<?php
/* Add new page status */
function rs_custom_post_status() {
	register_post_status( 'for_registered', array(
		'label' => _x( 'Для зарегистрированных', 'post' ),
		'public' => true,
		'exclude_from_search' => false,
		'show_in_admin_all_list' => true,
		'show_in_admin_status_list' => true,
		'label_count' => _n_noop( 'Для зарегистрированных <span class="count">(%s)</span>', 'Для зарегистрированных <span class="count">(%s)</span>' ),
	) );
}

function rs_append_post_status_list_for_page() {
	global $post;
	$complete = '';
	$for_registered = false;
	if( $post->post_type == 'page' ) {
		if( $post->post_status == 'for_registered' ) {
			$complete = ' selected="selected"';
			$for_registered = true;
		}

		?>
		<script>
			jQuery(document).ready(function($){
				$( 'select#post_status' ).append('<option value="for_registered"<?php echo $complete; ?>>Для зарегистрированных</option>');
				if ( $( 'select#post_status option[value="publish"]' ).length ==0 ) {
					$( 'select#post_status' ).prepend('<option value="publish">Опубликовано</option>');
				}
				<?php if ( $for_registered ) { ?>
					$( '#post-status-display' ).text('Для зарегистрированных');
				<?php } ?>
			} );
		</script>
		<?php
	}
}

function rs_append_post_status_list() {
	echo '<script>
	jQuery(document).ready( function($) {
		$(".inline-edit-status select[name=\"_status\"]").append("<option value=\"for_registered\">Для зарегистрированных</option>");
	});
	</script>';
}
add_action( 'init', 'rs_custom_post_status' );
add_action( 'admin_footer-post.php', 'rs_append_post_status_list_for_page' );
add_action( 'admin_footer-edit.php','rs_append_post_status_list' );

// Leaves a user on the current page in case of autorization failure
function rs_front_end_login_fail( $username ) {
	$referrer = $_SERVER['HTTP_REFERER'];  // откуда пришел запрос

	if( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		wp_redirect( add_query_arg('login', 'failed', $referrer ) );
		exit;
	}
}
add_action( 'wp_login_failed', 'rs_front_end_login_fail' );
