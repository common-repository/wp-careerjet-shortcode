<?php

// Create [wpcj_searchbox] Shortcode
function wpcj_searchbox($atts) {

	$wpcj_options = get_option('wpcj__option_name');
	$wpcj_publisher_id = $wpcj_options['wpcj_publisher_id_0'];

$wpcj_searchbox = '<a name="cjsearchformanchor"></a>
<div class="cjsearchform">
<script language="javascript" type="text/javascript" src="http://www.careerjet.com/partners/js_searchform.html?format=1&nfr=1&affid='.$wpcj_publisher_id.'"></script>
</div>';

return $wpcj_searchbox;
  
}

add_shortcode('wpcj_searchbox', 'wpcj_searchbox');

?>