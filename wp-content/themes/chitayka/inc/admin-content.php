<?php
/**
 * Редактор содержимого сайта по проверенному паттерну LEMESH PRO.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Декларативная схема редактируемых полей.
 *
 * @return array<string,array<string,mixed>>
 */
function chitayka_content_fields() {
	return array(
		'home'     => array(
			'label'    => 'Главная',
			'sections' => array(
				'hero'         => array(
					'title'  => 'Первый экран',
					'fields' => array(
						'hero_badge'       => array( 'label' => 'Адрес над заголовком', 'default' => 'Калининград · ул. Аксакова 131' ),
						'hero_title'       => array( 'label' => 'Главный заголовок', 'default' => 'Научим ребёнка читать с удовольствием', 'type' => 'textarea' ),
						'hero_lead'        => array( 'label' => 'Описание', 'default' => 'Детский центр «Читай-ка»: обучение чтению, подготовка к школе и умная продлёнка для учеников 1–4 классов. Маленькие группы, бережные педагоги, понятный результат.', 'type' => 'textarea' ),
						'hero_point_1'     => array( 'label' => 'Преимущество 1', 'default' => 'Группы от 4 лет до 4 класса' ),
						'hero_point_2'     => array( 'label' => 'Преимущество 2', 'default' => 'Диагностика навыков перед стартом' ),
						'hero_point_3'     => array( 'label' => 'Преимущество 3', 'default' => 'Продлёнка до вечера с домашними заданиями' ),
					),
				),
				'directions'   => array(
					'title'  => 'Направления',
					'fields' => array(
						'directions_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Направления в «Читай-ке»' ),
						'directions_title'  => array( 'label' => 'Заголовок', 'default' => 'Что мы делаем' ),
						'directions_sub'    => array( 'label' => 'Описание', 'default' => 'Помогаем детям учиться с интересом и радостью каждый день.', 'type' => 'textarea' ),
						'direction_1_title' => array( 'label' => 'Карточка 1 — заголовок', 'default' => 'Обучение чтению' ),
						'direction_1_text'  => array( 'label' => 'Карточка 1 — текст', 'default' => 'От первых слогов до беглого осмысленного чтения. Развиваем технику, понимание текста и любовь к книгам.', 'type' => 'textarea' ),
						'direction_2_title' => array( 'label' => 'Карточка 2 — заголовок', 'default' => 'Подготовка к школе' ),
						'direction_2_text'  => array( 'label' => 'Карточка 2 — текст', 'default' => 'Полный курс подготовки к 1 классу: чтение, счёт, логика, речь, письмо и навыки самостоятельности.', 'type' => 'textarea' ),
						'direction_3_title' => array( 'label' => 'Карточка 3 — заголовок', 'default' => 'Умная продлёнка' ),
						'direction_3_text'  => array( 'label' => 'Карточка 3 — текст', 'default' => 'Продлённый день для школьников 1–4 классов: уроки сделаны, развивающие занятия, прогулки и отдых.', 'type' => 'textarea' ),
						'direction_4_title' => array( 'label' => 'Карточка 4 — заголовок', 'default' => 'Развитие и творчество' ),
						'direction_4_text'  => array( 'label' => 'Карточка 4 — текст', 'default' => 'Развиваем мышление, речь, память и воображение через игры, творчество и общение.', 'type' => 'textarea' ),
						'direction_5_title' => array( 'label' => 'Карточка 5 — заголовок', 'default' => 'Забота и поддержка' ),
						'direction_5_text'  => array( 'label' => 'Карточка 5 — текст', 'default' => 'Маленькие группы, добрые педагоги и внимание к каждому ребёнку и его успехам.', 'type' => 'textarea' ),
					),
				),
				'journey'      => array(
					'title'  => 'Первое занятие',
					'fields' => array(
						'journey_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Первое знакомство' ),
						'journey_title'  => array( 'label' => 'Заголовок', 'default' => 'Как проходит первое занятие' ),
						'journey_sub'    => array( 'label' => 'Описание', 'default' => 'Спокойно знакомимся, определяем текущий уровень и подбираем формат, в котором ребёнку будет интересно.', 'type' => 'textarea' ),
						'journey_cta_title' => array( 'label' => 'Призыв — заголовок', 'default' => 'Не знаете, с чего начать?' ),
						'journey_cta_text'  => array( 'label' => 'Призыв — текст', 'default' => 'Начните с бесплатной диагностики — она поможет выбрать программу без догадок.', 'type' => 'textarea' ),
					),
				),
				'gallery_copy' => array(
					'title'  => 'Фотогалерея',
					'fields' => array(
						'gallery_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Фотогалерея' ),
						'gallery_title'  => array( 'label' => 'Заголовок', 'default' => 'Наш центр' ),
						'gallery_sub'    => array( 'label' => 'Описание', 'default' => 'Занятия, игры и интерьер «Читай-ки» на ул. Аксакова 131 — листайте фотографии.', 'type' => 'textarea' ),
					),
				),
			),
		),
		'programs' => array(
			'label'    => 'Программы',
			'sections' => array(
				'programs'     => array(
					'title'  => 'Возрастные программы',
					'fields' => array(
						'programs_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Для каждого возраста' ),
						'programs_title'  => array( 'label' => 'Заголовок', 'default' => 'Возрастные программы' ),
						'programs_sub'    => array( 'label' => 'Описание', 'default' => 'Программа подстраивается под возраст и текущий уровень ребёнка — начинаем с бесплатной диагностики.', 'type' => 'textarea' ),
						'program_1_age'   => array( 'label' => 'Программа 1 — возраст', 'default' => '4–5 лет' ),
						'program_1_title' => array( 'label' => 'Программа 1 — название', 'default' => 'Первые шаги к чтению' ),
						'program_2_age'   => array( 'label' => 'Программа 2 — возраст', 'default' => '5–6 лет' ),
						'program_2_title' => array( 'label' => 'Программа 2 — название', 'default' => 'Уверенное чтение' ),
						'program_3_age'   => array( 'label' => 'Программа 3 — возраст', 'default' => '6–7 лет' ),
						'program_3_title' => array( 'label' => 'Программа 3 — название', 'default' => 'Подготовка к школе' ),
						'program_4_age'   => array( 'label' => 'Программа 4 — возраст', 'default' => '1–4 класс' ),
						'program_4_title' => array( 'label' => 'Программа 4 — название', 'default' => 'Школьникам' ),
					),
				),
				'prodlenka'    => array(
					'title'  => 'Продлёнка',
					'fields' => array(
						'prodlenka_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Для занятых родителей' ),
						'prodlenka_title'  => array( 'label' => 'Заголовок', 'default' => 'Умная продлёнка для 1–4 классов' ),
						'prodlenka_lead'   => array( 'label' => 'Описание', 'default' => 'Ребёнок под присмотром до вечера: домашние задания выполнены с педагогом, а остальное время — отдых, игры и развивающие занятия в удобном центре на Аксакова 131.', 'type' => 'textarea' ),
						'prodlenka_am_title' => array( 'label' => 'Утренняя смена — название', 'default' => 'Утренняя смена' ),
						'prodlenka_am_time'  => array( 'label' => 'Утренняя смена — время', 'default' => 'Для учеников 2-й смены · 08:00–13:30' ),
						'prodlenka_pm_title' => array( 'label' => 'Дневная смена — название', 'default' => 'Дневная смена' ),
						'prodlenka_pm_time'  => array( 'label' => 'Дневная смена — время', 'default' => 'Для учеников 1-й смены · 12:00–18:00' ),
					),
				),
				'advantages'   => array(
					'title'  => 'Преимущества',
					'fields' => array(
						'advantages_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Почему «Читай-ка»' ),
						'advantages_title'  => array( 'label' => 'Заголовок', 'default' => 'Место, где ребёнка замечают' ),
						'advantages_lead'   => array( 'label' => 'Описание', 'default' => 'Соединяем обучение, игру и поддержку — ребёнок двигается в своём темпе и не боится пробовать.', 'type' => 'textarea' ),
						'advantage_1_title' => array( 'label' => 'Преимущество 1 — заголовок', 'default' => 'Маленькие группы' ),
						'advantage_1_text'  => array( 'label' => 'Преимущество 1 — текст', 'default' => 'Педагог видит каждого ребёнка и успевает помочь именно там, где это нужно.', 'type' => 'textarea' ),
						'advantage_2_title' => array( 'label' => 'Преимущество 2 — заголовок', 'default' => 'Старт с диагностики' ),
						'advantage_2_text'  => array( 'label' => 'Преимущество 2 — текст', 'default' => 'Сначала определяем уровень, затем предлагаем понятную и посильную программу.', 'type' => 'textarea' ),
						'advantage_3_title' => array( 'label' => 'Преимущество 3 — заголовок', 'default' => 'Без давления и сравнений' ),
						'advantage_3_text'  => array( 'label' => 'Преимущество 3 — текст', 'default' => 'Поддерживаем интерес к занятиям и отмечаем личный прогресс ребёнка.', 'type' => 'textarea' ),
						'advantage_4_title' => array( 'label' => 'Преимущество 4 — заголовок', 'default' => 'Обратная связь родителям' ),
						'advantage_4_text'  => array( 'label' => 'Преимущество 4 — текст', 'default' => 'Объясняем, что получается и на какие навыки стоит обратить внимание дальше.', 'type' => 'textarea' ),
					),
				),
				'achievements' => array(
					'title'  => 'Результаты',
					'fields' => array(
						'achievements_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Маленькие победы' ),
						'achievements_title'  => array( 'label' => 'Заголовок', 'default' => 'Результаты, которыми дети гордятся' ),
						'achievements_text'   => array( 'label' => 'Описание', 'default' => 'Уверенно прочитанный текст, выполненное задание, первая самостоятельная работа или заслуженный диплом — мы замечаем каждый шаг вперёд.', 'type' => 'textarea' ),
					),
				),
				'lead'         => array(
					'title'  => 'Форма заявки',
					'fields' => array(
						'lead_kicker' => array( 'label' => 'Надзаголовок', 'default' => 'Первый шаг' ),
						'lead_title'  => array( 'label' => 'Заголовок', 'default' => 'Запишитесь на бесплатную диагностику' ),
						'lead_text'   => array( 'label' => 'Описание', 'default' => 'Оставьте заявку — мы свяжемся с вами, ответим на вопросы и подберём удобное время для диагностики, пробного занятия или пробного дня.', 'type' => 'textarea' ),
					),
				),
			),
		),
		'contacts' => array(
			'label'    => 'Контакты',
			'sections' => array(
				'contacts' => array(
					'title'       => 'Контакты и реквизиты',
					'description' => 'Телефон используется в кнопках звонка, адрес и реквизиты — в контактах и подвале.',
					'fields'      => array(
						'phone'           => array( 'label' => 'Телефон', 'default' => '+7 911 497-33-04' ),
						'email'           => array( 'label' => 'Электронная почта', 'default' => 'clubchitayka@mail.ru', 'sanitize' => 'email' ),
						'address'         => array( 'label' => 'Адрес', 'default' => 'Калининград, ул. Аксакова 131' ),
						'vk_url'          => array( 'label' => 'Ссылка ВКонтакте', 'default' => 'https://vk.ru/clubchitayka39', 'sanitize' => 'url' ),
						'lead_requisites' => array( 'label' => 'Реквизиты в подвале', 'default' => 'ИП Бурмистрова Полина Сергеевна · ИНН 246519367524 · ОГРНИП 325246800146312', 'type' => 'textarea' ),
					),
				),
			),
		),
		'prices'   => array(
			'label'    => 'Тарифы',
			'sections' => array(
				'prices' => array(
					'title'       => 'Цены',
					'description' => 'Указывайте цену целиком, например «6 900 ₽». Подписи «в месяц» и «в день» сайт добавит сам.',
					'fields'      => array(
						'price_school'      => array( 'label' => 'Подготовка к школе', 'default' => '6 900 ₽' ),
						'price_reading'     => array( 'label' => 'Обучение чтению', 'default' => '6 900 ₽' ),
						'price_development' => array( 'label' => 'Комплексное развитие 4–5 лет', 'default' => '6 900 ₽' ),
						'price_english'     => array( 'label' => 'Английский язык', 'default' => '5 600 ₽' ),
						'price_calligraphy' => array( 'label' => 'Каллиграфия', 'default' => '5 600 ₽' ),
						'price_art'         => array( 'label' => 'Арт-студия', 'default' => '3 900 ₽' ),
						'price_neuro'       => array( 'label' => 'Нейропсихолог — от', 'default' => '1 650 ₽' ),
						'price_extended_am' => array( 'label' => 'Продлёнка утренняя', 'default' => '18 500 ₽' ),
						'price_extended_pm' => array( 'label' => 'Продлёнка дневная', 'default' => '21 800 ₽' ),
						'price_optimal'     => array( 'label' => 'Продлёнка «Оптимальный»', 'default' => '12 000 ₽' ),
						'price_homework'    => array( 'label' => 'Экспресс-домашка', 'default' => '9 900 ₽' ),
						'price_one_day'     => array( 'label' => '«Выручалочка» — один день', 'default' => '2 000 ₽' ),
						'price_events'      => array( 'label' => 'Праздники и мастер-классы — от', 'default' => '500 ₽' ),
						'price_wall'        => array( 'label' => 'Интерактивная стена', 'default' => '500 ₽' ),
					),
				),
			),
		),
		'gallery' => array(
			'label'    => 'Фото',
			'sections' => array(
				'gallery' => array(
					'title'       => 'Фотогалерея',
					'description' => 'Выберите фото из медиатеки. Сброс вернёт исходную фотографию темы.',
					'fields'      => array(),
				),
			),
		),
	);
}

