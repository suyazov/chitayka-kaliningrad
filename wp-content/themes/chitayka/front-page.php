<?php
/**
 * Главная страница: hero с 3 CTA, группы, направления, тарифы, форма, контакты.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="hero">
	<div class="container">
		<h1><?php esc_html_e( 'Детский центр «Читай-ка»', 'chitayka' ); ?></h1>
		<p class="hero__lead"><?php esc_html_e( 'Учим читать с удовольствием. Калининград, ул. Аксакова 131.', 'chitayka' ); ?></p>
		<div class="hero__cta">
			<a class="btn btn--primary" href="#lead-form" data-cta="diagnostika"><?php esc_html_e( 'Бесплатная диагностика', 'chitayka' ); ?></a>
			<a class="btn" href="#lead-form" data-cta="zanyatie"><?php esc_html_e( 'Пробное занятие', 'chitayka' ); ?></a>
			<a class="btn" href="#lead-form" data-cta="den"><?php esc_html_e( 'Пробный день', 'chitayka' ); ?></a>
		</div>
	</div>
</section>

<section class="groups">
	<div class="container">
		<h2><?php esc_html_e( 'Группы', 'chitayka' ); ?></h2>
		<div class="cards">
			<div class="card">
				<h3><?php esc_html_e( '4–6 лет', 'chitayka' ); ?></h3>
				<p><?php esc_html_e( 'Дошкольная группа: первые шаги в чтении и подготовка к школе.', 'chitayka' ); ?></p>
			</div>
			<div class="card">
				<h3><?php esc_html_e( '7–9 лет', 'chitayka' ); ?></h3>
				<p><?php esc_html_e( 'Младшие школьники: техника чтения, понимание текста, продлёнка.', 'chitayka' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="directions">
	<div class="container">
		<h2><?php esc_html_e( 'Направления', 'chitayka' ); ?></h2>
		<div class="cards">
			<div class="card">
				<h3><?php esc_html_e( 'Обучение чтению', 'chitayka' ); ?></h3>
				<p><?php esc_html_e( 'От слогов к уверенному чтению и пониманию текста.', 'chitayka' ); ?></p>
			</div>
			<div class="card">
				<h3><?php esc_html_e( 'Подготовка к школе (ПКШ)', 'chitayka' ); ?></h3>
				<p><?php esc_html_e( 'Комплексная подготовка дошкольников к первому классу.', 'chitayka' ); ?></p>
			</div>
			<div class="card">
				<h3><?php esc_html_e( 'Продлёнка', 'chitayka' ); ?></h3>
				<p><?php esc_html_e( 'Группа продлённого дня для школьников.', 'chitayka' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="prices">
	<div class="container">
		<h2><?php esc_html_e( 'Тарифы', 'chitayka' ); ?></h2>
		<p class="prices__note"><strong><?php esc_html_e( 'Цены требуют подтверждения актуальности у клиента.', 'chitayka' ); ?></strong></p>
		<div class="cards">
			<div class="card">
				<h3><?php esc_html_e( 'Обучение чтению', 'chitayka' ); ?></h3>
				<p class="card__price"><?php esc_html_e( 'XXX ₽ / занятие', 'chitayka' ); ?></p>
			</div>
			<div class="card">
				<h3><?php esc_html_e( 'Подготовка к школе', 'chitayka' ); ?></h3>
				<p class="card__price"><?php esc_html_e( 'XXX ₽ / месяц', 'chitayka' ); ?></p>
			</div>
			<div class="card">
				<h3><?php esc_html_e( 'Продлёнка', 'chitayka' ); ?></h3>
				<p class="card__price"><?php esc_html_e( 'XXX ₽ / месяц', 'chitayka' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="lead" id="lead-form">
	<div class="container">
		<h2><?php esc_html_e( 'Оставить заявку', 'chitayka' ); ?></h2>
		<?php chitayka_render_lead_form( 'diagnostika' ); ?>
	</div>
</section>

<section class="contacts">
	<div class="container">
		<h2><?php esc_html_e( 'Контакты', 'chitayka' ); ?></h2>
		<p><?php esc_html_e( 'Калининград, ул. Аксакова 131', 'chitayka' ); ?></p>
		<p><?php esc_html_e( 'Телефон: [ТЕЛЕФОН]', 'chitayka' ); ?></p>
		<p><?php esc_html_e( 'Email: [EMAIL]', 'chitayka' ); ?></p>
		<p><?php esc_html_e( 'Мы в соцсетях: [СОЦСЕТИ]', 'chitayka' ); ?></p>
	</div>
</section>

<?php
get_footer();
