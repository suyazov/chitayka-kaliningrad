<?php
/**
 * Нативные настройки содержимого сайта в WordPress Customizer.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'customize_register',
	function ( $customizer ) {
		$customizer->add_panel(
			'chitayka_content',
			array(
				'title'       => 'Содержимое «Читай-ки»',
				'description' => 'Контакты, цены и фотографии главной страницы.',
				'priority'    => 20,
			)
		);

		$customizer->add_section( 'chitayka_contacts', array( 'title' => 'Контакты', 'panel' => 'chitayka_content' ) );
		$contacts = array(
			'phone'           => array( 'Телефон', '+7 911 497-33-04', 'sanitize_text_field' ),
			'email'           => array( 'Электронная почта', 'clubchitayka@mail.ru', 'sanitize_email' ),
			'address'         => array( 'Адрес', 'Калининград, ул. Аксакова 131', 'sanitize_text_field' ),
			'vk_url'          => array( 'Ссылка ВКонтакте', 'https://vk.ru/clubchitayka39', 'esc_url_raw' ),
			'lead_requisites' => array( 'Реквизиты в подвале', 'ИП Бурмистрова Полина Сергеевна · ИНН 246519367524 · ОГРНИП 325246800146312', 'sanitize_text_field' ),
		);

		foreach ( $contacts as $key => $config ) {
			$setting = 'chitayka_' . $key;
			$customizer->add_setting( $setting, array( 'default' => $config[1], 'sanitize_callback' => $config[2] ) );
			$customizer->add_control( $setting, array( 'label' => $config[0], 'section' => 'chitayka_contacts', 'type' => 'text' ) );
		}

		$customizer->add_section(
			'chitayka_prices',
			array(
				'title'       => 'Тарифы',
				'description' => 'Введите цену целиком, например «6 900 ₽».',
				'panel'       => 'chitayka_content',
			)
		);

		$prices = array(
			'school'      => array( 'Подготовка к школе', '6 900 ₽' ),
			'reading'     => array( 'Обучение чтению', '6 900 ₽' ),
			'development' => array( 'Комплексное развитие 4–5 лет', '6 900 ₽' ),
			'english'     => array( 'Английский язык', '5 600 ₽' ),
			'calligraphy' => array( 'Каллиграфия', '5 600 ₽' ),
			'art'         => array( 'Арт-студия', '3 900 ₽' ),
			'neuro'       => array( 'Нейропсихолог — от', '1 650 ₽' ),
			'extended_am' => array( 'Продлёнка утренняя', '18 500 ₽' ),
			'extended_pm' => array( 'Продлёнка дневная', '21 800 ₽' ),
			'optimal'     => array( 'Продлёнка «Оптимальный»', '12 000 ₽' ),
			'homework'    => array( 'Экспресс-домашка', '9 900 ₽' ),
			'one_day'     => array( '«Выручалочка» — один день', '2 000 ₽' ),
			'events'      => array( 'Праздники и мастер-классы — от', '500 ₽' ),
			'wall'        => array( 'Интерактивная стена', '500 ₽' ),
		);

		foreach ( $prices as $key => $config ) {
			$setting = 'chitayka_price_' . $key;
			$customizer->add_setting( $setting, array( 'default' => $config[1], 'sanitize_callback' => 'sanitize_text_field' ) );
			$customizer->add_control( $setting, array( 'label' => $config[0], 'section' => 'chitayka_prices', 'type' => 'text' ) );
		}

		$customizer->add_section(
			'chitayka_gallery',
			array(
				'title'       => 'Фотогалерея',
				'description' => 'Выберите изображения из медиатеки. Пустое поле использует исходную фотографию.',
				'panel'       => 'chitayka_content',
			)
		);

		for ( $index = 1; $index <= 14; $index++ ) {
			$setting = 'chitayka_gallery_' . $index;
			$customizer->add_setting( $setting, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
			$customizer->add_control(
				new WP_Customize_Image_Control(
					$customizer,
					$setting,
					array( 'label' => 'Фотография ' . $index, 'section' => 'chitayka_gallery' )
				)
			);
		}
	}
);
