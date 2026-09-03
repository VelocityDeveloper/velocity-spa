<?php

defined('ABSPATH') || exit;

if (class_exists('WP_Customize_Control') && !class_exists('Velocity_Spa_Repeater_Control')) {
	class Velocity_Spa_Repeater_Control extends WP_Customize_Control
	{
		public $type = 'velocity_spa_repeater';

		protected function render_content()
		{
			$value = $this->value();
			if (is_string($value)) {
				$decoded = json_decode($value, true);
				$value = is_array($decoded) ? $decoded : array();
			}
			$value = is_array($value) ? $value : array();
			?>
			<div class="velocity-spa-repeater">
				<?php if ($this->label) : ?><span class="customize-control-title"><?php echo esc_html($this->label); ?></span><?php endif; ?>
				<?php if ($this->description) : ?><p class="description"><?php echo esc_html($this->description); ?></p><?php endif; ?>
				<input type="hidden" class="velocity-spa-repeater-store" <?php $this->link(); ?> value="<?php echo esc_attr(wp_json_encode($value)); ?>">
				<div class="velocity-spa-repeater-items"><?php foreach ($value as $item) { echo $this->item_markup($item); } // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<button type="button" class="button button-primary velocity-spa-repeater-add"><?php esc_html_e('Tambah Slider', 'justg'); ?></button>
				<script type="text/html" class="velocity-spa-repeater-template"><?php echo $this->item_markup(array()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></script>
			</div>
			<?php
		}

		private function item_markup($item)
		{
			$image_id = isset($item['image_id']) ? absint($item['image_id']) : 0;
			$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
			ob_start();
			?>
			<div class="velocity-spa-repeater-item is-collapsed">
				<button type="button" class="velocity-spa-repeater-toggle" aria-expanded="false"><span class="velocity-spa-repeater-label"><?php esc_html_e('Slider', 'justg'); ?></span><span class="velocity-spa-repeater-arrow" aria-hidden="true"></span></button>
				<div class="velocity-spa-repeater-body">
					<input type="hidden" data-field="image_id" value="<?php echo esc_attr($image_id); ?>">
					<div class="velocity-spa-repeater-preview<?php echo $image_url ? ' has-image' : ''; ?>">
						<?php if ($image_url) : ?><img src="<?php echo esc_url($image_url); ?>" alt=""><?php endif; ?>
						<button type="button" class="velocity-spa-repeater-clear" aria-label="<?php esc_attr_e('Hapus gambar', 'justg'); ?>" title="<?php esc_attr_e('Hapus gambar', 'justg'); ?>"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="velocity-spa-repeater-media-actions"><button type="button" class="button velocity-spa-repeater-select"><?php echo esc_html($image_url ? __('Ganti Gambar', 'justg') : __('Pilih Gambar', 'justg')); ?></button></div>
					<div class="velocity-spa-repeater-actions"><button type="button" class="button velocity-spa-repeater-clone"><?php esc_html_e('Clone', 'justg'); ?></button><button type="button" class="button button-secondary velocity-spa-repeater-remove"><?php esc_html_e('Hapus Slider', 'justg'); ?></button></div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}
	}
}
