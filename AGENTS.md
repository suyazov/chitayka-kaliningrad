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
- Не выдумывать контакты: телефон, email, соцсети, лицензии, юр. реквизиты — только placeholders (`[ТЕЛЕФОН]`, `[EMAIL]` и т.п.).
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
- Preview отдаётся без кеширования (`expires -1` в nginx), чтобы клиент всегда видел актуальную версию после обновления страницы.
- Формы демонстрационные и не отправляют персональные данные.
- Отдельная публичная страница обязательных сведений: `/svedeniya-ob-obrazovatelnoj-organizacii/` (источник: `preview/svedeniya-ob-obrazovatelnoj-organizacii/index.html`). Неподтверждённые сведения и документы не публиковать как фактические.
