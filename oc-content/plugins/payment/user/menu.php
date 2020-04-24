<?php
    $itemsPerPage = (Params::getParam('itemsPerPage') != '') ? Params::getParam('itemsPerPage') : 5;
    $page         = (Params::getParam('iPage') != '') ? Params::getParam('iPage') : 0;
    $total_items  = Item::newInstance()->countByUserIDEnabled($_SESSION['userId']);
    $total_pages  = ceil($total_items/$itemsPerPage);
    $items        = Item::newInstance()->findByUserIDEnabled($_SESSION['userId'], $page * $itemsPerPage, $itemsPerPage);

    View::newInstance()->_exportVariableToView('items', $items);
    View::newInstance()->_exportVariableToView('list_total_pages', $total_pages);
    View::newInstance()->_exportVariableToView('list_total_items', $total_items);
    View::newInstance()->_exportVariableToView('items_per_page', $itemsPerPage);
    View::newInstance()->_exportVariableToView('list_page', $page);
?>
<h2><?php _e('Paypal & your listings', 'payment'); ?></h2>
<?php if(osc_count_items() == 0) { ?>
    <h3><?php _e('You don\'t have any listing yet', 'payment'); ?></h3>
<?php } else { ?>
    <?php while(osc_has_items()) { ?>
            <div class="item" >
                    <h3>
                        <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>
                    </h3>
                    <p>
                    <?php _e('Data de publicação', 'payment') ; ?>: <?php echo osc_format_date(osc_item_pub_date()) ; ?><br />
                    <?php _e('Price', 'payment') ; ?>: <?php echo osc_format_price(osc_item_price()); ?>
                    </p>
                    <p class="options">
                        <?php if(osc_get_preference("pay_per_post", "payment")=="1") { ?>
                            <?php if(ModelPayment::newInstance()->publishFeeIsPaid(osc_item_id())) { ?>
                                <strong><?php _e('Pago!', 'payment'); ?></strong>
                            <?php } else { ?>
                                <strong><a href="<?php echo osc_route_url('payment-publish', array('itemId' => osc_item_id())); ?>"><?php _e('Destaque na Categoria', 'payment'); ?></a></strong>
                            <?php }; ?>
                        <?php }; ?>
                        <?php if(osc_get_preference("pay_per_post", "payment")=="1" && osc_get_preference("allow_premium", "payment")=="1") { ?>
                            <span>|</span>
                        <?php }; ?>
                        <?php if(osc_get_preference("allow_premium", "payment")=="1") { ?>
                            <?php if(ModelPayment::newInstance()->premiumFeeIsPaid(osc_item_id())) { ?>
                                <strong><?php _e('Already premium!', 'payment'); ?></strong>
                            <?php } else { ?>
                                <strong><a href="<?php echo osc_route_url('payment-premium', array('itemId' => osc_item_id())); ?>"><?php _e('Destacar na Página Inicial', 'payment'); ?></a></strong>
                            <?php }; ?>
                        <?php }; ?>
                    </p>
                    <br />
            </div>
    <?php } ?>
    <br />
    <div class="paginate">
    <?php for($i = 0 ; $i < osc_list_total_pages() ; $i++) {
        if($i == osc_list_page()) {
            printf('<a class="searchPaginationSelected" href="%s">%d</a>', osc_route_url('payment-user-menu-page', array('iPage' => $i)), ($i + 1));
        } else {
            printf('<a class="searchPaginationNonSelected" href="%s">%d</a>', osc_route_url('payment-user-menu-page', array('iPage' => $i)), ($i + 1));
        }
    } ?>
    </div>
<?php } ?>