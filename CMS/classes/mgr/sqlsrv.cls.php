<?php


class DbSqlsrv
{
	/**
	* Sqlsrv connect identifier
	* @var resource
	*/
	public $conn;
	public $in_trans;

	/**
	* calculate executed sql statement num
	* @var int
	*/
	public $querynum = 0;
	private  $codeKey="unbreakable";

	private static $instance = null;
	
	public static function getInstance() 
	{
		return self::$instance!=null ? self::$instance : new DbSqlsrv();
	}
	
	private function __construct()
	{
		
	}
	
	function __destruct()
	{		
		//~ close the opened connection(no effect to sqlsrv_pconnect)
		if($this->conn)	$this->close();
	}
	
	/**
	* connect to db, return connect identifier
	* @param string db host
	* @param string db user
	* @param string db password
	* @param string db name
	* @param bool is persistent connection: 1 - Yes, 0 - No
	* @return link_identifier
	*/
	function connect($dbhost, $dbuser, $dbpass, $dbname = '', $pconnect = 0) 
	{
		//echo $dbhost.' '.$dbuser.' '.$dbpass.' '.$dbname;exit;
		$serverName = $dbhost;
		$uid = $dbuser;
		$pwd = $dbpass;
		$connectionInfo = array( "UID"=>"$dbuser",
					"PWD"=>"$dbpass",
					"Database"=>"$dbname",
					"CharacterSet"=>"UTF-8");
		
		if(!$this->conn = sqlsrv_connect( "$dbhost", $connectionInfo))
		{
			$this->halt('service unavailable');
		}
		
		return $this->conn;
	}
	
	
	function connect_without_msg($dbhost, $dbuser, $dbpass, $dbname = '', $pconnect = 0) 
	{
		global $LANG;
		$func = $pconnect == 1 ? 'sqlsrv_pconnect' : 'sqlsrv_connect';
		if(!$this->conn = @$func($dbhost, $dbuser, $dbpass))
		{
//			$this->halt($LANG['service_unavailable']);
		}

		
		return $this->conn;
	}

	/**
	* select database
	* @param string db name
	* @return boolean Success: true, Fail: false
	*/
	function select_db($dbname) 
	{
		return @sqlsrv_select_db($dbname , $this->conn);
	}
	
	function begin_trans()
	{
		if (sqlsrv_begin_transaction( $this->conn) == false)
		{
		     echo "Could not begin transaction.\n";
		     die( print_r( sqlsrv_errors(), true ));
		}
		$this->in_trans=true;
	}
	function commit_trans()
	{
		sqlsrv_commit( $this->conn );
		$this->in_trans=false;
	}
	function rollback_trans()
	{
		sqlsrv_rollback( $this->conn );
		$this->in_trans=false;
	}

	/**
	* execute sql statement
	* @param string $sql: sql statement
	* @param string $type: default '', option: CACHE | UNBUFFERED
	* @param int $expires: Cache lifetime, second for unit
	* @param string $dbname: db name
	* @return resource
	*/
	function query($sql) 
	{
		if(!($query = @sqlsrv_query($this->conn,$sql)))
		{
			logger_mgr::logError("sql error :$sql");
			if($this->in_trans)
			{
				$this->rollback_trans();
			}
			echo "aa";
			print_r( sqlsrv_errors());
			$this->halt($sql.sqlsrv_errors(), $sql);
			
			
		}
		logger_mgr::logDebug("sql :$sql");
		$this->querynum++;
		
		return $query;
	}

	function getNewId($tablename){
		$sql="select isnull(max(id),0)+1 from ".$tablename;
		$query = $this->query($sql);
		$result = $this->fetch_array($query); 
		$id=$result[0];
		return $id;
	}
	
	function getDate(){
		return " GETDATE() ";
	}
	function query2($sql,$type,$value) 
	{
		if(!($query = @sqlsrv_query($this->conn,$sql)))
		{
			$this->halt($sql.sqlsrv_errors(), $sql);
		}
		$this->querynum++;
		return $query;
	}
	
