/* Тема «Читай-ка»: мобильное меню и выбор CTA из кнопок hero. */
(function () {
	'use strict';

	// Мобильное меню.
	var toggle = document.querySelector('.site-header__toggle');
	var nav = document.querySelector('.site-header__nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	}

	// Кнопки CTA в hero выбирают соответствующий вариант в форме.
	var select = document.getElementById('lead-cta');
	document.querySelectorAll('[data-cta]').forEach(function (btn) {
		btn.addEventListener('click', function () {
			if (select) {
				select.value = btn.getAttribute('data-cta');
			}
		});
	});
})();