/**
 * Добавляет 14 полей изображений без дублирования схемы вручную.
 *
 * @param array<string,array<string,mixed>> $schema Схема.
 * @return array<string,array<string,mixed>>
 */
function chitayka_content_schema_with_gallery( $schema ) {
	for ( $index = 1; $index <= 14; $index++ ) {
		$schema['gallery']['sections']['gallery']['fields'][ 'gallery_' . $index ] = array(
			'label'    => 'Фотография ' . $index,
			'default'  => '',
			'type'     => 'image',
			'sanitize' => 'url',
			'fallback' => get_template_directory_uri() . '/assets/gallery/photo-' . str_pad( (string) $index, 2, '0', STR_PAD_LEFT ) . '.webp',
		);
	}

	return $schema;
}

/**
 * Плоский перечень всех полей.
 *
 * @return array<string,array<string,mixed>>
 */
function chitayka_flat_content_fields() {
	$fields = array();
	$schema = chitayka_content_schema_with_gallery( chitayka_content_fields() );
	foreach ( $schema as $tab ) {
		foreach ( $tab['sections'] as $section ) {
			$fields = array_merge( $fields, $section['fields'] );
		}
	}
	return $fields;
}

/**
 * Секции главной в том же порядке, что и на публичной странице.
 *
 * @return array<string,array<string,mixed>>
 */
