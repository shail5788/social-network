<?php 
  error_reporting(1);
  include_once("config.php");
  include_once("library/core_class.php");
  include_once("library/twitteroauth/autoload.php");
  require_once("library/TwitterTextFormatter.php");
 

  use Abraham\TwitterOAuth\TwitterOAuth;
  use Netgloo\TwitterTextFormatter;
  // get data from twitter
  $connection=new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,TOKEN,TOKEN_SECRET);
  $content= $connection->get("account/verify_credentials");
  $tweets=$connection->get("statuses/user_timeline",
  						["screen_name"=>"auditoire","count"=>1,"exclude_replies"=>true,"include_rts"=>false,"tweet_mode"=>"extended"]);
 
 // print_r(json_encode($tweets));
  // get data from insta
  $instagram=new InstagramClass(CLIENTID,ACCESSTOKEN,APIURL);
  $insta_feeds=json_decode($instagram->get_instagram_post());
 

  $get_new_access_token=$instagram->genereate_new_accress_token("662278054181513","9efbb74c3bd889143a65cb5f849a28f7","EAAJaVqApeokBAPos8J6gO3KwpiZB47MU56evo57WZA6pPyKqAFULfrdo9GNyxResGsJLDzGksj79RqkRZAkoSxGIL0zKPR1GH844pBiuO5gGJgZBlhTlaTZBnyu2eUdDH4pJqHfEqiaOjUZCFSKTnnU1GrZAwiqEYkLrhaU9O1fZAAZDZD");

  print_r($get_new_access_token);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Social Media</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="http://phpmi2.delivery-projects.com/wp-content/themes/auditoire/assets/css/main.css?ver=1.1">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
	<style type="text/css">
		.thumbnail{ padding: 0; border-radius: 0;}
		.thumbnail img{ border-radius: 0px;}
		.thumbnail .caption{ padding: 7%;}
		.padding5{ padding:0 5px;}
		.col-sm-6 img{ width: 100%;}
		.col-sm-6 {
			width: 49%;
			margin: .5%;
		}
		
		
		
		
		
