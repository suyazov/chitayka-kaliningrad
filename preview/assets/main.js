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

	/* --- Фотослайдер «Наш центр» --- */
	var slider = document.getElementById('gallerySlider');

	if (slider) {
		var track = slider.querySelector('.slider__track');
		var slides = slider.querySelectorAll('.slider__slide');
		var prevBtn = slider.querySelector('.slider__btn--prev');
		var nextBtn = slider.querySelector('.slider__btn--next');
		var counter = slider.querySelector('.slider__counter');
		var current = 0;
		var total = slides.length;

		function goTo(index) {
			if (total === 0) {
				return;
			}
			if (index < 0) {
				index = total - 1;
			}
			if (index >= total) {
				index = 0;
			}
			current = index;
			track.style.transform = 'translateX(' + (-100 * current) + '%)';
			slides.forEach(function (slide, i) {
				slide.setAttribute('aria-hidden', i === current ? 'false' : 'true');
			});
			if (counter) {
				counter.textContent = (current + 1) + ' / ' + total;
			}
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				goTo(current - 1);
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				goTo(current + 1);
			});
		}

		slider.addEventListener('keydown', function (event) {
			if (event.key === 'ArrowLeft') {
				event.preventDefault();
				goTo(current - 1);
			} else if (event.key === 'ArrowRight') {
				event.preventDefault();
				goTo(current + 1);
			}
		});

		var touchStartX = null;

		slider.addEventListener('touchstart', function (event) {
			touchStartX = event.changedTouches[0].clientX;
		}, { passive: true });

		slider.addEventListener('touchend', function (event) {
			if (touchStartX === null) {
				return;
			}
			var deltaX = event.changedTouches[0].clientX - touchStartX;
			touchStartX = null;
			if (Math.abs(deltaX) > 40) {
				goTo(current + (deltaX < 0 ? 1 : -1));
			}
		}, { passive: true });

		goTo(0);
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
