<ul data-type="horizontal" data-role="controlgroup">
<?php if( osc_is_web_user_logged_in() ) { ?>
<a href="<?php echo osc_user_logout_url() ; ?>" data-role="button"><?php _e('Sair', 'osc_mobile') ; ?></a>
<?php } else {?>
<a href="<?php echo osc_user_login_url(); ?>" data-role="button"><?php _e('Login','osc_mobile')?></a>
<?php } ?>
</ul>