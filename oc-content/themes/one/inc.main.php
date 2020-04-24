<?php
    $total_categories   = osc_count_categories();
    $col1_max_cat       = ceil($total_categories/3);
    $col2_max_cat       = ceil(($total_categories-$col1_max_cat)/2);
    $col3_max_cat       = $total_categories-($col1_max_cat+$col2_max_cat);
?>
<div class="categories <?php echo 'c' . $total_categories; ?>">
    <?php osc_goto_first_category(); ?>
    <?php
        $i      = 1;
        $x      = 1;
        $col    = 1;		
        if(osc_count_categories () > 0) {
            echo '<div class="col c1">';
		}
	?>
    <?php while ( osc_has_categories() ) { ?>
        <div class="category second_category">
			<strong class="<?php echo osc_category_id(); ?>"  title="<?php echo osc_category_description() ; ?>" >
				<span class="image">
					<?php
						if(file_exists(osc_themes_path() . 'one/images/categ_image/' . osc_category_id() . '.png')) {
							$img = osc_base_url() . 'oc-content/themes/one/images/categ_image/' . osc_category_id() . '.png';
							} else {
							$img = osc_base_url() . 'oc-content/themes/one/images/none.png';
						}
					?> 
					<img src="<?php echo $img; ?>" alt="<?php echo osc_category_name() ; ?>"/>
				</span>
				<span class="a"><span><?php echo osc_highlight( strip_tags( osc_category_name() ),52 ); ?></span></span> 
			</strong>        		                   				  
		</div>
        <?php
            if (($col==1 && $i==$col1_max_cat) || ($col==2 && $i==$col2_max_cat) || ($col==3 && $i==$col3_max_cat)) {
                $i = 1;
                $col++;
                echo '</div>';
                if($x < $total_categories) {
                    echo '<div class="col c'.$col.'">';
				}
				} else {
                $i++;
			}
            $x++;
		?>
	<?php } ?>	
</div>