(function () {
	'use strict';

	var form = document.querySelector('[data-content-form]');
	if (!form) return;

	var dirty = false;
	var status = form.querySelector('[data-save-status]');
	var setDirty = function () {
		if (dirty) return;
		dirty = true;
		if (status) status.innerHTML = '<i aria-hidden="true"></i> Есть несохранённые изменения';
	};

	form.addEventListener('input', setDirty);
	form.addEventListener('change', setDirty);
	form.addEventListener('submit', function () { dirty = false; });
	window.addEventListener('beforeunload', function (event) {
		if (!dirty) return;
		event.preventDefault();
		event.returnValue = (window.chitaykaAdmin && chitaykaAdmin.unsaved) || '';
	});

	var syncCardStatus = function (card) {
		var checkbox = card.querySelector('[data-section-visible]');
		var cardStatus = card.querySelector('[data-card-status]');
		if (!checkbox || !cardStatus) return;
		cardStatus.textContent = checkbox.checked ? 'Включён' : 'Выключен';
		cardStatus.classList.toggle('is-on', checkbox.checked);
		cardStatus.classList.toggle('is-off', !checkbox.checked);
	};

	form.querySelectorAll('[data-card-toggle]').forEach(function (button) {
		button.addEventListener('click', function () {
			var card = button.closest('[data-content-card]');
			var body = card.querySelector('.chitayka-card__body');
			var open = !body.hidden;
			body.hidden = open;
			card.classList.toggle('is-open', !open);
			button.setAttribute('aria-expanded', String(!open));
		});
	});

	form.querySelectorAll('[data-section-visible]').forEach(function (checkbox) {
		checkbox.addEventListener('change', function () { syncCardStatus(checkbox.closest('[data-content-card]')); });
	});

	var enableAll = form.querySelector('[data-enable-all]');
	if (enableAll) {
		enableAll.addEventListener('click', function () {
			form.querySelectorAll('[data-section-visible]').forEach(function (checkbox) {
				checkbox.checked = true;
				syncCardStatus(checkbox.closest('[data-content-card]'));
			});
			setDirty();
		});
	}

	var collapseAll = form.querySelector('[data-collapse-all]');
	if (collapseAll) {
		collapseAll.addEventListener('click', function () {
			var cards = Array.from(form.querySelectorAll('[data-content-card]'));
			var shouldOpen = !cards.some(function (card) { return card.classList.contains('is-open'); });
			cards.forEach(function (card) {
				var body = card.querySelector('.chitayka-card__body');
				var button = card.querySelector('[data-card-toggle]');
				body.hidden = !shouldOpen;
				card.classList.toggle('is-open', shouldOpen);
				button.setAttribute('aria-expanded', String(shouldOpen));
			});
			collapseAll.textContent = shouldOpen ? 'Свернуть все' : 'Развернуть все';
		});
	}

	form.querySelectorAll('[data-reset-section]').forEach(function (button) {
		button.addEventListener('click', function (event) {
			var message = (window.chitaykaAdmin && chitaykaAdmin.confirmReset) || 'Восстановить исходные значения блока?';
			if (!window.confirm(message)) event.preventDefault();
			else dirty = false;
		});
	});

	var mediaFrame = null;
	var currentImageField = null;
	form.querySelectorAll('[data-image-field]').forEach(function (field) {
		var input = field.querySelector('[data-image-input]');
		var preview = field.querySelector('[data-image-preview]');
		var select = field.querySelector('[data-image-select]');
		var reset = field.querySelector('[data-image-reset]');

		select.addEventListener('click', function () {
			currentImageField = field;
			if (!mediaFrame) {
				mediaFrame = wp.media({ title: 'Выберите фотографию', button: { text: 'Использовать фото' }, library: { type: 'image' }, multiple: false });
				mediaFrame.on('select', function () {
					var attachment = mediaFrame.state().get('selection').first().toJSON();
					if (!currentImageField) return;
					var currentInput = currentImageField.querySelector('[data-image-input]');
					var currentPreview = currentImageField.querySelector('[data-image-preview]');
					currentInput.value = attachment.url;
					currentPreview.src = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
					setDirty();
				});
			}
			mediaFrame.open();
		});

		reset.addEventListener('click', function () {
			input.value = '';
			preview.src = reset.getAttribute('data-fallback');
			setDirty();
		});
	});

	form.querySelectorAll('[data-counter]').forEach(function (counter) {
		var input = counter.previousElementSibling;
		var max = Number(counter.getAttribute('data-counter')) || 0;
		var update = function () {
			var length = (input.value || '').length;
			counter.textContent = length + ' / ' + max;
			counter.classList.toggle('is-near', max > 0 && length > max * 0.85);
		};
		input.addEventListener('input', update);
		update();
	});
}());
