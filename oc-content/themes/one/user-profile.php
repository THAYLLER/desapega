<?php
	/*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
	
    $locales   = __get('locales');
    $user = osc_user();
    osc_enqueue_style('jquery-ui-custom', osc_current_web_theme_styles_url('jquery-ui/jquery-ui-1.8.20.custom.css'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
	</head>
    <body class="dash_b">
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_account">
            <h1>
                <strong><?php _e('User account manager', 'one'); ?></strong>
			</h1>
            <div id="sidebar">
                <?php echo osc_private_user_menu( get_user_menu() ); ?>
			</div>
            <div id="main" class="modify_profile">
                <h2><?php _e('Update your profile', 'one'); ?></h2>
                <?php UserForm::location_javascript(); ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#delete_account").click(function(){
                            $("#dialog-delete-account").dialog('open');
						});
						
                        $("#dialog-delete-account").dialog({
                            autoOpen: false,
                            modal: true,
                            buttons: {
                                "<?php echo osc_esc_js(__('Delete', 'one')); ?>": function() {
                                    window.location = '<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>';
								},
                                "<?php echo osc_esc_js(__('Cancel', 'one')); ?>": function() {
                                    $( this ).dialog( "close" );
								}
							}
						});
					});
				</script>
                <form action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="profile_post" />
                    <fieldset>
                        <div class="row">
                            <label for="name"><?php _e('Name', 'one'); ?></label>
                            <?php UserForm::name_text(osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="email"><?php _e('Username', 'one'); ?></label>
                            <span class="update">
                                <?php echo osc_user_username(); ?><br />
                                <?php if(osc_user_username()==osc_user_id()) { ?>
                                    <a href="<?php echo osc_change_user_username_url(); ?>"><?php _e('Modify username', 'one'); ?></a>
								<?php }; ?>
							</span>
						</div>
                        <div class="row">
                            <label for="email"><?php _e('E-mail', 'one'); ?></label>
                            <span class="update">
                                <?php echo osc_user_email(); ?><br />
                                <a href="<?php echo osc_change_user_email_url(); ?>"><?php _e('Modify e-mail', 'one'); ?></a> <a href="<?php echo osc_change_user_password_url(); ?>" ><?php _e('Modify password', 'one'); ?></a>
							</span>
						</div>
                        <div class="row">
                            <label for="user_type"><?php _e('User type', 'one'); ?></label>
                            <?php UserForm::is_company_select(osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="phoneMobile"><?php _e('Cell phone', 'one'); ?></label>
                            <?php UserForm::mobile_text(osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="phoneLand"><?php _e('Phone', 'one'); ?></label>
                            <?php UserForm::phone_land_text(osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="country"><?php _e('Country', 'one'); ?> *</label>
                            <?php UserForm::country_select(osc_get_countries(), osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="region"><?php _e('Region', 'one'); ?> *</label>
                            <?php UserForm::region_select(osc_get_regions(), osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="city"><?php _e('City', 'one'); ?> *</label>
                            <?php UserForm::city_select(osc_get_cities(), osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="city_area"><?php _e('Contact phone', 'one'); ?></label>
                            <?php UserForm::city_area_text(osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="address"><?php _e('Address', 'one'); ?></label>
                            <?php UserForm::address_text(osc_user()); ?>
						</div>
                        <div class="row">
                            <label for="webSite"><?php _e('Website', 'one'); ?></label>
                            <?php UserForm::website_text(osc_user()); ?>
						</div>
                        <div  class="row field" style="margin-left:140px;">
                            <?php UserForm::multilanguage_info($locales, osc_user()); ?>
						</div>
                        <div class="row field"style="margin-left:160px;">
                            <button type="submit"><?php _e('Update', 'one'); ?></button>
                            <button id="delete_account" type="button"><?php _e('Delete my account', 'one'); ?></button>
						</div>
                        <?php osc_run_hook('user_form'); ?>
					</fieldset>
				</form>
			</div>
		</div>
        <div id="dialog-delete-account" title="<?php _e('Delete account', 'one'); ?>" class="has-form-actions hide">
            <div class="form-horizontal">
                <div class="form-row">
                    <p><?php _e('All your listings and alerts will be removed, this action can not be undone.', 'one');?></p>
				</div>
			</div>
		</div>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>