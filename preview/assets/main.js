/* Детский центр «Читай-ка» — preview scripts.
   Демонстрационная версия: форма ничего не отправляет,
   после submit показывает demo-уведомление. */
(function () {
	'use strict';

	/* --- Мобильное меню --- */
	var toggle = document.querySelector('.site-header__toggle');
	var nav = document.querySelector('.site-header__nav');

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});

		nav.addEventListener('click', function (event) {
			if (event.target.closest('a')) {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	/* --- CTA-кнопки: подставляем выбранную тему в форму --- */
	var topicSelect = document.getElementById('lead-topic');

	document.querySelectorAll('[data-cta]').forEach(function (link) {
		link.addEventListener('click', function () {
			if (topicSelect && link.dataset.cta) {
				topicSelect.value = link.dataset.cta;
			}
		});
	});

	/* --- Форма заявки: demo-режим, без отправки данных --- */
	var form = document.getElementById('leadForm');
	var notice = document.getElementById('leadNotice');

	if (!form || !notice) {
		return;
	}

	function markValidity(field) {
		if (field.checkValidity()) {
			field.classList.remove('is-invalid');
		} else {
			field.classList.add('is-invalid');
		}
	}

	var requiredFields = form.querySelectorAll('[required]');

	requiredFields.forEach(function (field) {
		field.addEventListener('input', function () {
			markValidity(field);
		});
		field.addEventListener('change', function () {
			markValidity(field);
		});
	});

	form.addEventListener('submit', function (event) {
		event.preventDefault();

		/* Honeypot: тихо игнорируем ботов. */
		var honeypot = form.querySelector('#lead-company');
		if (honeypot && honeypot.value !== '') {
			return;
		}

		var valid = true;
		requiredFields.forEach(function (field) {
			markValidity(field);
			if (!field.checkValidity()) {
				valid = false;
			}
		});

		if (!valid) {
			var firstInvalid = form.querySelector('.is-invalid');
			if (firstInvalid) {
				firstInvalid.focus();
			}
			return;
		}

		notice.hidden = false;
		form.reset();
		notice.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
	});
})();