function chitayka_home_content_sections() {
	$schema = chitayka_content_schema_with_gallery( chitayka_content_fields() );
	return array(
		'hero'         => array( 'title' => 'Первый экран', 'description' => 'Главный оффер, вводный текст и короткие преимущества.', 'anchor' => 'top', 'critical' => true, 'fields' => $schema['home']['sections']['hero']['fields'] ),
		'directions'   => array( 'title' => 'Направления', 'description' => 'Основные направления центра и тексты карточек.', 'anchor' => 'directions', 'fields' => $schema['home']['sections']['directions']['fields'] ),
		'journey'      => array( 'title' => 'Первое занятие', 'description' => 'Как проходит знакомство с центром и призыв пройти диагностику.', 'anchor' => 'first-visit', 'fields' => $schema['home']['sections']['journey']['fields'] ),
		'programs'     => array( 'title' => 'Возрастные программы', 'description' => 'Названия программ и возрастные группы.', 'anchor' => 'programs', 'fields' => $schema['programs']['sections']['programs']['fields'] ),
		'prodlenka'    => array( 'title' => 'Продлёнка', 'description' => 'Описание продлёнки, смены и время работы.', 'anchor' => 'prodlenka', 'fields' => $schema['programs']['sections']['prodlenka']['fields'] ),
		'advantages'   => array( 'title' => 'Преимущества', 'description' => 'Почему родители выбирают центр.', 'anchor' => 'advantages', 'fields' => $schema['programs']['sections']['advantages']['fields'] ),
		'gallery'      => array( 'title' => 'Фотогалерея', 'description' => 'Заголовок, описание и фотографии. Сброс фотографии возвращает изображение из темы.', 'anchor' => 'gallery', 'fields' => array_merge( $schema['home']['sections']['gallery_copy']['fields'], $schema['gallery']['sections']['gallery']['fields'] ) ),
		'achievements' => array( 'title' => 'Результаты детей', 'description' => 'Текст о достижениях воспитанников.', 'anchor' => 'achievements', 'fields' => $schema['programs']['sections']['achievements']['fields'] ),
		'prices'       => array( 'title' => 'Тарифы', 'description' => 'Цены по направлениям и дополнительным услугам.', 'anchor' => 'prices', 'fields' => $schema['prices']['sections']['prices']['fields'], 'layout' => 'prices' ),
		'lead'         => array( 'title' => 'Форма заявки', 'description' => 'Текст рядом с формой бесплатной диагностики.', 'anchor' => 'lead-form', 'critical' => true, 'fields' => $schema['programs']['sections']['lead']['fields'] ),
	);
}