/*
		.inner-container {
		  column-count: 2;
		  column-gap:1%;
		}

		.thumbnail { 
		  background-color: #fff;	
		  display: inline-block;
		  padding:0;
		  width: 100%;
		  margin-bottom: 2%;
		}
*/
		
		
		
		
		hr{ margin-top: 0;}
		.masonry-col li{ list-style-type: none;}
		.post-icon{ display: none;}
		.post-icon img{ width: auto; }
		.post-message{ margin-bottom: 2%}
		.post-message iframe{ width: 100%;}
		.margintop10{ margin-top: 10px;}
		iframe,video{width: 100% !important; height: auto !important;}
      .img-circle img {
    border-radius: 50%;
    width: 50px;
    float: left;
    margin: 5px 15px 10px 15px;
}
.user-detail {
    margin: 5% 4% 0% 4%;
    display: inline-block;
    width: 92%;
}
.user-name {
    float: left;
    margin: 10px 0 0 0;
    font-weight: bold;
}
.user-name b{ display: block;}
.user-name span{ font-weight:normal; color:#888;display: inline-block;}
.like-tweet-share{ color: #6c757d; margin-left: 20px; font-size: 13px; padding-bottom: 10px;}
.like-tweet-share a{ color: #6c757d}
.like-tweet-share * {display: inline-block;}
.like-tweet-share a{ margin-right:0;}
.like-tweet-share .like-count, .like-tweet-share .comments-count, .like-tweet-share .share-count, .like-tweet-share .re-tweet, .like-tweet-share .re-tweet{ margin-right: 25px; margin-left: 5px;}
.like-tweet-share .likes{ margin-right: 25px;}
.like-tweet-share .likes span{ margin-right: 5px;}
</style>
</head>
<body>
   <div class="container">
	   <div class="inner-container">
        <input type="hidden" id="access_token" name="access_token" value="<?php ?>">   
 
   	   <div class="col-sm-6 thumbnail padding5">
		    <div class="">
           
           <?php if($insta_feeds->data[0]->type=='video'){ ?>
               <video width="350" height="260" controls>
                 <source src="
                  <?php echo $insta_feeds->data[0]->videos->standard_resolution->url; ?>" type="video/mp4">
               </video>   
          <?php }else { ?>
            
              <img src="
               <?php echo $insta_feeds->data[0]->images->standard_resolution->url; ?>"> 
           <?php } ?> 
           <div class="user-detail">
              <div class="img-circle">
                <img src="<?php echo $insta_feeds->data[0]->user->profile_picture  ?>" />
              </div>
			   <div class="user-name"><p><b><?php echo $insta_feeds->data[0]->user->full_name ?></b> - <span><?php echo $insta_feeds->data[0]->user->username ?></span> <span class="create-time"><?php echo date("F j, Y, g:i a",$insta_feeds->data[0]->created_time); ?></span></p>
               
 
              </div>
              
           </div>
           <div class="clearfix"></div>
          
          <div class="caption">
            <p><?php echo $insta_feeds->data[0]->caption->text; ?></p>
		  </div>	  
            <hr>
		<div class="like-tweet-share">		
            <span class="likes">
               <span>
                 <a href="<?php echo $insta_feeds->data[0]->link; ?>" target="_blank"><i class="fa fa-heart" aria-hidden="true"></i></a>
               </span>
              <?php echo $insta_feeds->data[0]->likes->count; ?></span>
            
              <span class="likes">
                <span>
                <a href="<?php echo $insta_feeds->data[0]->link; ?>" target="_blank"><i class="fa fa-comment" aria-hidden="true"></i></a>
              </span>
              <?php echo $insta_feeds->data[0]->comments->count; ?></span></span>            
          </div>
        </div>
		  </div>            
   	   
   	
	
		  <!-- Twitter section -->
      <?php 
   	    echo "<div class='col-sm-6 masonry-col thumbnail'>
				<ul>            
             
            <div class='clearfix'></div>
        ";
        
        foreach($tweets as $tweet){
          echo "<li>";
          
          // Print also the tweet's image if is set
          if(isset($tweet->extended_entities->media)){
       
            if($tweet->extended_entities->media[0]->type=="photo"){
             
               $media_url = $tweet->extended_entities->media[0]->media_url;
                echo "<img src='{$media_url}'  />";
             }else{
             
                 if(isset($tweet->extended_entities->media[0]->video_info)){
                  $video_url= $tweet->extended_entities->media[0]->video_info->variants[0]->url;
                   echo "<video width='400' controls>
                           <source src='{$video_url}' >
                        </video>";    

                 }
            }
            
           }
           echo "
           <div class='user-detail'>
                  <div class='img-circle'>
                     <img src='".$tweets[0]->user->profile_image_url."'/> 
                  </div>
                   <div class='user-name'><p><b>".$tweets[0]->user->name."</b> - <span>".$tweets[0]->user->screen_name."</span> <span>".date("F j, Y, g:i a",strtotime($tweets[0]->created_at))."</span></p>
                    </div>
               </div>     
            <div class='clearfix'></div>
           ";  
           echo "<div class='caption'><p class='title'>".$tweet->full_text."</p>";
          echo TwitterTextFormatter::format_text($tweet)."<br/>";
          echo "</div><hr/></li>";
        }
         
        echo "
         <div class='like-tweet-share'>
            <span><a href='https://twitter.com/intent/tweet?in_reply_to=".$tweets[0]->id_str."' target='_blank'><i class='fa fa-reply' aria-hidden='true'></i></a> </span>
            <span><a href='https://twitter.com/intent/retweet?tweet_id=".$tweets[0]->id_str."' target='_blank'><i class='fa fa-retweet' aria-hidden='true'></i></a> <span class='re-tweet'>".$tweets[0]->retweet_count."</span></span> 
            <span><a href='https://twitter.com/intent/favorite?tweet_id=".$tweets[0]->id_str."' target='_blank'><i class='fa fa-heart' aria-hidden='true'></i> </a><span class='re-tweet'>".$tweets[0]->favorite_count."</span></span> 
         </div>  
        </ul></div>"; 

    ?>
			  	
  <!-- Twitter section -->

  <!--Getting data facebook -->
			  
				  <div class="thumbnail col-sm-6" id="facebook-thumbnail">

            
				  </div>
          <!--end facebook data section--> 
			  </div>		  
		  
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      var dataSet=[];
      $.ajax({
       type:"GET",
        url:'https://graph.facebook.com/144759862206977?fields=about,is_published,bio,global_brand_page_name,built,cover,general_info,username,picture&limit=10&access_token=EAABZCwDdoWC8BAC1a6T4zKG3FMgZCN39jsVKfkQWgaf6GOAy0Grgqt38wD07kMj6nZAN5ioD8jPSju0BZBPAyXssLI7qlcXDS846d0h2Xj4UJ8DpJCMiGKpSk9iZCUwYkrO9ojk0ML1HKppqPckeepAqQBgPEgkGKzvjP7byMoQZDZD',
        success:function(data){
    
           dataSet.push(data);
              $.ajax({
                    type:"GET",
                    url:'https://graph.facebook.com/144759862206977/feed?fields=id,picture,created_time,admin_creator,full_picture,is_instagram_eligible,is_popular,is_eligible_for_promotion,is_spherical,message,message_tags,multi_share_end_card,multi_share_optimized,parent_id,place,privacy,promotable_id,promotion_status,properties,scheduled_publish_time,shares,status_type,likes.summary(1).limit(0),comments.summary(1).limit(0),story,story_tags,subscribed,target,targeting,timeline_visibility,updated_time,via,video_buying_eligibility,width,attachments{media,media_type,url,target{id},description,description_tags}&limit=1&access_token=EAABZCwDdoWC8BAC1a6T4zKG3FMgZCN39jsVKfkQWgaf6GOAy0Grgqt38wD07kMj6nZAN5ioD8jPSju0BZBPAyXssLI7qlcXDS846d0h2Xj4UJ8DpJCMiGKpSk9iZCUwYkrO9ojk0ML1HKppqPckeepAqQBgPEgkGKzvjP7byMoQZDZD',
                    success:function(data){
                      dataSet.push(data);
                      
                      var date= new Date(dataSet[1].data[0].created_time);
                      var d=Date.parse(dataSet[1].data[0].created_time);
                      var created_time=moment(d).format('MMMM Do YYYY, h:mm a');
                      var share_count="0";
                      if(dataSet[1].shares){
                        $share_count=dataSet[1].shares.count;
                      }
                      var media="";
                      var mediaSource="";
                      if(typeof dataSet[1].data[0].attachments &&(dataSet[1].data[0].attachments.data[0].media_type=="link" ||dataSet[1].data[0].attachments.data[0].media_type=="photo")){
                           media=dataSet[1].data[0].attachments.data[0].media.image.src;
                           mediaSource="<img src='"+media+"' style='max-height:300px;'/>"
                           $(".post-message").html(mediaSource);
                      }
                      else if(typeof dataSet[1].data[0].attachments && dataSet[1].data[0].attachments.data[0].media_type=="video"){
                          $.ajax({
                             type:"GET",
                             async:false,
                             url:"https://graph.facebook.com/"+dataSet[1].data[0].attachments.data[0].target.id+"?fields=embed_html,source&access_token=EAABZCwDdoWC8BAC1a6T4zKG3FMgZCN39jsVKfkQWgaf6GOAy0Grgqt38wD07kMj6nZAN5ioD8jPSju0BZBPAyXssLI7qlcXDS846d0h2Xj4UJ8DpJCMiGKpSk9iZCUwYkrO9ojk0ML1HKppqPckeepAqQBgPEgkGKzvjP7byMoQZDZD",
                             success:function(data){
                               // console.log(data);
                               mediaSource=data.embed_html;
                             }
                          })
                          // media=dataSet[1].data[0].attachments.data[0].url;
                          // mediaSource="<iframe width='420' height='315' src='"+media+"'></iframe>";
                          //  $(".post-message").html(mediaSource);
                      }

                    // get post id
                    var targetUrl="";
                    if(typeof dataSet[1].data[0].attachments.id=="undefined"){
                        var id=dataSet[1].data[0].id;
                        var ids= id.split("_");
                        targetUrl="https://www.facebook.com/144759862206977/posts/"+ids[1]; 
                    }else{
                      targetUrl=dataSet[1].data[0].attachments.target.url; 
                    }
                    
                    var feeds=  `
                      <div class="post-item">
                          <div class="post-message">${mediaSource}
                      </div>
                      </div> 
                       <div class="user-detail">
                                   <div class="img-circle">
                                     <img src="${dataSet[0].picture.data.url}" /> 
                                   </div>
                                   <div class="user-name"><p><b>${dataSet[0].global_brand_page_name}</b> - <span>${dataSet[0].username}</span> <span class="created-time">${created_time}</span></p>  
                               </div>
                            </div>
                     <div class="clearfix"></div>       
                    <div class="caption">
                      <p>${dataSet[1].data[0].message}</p>
                    </div> 
                    <hr/>
                   <div class="like-tweet-share">
                      <a href="${targetUrl}" class="" target="_blank"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                       <span class="like-count">${dataSet[1].data[0].likes.summary.total_count}</span> 
                      <a href="${targetUrl}" class="" target="_blank"><i class="fa fa-comment" aria-hidden="true"></i></a>
                       <span class="comments-count">${dataSet[1].data[0].comments.summary.total_count}</span> 
                       <a href="${targetUrl}" class="" target="_blank"><i class="fa fa-share" aria-hidden="true"></i></a> 
                      <span class="share-count">${dataSet[1].data[0].shares.count}</span> 
                   </div>          
                    `;  

                     $("#facebook-thumbnail").html(feeds);

                    }
                  }) 
       }
    })
      
    })
    
  </script>
</body>
</html>