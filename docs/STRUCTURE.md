# Структура сайта

## Страницы (MVP)
- **Главная** (`front-page.php`) — hero с 3 CTA, группы 4–6 и 7–9, направления, тарифы, контакты, форма заявки.
- **Обычные страницы** (`page.php`) — текстовые страницы (О центре, Контакты и т.п., создаются в админке).
- **index.php** — fallback-шаблон.

## Структура главной страницы
1. Hero: заголовок, адрес (Калининград, ул. Аксакова 131), три кнопки CTA.
2. Группы: карточки «4–6 лет» и «7–9 лет».
3. Направления: чтение, подготовка к школе (ПКШ), продлёнка.
4. Тарифы: таблица/карточки с пометкой «требует подтверждения актуальности».
5. Форма заявки (три варианта CTA через скрытое поле `cta`).
6. Контакты: адрес + placeholders для телефона/email/соцсетей.

## Файлы темы `wp-content/themes/chitayka/`
```
style.css            — заголовок темы (обязательный файл WP)
functions.php        — подключение ассетов, поддержка темы, хуки admin-post
header.php           — <head>, шапка, меню
footer.php           — подвал, wp_footer
index.php            — fallback
page.php             — шаблон страниц
front-page.php       — главная
inc/lead-form.php    — обработчик заявок + рендер формы
assets/css/main.css  — стили (mobile-first)
assets/js/main.js    — мобильное меню, мелкий UX форм
```

## Формы
- Action: `admin-post.php` (`admin_post_chitayka_lead` + `admin_post_nopriv_chitayka_lead`).
- Поля: имя, телефон, выбор CTA (hidden), honeypot `website`, checkbox согласия, nonce `chitayka_lead`.
- Отправка: `wp_mail` на `admin_email`. В БД не сохраняется.
- Результат: редирект обратно с `?lead=ok|error`.
