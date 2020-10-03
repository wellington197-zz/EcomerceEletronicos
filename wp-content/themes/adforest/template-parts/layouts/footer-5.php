<?php global $adforest_theme; ?>
<section class="new-footer-section padding-25">
  <div class="container">
    <div class="row">
      <div class="footer-last-section">
        <div class="col-lg-7 col-xs-12 col-md-7">
          <div class="new-footer-text-h1">
            <?php
			if( isset( $adforest_theme['sb_footer'] ) && $adforest_theme['sb_footer'] != "" )
            {
                echo wp_kses( $adforest_theme['sb_footer'], adforest_required_tags() );
            }
			?>
          </div>
        </div>
        <div class="col-lg-5 col-xs-12 col-md-5">
          <div class="new-social-icons">
            <ul class="list-inline">
              <?php
                 foreach( $adforest_theme['social_media']  as $index => $val)
                 {
            ?>
            <?php
                     if($val != "")
                     {
			?>
            			<li>
                        <a href="<?php echo esc_url($val); ?>">
                        <i class="<?php echo adforest_social_icons( $index ); ?>"></i>
                        </a>
                        </li>
            <?php
                     }
                 }
			?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>