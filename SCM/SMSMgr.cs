using System;
using System.Collections.Generic;
using System.Configuration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SCM
{
    class SMSMgr
    {
        string ret = null;
        public string Result
        {
            get
            {
                return ret;
            }
        }
        string AccountSid, AccountToken, AppId, ServerIP, ServerPort;
        public SMSMgr()
        {
             AccountSid = ConfigurationManager.AppSettings["AccountSid"].ToString();
             AccountToken = ConfigurationManager.AppSettings["AccountToken"].ToString();
             AppId = ConfigurationManager.AppSettings["AppId"].ToString();
             ServerIP = ConfigurationManager.AppSettings["ServerIP"].ToString();
             ServerPort = ConfigurationManager.AppSettings["ServerPort"].ToString();

        }

        public bool sendSuccessBookingMsg(string mobile,string doctorName,string orderDate){

            string bookingsuccess = ConfigurationManager.AppSettings["bookingsuccess"].ToString();
            string[] content = new string[] { doctorName, orderDate };
            try
            {
                CCPRestSDK.CCPRestSDK api = new CCPRestSDK.CCPRestSDK();
                //ip格式如下，不带https://
                bool isInit = api.init(ServerIP, ServerPort);
                api.setAccount(AccountSid, AccountToken);
                api.setAppId(AppId);
                if (isInit)
                {
                    Dictionary<string, object> retData = api.SendTemplateSMS(mobile, bookingsuccess, content);
                    ret = getDictionaryData(retData);
                    return true;
                }
                else
                {
                    ret = "初始化失败";
                }
            }
            catch (Exception exc)
            {
                ret = exc.Message;
            }
            return false;
        }
        private string getDictionaryData(Dictionary<string, object> data)
        {
            string ret = null;
            foreach (KeyValuePair<string, object> item in data)
            {
                if (item.Value != null && item.Value.GetType() == typeof(Dictionary<string, object>))
                {
                    ret += item.Key.ToString() + "={";
                    ret += getDictionaryData((Dictionary<string, object>)item.Value);
                    ret += "};";
                }
                else
                {
                    ret += item.Key.ToString() + "=" + (item.Value == null ? "null" : item.Value.ToString()) + ";";
                }
            }
            return ret;
        }
    }
}
