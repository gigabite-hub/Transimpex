<?php

/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if (!function_exists('twentytwentyfour_block_styles')) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles()
	{

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __('Arrow icon', 'twentytwentyfour'),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __('Pill', 'twentytwentyfour'),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __('Checkmark', 'twentytwentyfour'),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __('With arrow', 'twentytwentyfour'),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'sub-headline',
				'label'        => 'Sub Headline',
				'inline_style' => "
				.is-style-sub-headline {
					font-size:20px;
					font-weight:bold;
					font-family: 'Poppins';
				}",
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'headline',
				'label'        => 'Headline',
				'inline_style' => "
				.is-style-headline {
					font-size:34px;
					font-weight:bold;
					font-family: 'Poppins';
				}",
			)
		);
		register_block_style(
			'core/button',
			array(
				'name'         => 'reverse',
				'label'        => 'Reverse',
				'inline_style' => "
				.is-style-reverse a{
					background-color:black !important;
					color:white !important;
				}
				.is-style-reverse a::after{
					background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='19' viewBox='0 0 20 19'%3E%3Cg%3E%3Cpath fill='white' d='M13.774,19.16l5.493-5.33a1.211,1.211,0,0,0,.358-.891v-.016a1.211,1.211,0,0,0-.358-.891L13.774,6.7a1.176,1.176,0,0,0-1.718,0,1.316,1.316,0,0,0,0,1.8l3.3,3.158H6.846a1.274,1.274,0,0,0,0,2.545h8.511l-3.3,3.158a1.316,1.316,0,0,0,0,1.8A1.181,1.181,0,0,0,13.774,19.16Z' transform='translate(-2.754 -3.657)'/%3E%3Cpath id='Icon_ionic-md-arrow-round-forward-2' data-name='Icon ionic-md-arrow-round-forward' d='M13.774,19.16l5.493-5.33a1.211,1.211,0,0,0,.358-.891v-.016a1.211,1.211,0,0,0-.358-.891L13.774,6.7a1.176,1.176,0,0,0-1.718,0,1.316,1.316,0,0,0,0,1.8l3.3,3.158H6.846a1.274,1.274,0,0,0,0,2.545h8.511l-3.3,3.158a1.316,1.316,0,0,0,0,1.8A1.181,1.181,0,0,0,13.774,19.16Z' transform='translate(-22.496 -3.657)'/%3E%3C/g%3E%3C/svg%3E%0A\") !important;
				}
				.is-style-reverse a:hover {
					background-color:var(--wp--preset--color--light-primary) !important;
					color:black !important;
				}
				.is-style-reverse a:hover::after{
					background-image: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='19' viewBox='0 0 20 19'%3E%3Cg%3E%3Cpath fill='currentColor' d='M13.774,19.16l5.493-5.33a1.211,1.211,0,0,0,.358-.891v-.016a1.211,1.211,0,0,0-.358-.891L13.774,6.7a1.176,1.176,0,0,0-1.718,0,1.316,1.316,0,0,0,0,1.8l3.3,3.158H6.846a1.274,1.274,0,0,0,0,2.545h8.511l-3.3,3.158a1.316,1.316,0,0,0,0,1.8A1.181,1.181,0,0,0,13.774,19.16Z' transform='translate(-2.754 -3.657)'/%3E%3Cpath id='Icon_ionic-md-arrow-round-forward-2' data-name='Icon ionic-md-arrow-round-forward' d='M13.774,19.16l5.493-5.33a1.211,1.211,0,0,0,.358-.891v-.016a1.211,1.211,0,0,0-.358-.891L13.774,6.7a1.176,1.176,0,0,0-1.718,0,1.316,1.316,0,0,0,0,1.8l3.3,3.158H6.846a1.274,1.274,0,0,0,0,2.545h8.511l-3.3,3.158a1.316,1.316,0,0,0,0,1.8A1.181,1.181,0,0,0,13.774,19.16Z' transform='translate(-22.496 -3.657)'/%3E%3C/g%3E%3C/svg%3E%0A\") !important;
				}
				",
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'floating-icon-right',
				'label'        => 'Floating Icon Right',
				'inline_style' => "
				.is-style-floating-icon-right {
					position:absolute;
					top:7%;
					right:10%;
					box-shadow:0 10px 25px rgba(0,0,0,0.1);
				}",
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'floating-icon-left',
				'label'        => 'Floating Icon left',
				'inline_style' => "
				.is-style-floating-icon-left {
					position:absolute;
					top:7%;
					left:10%;
					box-shadow:0 10px 25px rgba(0,0,0,0.1);
				}",
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'floating-icon-center',
				'label'        => 'Floating Icon center',
				'inline_style' => "
				.is-style-floating-icon-center-wrapper{
				transform: translate(calc(50% - 50px));
				}
				.is-style-floating-icon-center {
					position: absolute;  
					top: -62px;
					left: 0;
					box-shadow: 0 10px 25px rgba(0,0,0,0.1);
				}",
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'plus-list',
				'label'        => 'Plust Liste',
				'inline_style' => "
				.is-style-plus-list{
				margin:0;
				padding:0;
				margin-top:20px;
				margin-bottom:20px;
				}
				.is-style-plus-list li{
					padding-left: 30px;
					padding-bottom:20px;
					font-size:16px;
					font-weight:bold;
					font-family: Poppins;
					margin-top:20px;
					border-bottom:1px solid rgba(0,0,0,0.2);
  list-style: none;
					background: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='22' height='22' viewBox='0 0 22 22'%3E%3Cpath id='Icon_awesome-plus-circle' data-name='Icon awesome-plus-circle' d='M11.563.563a11,11,0,1,0,11,11A11,11,0,0,0,11.563.563ZM17.95,12.8a.534.534,0,0,1-.532.532H13.337v4.081a.534.534,0,0,1-.532.532H10.321a.534.534,0,0,1-.532-.532V13.337H5.708a.534.534,0,0,1-.532-.532V10.321a.534.534,0,0,1,.532-.532H9.788V5.708a.534.534,0,0,1,.532-.532H12.8a.534.534,0,0,1,.532.532V9.788h4.081a.534.534,0,0,1,.532.532Z' transform='translate(-0.563 -0.563)' fill='%2395cb2a'/%3E%3C/svg%3E%0A\") no-repeat left 2px;
				}
				.is-style-plus-list li:last-child{
					border:none;
				}
				",
			)
		);
	}
