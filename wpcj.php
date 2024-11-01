<?php
/*
Plugin Name: WP Careerjet Shortcode
Plugin URI:  http://www.blmarketingllc.com/job-jetstream
Description: Add Careerjet publisher job listings and search boxes to your website with simple shortcodes.
Version:     1.0
Author:      B & L Marketing
Author URI:  http://www.blmarketingllc.com
License:     GPL2f
License URI: https://www.gnu.org/licenses/gpl-2.0.html

*/

class wpcj {
	private $wpcj__options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wpcj__add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'wpcj__page_init' ) );
	}

	public function wpcj__add_plugin_page() {
		add_options_page(
			'WP Careerjet Shortcode', // page_title
			'WP Careerjet Shortcode', // menu_title
			'manage_options', // capability
			'wpcj', // menu_slug
			array( $this, 'wpcj__create_admin_page' ) // function
		);
	}

	
	public function wpcj__create_admin_page() {

 	// check user capabilities
 	if ( !current_user_can( 'manage_options' ) ) {
		echo "YOU DO NOT HAVE PERMISSION TO MANAGE THESE OPTIONS. BAD KITTY!";
 		return;
 	}

		$this->wpcj__options = get_option( 'wpcj__option_name' ); 
		$this->wpcj_style_options = get_option( 'wpcj_style_option_name' );

	// DEFINE STYLE VARIABLES
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


	$wpcj_style_options = get_option('wpcj_style_option_name');
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
	if (isset($wpcj_style_options['wpcj_apply_now_color'])) { $wpcj_apply_btn_color = $wpcj_style_options['wpcj_apply_btn_color'];}
	



?>


	<a name="top"></a>
	<div class="wpcj-wrap">
		<div style="max-width:500px; margin:20px auto;"><img style="max-width:100%; height:auto;" src="<?php echo plugins_url( 'img/wp-careerjet-logo.png' , __FILE__ );?>" /></div>

		<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_options'; ?>

		<h2 class="nav-tab-wrapper" id="wpcj-tab-wrapper">
    			<a href="?page=wpcj&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>">General Options</a>
			<a href="?page=wpcj&tab=styles" class="nav-tab <?php echo $active_tab == 'styles' ? 'nav-tab-active' : ''; ?>">Styling</a>
    			<a href="?page=wpcj&tab=shortcode-generator" class="nav-tab <?php echo $active_tab == 'shortcode-generator' ? 'nav-tab-active' : ''; ?>">Shortcode Generator</a>
    			<a href="?page=wpcj&tab=howto" class="nav-tab <?php echo $active_tab == 'howto' ? 'nav-tab-active' : ''; ?>">How To</a>
		</h2>

		<form method="post" action="options.php" id="wpcj-options-form">

		<?php

		if( $active_tab == 'general_options' ) { ?>
			<?php add_thickbox(); ?>
			
			<h2>Careerjet Settings</h2>
			<p>Your Careerjet Affiliate ID (affid) can be found in the top right of your. <a href="http://www.careerjet.com/partners/?ak=2a32e360e51c0cdc89499ea4cb06a60f" target="_blank">Publisher Account</a></p>

			 
			<?
			settings_fields( 'wpcj__option_group' );
			do_settings_sections( 'wpcj-admin' );
			echo '<hr/><h2>Sharing is Caring</h2>';
			echo '<p>Want to thank me for developing this free plugin? By checking the box you agree to replace your Careerjet affiliate ID with the plugin author Careerjet affiliate ID for 1% of all job listing pageviews. Thanks!</p>';

			settings_fields( 'wpcj__option_group' );
			do_settings_sections( 'wpcj-admin_2' );
			submit_button();

		}
		else if ( $active_tab == 'shortcode-generator' ){
		
			include 'wpcj-create-shortcode.php';

		}
		else if ( $active_tab == 'styles' ){

			include 'js/wpcj-clear-form.js';
			echo '
			<div style="max-width:400px;float:left;">';      
				settings_fields( 'wpcj_style_option_group' );
				do_settings_sections( 'wpcj-styles' );
				submit_button();
				echo '<input name="submit" id="submit" class="button button-primary" value="Clear All Styles" onclick="wpcjclearForm(this.form);" type="submit">';

			echo '</div>';


			// SHOW USER THEIR STYLES
			echo '
			<div style="float:left; margin: 0 20px 20px 20px; max-width:500px;">
				<h3>Your Styles in Action <span style="font-size:10px;">(save to see changes)</span></h3>
				<div class="list-group">
					<div class="list-group-item">
						<div style="background:'.$wpcj_job_header_bg.'" class="wpcj-job-header"><a style="font-size:'.$wpcj_job_title_font.'px!important; color:'.$wpcj_job_title_color.'!important;" target="_blank" class="wpcj-job-link" href="#">Job Title</a></div>

					<div class="wpcj-job-body">
						<div class="wpcj-job-company" style="font-size:'.$wpcj_company_font.'px!important; color:'.$wpcj_company_color.'!important;">Company - <span class="wpcj-job-location" style="font-size:'.$wpcj_location_font.'px!important; color:'.$wpcj_location_color.'!important;">City, ST</span></div>
						<div class="wpcj-job-description" style="font-size:'.$wpcj_job_desc_font.'px!important; color:'.$wpcj_job_desc_color.'!important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dui sapien, pellentesque nec imperdiet id, viverra ut metus. Etiam ut orci id turpis malesuada sodales sit amet nec urna.</div>
						<div class="wpcj-job-time" style="font-size:'.$wpcj_date_font.'px!important; color:'.$wpcj_date_color.'!important;"><i class="fa fa-clock-o" aria-hidden="true"></i> 1 Day Ago</div>
					</div>
					<div class="wpcj-job-apply">
						<button class="wpcj-apply-btn btn" style="background-color:'.$wpcj_apply_btn_color.'; font-size:'.$wpcj_apply_now_font.'px!important; color:'.$wpcj_apply_now_color.'!important;"><i class="fa fa-paper-plane-o fa-lg"></i> Apply Now!</button>
					</div>
				</div>
			</div>';


			// SHOW USER DEFAULT STYLES
			echo '
			<div style="float:left; max-width:500px;">
				<h3>Default Styles</h3>
				<div class="list-group">
					<div class="list-group-item">
						<div class="wpcj-job-header"><a target="_blank" class="wpcj-job-link" href="#">Job Title</a></div>

					<div class="wpcj-job-body">
						<div class="wpcj-job-company">Company - <span class="wpcj-job-location">City, ST</span></div>
						<div class="wpcj-job-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dui sapien, pellentesque nec imperdiet id, viverra ut metus. Etiam ut orci id turpis malesuada sodales sit amet nec urna.</div>
						<div class="wpcj-job-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 1 Day Ago</div>
					</div>
					<div class="wpcj-job-apply">
						<button class="wpcj-apply-btn btn"><i class="fa fa-paper-plane-o fa-lg"></i> Apply Now!</button>
					</div>
				</div>
			</div>';


	} 

	else if ( $active_tab == 'howto' ){

		// Include all How To Content
		include 'wpcj-how-to.php';
	} 



				?>
			</form>
	</div>
	<?php }

	public function wpcj__page_init() {

		// GENERAL OPTIONS SECTION
		add_settings_section(
			'wpcj__setting_section', // id
			'', // title
			array( $this, 'wpcj__section_info' ), // callback
			'wpcj-admin' // page
		);

		register_setting(
			'wpcj__option_group', // option_group
			'wpcj__option_name', // option_name
			array( $this, 'wpcj__sanitize' ) // sanitize_callback
		);

		add_settings_field(
			'wpcj_publisher_id_0', // id
			'Careerjet Publisher ID', // title
			array( $this, 'wpcj_publisher_id_0_callback' ), // callback
			'wpcj-admin', // page
			'wpcj__setting_section' // section
		);

		// OTHER OPTIONS SECTION
		add_settings_section(
			'wpcj__setting_section_2', // id
			'', // title
			array( $this, 'wpcj__section_info' ), // callback
			'wpcj-admin_2' // page
		);

		add_settings_field(
			'wpcj_top_search_form_1', // id
			'Top Search Form', // title
			array( $this, 'wpcj_top_search_form_1_callback' ), // callback
			'wpcj-admin', // page
			'wpcj__setting_section' // section
		);

		add_settings_field(
			'wpcj_bottom_search_form_2', // id
			'Show Plugin Support', // title
			array( $this, 'wpcj_bottom_search_form_2_callback' ), // callback
			'wpcj-admin_2', // page
			'wpcj__setting_section_2' // section
		);

		add_settings_field(
			'wpcj_percentage_3', // id
			'Percentage', // title
			array( $this, 'wpcj_percentage_3_callback' ), // callback
			'wpcj-admin_2', // page
			'wpcj__setting_section_2' // section
		);

		// STYLING SECTION
		add_settings_section(
			'wpcj_style_setting_section', // id
			'Styling', // title
			array( $this, 'wpcj_style_section_info' ), // callback
			'wpcj-styles' // page
		);

		register_setting(
			'wpcj_style_option_group', // option_group
			'wpcj_style_option_name', // option_name
			array( $this, 'wpcj__sanitize' ) // sanitize_callback
		);

		add_settings_field(
			'wpcj_job_header_bg', // id
			'Job Header BG Color', // title
			array( $this, 'wpcj_job_header_bg_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_job_title_font', // id
			'Job Title Font Size', // title
			array( $this, 'wpcj_job_title_font_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_job_title_color', // id
			'Job Title Color', // title
			array( $this, 'wpcj_job_title_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);
		add_settings_field(
			'wpcj_company_font', // id
			'Company Font Size', // title
			array( $this, 'wpcj_company_font_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_company_color', // id
			'Company Color', // title
			array( $this, 'wpcj_company_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_location_font', // id
			'Location Font Size', // title
			array( $this, 'wpcj_location_font_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_location_color', // id
			'Location Color', // title
			array( $this, 'wpcj_location_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_job_desc_font', // id
			'Job Description Font Size', // title
			array( $this, 'wpcj_job_desc_font_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_job_desc_color', // id
			'Job Description Color', // title
			array( $this, 'wpcj_job_desc_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_date_font', // id
			'Date Font Size', // title
			array( $this, 'wpcj_date_font_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_date_color', // id
			'Date Color', // title
			array( $this, 'wpcj_date_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_apply_now_font', // id
			'Apply Now Font Size', // title
			array( $this, 'wpcj_apply_now_font_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_apply_now_color', // id
			'Apply Now Font Color', // title
			array( $this, 'wpcj_apply_now_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);

		add_settings_field(
			'wpcj_apply_btn_color', // id
			'Apply Now Button Color', // title
			array( $this, 'wpcj_apply_btn_color_callback' ), // callback
			'wpcj-styles', // page
			'wpcj_style_setting_section' // section
		);


	}


	public function wpcj__sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['wpcj_publisher_id_0'] ) ) {
			$sanitary_values['wpcj_publisher_id_0'] = sanitize_text_field( $input['wpcj_publisher_id_0'] );
		}


		if ( isset( $input['wpcj_top_search_form_1'] ) ) {
			$sanitary_values['wpcj_top_search_form_1'] = $input['wpcj_top_search_form_1'];
		}

		if ( isset( $input['wpcj_bottom_search_form_2'] ) ) {
			$sanitary_values['wpcj_bottom_search_form_2'] = $input['wpcj_bottom_search_form_2'];
		}

		if ( isset( $input['wpcj_percentage_3'] ) ) {
			$sanitary_values['wpcj_percentage_3'] = $input['wpcj_percentage_3'];
		}

		// STYLING SECTION
		if ( isset( $input['wpcj_job_header_bg'] ) ) {
			$sanitary_values['wpcj_job_header_bg'] = $input['wpcj_job_header_bg'];
		}


		if ( isset( $input['wpcj_job_title_font'] ) ) {
			$sanitary_values['wpcj_job_title_font'] = $input['wpcj_job_title_font'];
		}

		if ( isset( $input['wpcj_job_title_color'] ) ) {
			$sanitary_values['wpcj_job_title_color'] = $input['wpcj_job_title_color'];
		}

		if ( isset( $input['wpcj_company_font'] ) ) {
			$sanitary_values['wpcj_company_font'] = $input['wpcj_company_font'];
		}

		if ( isset( $input['wpcj_company_color'] ) ) {
			$sanitary_values['wpcj_company_color'] = $input['wpcj_company_color'];
		}

		if ( isset( $input['wpcj_job_desc_font'] ) ) {
			$sanitary_values['wpcj_job_desc_font'] = $input['wpcj_job_desc_font'];
		}

		if ( isset( $input['wpcj_job_desc_color'] ) ) {
			$sanitary_values['wpcj_job_desc_color'] = $input['wpcj_job_desc_color'];
		}

		if ( isset( $input['wpcj_location_font'] ) ) {
			$sanitary_values['wpcj_location_font'] = $input['wpcj_location_font'];
		}

		if ( isset( $input['wpcj_location_color'] ) ) {
			$sanitary_values['wpcj_location_color'] = $input['wpcj_location_color'];
		}

		if ( isset( $input['wpcj_date_font'] ) ) {
			$sanitary_values['wpcj_date_font'] = $input['wpcj_date_font'];
		}

		if ( isset( $input['wpcj_date_color'] ) ) {
			$sanitary_values['wpcj_date_color'] = $input['wpcj_date_color'];
		}

		if ( isset( $input['wpcj_apply_now_font'] ) ) {
			$sanitary_values['wpcj_apply_now_font'] = $input['wpcj_apply_now_font'];
		}

		if ( isset( $input['wpcj_apply_now_color'] ) ) {
			$sanitary_values['wpcj_apply_now_color'] = $input['wpcj_apply_now_color'];
		}

		if ( isset( $input['wpcj_apply_btn_color'] ) ) {
			$sanitary_values['wpcj_apply_btn_color'] = $input['wpcj_apply_btn_color'];
		}

		return $sanitary_values;
	}

	public function wpcj__section_info() {


	}

	public function wpcj_style_section_info() {


	}


	public function wpcj_publisher_id_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="wpcj__option_name[wpcj_publisher_id_0]" id="wpcj_publisher_id_0" value="%s">',
			isset( $this->wpcj__options['wpcj_publisher_id_0'] ) ? esc_attr( $this->wpcj__options['wpcj_publisher_id_0']) : ''
		);
	}


	public function wpcj_top_search_form_1_callback() {
		printf(
			'<input type="checkbox" name="wpcj__option_name[wpcj_top_search_form_1]" id="wpcj_top_search_form_1" value="wpcj_top_search_form_1" %s> <label for="wpcj_top_search_form_1">Check to include search form above listings</label>',
			( isset( $this->wpcj__options['wpcj_top_search_form_1'] ) && $this->wpcj__options['wpcj_top_search_form_1'] === 'wpcj_top_search_form_1' ) ? 'checked' : ''
		);
	}

	public function wpcj_bottom_search_form_2_callback() {
		printf(
			'<input type="checkbox" name="wpcj__option_name[wpcj_bottom_search_form_2]" id="wpcj_bottom_search_form_2" value="wpcj_bottom_search_form_2" %s> <label for="wpcj_bottom_search_form_2">Check to profit share with plugin author for percentage below (1&#37; if checked and left blank) OR <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=N2JLLWPN37UN4">donate here</a>.</label>',
			( isset( $this->wpcj__options['wpcj_bottom_search_form_2'] ) && $this->wpcj__options['wpcj_bottom_search_form_2'] === 'wpcj_bottom_search_form_2' ) ? 'checked' : ''
		);
	}

	public function wpcj_percentage_3_callback() {
		printf(
			'<input class="" type="text" name="wpcj__option_name[wpcj_percentage_3]" id="wpcj_percentage_3" value="%s" size="2" maxlength="2">&#37;',
			isset( $this->wpcj__options['wpcj_percentage_3'] ) ? esc_attr( $this->wpcj__options['wpcj_percentage_3']) : ''
		);
	}

	// STYLE FIELDS

	public function wpcj_job_header_bg_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_job_header_bg]" id="wpcj_job_header_bg" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_job_header_bg'] ) ? esc_attr( $this->wpcj_style_options['wpcj_job_header_bg']) : ''
		);
	}

	public function wpcj_job_title_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_job_title_color]" id="wpcj_job_title_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_job_title_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_job_title_color']) : ''
		);
	}

	public function wpcj_job_title_font_callback() {
		printf(
			'<input class="" type="text" name="wpcj_style_option_name[wpcj_job_title_font]" id="wpcj_job_title_font" value="%s" size="2" maxlength="2"> px',
			isset( $this->wpcj_style_options['wpcj_job_title_font'] ) ? esc_attr( $this->wpcj_style_options['wpcj_job_title_font']) : ''
		);
	}

	public function wpcj_company_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_company_color]" id="wpcj_company_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_company_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_company_color']) : ''
		);
	}

	public function wpcj_company_font_callback() {
		printf(
			'<input class="" type="text" name="wpcj_style_option_name[wpcj_company_font]" id="wpcj_company_font" value="%s" size="2" maxlength="2"> px',
			isset( $this->wpcj_style_options['wpcj_company_font'] ) ? esc_attr( $this->wpcj_style_options['wpcj_company_font']) : ''
		);
	}

	public function wpcj_job_desc_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_job_desc_color]" id="wpcj_job_desc_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_job_desc_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_job_desc_color']) : ''
		);
	}

	public function wpcj_job_desc_font_callback() {
		printf(
			'<input class="" type="text" name="wpcj_style_option_name[wpcj_job_desc_font]" id="wpcj_job_desc_font" value="%s" size="2" maxlength="2"> px',
			isset( $this->wpcj_style_options['wpcj_job_desc_font'] ) ? esc_attr( $this->wpcj_style_options['wpcj_job_desc_font']) : ''
		);
	}

	public function wpcj_location_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_location_color]" id="wpcj_location_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_location_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_location_color']) : ''
		);
	}

	public function wpcj_location_font_callback() {
		printf(
			'<input class="" type="text" name="wpcj_style_option_name[wpcj_location_font]" id="wpcj_location_font" value="%s" size="2" maxlength="2"> px',
			isset( $this->wpcj_style_options['wpcj_location_font'] ) ? esc_attr( $this->wpcj_style_options['wpcj_location_font']) : ''
		);
	}

	public function wpcj_date_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_date_color]" id="wpcj_date_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_date_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_date_color']) : ''
		);
	}

	public function wpcj_date_font_callback() {
		printf(
			'<input class="" type="text" name="wpcj_style_option_name[wpcj_date_font]" id="wpcj_date_font" value="%s" size="2" maxlength="2"> px',
			isset( $this->wpcj_style_options['wpcj_date_font'] ) ? esc_attr( $this->wpcj_style_options['wpcj_date_font']) : ''
		);
	}

	public function wpcj_apply_now_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_apply_now_color]" id="wpcj_apply_now_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_apply_now_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_apply_now_color']) : ''
		);
	}

	public function wpcj_apply_btn_color_callback() {
		printf(
			'<input class="wpcj-color-picker" type="text" name="wpcj_style_option_name[wpcj_apply_btn_color]" id="wpcj_apply_btn_color" value="%s" size="6" maxlength="6">',
			isset( $this->wpcj_style_options['wpcj_apply_btn_color'] ) ? esc_attr( $this->wpcj_style_options['wpcj_apply_btn_color']) : ''
		);
	}

	public function wpcj_apply_now_font_callback() {
		printf(
			'<input class="" type="text" name="wpcj_style_option_name[wpcj_apply_now_font]" id="wpcj_apply_now_font" value="%s" size="2" maxlength="2"> px',
			isset( $this->wpcj_style_options['wpcj_apply_now_font'] ) ? esc_attr( $this->wpcj_style_options['wpcj_apply_now_font']) : ''
		);
	}


}


