# chitayka-kaliningrad

Сайт детского центра «Читай-ка» (Калининград, ул. Аксакова 131).

## Состав репозитория

- `docs/` — бриф (`BRIEF.md`), структура сайта (`STRUCTURE.md`), инвентарь контента (`CONTENT-INVENTORY.md`).
- `materials/client/` — исходные материалы от клиента (DOCX, логотипы).
- `wp-content/themes/chitayka/` — кастомная WordPress-тема (mobile-first).
- `scripts/check-php-syntax.sh` — проверка синтаксиса PHP-файлов темы.

## Установка темы

1. Требования: WordPress 6.0+, PHP 7.4+, MySQL/MariaDB.
2. Скопировать `wp-content/themes/chitayka` в `wp-content/themes/` WordPress-установки.
3. Активировать тему «Читай-ка» в админке (Внешний вид → Темы).
4. Создать и опубликовать страницы со slug `politika-konfidencialnosti` и `svedeniya-ob-obrazovatelnoj-organizacii`.
5. Контакты, тарифы и фотографии редактируются в разделе «Внешний вид → Настроить → Содержимое „Читай-ки“».
6. Указать рабочий `admin_email`: он используется как резервный адрес, если ALFACRM недоступна или не настроена.

## Проверка PHP

```bash
bash scripts/check-php-syntax.sh
```

## Важно

- Контакты, тарифы и фотографии имеют исходные значения из подтверждённых материалов и редактируются через WordPress Customizer.
- Production-форма создаёт лид в ALFACRM через серверный API; при ошибке или отсутствии конфигурации отправляет заявку на `admin_email`. В WordPress заявки не хранятся.
