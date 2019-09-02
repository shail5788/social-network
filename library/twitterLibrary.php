<?php
error_reporting(E_ALL);
class twitterClass {
    public $consumer_key;
    public $consumer_secret_key;
    public $token;
    public $token_secret; 
    public $apiUrl;	

 	public function __construct($consumer_key,$consumer_secret_key,$token,
 		$token_secret){

         $this->consumer_key=$consumer_key;
         $this->consumer_secret_key=$consumer_secret_key;
         $this->token=$token;
         $this->token_secret=$token_secret;
         $this->apiUrl="https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=snap";

 	}

 public function buildBaseString($baseURI, $method, $params)
	{
	    $r = array(); 
	    ksort($params);
	    foreach($params as $key=>$value){
	        $r[] = "$key=" . rawurlencode($value); 
	    }
	    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); 
	}

	public function buildAuthorizationHeader($oauth)
	{
	    
	    $r = 'Authorization: OAuth '; 
	    $values = array(); 
	    foreach($oauth as $key=>$value)
	        $values[] = "$key='" . rawurlencode($value) . "'"; 
	    $r .= implode(', ', $values); 

	    return $r; 
	}





 	public function the_nonce(){
    	$nonce = base64_encode(uniqid());
    	$nonce = preg_replace('~[\W]~','',$nonce);
    	return $nonce;
	}

    

	
    public function create_url(){
        return $this->url."/?access_token=".$this->access_token;                 
 	}
    public function get_twittes(){
           

    	$url=$this->apiUrl;
    	$oauth_access_token =$this->token;
		$oauth_access_token_secret =$this->token_secret;
		$consumer_key = $this->consumer_key;
		$consumer_secret =$this->consumer_secret_key;

		$oauth = array( 'oauth_consumer_key' => $consumer_key,
		                'oauth_nonce' => time(),
		                'oauth_signature_method' => 'HMAC-SHA1',
		                'oauth_token' => $oauth_access_token,
		                'oauth_timestamp' => time(),
      		            'oauth_version' => '1.0');
          
        
        $base_info = $this->buildBaseString($url, 'GET', $oauth);
		$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		 $oauth['oauth_signature'] = $oauth_signature;   



         

          $header = array($this->buildAuthorizationHeader($oauth), 'Expect:');
			$options = array( CURLOPT_HTTPHEADER => $header,
			                  CURLOPT_HEADER => false,
			                  CURLOPT_URL => $url,
			                  CURLOPT_RETURNTRANSFER => true,
			                  CURLOPT_SSL_VERIFYPEER => false);
          
			$feed = curl_init();
			curl_setopt_array($feed, $options);
			$json = curl_exec($feed);
			curl_close($feed);

			$twitter_data = json_decode($json);
			print_r($twitter_data);          
   
    }

 
 }
 ?>