	/**
	* execute sql statement, only get one record
	* @param string $sql: sql statement
	* @param string $type: default '', option: CACHE | UNBUFFERED
	* @param int $expires: Cache lifetime, second for unit
	* @param string $dbname: db name
	* @return array, if no record in $query, return an empty array
	*/
	function get_one($sql)
	{
		$query = $this->query($sql);
		$row = $this->fetch_array($query);
		$this->free_result($query);
		//return $row ;
		return $row===false ? array() : $row ;
	}
	
	/**
	* get one row data as associate array from resultset.
	* @param resource ResultSet
	* @param string define return array type, option value: MYSQL_ASSOC, MYSQL_BOTH, MYSQL_NUM
	* @return array
	*/
	function fetch_array($query) 
	{
		return sqlsrv_fetch_array($query);
	}
	
	/**
	* get all rows data as associate array from resultset.
	* @param resource: ResultSet
	* @param string: define return array type,option value: MYSQL_ASSOC, MYSQL_BOTH, MYSQL_NUM
	* @return array: contain all rows data in $query; if no record in $query, return an empty array
	*/
	function fetch_array_all($query) 
	{
		while($row=sqlsrv_fetch_array($query))
			$rows[] = $row;
		//return $rows;
		return !is_array($rows)? array() : $rows ;
	}

	function fetch_one_column( $query, $colname )
	{
		$retarr = $this->fetch_array_all( $query );
		foreach ( $retarr as &$v ){
			$v = $v[$colname];
		}
		return 	$retarr;
	}
	
	/**
	* save or update db record
	* @param string $sql_check: check if exist sql statement
	* @param string $sql_update: update sql statement
	* @param string $sql_insert: insert sql statement
	* @return effect row num
	*/
	function save_or_update($sql_check, $sql_update, $sql_insert) 
	{
		$this->query($sql_check);
		if ( $this->affected_rows() > 0 ) {	// exist corresponding record
			$this->query($sql_update);	
		} else {	// no exist
			$this->query($sql_insert);
		}
		
		return $this->affected_rows();
	}
	
	/**
	* get the last effect row num
	* @return int
	*/
	function affected_rows() 
	{
		return sqlsrv_affected_rows($this->conn);
	}

	/**
	* get record count of resultset
	* @return int
	*/
	function num_rows($query) 
	{
		return sqlsrv_num_rows($query);
	}

	/**
	* get field count of resultset
	* @return int
	*/
	function num_fields($query) 
	{
		return mysql_num_fields($query);
	}

    /**
     * get result set 
     * @return array
     */
	function result($query, $row) 
	{
		return @sqlsrv_result($query, $row);
	}

	
	/**
	 * free result set
	 * @return bool whether free result success 
	 */
	function free_result($query) 
	{
		return sqlsrv_free_result($query);
	}


    /**
     * get one row from resultset
	 * @return array
	 */
	function fetch_row($query) 
	{
		return sqlsrv_fetch_row($query);
	}


	/**
	 * close db connection
	 * @return bool whether close connection successful
	 */
	function close() 
	{
		return sqlsrv_close($this->conn);
	}

	/**
	 * Character encoding conversion
	 * @return character
	 */
//	function setCharsetEncoding($data){;
//		$data = ($data,'iso8859-1','utf-8');
//		return $data;
//	}
	
    /**
	* display error message and exit
	* @param string $message
	* @param string $sql, sql statememt
	*/
	function halt($message = '', $sql = '')
	{
		
		echo $message;
		echo "The method or operation is not implemented.";
		exit();
	}

  
}




$dbmgr = DbSqlsrv::getInstance();
$myconn = $dbmgr->connect($CONFIG['database']['host'], $CONFIG['database']['user'], $CONFIG['database']['psw'], $CONFIG['database']['database']);

?>