endif;

add_action('init', 'twentytwentyfour_block_styles');

/**
 * Enqueue block stylesheets.
 */

if (!function_exists('twentytwentyfour_block_stylesheets')) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets()
	{
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri('assets/css/button-outline.css'),
				'ver'    => wp_get_theme(get_template())->get('Version'),
				'path'   => get_parent_theme_file_path('assets/css/button-outline.css'),
			)
		);
	}
endif;

add_action('init', 'twentytwentyfour_block_stylesheets');

/**
 * Register pattern categories.
 */

if (!function_exists('twentytwentyfour_pattern_categories')) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories()
	{

		register_block_pattern_category(
			'page',
			array(
				'label'       => _x('Pages', 'Block pattern category', 'twentytwentyfour'),
				'description' => __('A collection of full page layouts.', 'twentytwentyfour'),
			)
		);
	}
endif;

add_action('init', 'twentytwentyfour_pattern_categories');


add_filter('render_block', "replace_burger_menu", null, 2);
function replace_burger_menu($block_content, $block)
    {
        if ($block['blockName'] === 'core/navigation' && !is_admin() &&    !wp_is_json_request()) {
            $dots_svg = "<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" width=\"25\" height=\"19\" viewBox=\"0 0 25 19\">\r\n  <g id=\"Gruppe_1907\" data-name=\"Gruppe 1907\" transform=\"translate(-330 -18)\">\r\n    <rect id=\"Rechteck_1873\" data-name=\"Rechteck 1873\" width=\"25\" height=\"3\" rx=\"1.5\" transform=\"translate(330 18)\"\/>\r\n    <rect id=\"Rechteck_1874\" data-name=\"Rechteck 1874\" width=\"25\" height=\"3\" rx=\"1.5\" transform=\"translate(330 26)\"\/>\r\n    <rect id=\"Rechteck_1875\" data-name=\"Rechteck 1875\" width=\"25\" height=\"3\" rx=\"1.5\" transform=\"translate(330 34)\"\/>\r\n  <\/g>\r\n<\/svg>\r\n";
            $block_content = preg_replace('/\<svg width="24" height="24" xmlns="http:\/\/www.w3.org\/2000\/svg" viewBox="0 0 24 24"\>\<path d="M5 5v1.5h14V5H5zm0 7.8h14v-1.5H5v1.5zM5 19h14v-1.5H5V19z" \/\>\<\/svg\>/', $dots_svg, $block_content);

            $closed_svg = "<svg xmlns=\"http:\/\/www.w3.org\/2000\/svg\" width=\"19.799\" height=\"19.799\" viewBox=\"0 0 19.799 19.799\">\r\n  <g id=\"Gruppe_1943\" data-name=\"Gruppe 1943\" transform=\"translate(-333.6 -18.6)\">\r\n    <rect id=\"Rechteck_1873\" data-name=\"Rechteck 1873\" width=\"25\" height=\"3\" rx=\"1.5\" transform=\"translate(335.722 18.601) rotate(45)\" fill=\"#fff\"\/>\r\n    <rect id=\"Rechteck_1875\" data-name=\"Rechteck 1875\" width=\"25\" height=\"3\" rx=\"1.5\" transform=\"translate(353.399 20.722) rotate(135)\" fill=\"#fff\"\/>\r\n  <\/g>\r\n<\/svg>\r\n";
            $block_content = str_replace('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg>', $closed_svg, $block_content);
        }
        return $block_content;
    }



