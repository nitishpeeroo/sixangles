<?php

if(!defined('ABSPATH')) exit;

class QodeTwitterHelper {
    public function getTweetText($tweet) {
        $protocol = is_ssl() ? 'https' : 'http';
        if(!empty($tweet['text'])) {
            //add links around https or http parts of text
            $tweet['text'] = preg_replace('/(https?)\:\/\/([a-z0-9\/\.\&\#\?\-\+\~\_\,]+)/i', '<a target="_blank" href="'.('$1://$2').'">$1://$2</a>', $tweet['text']);

            //add links around @mentions
            $tweet['text'] = preg_replace('/\@([a-aA-Z0-9\.\_\-]+)/i', '<a target="_blank" href="'.esc_url($protocol.'://twitter.com/$1').'">@$1</a>', $tweet['text']);

            return $tweet['text'];
        }

        return '';
    }

    public function getTweetTime($tweet) {
        if(!empty($tweet['created_at'])) {
            return human_time_diff(strtotime($tweet['created_at']), current_time('timestamp') ).' '.esc_html__('ago', 'qode-twitter-feed');
        }

        return '';
    }

	public function getTweetCreatedTime($tweet) {
		if(!empty($tweet['created_at'])) {
			return date("M d", strtotime($tweet['created_at']));
		}

		return '';
	}
	public function getTweetAuthorName($tweet) {
		if(!empty($tweet['user']['name'])) {
			return $tweet['user']['name'];
		}

		return '';
	}

	public function getTweetAuthorScreenName($tweet) {
		if(!empty($tweet['user']['screen_name'])) {
			return '@'.$tweet['user']['screen_name'];
		}

		return '';
	}

    public function getTweetURL($tweet) {
        if(!empty($tweet['id_str']) && $tweet['user']['screen_name']) {
            return 'https://twitter.com/'.$tweet['user']['screen_name'].'/statuses/'.$tweet['id_str'];
        }

        return '#';
    }

	public function getProfileImageURL($tweet) {

		if(!empty($tweet['id_str'])) {
			if($tweet['user']['profile_image_url'] && !is_ssl()) {
				return $tweet['user']['profile_image_url'];
			} elseif ($tweet['user']['profile_image_url_https'] && is_ssl()){
				return $tweet['user']['profile_image_url_https'];
			}
		}

		return '';
	}

	public function getBiggerProfileImageURL($tweet) {

		$image_url = $this->getProfileImageURL($tweet);
		if(!empty($image_url)) {
			$image_url = str_replace('_normal', '_bigger', $image_url);
		}

		return $image_url;
	}

}