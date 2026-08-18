<?php
/**
 * Подвал темы.
 *
 * @package chitayka
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>
<footer class="site-footer">
	<div class="container">
		<p><?php esc_html_e( 'Детский центр «Читай-ка», Калининград, ул. Аксакова 131', 'chitayka' ); ?></p>
		<p><?php esc_html_e( 'Телефон: [ТЕЛЕФОН] · Email: [EMAIL] · [СОЦСЕТИ]', 'chitayka' ); ?></p>
		<p class="site-footer__legal"><?php esc_html_e( '[ЛИЦЕНЗИЯ] · [РЕКВИЗИТЫ]', 'chitayka' ); ?></p>
		<p class="site-footer__copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
