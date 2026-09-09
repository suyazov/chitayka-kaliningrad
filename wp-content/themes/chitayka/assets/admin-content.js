(function () {
	'use strict';

	var form = document.querySelector('[data-content-form]');
	if (!form) return;

	var tabInput = form.querySelector('[data-active-tab]');
	var savebar = form.querySelector('[data-savebar]');
	var saveStatus = form.querySelector('[data-save-status]');
	var tabButtons = form.querySelectorAll('[data-tab]');
	var tabPanels = form.querySelectorAll('[data-tab-panel]');
	var markDirty = function () {
		if (!savebar || savebar.classList.contains('is-dirty')) return;
		savebar.classList.add('is-dirty');
		saveStatus.innerHTML = '<span aria-hidden="true">●</span> Есть несохранённые изменения';
	};

	form.addEventListener('input', markDirty);
	form.addEventListener('change', markDirty);

	tabButtons.forEach(function (button) {
		button.addEventListener('click', function () {
			var tab = button.getAttribute('data-tab');
			tabButtons.forEach(function (item) { item.classList.toggle('is-active', item === button); });
			tabPanels.forEach(function (panel) { panel.classList.toggle('is-active', panel.getAttribute('data-tab-panel') === tab); });
			tabInput.value = tab;
			window.history.replaceState({}, '', window.location.pathname + '?page=chitayka-content&tab=' + encodeURIComponent(tab));
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	});

	form.querySelectorAll('[data-image-field]').forEach(function (field) {
		var input = field.querySelector('[data-image-input]');
		var preview = field.querySelector('[data-image-preview]');
		var select = field.querySelector('[data-image-select]');
		var reset = field.querySelector('[data-image-reset]');

		select.addEventListener('click', function () {
			var frame = wp.media({ title: 'Выберите фотографию', button: { text: 'Использовать фото' }, multiple: false });
			frame.on('select', function () {
				var attachment = frame.state().get('selection').first().toJSON();
				input.value = attachment.url;
				preview.src = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
				markDirty();
			});
			frame.open();
		});

		reset.addEventListener('click', function () {
			input.value = '';
			preview.src = reset.getAttribute('data-fallback');
			markDirty();
		});
	});
}());
