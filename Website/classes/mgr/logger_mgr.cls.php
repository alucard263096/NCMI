<?PHP

	require_once PEAR_HOME.'Log.php';
	class logger {
		var $_logger;
		var $_key;
		var $_log_file;
		var $_is_on = true;
		function logger($key, $log_file) {
			$mask = Log::MAX(PEAR_LOG_DEBUG);
			$conf = array('mode' => 0600, 'dirmode' => 777, 'lineFormat' => '%{timestamp} [%{priority}]: %{message}', 'timeFormat' => '%d/%m/%Y %H:%M:%S');
			$this->_key = $key;
			$this->_log_file = $log_file;
			$this->_logger =& Log::singleton('file', $this->_log_file, $this->_key, $conf);
			$this->_logger->setMask($mask);
		}
		function info($msg) {
			if ($this->_is_on) {
				$l = $this->_logger;
				$l->info($msg);								
			}
		}
		function error($msg) {
			if ($this->_is_on) {
				$l = $this->_logger;
				$l->err($msg);								
			}
		}
		function debug($msg) {
			if ($this->_is_on) {
				$l = $this->_logger;
				$l->debug($msg);	
			}
		}
		function set_enabled($flag) {
			$this->_is_on = (boolean)$flag;
		}		
	}
	
	class logger_mgr {
		function get_info_logger() {
			$filename = strftime(LOGGER_INFO_FILE);
			return new logger('', $filename);
		}
		function get_error_logger() {
			$filename = strftime(LOGGER_ERROR_FILE);
			return new logger('', $filename);
		}
		function get_debug_logger() {
			$filename = strftime(LOGGER_DEBUG_FILE);
			return new logger('', $filename);
		}
		function _error_handler($err) {
			logger_mgr::_error_handler_nodie($err);									
			die('Error');
		}
		function _error_handler_nodie($err) {			
			$l = logger_mgr::get_logger();									
			$msg = "\n".$err->toString()."\n";
			foreach ($err->backtrace as $item) {
				$msg .= sprintf("%s %s %s %s",
					$item['file'],$item['line'],$item['function'],
					$item['class'])."\n";									
			}
			$l->error(sprintf("[%s]%s", session_id(), $msg));
		}
		function logError($err){
			$l = logger_mgr::get_error_logger();
			$l->error($err);
		}
		function logInfo($info){
			$l = logger_mgr::get_info_logger();
			$l->info($info);
		}
		function logDebug($info){
			if(LOGGER_IS_DEBUG)
			{
				$l = logger_mgr::get_debug_logger();
				$l->debug($info);
			}
		}
	}
?>