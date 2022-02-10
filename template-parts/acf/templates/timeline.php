<?php
/**
 * The ACF template part for displaying Timeline.
 *
 * @package RMS
 */

$image = '';
if ( get_sub_field( 'timeline_section_bg_image' ) ) {
	$image = df_resize( get_sub_field( 'timeline_section_bg_image' ), '', 1920, 1358, true, true );
}
$heading     = get_sub_field( 'timeline_section_heading' );
$description = get_sub_field( 'timeline_section_description' );
$count       = 1;
?>

<section class="featured timeline pt-[320px] bg-cover" style="background-image: url('<?php echo $image ? $image['url'] : ''; ?>');">
	<div class="container">

		<?php
		if ( $heading || $description ) {
			echo '<div class="heading-section text-center mb-96 text-white relative">';

			if ( $heading ) {
				printf(
					'<span class="title-border text-8xl font-bold uppercase light-stroke opacity-40 hidden lg:block">%1$s</span>
					<h2 class="title text-4xl md:text-7xl font-bold uppercase lg:-mt-14 text-white relative z-10">%1$s</h2>',
					esc_html( $heading )
				);
			}
			if ( $description ) {
				echo '<p class="description mt-6 text-white lg:w-6/12 mx-auto mb-8">' . esc_html( $description ) . '</p>';
			}

			echo '</div>';
		}
		?>

		<!-- <div class="heading-section text-center mb-96 text-white relative">
			<span class="title-border text-8xl font-bold uppercase light-stroke opacity-40 hidden lg:block">Timeline</span>
			<h2 class="title text-4xl md:text-7xl font-bold uppercase lg:-mt-14 text-white relative z-10">Timeline</h2>
			<p class="description mt-6 text-white lg:w-6/12 mx-auto mb-8">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam omnis earum laborum nesciunt quis accusamus?</p>
		</div> -->

	</div>
</section>

<?php
// Timeline posts.
if ( is_array( get_sub_field( 'timeline_lists' ) ) ) {
	$count_row = count( get_sub_field( 'timeline_lists' ) );
}