if ( is_admin() )
	$wpcj_ = new wpcj();


// INCLUDE JOBS SHORTCODE FILE
include 'wpcj-jobs-shortcode.php';

// INCLUDE SEARCHBOX SHORTCODE
include 'wpcj-searchbox-shortcode.php';



/* USE PLUGIN STYLESHEET FOR JOB LISTINGS */
function wpcj_custom_styles() {
	$wpcj_plugin_url = plugin_dir_url( __FILE__ );
        wp_enqueue_style( 'wpcj_main_styles', $wpcj_plugin_url . 'wpcj-styles.css', false, '1.0.0' );
        wp_enqueue_style( 'wpcj_font_awesome', $wpcj_plugin_url . 'fonts/font-awesome.min.css', false, '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'wpcj_custom_styles', 9999 );


/* ADD SETTINGS LINK TO PLUGIN PAGE */

function wpcj_add_action_links ( $links ) {
	$mylinks = array(
 		'<a href="' . admin_url( 'options-general.php?page=wpcj' ) . '">Settings</a>',
 	);
	return array_merge( $links, $mylinks );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpcj_add_action_links' );

// ADD ERROR MESSAGE

function wpcj_admin_notice__error() {
	$class = 'notice notice-error is-dismissible';
	$message = __( 'You must provide the required WP Careerjet Shortcode settings before using.', 'sample-text-domain' );
	$wpcj_options = get_option('wpcj__option_name');
	$check_pub_id = $wpcj_options['wpcj_publisher_id_0'];

	if(!$check_pub_id) {
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
	}
}
add_action( 'admin_notices', 'wpcj_admin_notice__error' );


add_action( 'admin_enqueue_scripts', 'wpcj_load_admin_styles');
function wpcj_load_admin_styles() {
	$wpcj_plugin_url = plugin_dir_url( __FILE__ );
        wp_enqueue_style( 'wpcj_admin_styles', $wpcj_plugin_url . 'wpcj-styles.css', false, '1.0.0' );
    	wp_enqueue_style( 'wp-color-picker' );
   	wp_enqueue_script( 'wpcj_admin_color_picker', plugins_url('js/wpcj-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
        wp_enqueue_style( 'wpcj_admin_font_awesome', $wpcj_plugin_url . 'fonts/font-awesome.min.css', false, '1.0.0' );
}

// COLOR PICKER
function wpcj_color_picker_assets($hook_suffix) {
	$wpcj_plugin_url = plugin_dir_url( __FILE__ );
    	wp_enqueue_style( 'wp-color-picker' );
   	wp_enqueue_script( 'wpcj-color-picker', plugins_url('js/wpcj-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
        wp_enqueue_style( 'wpcj_font_awesome', $wpcj_plugin_url . 'fonts/font-awesome.min.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'wpcj_color_picker_assets' );

// Ensure wpcg-styles.css has viewport meta
add_action('wp_head', 'wpcj_add_viewport_meta');
function wpcj_add_viewport_meta() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
}




?>