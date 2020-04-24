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
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_forms">
            <div id="contact" class="inner">
				<div class="border">
					<h1><?php _e('Send to a friend', 'one'); ?></h1>
					<ul id="error_list"></ul>
					<form id="sendfriend" name="sendfriend" action="<?php echo osc_base_url(true); ?>" method="post">
						<fieldset>
							<input type="hidden" name="action" value="send_friend_post" />
							<input type="hidden" name="page" value="item" />
							<input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
							<label class="title"><?php _e('Listing', 'one'); ?>: <a href="<?php echo osc_item_url( ); ?>"><span><?php echo osc_item_title(); ?></span></a></label><br />
							<?php if(osc_is_web_user_logged_in()) { ?>
								<input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
								<input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
								<?php } else { ?>
								<label for="yourName"><?php _e('Your name', 'one'); ?></label> <?php SendFriendForm::your_name(); ?> <br />
								<label for="yourEmail"><?php _e('Your e-mail address', 'one'); ?></label> <?php SendFriendForm::your_email(); ?> <br />
							<?php }; ?>
							<label for="friendName"><?php _e("Your friend's name", 'one'); ?></label> <?php SendFriendForm::friend_name(); ?> <br />
							<label for="friendEmail"><?php _e("Your friend's e-mail address", 'one'); ?></label> <?php SendFriendForm::friend_email(); ?> <br />
							<label for="message"><?php _e('Message', 'one'); ?></label> <?php SendFriendForm::your_message(); ?> <br />
							<?php osc_show_recaptcha(); ?>
							<br />
							<button type="submit"><?php _e('Send', 'one'); ?></button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
        <?php SendFriendForm::js_validation(); ?>
        <?php osc_current_web_theme_path('footer.php'); ?>
	</body>
</html>