/**
 * Текущая видимость секций главной.
 *
 * @return array<string,int>
 */
function chitayka_get_sections_visibility() {
	$defaults = array_fill_keys( array_keys( chitayka_home_content_sections() ), 1 );
	$saved    = get_option( 'chitayka_sections_visibility', array() );
	$values   = is_array( $saved ) ? array_merge( $defaults, $saved ) : $defaults;
	$values['hero'] = 1;
	$values['lead'] = 1;
	return $values;
}

/**
 * Проверяет, включена ли секция на главной.
 *
 * @param string $key Ключ секции.
 * @return bool
 */
function chitayka_is_home_section_enabled( $key ) {
	$visibility = chitayka_get_sections_visibility();
	return ! empty( $visibility[ $key ] );
}

add_action(
	'admin_menu',
	function () {
		$capability = 'edit_theme_options';
		add_menu_page( '«Читай-ка» — управление сайтом', 'ЧИТАЙ-КА', $capability, 'chitayka-content', 'chitayka_render_home_content_admin', 'dashicons-admin-home', 3 );
		add_submenu_page( 'chitayka-content', 'Главная страница', 'Главная страница', $capability, 'chitayka-content', 'chitayka_render_home_content_admin' );
		add_submenu_page( 'chitayka-content', 'Контакты и реквизиты', 'Контакты и реквизиты', $capability, 'chitayka-contacts', 'chitayka_render_contacts_admin' );
	}
);

