using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ImportData
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btnImportHospital_Click(object sender, EventArgs e)
        {
            OpenFileDialog of = new OpenFileDialog();
            if (of.ShowDialog() == DialogResult.OK)
            {
                string excelpath = of.FileName;
                ExcelReader xlsReader = new ExcelReader(excelpath);
                DataTable dt = xlsReader.GetDataTable("医院字典");
                int id = 101;
                StringBuilder sb = new StringBuilder();
                foreach (DataRow dr in dt.Rows)
                {
                    string seq = dr["医院代码"].ToString();
                    string name = dr["医院名称"].ToString();
                    string level = dr["医院等级"].ToString();
                    string property = dr["医院性质"].ToString();
                    string address = dr["医院地址"].ToString();
                    string description = convertContent(dr["医院简介"].ToString());

                    string sql =string.Format(@"INSERT INTO `ncmi151123`.`tb_hospital`
(`id`,`created_date`,`created_user`,`updated_date`,`updated_user`,
`name`,`seq`,`shortname`,`photo`,
`address`,`postcode`,`website`,`email`,`content`
,`count`,`remarks`,`status`,`level`,`property`)
VALUES
({0},now(),1,now(),1,
'{1}','{6}','{1}','',
'{2}','545600','暂无','暂无','{3}',
0,'','A','{4}','{5}');
", id++,name,address,description,level,property,seq);
                    sb.AppendLine(sql);
                }
                richTextBox1.Text = sb.ToString();
            }

        }

        public string convertContent(string content)
        {
            string[] conarr = content.Split(new string[] { "\r\n", "\n" }, StringSplitOptions.RemoveEmptyEntries);
            StringBuilder sb = new StringBuilder();
            foreach (string line in conarr)
            {
                sb.AppendLine("<p>"+line+"</p>");
            }
            return sb.ToString();
        }

        private void btnDoctor_Click(object sender, EventArgs e)
        {
            OpenFileDialog of = new OpenFileDialog();
            if (of.ShowDialog() == DialogResult.OK)
            {
                string excelpath = of.FileName;
                ExcelReader xlsReader = new ExcelReader(excelpath);
                DataTable dt = xlsReader.GetDataTable("医生字典");
                int id = 101;
                StringBuilder sb = new StringBuilder();
                foreach (DataRow dr in dt.Rows)
                {
                    string seq = dr["医师代码"].ToString();
                    string name = dr["医师姓名"].ToString();
                    string sextual = dr["医师性别"].ToString();
                    string birth = dr["出生年月"].ToString();
                    string expert = dr["研究领域"].ToString();
                    string department = dr["所在科室"].ToString();
                    string hospital = dr["所在医院"].ToString();
                    string content = convertContent(dr["简介（执业经历）"].ToString());

                    string department_id = getIdFromName(department, "tb_department");
                    string hospital_id = getIdFromName(hospital, "tb_hospital");

                    string sql = string.Format(@"INSERT INTO `ncmi151123`.`tb_doctor`
(`id`,`created_date`,`created_user`,`updated_date`,`updated_user`,
`name`,`photo`,`hospital_id`,`department_id`,`status`,`seq`,`count`,`content`,
`duty_mon_m`,`duty_mon_a`,`duty_tue_m`,`duty_tue_a`,`duty_wed_m`,`duty_wed_a`,`duty_thu_m`,`duty_thu_a`,
`duty_fri_m`,`duty_fri_a`,`duty_sat_m`,`duty_sat_a`,`duty_sun_m`,`duty_sun_a`,`duty_notice`,
`remarks`,`position`,`expert`,`sextual`,`price`,`loginname`)
VALUES
({0},now(),1,now(),1,
'{1}','nophoto.png',{2},{3},'A','{4}',0,'{5}',
8,6,8,6,8,6,8,6,8,6,8,6,8,6,''
,'','主任医师','{6}','{7}',100,'no__{4}');
;
", id++, name, hospital_id, department_id, seq, content, expert,sextual);
                    sb.AppendLine(sql);
                }
                richTextBox1.Text = sb.ToString();
            }

        }

        private string getIdFromName(string name,string tablename)
        {
            DataBaseMgr mgr=new DataBaseMgr();
            string sql = "select id from " + tablename + " where name='" + name + "'";
            using (DataTable dt = mgr.executeDataTable(sql))
            {
                foreach (DataRow dr in dt.Rows)
                {
                    return Convert.ToString(dr["id"]);
                }
            }
            return "0";
        }

    }
}
