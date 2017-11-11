function svc_social_add_animation($this, animation) {
	$this.removeClass('animated '+animation).addClass('animated '+animation).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function (e) {
		$this.css({
			'-webkit-animation':'none',
	   '-webkit-animation-name':'none',
			   'animation-name':'none',
					'animation':'none'
		});
		$this.removeClass('animated '+animation).removeAttr('vc-social-effect');
	});
}
function svc_social_add_animation(){
	jQuery('[vc-social-effect]').each(function () {
		var animation_style = jQuery(this).attr('vc-social-effect');
		svc_social_add_animation(jQuery(this), animation_style);
	});
}