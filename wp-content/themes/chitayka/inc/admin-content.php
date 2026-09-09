<?php
/**
 * Упрощённый редактор содержимого сайта в админке WordPress.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Поля редактора, сгруппированные по вкладкам.
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

add_action(
	'admin_menu',
	function () {
		add_menu_page(
			'Контент сайта «Читай-ка»',
			'Контент сайта',
			'edit_theme_options',
			'chitayka-content',
			'chitayka_render_content_admin',
			'dashicons-edit-page',
			3
		);
	}
);

add_action(
	'admin_enqueue_scripts',
	function ( $hook_suffix ) {
		if ( 'toplevel_page_chitayka-content' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_style( 'chitayka-admin-content', get_template_directory_uri() . '/assets/admin-content.css', array(), CHITAYKA_VERSION );
		wp_enqueue_script( 'chitayka-admin-content', get_template_directory_uri() . '/assets/admin-content.js', array(), CHITAYKA_VERSION, true );
	}
);

/**
 * Сохраняет данные редактора в theme_mods, совместимые с Customizer.
 */
function chitayka_save_content_admin() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'Недостаточно прав для изменения сайта.', 'chitayka' ) );
	}

	check_admin_referer( 'chitayka_save_content', 'chitayka_content_nonce' );
	$values = isset( $_POST['chitayka'] ) && is_array( $_POST['chitayka'] ) ? wp_unslash( $_POST['chitayka'] ) : array();

	foreach ( chitayka_flat_content_fields() as $key => $field ) {
		if ( ! array_key_exists( $key, $values ) ) {
			continue;
		}

		$value = (string) $values[ $key ];
		switch ( isset( $field['sanitize'] ) ? $field['sanitize'] : '' ) {
			case 'email':
				$value = sanitize_email( $value );
				break;
			case 'url':
				$value = esc_url_raw( $value );
				break;
			default:
				$value = 'textarea' === ( isset( $field['type'] ) ? $field['type'] : '' ) ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
		}

		set_theme_mod( 'chitayka_' . $key, $value );
	}

	$active_tab = isset( $_POST['active_tab'] ) ? sanitize_key( wp_unslash( $_POST['active_tab'] ) ) : 'home';
	wp_safe_redirect(
		add_query_arg(
			array(
				'page'    => 'chitayka-content',
				'updated' => '1',
				'tab'     => $active_tab,
			),
			admin_url( 'admin.php' )
		)
	);
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
	?>
	<div class="chitayka-field<?php echo 'image' === $type ? ' chitayka-field--image' : ''; ?>">
		<label for="chitayka-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
		<?php if ( 'textarea' === $type ) : ?>
			<textarea id="chitayka-<?php echo esc_attr( $key ); ?>" name="chitayka[<?php echo esc_attr( $key ); ?>]" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
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
			<input type="text" id="chitayka-<?php echo esc_attr( $key ); ?>" name="chitayka[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>">
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Страница «Контент сайта».
 */
function chitayka_render_content_admin() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$schema     = chitayka_content_schema_with_gallery( chitayka_content_fields() );
	$active_tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : 'home';
	if ( ! isset( $schema[ $active_tab ] ) ) {
		$active_tab = 'home';
	}
	?>
	<div class="wrap chitayka-admin">
		<div class="chitayka-admin__heading">
			<div>
				<h1>Контент сайта «Читай-ка»</h1>
				<p>Редактируйте тексты, контакты, цены и фотографии без изменения дизайна.</p>
			</div>
			<a class="button button-secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" rel="noopener">Открыть сайт ↗</a>
		</div>

		<?php if ( isset( $_GET['updated'] ) ) : ?>
			<div class="notice notice-success is-dismissible"><p>Изменения сохранены и уже отображаются на сайте.</p></div>
		<?php endif; ?>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-content-form>
			<input type="hidden" name="action" value="chitayka_save_content">
			<input type="hidden" name="active_tab" value="<?php echo esc_attr( $active_tab ); ?>" data-active-tab>
			<?php wp_nonce_field( 'chitayka_save_content', 'chitayka_content_nonce' ); ?>

			<nav class="chitayka-tabs" aria-label="Разделы редактора">
				<?php foreach ( $schema as $tab_key => $tab ) : ?>
					<button class="chitayka-tabs__button<?php echo $active_tab === $tab_key ? ' is-active' : ''; ?>" type="button" data-tab="<?php echo esc_attr( $tab_key ); ?>"><?php echo esc_html( $tab['label'] ); ?></button>
				<?php endforeach; ?>
			</nav>

			<?php foreach ( $schema as $tab_key => $tab ) : ?>
				<div class="chitayka-tab<?php echo $active_tab === $tab_key ? ' is-active' : ''; ?>" data-tab-panel="<?php echo esc_attr( $tab_key ); ?>">
					<?php foreach ( $tab['sections'] as $section ) : ?>
						<section class="chitayka-panel">
							<header class="chitayka-panel__head">
								<h2><?php echo esc_html( $section['title'] ); ?></h2>
								<?php if ( ! empty( $section['description'] ) ) : ?><p><?php echo esc_html( $section['description'] ); ?></p><?php endif; ?>
							</header>
							<div class="chitayka-fields<?php echo 'gallery' === $tab_key ? ' chitayka-fields--gallery' : ''; ?>">
								<?php foreach ( $section['fields'] as $key => $field ) : ?>
									<?php chitayka_render_admin_field( $key, $field ); ?>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>

			<div class="chitayka-savebar" data-savebar>
				<p data-save-status><span aria-hidden="true">●</span> Все изменения сохранены</p>
				<button class="button button-primary button-hero" type="submit">Сохранить изменения</button>
			</div>
		</form>
	</div>
	<?php
}
