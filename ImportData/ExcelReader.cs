using System;
using System.Collections.Generic;
using System.Data;
using System.Data.OleDb;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ImportData
{
    public class ExcelReader
    {
        public string strCon { get; set; }
        public ExcelReader(string filepath)
        {
            strCon = " Provider = Microsoft.ACE.OLEDB.12.0; Data Source =" + filepath + ";Extended Properties='Excel 12.0;HDR=False;IMEX=1'";
        }

        public DataTable GetDataTable(string sheet)
        {
            try
            {
                using (OleDbConnection myConn = new OleDbConnection(strCon))
                {
                    string strCom = string.Format(" SELECT * FROM [{0}$] ", sheet);
                    myConn.Open();
                    OleDbDataAdapter myCommand = new OleDbDataAdapter(strCom, myConn);
                    DataTable myDataTable = new DataTable();
                    myCommand.Fill(myDataTable);
                    myConn.Close();

                    return myDataTable;
                }
            }
            catch (Exception ex)
            {
                throw ex;
            }
        }


    }
}
