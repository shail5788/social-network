<?php 



use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

require_once 'library/facebook/src/Facebook/autoload.php';
require_once 'library/facebook/src/Facebook/Exceptions/FacebookResponseException.php';
require_once 'library/facebook/src/Facebook/Exceptions/FacebookSDKException.php';
require_once 'library/facebook/src/Facebook/Helpers/FacebookRedirectLoginHelper.php';

$appId = "163746873701765";
$appSecret = "de24adde0e96ad77d5fbdab43a725c34";
$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v3.1'
]);
$id="897487457271709";

$accessToken='EAACU7Uo9dYUBAH0baXpo0ZCC6QZBd5yEZCrJ0bq9p4N5vIFYQfcnByoZA8NgbfsMgBQuc4Akprt4pMVAZB1Lty6yJwZCGinSUiFFbW1R5Nshfnd753mnZBmNoJkvtD7QvZAZCMXxQejPfKJnvdXq5gJxk59OKXpvangqIZAHgAIfMD5vdJRSrdqyxLRlZCgRVslWirI24jnayZAZBo89WDUR5PxZA4lMbwUWZChL8kUcorCjPxr9AZDZD';
$postData = "";
try {
   
    // $accessToken = $helper->getAccessToken();  
    $userPosts =$fb->get("/897487457271709/feed?fields=id,message,link,name,description,type,icon,source,likes.summary(1).limit(0)&amp;", $accessToken);
    $postBody = $userPosts->getDecodedBody();

    $postData = $postBody["data"];
    // print_r(json_encode($postData));
} catch (FacebookResponseException $e) {
    echo $e;
    exit();
} catch (FacebookSDKException $e) {
	 //echo $e;
     //display error message
    exit();
}



?>
<style>
body {
    width: 550px;
    font-family: Arial;
}

.post-item {
    border-bottom: 1px #F0F0F0 solid;
    padding: 10px;
}
.post-message {
    font-size: 1em;
    padding-bottom: 8px;
}

.post-date {
    color: #b7b7b7;
    font-size: 0.9em;
    font-style: italic;
}
</style>



<?php
if (! empty($postData)) {
    // foreach ($postData as $k => $v) {
        
?>
<div class="post-item">
<div class="post-message">
	<?php 
	      if(!empty($postData[0]["type"]) && $postData[0]['type']=="video"){
	         echo "<iframe width='420' height='315' src='".$postData[0]['source']."'>
				</iframe>";
	       } ?>
</div>
<div class="post-name"><h3><?php echo $postData[0]['name']; ?></h3></div>
<div class="post-name"><span><?php echo $postData[0]['message']; ?></span></div>
<div class="post-date"><?php if(!empty($postData[0]["likes"])){
	  echo "<span>Likes-".$postData[0]["likes"]['summary']['total_count']."</span>";
}   ?></div>
<div class="post-icon"><?php 
	  echo "<span><img src='".$postData[0]['icon']."'</span>";  ?></div>
</div>
<?php
    // }
}
?>