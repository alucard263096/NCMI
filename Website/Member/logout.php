<?php
require '../include/common.inc.php';

//$lang=$_SESSION[SESSIONNAME]["SysLang"];
$_SESSION[SESSIONNAME]=null;
empty($_SESSION[SESSIONNAME]);
WindowRedirect("../index.php");

?>