add_action(
	'admin_enqueue_scripts',
	function () {
		$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';
		if ( 0 !== strpos( $page, 'chitayka-' ) ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_style( 'chitayka-admin-content', get_template_directory_uri() . '/assets/admin-content.css', array(), CHITAYKA_VERSION );
		wp_enqueue_script( 'chitayka-admin-content', get_template_directory_uri() . '/assets/admin-content.js', array(), CHITAYKA_VERSION, true );
		wp_localize_script(
			'chitayka-admin-content',
			'chitaykaAdmin',
			array(
				'confirmReset' => 'Восстановить исходные значения этого блока? Текущие изменения блока будут потеряны.',
				'unsaved'      => 'Есть несохранённые изменения. Уйти со страницы?',
			)
		);
	}
);

/** Сохраняет резервную копию последних пяти состояний контента. */
function chitayka_backup_content_options() {
	$mods = get_theme_mods();
	$data = array();
	foreach ( chitayka_flat_content_fields() as $key => $field ) {
		$mod_key = 'chitayka_' . $key;
		if ( array_key_exists( $mod_key, $mods ) ) {
			$data[ $mod_key ] = $mods[ $mod_key ];
		}
	}
	$backups = get_option( 'chitayka_content_backups', array() );
	$backups = is_array( $backups ) ? $backups : array();
	array_unshift(
		$backups,
		array(
			'time'       => current_time( 'mysql' ),
			'user'       => get_current_user_id(),
			'theme_mods' => $data,
			'visibility' => chitayka_get_sections_visibility(),
		)
	);
	update_option( 'chitayka_content_backups', array_slice( $backups, 0, 5 ), false );
}

/**
 * Очищает значение поля согласно декларативной схеме.
 *
 * @param string              $value Сырое значение.
 * @param array<string,mixed> $field Схема поля.
 * @return string
 */
function chitayka_sanitize_content_value( $value, $field ) {
	switch ( isset( $field['sanitize'] ) ? $field['sanitize'] : '' ) {
		case 'email':
			return sanitize_email( $value );
		case 'url':
			return esc_url_raw( $value );
		default:
			return 'textarea' === ( isset( $field['type'] ) ? $field['type'] : '' ) ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
	}
}

/** Сохраняет данные редактора в theme_mods, совместимые с Customizer. */
function chitayka_save_content_admin() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Недостаточно прав для изменения сайта.', 'chitayka' ) );
	}
	check_admin_referer( 'chitayka_save_content', 'chitayka_content_nonce' );
	chitayka_backup_content_options();

	$editor_page = isset( $_POST['editor_page'] ) ? sanitize_key( wp_unslash( $_POST['editor_page'] ) ) : 'home';
	$page_slug   = 'contacts' === $editor_page ? 'chitayka-contacts' : 'chitayka-content';
	$reset       = isset( $_POST['reset_section'] ) ? sanitize_key( wp_unslash( $_POST['reset_section'] ) ) : '';

	if ( '' !== $reset && 'home' === $editor_page ) {
		$sections = chitayka_home_content_sections();
		if ( isset( $sections[ $reset ] ) ) {
			foreach ( $sections[ $reset ]['fields'] as $key => $field ) {
				remove_theme_mod( 'chitayka_' . $key );
			}
		}
	} else {
		$values = isset( $_POST['chitayka'] ) && is_array( $_POST['chitayka'] ) ? wp_unslash( $_POST['chitayka'] ) : array();
		foreach ( chitayka_flat_content_fields() as $key => $field ) {
			if ( array_key_exists( $key, $values ) ) {
				set_theme_mod( 'chitayka_' . $key, chitayka_sanitize_content_value( (string) $values[ $key ], $field ) );
			}
		}

		if ( 'home' === $editor_page ) {
			$posted_visibility = isset( $_POST['visibility'] ) && is_array( $_POST['visibility'] ) ? wp_unslash( $_POST['visibility'] ) : array();
			$visibility        = array();
			foreach ( chitayka_home_content_sections() as $key => $section ) {
				$visibility[ $key ] = ! empty( $section['critical'] ) || ! empty( $posted_visibility[ $key ] ) ? 1 : 0;
			}
			update_option( 'chitayka_sections_visibility', $visibility, false );
		}
	}

	update_option(
		'chitayka_content_last_save',
		array( 'time' => current_time( 'mysql' ), 'user' => get_current_user_id() ),
		false
	);
	wp_safe_redirect( add_query_arg( array( 'page' => $page_slug, 'updated' => '1' ), admin_url( 'admin.php' ) ) );
	exit;
}
add_action( 'admin_post_chitayka_save_content', 'chitayka_save_content_admin' );

