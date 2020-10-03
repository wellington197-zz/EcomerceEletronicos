<?php  global $product; ?>

<div class="adforest_product-single-detial"> 
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab"><?php echo esc_html__( 'Description', 'adforest' ); ?></a></li>
    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab"><?php echo esc_html__( 'Reviews', 'adforest' ); ?></a></li>
    <?php
		$product	=	 wc_get_product( get_the_ID() );
		$attributes = $product->get_attributes();
		if(is_array($attributes) && count($attributes) > 0 )
		{
			?>
    <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab"><?php echo esc_html__( 'Additional Information', 'adforest' ); ?></a></li>
    <?php
							}
							?>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="Section1">
      <?php the_content(); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="Section2">
      <div class="comments">
        <?php //comments_template('', true); ?>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="Section3">
      <?php do_action( 'woocommerce_product_additional_information', $product ); ?>
    </div>
  </div>
</div>
