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
    }
}
