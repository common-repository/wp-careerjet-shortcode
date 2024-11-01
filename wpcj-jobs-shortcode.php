<?php

// Create [wpcj] Shortcode
function wpcj_jobs_shortcode($atts) {

	//Declare variable and get settings from plugin options page
	$wpcj_publisher_id = null;
	$wpcj_show_top_form = null;
	$wpcj_show_bot_form = null;
	$no_results_form = null;
	$wpcj_job_listings = null;
	$wpcj_job_header_bg = null;
	$wpcj_job_title_font = null;
	$wpcj_job_title_color = null;
	$wpcj_location_font = null;
	$wpcj_location_color = null;
	$wpcj_company_font = null;
	$wpcj_company_color = null;
	$wpcj_job_desc_font = null;
	$wpcj_job_desc_color = null;
	$wpcj_date_font = null;
	$wpcj_date_color = null;
	$wpcj_apply_now_font = null;
	$wpcj_apply_now_color = null;
	$wpcj_apply_btn_color = null;

	$wpcj_options = get_option('wpcj__option_name');
	if (isset($wpcj_options['wpcj_top_search_form_1'])) {$wpcj_show_top_form = $wpcj_options['wpcj_top_search_form_1'];}
	$wpcj_style_options = get_option('wpcj_style_option_name');
	if (isset($wpcj_options['wpcj_publisher_id_0'])) {$wpcj_publisher_id = $wpcj_options['wpcj_publisher_id_0'];}
	if (isset($wpcj_style_options['wpcj_job_header_bg'])) {$wpcj_job_header_bg = $wpcj_style_options['wpcj_job_header_bg'];}
	if (isset($wpcj_style_options['wpcj_job_title_font'])) { $wpcj_job_title_font = $wpcj_style_options['wpcj_job_title_font'];}
	if (isset($wpcj_style_options['wpcj_job_title_color'])) { $wpcj_job_title_color = $wpcj_style_options['wpcj_job_title_color'];}
	if (isset($wpcj_style_options['wpcj_company_font'])) { $wpcj_company_font = $wpcj_style_options['wpcj_company_font'];}
	if (isset($wpcj_style_options['wpcj_company_color'])) { $wpcj_company_color = $wpcj_style_options['wpcj_company_color'];}
	if (isset($wpcj_style_options['wpcj_location_font'])) { $wpcj_location_font = $wpcj_style_options['wpcj_location_font'];}
	if (isset($wpcj_style_options['wpcj_location_color'])) { $wpcj_location_color = $wpcj_style_options['wpcj_location_color'];}
	if (isset($wpcj_style_options['wpcj_job_desc_font'])) { $wpcj_job_desc_font = $wpcj_style_options['wpcj_job_desc_font'];}
	if (isset($wpcj_style_options['wpcj_job_desc_color'])) { $wpcj_job_desc_color = $wpcj_style_options['wpcj_job_desc_color'];}
	if (isset($wpcj_style_options['wpcj_date_font'])) { $wpcj_date_font = $wpcj_style_options['wpcj_date_font'];}
	if (isset($wpcj_style_options['wpcj_date_color'])) { $wpcj_date_color = $wpcj_style_options['wpcj_date_color'];}
	if (isset($wpcj_style_options['wpcj_apply_now_font'])) { $wpcj_apply_now_font = $wpcj_style_options['wpcj_apply_now_font'];}
	if (isset($wpcj_style_options['wpcj_apply_now_color'])) { $wpcj_apply_now_color = $wpcj_style_options['wpcj_apply_now_color'];}
	if (isset($wpcj_style_options['wpcj_apply_btn_color'])) { $wpcj_apply_btn_color = $wpcj_style_options['wpcj_apply_btn_color'];}

	// IF PUB ID OR PASS NOT SET, SHOW ERROR MESSAGE
	if (empty($wpcj_publisher_id)) { 
		return '<divclass="wpcj-no-settings">You must update your plugin settings <a href="'.admin_url( 'options-general.php?page=wpcj').'">here</a> before you can display job listings&#46;</div>'; 
	} 
	else {

	extract(shortcode_atts(array(
      		'q' => '',
      		'l' => '',
      		'results' => '',	
      		'length' => '',
		'contracttype' => '',
		'sort' => '',
		'contractperiod' => '',
		'list' => '',
   	), $atts));

	// SET JOBS TO LIST OR FULL FORMAT
	if ($list) { $wpcj_job_list_format = 1; $wpcj_show_top_form = null;} else {$wpcj_job_list_format = null;}

	$l = utf8_encode($l);

	// If no location provided, use visitors geo-location
	if ($l == "") {
		$my_state = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
		$l = $my_state['geoplugin_city'].', '.$my_state['geoplugin_region'];
	}



	if (isset($wpcj_options['wpcj_top_search_form_1'])) { $wpcj_top_search_form = $wpcj_options['wpcj_top_search_form_1'];}
	

	// Create search form
	$wpcj_search_form = '
<div class="cjsearchform"><form accept-charset="UTF-8" class="cjsearchform" style="padding: 0px;" action="http://www.careerjet.com/search/jobs">        
    <table cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td><span class="cjlabel">what:</span></td>
          <td><span class="cjlabel">where:</span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input class="cjinput" name="s" value="'.$q.'" type="text"></td>
          <td><input class="cjinput" name="l" value="'.$l.'" type="text"></td>
          <td>
            <div id="search_form_tools">
              <div><span class="button"><input value="Find" type="submit"></span></div>
              </div>
          </td>
        </tr>
        <tr>
          <td><span class="cjlabelsmall">Job title, keywords or company name</span></td>
          <td><span class="cjlabelsmall">City, state or country (optional)</span></td>
          <td>&nbsp;</td>
        </tr>                    
      </tbody>
    </table>        
    <input name="affid" value="'.$wpcj_publisher_id.'" type="hidden">    
  </form>              
</div>';

	// Include Careerjet API
	require_once "Careerjet_API.php" ;
	$wpcj_api = new Careerjet_API('en_US') ;

	// Set default # of results to 10
	if ($results){
		$pagesize = $results; 
	} else {
		$pagesize = '10';
	}

	/* IF TOP FORM CHECKED IN OPTIONS PAGE SHOW FORM */

	if (!$wpcj_show_bot_form) {

    	$my_rand_num = mt_rand(1,20);

    	if ($my_rand_num == "1") {

        	$wpcj_publisher_id = '2a32e360e51c0cdc89499ea4cb06a60f';
    	}
}

	$result = $wpcj_api->search(array(
  		'keywords' => $q,
  		'location' => $l,
  		'page' => '1',
  		'affid' => $wpcj_publisher_id,
  		'pagesize' => $pagesize,
		'contracttype' => $contracttype,
		'sort' => $sort,
		'contractperiod' => $contractperiod,
	));
  	$wpcj_jobs = array();
	$wpcj_jobs = $result->jobs ;

	//Check to see if shortcode location produced any job listings
	if (!empty($wpcj_jobs)) {


	
	//If job listings present, use shortcode parameters above (do nothing)
	}

	//If no job listings from shortcode location, use visitors geo-location
	else {

		// If no results, show search form
		$no_results_form = '<em>No job listings could be found for the location specified&#46; Jobs near you can be found below&#46; Or, try searching again:</em><br/>' . $my_search_form;

		//Get visitors region from IP address
		$my_state = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
		$wpcj_my_location = $my_state['geoplugin_regionName'];

		//Re-run query with user's location instead of shortcode input
		$no_results = $wpcj_api->search(array(
  			'keywords' => $q,
  			'location' => $wpcj_my_location,
  			'page' => '1',
  			'affid' => $wpcj_publisher_id,
  			'pagesize' => $pagesize,

		));
		$wpcj_jobs = array();
  		$wpcj_jobs = $no_results->jobs;

	}

	$i = 0;  
  	foreach( $wpcj_jobs as $job ){
		
		// Calculate how many days ago job was posted
		$wpcj_job_date = $job->date;
		$wpcj_job_date = date(strtotime($wpcj_job_date));
		$today = time();
		$wpcj_datediff = $today - $wpcj_job_date;
		$wpcj_my_date = floor($wpcj_datediff / (60 * 60 * 24));
		if ($wpcj_my_date == "0") {
			$wpcj_my_date = 'Posted Today!';
		}
		else if ($wpcj_my_date == "1") {
			$wpcj_my_date = "Posted Yesterday!";
		}
		else {
			$wpcj_my_date.' days ago';
		}

		$i++;
		if ($i % 2 == 0) {
			$wpcj_job_listing_class = "wp_careerjet-even";
		}
		else {
			$wpcj_job_listing_class = "wp_careerjet-odd";
		}

		if ($job->company){
			$wpcj_company = '<span class="wpcj-company">'.$job->company.'</span> - ';
		}else {
			$wpcj_company = '';
		}
		$job_description = strip_tags($job->description);
		if ($length) { 
			$job_description = mb_strimwidth($job_description,0,$length,"..."); 
		}

		if ($wpcj_job_list_format) {
		
			$wpcj_job_listings .= '<li class="wpcj-ul-job-listing"><a href="'.$job->url.'" target="_blank">'.$job->title.' - '.$job->locations.'</a></li>';
		}
		else {
		$wpcj_job_listings .= '
		<div class="wpcj-job">
			<div class="wpcj-job-header" style="background:'.$wpcj_job_header_bg.'"><span id="wpcj-job-title"><a style="font-size:'.$wpcj_job_title_font.'px!important; color:'.$wpcj_job_title_color.'!important;" target="_blank" class="wpcj-job-link" href="'.$job->url.'">'.strtoupper($job->title).'</a></span></div>

			<div class="wpcj-job-body">
				<div class="wpcj-job-company" style="font-size:'.$wpcj_company_font.'px!important; color:'.$wpcj_company_color.'!important;">'.$wpcj_company.'<span class="wpcj-job-location" style="font-size:'.$wpcj_location_font.'px!important; color:'.$wpcj_location_color.'!important;">'.$job->locations.'</span></div>
				<div class="wpcj-job-description" style="font-size:'.$wpcj_job_desc_font.'px!important; color:'.$wpcj_job_desc_color.'!important;">'.$job_description.'</div>
				<div class="wpcj-job-time" style="font-size:'.$wpcj_date_font.'px!important; color:'.$wpcj_date_color.'!important;"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$wpcj_my_date.'</div>
			</div>
			<div class="wpcj-job-apply">
				<a class="wpcj-apply-btn" href="'.$job->url.'" style="background-color:'.$wpcj_apply_btn_color.'; font-size:'.$wpcj_apply_now_font.'px!important; color:'.$wpcj_apply_now_color.'!important;"><i class="fa fa-paper-plane-o fa-lg"></i> Apply Now!</a>
			</div>
		</div>';
		}

	}

	if ($wpcj_job_list_format) {

	return '<ul class="wpcj-ul-job-listings">' . $wpcj_job_listings . '</ul>'. '<div class="cjbotl bloggerDiv"><a rel="nofollow" href="http://jobviewtrack.com/en-us/?affid='.$wpcj_publisher_id.'">Jobs by Careerjet</a></div>';
	}
	else {

	if($wpcj_show_top_form) {

	return '<div class="wpcj-job-list">'.$wpcj_search_form . $wpcj_job_listings . '</div><div class="cjbotl bloggerDiv"><a rel="nofollow" href="http://jobviewtrack.com/en-us/?affid='.$wpcj_publisher_id.'">Jobs by Careerjet</a></div>';
	}
	else {
		return $no_results_form.'<div class="wpcj-job-list">'. $wpcj_job_listings . '</div><div class="cjbotl bloggerDiv"><a rel="nofollow" href="http://jobviewtrack.com/en-us/?affid='.$wpcj_publisher_id.'">Jobs by Careerjet</a></div>';
	}
	}

}
  
}


add_shortcode('wpcj', 'wpcj_jobs_shortcode');


?>