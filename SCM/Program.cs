using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace SCM
{
    class Program
    {
        static void Main(string[] args)
        {
            log4net.ILog logInfo = log4net.LogManager.GetLogger("loginfo");
            log4net.ILog logError = log4net.LogManager.GetLogger("loginfo");
            DataBaseMgr dbMgr=new DataBaseMgr();
            log4net.Config.XmlConfigurator.Configure();

            while (true)
            {
                Console.WriteLine(DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss")+"：准备请求发送短信");
                string sql = string.Format(@"select o.id, d.name doctor_name,c.tel mobile
,concat( o.meeting_date,' ', reverse(substring_index(reverse(substring_index(o.meeting_time,'-',1)),'-',1))) order_date 
from tb_order o
inner join tb_doctor d on o.doctor_id=d.id
inner join tb_member_case c on o.case_id=c.id
where  IFNULL(o.send,'N')<>'Y'
and concat( o.meeting_date,' ', reverse(substring_index(reverse(substring_index(o.meeting_time,'-',1)),'-',1)))>'{0}'
and concat( o.meeting_date,' ', reverse(substring_index(reverse(substring_index(o.meeting_time,'-',1)),'-',1)))<'{1}' ", DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss"), DateTime.Now.AddMinutes(17).ToString("yyyy-MM-dd HH:mm:ss"));
                DataTable dt = dbMgr.executeDataTable(sql);
                int successCount=0;
                foreach (DataRow dr in dt.Rows)
                {
                    string id = dr["id"].ToString();
                    string doctor_name = dr["doctor_name"].ToString();
                    string order_date = dr["order_date"].ToString();
                    string mobile = dr["mobile"].ToString();
                    SMSMgr smsMgr = new SMSMgr();
                    bool sent = smsMgr.sendSuccessBookingMsg(mobile, doctor_name, order_date);
                    if (sent)
                    {
                        string format=string.Format("发送{0}短信成功",mobile);
                        Console.WriteLine(format);
                        logInfo.Info(format);
                        string update = "update tb_order set send='Y' where id="+id;
                        dbMgr.executeNoneQuery(sql);
                        successCount++;
                    }
                    else
                    {
                        string format = string.Format("发送{0}短信失败，原因：{1}", mobile, smsMgr.Result);
                        Console.WriteLine(format);
                        logError.Error(format);
                    }
                }
                string totalFormat = string.Format("完成发送，共{0}条信息需要发送，其中{1}条发送成功", dt.Rows.Count, successCount);
                Console.WriteLine(totalFormat);
                Thread.Sleep(1000 * 60);
            }


            
            Console.Read();

        }
    }
}
