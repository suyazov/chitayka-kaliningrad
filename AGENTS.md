# AGENTS.md — chitayka-kaliningrad

## Проект
Сайт детского центра «Читай-ка» (Калининград, ул. Аксакова 131).
WordPress, кастомная тема `wp-content/themes/chitayka`. Mobile-first.

## Структура
- `docs/` — бриф, структура сайта, инвентарь контента.
- `materials/client/` — исходные материалы от клиента (DOCX, логотипы). Не редактировать.
- `wp-content/themes/chitayka/` — единственная тема, вся разработка ведётся в ней.
- `scripts/check-php-syntax.sh` — проверка синтаксиса всех PHP-файлов темы.

## Правила
- Весь PHP-код — только в `wp-content/themes/chitayka`, без плагинов и правок ядра.
- Стили mobile-first: базовые правила для мобильных, десктоп через `min-width` медиазапросы.
- Не выдумывать контакты: телефон, email, соцсети, лицензии и юр. реквизиты публиковать только из подтверждённых материалов клиента.
- Тарифы помечать как требующие подтверждения актуальности.
- Формы заявок: обработка через `admin-post.php`, обязательны nonce, honeypot-поле, sanitization (`sanitize_text_field`, `sanitize_email`), checkbox согласия на обработку ПДн, отправка через `wp_mail` на `admin_email`. Заявки в БД не хранить.
- Три CTA на главной: бесплатная диагностика, пробное занятие, пробный день.
- Никаких Docker, staging, deploy-скриптов в этом репозитории.

## Проверки
- Перед завершением правок PHP: `bash scripts/check-php-syntax.sh` (требуется `php` в PATH).

## Клиентский preview
- URL: `https://chitayka.sy3.ru/`.
- Серверный web-root: `/var/www/chitayka.sy3.ru`.
- Источник публикации: `preview/`; WordPress и база данных для preview не используются.
- Nginx-конфигурация: `/etc/nginx/sites-available/chitayka.sy3.ru.conf`.
- DNS: управляемая A-запись Beget для `chitayka.sy3.ru`.
- TLS: Let's Encrypt с автоматическим продлением.
- Preview закрыт от индексации заголовком `X-Robots-Tag: noindex, nofollow, noarchive`.
- HTML preview отдаётся с `Cache-Control: no-store, no-cache, must-revalidate`; версионированная статика и изображения — с immutable-кэшем 30 дней.
- Главная использует собственный набор мягких 3D-иконок WebP из `preview/assets/icons-v2/`; исходные генерации хранятся локально в игнорируемой папке `design-assets/` и не публикуются.
- Официальный горизонтальный логотип клиента хранится в `preview/assets/brand/logo-official.webp`; не собирать логотип заново из текста и отдельных элементов.
- Официальный персонаж и производные фирменные позы находятся в `preview/assets/stickers/`. Новые позы должны сохранять белое овальное тело, фиолетовые контуры и ушки, жёлто-фиолетовые крылья, крупные фиолетовые глаза и общий характер исходного персонажа.
- Реальные фотографии клиента опубликованы в `preview/assets/gallery/`; в смысловых блоках отдавать им приоритет перед сгенерированными изображениями детей.
- В WordPress-теме форма отправляет заявки через `admin-post.php` на `admin_email`; статический preview остаётся демонстрационным.
- Отдельная публичная страница обязательных сведений: `/svedeniya-ob-obrazovatelnoj-organizacii/` (источник: `preview/svedeniya-ob-obrazovatelnoj-organizacii/index.html`). Неподтверждённые сведения и документы не публиковать как фактические.
- Политика обработки персональных данных: `/politika-konfidencialnosti/`. Для WordPress-версии текст описывает реальную отправку заявки; юридическая редакция остаётся на согласование владельца.

## Production
- URL: `https://chitayka39.ru/`.
- Хостинг: виртуальный хостинг Beget; каталог сайта `chitayka39.ru/public_html`.
- С 2026-09-09 production работает на WordPress 7.1, PHP 8.3 и MySQL 8.4. Активна кастомная тема `chitayka` 1.1.0.
- Production web-root: `/home/m/mzibitu3/chitayka39.ru/public_html`.
- Основные тексты главной, программы, контакты, тарифы и фотографии редактируются в отдельном пункте WordPress `Контент сайта`; данные совместимы с прежним Customizer.
- Фирменный favicon темы собран из официального знака персонажа и используется на публичных, административных и login-страницах, пока в WordPress не выбрана другая Site Icon.
- Отдельные страницы WordPress: `/politika-konfidencialnosti/` и `/svedeniya-ob-obrazovatelnoj-organizacii/`.
- Предыдущая статическая версия сохранена для быстрого отката в `/home/m/mzibitu3/chitayka39.ru/public_html.static-before-wordpress-20260909`; отдельный tar-архив — `/home/m/mzibitu3/backups/chitayka39.ru-static-before-wordpress-20260909.tar.gz`.
- Доступ Beget хранится только в защищённом локальном хранилище `/root/.config/client-access/chitayka39.ru/beget-panel.env`, вне Git.
- Доступ WordPress и MySQL хранится только в `/root/.config/client-access/chitayka39.ru/wordpress.env` с правами `0600`, вне Git.
- SSH на аккаунте Beget после деплоя снова отключён; для обслуживания включать временно через панель и отключать после завершения.
- Перед первой публикацией штатная заглушка Beget сохранена локально в `/root/backups/chitayka39.ru/2026-09-08-before-first-deploy/`.
- HTTPS активен. Главная, страница сведений, политика, основной CSS, WordPress-админка и Customizer проверены после переключения ответом HTTP 200.
- Форма на production обрабатывается через `admin-post.php`, требует согласие и отправляет заявку на WordPress `admin_email`; honeypot-smoke проверен без отправки письма клиенту.
