/* Preview-сборка «Читай-ка»: мобильное меню, выбор CTA, демо-форма без отправки. */
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

	// Демонстрационная форма: данные никуда не отправляются.
	var form = document.querySelector('.lead-form');
	var notice = document.getElementById('lead-notice');
	if (form && notice) {
		form.addEventListener('submit', function (event) {
			event.preventDefault();
			notice.hidden = false;
			notice.scrollIntoView({ behavior: 'smooth', block: 'center' });
		});
	}
})();