if ( have_rows( 'timeline_lists' ) ) :

	echo '<section class="timeline-wrap">';
	echo '<div class="container">';

	// Loop through rows.
	while ( have_rows( 'timeline_lists' ) ) :
		the_row();

		// Load sub field value.
		$layout_style = get_sub_field( 'timeline_layout_style' );
		$post_year    = get_sub_field( 'timeline_year' ) ? get_sub_field( 'timeline_year' ) : 'year';
		$small_title  = get_sub_field( 'timeline_small_title' );
		$post_title   = get_sub_field( 'timeline_title' );
		$content      = get_sub_field( 'timeline_content' );
		$image1       = '';
		$image2       = '';
		$image3       = '';
		$first_last   = ' border-b-2 border-l-2 border-primary';
		if ( 'image' === $layout_style ) {
			$first_last = ' border-b-2 border-r-2 border-primary';
		}

		if ( get_sub_field( 'timeline_image_1' ) ) {
			$image1 = df_resize( get_sub_field( 'timeline_image_1' ), '', 588, 416, true, true );
		}
		if ( get_sub_field( 'timeline_image_2' ) ) {
			$image2 = df_resize( get_sub_field( 'timeline_image_2' ), '', 350, 286, true, true );
		}
		if ( get_sub_field( 'timeline_image_3' ) ) {
			$image3 = df_resize( get_sub_field( 'timeline_image_3' ), '', 250, 181, true, true );
		}

		if ( 1 === $count ) {
			$first_last = ' first border-b-2 border-l-2 border-primary';
			if ( 'image' === $layout_style ) {
				$first_last = ' first border-b-2 border-r-2 border-primary';
			}
		}
		if ( $count === $count_row ) {
			$first_last = ' last border-l-2 border-primary';
			if ( 'image' === $layout_style ) {
				$first_last = ' last border-r-2 border-primary';
			}
		}

		// Content - Image.
		if ( 'content' === $layout_style ) {
			?>

			<div class="border-grid<?php echo esc_html( $first_last ); ?> content-image ml-16 mr-16 relative">
				<div class="item-wrap flex flex-col lg:flex-row lg:items-center lg:space-x-26 py-12 lg:py-20 xl:py-56 pl-14 lg:pl-0">

					<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -left-12 top-1/2 -translate-y-1/2">
						<?php
						if ( $post_year ) {
							echo '<span class="scroll-reveal">' . esc_html( $post_year ) . '</span>';
						}
						?>
					</div>

					<?php
					// Content.
					if ( $small_title || $post_title || $content ) {
						echo '<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pr-0 xl:pr-52 flex flex-col justify-center">';

						if ( $small_title ) {
							echo '<div class="date text-lg text-theme-color">' . esc_html( $small_title ) . '</div>';
						}
						if ( $post_title ) {
							echo '<h3 class="text-primary text-3xl font-bold">' . esc_html( $post_title ) . '</h3>';
						}
						if ( $content ) {
							echo '<p>' . nl2br( esc_html( $content ) ) . '</p>';
						}

						echo '</div>';
					}

					// Images.
					if ( $image1 || $image2 || $image3 ) {
						echo '<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -ml-[6px] xl:-ml-0">';
						echo '<div class="w-full grid grid-cols-2 xl:-ml-12 relative">';

						// medium.
						if ( $image2 ) {
							echo '<img class="w-full xl:w-[260px] 2xl:w-[350px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[30%] -bottom-[20%]" src="' . esc_url( $image2['url'] ) . '">';
						}
						// small.
						if ( $image3 ) {
							echo '<img class="w-full xl:w-[210px] 2xl:w-[250px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[24%] bottom-[8%]" src="' . esc_url( $image3['url'] ) . '">';
						}
						// large.
						if ( $image1 ) {
							echo '<img class="col-span-2 w-full border-[6px] border-white" src="' . esc_url( $image1['url'] ) . '">';
						}

						echo '</div>';
						echo '</div>';

					}
					?>
				</div>
			</div>

			<?php
		}

		// Image - Content.
		if ( 'image' === $layout_style ) {
			?>

			<div class="border-grid<?php echo esc_html( $first_last ); ?> image-content ml-16 mr-16 pr-16 relative">
				<div class="item-wrap flex flex-col lg:flex-row lg:items-center py-12 lg:py-20 xl:py-56">

					<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -right-12 top-1/2 -translate-y-1/2">
						<?php
						if ( $post_year ) {
							echo '<span class="scroll-reveal">' . esc_html( $post_year ) . '</span>';
						}
						?>
					</div>

					<?php
					// Images.
					if ( $image1 || $image2 || $image3 ) {
						echo '<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -mr-[6px] xl:-mr-0 xl:ml-16 order-1 lg:-order-none">';
						echo '<div class="w-full grid grid-cols-2 relative">';

						// medium.
						if ( $image2 ) {
							echo '<img class="w-full xl:w-[260px] 2xl:w-[280px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[22%] top-[12%]" src="' . esc_url( $image2['url'] ) . '">';
						}
						// small.
						if ( $image3 ) {
							echo '<img class="w-full xl:w-[210px] 2xl:w-[230px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[20%] -bottom-[20%]" src="' . esc_url( $image3['url'] ) . '">';
						}
						// large.
						if ( $image1 ) {
							echo '<img class="col-span-2 w-full border-[6px] border-white" src="' . esc_url( $image1['url'] ) . '">';
						}

						echo '</div>';
						echo '</div>';

					}

					// Content.
					if ( $small_title || $post_title || $content ) {
						echo '<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pl-8 xl:pl-52 lg:pr-8 flex flex-col justify-center text-right">';

						if ( $small_title ) {
							echo '<div class="date text-lg text-theme-color">' . esc_html( $small_title ) . '</div>';
						}
						if ( $post_title ) {
							echo '<h3 class="text-primary text-3xl font-bold">' . esc_html( $post_title ) . '</h3>';
						}
						if ( $content ) {
							echo '<p>' . nl2br( esc_html( $content ) ) . '</p>';
						}

						echo '</div>';
					}
					?>
					<!-- <div class="border-grid image-content border-b-2 border-r-2 border-primary ml-16 mr-16 pr-16 relative">
						<div class="item-wrap flex flex-col lg:flex-row lg:items-center py-12 lg:py-20 xl:py-56">
							<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -right-12 top-1/2 -translate-y-1/2"><span class="scroll-reveal">1998</span></div>
							<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -mr-[6px] xl:-mr-0 xl:ml-16 order-1 lg:-order-none">
								<div class="w-full grid grid-cols-2 relative">
									<img class="w-full xl:w-[260px] 2xl:w-[280px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[22%] top-[12%]" src="images/timeline-medium.jpg" alt="...">
									<img class="w-full xl:w-[210px] 2xl:w-[230px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[20%] -bottom-[20%]" src="images/timeline-small.jpg" alt="...">
									<img class="col-span-2 w-full border-[6px] border-white" src="images/timeline-large.jpg" alt="...">
								</div>
							</div>
							<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pl-8 xl:pl-52 lg:pr-8 flex flex-col justify-center text-right">
								<div class="date text-lg text-theme-color">28 June</div>
								<h3 class="text-primary text-3xl font-bold">Title 02</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
							</div>
						</div>
					</div> -->
				</div>
			</div>

			<?php
		}

		++$count;

	endwhile;

	echo '</div>';
	echo '</section>';

endif;
?>

