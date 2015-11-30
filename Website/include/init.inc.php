<?php


  require ROOT.'/classes/datamgr/website.cls.php';
  $siteinfo=$websiteMgr->getWebsiteInfo();
  $smarty->assign("SITEINFO",$siteinfo);


?>