<?php
add_action('init','svc_social_register_style_script');
function svc_social_register_style_script(){
	wp_register_style( 'svc-social-animate-css', plugins_url('../assets/css/animate.css', __FILE__));	
	wp_enqueue_style( 'vcyt-font-awesome-css', plugins_url('../assets/css/font-awesome.min.css', __FILE__));
	wp_register_style( 'vcyt-bootstrap-css', plugins_url('../assets/css/bootstrap.css', __FILE__));
	wp_register_style( 'svc-megnific-css', plugins_url('../assets/css/magnific-popup.css', __FILE__));
	
	wp_enqueue_script('moment-locale-js', plugins_url('../assets/js/moment-with-locales.min.js', __FILE__), array("jquery"), false, false);
	wp_register_script('svc-megnific-js', plugins_url('../assets/js/megnific.js', __FILE__), array("jquery"), false, false);	
	wp_enqueue_script('svc-isotop-js', plugins_url('../assets/js/isotope.pkgd.min.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('svc-imagesloaded-js', plugins_url('../assets/js/imagesloaded.pkgd.min.js', __FILE__), array("jquery"), false, false);
	wp_register_script('svc-carousel-js', plugins_url('../assets/js/owl.carousel.min.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('viewportchecker-js', plugins_url('../assets/js/jquery.viewportchecker.js', __FILE__), array("jquery"), false, false);
	//wp_enqueue_script('codebird-js', plugins_url('../assets/js/codebird.js', __FILE__), array("jquery"), false, false);
	wp_enqueue_script('doT-js', plugins_url('../assets/js/doT.min.js', __FILE__), array("jquery"), false, false);	
	wp_enqueue_script('social-stream-js', plugins_url('../assets/js/social-stream.js', __FILE__), array("jquery"), false, false);
	wp_localize_script('social-stream-js', 'svc_ajax_url', array('url' => admin_url( 'admin-ajax.php' ),'laungage' => get_locale()));
}
add_action('wp_head','svc_social_inline_css_for_imageloaded');
function svc_social_inline_css_for_imageloaded(){
	?>
    <style>
	.svc_social_stream_container{ display:none;}
	#loader {background-image: url("<?php echo plugins_url('../addons/social-stream/css/loader.GIF',__FILE__);?>");}
	</style>
    <?php	
}

add_action('wp_ajax_svc_get_tweet','svc_get_tweet');
add_action('wp_ajax_nopriv_svc_get_tweet','svc_get_tweet');
function svc_get_tweet(){
	require_once('twitter_proxy.php');
	extract($_POST);
	//echo "<pre>";print_r($_POST);
	// Twitter OAuth Config options
	$oauth_access_token = '531871187-jA1LUzuKOBMYy9FTHNS8Lrq3tHFtGQxCMeJMdjwY';
	$oauth_access_token_secret = '3qQgkYWzexuLoGKMnFpIoh3MZ5UEPmiRvysBBgEDIqLBn';
	$consumer_key = 'UaXiG364zfkqhkkK6ckFSRtoy';
	$consumer_secret = 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V';
	$user_id = '78884300';
	$screen_name = $user_name;
	$count = $limit;
	
	$twitter_url = 'statuses/user_timeline.json';
	$twitter_url .= '?user_id=' . $user_id;
	$twitter_url .= '&screen_name=' . $screen_name;
	$twitter_url .= '&count=' . $count;
	if($max_id != ''){
		$twitter_url .= '&max_id=' . $max_id;
	}
	
	// Create a Twitter Proxy object from our twitter_proxy.php class
	$twitter_proxy = new TwitterProxy(
		$oauth_access_token,			// 'Access token' on https://apps.twitter.com
		$oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
		$consumer_key,					// 'API key' on https://apps.twitter.com
		$consumer_secret,				// 'API secret' on https://apps.twitter.com
		$user_id,						// User id (http://gettwitterid.com/)
		$screen_name,					// Twitter handle
		$count							// The number of tweets to pull out
	);
	
	// Invoke the get method to retrieve results via a cURL request
	$tweets = $twitter_proxy->get($twitter_url);
	
	echo $tweets;
wp_die();
}

add_action('wp_ajax_svc_get_search_tweet','svc_get_search_tweet');
add_action('wp_ajax_nopriv_svc_get_search_tweet','svc_get_search_tweet');
function svc_get_search_tweet(){
	require_once('twitter_proxy.php');
	extract($_POST);
	//echo "<pre>";print_r($_POST);
	// Twitter OAuth Config options
	$oauth_access_token = '531871187-jA1LUzuKOBMYy9FTHNS8Lrq3tHFtGQxCMeJMdjwY';
	$oauth_access_token_secret = '3qQgkYWzexuLoGKMnFpIoh3MZ5UEPmiRvysBBgEDIqLBn';
	$consumer_key = 'UaXiG364zfkqhkkK6ckFSRtoy';
	$consumer_secret = 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V';
	$user_id = '78884300';
	$screen_name = $user_name;
	$count = $limit;
	
	$twitter_url = 'search/tweets.json';
	if($other == 'yes'){
		$twitter_url .= '?q=' . $q;
		$twitter_url .= '&count=' . $limit;
		$twitter_url .= '&' . $que;
		$twitter_url .= '&include_entities' . $include_entities;
	}else{
		$twitter_url .= '?q=' . $q;
		$twitter_url .= '&count=' . $count;
	}
	
	// Create a Twitter Proxy object from our twitter_proxy.php class
	$twitter_proxy = new TwitterProxy(
		$oauth_access_token,			// 'Access token' on https://apps.twitter.com
		$oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
		$consumer_key,					// 'API key' on https://apps.twitter.com
		$consumer_secret,				// 'API secret' on https://apps.twitter.com
		$user_id,						// User id (http://gettwitterid.com/)
		$screen_name,					// Twitter handle
		$count							// The number of tweets to pull out
	);
	
	// Invoke the get method to retrieve results via a cURL request
	$tweets = $twitter_proxy->get($twitter_url);
	
	echo $tweets;
die();		
}

add_action('wp_ajax_nopriv_svc_inline_social_popup','svc_inline_social_popup');
add_action('wp_ajax_svc_inline_social_popup','svc_inline_social_popup');
function svc_inline_social_popup(){
	
	if($_GET['network'] == 'twitter'){?>
		<div class="svc_tweet_conatiner">
		<style type="text/css">
		.svc_tweet_conatiner{ max-width:500px; background:#f5f8fa;margin:0 auto 15px;border-radius: 6px;}
		.tweet_img_video{ text-align: center; line-height: 0;}
		.tweet_img_video img{ max-width: 100%; width:100%;border-radius: 6px 6px 0 0;}
		.tweet_content{padding: 15px;}
		.tweet_title{ font-size: 17px; color: #333; display:inline-block;line-height: 1.4em;}
		.tweet_title a {color: #8899a6;font-size: 13px;}
		.tweet_message{ margin-top: 3px;margin-bottom:7px; }
		.tweet_tags a{ font-size: 14px; color: #aaa; float: left; margin-right: 5px; }
		.tweet_notes{width:100%; display:inline-block; margin-top:10px;}
		.tweet_notes div{ font-weight: bold; color: #949494; float:left; font-size:15px; margin-right:15px; }
		.twit_profile_img{ float:left;margin-right: 12px;border-radius: 4px;}
		</style>
			<div class="tweet_img_video">
			<?php if($_GET['image_url']){?>
				<img src="<?php echo $_GET['image_url'];//$tweet->entities->media[0]->media_url;?>">
			<?php }?>
			</div>
			<div class="tweet_content">
				<img src="<?php echo $_GET['authore_img'];?>" class="twit_profile_img"><div class="tweet_title"><?php echo $_GET['authore_name'];?> <a href="https://twitter.com/<?php echo $_GET['username'];?>" target="_blank">@<?php echo $_GET['username'];?></a></div>
				<div class="tweet_message"><?php echo $_GET['msg'];?></div>
				<div class="tweet_notes">
					<div><i class="fa fa-retweet" aria-hidden="true"></i> <?php echo $_GET['retweet'];?></div>
					<div><i class="fa fa-heart" aria-hidden="true"></i> <?php echo $_GET['like'];?></div>
				</div>
			</div>
		</div>
	
	<?php }
	
	if($_GET['network'] == 'vimeo'){?>
		<style>
		.svc_vimeo_popup {
			margin: 20px auto;
			max-width: 850px;
			position: relative;
			width: 100%;
			background: #333;
			display: -webkit-flex;
			display: flex;
			background:#fff;
		}
		.svc_vimeo_popup > div{ width:100%;}
		.vimeo-main-container,.vimeo-panel-details{ padding:15px;border: 0;background: #fff;-moz-box-sizing: border-box;box-sizing: border-box;}
		.vimeo-watch-title{ font-size:23px; display:block; margin-bottom:10px;}
		.vimeo-profile-container{ display:inline-block;padding-bottom: 15px; width:100%;position: relative;}
		.vimeo-profile-container > span{ display:table-row;font-size: 14px;}
		.vimeo_profile_img{ width:48px; float:left; margin-right:10px;border-radius: 100%;}
		.vimeo-suscriber_div {
			margin-top: 4px;
		}
		.vimeo-suscriber_div div {
			background: #e62117;
			color: #fff;
			font-size: 13px;
			padding: 3px 6px;
			float: left;
			margin-right: 7px;
		}
		.vimeo-suscriber_div small{
			background: #e62117;
			color: #fff;
			font-size: 13px;
			padding: 2px 6px;
		}
		.vimeo-suscriber_div span{
		    border: 1px solid #ccc;
		    padding: 1px 5px;
			font-size: 13px;
		    background: #f2f2f2;
		}
		.vimeo_view_count {
			position: absolute;
			right: 0;
			font-size: 25px;
			bottom: -1px;
			border-bottom: 2px solid #167ac6;
		}
		.vimeo_publish_date {
			color: #222;
			font-weight: bold;
			font-size: 14px;
			margin-bottom: 5px;
		}
		.vimeo_comments{
			padding:0 0 0 15px;
		}
		.vimeo_comments span{
			width:100%;
			display:inline-block;
			padding: 8px 8px 8px 0;
			box-sizing: border-box;
		}
		.vimeo_comments_inner{
			overflow-y: auto;
			max-height: 380px;
			margin:10px 0 0;
		}
		.vimeo_comments_inner span img{
			float: left;
			margin-right: 10px;
			max-width: 45px;
			border-radius: 2px;
		}
		.vimeo_comments_inner span a {
			font-weight:bold;
		}
		.vimeo_comments_inner span {
			margin: 0 0 6px;
			font-size: 12px;
			line-height: 16px;
			color: #333;
			margin-bottom: 15px;
			display: inline-block;
			width:100%;
		}
		.vimeo_comment_a{ font-size:13px; margin-right:4px;}
		.vimeo_comment_text{ font-size:16px;margin-top: 25px;margin-bottom: 20px;}
		.vimeo_comment_content{ margin-top:5px; font-size:13px; color:#222;}
		.vimeo_profile_data{ font-size:15px;}
		.vimeo-panel-details { background:#F4F6F6 !important;background: #F4F6F6;border-bottom: 1px solid #D0D8DB;border-top: 1px solid #D0D8DB;position: relative;}
		.vimeo_like_dislike {padding: 10px 0;font-size: 16px;display: inline-block; width:100%;}
		.vimeo_up {float: left;margin-right: 10px;}
		.you-desc-panel-height-css{}
		.you-desc-panel-height{max-height: 110px;overflow: hidden;}
		.you-desc-hide-show {
			padding-top: 8px;
			font-size: 13px;
			cursor: pointer;
			margin-bottom: 15px;
			padding-bottom: 5px;
			padding-left: 15px;
			font-weight: bold;
			border-bottom: 1px solid #D0D8DB;
			background: #F4F6F6;
		}
		</style>
		<?php		
		
		$api_url1 = 'https://api.vimeo.com/users/'.$_GET['userid'].'/videos/'.$_GET['videoId'].'?access_token=73e23e410b2fe14504a59ff863c2eeae';
		$api_url2 =  'https://api.vimeo.com/videos/'.$_GET['videoId'].'/comments?per_page=25&access_token=73e23e410b2fe14504a59ff863c2eeae';
		
		$response1=json_decode(file_get_contents($api_url1));
		$snippet = $response1;
		//$statistics = $response1->items[0]->statistics;	
		
		$response2=json_decode(file_get_contents($api_url2));
		$snippet_comment = $response2->data;	
		$feed_url = 'https://vimeo.com/'.$_GET['videoId'];
		?>
		<div class="svc_vimeo_popup">
			<div>
				<iframe class="mfp-iframe" src="//player.vimeo.com/video/<?php echo $_GET['videoId'];?>?autoplay=0" frameborder="0" allowfullscreen=""></iframe>
				
				<div class="vimeo-watch-header vimeo-main-container">
					<div class="clearfix">
				      <div class="vimeo-watch-title"><?php echo $snippet->name;?></div>
					  <div class="vimeo-profile-container">
					  	<img src="<?php echo $_GET['profileImg'];?>" class="vimeo_profile_img"/>
						<div class="vimeo_profile_data"><strong><?php echo $_GET['from'];?></strong>  <div class="vimeo_publish_date"><?php echo time_elapsed_string(strtotime($snippet->created_time));?></div></div>
					  </div>				  
					</div>
				</div>
				
				<div class="vimeo-panel-details you-panel-details you-desc-panel-height you-desc-panel-height-css">
					<div class="svc_share">                            
						<i class="fa fa-share-alt"></i>
						<div class="svc_share-box full-color">
						  <ul class="s8-social" style="padding-left: 1em; text-indent: -1em;">
							<li class="facebook">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $feed_url;?>" target="_blank" title="">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li class="google">
								<a href="https://plusone.google.com/share?url=<?php echo $feed_url;?>" target="_blank" title="">
									<i class="fa fa-google-plus"></i>
								</a>
							</li>
							<li class="twitter">
								<a href="https://twitter.com/intent/tweet?text=&amp;url=<?php echo $feed_url;?>" target="_blank" title="">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
						  </ul>
						</div>
					</div>
					<div class="vimeo_like_dislike_container">
						<div class="vimeo_like_dislike">
							<div class="vimeo_up"><i class="fa fa-play"></i> <?php echo number_format($snippet->stats->plays);?></div>
							<div class="vimeo_up"><i class="fa fa-heart"></i> <?php echo number_format($snippet->metadata->connections->likes->total);?></div>
						</div>
					</div>
					<div class="vimeo_description"><?php echo nl2br(social_convertHashtags($snippet->description,'vimeo'));?></div>
				</div>
                <div class="you-desc-hide-show vimeo-show-more"><?php _e('Read More...','svc_social_feed');?></div>
				
				<div class="vimeo-comment-details">
					<?php $comm_count = count($snippet_comment);
					if($comm_count > 0){?>
					<div class="vimeo_comments">
						<?php $comments = $snippet_comment;?>
						<div class="vimeo_comment_text">COMMENTS</div>
						<div class="vimeo_comments_inner">
						<?php for($i=0;$i<$comm_count;$i++){?>
						<div>
							<span><img src="<?php echo $comments[$i]->user->pictures->sizes[1]->link;?>" /><a href="https://vimeo.com<?php echo $comments[$i]->user->uri;?>" target="_blank" class="vimeo_comment_a"><?php echo $comments[$i]->user->name;?></a> <?php echo time_elapsed_string(strtotime($comments[$i]->created_on));?><div class="vimeo_comment_content"><?php echo $comments[$i]->text;?></div></span>
						</div>
						<?php }?>
						</div>
					</div>
					<?php }?>
				</div>
				
			</div>
		</div>
	
	<?php }
	
	if($_GET['network'] == 'tumblr'){
		$api_url = 'https://api.tumblr.com/v2/blog/'.$_GET['blog_name'].'/posts/photo?id='.$_GET['id'].'&api_key=fuiKNFp9vQFvjLNvx4sUwti4Yb5yGutBN4Xh10LXZhhRKjWlV4';
	    $response = json_decode( file_get_contents($api_url) );

		$res1 = $response->response->posts[0];
		$type = $res1->type;
		if($type == 'photo'){
        	$photo = $response->response->posts[0]->photos[0]->original_size->url;
    	}
		if($type == 'video'){
			$video_url = $response->response->posts[0]->video_url;
			$poster = $response->response->posts[0]->thumbnail_url;
		}
    	?>
		<style type="text/css">
		.svc_tumblr_conatiner{ max-width:500px; background:#fff; border:1px solid #ccc; padding: 15px; margin:0 auto 15px;}
		.tumblr_img_video{ text-align: center; }
		.tumblr_img_video img{ max-width: 100%;}
		.tumblr_img_video video{ max-width: 100%; }
		.tumb_content{ padding: 15px 0; }
		.tumb_title{ font-size: 18px; color: #333; }
		.tumb_tags{ margin-top: 10px; display: inline-block; width: 100%; margin-bottom:7px; }
		.tumb_tags a{ font-size: 14px; color: #aaa; float: left; margin-right: 5px; }
		.tumb_notes{ font-weight: bold; color: #aaa; }
		</style>
		<div class="svc_tumblr_conatiner">
			<div class="tumblr_img_video">
			<?php if($type == 'photo'){?>
				<img src="<?php echo $photo;?>">
			<?php }
			if($type == 'video'){?>
				<video width="100%" poster="<?php echo $poster;?>" controls>
				  <source src="<?php echo $video_url;?>" type="video/mp4">
				</video>
			<?php }?>
			</div>
			<div class="tumb_content">
				<div class="tumb_title"><?php echo $res1->caption;?></div>
				<?php $tags = $res1->tags;            
				$tag_count = count($res1->tags);
				if($tag_count > 0 && is_array($tags)){?>
					<div class="tumb_tags">
					<?php for($i = 0;$i<$tag_count;$i++){?>
						<a href="https://www.tumblr.com/tagged/<?php echo 
	$tags[$i];?>" target="_blank"><?php echo $tags[$i];?></a>
					<?php }?>
					</div>
				<?php }?>
				<div class="tumb_notes">
					<?php echo $res1->note_count;?> Notes
				</div>
			</div>
		</div>
	<?php }
	
	if($_GET['network'] == 'youtube'){?>
		<style>
		.svc_youtube_popup {
			margin: 20px auto;
			max-width: 900px;
			position: relative;
			width: 100%;
			background: #333;
			display: -webkit-flex;
			display: flex;
			background:#fff;
		}
		.svc_youtube_popup > div{ width:100%;}
		.youtube-main-container,.you-panel-details{ padding:15px;margin: 0 0 10px;border: 0;background: #fff;box-shadow: 0 1px 2px rgba(0,0,0,.1);-moz-box-sizing: border-box;box-sizing: border-box;}
		.you-watch-title{ font-size:20px; display:block; margin-bottom:10px;}
		.you-profile-container{ display:inline-block;border-bottom: 1px solid #ccc;padding-bottom: 15px; width:100%;position: relative;}
		.you-profile-container > span{ display:table-row;font-size: 14px;}
		.you_profile_img{ width:48px; float:left; margin-right:10px;}
		.you-suscriber_div {
			margin-top: 4px;
		}
		.you-suscriber_div div {
			background: #e62117;
			color: #fff;
			font-size: 13px;
			padding: 3px 6px;
			float: left;
			margin-right: 7px;
		}
		.you-suscriber_div small{
			background: #e62117;
			color: #fff;
			font-size: 13px;
			padding: 2px 6px;
		}
		.you-suscriber_div span{
		    border: 1px solid #ccc;
		    padding: 1px 5px;
			font-size: 13px;
		    background: #f2f2f2;
		}
		.you_view_count {
			position: absolute;
			right: 0;
			font-size: 25px;
			bottom: -1px;
			border-bottom: 2px solid #167ac6;
		}
		.you_view_count span{ font-size:18px;}
		.you_like_dislike > div {
			display: inline-block;
			margin-right: 14px;
		}
		.you_like_dislike_container{
			display: inline-block;
			width: 100%;
			padding: 10px 10px 0 10px;
			box-sizing: border-box;
		}
		.you_like_dislike {
			color: #807e7e;
			font-size: 14px;
			float: right;
		}
		.you_like_dislike i{ font-size:20px; margin-right:3px;}
		.you_publish_date {
			color: #222;
			font-weight: bold;
			font-size: 14px;
			margin-bottom: 5px;
		}
		.you_comments{
			padding:0 0 0 15px;
		}
		.you_comments span{
			width:100%;
			display:inline-block;
			padding: 8px 8px 8px 0;
			box-sizing: border-box;
		}
		.you_comments_inner{
			overflow-y: auto;
			height: 380px;
			max-height: 100%;
			margin:10px 0 0;
		}
		.you_comments_inner span img{
			float: left;
			margin-right: 10px;
			max-width: 45px;
			border-radius: 2px;
		}
		.you_comments_inner span a {
			font-weight:bold;
		}
		.you_comments_inner span {
			margin: 0 0 6px;
			font-size: 12px;
			line-height: 16px;
			color: #333;
			margin-bottom: 15px;
			display: inline-block;
			width:100%;
		}
		.you_comment_a{ font-size:13px; margin-right:4px;}
		.you_comment_text{ font-size:16px;}
		.you_comment_content{ margin-top:5px; font-size:13px; color:#222;}
		.you-desc-panel-height-css{margin:-14px 0 1px 0;border-top: 1px solid #e6e3e3; position:relative;}
		.you-desc-panel-height{max-height: 110px;overflow: hidden;}
		.you-desc-hide-show {
			text-align: center;
			box-shadow: 1px -1px 2px rgba(0,0,0,.1);
			-moz-box-sizing: border-box;
			padding-top: 5px;
			font-size: 11px;
			cursor: pointer;
			margin-bottom: 15px;
			border-bottom: 1px solid #f2f2f2;
    		padding-bottom: 5px;
		}
		</style>
		<?php
		$api_url1 = 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails%2Cstatistics%2Csnippet&id='.$_GET['videoId'].'&key=AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4';
		$api_url2 = 'https://www.googleapis.com/youtube/v3/commentThreads?part=id%2Csnippet&videoId='.$_GET['videoId'].'&key=AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4';
		
		$response1=json_decode(file_get_contents($api_url1));
		$snippet = $response1->items[0]->snippet;
		$statistics = $response1->items[0]->statistics;
		
		$api_url3 = 'https://www.googleapis.com/youtube/v3/channels?part=brandingSettings,snippet,statistics,contentDetails&id='.$snippet->channelId.'&key=AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4';		
		
		$response2=json_decode(file_get_contents($api_url2));
		$snippet_comment = $response2->items;
		//$statistics_comment = $response2->items[0]->statistics;
		//echo "<pre>";print_r($snippet_comment);echo "</pre>";die;
		
		$response3=json_decode(file_get_contents($api_url3));
		$snippet_channel = $response3->items[0]->snippet;
		$statistics_channel = $response3->items[0]->statistics;		
		?>
		<div class="svc_youtube_popup">
			<div>
				<iframe class="mfp-iframe" src="//www.youtube.com/embed/<?php echo $_GET['videoId'];?>?rel=0&amp;autoplay=0" frameborder="0" allowfullscreen=""></iframe>
				
				<div class="youtube-watch-header youtube-main-container">
					<div class="clearfix">
				      <div class="you-watch-title"><?php echo $snippet->title;?></div>
					  <div class="you-profile-container">
					  	<img src="<?php echo $snippet_channel->thumbnails->default->url;?>" class="you_profile_img"/>
						<span><?php echo $snippet_channel->title;?></span>
						<span><div class="you-suscriber_div"><small><i class="fa fa-youtube-play"></i> subscriber</small><span><?php echo number_format($statistics_channel->subscriberCount);?></span></div></span>
						<div class="you_view_count"><?php echo number_format($statistics->viewCount);?> <span>views</span></div>
					  </div>
					  <div class="you_like_dislike_container">
					  		<div class="you_like_dislike">
								<div class="you_up"><i class="fa fa-thumbs-up"></i><?php echo number_format($statistics->likeCount);?></div>
								<div class="you_down"><i class="fa fa-thumbs-down"></i><?php echo number_format($statistics->dislikeCount);?></div>
							</div>
					  </div>				  
					</div>
				</div>
				
				<div class="you-panel-details you-desc-panel-height you-desc-panel-height-css">
					<div class="you_publish_date"><?php _e('Published on','svc_social_feed');?> <?php echo date('M d,Y',strtotime($snippet->publishedAt));?></div>
					<div class="you_description"><?php echo nl2br(social_convertHashtags($snippet->description,'youtube'));?></div>
				</div>
                <div class="you-desc-hide-show" show-more="<?php _e('SHOW MORE','svc_social_feed');?>" show-less="<?php _e('SHOW LESS','svc_social_feed');?>"><?php _e('SHOW MORE','svc_social_feed');?></div>
				
				<div class="you-comment-details">
					<?php $comm_count = count($snippet_comment);
					if($comm_count > 0){?>
					<div class="you_comments">
						<?php $comments = $snippet_comment;?>
						<div class="you_comment_text">COMMENTS</div>
						<div class="you_comments_inner">
						<?php for($i=0;$i<$comm_count;$i++){?>
						<div>
							<span><img src="<?php echo $comments[$i]->snippet->topLevelComment->snippet->authorProfileImageUrl;?>" /><a href="<?php echo $comments[$i]->snippet->topLevelComment->snippet->authorChannelUrl;?>" target="_blank" class="you_comment_a"><?php echo $comments[$i]->snippet->topLevelComment->snippet->authorDisplayName;?></a> <?php echo time_elapsed_string(strtotime($comments[$i]->snippet->topLevelComment->snippet->publishedAt));?><div class="you_comment_content"><?php echo $comments[$i]->snippet->topLevelComment->snippet->textDisplay;?></div></span>
						</div>
						<?php }?>
						</div>
					</div>
					<?php }?>
				</div>
				
			</div>
		</div>
		<?php
	}
	
	if($_GET['network'] == 'facebook'){
		if($_GET['fb_type'] == 'photo'){
			$api_url1 = 'https://graph.facebook.com/'.$_GET["facebook_id"].'?access_token=939642459399515|GT91tLv3rE7vCXn9UNP1tHsHZSA&fields=images,from,link,created_time,icon,id';
		}elseif($_GET['fb_type'] == 'link'){
			$api_url1 = 'https://graph.facebook.com/'.$_GET["facebook_id"].'?access_token=939642459399515|GT91tLv3rE7vCXn9UNP1tHsHZSA&fields=from,link,created_time,icon,id';
		}else{
			$api_url1 = 'https://graph.facebook.com/'.$_GET["facebook_id"].'?access_token=939642459399515|GT91tLv3rE7vCXn9UNP1tHsHZSA&fields=created_time,icon,from,embed_html';
		}
		$api_url2 = 'https://graph.facebook.com/'.$_GET["facebook_id"].'/likes?limit=1&access_token=939642459399515|GT91tLv3rE7vCXn9UNP1tHsHZSA&summary=1';
		
		$api_url3 = 'https://graph.facebook.com/'.$_GET["facebook_id"].'/comments?access_token=939642459399515|GT91tLv3rE7vCXn9UNP1tHsHZSA&summary=1';
		
		$response1=json_decode(file_get_contents($api_url1));
		$response2=json_decode(file_get_contents($api_url2));
		$response3=json_decode(file_get_contents($api_url3));
		
		if($_GET['fb_type'] == 'photo' || $_GET['fb_type'] == 'link'){
			$feed_url = $response1->link;
		}else{
			$feed_url = 'https://www.facebook.com'.$response1->permalink_url.'/';
		}
		//$response = wp_remote_get( $url );?>
			<div class="svc_facebok_popup">
            <style type="text/css">
			@media screen and (min-width:769px){.svc_facebok_popup .pos_relative{ min-height:550px;}}
			@media screen and (max-width:768px) and (min-width:760px){.svc_facebok_popup .pos_relative{ min-height:400px;}}
			@media screen and (max-width:759px) and (min-width:550px){.svc_facebok_popup .vcfti-col-md-8{ min-height:270px;}}
			@media screen and (max-width:549px) and (min-width:10px){.svc_facebok_popup .vcfti-col-md-8{ min-height:150px;}}
			.fb_comments_inner{ min-height:358px !important;}
			</style>
			<div>
				<div class="vcyt-col-md-8 vcyt-col-sm-6" style="line-height:0;text-align: center;">
					<?php 
					if($_GET['fb_type'] == 'photo'){?>
					<a href="<?php echo $feed_url;?>" target="_blank"><img src="<?php echo $response1->images[1]->source;?>" class="fb_popup_img"/></a>
					<?php }elseif($_GET['fb_type'] == 'link'){
						if(strpos($_GET['img'], 'safe_image.php')){
							$fb_img_link = $_GET['url'];
						}else{
							if($_GET['oe']){
								$fb_img_link = $_GET['img'].'&oe='.$_GET['oe'];
							}else{
								$fb_img_link = $_GET['img'];
							}
						}?>
					<a href="<?php echo $feed_url;?>" target="_blank"><img src="<?php echo $fb_img_link;?>" class="fb_popup_img"/></a>
					<?php }else{
						echo $response1->embed_html;
					}?>
				</div>
				<div class="vcyt-col-md-4 vcyt-col-sm-6 pos_relative">
				<div class="svc_link">                            
					<a href="<?php echo $feed_url;?>" target="_blank"><i class="fa fa-link"></i></a>
				</div>
				<div class="svc_share">                            
					<i class="fa fa-share-alt"></i>
					<div class="svc_share-box full-color">
					  <ul class="s8-social" style="padding-left: 1em; text-indent: -1em;">
						<li class="facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $feed_url;?>" target="_blank" title="">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li class="google">
							<a href="https://plusone.google.com/share?url=<?php echo $feed_url;?>" target="_blank" title="">
								<i class="fa fa-google-plus"></i>
							</a>
						</li>
						<li class="twitter">
							<a href="https://twitter.com/intent/tweet?text=&amp;url=<?php echo $feed_url;?>" target="_blank" title="">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					  </ul>
					</div>
				</div>
				<div class="fb_popup_content">
					<div class="fb_popup_header">
						<a href="javascript:;" class="fb_profile_img" target="_blank"><img src="https://graph.facebook.com/<?php echo $response1->from->id;?>/picture" /></a>
						<a href="javascript:;" class="fb_profile_name" target="_blank"><?php echo $response1->from->name;?></a>
					</div>
					<hr class="fb_hr"/>
					<div class="fb_like_date">
						<div class="fb_likes"><i class="fa fa-thumbs-o-up"></i>&nbsp;<?php echo insta_like_counter($response2->summary->total_count);?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments-o"></i>&nbsp;<?php echo insta_like_counter($response3->summary->total_count);?></div>
						<div class="fb_date"><?php echo time_elapsed_string(strtotime($response1->created_time));?></div>
					</div>
					<div class="fb_caption">
						<?php if($_GET['story'] != 'undefined'){
							echo $_GET['story'];
						}?>
					</div>
					</div>
					<?php $comm_count = count($response3->data);
					if($comm_count > 0){?>
					<div class="fb_comments">
						<?php $comments = $response3->data;
						//echo "<pre>";print_r($comments);echo "</pre>";?>
						<span><?php echo $_GET['share'].' shares';?><div class="pull_right"><?php echo insta_like_counter($response3->summary->total_count);?> Comments</div></span>
						<div class="fb_comments_inner">
						<?php for($i=0;$i<$comm_count;$i++){?>
						<p><img src="https://graph.facebook.com/<?php echo $comments[$i]->from->id;?>/picture" /><a href="javascript:;" target="_blank"><?php echo $comments[$i]->from->name;?></a> <?php echo $comments[$i]->message;?></p>
						<?php }?>
						</div>
					</div>
					<?php }?>
				</div>
				</div>
			<?php
			//print_r($response->html);?>
			</div>
			<?php
		}
	//https://www.instagram.com/p/BGdb59ruuRd/?taken-by=alexstrohl&__a=1
	if($_GET['network'] == 'instagram'){
		$url = $_GET['url'].'?taken-by=alexstrohl&__a=1';
		$response=json_decode(file_get_contents($url));
		$media = $response->graphql->shortcode_media;
		$feed_url = 'https://www.instagram.com/p/'.$media->shortcode.'/';
		//$response = wp_remote_get( $url );?>
			<div class="svc_instagram_popup">
			<div>
				<div class="vcyt-col-md-7 vcyt-col-sm-6" style="line-height:0">
					<?php if($media->is_video){?>
					<iframe frameborder="0" allowfullscreen="" class="mfp-iframe" src="<?php echo $media->video_url;?>"></iframe>
					<?php }else{?>
					<a href="<?php echo $feed_url;?>" target="_blank"><img src="<?php echo $media->display_url?>" class="insta_popup_img"/></a>
					<?php }?>
				</div>
				<div class="vcyt-col-md-5 vcyt-col-sm-6 pos_relative">
				<div class="svc_link">                            
					<a href="<?php echo $feed_url;?>" target="_blank"><i class="fa fa-link"></i></a>
				</div>
				<div class="svc_share">                            
					<i class="fa fa-share-alt"></i>
					<div class="svc_share-box full-color">
					  <ul class="s8-social" style="padding-left: 1em; text-indent: -1em;">
						<li class="facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $feed_url;?>" target="_blank" title="">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li class="google">
							<a href="https://plusone.google.com/share?url=<?php echo $feed_url;?>" target="_blank" title="">
								<i class="fa fa-google-plus"></i>
							</a>
						</li>
						<li class="twitter">
							<a href="https://twitter.com/intent/tweet?text=&amp;url=<?php echo $feed_url;?>" target="_blank" title="">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					  </ul>
					</div>
				</div>
				<div class="insta_popup_content">
					<div class="insta_popup_header">
						<a href="https://www.instagram.com/<?php echo $media->owner->username;?>/" class="insta_profile_img" target="_blank"><img src="<?php echo $media->owner->profile_pic_url?>" /></a>
						<a href="https://www.instagram.com/<?php echo $media->owner->username;?>/" class="insta_profile_name" target="_blank"><?php echo $media->owner->full_name;?></a>
					</div>
					<hr class="insta_hr"/>
					<div class="insta_like_date">
						<div class="insta_likes"><i class="fa fa-heart-o"></i>&nbsp;<?php echo insta_like_counter($media->edge_media_preview_like->count);?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments-o"></i>&nbsp;<?php echo insta_like_counter($media->edge_media_to_comment->count);?></div>
						<div class="insta_date"><?php echo time_elapsed_string($media->taken_at_timestamp);?></div>
					</div>
					<div class="insta_caption">
						<?php $len_caption = strlen($media->edge_media_to_caption->edges[0]->node->text);
						if($len_caption > 350){
							echo substr($media->edge_media_to_caption->edges[0]->node->text,0,350).'...';
						}else{
							echo $media->edge_media_to_caption->edges[0]->node->text;
						}?>
					</div>
					</div>
					<?php $comm_count = count($media->edge_media_to_comment->edges);
					if($comm_count > 0){?>
					<div class="insta_comments">
						<?php $comments = $media->edge_media_to_comment->edges;?>
						<span>Comments</span>
						<div class="insta_comments_inner">
						<?php for($i=0;$i<$comm_count;$i++){?>
						<p><a href="https://www.instagram.com/<?php echo $comments[$i]->node->owner->username;?>" target="_blank"><?php echo $comments[$i]->node->owner->username;?></a> <?php echo $comments[$i]->node->text;?></p>
						<?php }?>

						</div>
					</div>
					<?php }?>
				</div>
				</div>
			<?php
			//print_r($response->html);?>
			</div>
			<?php
		}
	die();
}


if(!function_exists('insta_like_counter')){
	function insta_like_counter($value){
		if ($value > 999 && $value <= 999999) {
			$result = floor($value / 1000) . 'k';
		} elseif ($value > 999999) {
			$result = floor($value / 1000000) . 'M';
		} else {
			$result = $value;
		}
		return $result;
	}
}

if(!function_exists('time_elapsed_string')){
	function time_elapsed_string($ptime){
		$etime = time() - $ptime;
	
		if ($etime < 1)
		{
			return '0 seconds';
		}
	
		$a = array( 365 * 24 * 60 * 60  =>  'year',
					 30 * 24 * 60 * 60  =>  'month',
						  24 * 60 * 60  =>  'day',
							   60 * 60  =>  'hour',
									60  =>  'minute',
									 1  =>  'second'
					);
		$a_plural = array( 'year'   => 'years',
						   'month'  => 'months',
						   'day'    => 'days',
						   'hour'   => 'hours',
						   'minute' => 'minutes',
						   'second' => 'seconds'
					);
	
		foreach ($a as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
			}
		}
	}
}

function social_convertHashtags($str,$social){
	$regex = "/#+([a-zA-Z0-9_]+)/";
	if($social == 'instagram'){
		$str = preg_replace($regex, '<a href="https://www.instagram.com/explore/tags/$1/" target="_blank" class="svc_hashtags">$0</a>', $str);
	}
	if($social == 'facebook'){
		$str = preg_replace($regex, '<a href="https://www.facebook.com/hashtag/$1/" target="_blank" class="svc_hashtags">$0</a>', $str);
	}
	if($social == 'twitter'){
		$str = social_autolink($str);
		$str = preg_replace($regex, '<a href="https://twitter.com/hashtag/$1/" target="_blank" class="svc_hashtags">$0</a>', $str);
	}
	if($social == 'youtube'){
		$str = social_autolink($str);
	}
	if($social == 'dribbble'){
		$str = social_autolink($str);
	}
	if($social == 'vimeo'){
		$str = social_autolink($str);
	}
	if($social == 'vk'){
		$str = social_autolink($str);
	}
	return($str);
}

function social_autolink($string){
	$string = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\" class=\"svc_hashtags\">$1</a>", $string);
	return $string;
}
?>
