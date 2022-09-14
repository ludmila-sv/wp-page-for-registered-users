<?php
if ( 'for_registered' === $post->post_status && ! is_user_logged_in() ) {

	if ( get_option( 'users_can_register' ) ) {
		require __DIR__ . '/page-login.php';
	} else {
		get_header();
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="rs-17">
					<div class="rs-page">
						<div class="container">
							<p style="padding: 50px 0; text-align: center;">У Вас нет доступа к этой странице.</p>
						</div>
					</div>
				</div>
			</main>
		</div>
		<?php
	}

} else {

	get_header();
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				/* ... */

			endwhile;
			?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php } ?>
<?php get_footer(); ?>
