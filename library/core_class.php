<?php
include_once("./../config.php");
class InstagramClass {
    public $client_id;
    public $access_token;
    public $url; 	
    public $redirect_url;
    public $refresh_url;
 	public function __construct($client_id,$access_token,$apiUrl){
         $this->client_id=$client_id;
         $this->access_token=$access_token;
         $this->url=$apiUrl;
 	}
 	public function create_url(){
 		   $this->access_token="1428820532.d4edbe0.45cfd49d0ebb4c10a6aa8adb4a15e88c";
 		  //$this->access_token="1428820532.1677ed0.e03c00712ad242328a0e07a1d1e94ac5";
        return $this->url."/?access_token=".$this->access_token;                 
 	}
 	public function get_access_token($redirect_url){
 		$this->redirect_url=$redirect_url;
 		$url="https://api.instagram.com/oauth/authorize/?client_id=".$this->client_id."&redirect_uri=".$this->redirect_url."&response_type=token"; 
 	    header('Location',$url);
 	}
    public function get_instagram_post(){
         
		    $ch = curl_init();
			$timeout = 0; 
			curl_setopt($ch, CURLOPT_URL, $this->create_url());
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			if (curl_errno($ch)) {
				echo curl_error($ch);
			    curl_close($ch);
			    exit();
			}
			curl_close($ch);
		return $file_contents;
    }

      
     public function refresh_access_token($access_token){
             $app_id=FB_CLIENT_ID;
             $app_secret=FB_CLINT_SECRET; 
             $this->refresh_url="https://graph.facebook.com/oauth/access_token?client_id={$app_id}&client_secret={$app_secret}&grant_type=fb_exchange_token&fb_exchange_token={$access_token}";

            return $this->refresh_url;                   	                   
     }

     public function genereate_new_accress_token($access_token){

     	    $ch = curl_init();
			$timeout = 0; 
			curl_setopt($ch, CURLOPT_URL, $this->refresh_access_token($app_id,$app_secret,$access_token));
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
		
			if (curl_errno($ch)) {
				echo curl_error($ch);
			    curl_close($ch);
			    exit();
			}
			curl_close($ch);
		return $file_contents;                         
     } 



 }
 ?>
