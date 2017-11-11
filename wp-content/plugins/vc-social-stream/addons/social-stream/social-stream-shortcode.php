<?php
function svc_social_layout_shortcode($attr,$content=null){
	extract(shortcode_atts( array(
		'fb_type' => '@',
		'fb_id' => '',
		'fb_num' => '5',
		'gplus_type' => '#',
		'gplus_id' => '',
		'gplus_num' => '5',
		'twitter_type' => '@',
		'twitter_id' => '',
		'twitter_num' => '5',
		'instagram_type' => '@',
		'instagram_id' => '',
		'instagram_num' => '5',
		'instagram_access_token' => '',
		'youtube_id' => '',
		'youtube_playlist_id' => '',
		'youtube_channel_id' => '',
		'youtube_num' => '5',
		'tumblr_id' => '',
		'tumblr_num' => '5',
		'vimeo_id' => '',
		'vimeo_num' => '5',
		'dribbble_id' => '',
		'dribbble_num' => '5',
		'post_type' => 'post_layout',
		'skin_type' => 'template',
		'car_display_item' => '4',
		'car_pagination' => '',
		'car_pagination_num' => '',
		'car_navigation' => '',
		'car_autoplay' => '',
		'car_autoplay_time' => '5',
		'grid_columns_count_for_desktop' => 'vcyt-col-md-3',
		'grid_columns_count_for_tablet' => 'vcyt-col-sm-4',
		'grid_columns_count_for_mobile' => 'vcyt-col-xs-12',
		'excerpt_length' => '150',
		'hide_media' => '',
		'filter' => '',
		'sort_filter' => '',
		'popup' => 'p1',
		'loadmore' => 'yes',
		'loadmore_text' => '',
		'date_sorting' => '',
		'effect' => '',
		'svc_class' => '',
		'pbgcolor' => '',
		'pbghcolor' => '',
		'tcolor' => '',
		'ftcolor' => '',
		'ftacolor' => '',
		'ftabgcolor' => '',
		'loder_color' => '',
		'car_navigation_color' => ''
	), $attr));
	wp_register_style( 'svc-social-css', plugins_url('css/css.css', __FILE__));
	wp_enqueue_style( 'svc-social-css');
	wp_enqueue_style( 'vcyt-bootstrap-css' );
	wp_enqueue_style( 'svc-megnific-css' );
	wp_enqueue_style( 'svc-social-animate-css');

	wp_enqueue_script('svc-megnific-js');
	wp_enqueue_script('svc-carousel-js');
	$svc_social_id = rand(100,7000);
	ob_start();	
	if(!$twitter_num){
		$twitter_num = 5;	
	}
	if(!$fb_num){
		$fb_num = 5;	
	}
	if(!$instagram_num){
		$instagram_num = 5;	
	}
	if(!$youtube_num){
		$youtube_num = 5;	
	}
	if(!$excerpt_length){
		$excerpt_length = 150;	
	}
	
	?>
<style type="text/css">
<?php if($ftcolor != ''){?>
.svc_sort_div_<?php echo $svc_social_id;?>{background:<?php echo $ftabgcolor;?> !important; color:<?php echo $ftacolor;?> !important;}
.svc_sort_div a i{ color:<?php echo $ftacolor;?> !important;}
<?php }?>

<?php if($skin_type == 'template'){$skint = '';}elseif($skin_type == 'template1'){$skint = '1';}elseif($skin_type == 'template2'){$skint = '2';}
if($pbgcolor != ''){?>
.vc_social_tm<?php echo $skint;?>{ background:<?php echo $pbgcolor;?> !important;}
<?php }
if($pbghcolor != ''){?>
.vc_social_tm<?php echo $skint;?>:hover{ background:<?php echo $pbghcolor;?> !important;}
<?php }
if($tcolor != ''){?>
.vc_social_tm<?php echo $skint;?> .svc-author-title{ color:<?php echo $tcolor;?>  !important;}
<?php }
if($ftcolor != ''){?>
.svc_social_filter_ul_<?php echo $svc_social_id;?> li{ border:1px solid <?php echo $ftcolor;?> !important;}
.svc_social_filter_ul_<?php echo $svc_social_id;?> li a{ color:<?php echo $ftcolor;?> !important;}
<?php }
if($ftacolor != ''){?>
.svc_social_filter_ul_<?php echo $svc_social_id;?> li.active a{ color:<?php echo $ftacolor;?> !important;}
<?php }
if($ftabgcolor != ''){?>
.svc_social_filter_ul_<?php echo $svc_social_id;?> li.active{ background:<?php echo $ftabgcolor;?> !important;border:1px solid <?php echo $ftabgcolor;?> !important;}
<?php }
if($loder_color != ''){?>
.svc_social_stream_container_<?php echo $svc_social_id;?> nav#svc_infinite div.loading-spinner .ui-spinner .side .fill{background:<?php echo $loder_color;?> !important;}
.svc_load_more_<?php echo $svc_social_id;?>.svc_carousel_loadmore{ color:<?php echo $loder_color;?> !important;}
<?php }
if($car_navigation_color != ''){?>
.owl-theme .owl-controls .owl-buttons div{ background:<?php echo $car_navigation_color;?> !important;}
.owl-theme .owl-controls .owl-page span{ background:<?php echo $car_navigation_color;?> !important;}
<?php }?>
</style>
    <div>
    	<div class="svc_mask <?php echo $svc_class;?>" id="svc_mask_<?php echo $svc_social_id;?>">
            <div id="loader"></div>
        </div>
        <section class="feed svc_social_stream_container svc_social_stream_container_<?php echo $svc_social_id;?> <?php echo $svc_class;?>">
        <?php if($filter == 'yes' && $post_type != 'carousel'){?>
        <div class="svc_social_filter_div">
        	<ul class="svc_social_filter_ul svc_social_filter_ul_<?php echo $svc_social_id;?>">
				<li data-filter="*" class="active"><a href="javascript:;">All</a></li>
				<?php if($fb_id != ''){?>
            	<li data-filter="svc_facebook"><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
				<?php }
				if($twitter_id != ''){?>
                <li data-filter="svc_twitter"><a href="javascript:;" ><i class="fa fa-twitter"></i></a></li>
				<?php }
				if($gplus_id != ''){?>
                <li data-filter="svc_gplus"><a href="javascript:;"><i class="fa fa-google"></i></a></li>
				<?php }
				if($instagram_id != ''){?>
                <li data-filter="svc_instagram"><a href="javascript:;"><i class="fa fa-instagram"></i></a></li>
				<?php }
				if($youtube_id != '' || $youtube_playlist_id != '' || $youtube_channel_id != ''){?>
                <li data-filter="svc_youtube"><a href="javascript:;"><i class="fa fa-youtube"></i></a></li>
				<?php }
				if($tumblr_id != ''){?>
                <li data-filter="svc_tumblr"><a href="javascript:;"><i class="fa fa-tumblr"></i></a></li>
				<?php }
				if($vimeo_id != ''){?>
                <li data-filter="svc_vimeo"><a href="javascript:;"><i class="fa fa-vimeo-square"></i></a></li>
				<?php }
				if($dribbble_id != ''){?>
                <li data-filter="svc_dribbble"><a href="javascript:;"><i class="fa fa-dribbble"></i></a></li>
				<?php }?>
            </ul>
            
            <?php if($sort_filter == 'yes' && $post_type != 'carousel'){
				
				$output = '
				<div class="svc_fl svc_sort_div svc_sort_div_'.$svc_social_id.'">
					<div class="svc_sort_title">'.__(ucwords ( str_replace('_',' ','Date') ),'js_composer').'</div>
					<a href="javascript:;" class="svc_active" id="svc_sort_asc_'.$svc_social_id.'"><i class="fa fa-chevron-up"></i></a>
					<a href="javascript:;" class="" id="svc_sort_desc_'.$svc_social_id.'"><i class="fa fa-chevron-down"></i></a>
				</div>';
				echo $output;
			}?>
            </div>
            <?php
        }?>
			<div class="social-feed-container social-feed-container_<?php echo $svc_social_id;?>" style="width:100%;" id="svc_social_stream_<?php echo $svc_social_id;?>">
			</div>
            <?php if($loadmore == 'yes' && $post_type != 'carousel'){?>
			<div class="load_more_main_div <?php echo $svc_class;?>">
				<nav id="svc_infinite" class="svc_infinite_<?php echo $svc_social_id;?>">
				  <div class="loading-spinner loading-spinner_<?php echo $svc_social_id;?>">
					<div class="ui-spinner">
					  <span class="side side-left">
						<span class="fill"></span>
					  </span>
					  <span class="side side-right">
						<span class="fill"></span>
					  </span>
					</div>
				  </div>
				  <a href="javascript:;" data-facebook="" data-twitter="" data-gplus="" data-instagram="" data-tumblr="" data-youtube="" data-vimeo="" data-dribbble="" class="svc_load_more_<?php echo $svc_social_id;?> svc_carousel_loadmore" id="social_load_more_btn_<?php echo $svc_social_id;?>" rel="<?php echo $svc_social_id;?>"><?php if($loadmore_text != ''){ _e($loadmore_text,'svc_social_feed');}else{ _e('Show More','svc_social_feed');}?></a>
				</nav>
			</div>
            <?php }?>
        </section>
    </div>
	<script>
    jQuery(document).ready(function() {
		function all_svc_megnific_content_image_height_manage(){
			  var window_width = jQuery(window).width();
			  if(window_width > 768){
				  var fb_image_height = jQuery('.svc_facebok_popup .vcyt-col-md-8').height();
					  jQuery('.svc_facebok_popup .vcyt-col-md-8 .fb_popup_img').css('max-height',fb_image_height+'px');
				  jQuery(window).resize(function(){
					  var window_width = jQuery(window).width();
					  if(window_width > 768){
						  var fb_image_height = jQuery('.svc_facebok_popup .vcyt-col-md-8').height();
						  jQuery('.svc_facebok_popup .vcyt-col-md-8 .fb_popup_img').css('max-height',fb_image_height+'px');
					  }else{
						  jQuery('.svc_facebok_popup .vcyt-col-md-8 .fb_popup_img').removeAttr('style');
					  }
				  });
			  }else{
				  jQuery(window).resize(function(){
					  var window_width = jQuery(window).width();
					  if(window_width > 768){
						  var fb_image_height = jQuery('.svc_facebok_popup .vcyt-col-md-8').height();
						  jQuery('.svc_facebok_popup .vcyt-col-md-8 .fb_popup_img').css('max-height',fb_image_height+'px');
					  }else{
						  jQuery('.svc_facebok_popup .vcyt-col-md-8 .fb_popup_img').removeAttr('style');
					  }
				  });
			  }
		}
		function svc_megnific_script_with_content_<?php echo $svc_social_id;?>(){
			jQuery('.social-feed-container_<?php echo $svc_social_id;?> a.svc_big_img,.social-feed-container_<?php echo $svc_social_id;?> .popup-youtube,.social-feed-container_<?php echo $svc_social_id;?> .popup-vimeo').magnificPopup({
				  type: 'ajax',
				  closeBtnInside:false,
	  			  closeOnBgClick: false,
				  callbacks: {
					  ajaxContentAdded: function(){
						  all_svc_megnific_content_image_height_manage();
						  jQuery('.you-desc-hide-show').on('click',function(){
							  if(jQuery(this).hasClass('you-desc-show')){
								jQuery('.you-panel-details').addClass('you-desc-panel-height');
								jQuery(this).removeClass('you-desc-show'); 
								jQuery(this).text(jQuery(this).attr('show-more'));
							  }else{
								if(jQuery(this).hasClass('vimeo-show-more')){
									jQuery(this).remove();
								}
								jQuery('.you-panel-details').removeClass('you-desc-panel-height');
								jQuery(this).addClass('you-desc-show');
								jQuery(this).text(jQuery(this).attr('show-less'));
							  }
						  });
					  }
				  }
			});
			jQuery('.social-feed-container_<?php echo $svc_social_id;?> a.svc_gplus_img').magnificPopup({
			  type: 'image',
			  closeBtnInside:false
			});	
		}
		function svc_megnific_script_<?php echo $svc_social_id;?>(){
			jQuery('.social-feed-container_<?php echo $svc_social_id;?> a.svc_big_img').magnificPopup({
			  type: 'image',
			  closeBtnInside:false
			});
			jQuery('.social-feed-container_<?php echo $svc_social_id;?> .popup-youtube').magnificPopup({
			  type: 'iframe',
			  mainClass: 'mfp-fade',
			  preloader: false,
			  closeBtnInside:false,
			  iframe: {
				 patterns: {
				   youtube: {
					index: 'youtube.com', 
					id: 'v=', 
					src: '//www.youtube.com/embed/%id%?rel=0&autoplay=0'
				   }
				 }
			   }
			});
			jQuery('.social-feed-container_<?php echo $svc_social_id;?> .popup-vimeo').magnificPopup({
			  type: 'iframe',
			  mainClass: 'mfp-fade',
			  preloader: false,
			  closeBtnInside:false,
			  iframe: {
				 patterns: {
				   vimeo: {
					index: 'vimeo.com', 
					id: '/',
					src: '//player.vimeo.com/video/%id%?autoplay=0'
				   }
				 }
			   }
			});
		}
		
		var iso_cont = jQuery('.social-feed-container_<?php echo $svc_social_id;?>');
		<?php  if($sort_filter == 'yes' && $post_type != 'carousel'){?>
		jQuery('#svc_sort_asc_<?php echo $svc_social_id;?>').click(function() {
			jQuery('.svc_sort_div_<?php echo $svc_social_id;?> a').removeClass('svc_active');
			jQuery(this).addClass('svc_active');
			iso_cont.isotope({
			  sortBy: 'date',
			  sortAscending : true
			});
		});
		jQuery('#svc_sort_desc_<?php echo $svc_social_id;?>').click(function() {
			jQuery('.svc_sort_div_<?php echo $svc_social_id;?> a').removeClass('svc_active');
			jQuery(this).addClass('svc_active');
			iso_cont.isotope({
			  sortBy: 'date',
			  sortAscending : false
			});
		});
		<?php }?>
		<?php if($filter == 'yes' && $post_type != 'carousel'){?>
		jQuery('.svc_social_filter_ul_<?php echo $svc_social_id;?> li').on( 'click', function(e) {
		  e.preventDefault();
		  jQuery('.svc_social_filter_ul_<?php echo $svc_social_id;?> li').removeClass('active');
		  jQuery(this).addClass('active');
		  var filterValue = jQuery(this).attr('data-filter');
		  
		  var filterValue = '';
		  jQuery('.svc_social_filter_ul_<?php echo $svc_social_id;?> li').each(function(){
		  	if(jQuery(this).hasClass('active')){
				var v = jQuery(this).attr('data-filter');
				if(typeof v != 'undefined' ){
					if(v === '*'){
						filterValue += v;
					}else{
						filterValue += '.'+v;
					}
				}
			}
		  });
		  iso_cont.isotope({transformsEnabled: false,isResizeBound: false,transitionDuration: 0}).isotope({ filter: filterValue }).isotope();
		});
		<?php }
		if($loadmore == 'yes' && $post_type != 'carousel'){?>
		jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').click(function(){
			jQuery('.loading-spinner_<?php echo $svc_social_id;?>').show();
			jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').hide();
			jQuery('.social-feed-container_<?php echo $svc_social_id;?>').svc_social_stream({
				grid_columns_count_for_desktop:'<?php echo $grid_columns_count_for_desktop;?>',
				grid_columns_count_for_tablet:'<?php echo $grid_columns_count_for_tablet;?>',
				grid_columns_count_for_mobile:'<?php echo $grid_columns_count_for_mobile;?>',
				stream_id:'<?php echo $svc_social_id;?>',
				length: <?php echo $excerpt_length;?>,
				<?php if($effect != ''){?>
				effect:'<?php echo $effect;?>',
				<?php }?>
                show_media: <?php echo ($hide_media == 'yes') ? 'false' : 'true';?>,
				template: '<?php echo plugins_url( ltrim( 'template/'.$skin_type.'.html', '/' ), __FILE__ );?>',
				<?php if($gplus_id != ''){?>
				google: {
					accounts: ["<?php echo $gplus_type.$gplus_id;?>"],
					limit: <?php echo $gplus_num;?>,
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4',
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-gplus'),
					showmore:true
				},
				<?php }
				if($fb_id != ''){?>
				facebook: {
					accounts: ["<?php echo $fb_type.$fb_id;?>"],
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-facebook'),
					showmore:true
				},
				<?php }
				if($twitter_id != ''){?>
				twitter: {
                    accounts: ["<?php echo $twitter_type.$twitter_id;?>"], // @ user id #for search result
					limit: <?php echo $twitter_num;?>,
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-twitter'),
					showmore:true,
                    consumer_key: 'UaXiG364zfkqhkkK6ckFSRtoy', // make sure to have your app read-only
                    consumer_secret: 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V', // make sure to have your app read-only
                },
				<?php }
				if($instagram_id != ''){?>
				instagram: {
                    accounts: ["<?php echo $instagram_type.$instagram_id;?>"], //@ for user # user serach
                    loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-instagram'),
                    instagram_access_token: '<?php echo $instagram_access_token;?>',
					showmore:true
                },
				<?php }
				if($tumblr_id != ''){?>
				tumblr: {
                    accounts: ["@<?php echo $tumblr_id;?>"], //for @flipkart page
                    limit: <?php echo $tumblr_num;?>,
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-tumblr'),
					showmore:true,
                    api_key: 'HXre7XQapYZgmz6mDlPfv0wAzYHz93tyxyCA94wDw9wG6ATMiI'
                },
				<?php }
				if($youtube_id != '' || $youtube_playlist_id != '' || $youtube_channel_id != ''){
					if($youtube_id == ''){
						$youtube_id = 'apple';
					}?>
				youtube: {
					accounts: ["<?php echo $youtube_id;?>"],
                    limit: <?php echo $youtube_num;?>,
					<?php if($youtube_playlist_id != ''){?>
					//playlistid: '<?php echo $youtube_playlist_id;?>',
					<?php }?>
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-youtube'),
					showmore:true,
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4'
				},
				<?php }
				if($vimeo_id != ''){?>
				vimeo: {
                    accounts: ["<?php echo $vimeo_id;?>"], //for @user723916 page
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-vimeo'),
					showmore:true,
                },
				<?php }
				if($dribbble_id != ''){?>
				dribbble: {
                    accounts: ["<?php echo $dribbble_id;?>"],
                    limit: <?php echo $dribbble_num;?>,
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-dribbble'),
					showmore:true,
                },
				<?php }?>
				popup: '<?php echo $popup;?>',
				callback: function(dataa_social) {
					var dd = 0;
					var iitem = jQuery( dataa_social );
					
					iitem.imagesLoaded( function() {
					jQuery('.loading-spinner_<?php echo $svc_social_id;?>').hide();
					jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').show();
					iso_cont.append( iitem ).isotope( 'appended',iitem);
					<?php if($popup == 'p1'){?>
						svc_megnific_script_<?php echo $svc_social_id;?>();
					<?php }else{?>
						svc_megnific_script_with_content_<?php echo $svc_social_id;?>();
					<?php }?>
						jQuery("[vc-social-effect]").viewportChecker({
							classToAdd: '<?php echo $effect;?>', // Class to add to the elements when they are visible
							classToRemove: 'opacity0', // Class to remove before adding 'classToAdd' to the elements
							callbackFunction: function(elem, action){
								if(action == 'add'){
									elem.removeAttr('vc-social-effect');
								}
							},
						});
					});
						
					/*iso_cont.append( iitem ).isotope( 'appended',iitem);
					iso_cont.isotope();
					setTimeout(function(){
						jQuery("[vc-social-effect]").each(function(index, element) {
                            var ef = jQuery(this).attr('vc-social-effect');
							jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
                        });
						var sdi = setInterval(function(){
							iso_cont.isotope();
							if(dd>5){
								clearInterval(sdi);
							}
							dd++;
						},800);
					},500);*/
                }
			});
		});
		<?php }
		if($post_type != 'carousel'){?>
		iso_cont.isotope({
			itemSelector: '.svc-social-item',
			getSortData: {
				date: function (elem) {
					return Date.parse(jQuery(elem).attr('dt-create'));
				}
			},
			<?php if($date_sorting == 'yes'){?>
			sortBy: 'date',
			sortAscending : false,
			<?php }?>
			transformsEnabled: false,
			  isResizeBound: false,
			  transitionDuration: '0',
			  filter: '*',
			  layoutMode: 'masonry',
			  masonry: {
				columnWidth: 1
			  }
		});
		jQuery(window).resize(function(){
				iso_cont.isotope();
		});
		<?php }else{?>
		iso_cont.owlCarousel({
			<?php if($car_autoplay == 'yes'){?>
			autoPlay: <?php echo $car_autoplay_time*1000;?>,
			<?php }?>
			items : <?php echo $car_display_item;?>,
			<?php if($car_display_item == 1){?>
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [979,1],
			itemsTablet : [768,1],
			<?php }?>
			pagination:<?php if($car_pagination == 'yes'){echo 'true';}else{echo 'false';}?>,
			navigation: <?php if($car_navigation == 'yes'){echo 'false';}else{echo 'true';}?>,
			<?php if($car_pagination == 'yes' && $car_pagination_num == 'yes'){?>
			paginationNumbers:true,
			<?php }
			if($synced == 'yes' && $car_display_item == 1){?>
			afterAction : svc_syncPosition_<?php echo $svc_grid_id;?>,
			responsiveRefreshRate : 200,
			<?php }?>
			navigationText: [
				"<i class='icons icon-left-dir icon-white'></i>",
				"<i class='icons icon-right-dir icon-white'></i>"
			],
			afterInit:function(){
				<?php if($popup == 'p1'){?>
					svc_megnific_script_<?php echo $svc_social_id;?>();
				<?php }else{?>
					svc_megnific_script_with_content_<?php echo $svc_social_id;?>();
				<?php }?>			
			}
		});
		<?php }?>
        var vc_social_updateFeed_<?php echo $svc_social_id;?> = function() {
            jQuery('.social-feed-container_<?php echo $svc_social_id;?>').svc_social_stream({
				<?php if($gplus_id != ''){?>
				google: {
                    accounts: ["<?php echo $gplus_type.$gplus_id;?>"],//for page #113649881831517330739 for profile @digital.inspiration
                    limit: <?php echo $gplus_num;?>,
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4'
                },
				<?php }if($fb_id != ''){?>
                facebook: {
                    accounts: ["<?php echo $fb_type.$fb_id;?>"], //for @digital.inspiration page
                    limit: <?php echo $fb_num;?>,
                    access_token: '939642459399515|GT91tLv3rE7vCXn9UNP1tHsHZSA'//'150849908413827|a20e87978f1ac491a0c4a721c961b68c'
                },
				<?php }
				if($twitter_id != ''){?>
                twitter: {
                    accounts: ["<?php echo $twitter_type.$twitter_id;?>"], // @shabbyapple user id #for search result
                    limit: <?php echo $twitter_num;?>,
                    consumer_key: 'UaXiG364zfkqhkkK6ckFSRtoy', // make sure to have your app read-only
                    consumer_secret: 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V', // make sure to have your app read-only
                },
				<?php }
				if($instagram_id != ''){?>
				instagram: {
                    accounts: ["<?php echo $instagram_type.$instagram_id;?>"], //@shabbyapple for user # user serach
                    limit: <?php echo $instagram_num;?>,
                    client_id: 'c47fb3449fbf4dcea3d52aab52630556',
                    instagram_access_token: '<?php echo $instagram_access_token;?>'
                },
				<?php }
				if($tumblr_id != ''){?>
				tumblr: {
                    accounts: ["@<?php echo $tumblr_id;?>"], //for @itunes page
                    limit: <?php echo $tumblr_num;?>,
                    api_key: 'HXre7XQapYZgmz6mDlPfv0wAzYHz93tyxyCA94wDw9wG6ATMiI'
                },
				<?php }
				if($youtube_id != '' || $youtube_playlist_id != '' || $youtube_channel_id != ''){
					if($youtube_id == ''){
						$youtube_id = 'apple';
					}?>
				youtube: {
					accounts: ["<?php echo $youtube_id;?>"],
                    limit: <?php echo $youtube_num;?>,
					<?php if($youtube_playlist_id != ''){?>
					playlistid: '<?php echo $youtube_playlist_id;?>',
					<?php }
					if($youtube_channel_id != ''){?>
					channel_id: '<?php echo $youtube_channel_id;?>',
					<?php }?>
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4'
				},
				<?php }
				if($vimeo_id != ''){?>
				vimeo: {
                    accounts: ["<?php echo $vimeo_id;?>"], //for @user723916 page
					limit: <?php echo $vimeo_num;?>,
                },
				<?php }
				if($dribbble_id != ''){?>
				dribbble: {
                    accounts: ["<?php echo $dribbble_id;?>"], //for @user723916 page
					limit: <?php echo $dribbble_num;?>,
                },
				<?php }
				if($post_type != 'carousel'){?>
				grid_columns_count_for_desktop:'<?php echo $grid_columns_count_for_desktop;?>',
				grid_columns_count_for_tablet:'<?php echo $grid_columns_count_for_tablet;?>',
				grid_columns_count_for_mobile:'<?php echo $grid_columns_count_for_mobile;?>',
				<?php }else{?>
				grid_columns_count_for_desktop:'',
				grid_columns_count_for_tablet:'',
				grid_columns_count_for_mobile:'',
				<?php }?>
				popup: '<?php echo $popup;?>',
				stream_id:'<?php echo $svc_social_id;?>',
                length: <?php echo $excerpt_length;?>,
				<?php if($effect != ''){?>
				effect:'<?php echo $effect;?>',
				<?php }?>
                show_media: <?php echo ($hide_media == 'yes') ? 'false' : 'true';?>,
				template: '<?php echo plugins_url( ltrim( 'template/'.$skin_type.'.html', '/' ), __FILE__ );?>',
                // Moderation function - if returns false, template will have class hidden
                moderation: function(content) {
                    return (content.text) ? content.text.indexOf('fuck') == -1 : true;
                },
				popup: '<?php echo $popup;?>',
                //update_period: 5000,
                // When all the posts are collected and displayed - this function is evoked
                callback: function(dataa_social) {
                    console.log('all posts are collected');
				<?php if($post_type != 'carousel'){?>
					var dd = 0;
					var sdasd = jQuery( dataa_social );
					iso_cont.isotope( 'insert',sdasd);
					iso_cont.imagesLoaded( function() {
						//iso_cont.isotope();
						setTimeout(function(){
							
							var sdi = setInterval(function(){
								iso_cont.isotope();
								if(dd>10){
									clearInterval(sdi);
								}
								dd++;
							},800);
							
							iso_cont.isotope();
							setTimeout(function(){
								jQuery('.svc_social_stream_container_<?php echo $svc_social_id;?>').show();
								jQuery('#svc_mask_<?php echo $svc_social_id;?>').hide();
								jQuery("[vc-social-effect]").viewportChecker({
									classToAdd: '<?php echo $effect;?>', // Class to add to the elements when they are visible
									classToRemove: 'opacity0', // Class to remove before adding 'classToAdd' to the elements
									callbackFunction: function(elem, action){
										if(action == 'add'){
											elem.removeAttr('vc-social-effect');
										}
									},
								});
								/*jQuery("[vc-social-effect]").each(function(index, element) {
									var ef = jQuery(this).attr('vc-social-effect');
									jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
								});*/
							},1000);
							<?php if($popup == 'p1'){?>
								svc_megnific_script_<?php echo $svc_social_id;?>();
							<?php }else{?>
								svc_megnific_script_with_content_<?php echo $svc_social_id;?>();
							<?php }?>
						},1000);
						
					});
					<?php }else{?>
					iso_cont.data('owlCarousel').addItem(dataa_social);
					jQuery('.svc_social_stream_container_<?php echo $svc_social_id;?>').show();
					jQuery('#svc_mask_<?php echo $svc_social_id;?>').hide();
					jQuery("[vc-social-effect]").each(function(index, element) {
						var ef = jQuery(this).attr('vc-social-effect');
						jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
					});
					<?php }?>
                }
            });
        };
        vc_social_updateFeed_<?php echo $svc_social_id;?>();
    });
    </script>
	
	<?php
	$message = ob_get_clean();
	return $message;
}
?>
