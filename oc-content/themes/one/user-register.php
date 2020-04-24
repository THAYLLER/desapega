<?php
	/*
		*
		*                        Copyright (C) 2015 Puiu Calin
		*
		*       This program is a commercial software. Copying or distribution without a license is forbidden.
		*     
	*/
	
    osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
	</head>
    <body>
        <?php UserForm::js_validation(); ?>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_forms">
            <div class="inner">
                <h1><?php _e('Register an account for free', 'one'); ?></h1>
                <ul id="error_list"></ul>
                <form name="register" id="register" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="register" />
                    <input type="hidden" name="action" value="register_post" />
					
                    <fieldset>
                        <label for="name"><?php _e('Name', 'one'); ?></label> <?php UserForm::name_text(); ?><br />
						<label for="user_type"><?php _e('Tipo de usuário', 'one') ; ?></label>
                        <div class="userss">
							<select name="b_company" id="b_company">						
								<option value="0"><?php _e('Usuário','one'); ?></option>
								<option value="1"><?php _e('Empresa','one'); ?></option>
								<select>
								</div>
								<br />
								<label for="password"><?php _e('Password', 'one'); ?></label> <?php UserForm::password_text(); ?><br />
								<label for="password"><?php _e('Re-type password', 'one'); ?></label> <?php UserForm::check_password_text(); ?><br />
								<p id="password-error" style="display:none;">
									<?php _e('Passwords don\'t match', 'one'); ?>.
								</p>
								<label for="email"><?php _e('E-mail', 'one'); ?></label> <?php UserForm::email_text(); ?><br />
								<?php osc_run_hook('user_register_form'); ?>
								<?php osc_show_recaptcha('register'); ?>
								<button type="submit"><?php _e('Create', 'one'); ?></button>
							</fieldset>
						</form>
					</div>
				</div>
				<?php osc_current_web_theme_path('footer.php'); ?>
			</body>
		</html>		