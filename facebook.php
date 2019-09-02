<?php 



// require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

// $fb = new \Facebook\Facebook([
//   'app_id' => '662278054181513',
//   'app_secret' => '9efbb74c3bd889143a65cb5f849a28f7',
//   'default_graph_version' => 'v2.10',
//   //'default_access_token' => '{access-token}', // optional
// ]);

// // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
// //   $helper = $fb->getRedirectLoginHelper();
// //   $helper = $fb->getJavaScriptHelper();
// //   $helper = $fb->getCanvasHelper();
// //   $helper = $fb->getPageTabHelper();

// try {
//   // Get the \Facebook\GraphNodes\GraphUser object for the current user.
//   // If you provided a 'default_access_token', the '{access-token}' is optional.
//   $response = $fb->get('/144759862206977/feed?fields=id,picture,created_time,admin_creator,full_picture,is_instagram_eligible,is_popular,is_eligible_for_promotion,is_spherical,message,message_tags,multi_share_end_card,multi_share_optimized,parent_id,place,privacy,promotable_id,promotion_status,properties,scheduled_publish_time,shares,status_type,story,story_tags,subscribed,target,targeting,timeline_visibility,updated_time,via,video_buying_eligibility,width,attachments{media,media_type,url,target,description,description_tags}&limit=10', 'EAABZCwDdoWC8BAC1a6T4zKG3FMgZCN39jsVKfkQWgaf6GOAy0Grgqt38wD07kMj6nZAN5ioD8jPSju0BZBPAyXssLI7qlcXDS846d0h2Xj4UJ8DpJCMiGKpSk9iZCUwYkrO9ojk0ML1HKppqPckeepAqQBgPEgkGKzvjP7byMoQZDZD');
// } catch(\Facebook\Exceptions\FacebookResponseException $e) {
//   // When Graph returns an error
//   echo 'Graph returned an error: ' . $e->getMessage();
//   exit;
// } catch(\Facebook\Exceptions\FacebookSDKException $e) {
//   // When validation fails or other local issues
//   echo 'Facebook SDK returned an error: ' . $e->getMessage();
//   exit;
// }

// $me = $response->getGraphUser();
// echo 'Logged in as ' . $me->getName();



//  $data=file_get_contents("https://graph.facebook.com/212657702522878/feed?fields=id,picture,created_time,admin_creator,full_picture,is_instagram_eligible,is_popular,is_eligible_for_promotion,is_spherical,message,message_tags,multi_share_end_card,multi_share_optimized,parent_id,place,privacy,promotable_id,promotion_status,properties,scheduled_publish_time,shares,status_type,story,story_tags,subscribed,target,targeting,timeline_visibility,updated_time,via,video_buying_eligibility,width,attachments{media,media_type,url,target,description,description_tags}&limit=10
// &access_token=EAAaJYOY9hb4BAJY8ebCVZCfhJYiHlW4L1p4mCQX33QG8ZAwZAeRwXnxFHFymE9bKOm8j8LWuOXdZBhAnUfTymEXMvm6P3hn2fXf2ZABdSgtvz1DJjklblOnAXtbhVlu2x6o3IErEvj67ELZCLQ3ROOn6ZAYCuaTgtDiwt6baZAyPaa43Hrb60dDxCfDNGiAnRQdr9tmDNBewsQZDZD",false);

//  print_r(json_decode($data));
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
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
                    url:'https://graph.facebook.com/144759862206977/feed?fields=id,picture,created_time,admin_creator,full_picture,is_instagram_eligible,is_popular,is_eligible_for_promotion,is_spherical,message,message_tags,multi_share_end_card,multi_share_optimized,parent_id,place,privacy,promotable_id,promotion_status,properties,scheduled_publish_time,shares,status_type,likes.summary(1).limit(0),comments.summary(1).limit(0),story,story_tags,subscribed,target,targeting,timeline_visibility,updated_time,via,video_buying_eligibility,width,attachments{media,media_type,url,description,description_tags,subattachments,unshimmed_url,title,target{id}}&limit=10&access_token=EAABZCwDdoWC8BAC1a6T4zKG3FMgZCN39jsVKfkQWgaf6GOAy0Grgqt38wD07kMj6nZAN5ioD8jPSju0BZBPAyXssLI7qlcXDS846d0h2Xj4UJ8DpJCMiGKpSk9iZCUwYkrO9ojk0ML1HKppqPckeepAqQBgPEgkGKzvjP7byMoQZDZD',
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
                      if(typeof dataSet[1].data[9].attachments && dataSet[1].data[9].attachments.data[0].media_type=="video"){
                        mediaSource="";
                          $.ajax({
                             type:"GET",
                             async:false,
                             url:"https://graph.facebook.com/"+dataSet[1].data[9].attachments.data[0].target.id+"?fields=embed_html,source&access_token=EAABZCwDdoWC8BAC1a6T4zKG3FMgZCN39jsVKfkQWgaf6GOAy0Grgqt38wD07kMj6nZAN5ioD8jPSju0BZBPAyXssLI7qlcXDS846d0h2Xj4UJ8DpJCMiGKpSk9iZCUwYkrO9ojk0ML1HKppqPckeepAqQBgPEgkGKzvjP7byMoQZDZD",
                             success:function(data){
                               // console.log(data);
                               mediaSource=data.embed_html;
                             }
                          })
                           console.log(mediaSource);
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
                                   <div class="user-name"><p>${dataSet[0].global_brand_page_name}
                                   <span>${dataSet[0].username}</span></p>
                                   <span class="created-time">${created_time}</span>  
                               </div>
                            </div>
                    <div class="message">
                      <p>${dataSet[1].data[0].message}</p>
                    </div> 
                   <div class="links">
                      <a href="${targetUrl}" class="" target="_blank">Like-</a>
                       <span class="like-count">${dataSet[1].data[0].likes.summary.total_count}</span> 
                      <a href="${targetUrl}" class="" target="_blank">comments-</a>
                       <span class="comments-count">${dataSet[1].data[0].comments.summary.total_count}</span> 
                       <a href="${targetUrl}" class="" target="_blank">share-</a> 
                      <span class="share-count">${dataSet[1].data[0].shares.count}</span> 
                   </div>          
                    `;  

                     $(".thumbnail").html(feeds);

                    }
                  }) 
       }
    })



  		
  	})
  	
  </script>
<body>
 <div class="thumbnail">
      
 </div>
</body>
</html>