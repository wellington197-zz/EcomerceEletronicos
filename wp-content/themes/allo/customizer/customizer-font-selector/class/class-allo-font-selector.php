<?php
/**
 * Font selector.
 *
 * @package Allo
 * @since 1.0
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}
/**
 * Class Allo_Font_Selector
 */
class Allo_Font_Selector extends WP_Customize_Control {
	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'selector-font';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'allo-select-script', TL_ALLO_TEMPLATE_DIR_URL . '/customizer/customizer-font-selector/js/select.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'allo-select-style', TL_ALLO_TEMPLATE_DIR_URL . '/customizer/customizer-font-selector/css/select.css', null, '1.0' );
		wp_enqueue_script( 'allo-typography-js', TL_ALLO_TEMPLATE_DIR_URL . '/customizer/customizer-font-selector/js/typography.js', array( 'jquery', 'allo-select-script' ), '1.0', true );
		wp_enqueue_style( 'allo-typography', TL_ALLO_TEMPLATE_DIR_URL . '/customizer/customizer-font-selector/css/typography.css', null );
	}

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper in $this->render().
	 *
	 * @access protected
	 */
	protected function render_content() {
		$this_val = $this->value(); ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<select class="allo-typography-select" <?php $this->link(); ?>>
				<option value="" 
				<?php if ( ! $this_val ) {
					echo 'selected="selected"';} ?>><?php esc_html_e( 'Default', 'allo' ); ?></option>
				<?php
				// Get Standard font options
				$std_fonts = allo_get_standard_fonts();
				if ( ! empty( $std_fonts ) ) { ?>
					<optgroup label="<?php esc_html_e( 'Standard Fonts', 'allo' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $std_fonts as $font ) {
						?>
							<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php }

				// Google font options
				$google_fonts = allo_get_google_fonts_array();
				if ( ! empty( $google_fonts ) ) { ?>
					<optgroup label="<?php esc_html_e( 'Google Fonts', 'allo' ); ?>">
						<?php
						// Loop through font options and add to select
						foreach ( $google_fonts as $font ) { ?>
							<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php } ?>
			</select>
		</label>
		<?php
	}
}