<?php
include('social-stream-shortcode.php');
if(!class_exists('svc_social_layout'))
{
	class svc_social_layout
	{
		function __construct()
		{
			add_action('admin_init',array($this,'svc_social_layout_init'));
			add_shortcode('svc_social_stream','svc_social_layout_shortcode');
		}
		function svc_social_layout_init()
		{

			if(function_exists('vc_map'))
			{
				$animations = array(
				'None' => '',
				'bounce'		=>	'bounce',
				'flash'			=>	'flash',
				'pulse'			=>	'pulse',
				'rubberBand'	=>	'rubberBand',
				'shake'			=>	'shake',
				'swing'			=>	'swing',
				'tada'			=>	'tada',
				'bounce'		=>	'bounce',
				'wobble'		=>	'wobble',
				'bounceIn'		=>	'bounceIn',
				'bounceInDown'	=>	'bounceInDown',
				'bounceInLeft'	=>	'bounceInLeft',
				'bounceInRight'	=>	'bounceInRight',
				'bounceInUp'	=>	'bounceInUp',
				'fadeIn'			=>	'fadeIn',
				'fadeInDown'		=>	'fadeInDown',
				'fadeInDownBig'		=>	'fadeInDownBig',
				'fadeInLeft'		=>	'fadeInLeft',
				'fadeInLeftBig'		=>	'fadeInLeftBig',
				'fadeInRight'		=>	'fadeInRight',
				'fadeInRightBig'	=>	'fadeInRightBig',
				'fadeInUp'			=>	'fadeInUp',
				'fadeInUpBig'		=>	'fadeInUpBig',
				'flip'	=>	'flip',
				'flipInX'	=>	'flipInX',
				'flipInY'	=>	'flipInY',
				'lightSpeedIn'	=>	'lightSpeedIn',
				'rotateIn'			=>	'rotateIn',
				'rotateInDownLeft'	=>	'rotateInDownLeft',
				'rotateInDownRight'	=>	'rotateInDownRight',
				'rotateInUpLeft'	=>	'rotateInUpLeft',
				'rotateInUpRight'	=>	'rotateInUpRight',
				'slideInUp' => 'slideInUp',
				'slideInDown' => 'slideInDown',
				'slideInLeft' => 'slideInLeft',
				'slideInRight' => 'slideInRight',
				'zoomIn'		=>	'zoomIn',
				'zoomInDown'	=>	'zoomInDown',
				'zoomInLeft'	=>	'zoomInLeft',
				'zoomInRight'	=>	'zoomInRight',
				'zoomInUp'		=>	'zoomInUp',
				'rollIn'	=>	'rollIn',
				'twisterInDown'	=>	'twisterInDown',
				'twisterInUp'	=>	'twisterInUp',
				'swap'			=>	'swap',
				'puffIn'	=>	'puffIn',
				'vanishIn'	=>	'vanishIn',
				'openDownLeftRetourn'	=>	'openDownLeftRetourn',
				'openDownRightRetourn'	=>	'openDownRightRetourn',
				'openUpLeftRetourn'		=>	'openUpLeftRetourn',
				'openUpRightRetourn'	=>	'openUpRightRetourn',
				'perspectiveDownRetourn'	=>	'perspectiveDownRetourn',
				'perspectiveUpRetourn'		=>	'perspectiveUpRetourn',
				'perspectiveLeftRetourn'	=>	'perspectiveLeftRetourn',
				'perspectiveRightRetourn'	=>	'perspectiveRightRetourn',
				'slideDownRetourn'	=>	'slideDownRetourn',
				'slideUpRetourn'	=>	'slideUpRetourn',
				'slideLeftRetourn'	=>	'slideLeftRetourn',
				'slideRightRetourn'	=>	'slideRightRetourn',
				'swashIn'		=>	'swashIn',
				'foolishIn'		=>	'foolishIn',
				'tinRightIn'	=>	'tinRightIn',
				'tinLeftIn'		=>	'tinLeftIn',
				'tinUpIn'		=>	'tinUpIn',
				'tinDownIn'		=>	'tinDownIn',
				'boingInUp'		=>	'boingInUp',
				'spaceInUp'		=>	'spaceInUp',
				'spaceInRight'	=>	'spaceInRight',
				'spaceInDown'	=>	'spaceInDown',
				'spaceInLeft'	=>	'spaceInLeft'
			);
				vc_map( array(
					"name" => __('Social Stream','js_composer'),		
					"base" => 'svc_social_stream',		
					"icon" => 'vc_social_logo',		
					"category" => __('Social Stream','js_composer'),
					'description' => __( 'Set your Social Stream.','js_composer' ),
					"params" => array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'Select Type', 'js_composer' ),
							'param_name' => 'fb_type',
							"value" =>array(
								__("For Page/User", 'js_composer' )=>"@",
								__("For Group", 'js_composer' )=>"#"
								
								),
							'description' => __( 'Select facebook User feed type.', 'js_composer' ),
							'group' => __('<i class="fa fa-facebook"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User name Or Page ID', 'js_composer' ),
							'param_name' => 'fb_id',
							'holder' => 'div',
							'description' => __( 'Enter Facebook Page or User name.', 'js_composer' ),
							'group' => __('<i class="fa fa-facebook"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'fb_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-facebook"></i>', 'js_composer')
						),
						array(
							'type' => 'dropdown',
							'heading' => __( 'Select Type', 'js_composer' ),
							'param_name' => 'gplus_type',
							"value" =>array(
								__("For Page ID or name", 'js_composer' )=>"#",
								__("For User Profile ID or name", 'js_composer' )=>"@"
								),
							'description' => __( 'Select Google Plus feed type.', 'js_composer' ),
							'group' => __('<i class="fa fa-google"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User Or Page ID', 'js_composer' ),
							'param_name' => 'gplus_id',
							'holder' => 'div',
							'description' => __( 'Enter Google Plus Page or Profile id.', 'js_composer' ),
							'group' => __('<i class="fa fa-google"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'gplus_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-google"></i>', 'js_composer')
						),
						array(
							'type' => 'dropdown',
							'heading' => __( 'Select Type', 'js_composer' ),
							'param_name' => 'twitter_type',
							"value" =>array(
								__("For User", 'js_composer' )=>"@",
								__("For Search Feed", 'js_composer' )=>"#"
								
								),
							'description' => __( 'Select Twitter User feed type.', 'js_composer' ),
							'group' => __('<i class="fa fa-twitter"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User name', 'js_composer' ),
							'param_name' => 'twitter_id',
							'holder' => 'div',
							'description' => __( 'Enter Twitter User name.', 'js_composer' ),
							'group' => __('<i class="fa fa-twitter"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'twitter_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-twitter"></i>', 'js_composer')
						),
						array(
							'type' => 'dropdown',
							'heading' => __( 'Select Type', 'js_composer' ),
							'param_name' => 'instagram_type',
							"value" =>array(
								__("For User", 'js_composer' )=>"@",
								__("For Search Feed", 'js_composer' )=>"#"
								),
							'description' => __( 'Select Instagram User feed type.', 'js_composer' ),
							'group' => __('<i class="fa fa-instagram"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User name', 'js_composer' ),
							'param_name' => 'instagram_id',
							'holder' => 'div',
							'description' => __( 'Enter Instagram User name.', 'js_composer' ),
							'group' => __('<i class="fa fa-instagram"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'instagram_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-instagram"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Instagram auth settings / Access Token', 'js_composer' ),
							'param_name' => 'instagram_access_token',
							'description' => __( 'You can use your own token or get token authorizing our app. Follow setup guide.<a href="http://plugin.saragna.com/vc-addon/how-to-generate-an-instagram-access-token/" target="_blank">Follow setup guide</a>.', 'js_composer' ),
							'group' => __('<i class="fa fa-instagram"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User ID', 'js_composer' ),
							'param_name' => 'youtube_id',
							'holder' => 'div',
							'description' => __( 'Enter Youtube User id.', 'js_composer' ),
							'group' => __('<i class="fa fa-youtube"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Enter Playlist ID', 'js_composer' ),
							'param_name' => 'youtube_playlist_id',
							'description' => __( '(Optional) Enter Youtube Playlist id.', 'js_composer' ),
							'group' => __('<i class="fa fa-youtube"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Enter Channel ID', 'js_composer' ),
							'param_name' => 'youtube_channel_id',
							'holder' => 'div',
							'description' => __( 'Enter Youtube Channel id.', 'js_composer' ),
							'group' => __('<i class="fa fa-youtube"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'youtube_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-youtube"></i>', 'js_composer')
						),						
						array(
							'type' => 'textfield',
							'heading' => __( 'Page ID', 'js_composer' ),
							'param_name' => 'tumblr_id',
							'holder' => 'div',
							'description' => __( 'Enter Tumblr Page id.', 'js_composer' ),
							'group' => __('<i class="fa fa-tumblr"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'tumblr_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-tumblr"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User ID', 'js_composer' ),
							'param_name' => 'vimeo_id',
							'holder' => 'div',
							'description' => __( 'Enter Vimeo User id.', 'js_composer' ),
							'group' => __('<i class="fa fa-vimeo-square"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'vimeo_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-vimeo-square"></i>', 'js_composer')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'User Name', 'js_composer' ),
							'param_name' => 'dribbble_id',
							'holder' => 'div',
							'description' => __( 'Enter Dribbble User Name.', 'js_composer' ),
							'group' => __('<i class="fa fa-dribbble"></i>', 'js_composer')
						),
						array(
							'type' => 'num',
							'heading' => __( 'Count per page limit', 'js_composer' ),
							'param_name' => 'dribbble_num',
							'value' => '5',
							'min' => 1,
							'max' => 1000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'Set Limit for feed par page.', 'js_composer' ),
							'group' => __('<i class="fa fa-dribbble"></i>', 'js_composer')
						),
						array(
							"type" => "dropdown",
							"heading" => __("Feed type" , 'js_composer' ),
							"param_name" => "post_type",
							"value" =>array(
								__("Post Layout", 'js_composer' )=>"post_layout",
								__("Carousel", 'js_composer' )=>"carousel"
								),
							"description" => __("Choose Feed type.", 'js_composer' ),
						),
						array(
							"type" => "dropdown",
							"heading" => __("Skin type" , 'js_composer' ),
							"param_name" => "skin_type",
							"value" =>array(
								__("Style1", 'js_composer' )=>"template",
								__("Style2", 'js_composer' )=>"template1",
								__("Style3", 'js_composer' )=>"template2"
								),
							"description" => __("Choose skin type for Social feed layout.", 'js_composer' ),
						),
						array(
							'type' => 'num',
							'heading' => __( 'Items Display', 'js_composer' ),
							'param_name' => 'car_display_item',
							'value' => '4',
							'min' => 1,
							'max' => 100,
							'suffix' => '',
							'step' => 1,
							'dependency' => array('element' => 'post_type','value' => 'carousel'),
							'description' => __( 'This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show pagination', 'js_composer' ),
							'param_name' => 'car_pagination',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'post_type','value' => 'carousel'),
							'description' => __( 'Show pagination', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show pagination Numbers', 'js_composer' ),
							'param_name' => 'car_pagination_num',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'car_pagination','value' => 'yes'),
							'description' => __( 'Show numbers inside pagination buttons.', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Hide navigation', 'js_composer' ),
							'param_name' => 'car_navigation',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'post_type','value' => 'carousel'),
							'description' => __( 'Display "next" and "prev" buttons.', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'AutoPlay', 'js_composer' ),
							'param_name' => 'car_autoplay',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'post_type','value' => 'carousel'),
							'description' => __( 'Set Slider Autoplay.', 'js_composer' )
						),
						array(
							'type' => 'num',
							'heading' => __( 'autoPlay Time', 'js_composer' ),
							'param_name' => 'car_autoplay_time',
							'value' => '5',
							'min' => 1,
							'max' => 100,
							'suffix' => 'seconds',
							'step' => 1,
							'dependency' => array('element' => 'car_autoplay','value' => 'yes'),
							'description' => __( 'Set Autoplay slider speed.', 'js_composer' )
						),
						array(
							"type" => "dropdown",
							"heading" => __("Desktop Columns Count" , 'js_composer' ),
							"param_name" => "grid_columns_count_for_desktop",
							"value" =>array(
								__("1 Column", 'js_composer' )=>"vcyt-col-md-12",
								__("2 Columns", 'js_composer' )=>"vcyt-col-md-6",
								__("3 Columns", 'js_composer' )=>"vcyt-col-md-4",
								__("4 Columns", 'js_composer' )=>"vcyt-col-md-3",
								__("5 Columns", 'js_composer' )=>"vcyt-col-md-15"
								),
							'std' => 'vcyt-col-md-3',
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							"description" => __("Choose Desktop(PC Mode) Columns Count", 'js_composer' ),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Tablet Columns Count" , 'js_composer' ),
							"param_name" => "grid_columns_count_for_tablet",
							"value" =>array(
								__("1 Column", 'js_composer' )=>"vcyt-col-sm-12",
								__("2 Columns", 'js_composer' )=>"vcyt-col-sm-6",
								__("3 Columns", 'js_composer' )=>"vcyt-col-sm-4",
								__("4 Columns", 'js_composer' )=>"vcyt-col-sm-3",
								__("5 Columns", 'js_composer' )=>"vcyt-col-sm-15"
								),
							'std' => 'vcyt-col-sm-4',
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							"description" => __("Choose Tablet Columns Count", 'js_composer' ),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Mobile Columns Count" ,'js_composer' ),
							"param_name" => "grid_columns_count_for_mobile",
							"value" =>array(
								__("1 Column", 'js_composer' )=>"vcyt-col-xs-12",
								__("2 Columns", 'js_composer' )=>"vcyt-col-xs-6",
								__("3 Columns", 'js_composer' )=>"vcyt-col-xs-4",
								__("4 Columns", 'js_composer' )=>"vcyt-col-xs-3",
								__("5 Columns", 'js_composer' )=>"vcyt-col-xs-15"
								),
							'std' => 'vcyt-col-xs-12',
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							"description" => __("Choose Mobile Columns Count", 'js_composer'),
						),
						array(
							'type' => 'num',
							'heading' => __( 'Description Length', 'js_composer' ),
							'param_name' => 'excerpt_length',
							'value' => '150',
							'min' => 0,
							'max' => 9000,
							'suffix' => '',
							'step' => 1,
							'description' => __( 'set Description length.default:150.If you set 0 no display Discription in fronted site', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Hide Media', 'js_composer' ),
							'param_name' => 'hide_media',
							'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
							'description' => __( 'If you check not display Media Image in feed.', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show filter', 'js_composer' ),
							'param_name' => 'filter',
							'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							'description' => __( 'Add Social Filter to top of the page.', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show Sorting Filter', 'js_composer' ),
							'param_name' => 'sort_filter',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'filter','value' => 'yes'),
							'description' => __( 'Display Sorting Filter.', 'js_composer' )
						),
						array(
							"type" => "dropdown",
							"heading" => __("Popup Content Style" , 'js_composer' ),
							"param_name" => "popup",
							"value" =>array(
								__("Style1", 'js_composer' )=>"p1",
								__("Style2", 'js_composer' )=>"p2"
								),
							"description" => __("Choose popup type for Social feed layout.", 'js_composer' ),
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show more', 'js_composer' ),
							'param_name' => 'loadmore',
							'std' => 'yes',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							'description' => __( 'add Show more feed button.', 'js_composer' ),
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Show more text', 'js_composer' ),
							'param_name' => 'loadmore_text',
							'dependency' => array('element' => 'loadmore','value' => 'yes'),
							'description' => __( 'add Show more button text.Default:Show More', 'js_composer' )
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Onload Date sorting', 'js_composer' ),
							'param_name' => 'date_sorting',
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							'description' => __( 'set Onload feed Date sorting.', 'js_composer' )
						),
						array(
							'type' => 'dropdown',
							'heading' => __( 'Feed load Effect', 'js_composer' ),
							'param_name' => 'effect',
							'value' => $animations,
							'dependency' => array('element' => 'post_type','value' => 'post_layout'),
							'description' => __( 'Select Feed load effect.', 'js_composer' )
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Extra class name', 'js_composer' ),
							'param_name' => 'svc_class',
							'holder' => 'div',
							'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Post Background Color', 'js_composer' ),
							'param_name' => 'pbgcolor',
							'description' => __( 'set post background color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Post hover Background Color', 'js_composer' ),
							'param_name' => 'pbghcolor',
							'description' => __( 'set post hover background color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Title Color', 'js_composer' ),
							'param_name' => 'tcolor',
							'description' => __( 'set Title color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Filter text Color', 'js_composer' ),
							'param_name' => 'ftcolor',
							'description' => __( 'set Filter Text color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Filter text Active Color', 'js_composer' ),
							'param_name' => 'ftacolor',
							'description' => __( 'set Filter Text Active color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Filter text Active Background Color', 'js_composer' ),
							'param_name' => 'ftabgcolor',
							'description' => __( 'set Filter Text Active Background color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Load more Loader and Text Color', 'js_composer' ),
							'param_name' => 'loder_color',
							'description' => __( 'set Load More Loader and Text color.', 'js_composer' ),
							'dependency' => array('element' => 'loadmore','value' => 'yes'),
							'group' => __('Color Setting', 'js_composer')
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Navigation and Pagination color', 'js_composer' ),
							'param_name' => 'car_navigation_color',
							'dependency' => array('element' => 'post_type','value' => 'carousel'),
							'description' => __( 'Set Navigation and pagination color.', 'js_composer' ),
							'group' => __('Color Setting', 'js_composer')
						)
					)
				) );
				
			}

		}

	}
	
	
	//instantiate the class
	$svc_social_layout = new svc_social_layout;
}
