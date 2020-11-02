
<?php
    $wpSectionsQuery = new WP_Query( array( 'post_type' => 'section', 'orderby' => 'menu_order' ) );
    $index = 0;
    while ( $wpSectionsQuery->have_posts() ) : $wpSectionsQuery->the_post();
    $imgalign = get_post_meta(get_the_ID(), 'section_imgalign', true );
    $isfullscreen = get_post_meta(get_the_ID(), 'section_fullscreen', true );
    $sectionclass = get_post_meta(get_the_ID(), 'section_class', true ) ? get_post_meta(get_the_ID(), 'section_class', true ) : '';
?>

        <?php
            $noMargin = get_post_meta(get_the_ID(), 'section_nomargin', true ) == 1;
            
            $noMarginClass = $noMargin ? 'container__margin--none' : '';
            echo '<div class="container section ' . $noMarginClass . ' ' . get_post_meta(get_the_ID(), "section_class", true ) . '">';
            if(!$noMargin){
                echo '<div class="row">';
                echo '<div class="col-sm-12 blog-main">';
                echo '<div class="" id="' . get_post_meta(get_the_ID(), "section_id", true ) . '">';
            }
                
            if(get_post_meta(get_the_ID(), 'section_showtitle', true ) == 1){
                echo '<h2 class="section-title">' . get_the_title() . '</h2>';
            }
            ?>
            <?php echo the_content(); ?>

            <?php
            if(get_post_meta(get_the_ID(), 'section_nomargin', true ) != 1){
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            ?>

<?php 
$index++;
endwhile;
?>
