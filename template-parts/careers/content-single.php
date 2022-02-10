<?php
/**
 * The template part for displaying Content in career single page.
 *
 * @package RMS
 */

$location      = get_field( 'career_single_location' );
$job_ref       = get_field( 'career_single_job_ref' );
$working_hours = get_field( 'career_single_working_hours' );
$is_social     = get_field( 'show_social_share_icons' );
$btn_url       = get_field( 'career_single_button_link' );
?>

<div class="content-wrap w-full">

	<div class="heading block md:flex justify-between items-center">
		<?php the_title( '<h1 class="text-primary text-4xl font-bold">', '</h1>' ); ?>
		<?php
		if ( $btn_url ) {
			printf(
				'<a href="%s" class="button mt-4 md:mt-0">%s</a>',
				esc_url( $btn_url ),
				esc_html__( 'Apply', 'rms' )
			);
		}
		?>
	</div>

	<div class="meta-info block lg:flex flex-wrap justify-between my-6 text-theme-color text-lg">
		<?php
		if ( $location || $job_ref || $working_hours ) {
			?>
			<div class="meta">
				<ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 lg:gap-y-0 lg:flex lg:space-x-12">
					<li class="flex">
						<span class="font-medium mr-1"><?php esc_html_e( 'Date Posted', 'rms' ); ?></span> -&nbsp;<?php rms_posted_on() ?>
					</li>
					<?php
					if ( $location ) {
						printf(
							'<li class="flex">
								<span class="font-medium mr-1">%s</span> - %s
							</li>',
							esc_html__( 'Location', 'rms' ),
							esc_html( $location )
						);
					}
					if ( $job_ref ) {
						printf(
							'<li class="flex">
								<span class="font-medium mr-1">%s</span> - %s
							</li>',
							esc_html__( 'Job Ref', 'rms' ),
							esc_html( $job_ref )
						);
					}
					if ( $working_hours ) {
						printf(
							'<li class="flex">
								<span class="font-medium mr-1">%s</span> - %s
							</li>',
							esc_html__( 'Working Hours', 'rms' ),
							esc_html( $working_hours )
						);
					}
					?>
				</ul>
			</div>
			<?php
		}

		// Social Icons.
		if ( $is_social ) {
			?>
			<div class="social-icons flex mt-4 xl:mt-0">
				<?php get_template_part( 'template-parts/knowledge/social', 'shares' ); ?>
			</div>
			<?php
		}
		?>
	</div>

	<?php the_content(); ?>

</div>
