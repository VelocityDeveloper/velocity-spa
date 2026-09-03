(function (api, $) {
	'use strict';

	function Repeater(control) {
		this.$root = control.container.find('.velocity-spa-repeater');
		this.$store = this.$root.find('.velocity-spa-repeater-store');
		this.$items = this.$root.find('.velocity-spa-repeater-items');
		this.template = (this.$root.find('.velocity-spa-repeater-template').html() || '').trim();
		this.$root.find('.velocity-spa-repeater-template').remove();
		this.bind();
		this.updateLabels();
	}

	Repeater.prototype.bind = function () {
		var self = this;
		this.$root.on('click', '.velocity-spa-repeater-add', function (event) {
			event.preventDefault();
			self.$items.append($(self.template));
			self.sync();
			self.updateLabels();
		});
		this.$root.on('click', '.velocity-spa-repeater-toggle', function (event) {
			event.preventDefault();
			var $item = $(this).closest('.velocity-spa-repeater-item');
			$item.toggleClass('is-collapsed');
			$(this).attr('aria-expanded', !$item.hasClass('is-collapsed'));
		});
		this.$root.on('click', '.velocity-spa-repeater-remove', function (event) {
			event.preventDefault();
			$(this).closest('.velocity-spa-repeater-item').remove();
			self.sync();
			self.updateLabels();
		});
		this.$root.on('click', '.velocity-spa-repeater-clone', function (event) {
			event.preventDefault();
			var $source = $(this).closest('.velocity-spa-repeater-item');
			var $clone = $(self.template);
			var imageId = $source.find('[data-field="image_id"]').val();
			var imageUrl = $source.find('.velocity-spa-repeater-preview img').attr('src') || '';
			$clone.find('[data-field="image_id"]').val(imageId);
			self.setPreview($clone, imageUrl);
			$clone.insertAfter($source);
			self.sync();
			self.updateLabels();
		});
		this.$root.on('click', '.velocity-spa-repeater-select', function (event) {
			event.preventDefault();
			var $item = $(this).closest('.velocity-spa-repeater-item');
			var frame = wp.media({title: 'Pilih gambar slider', multiple: false, library: {type: 'image'}, button: {text: 'Gunakan gambar'}});
			frame.on('select', function () {
				var image = frame.state().get('selection').first().toJSON();
				$item.find('[data-field="image_id"]').val(image.id || '');
				self.setPreview($item, image.url || '');
				self.sync();
			});
			frame.open();
		});
		this.$root.on('click', '.velocity-spa-repeater-clear', function (event) {
			event.preventDefault();
			var $item = $(this).closest('.velocity-spa-repeater-item');
			$item.find('[data-field="image_id"]').val('');
			self.setPreview($item, '');
			self.sync();
		});
	};

	Repeater.prototype.setPreview = function ($item, url) {
		var $preview = $item.find('.velocity-spa-repeater-preview');
		$preview.find('img').remove();
		if (url) {
			$preview.prepend($('<img>', {src: url, alt: ''})).addClass('has-image');
			$item.find('.velocity-spa-repeater-select').text('Ganti Gambar');
		} else {
			$preview.removeClass('has-image');
			$item.find('.velocity-spa-repeater-select').text('Pilih Gambar');
		}
	};

	Repeater.prototype.sync = function () {
		var data = [];
		this.$items.children('.velocity-spa-repeater-item').each(function () {
			var imageId = parseInt($(this).find('[data-field="image_id"]').val(), 10) || 0;
			if (imageId) {
				data.push({image_id: imageId});
			}
		});
		this.$store.val(JSON.stringify(data)).trigger('change');
	};

	Repeater.prototype.updateLabels = function () {
		this.$items.children('.velocity-spa-repeater-item').each(function (index) {
			$(this).find('.velocity-spa-repeater-label').text('Slider ' + (index + 1));
		});
	};

	api.controlConstructor.velocity_spa_repeater = api.Control.extend({
		ready: function () {
			new Repeater(this);
		}
	});
}(wp.customize, jQuery));
