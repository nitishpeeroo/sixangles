<?php
$twitterShortcode = new QodeTwitterShortcode();
add_shortcode($twitterShortcode->getBase(), array($twitterShortcode, 'render'));