<!-- <section class="timeline-wrap">
	<div class="container">

		<div class="border-grid first content-image border-b-2 border-l-2 border-primary ml-16 mr-16 relative">
			<div class="item-wrap flex flex-col lg:flex-row lg:items-center lg:space-x-26 py-12 lg:py-20 xl:py-56 pl-14 lg:pl-0">
				<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -left-12 top-1/2 -translate-y-1/2"><span class="scroll-reveal">1990</span></div>
				<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pr-0 xl:pr-52 flex flex-col justify-center">
					<div class="date text-lg text-theme-color">01 March</div>
					<h3 class="text-primary text-3xl font-bold">Title 01</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
				</div>
				<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -ml-[6px] xl:-ml-0">
					<div class="w-full grid grid-cols-2 xl:-ml-12 relative">
						<img class="w-full xl:w-[260px] 2xl:w-[350px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[30%] -bottom-[20%]" src="images/timeline-medium.jpg" alt="...">
						<img class="w-full xl:w-[210px] 2xl:w-[250px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[24%] bottom-[8%]" src="images/timeline-small.jpg" alt="...">
						<img class="col-span-2 w-full border-[6px] border-white" src="images/timeline-large.jpg" alt="...">
					</div>
				</div>
			</div>
		</div>

		<div class="border-grid image-content border-b-2 border-r-2 border-primary ml-16 mr-16 pr-16 relative">
			<div class="item-wrap flex flex-col lg:flex-row lg:items-center py-12 lg:py-20 xl:py-56">
				<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -right-12 top-1/2 -translate-y-1/2"><span class="scroll-reveal">1998</span></div>
				<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -mr-[6px] xl:-mr-0 xl:ml-16 order-1 lg:-order-none">
					<div class="w-full grid grid-cols-2 relative">
						<img class="w-full xl:w-[260px] 2xl:w-[280px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[22%] top-[12%]" src="images/timeline-medium.jpg" alt="...">
						<img class="w-full xl:w-[210px] 2xl:w-[230px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[20%] -bottom-[20%]" src="images/timeline-small.jpg" alt="...">
						<img class="col-span-2 w-full border-[6px] border-white" src="images/timeline-large.jpg" alt="...">
					</div>
				</div>
				<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pl-8 xl:pl-52 lg:pr-8 flex flex-col justify-center text-right">
					<div class="date text-lg text-theme-color">28 June</div>
					<h3 class="text-primary text-3xl font-bold">Title 02</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
				</div>
			</div>
		</div>

		<div class="border-grid content-image border-b-2 border-l-2 border-primary ml-16 mr-16 relative">
			<div class="item-wrap flex flex-col lg:flex-row lg:items-center lg:space-x-26 py-12 lg:py-20 xl:py-56 pl-14 lg:pl-0">
				<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -left-12 top-1/2 -translate-y-1/2"><span class="scroll-reveal">2005</span></div>
				<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pr-0 xl:pr-52 flex flex-col justify-center">
					<div class="date text-lg text-theme-color">01 March</div>
					<h3 class="text-primary text-3xl font-bold">Title 03</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
				</div>
				<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -ml-[6px] xl:-ml-0">
					<div class="w-full grid grid-cols-2 xl:-ml-12 relative">
						<img class="w-full xl:w-[260px] 2xl:w-[350px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[30%] -bottom-[20%]" src="images/timeline-medium.jpg" alt="...">
						<img class="w-full xl:w-[210px] 2xl:w-[250px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[24%] bottom-[8%]" src="images/timeline-small.jpg" alt="...">
						<img class="col-span-2 w-full border-[6px] border-white" src="images/timeline-large.jpg" alt="...">
					</div>
				</div>
			</div>
		</div>

		<div class="border-grid last image-content border-r-2 border-primary ml-16 mr-16 pr-16 relative">
			<div class="item-wrap flex flex-col lg:flex-row lg:items-center py-12 lg:py-20 xl:py-56">
				<div class="year h-fit text-3xl lg:text-5xl font-bold text-primary bg-white px-5 py-3 border-2 border-primary absolute -right-12 top-1/2 -translate-y-1/2"><span class="scroll-reveal">2021</span></div>
				<div class="image-wrap scroll-reveal w-full xl:w-[45%] mt-8 lg:mt-0 xl:-mt-16 -mr-[6px] xl:-mr-0 xl:ml-16 order-1 lg:-order-none">
					<div class="w-full grid grid-cols-2 relative">
						<img class="w-full xl:w-[260px] 2xl:w-[280px] h-full xl:h-auto border-[6px] border-white xl:absolute -left-[22%] top-[12%]" src="images/timeline-medium.jpg" alt="...">
						<img class="w-full xl:w-[210px] 2xl:w-[230px] h-full xl:h-auto border-[6px] border-white xl:absolute -right-[20%] -bottom-[20%]" src="images/timeline-small.jpg" alt="...">
						<img class="col-span-2 w-full border-[6px] border-white" src="images/timeline-large.jpg" alt="...">
					</div>
				</div>
				<div class="content-wrap scroll-reveal w-full xl:w-[55%] space-y-4 pl-8 xl:pl-52 lg:pr-8 flex flex-col justify-center text-right">
					<div class="date text-lg text-theme-color">10 July</div>
					<h3 class="text-primary text-3xl font-bold">Title 04</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
				</div>
			</div>
		</div>

	</div>
</section> -->
