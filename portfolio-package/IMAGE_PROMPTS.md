# IMAGE_PROMPTS

## Источники

Серия пересобрана 10.09.2026 по свежим фактическим скриншотам:

- `screenshots/01-hero-desktop.png` — production, первый экран desktop;
- `screenshots/02-directions-desktop.png` — production, направления;
- `screenshots/03-first-visit-desktop.png` — production, первое занятие;
- `screenshots/05-prices-desktop.png` — production, тарифы;
- `screenshots/06-mobile-hero.png` — production, первый экран mobile;
- `screenshots/08-wordpress-editor.png` — реальный редактор `ЧИТАЙ-КА` в WordPress без верхней панели пользователя;
- `screenshots/start-before.png` — подтверждённая ранняя версия сайта.

Для композиционной иерархии использован референс инфографики пользователя. Тёмная палитра референса не переносилась: серия выполнена в фирменных цветах «Читай-ки».

Инструмент всех четырёх кадров: встроенный `image_gen`. Интерфейсы должны оставаться узнаваемыми и фактически соответствовать исходным скриншотам; выдуманные функции и метрики запрещены.

## 00-cover.png

```text
Use case: infographic-diagram.
Asset type: portfolio case cover, 4:3 landscape, 1600×1200.
Create a professional cover for the children's center «Читай-ка». Use the real production homepage screenshot as the dominant visual in a browser frame. Official palette: cream, white, deep purple, lilac, mint and warm yellow.
Text: «ДЕТСКИЙ ЦЕНТР „ЧИТАЙ-КА“», «Сайт с характером и удобным управлением», «Адаптивная версия», «10 редактируемых секций», «3 сценария записи», «WordPress · PHP · HTML · CSS · JavaScript», «ИТ-Бизнес-партнер · Суязов Артем».
No children photos, private data, invented metrics or fictional UI.
```

## 01-start.png

```text
Use case: infographic-diagram.
Asset type: initial-state portfolio frame, 4:3 landscape, 1600×1200.
Use the real early-version screenshot as the dominant factual visual with callout lines to visible layout areas.
Text: «С чего начинали», «Рабочая версия требовала единой системы», «Разрозненная композиция», «Пустой блок преимуществ», «Навигация и тарифы требовали переработки», «Задача: собрать цельную структуру и сохранить фирменный характер», «ИТ-Бизнес-партнер · Суязов Артем».
Do not present the final result or invent UI.
```

## 02-work.png

```text
Use case: infographic-diagram.
Asset type: implementation portfolio frame, 4:3 landscape, 1600×1200.
Use the real WordPress editor as the primary screenshot and the real production directions section as a supporting inset. Explain how the editor follows the public page order.
Text: «Как устроено решение», «Публичный сайт и редактор работают как одна система», «10 секций в порядке страницы», «Включение и отключение блоков», «Редактирование без работы с кодом», «WordPress · кастомная PHP-тема», «РЕДАКТОР», «САЙТ», «ИТ-Бизнес-партнер · Суязов Артем».
Do not expose usernames, passwords or private data. Do not invent controls.
```

## 03-result.png

```text
Use case: infographic-diagram.
Asset type: verified-result portfolio frame, 4:3 landscape, 1600×1200.
Use the real current desktop homepage, real mobile view and real tariffs section. Desktop is dominant; mobile and tariffs are supporting frames.
Text: «Что получил центр», «Опубликованный сайт на домене клиента», «Адаптивные версии», «Тарифы, карта и формы записи», «Контент можно обновлять самостоятельно», «Сайт работает по HTTPS», «ИТ-Бизнес-партнер · Суязов Артем».
No children photos, private data, testimonials, invented metrics or fictional UI.
```

## Проверка

- итоговые файлы: ровно четыре PNG;
- размер каждого: 1600×1200;
- последовательность: обложка → исходная ситуация → реализация → результат;
- водяной знак присутствует на каждом кадре;
- реальные интерфейсы сайта и WordPress использованы как визуальная основа;
- детские фотографии, контакты администратора, логины, пароли и неподтверждённые метрики отсутствуют.
