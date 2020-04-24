<?php
    /*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
    define('ONE_THEME_VERSION', '1.4.3');
    osc_enqueue_script('php-date');
    if( !OC_ADMIN ) {
        if( !function_exists('add_close_button_action') ) {
            function add_close_button_action(){
                echo '<script type="text/javascript">';
				echo '$(".flashmessage .ico-close").click(function(){';
				echo '$(this).parent().hide();';
				echo '});';
                echo '</script>';
			}
            osc_add_hook('footer', 'add_close_button_action');
		}
	}
    function theme_one_actions_admin() {
        if( Params::getParam('file') == 'oc-content/themes/one/admin/settings.php' ) {
            if( Params::getParam('donation') == 'successful' ) {
                osc_set_preference('donation', '1', 'one');
                osc_reset_preferences();
			}
		}
        switch( Params::getParam('action_specific') ) {
            case('settings'): 
			$defaultLogo = Params::getParam('default_logo');
			osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'one');
			osc_set_preference('default_logo', ($defaultLogo ? '1' : '0'), 'one');
			osc_set_preference('header-728x90',         trim(Params::getParam('header-728x90', false, false, false)),                  'one');
			osc_set_preference('homepage-728x90',       trim(Params::getParam('homepage-728x90', false, false, false)),                'one');
			osc_set_preference('sidebar-300x250',       trim(Params::getParam('sidebar-300x250', false, false, false)),                'one');
			osc_set_preference('search-results-top-728x90',     trim(Params::getParam('search-results-top-728x90', false, false, false)),          'one');
			osc_set_preference('search-results-middle-728x90',  trim(Params::getParam('search-results-middle-728x90', false, false, false)),       'one');
			osc_add_flash_ok_message(__('Theme settings updated correctly', 'one'), 'admin');
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/settings.php')); exit;
            break;
			//upload
			case('up_categ_image'):
			$package = Params::getFiles('set_image');
			$idt = $_POST['id_category'];
			if( $package['error'] == UPLOAD_ERR_OK ) {
				if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/categ_image/".$idt.".png" ) ) {
					osc_add_flash_ok_message(__('The category image has been uploaded correctly', 'one'), 'admin');
                    } else {
					osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
				}
                } else {
				osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/img_settings.php')); exit;
            break;		
			//remove
			case('remove_categ_image'):
			$id_remove = $_POST['id_remove'];
			if(file_exists (osc_themes_path() . 'one/images/categ_image/' . $id_remove . '.png') ) {
				@unlink(osc_themes_path() . 'one/images/categ_image/' . $id_remove . '.png') ;
				osc_add_flash_ok_message(__('The category image has been removed', 'one'), 'admin');
                } else {
				osc_add_flash_error_message(__("Image not found", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/img_settings.php')); exit;
            break;
			//mobile image
			//upload
			case('m_up_categ_image'):
			$package = Params::getFiles('set_image');
			$idt = $_POST['id_category'];
			if( $package['error'] == UPLOAD_ERR_OK ) {
				if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/m_categ_image/".$idt.".png" ) ) {
					osc_add_flash_ok_message(__('The category image has been uploaded correctly', 'one'), 'admin');
                    } else {
					osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
				}
                } else {
				osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/mobile_image.php')); 
			exit;
            break;		
			//remove
			case('m_remove_categ_image'):
			$id_remove = $_POST['id_remove'];
			if(file_exists (osc_themes_path() . 'one/images/m_categ_image/' . $id_remove . '.png') ) {
				@unlink(osc_themes_path() . 'one/images/m_categ_image/' . $id_remove . '.png') ;
				osc_add_flash_ok_message(__('The category image has been removed', 'one'), 'admin');
                } else {
				osc_add_flash_error_message(__("Image not found", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/mobile_image.php'));
			exit;
            break;
			//end mobile image
            case('upload_logo'):
			$package = Params::getFiles('logo');
			if( $package['error'] == UPLOAD_ERR_OK ) {
				if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
					osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'one'), 'admin');
                    } else {
					osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
				}
                } else {
				osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/header.php')); exit;
            break;
            case('remove'):
			if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
				@unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
				osc_add_flash_ok_message(__('The logo image has been removed', 'one'), 'admin');
                } else {
				osc_add_flash_error_message(__("Image not found", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/header.php')); exit;
            break;
			case('upload_logo_footer'):
			$package = Params::getFiles('logo_footer');
			if( $package['error'] == UPLOAD_ERR_OK ) {
				if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo_footer.jpg" ) ) {
					osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'one'), 'admin');
                    } else {
					osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
				}
                } else {
				osc_add_flash_error_message(__("An error has occurred, please try again", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/header.php')); exit;
            break;
            case('remove_footer'):
			if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo_footer.jpg" ) ) {
				@unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo_footer.jpg" );
				osc_add_flash_ok_message(__('The logo image has been removed', 'one'), 'admin');
                } else {
				osc_add_flash_error_message(__("Image not found", 'one'), 'admin');
			}
			header('Location: ' . osc_admin_render_theme_url('oc-content/themes/one/admin/header.php')); exit;
            break;
			case('sttings_one'):
			$top_bar = Params::getParam('top_bar');
			osc_set_preference('top_bar', ($top_bar ? '1' : '0'), 'one');
			$autocomplete_related = Params::getParam('autocomplete_related');
			osc_set_preference('autocomplete_related', ($autocomplete_related ? '1' : '0'), 'one');
			$custom_items = Params::getParam('custom_items');
			osc_set_preference('custom_items', ($custom_items ? '1' : '0'), 'one');
			$premium_custom = Params::getParam('premium_custom');
			osc_set_preference('premium_custom', ($premium_custom ? '1' : '0'), 'one');
			$random_custom = Params::getParam('random_custom');
			osc_set_preference('random_custom', ($random_custom ? '1' : '0'), 'one');
			$latest = Params::getParam('latest');
			osc_set_preference('latest', ($latest ? '1' : '0'), 'one');			
			$region_pub = Params::getParam('region_pub');
			osc_set_preference('region_pub', ($region_pub ? '1' : '0'), 'one');
			$useradspc = Params::getParam('useradspc');
			osc_set_preference('useradspc', ($useradspc ? '1' : '0'), 'one');
			$text_home = Params::getParam('text_home');
			osc_set_preference('text_home',         trim(Params::getParam('text_home', false, false, false)),                  'one');
			$social_facebook = Params::getParam('social_facebook');
			osc_set_preference('social_facebook',         trim(Params::getParam('social_facebook', false, false, false)),                  'one');
			$social_twitter = Params::getParam('social_twitter');
			osc_set_preference('social_twitter',         trim(Params::getParam('social_twitter', false, false, false)),                  'one');
			$social_google = Params::getParam('social_google');
			osc_set_preference('social_google',         trim(Params::getParam('social_google', false, false, false)),                  'one');
			$social_widget = Params::getParam('social_widget');
			osc_set_preference('social_widget',         trim(Params::getParam('social_widget', false, false, false)),                  'one');
			$autor = Params::getParam('autor');
			osc_set_preference('autor',         trim(Params::getParam('autor', false, false, false)),                  'one');
			$premiumsearch = Params::getParam('premiumsearch');
			osc_set_preference('premiumsearch',         trim(Params::getParam('premiumsearch', false, false, false)),                  'one');
			$premiumsearchgl = Params::getParam('premiumsearchgl');
			osc_set_preference('premiumsearchgl',         trim(Params::getParam('premiumsearchgl', false, false, false)),                  'one');
			$related = Params::getParam('related');
			osc_set_preference('related',         trim(Params::getParam('related', false, false, false)),                  'one');
			$userads = Params::getParam('userads');
			osc_set_preference('userads',         trim(Params::getParam('userads', false, false, false)),                  'one');
			$number_order = Params::getParam('number_order');
			osc_set_preference('number_order',         trim(Params::getParam('number_order', false, false, false)),                  'one');
			$number_set = Params::getParam('number_set');
			osc_set_preference('number_set',         trim(Params::getParam('number_set', false, false, false)),                  'one');
			osc_set_preference('category_custom',         trim(Params::getParam('category_custom', false, false, false)),                  'one');
			osc_set_preference('city_custom',         trim(Params::getParam('city_custom', false, false, false)),                  'one');
			osc_set_preference('region_custom',         trim(Params::getParam('region_custom', false, false, false)),                  'one');
			osc_set_preference('number_custom',         trim(Params::getParam('number_custom', false, false, false)),                  'one');
			osc_set_preference('name_custom',         trim(Params::getParam('name_custom', false, false, false)),                  'one');
			osc_add_flash_ok_message(__('Theme settings updated correctly', 'onex'), 'admin');
			osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/one/admin/header.php'));
            exit;		
            break;
			case('color_one'):
			$onebody = Params::getParam('onebody');
			$homesearchc = Params::getParam('homesearchc');
			$searchsearchc = Params::getParam('searchsearchc');
			$containercolor = Params::getParam('containercolor');
			$savelocationcolor = Params::getParam('savelocationcolor');
			$search_button_color = Params::getParam('search_button_color');
			$search_button_hover = Params::getParam('search_button_hover');
			$pub_button_color = Params::getParam('pub_button_color');
			$pub_button_hover = Params::getParam('pub_button_hover');
			$top_pub_button_color = Params::getParam('top_pub_button_color');
			$top_pub_button_hover = Params::getParam('top_pub_button_hover');
			$background_price_color = Params::getParam('background_price_color');
			$price_color = Params::getParam('price_color');
			$upload_button_color = Params::getParam('upload_button_color');
			$publish_buton_color = Params::getParam('publish_buton_color');
			$publish_buton_hover = Params::getParam('publish_buton_hover');
			osc_set_preference('onebody', ($onebody), 'one');
			osc_set_preference('homesearchc', ($homesearchc), 'one');
			osc_set_preference('searchsearchc', ($searchsearchc), 'one');
			osc_set_preference('containercolor', ($containercolor), 'one');
			osc_set_preference('savelocationcolor', ($savelocationcolor), 'one');
			osc_set_preference('search_button_color', ($search_button_color), 'one');
			osc_set_preference('search_button_hover', ($search_button_hover), 'one');
			osc_set_preference('pub_button_color', ($pub_button_color), 'one');
			osc_set_preference('pub_button_hover', ($pub_button_hover), 'one');
			osc_set_preference('top_pub_button_color', ($top_pub_button_color), 'one');
			osc_set_preference('top_pub_button_hover', ($top_pub_button_hover), 'one');
			osc_set_preference('background_price_color', ($background_price_color), 'one');
			osc_set_preference('price_color', ($price_color), 'one');
			osc_set_preference('upload_button_color', ($upload_button_color), 'one');
			osc_set_preference('publish_buton_color', ($publish_buton_color), 'one');
			osc_set_preference('publish_buton_hover', ($publish_buton_hover), 'one');
			osc_add_flash_ok_message(__('Theme settings updated correctly', 'onex'), 'admin');
			osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/one/admin/color.php'));
			exit;
            break;
		}
	}
	/*style for color */
	function one_style_header() {
		$onebody		 = osc_get_preference('onebody', 'one');
		$homesearchc		 = osc_get_preference('homesearchc', 'one');
		$searchsearchc		 = osc_get_preference('searchsearchc', 'one');
		$containercolor		 = osc_get_preference('containercolor', 'one');
		$savelocationcolor		 = osc_get_preference('savelocationcolor', 'one');
		$search_button_color		 = osc_get_preference('search_button_color', 'one');
		$search_button_hover		 = osc_get_preference('search_button_hover', 'one');
		$pub_button_color		 = osc_get_preference('pub_button_color', 'one');
		$pub_button_hover		 = osc_get_preference('pub_button_hover', 'one');
		$top_pub_button_color		 = osc_get_preference('top_pub_button_color', 'one');
		$top_pub_button_hover		 = osc_get_preference('top_pub_button_hover', 'one');
		$background_price_color		 = osc_get_preference('background_price_color', 'one');
		$price_color		 = osc_get_preference('price_color', 'one');
		$upload_button_color		 = osc_get_preference('upload_button_color', 'one');
		$publish_buton_color		 = osc_get_preference('publish_buton_color', 'one');
		$publish_buton_hover		 = osc_get_preference('publish_buton_hover', 'one');
	?>
	<style type="text/css">
		body {background: <?php echo $onebody; ?> !important; }	    
		.search fieldset {background: <?php echo $homesearchc; ?> !important; }
		.search_top {background: <?php echo $searchsearchc; ?> !important; }
		.second_categoriess .top_selection {background: <?php echo $savelocationcolor; ?> !important; }
		.search .home_b, .search_top .button   {background: <?php echo $search_button_color; ?> !important; }
		.search .home_b:hover, .search_top .button:hover {background: <?php echo $search_button_hover; ?> !important;}
		.home #sidebar .tcenter a, .form_publish, .user_account.items h2 a {background-color: <?php echo $pub_button_color; ?> !important;}
		.home #sidebar .tcenter  a:hover, .form_publish:hover, .user_account.items h2 a:hover {background-color: <?php echo $pub_button_hover; ?> !important;}
		.msss .form_publish  a, .msss .form_publish .icon_pss span.pl_ss {color: <?php echo $top_pub_button_color; ?> !important;}
		.msss .form_publish  a:hover {background: <?php echo $top_pub_button_hover; ?> !important;}
		.item #sidebar  .sidebar_price { background: <?php echo $background_price_color; ?> !important;color: <?php echo $price_color; ?> !important;}
		.qq-upload-button { background: <?php echo $upload_button_color; ?> !important; }
		.add_item .button, .add_item button { background: <?php echo $publish_buton_color; ?> !important; }
		.add_item .button:hover {background: <?php echo $publish_buton_hover; ?> !important; }
		<?php if( osc_get_preference('top_bar', 'one') != '0') { ?>
			.item .second_sidebar.fixed {top:50px !important;}
			<?php } else { ?>	
			.item .second_sidebar.fixed {top:0px !important;}
		<?php } ?>
	</style>
	<?php }
	osc_add_hook('style_color', 'one_style_header');
	/*end style haeder*/
    if( !function_exists('logo_header') ) {
        function logo_header() {
            $html = '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" />';
            if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                return $html;
				} else if( osc_get_preference('default_logo', 'one') && (file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/default-logo.jpg")) ) {
                return '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/default-logo.jpg') . '" />';
				} else {
                return osc_page_title();
			}
		}
	}
	if( !function_exists('logo_footer') ) {
        function logo_footer() {
            $html = '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo_footer.jpg') . '" />';
            if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo_footer.jpg" ) ) {
                return $html;
				} else if( osc_get_preference('default_logo_footer', 'one') && (file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/default-logo_footer.jpg")) ) {
                return '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/default-logo_footer.jpg') . '" />';
				} else {
                return osc_page_title();
			}
		}
	}
    // install update options
    if( !function_exists('one_theme_install') ) {
        function one_theme_install() {
            osc_set_preference('keyword_placeholder', __('Pesquizar...', 'one'), 'one');
            osc_set_preference('version', '1.4.3', 'one');
            osc_set_preference('footer_link', true, 'one');
            osc_set_preference('donation', '0', 'one');
            osc_set_preference('default_logo', '1', 'one');
			osc_set_preference('latest', '0', 'one');
			osc_set_preference('custom_items', '1', 'one');
			osc_set_preference('number_custom', '12', 'one');
			osc_set_preference('premium_custom', '0', 'one');
			osc_set_preference('random_custom', '0', 'one');
			osc_set_preference('number_order', '10', 'one');
			osc_set_preference('number_set', '40', 'one');
			osc_set_preference('default_logo_footer', '1', 'one');
			osc_set_preference('premiumsearch', '3', 'one');
			osc_set_preference('premiumsearchgl', '4', 'one');
			osc_set_preference('related', '3', 'one');
			osc_set_preference('userads', '3', 'one');
			osc_set_preference('top_bar', '1', 'one');
			osc_set_preference('autocomplete_related', '1', 'one');
			osc_set_preference('region_pub', '1', 'one');
			osc_set_preference('autor', __('Copyright ©2016. Todos os direitos reservados.<a title="Osclass web" href="http://mxsistemas.ml">MX Sistemas</a>', 'one'), 'one');
			osc_set_preference('text_home', __('Coloque algum texto aqui. Alterar no painel osclass admin, sob configurações de aparência.', 'one'), 'one');
			osc_set_preference('onebody', '#FFF', 'one');
			osc_set_preference('containercolor', '#FFF', 'one');
			osc_set_preference('searchsearchc', '#417CD4', 'one');
			osc_set_preference('homesearchc', '#417CD4', 'one');
			osc_set_preference('savelocationcolor', '#417CD4', 'one');
			osc_set_preference('search_button_color', '#82B02A', 'one');
		    osc_set_preference('search_button_hover', '#8DBF2E', 'one');
			osc_set_preference('pub_button_color', '#82B02A', 'one');
			osc_set_preference('pub_button_hover', '#8DBF2E', 'one');
			osc_set_preference('top_pub_button_color', '#82B02A', 'one');
			osc_set_preference('top_pub_button_hover', '#8DBF2E', 'one');
			osc_set_preference('background_price_color', '#FBA65E', 'one');
			osc_set_preference('price_color', '#F1F5FC', 'one');
			osc_set_preference('upload_button_color', '#F8F8F7', 'one');
		    osc_set_preference('publish_buton_color', '#82B02A', 'one');
			osc_set_preference('publish_buton_hover', '#8DBF2E', 'one');
			osc_set_preference('social_facebook', __('Facebook', 'one'), 'one');
			osc_set_preference('social_twitter', __('Twitter', 'one'), 'one');
			osc_set_preference('social_google', __('Google', 'one'), 'one');
            osc_reset_preferences();
		}
	}
    if(!function_exists('check_install_one_theme')) {
        function check_install_one_theme() {
            $current_version = osc_get_preference('version', 'one');
            //check if current version is installed or need an update
            if( !$current_version ) {
                one_theme_install();
			}
		}
	}
    check_install_one_theme();
	if (one_is_fineuploader()) {
		if (!OC_ADMIN) {
			osc_enqueue_style('fine-uploader-css', osc_assets_url('js/fineuploader/fineuploader.css'));
		}
		osc_enqueue_script('jquery-fineuploader');
	}
	function one_is_fineuploader() {
		return Scripts::newInstance()->registered['jquery-fineuploader'] && method_exists('ItemForm', 'ajax_photos');
	}
	osc_add_hook('init_admin', 'theme_one_actions_admin');
	osc_add_hook('init_admin', 'theme_one_regions_map_admin');
	if (function_exists('osc_admin_menu_appearance')) {
		osc_admin_menu_appearance(__('One Settings', 'one'), osc_admin_render_theme_url('oc-content/themes/one/admin/header.php'), 'header_one');
		} else {
		function one_admin_menu() {
			echo '<h3><a href="#">' . __('One theme', 'one') . '</a></h3>
            <ul>
			<li><a href="' . osc_admin_render_theme_url('oc-content/themes/one/admin/header.php') . '">&raquo; ' . __('One Settings', 'one') . '</a></li>
            </ul>';
		}
		osc_add_hook('admin_menu', 'one_admin_menu');
	}
    /* ads  SEARCH */
    function search_ads_listing_top_fn_one() {
        if(osc_get_preference('search-results-top-728x90', 'one')!='') {
            echo '<div class="clear"></div>' . PHP_EOL;
            echo '<div class="ads_728">' . PHP_EOL;
            echo osc_get_preference('search-results-top-728x90', 'one');
            echo '</div>' . PHP_EOL;
		}
	}
    osc_add_hook('search_ads_listing_top_one', 'search_ads_listing_top_fn_one');
    function search_ads_listing_medium_fn_one() {
        if(osc_get_preference('search-results-middle-728x90', 'one')!='') {
            echo '<div class="clear"></div>' . PHP_EOL;
            echo '<div class="ads_728">' . PHP_EOL;
            echo osc_get_preference('search-results-middle-728x90', 'one');
            echo '</div>' . PHP_EOL;
		}
	}
    osc_add_hook('search_ads_listing_medium_one', 'search_ads_listing_medium_fn_one');
	/* function most used categories 
		function cust_order_by_num_items($a, $b) {
		return $b['i_num_items'] - $a["i_num_items"];
	}*/
	/*select category search */
	function osc_categories_select_one($name = 'sCategory', $category = null, $default_str = null) {
        if($default_str == null) $default_str = __('Select a category');
		if(is_array($category)) $category['pk_i_id'] = $category[0];
        CategoryForm::category_select(Category::newInstance()->toTree(), $category, $default_str, $name);
	}
	/*user type */
	function one_user_type() {
		if(Params::getParam('sCompany') <> '' and Params::getParam('sCompany') <> null) {
			Search::newInstance()->addJoinTable( 'pk_i_id', DB_TABLE_PREFIX.'t_user', DB_TABLE_PREFIX.'t_item.fk_i_user_id = '.DB_TABLE_PREFIX.'t_user.pk_i_id', 'LEFT OUTER' ) ;
			if(Params::getParam('sCompany') == 1) {
				Search::newInstance()->addConditions(sprintf("%st_user.b_company = 1", DB_TABLE_PREFIX));
				} else {
				Search::newInstance()->addConditions(sprintf("coalesce(%st_user.b_company, 0) <> 1", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
			}
		}
	}
	osc_add_hook('search_conditions', 'one_user_type');
	/*search number items */
	if( !function_exists('one_search_number') ) {
        /**
			*
			* @return array
		*/
        function one_search_number() {
            $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
            $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
            if( $search_to > osc_search_total_items() ) {
                $search_to = osc_search_total_items();
			}
            return array(
			'from' => $search_from,
			'to'   => $search_to,
			'of'   => osc_search_total_items()
            );
		}
	}
	/*search breadcrumbs */
	function breadcrumbs_one($separator = '&nbsp;') {
        $text       = '';
        $location   = Rewrite::newInstance()->get_location();
        $section    = Rewrite::newInstance()->get_section();
        $separator  = ' ' . trim($separator) . ' ';
        $page_title = '<a href="' . osc_base_url() .  '"><span class="home"></span><span class="point"></span></a>';
        switch ($location) {
            case('search'):
			$region     = osc_search_region();
			$city       = osc_search_city();
			$pattern    = osc_search_pattern();
			$category   = osc_search_category_id();
			$category   = ((count($category) == 1) ? $category[0] : '');
			$b_show_all = ($pattern == '' && $category == '' && $region == '' && $city == '');
			$b_category = ($category != '');
			$b_pattern  = ($pattern != '');
			$b_region   = ($region != '');
			$b_city     = ($city != '');
			$b_location = ($b_region || $b_city);
			if($b_show_all) {
				$text = $page_title . $separator . '<span class="bc_last">' . __('Listings', 'one') . '</span>' ;
				break; 
			}
			// init
			$result = $page_title . $separator;
			if($b_category) {
				$list        = array();
				$aCategories = Category::newInstance()->toRootTree($category);
				if(count($aCategories) > 0) {
					$deep = 1;
					foreach ($aCategories as $single) {
						$list[] = '<a href="' . breadcrumbs_one_category_url($single['pk_i_id']) . '"><span class="bc_level_' . $deep . '">' . $single['s_name']. '</span></a>';
						$deep++;
					}
					// remove last link
					if( !$b_pattern && !$b_location ) {
						$list[count($list) - 1] = preg_replace('|<a href.*?>(.*?)</a>|', '$01', $list[count($list) - 1]);
					}
					$result .= implode($separator, $list) . $separator;
				}
			}
			if( $b_location ) {
				$list   = array();
				$params = array();
				if($b_category) $params['sCategory'] = $category;
				if($b_city) {
					$aCity = City::newInstance()->findByName($city);
					if( count($aCity) == 0 ) {
						$params['sCity'] = $city;
						$list[] = '<a href="' . osc_search_url($params) . '"><span class="bc_city">' . $city . '</span></a>';
                        } else {
						$aRegion = Region::newInstance()->findByPrimaryKey($aCity['fk_i_region_id']);
						$params['sRegion'] = $aRegion['s_name'];
						$list[] = '<a href="' . osc_search_url($params) . '"><span class="bc_region">' . $aRegion['s_name'] . '</span></a>';
						$params['sCity'] = $aCity['s_name'];
						$list[] = '<a href="' . osc_search_url($params) . '"><span class="bc_city">' . $aCity['s_name'] . '</span></a>';
					}
					if( !$b_pattern ) {
						$list[count($list) - 1] = preg_replace('|<a href.*?>(.*?)</a>|', '$01', $list[count($list) - 1]);
					}
					$result .= implode($separator, $list) . $separator;
                    } else if( $b_region ) {
					$params['sRegion'] = $region;
					$list[]  = '<a href="' . osc_search_url($params) . '"><span class="bc_region">' . $region . '</span></a>';
					if( !$b_pattern ) {
						$list[count($list) - 1] = preg_replace('|<a href.*?>(.*?)</a>|', '$01', $list[count($list) - 1]);
					}
					$result .= implode($separator, $list) . $separator;
				}
			}
			if($b_pattern) {
				$result .= '<span class="bc_last">' . __('Search Results', 'breadcrumbs') . ': ' . $pattern  . '</span>'. $separator;
			}
			// remove last separator
			$result = preg_replace('|' . trim($separator) . '\s*$|', '', $result);
			$text   = $result;
            break;          
            default:
            break;
		}
        echo $text;
        return true;
	}
	function breadcrumbs_one_category_url($category_id) {
        $path = '' ;
        if ( osc_rewrite_enabled() ) {
            if ($category_id != '') {
                $category = Category::newInstance()->hierarchy($category_id) ;
                $sanitized_category = "" ;
                for ($i = count($category); $i > 0; $i--) {
                    $sanitized_category .= $category[$i - 1]['s_slug'] . '/' ;
				}
                $path = osc_base_url() . $sanitized_category ;
			}
			} else {
            $path = sprintf( osc_base_url(true) . '?page=search&sCategory=%d', $category_id ) ;
		}
        return rtrim($path, "/");
	}
	/*subcategories name search */
    if( !function_exists('get_categoriesOlx') ) {
        function get_categoriesOlx( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;
            if ( $location != 'search' ) {
                return false ;
			}
            $category_id = osc_search_category_id() ;
            if(count($category_id) > 1) {
                return false;
			}
            $category_id = (int) $category_id ;
            $categoriesOlx = Category::newInstance()->hierarchy($category_id) ;
            foreach($categoriesOlx as &$category) {
                $category['url'] = get_category_url($category) ;
			}
            return $categoriesOlx ;
		}
	}
	if( !function_exists('get_subcategories') ) {
		function get_subcategories( ) {
			$location = Rewrite::newInstance()->get_location() ;
			$section  = Rewrite::newInstance()->get_section() ;
			if ( $location != 'search' ) {
				return false ;
			}
			$category_id = osc_search_category_id() ;
			if(count($category_id) > 1) {
				return false ;
			}  
			$category_id = (int) $category_id[0] ;
			$subCategories = Category::newInstance()->findSubcategories($category_id) ;
			foreach($subCategories as &$category) {
				$category['url'] = get_category_url($category) ;			 
			}
			return $subCategories ;
		}
	}
	if ( !function_exists('get_category_url') ) {
		function get_category_url( $category ) {
			$path = '';
			if ( osc_rewrite_enabled() ) {
                if ($category != '') {
                    $category = Category::newInstance()->hierarchy($category['pk_i_id']) ;
                    $sanitized_category = "" ;
                    for ($i = count($category); $i > 0; $i--) {
                        $sanitized_category .= $category[$i - 1]['s_slug'] . '/' ;
					}
                    $path = osc_base_url() . $sanitized_category ;
				}
				} else {
                $path = sprintf( osc_base_url(true) . '?page=search&sCategory=%d', $category['pk_i_id'] ) ;
			}
            return $path;
		}
	}
	if ( !function_exists('get_category_num_items') ) {
		function get_category_num_items( $category ) {
            $category_stats = CategoryStats::newInstance()->countItemsFromCategory($category['pk_i_id']) ;
            if( empty($category_stats) ) {
                return 0 ;
			}
            return $category_stats;
		}
	}
	/*title and description */
    if( !function_exists('one_item_title') ) {
        function one_item_title() {
            $title = osc_item_title();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('title') != "" ) {
                    $title_ = Session::newInstance()->_getForm('title');
                    if( @$title_[$locale['pk_c_code']] != "" ){
                        $title = $title_[$locale['pk_c_code']];
					}
				}
			}
            return $title;
		}
	}
    if( !function_exists('one_item_description') ) {
        function one_item_description() {
            $description = osc_item_description();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('description') != "" ) {
                    $description_ = Session::newInstance()->_getForm('description');
                    if( @$description_[$locale['pk_c_code']] != "" ){
                        $description = $description_[$locale['pk_c_code']];
					}
				}
			}
            return $description;
		}
	}
	/*navigate on item page */
	define('theme_name_one', 'one');
	function one_navigate($show_next_img = false) {
		$category_id = osc_item_category_id();
		$conn   = getConnection();
		$aItems = $conn->osc_dbFetchResults("SELECT * FROM %st_item WHERE b_enabled = '1' AND b_active ='1' AND fk_i_category_id ='$category_id' ", DB_TABLE_PREFIX);
		$contLoop = true ;
		$max = count($aItems);	
		for($i = 0; $i < $max; $i++){
			if($aItems[$i]['pk_i_id'] == osc_item_id() ) {
				echo '<div class="navigate_one">';					
				if($i != 0 ) {						
					echo '<span class="navigateone_prev"><a href="', osc_item_url_ns($aItems[$i-1]['pk_i_id']), '"><span>', __('Voltar',theme_name_one),'</span></a></span>';
					} elseif($contLoop == true && $i == 0 && $max != 1) {					
					echo '<span class="navigateone_prev"><a href="', osc_item_url_ns($aItems[$max -1]['pk_i_id']), '"><span>', __('Voltar',theme_name_one),'</span></a></span>';					
				}
				if($i != $max -1) {						
					echo '<span class="navigateone_next"><a class="n_image" href="', osc_item_url_ns($aItems[$i+1]['pk_i_id']), '"><span>', __('Próximo',theme_name_one), '</span></a></span>';
					if($show_next_img == true){
						$image = null;
						$r         = ItemResource::newInstance()->getResource($aItems[$i+1]['pk_i_id']);							
						if(isset($r['pk_i_id'])) {
							$image = (string) osc_base_url().$r['s_path'].$r['pk_i_id'].".".$r['s_extension'];
						}
						if(!$image == null){
						    $id_id = $aItems[$i+1]['pk_i_id'];
							$n = $conn->osc_dbFetchResults("SELECT * FROM %st_item_description WHERE fk_i_item_id ='$id_id' ", DB_TABLE_PREFIX);							
							echo '<a class="n_image" href="', osc_item_url_ns($aItems[$i+1]['pk_i_id']), '"><div class="hover_next_img">';
							echo '<span class="title_hover">';
							echo osc_highlight( strip_tags( $n[0]['s_title'] ),70 );
							echo ' >></span>';
							echo '<img src="'. $image .'">';
							echo '</div></a>';
						}
					}
					} elseif($contLoop == true && $i == $max -1 && $max != 1) {						
					echo '<span class="navigateone_next"><a class="n_image" href="', osc_item_url_ns($aItems[0]['pk_i_id']), '"><span>', __('Próximo',theme_name_one),'</span></a></span>';					
				}
				echo '</div>';
			}
		}
	}
	/*related listings */
	if( !function_exists('related_listings') ) {
        function related_listings() {
		    $related_number = osc_get_preference('related', 'one');
            View::newInstance()->_exportVariableToView('items', array());
            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addRegion(osc_item_region());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit(0, $related_number);
            $aItems      = $mSearch->doSearch();
            $iTotalItems = count($aItems);
            if( $iTotalItems == 3 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
			}
            unset($mSearch);
            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit(0, $related_number);
            $aItems = $mSearch->doSearch();
            $iTotalItems = count($aItems);
            if( $iTotalItems > 0 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
			}
            unset($mSearch);
            return 0;
		}
	}
	/*seller ads */
	function one_user_ads() {
		$rmItemId = osc_item_id() ;
		$oa_numads = osc_get_preference('userads', 'one');
		$picOnly = osc_get_preference('useradspc', 'one');
		$mSearch = new Search() ;
		//Excluding current item
		$mSearch->dao->where(sprintf("%st_item.pk_i_id <> $rmItemId", DB_TABLE_PREFIX));
		$mSearch->dao->where(sprintf("%st_item.fk_i_user_id = %d ", DB_TABLE_PREFIX, osc_item_user_id()));
		//Adding condition for item having pictures
		if($picOnly == 1 ) {
			$mSearch->withPicture(true); //Search only Item which have pictures
		}
		//limiting number of calinbehtuk_sellers_latest ads
		$mSearch->limit(0, $oa_numads) ; // fetch number of ads to show set in preference
		//Searching with all enabled conditions
		$iaItems = $mSearch->doSearch();
		$global_items = View::newInstance()->_get('items') ; //save existing item array
		View::newInstance()->_exportVariableToView('items', $iaItems); //exporting our searched item array
		require_once 'user_ads.php';
		//calling stored item array
		View::newInstance()->_exportVariableToView('items', $global_items); //restore original item array
	}
	/*print */
	function one_print_ad() {
		// make user information available
		View::newInstance()->_exportVariableToView('user', User::newInstance()->findByPrimaryKey(osc_item_user_id()));
		$path = osc_base_url() . 'oc-content/themes/one/';
		// Get item data		
		$desc = htmlspecialchars(osc_item_description());		
		$title = osc_item_title();		
		$price = htmlspecialchars(osc_item_formated_price());		
		$pub_date = osc_item_pub_date();
		$country = osc_item_country();
		$region = osc_item_region();
		$city = osc_item_city();		
		$city_area = osc_item_city_area();	
		$zip = osc_item_zip();
		// store user information
		$phone = osc_user_phone();
		$website = osc_user_website();
		$address = osc_user_address();
		// Get & store all the image data for the current item
		if( osc_count_item_resources() > 0 ) {
			for ( $pindex = 0; osc_has_item_resources() ; $pindex++ ) {
				$image_id[] = osc_resource_id();	
				$image_path[] = osc_resource_path(); 
				$image_ext[] = osc_resource_extension();
			}	
		} 
		// prepare arrays to be posted
		if( osc_count_item_resources() > 0 ) {
			if(count($image_id)>0){	
				$image_id = implode(",", $image_id);	
				$image_path = implode(",", $image_path);
				$image_ext = implode(",", $image_ext);
			}
			} else { // solve eroor for no image
			$image_id = '';
			$image_path = '';
			$image_ext = '';
		}
		View::newInstance()->_reset('resources') ; //reset resources array (no helper function exisits for this as of now, but has been suggested)
		echo '
		<script>
		function formpopup()
        {
		window.open("about :blank","printme","width=800,height=700,scrollbars=yes,menubar=yes");
		return true;
        }
		</script>
		<form class="one_print" name="printform" action="'.$path.'print.php" method="post" target="printme" onsubmit="formpopup();">
		<input type="hidden" name="image_id" value="'.htmlspecialchars($image_id).'">		
		<input type="hidden" name="image_path" value="'.htmlspecialchars($image_path).'">		
		<input type="hidden" name="image_ext" value="'.htmlspecialchars($image_ext).'">
		<input type="hidden" name="contact_name" value="'.osc_item_contact_name().'">		
		<input type="hidden" name="contact_email" value="'.osc_item_contact_email().'">		
		<input type="hidden" name="contact_phone" value="'.$phone.'">		
		<input type="hidden" name="contact_website" value="'.$website.'">		
		<input type="hidden" name="contact_address" value="'.$address.'">
		<input type="hidden" name="site_title" value="'.osc_page_title().'">		
		<input type="hidden" name="site_url" value="'.osc_base_url().'">		
        <input type="hidden" name="desc" value="'.$desc.'">		
        <input type="hidden" name="title" value="'.$title.'">		
        <input type="hidden" name="price" value="'.$price.'">		
        <input type="hidden" name="pub_date" value="'.$pub_date.'">		
        <input type="hidden" name="country" value="'.$country.'">		
        <input type="hidden" name="region" value="'.$region.'">		
        <input type="hidden" name="city" value="'.$city.'">		
        <input type="hidden" name="city_area" value="'.$city_area.'">		
        <input type="hidden" name="zip" value="'.$zip.'">		
		</form>
		'; //end echo			
	} //end print_ad()
	/*user dashboard */
	if( !function_exists('get_user_menu') ) {
        function get_user_menu() {
            $options   = array();
            $options[] = array('name' => __('Perfil público'), 'url' => osc_user_public_profile_url(osc_logged_user_id()), 'class' => 'opt_publicprofile');
            $options[] = array(
			'name'  => __('Listings', 'one'),
			'url'   => osc_user_list_items_url(),
			'class' => 'opt_items'
            );
            $options[] = array(
			'name' => __('Alertas', 'one'),
			'url' => osc_user_alerts_url(),
			'class' => 'opt_alerts'
            );
            $options[] = array(
			'name'  => __('Perfil', 'one'),
			'url'   => osc_user_profile_url(),
			'class' => 'opt_account'
            );
            $options[] = array(
			'name'  => __('Mudar email', 'one'),
			'url'   => osc_change_user_email_url(),
			'class' => 'opt_change_email'
            );
            $options[] = array(
			'name'  => __('Mudar nome de usuario', 'one'),
			'url'   => osc_change_user_username_url(),
			'class' => 'opt_change_username'
            );
            $options[] = array(
			'name'  => __('Mudar senha', 'one'),
			'url'   => osc_change_user_password_url(),
			'class' => 'opt_change_password'
            );
            $options[] = array(
			'name'  => __('Logout', 'one'),
			'url'   => osc_user_logout_url(),
			'class' => 'opt_logout'
            );
            return $options;
		}
	}
	//top bar search category
	function top_one() {
        $text       = '';
        $location   = Rewrite::newInstance()->get_location();   
        switch ($location) {
            case('search'):
			$category   = osc_search_category_id();
			$category   = ((count($category) == 1) ? $category[0] : '');
			$b_show_all = ( $category == '');
			if($b_show_all) {
				$text = '<span class="select">' . __('Select a category', 'one') . '</span>' ;
				break; 
			}
		}
		$local = osc_current_user_locale();
		$dao = new DAO();
		$dao->dao->select('*');
		$dao->dao->from(DB_TABLE_PREFIX.'t_category_description');
		$dao->dao->where('fk_i_category_id', $category );
		$dao->dao->where('fk_c_locale_code', $local );
		$result = $dao->dao->get();
		$detail = $result->row();
		if (!empty($category)){
			echo $detail['s_name'];
			} else {
			echo $text;
		}		 
	}
	//draw subcategories in top sidebar
	function top_drawSubcategory($category) {
        if ( osc_count_subcategories2() > 0 ) {
            osc_category_move_to_children();
		?>
		<div class="top_subcategories" style="display:none;">
			<?php while ( osc_has_categories() ) { ?>
				<span id="<?php echo osc_category_id(); ?>"><?php echo osc_category_name(); ?></span>					
				<?php top_drawSubcategory(osc_category()); ?>
			<?php } ?>
		</div>
        <?php
            osc_category_move_to_parent();
		}
	}
	//set country code if one country is active	
	function user_set_country_code_one(){
		$countries = osc_get_countries();
		if( count($countries) == 1 ) {
			$loget_user = osc_logged_user_id();
			$dao = new DAO();
			$dao->dao->select('*');
			$dao->dao->from(DB_TABLE_PREFIX.'t_user');
			$dao->dao->where('pk_i_id', $loget_user);
			$result = $dao->dao->get();
			$check = $result->row();	
			$false = $check['fk_c_country_code']; 
			if(empty($false)){
				$dao = new DAO();
				$dao->dao->select('*');
				$dao->dao->from(DB_TABLE_PREFIX.'t_country');
				$result = $dao->dao->get();
				$code = $result->row();	
				$exist_code_country = $code['pk_c_code'];            			   			   
				$conn = getConnection();
				$conn->osc_dbExec("UPDATE %st_user SET fk_c_country_code = '%s' WHERE pk_i_id = '%d' ", DB_TABLE_PREFIX, $exist_code_country, $loget_user);	
			}
		}
	}
	osc_add_hook('user_edit_completed', 'user_set_country_code_one');	
	//setting most search
	function most_used_search(){
		if ( osc_get_preference('save_latest_searches', 'osclass') == 1){
			$set_after = osc_get_preference('number_order', 'one');
			$set_number = osc_get_preference('number_set', 'one');	
			$conn   = getConnection();
			$details = $conn->osc_dbFetchResults("SELECT COUNT(*), s_search FROM %st_latest_searches GROUP BY s_search HAVING COUNT(*) > '$set_after' LIMIT $set_number", DB_TABLE_PREFIX);
			foreach ($details as $detail){
				echo '<a href="/index.php?page=search&sPattern='.$detail['s_search'].'">';
				echo $detail['s_search'];
				echo '</a>, ';	
			}
		}
	}	
	//most active categories
	function most_active_categoryes(){
	    $number = 5;
		$local = osc_current_user_locale();
		$conn   = getConnection();
		$details = $conn->osc_dbFetchResults("SELECT * FROM %st_category_stats order by i_num_items desc LIMIT $number", DB_TABLE_PREFIX);
		$url = osc_base_url();        
		foreach($details as $id){
			$dao = new DAO();
			$dao->dao->select('*');
			$dao->dao->from(DB_TABLE_PREFIX.'t_category_description');
			$dao->dao->where('fk_i_category_id', $id['fk_i_category_id']);
			$dao->dao->where('fk_c_locale_code', $local);
			$result = $dao->dao->get();
			$item_echo = $result->row();
			echo '<div class="dst">';
			echo '<a href="'. $url.'index.php?page=search&sCategory='.$item_echo['fk_i_category_id'].'">';
			echo $item_echo['s_name'] . "<br />";
			echo '</a>';
			echo '</div>';
		}
	}
	function region_select_active(){
		$url = osc_base_url();
		$number_regions = 42;
		$dao = new DAO();
		$dao->dao->select('r.*, c.s_name');
		$dao->dao->from(DB_TABLE_PREFIX.'t_region_stats'. ' r');
		$dao->dao->join(DB_TABLE_PREFIX.'t_region'. ' c', 'c.pk_i_id = r.fk_i_region_id');
		$dao->dao->orderBy('r.i_num_items', 'desc');
		$dao->dao->limit(0, $number_regions);
		$result = $dao->dao->get();
		$regions = $result->result();	
		echo '<ul class="ul_reg">';
		foreach($regions as $r){
			echo '<li>';
			echo '<a href="'. $url.'index.php?page=search&sRegion='.$r['fk_i_region_id'].'"><span>'.$r['s_name'].'</span></a>';
			echo '</li>';
		}
		echo '</ul>';
	}	
	function cust_all_premiums_ontop() {
	if(Params::getParam('OnlyPremium') == 1){
		 Search::newInstance()->onlyPremium(true);		 
		 }
	}	
	osc_add_hook('search_conditions', 'cust_all_premiums_ontop');
?>