/**
 * Выводит одно поле редактора.
 *
 * @param string              $key   Ключ.
 * @param array<string,mixed> $field Конфигурация.
 */
function chitayka_render_admin_field( $key, $field ) {
	$value = get_theme_mod( 'chitayka_' . $key, $field['default'] );
	$type  = isset( $field['type'] ) ? $field['type'] : 'text';
	$max   = isset( $field['max'] ) ? absint( $field['max'] ) : ( 'textarea' === $type ? 700 : 300 );
	?>
	<div class="chitayka-field<?php echo 'image' === $type ? ' chitayka-field--image' : ''; ?>">
		<label for="chitayka-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
		<?php if ( 'textarea' === $type ) : ?>
			<textarea id="chitayka-<?php echo esc_attr( $key ); ?>" name="chitayka[<?php echo esc_attr( $key ); ?>]" rows="3" maxlength="<?php echo esc_attr( $max ); ?>" data-counter-source><?php echo esc_textarea( $value ); ?></textarea>
			<span class="chitayka-counter" data-counter="<?php echo esc_attr( $max ); ?>"></span>
		<?php elseif ( 'image' === $type ) : ?>
			<?php $preview = '' !== $value ? $value : $field['fallback']; ?>
			<div class="chitayka-image" data-image-field>
				<img src="<?php echo esc_url( $preview ); ?>" alt="" data-image-preview>
				<input type="hidden" id="chitayka-<?php echo esc_attr( $key ); ?>" name="chitayka[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>" data-image-input>
				<div class="chitayka-image__actions">
					<button class="button button-primary" type="button" data-image-select>Выбрать фото</button>
					<button class="button" type="button" data-image-reset data-fallback="<?php echo esc_url( $field['fallback'] ); ?>">Вернуть исходное</button>
				</div>
			</div>
		<?php else : ?>
			<?php $input_type = 'email' === ( isset( $field['sanitize'] ) ? $field['sanitize'] : '' ) ? 'email' : ( 'url' === ( isset( $field['sanitize'] ) ? $field['sanitize'] : '' ) ? 'url' : 'text' ); ?>
			<input type="<?php echo esc_attr( $input_type ); ?>" id="chitayka-<?php echo esc_attr( $key ); ?>" name="chitayka[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>" maxlength="<?php echo esc_attr( $max ); ?>" data-counter-source>
			<span class="chitayka-counter" data-counter="<?php echo esc_attr( $max ); ?>"></span>
		<?php endif; ?>
	</div>
	<?php
}

