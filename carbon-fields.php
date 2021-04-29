<?php
use Carbon_Fields\Block;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {    
    Container::make( 'theme_options', __( 'Custom Code', 'crb' ) )
        ->add_fields( array(
            Field::make( 'textarea', 'mos_additional_coding', 'Additional Coding' ),
        ));
    /*Container::make( 'post_meta', 'Custom Data' )
        ->where( 'post_type', '=', 'page' )
        ->add_fields( array(
            Field::make( 'map', 'crb_location' )
                ->set_position( 37.423156, -122.084917, 14 ),
            Field::make( 'sidebar', 'crb_custom_sidebar' ),
            Field::make( 'image', 'crb_photo' ),
        ));*/
    Block::make( __( 'Mos Image Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-image-heading', __( 'Heading' ) ),
        Field::make( 'image', 'mos-image-media', __( 'Image' ) ),
        Field::make( 'rich_text', 'mos-image-content', __( 'Content' ) ),
        //Field::make( 'color', 'mos-image-hr', __( 'Border Color' ) ),
        Field::make( 'text', 'mos-image-btn-title', __( 'Button' ) ),
        Field::make( 'text', 'mos-image-btn-url', __( 'URL' ) ),
        Field::make( 'select', 'mos-image-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'id-alt' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-image-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-image-block text-<?php echo esc_html( $fields['mos-image-alignment'] ) ?>">
                <div class="img-part"><?php echo wp_get_attachment_image( $fields['mos-image-media'], 'full' ); ?></div>
                <div class="text-part">
                    <h4><?php echo esc_html( $fields['mos-image-heading'] ); ?></h4>
<!--                    <hr style="background-color: <?php echo esc_html( $fields['mos-image-hr'] ) ?>;">-->
                <?php if ($fields['mos-image-content']) :?>
                    <div class="desc"><?php echo apply_filters( 'the_content', $fields['mos-image-content'] ); ?></div> 
                <?php endif?>                 
                <?php if ($fields['mos-image-btn-title'] && $fields['mos-image-btn-url']) :?>   
                    <div class="wp-block-buttons"><div class="wp-block-button"><a href="<?php echo esc_url( $fields['mos-image-btn-url'] ); ?>" title="" class="wp-block-button__link"><?php echo esc_html( $fields['mos-image-btn-title'] ); ?></a></div></div>  
                <?php endif?>                 
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos 3 Column CTA' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-3ccta-heading', __( 'Heading' ) ),        
        Field::make( 'image', 'mos-3ccta-media', __( 'Image' ) ),
        Field::make( 'text', 'mos-3ccta-link', __( 'Link' ) ),
        Field::make( 'textarea', 'mos-3ccta-content', __( 'Content' ) ),
        Field::make( 'image', 'mos-3ccta-bgimage', __( 'Background Image' ) ),
        Field::make( 'color', 'mos-3ccta-bgcolor', __( 'Background Color' ) ),
    ))
    ->set_icon( 'phone' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-3ccta-wrapper <?php echo $attributes['className'] ?>" style="<?php if ($fields['mos-3ccta-bgcolor']) echo 'background-color:'.esc_html($fields['mos-3ccta-bgcolor']).';' ?><?php if ($fields['mos-3ccta-bgimage']) echo 'background-image:url('.wp_get_attachment_url($fields['mos-3ccta-bgimage']).');' ?>">
            <div class="mos-3ccta">
                <div class="call-left">
                    <h3><?php echo esc_html( $fields['mos-3ccta-heading'] ); ?></h3>
                </div>
                <div class="call-center">
                    <a href="<?php echo esc_url( $fields['mos-3ccta-link'] ); ?>" class="" target="_blank"><?php echo wp_get_attachment_image( $fields['mos-3ccta-media'], 'full' ); ?></a>
                </div>
                <div class="call-right">
                    <div class="desc"><?php echo esc_html( $fields['mos-3ccta-content'] ); ?></div>
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Icon Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-icon-heading', __( 'Heading' ) ),
        Field::make( 'text', 'mos-icon-class', __( 'Icon Class' ) ),
        Field::make( 'color', 'mos-icon-color', __( 'Color' ) ),
        Field::make( 'textarea', 'mos-icon-content', __( 'Content' ) ),
        Field::make( 'select', 'mos-icon-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_description( __( 'Use Font Awesome in <b>Icon class</b>, you can find Fontawesome <a href="https://fontawesome.com/v4.7.0/cheatsheet/">Here</a>.' ) )
    ->set_icon( 'editor-customchar' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-icon-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-icon-block text-<?php echo esc_html( $fields['mos-icon-alignment'] ) ?>">
                <?php if ($fields['mos-icon-class']) : ?>
                <div class="icon-part"><i class="fa <?php echo esc_html( $fields['mos-icon-class'] ); ?>" style="--color:<?php echo esc_html( $fields['mos-icon-color'] ); ?>"></i></div>
                <?php endif;?>
                <div class="text-part">
                    <?php if ($fields['mos-icon-heading']) : ?>
                    <h4><?php echo esc_html( $fields['mos-icon-heading'] ); ?></h4>
                    <?php endif;?>
                    <?php if ($fields['mos-icon-content']) : ?>
                    <div class="desc"><?php echo  $fields['mos-icon-content']; ?></div>                    
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Counter Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-counter-prefix', __( 'Prefix' ) ),
        Field::make( 'text', 'mos-counter-number', __( 'Number' ) ),
        Field::make( 'text', 'mos-counter-suffix', __( 'Suffix' ) ),
        Field::make( 'color', 'mos-counter-color', __( 'Heading Color' ) ),
        Field::make( 'color', 'mos-counter-text-color', __( 'Text Color' ) ),
        Field::make( 'textarea', 'mos-counter-content', __( 'Content' ) ),
        Field::make( 'select', 'mos-counter-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'clock' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-counter-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-counter-block text-<?php echo esc_html( $fields['mos-counter-alignment'] ) ?>">
                <h2 style="color: <?php echo esc_html( $fields['mos-counter-color'] ); ?>"><span class="prefix"><?php echo esc_html( $fields['mos-counter-prefix'] ); ?></span><span class='numscroller counter' data-min='1' data-counterup-time="1500"><?php echo esc_html( $fields['mos-counter-number'] ); ?></span><span class="suffix"><?php echo esc_html( $fields['mos-counter-suffix'] ); ?></span></h2>
                <div class="mb-0" style="color: <?php echo esc_html( $fields['mos-counter-text-color'] ); ?>"><?php echo esc_html( $fields['mos-counter-content'] ); ?></div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Pricing Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-pricing-title', __( 'Heading' ) ),
        Field::make( 'text', 'mos-pricing-symbol', __( 'Symbol' ) ),
        Field::make( 'text', 'mos-pricing-amount', __( 'Amount' ) ),
        Field::make( 'text', 'mos-pricing-period', __( 'Period' ) )
            ->set_attribute( 'placeholder', 'Ex: per clean / billed weekly' ),
        Field::make( 'text', 'mos-pricing-subtitle', __( 'Sub Heading' ) ),
        Field::make( 'textarea', 'mos-pricing-desc', __( 'Desacription' ) ),
        Field::make( 'complex', 'mos-pricing-features', __( 'Features' ) )
            ->add_fields( array(
                Field::make( 'text', 'item', __( 'Feature' ) ),
            )),
        Field::make( 'text', 'mos-pricing-btn-title', __( 'Button' ) ),
        Field::make( 'text', 'mos-pricing-btn-url', __( 'URL' ) ),
        Field::make( 'select', 'mos-member-alignment', __( 'Content Alignment' ) )
        ->set_options( array(
            'left' => 'Left',
            'right' => 'Right',
            'center' => 'Center',
        ))
    ))
    ->set_icon( 'list-view' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-pricing-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-pricing text-<?php echo esc_html( $fields['mos-member-alignment'] ) ?>">            
                <div class="title-part">
                    <h3><?php echo esc_html( $fields['mos-pricing-title'] ); ?></h3>
                </div>
                <div class="pricing-part">
                    <div class="pricing-value"> <span class="pricing-symbol"><?php echo esc_html( $fields['mos-pricing-symbol'] ); ?></span> <span class="pricing-amount"><?php echo esc_html( $fields['mos-pricing-amount'] ); ?></span> <span class="plan-period"><?php echo esc_html( $fields['mos-pricing-period'] ); ?></span>
                    </div>
                </div>
                <?php if (@$fields['mos-pricing-subtitle']) : ?>
                    <h5 class="desc-subtitle"><?php echo esc_html( $fields['mos-pricing-subtitle'] ); ?></h5>
                <?php endif?>
                <?php if (@$fields['mos-pricing-desc']) : ?>
                    <div class="desc-part"><?php echo esc_html( $fields['mos-pricing-desc'] ); ?></div>
                <?php endif?>
                <?php if (sizeof(@$fields['mos-pricing-features'])) : ?>
                <div class="features-part">
                    <ul class="pricing-features">
                        <?php foreach ($fields['mos-pricing-features'] as $value) : ?>
                            <li><?php echo $value['item'] ?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <?php endif?>
                <?php if(@$fields['mos-pricing-btn-title'] && @$fields['mos-pricing-btn-url']) : ?>
                <div class="wp-block-buttons"><div class="wp-block-button"><a href="<?php echo esc_html( $fields['mos-pricing-btn-url'] ); ?>" title="" class="wp-block-button__link"><?php echo esc_html( $fields['mos-pricing-btn-title'] ); ?></a></div></div>
                <?php endif;?>
            
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Team Member' ) )
    ->add_fields( array(
        Field::make( 'image', 'mos-member-media', __( 'Image' ) ),
        Field::make( 'text', 'mos-member-title', __( 'Name' ) ),
        Field::make( 'text', 'mos-member-designation', __( 'Designation' ) ),
        Field::make( 'text', 'mos-member-url', __( 'URL' ) ),
        Field::make( 'select', 'mos-member-alignment', __( 'Content Alignment' ) )
        ->set_options( array(
            'left' => 'Left',
            'right' => 'Right',
            'center' => 'Center',
        ))
    ))
    ->set_icon( 'admin-users' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-member-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-member position-relative text-<?php echo esc_html( $fields['mos-member-alignment'] ) ?>"> 
                <?php if (@$fields['mos-member-media']): ?>
                    <div class="img-part">
                        <?php echo wp_get_attachment_image( $fields['mos-member-media'], 'full' ); ?>   
                    </div>  
                <?php endif?>
                <div class="text-part">
                    <?php if (@$fields['mos-member-title']): ?>
                        <h3 class="title-part"><?php echo esc_html( $fields['mos-member-title'] ); ?></h3>
                    <?php endif?>
                    <?php if (@$fields['mos-member-designation']): ?>
                        <div class="designation-part">
                            <?php echo esc_html( $fields['mos-member-designation'] ); ?>
                        </div> 
                    <?php endif?>
                </div> 
                <?php if (@$fields['mos-member-url']): ?>
                    <a class="hidden-link" href="<?php echo esc_html( $fields['mos-member-url'] ); ?>">Read More</a> 
                <?php endif?>           
            </div>
        </div>
        <?php
    });
}
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}