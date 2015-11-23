<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require '../include/common.inc.php';
include ROOT.'/include/init.inc.php';
  
  $smarty->assign("MyModule","admin");
  $smarty->assign("MyMenuId","about");
  $smarty->display(ROOT.'/templates/about.html');
?>