/** Выводит заголовок административной страницы и метку последнего сохранения. */
function chitayka_admin_page_head( $title, $subtitle ) {
	?>
	<div class="chitayka-admin__heading">
		<div><h1><?php echo esc_html( $title ); ?></h1><p><?php echo esc_html( $subtitle ); ?></p></div>
	</div>
	<?php if ( isset( $_GET['updated'] ) ) : ?>
		<?php $last_save = get_option( 'chitayka_content_last_save', array() ); ?>
		<div class="notice notice-success is-dismissible"><p><strong>Изменения сохранены.</strong><?php echo ! empty( $last_save['time'] ) ? ' ' . esc_html( $last_save['time'] ) . '.' : ''; ?> <a href="<?php echo esc_url( add_query_arg( 'cv', wp_date( 'YmdHi' ), home_url( '/' ) ) ); ?>" target="_blank" rel="noopener">Открыть главную ↗</a></p></div>
	<?php endif;
}

/** Страница «Главная страница» по образцу админки LEMESH PRO. */
function chitayka_render_home_content_admin() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Недостаточно прав.', 'chitayka' ), 403 );
	}
	$sections   = chitayka_home_content_sections();
	$visibility = chitayka_get_sections_visibility();
	?>
	<div class="wrap chitayka-admin">
		<?php chitayka_admin_page_head( 'Главная страница', 'Блоки расположены в том же порядке, что и на сайте. Можно открыть несколько блоков одновременно.' ); ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-content-form>
			<input type="hidden" name="action" value="chitayka_save_content">
			<input type="hidden" name="editor_page" value="home">
			<?php wp_nonce_field( 'chitayka_save_content', 'chitayka_content_nonce' ); ?>
			<div class="chitayka-toolbar">
				<button class="button button-primary button-hero" type="submit">Сохранить все изменения</button>
				<a class="button button-hero" href="<?php echo esc_url( add_query_arg( 'cv', wp_date( 'YmdHi' ), home_url( '/' ) ) ); ?>" target="_blank" rel="noopener">Открыть главную ↗</a>
				<button class="button button-hero" type="button" data-enable-all>Включить все блоки</button>
				<button class="button button-hero" type="button" data-collapse-all>Развернуть все</button>
				<span class="chitayka-toolbar__status" data-save-status><i aria-hidden="true"></i> Все изменения сохранены</span>
			</div>

			<?php foreach ( $sections as $section_key => $section ) : ?>
				<?php $enabled = ! empty( $visibility[ $section_key ] ); ?>
				<section class="chitayka-card" data-content-card>
					<header class="chitayka-card__head">
						<button class="chitayka-card__toggle" type="button" aria-expanded="false" data-card-toggle>
							<span class="chitayka-card__chevron" aria-hidden="true"></span>
							<span class="chitayka-card__title"><?php echo esc_html( $section['title'] ); ?></span>
							<span class="chitayka-card__status <?php echo $enabled ? 'is-on' : 'is-off'; ?>" data-card-status><?php echo $enabled ? 'Включён' : 'Выключен'; ?></span>
						</button>
						<div class="chitayka-card__actions">
							<a href="<?php echo esc_url( home_url( '/#' . $section['anchor'] ) ); ?>" target="_blank" rel="noopener">На сайте ↗</a>
							<?php if ( empty( $section['critical'] ) ) : ?>
								<label class="chitayka-switch" title="Показывать блок">
									<input type="checkbox" name="visibility[<?php echo esc_attr( $section_key ); ?>]" value="1" <?php checked( $enabled ); ?> data-section-visible>
									<span aria-hidden="true"></span>
								</label>
							<?php else : ?>
								<input type="hidden" name="visibility[<?php echo esc_attr( $section_key ); ?>]" value="1">
								<small>обязательный</small>
							<?php endif; ?>
						</div>
					</header>
					<div class="chitayka-card__body" hidden>
						<p class="chitayka-card__description"><?php echo esc_html( $section['description'] ); ?></p>
						<div class="chitayka-fields chitayka-fields--<?php echo esc_attr( isset( $section['layout'] ) ? $section['layout'] : $section_key ); ?>">
							<?php foreach ( $section['fields'] as $key => $field ) : ?><?php chitayka_render_admin_field( $key, $field ); ?><?php endforeach; ?>
						</div>
						<footer class="chitayka-card__footer">
							<button class="button" type="submit" name="reset_section" value="<?php echo esc_attr( $section_key ); ?>" data-reset-section>Восстановить исходные значения блока</button>
						</footer>
					</div>
				</section>
			<?php endforeach; ?>

			<div class="chitayka-toolbar chitayka-toolbar--bottom">
				<button class="button button-primary button-hero" type="submit">Сохранить все изменения</button>
				<a class="button button-hero" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener">Открыть главную ↗</a>
			</div>
		</form>
	</div>
	<?php
}

