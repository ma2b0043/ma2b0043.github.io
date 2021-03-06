<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yith-proteo
 */

$post_layout        = get_theme_mod( 'yith_proteo_single_post_layout', 'standard' );
$post_thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'full' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'proteo_post_layout_' . $post_layout ); ?>>
	<?php if ( 'standard' === $post_layout ) : ?>
		<header class="entry-header">
			<?php
			if ( is_single() && function_exists( 'woocommerce_breadcrumb' ) ) {
				woocommerce_breadcrumb();
			}
			?>

			<div class="date-and-thumbnail">
				<?php
				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
						if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
						}

						$time_string = sprintf(
							$time_string,
							esc_attr( get_the_date( DATE_W3C ) ),
							esc_html( get_the_date() ),
							esc_attr( get_the_modified_date( DATE_W3C ) ),
							esc_html( get_the_modified_date() )
						);

						echo $time_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
				<?php yith_proteo_post_thumbnail(); ?>
			</div>

			<?php
				yith_proteo_print_page_titles();
			?>

			<div class="entry-meta">
				<?php
				yith_proteo_posted_by();
				yith_proteo_posted_on();

				if ( 'post' === get_post_type() ) {
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( esc_html__( ', ', 'yith-proteo' ) );
					if ( $categories_list ) {
						/* translators: 1: list of categories. */
						printf( '<span class="cat-links">' . esc_html__( 'Categories: %1$s', 'yith-proteo' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}

					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'yith-proteo' ) );
					if ( $tags_list ) {
						/* translators: 1: list of tags. */
						printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'yith-proteo' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="comments-link">';
					comments_popup_link(
						sprintf(
							wp_kses(
								/* translators: %s: post title */
								__( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'yith-proteo' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);
					echo '</span>';
				}
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
	<?php elseif ( 'background_picture' === $post_layout ) : ?>
		<header class="alignfull" style="background-image: url(<?php echo esc_url( $post_thumbnail_url ); ?>)">
			<div class="single-post-header-content">
				<div class="container">
				<?php
					yith_proteo_print_page_titles();
				?>
				<div class="entry-meta">
				<?php
				yith_proteo_posted_by();
				yith_proteo_posted_on();

				if ( 'post' === get_post_type() ) {
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( esc_html__( ', ', 'yith-proteo' ) );
					if ( $categories_list ) {
						/* translators: 1: list of categories. */
						printf( '<span class="cat-links">' . esc_html__( 'Categories: %1$s', 'yith-proteo' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}

					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'yith-proteo' ) );
					if ( $tags_list ) {
						/* translators: 1: list of tags. */
						printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'yith-proteo' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="comments-link">';
					comments_popup_link(
						sprintf(
							wp_kses(
								/* translators: %s: post title */
								__( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'yith-proteo' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);
					echo '</span>';
				}
				?>
			</div><!-- .entry-meta -->
				</div>
			</div>

		</header>
	<?php endif; ?>
	<div class="entry-content">
		<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'yith-proteo' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'yith-proteo' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php yith_proteo_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
