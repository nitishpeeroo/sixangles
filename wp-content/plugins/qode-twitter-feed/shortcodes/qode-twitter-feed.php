<?php
/**
 * Class Twitter
 * @package SelectCore\Twitter\Shortcodes
 */
class QodeTwitterShortcode {
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qode_twitter_feed';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 *
	 */
	public function vcMap()
	{
		if (function_exists('vc_map')) {
			vc_map(array(
				'name' => 'Qode Twitter Feed',
				'base' => $this->base,
				'icon' => 'extended-custom-icon-qode icon-wpb-twitter-feed',
				'category' => 'by QODE',
				'params' => array(
					array(
						'type'			=> 'textfield',
						'heading'		=> 'User ID',
						'param_name'	=> 'user_id',
						'value'			=> '',
						'description'	=> ''
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> 'Number of Tweets',
						'param_name'	=> 'count',
						'description'	=> ''
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> 'Show tweet time',
						'param_name'	=> 'show_tweet_time',
						'value'			=> array(
							'No' => 'no',
							'Yes' => 'yes'
						),
						'description'	=> ''
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> 'Author Name Color',
						'param_name'	=> 'author_name_color',
						'value'			=> '',
						'group'			=> 'Design Options'
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> 'Screen Name and Date Color',
						'param_name'	=> 'sc_date_color',
						'value'			=> '',
						'group'			=> 'Design Options'
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> 'Text Color',
						'param_name'	=> 'text_color',
						'value'			=> '',
						'group'			=> 'Design Options'
					),
				)
			));
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'user_id'			=> 'normal',
			'count'				=> 'yes',
			'show_tweet_time'	=> 'yes',
			'author_name_color'	=> 'yes',
			'sc_date_color'		=> 'yes',
			'text_color'		=> 'yes'
		);

		$params = shortcode_atts($args, $atts);
		extract(shortcode_atts($args, $atts));

		$html                   = '';


		$user_id = !empty($user_id) ? $user_id : '';
		$count = !empty($count) ? $count : '';

		$twitter_api = QodeTwitterApi::getInstance();
		$name_style = $this->getTwitterNameStyle($params);
		$info_style = $this->getTwitterInfoStyle($params);
		$text_style = $this->getTwitterTextStyle($params);
		if($twitter_api->hasUserConnected()) {
			$response = $twitter_api->fetchTweets($user_id, $count);

			if($response->status) {
				if(is_array($response->data) && count($response->data)) {
					$html = '<div class="qode-twitter-feed-shortcode">';
						$html .= '<div class="qode-tfs-inner clearfix">';
							foreach($response->data as $tweet) {
								$html .= '<div class="qode-tfs-item">';
								$html .= '<div class="qode-tfs-item-inner">';
									$html .= '<div class="qode-tfs-image-info-holder clearfix">';
										$html .= '<div class="qode-tfs-image">';
											$html .= '<img src="'. esc_url($twitter_api->getHelper()->getBiggerProfileImageURL($tweet)) .'" alt="" />';
										$html .= '</div>';
										$html .= '<div class="qode-tfs-info-holder">';
											$html .= '<h5 class="qode-tfs-author-name" '. qode_twitter_get_inline_style($name_style) .'>';
												$html .=  wp_kses_post($twitter_api->getHelper()->getTweetAuthorName($tweet));
											$html .= '</h5>';
											$html .= '<div class="qode-tfs-info" '. qode_twitter_get_inline_style($info_style) .'>';
											$html .= '<span class="qode-tfs-author-screen-name">';
												$html .= wp_kses_post($twitter_api->getHelper()->getTweetAuthorScreenName($tweet));
											$html .= '</span>';
											if($show_tweet_time == 'yes') {
													$html .= '<span class="qode-tfs-time">';
														$html .= wp_kses_post($twitter_api->getHelper()->getTweetCreatedTime($tweet));
													$html .= '</span>';
											}
												$html .= '</div>';
											$html .= '</div>';
										$html .= '</div>';
									$html .= '<div class="qode-tfs-text"  '. qode_twitter_get_inline_style($text_style) .'>';
										$html .= wp_kses_post($twitter_api->getHelper()->getTweetText($tweet));
									$html .= '</div>';
								$html .= '</div>';
								$html .= '</div>';
							 }
						$html .= '</div>';
					$html .= '</div>';
 				}
			} else {
				$html .= esc_html($response->message);
			}
		} else {
			esc_html_e('It seams that you haven\'t connected with your Twitter account', 'qode-twitter-feed');
		}


		return $html;
	}

	private function getTwitterNameStyle($params){

		$style = array();

		if(!empty($params['author_name_color'])) {
			$style[] = 'color:'.$params['author_name_color'];
		}
		return implode(';', $style);
	}

	private function getTwitterInfoStyle($params){

		$style = array();

		if(!empty($params['sc_date_color'])) {
			$style[] = 'color:'.$params['sc_date_color'];
		}
		return implode(';', $style);
	}
	private function getTwitterTextStyle($params){

		$style = array();

		if(!empty($params['text_color'])) {
			$style[] = 'color:'.$params['text_color'];
		}
		return implode(';', $style);
	}
}