/** Страница единых контактов и реквизитов. */
function chitayka_render_contacts_admin() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Недостаточно прав.', 'chitayka' ), 403 );
	}
	$schema = chitayka_content_fields();
	$section = $schema['contacts']['sections']['contacts'];
	?>
	<div class="wrap chitayka-admin">
		<?php chitayka_admin_page_head( 'Контакты и реквизиты', 'Единые данные используются в шапке, контактах, форме и подвале сайта.' ); ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-content-form>
			<input type="hidden" name="action" value="chitayka_save_content">
			<input type="hidden" name="editor_page" value="contacts">
			<?php wp_nonce_field( 'chitayka_save_content', 'chitayka_content_nonce' ); ?>
			<div class="chitayka-toolbar">
				<button class="button button-primary button-hero" type="submit">Сохранить все изменения</button>
				<a class="button button-hero" href="<?php echo esc_url( home_url( '/#contacts' ) ); ?>" target="_blank" rel="noopener">Открыть контакты ↗</a>
				<span class="chitayka-toolbar__status" data-save-status><i aria-hidden="true"></i> Все изменения сохранены</span>
			</div>
			<section class="chitayka-card is-open">
				<header class="chitayka-card__head"><h2 class="chitayka-card__title"><?php echo esc_html( $section['title'] ); ?></h2></header>
				<div class="chitayka-card__body">
					<p class="chitayka-card__description"><?php echo esc_html( $section['description'] ); ?></p>
					<div class="chitayka-fields"><?php foreach ( $section['fields'] as $key => $field ) : ?><?php chitayka_render_admin_field( $key, $field ); ?><?php endforeach; ?></div>
				</div>
			</section>
			<div class="chitayka-toolbar chitayka-toolbar--bottom"><button class="button button-primary button-hero" type="submit">Сохранить все изменения</button></div>
		</form>
	</div>
	<?php
}
