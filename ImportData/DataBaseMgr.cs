using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data;
using MySql.Data.MySqlClient;

namespace ImportData
{
    public class DataBaseMgr
    {
        string connectionStr = "";
        public DataBaseMgr()
        {
            connectionStr = ConfigurationManager.ConnectionStrings["Default"].ToString();
        }
        public DataTable executeDataTable(string sql)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connectionStr))
                {
                    conn.Open();
                    using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                    {
                        MySqlDataAdapter adt = new MySqlDataAdapter(cmd);
                        DataTable dt = new DataTable();
                        adt.Fill(dt);
                        return dt;
                    }
                }
            }
            catch(Exception ex)
            {
                return null;
            }
        }
        public IDataReader executeReader(string sql)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connectionStr))
                {
                    conn.Open();
                    using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                    {
                        return cmd.ExecuteReader();
                    }
                }
            }
            catch (Exception ex)
            {
                return null;
            }
        }

        public void executeNoneQuery(string sql)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(connectionStr))
                {
                    conn.Open();
                    using (MySqlCommand cmd = new MySqlCommand(sql, conn))
                    {
                        cmd.ExecuteNonQuery();
                    }
                }
            }
            catch (Exception ex)
            {
            }
        }
    }
}
