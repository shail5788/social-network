<?php 
  error_reporting(1);
 include_once("config.php");
 include_once("library/core_class.php");

 $instagram=new InstagramClass(CLIENTID,ACCESSTOKEN,APIURL);
 $redirect_url="http://localhost/";
 $data=$instagram->get_access_token($redirect_url);
 


?>