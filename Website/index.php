<?php
/*
 * Created on 2012-6-30
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require 'include/common.inc.php';
  require ROOT.'/classes/datamgr/notice.cls.php';
  require ROOT.'/classes/datamgr/banner.cls.php';
  

  $notice=$noticeMgr->getNoticeContent();
  $smarty->assign("notice",$notice);

  
  $bannerlist=$bannerMgr->getIndexBannerList();
  $smarty->assign("bannerlist",$bannerlist);
  
  $smarty->display(ROOT.'/templates/index.html');
  
?>