function three_box() {
		ob_start(); ?>
		
		<!-- HTML here -->
		<div class="three-box-wrap">
			<div class="boxes">
				<div class="grenn-box">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="54.954" height="63.5" viewBox="0 0 54.954 63.5">
					<defs>
						<clipPath id="clip-path">
						<rect id="Rechteck_70" data-name="Rechteck 70" width="54.954" height="63.5" fill="none"></rect>
						</clipPath>
					</defs>
					<g id="Gruppe_74" data-name="Gruppe 74" clip-path="url(#clip-path)">
						<path id="Pfad_399" data-name="Pfad 399" d="M53.844,32.222,48.916.876A1.032,1.032,0,0,0,47.895,0H6.687A1.029,1.029,0,0,0,5.672.842L4.444,7.2a3.726,3.726,0,0,0,.5,2.761L.8,39.979a53.137,53.137,0,0,0,.587,21.332,1.029,1.029,0,0,0,.973.807l40.67,1.38a2.545,2.545,0,0,0,.9-.117L53.2,58.551a1.037,1.037,0,0,0,.545-.759,71.275,71.275,0,0,0,.1-25.576ZM3.229,60.083l-.5-2.264A54.88,54.88,0,0,1,2.85,40.3l4-28.924a4.373,4.373,0,0,0,1.166.173H42.919a4.8,4.8,0,0,0,2.588-.794l-4.03,29.013a61.4,61.4,0,0,0,.386,21.629c-7.771-.262-31.249-1.063-38.62-1.311ZM6.839,5.7c.069-.345.656-3.375.7-3.623h39.1l-.994,5.135a2.947,2.947,0,0,1-2.733,2.271H8.005A1.5,1.5,0,0,1,6.473,7.605ZM51.78,56.964,43.9,61.07a59.608,59.608,0,0,1-.386-20.994L47.957,8.1l3.851,24.486a68.394,68.394,0,0,1-.028,24.376" transform="translate(0 0)" fill="#fff"></path>
						<path id="Pfad_400" data-name="Pfad 400" d="M17.747,68.584,39.079,69.6a1.042,1.042,0,0,0,1.077-1.187l-.511-3.389a38.755,38.755,0,0,1,.1-12.243c.021-.014,1.67-12.126,1.691-12.146a1.045,1.045,0,0,0-1.028-1.18H11.625a1.04,1.04,0,0,0-1.028.89L8.906,52.593a40.454,40.454,0,0,0-.055,13.092l.49,1.774a1.03,1.03,0,0,0,.945.759c1.5.069,6.039.29,7.467.359ZM10.859,65.2a38.817,38.817,0,0,1,.09-12.284l1.574-11.38H39.217L37.7,52.462a43.219,43.219,0,0,0,.214,15.017C33,67.245,15.711,66.417,11.128,66.2l-.276-.994Z" transform="translate(-2.586 -12.227)" fill="#fff"></path>
					</g>
				</svg>
				</div>
				<div class="inner-content">
					<h4 class="wp-block-heading is-style-default">Private Label / LEH</h4>
					<ul class="is-style-plus-list">
						<li>alle Produkte auf Wunsch mit individueller Verpackung</li>
						<li>wir unterstützen bei Auswahl und Design</li>
						<li>gemeinsam realisieren wir Ihre Verpackungskonzepte </li>
					</ul>
					<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
						<div class="wp-block-button is-style-reverse"><a class="wp-block-button__link wp-element-button">Mehr erfahren</a></div>
					</div>
				</div>
			</div>
	
			<div class="boxes">
				<div class="grenn-box">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="68.282" height="72.844" viewBox="0 0 68.282 72.844">
					<defs>
						<clipPath id="clip-path">
						<rect id="Rechteck_72" data-name="Rechteck 72" width="68.282" height="72.844" fill="none"></rect>
						</clipPath>
					</defs>
					<g id="Gruppe_76" data-name="Gruppe 76" clip-path="url(#clip-path)">
						<path id="Pfad_401" data-name="Pfad 401" d="M67.679,16.072,34.6.106a1.067,1.067,0,0,0-.928,0L.6,16.072a1.067,1.067,0,0,0-.6.961V55.81a1.067,1.067,0,0,0,.6.961L33.677,72.737a1.067,1.067,0,0,0,.928,0L67.679,56.77a1.067,1.067,0,0,0,.6-.961V17.033a1.067,1.067,0,0,0-.6-.961M34.141,2.251l30.62,14.782-8.876,4.285A1.058,1.058,0,0,0,55.7,21.2L25.292,6.523ZM22.882,7.73,53.457,22.49,47.2,25.513,16.633,10.759Zm31.29,16.785V35.689l-5.849,2.824V27.338ZM66.148,55.14,35.208,70.076V33.67l7.38-3.563a1.067,1.067,0,1,0-.928-1.922l-7.519,3.63-2.959-1.428a1.067,1.067,0,0,0-.928,1.922l2.82,1.361V70.076L2.134,55.14V18.733l23.56,11.374a1.067,1.067,0,0,0,.928-1.922L3.521,17.033l10.6-5.117L46.175,27.39l.015.019v12.8a1.067,1.067,0,0,0,1.531.961L55.7,37.32a1.067,1.067,0,0,0,.6-.961V23.484l9.841-4.751Z" transform="translate(0 0)" fill="#fff"></path>
						<path id="Pfad_402" data-name="Pfad 402" d="M38.4,343.711l-4.854-2.343a1.067,1.067,0,1,0-.928,1.922l4.854,2.343a1.067,1.067,0,0,0,.928-1.922" transform="translate(-27.461 -292.709)" fill="#fff"></path>
						<path id="Pfad_403" data-name="Pfad 403" d="M42.909,310.293,33.6,305.8a1.067,1.067,0,1,0-.928,1.922l9.314,4.5a1.067,1.067,0,0,0,.928-1.922" transform="translate(-27.502 -262.199)" fill="#fff"></path>
					</g>
				</svg>
				</div>
				<div class="inner-content">
					<h4 class="wp-block-heading is-style-default">Großverbraucher</h4>
					<ul class="is-style-plus-list">
						<li>Flexibilität durch unterschiedliche Verpackungsgrößen</li>
						<li>Abnahme in Großmengen möglich</li>
						<li>wir beraten Sie individuell  </li>
					</ul>
					<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
						<div class="wp-block-button is-style-reverse"><a class="wp-block-button__link wp-element-button">Mehr erfahren</a></div>
					</div>
				</div>
			</div>
	
			<div class="boxes">
				<div class="grenn-box">
				<svg id="Gruppe_79" data-name="Gruppe 79" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="66" height="64.09" viewBox="0 0 66 64.09">
					<defs>
						<clipPath id="clip-path">
						<rect id="Rechteck_73" data-name="Rechteck 73" width="66" height="64.09" fill="none"></rect>
						</clipPath>
					</defs>
					<g id="Gruppe_78" data-name="Gruppe 78" clip-path="url(#clip-path)">
						<path id="Pfad_404" data-name="Pfad 404" d="M35.366,143.346a.967.967,0,0,1-.967-.967V125.974a.967.967,0,1,1,1.934,0v16.405a.967.967,0,0,1-.967.967" transform="translate(-29.965 -108.893)" fill="#fff"></path>
						<path id="Pfad_405" data-name="Pfad 405" d="M463.567,278.8a.967.967,0,0,1-.967-.967V254.428a.967.967,0,0,1,1.934,0v23.405a.967.967,0,0,1-.967.967" transform="translate(-402.968 -220.788)" fill="#fff"></path>
						<path id="Pfad_406" data-name="Pfad 406" d="M463.567,140.41a.967.967,0,0,1-.967-.967V127.607a.967.967,0,0,1,1.934,0v11.836a.967.967,0,0,1-.967.967" transform="translate(-402.968 -110.315)" fill="#fff"></path>
						<path id="Pfad_407" data-name="Pfad 407" d="M100.42,217a.967.967,0,0,1-.967-.967v-5.506a.967.967,0,1,1,1.934,0v5.506a.967.967,0,0,1-.967.967" transform="translate(-86.633 -182.545)" fill="#fff"></path>
						<path id="Pfad_408" data-name="Pfad 408" d="M398.514,241.007a.967.967,0,0,1-.967-.967V211.185a.967.967,0,1,1,1.934,0v28.856a.967.967,0,0,1-.967.967" transform="translate(-346.301 -183.12)" fill="#fff"></path>
						<path id="Pfad_409" data-name="Pfad 409" d="M279.179,267.878a.967.967,0,0,1-.967-.967V256.089H267.326v10.726a.967.967,0,1,1-1.934,0V255.122a.967.967,0,0,1,.967-.967h12.82a.967.967,0,0,1,.967.967v11.79a.967.967,0,0,1-.967.967" transform="translate(-231.181 -221.393)" fill="#fff"></path>
						<path id="Pfad_410" data-name="Pfad 410" d="M279.179,359.073a.967.967,0,0,1-.967-.967V347.548H267.326v10.436a.967.967,0,0,1-1.934,0v-11.4a.967.967,0,0,1,.967-.967h12.82a.967.967,0,0,1,.967.967v11.526a.967.967,0,0,1-.967.967" transform="translate(-231.181 -301.062)" fill="#fff"></path>
						<path id="Pfad_411" data-name="Pfad 411" d="M166.906,359.073a.967.967,0,0,1-.967-.967V346.581a.967.967,0,0,1,.967-.967h12.413a.967.967,0,1,1,0,1.934H167.873v10.559a.967.967,0,0,1-.967.967" transform="translate(-144.548 -301.062)" fill="#fff"></path>
						<path id="Pfad_412" data-name="Pfad 412" d="M301.049,262.969h-5.223a.967.967,0,0,1-.967-.967v-4.579a.967.967,0,0,1,1.934,0v3.612h3.289v-3.612a.967.967,0,0,1,1.934,0V262a.967.967,0,0,1-.967.967" transform="translate(-256.85 -223.398)" fill="#fff"></path>
						<path id="Pfad_413" data-name="Pfad 413" d="M301.049,353.965h-5.223a.967.967,0,0,1-.967-.967v-4.647a.967.967,0,0,1,1.934,0v3.681h3.289v-3.681a.967.967,0,0,1,1.934,0V353a.967.967,0,0,1-.967.967" transform="translate(-256.85 -302.604)" fill="#fff"></path>
						<path id="Pfad_414" data-name="Pfad 414" d="M201.6,354.933h-5.223a.967.967,0,0,1-.967-.967v-4.419a.967.967,0,1,1,1.934,0V353h3.289v-3.537a.967.967,0,1,1,1.934,0v4.5a.967.967,0,0,1-.967.967" transform="translate(-170.218 -303.572)" fill="#fff"></path>
						<path id="Pfad_415" data-name="Pfad 415" d="M34.209,347.548H21.99a.967.967,0,1,1,0-1.934H34.209a.967.967,0,1,1,0,1.934" transform="translate(-18.313 -301.062)" fill="#fff"></path>
						<path id="Pfad_416" data-name="Pfad 416" d="M54.327,354.933H49.1a.967.967,0,0,1-.967-.967v-4.5a.967.967,0,0,1,1.934,0V353H53.36v-3.537a.967.967,0,0,1,1.934,0v4.5a.967.967,0,0,1-.967.967" transform="translate(-41.932 -303.572)" fill="#fff"></path>
						<path id="Pfad_417" data-name="Pfad 417" d="M19.637,413.346a.967.967,0,0,1-.967-.967v-3.593a.967.967,0,0,1,1.934,0v3.593a.967.967,0,0,1-.967.967" transform="translate(-16.263 -355.249)" fill="#fff"></path>
						<path id="Pfad_418" data-name="Pfad 418" d="M32.457,279.41a.967.967,0,0,1-.967-.967V256.095H20.6v14.329a.967.967,0,0,1-1.934,0v-15.3a.967.967,0,0,1,.967-.967h12.82a.967.967,0,0,1,.967.967v23.315a.967.967,0,0,1-.967.967" transform="translate(-16.263 -221.398)" fill="#fff"></path>
						<path id="Pfad_419" data-name="Pfad 419" d="M54.327,262.969H49.1a.967.967,0,0,1-.967-.967v-4.465a.967.967,0,0,1,1.934,0v3.5H53.36v-3.612a.967.967,0,0,1,1.934,0V262a.967.967,0,0,1-.967.967" transform="translate(-41.932 -223.398)" fill="#fff"></path>
						<path id="Pfad_420" data-name="Pfad 420" d="M65.033,444.82H.967A.967.967,0,0,1,0,443.853v-5.815a.967.967,0,0,1,.967-.967H65.033a.967.967,0,0,1,.967.967v5.815a.967.967,0,0,1-.967.967m-63.1-1.934H64.066V439H1.934Z" transform="translate(0 -380.73)" fill="#fff"></path>
						<path id="Pfad_421" data-name="Pfad 421" d="M121.447,153.067H91.563a.967.967,0,1,1,0-1.934H120.48v-6.46H77.944v6.46h9.107a.967.967,0,0,1,0,1.934H76.977a.967.967,0,0,1-.967-.967v-8.393a.967.967,0,0,1,.967-.967h44.47a.967.967,0,0,1,.967.967V152.1a.967.967,0,0,1-.967.967" transform="translate(-66.212 -124.34)" fill="#fff"></path>
						<path id="Pfad_422" data-name="Pfad 422" d="M65.033,19.483a.965.965,0,0,1-.343-.063L40.7,10.321a.967.967,0,1,1,.686-1.808l22.676,8.6V13.788L33,2,1.934,13.788v3.328L32.657,5.459a.967.967,0,0,1,.686,0l3.83,1.453a.967.967,0,1,1-.686,1.808L33,7.4,1.31,19.42a.967.967,0,0,1-1.31-.9v-5.4a.967.967,0,0,1,.624-.9L32.657.063a.967.967,0,0,1,.686,0L65.376,12.217a.967.967,0,0,1,.624.9v5.4a.967.967,0,0,1-.967.967" transform="translate(0 0)" fill="#fff"></path>
						<path id="Pfad_423" data-name="Pfad 423" d="M122.757,177.23H78.742a.967.967,0,0,1,0-1.934h44.015a.967.967,0,1,1,0,1.934" transform="translate(-67.749 -152.699)" fill="#fff"></path>
					</g>
					</svg>
				</div>
				<div class="inner-content">
					<h4 class="wp-block-heading is-style-default">Industrie</h4>
					<ul class="is-style-plus-list">
						<li>umfangreiches Sortiment an verschiedenen Produkten</li>
						<li>Sicherung höchster Qualitätsstandards</li>
						<li>Berücksichtigung individueller Bedürfnisse </li>
					</ul>
					<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
						<div class="wp-block-button is-style-reverse"><a class="wp-block-button__link wp-element-button">Mehr erfahren</a></div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$output_string = ob_get_contents();
		ob_end_clean();
		return $output_string;
	}
	add_shortcode('three_boxes','three_box');