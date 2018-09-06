<section class="featured-news container-fluid">
	<h3>News <img src="@asset('images/green-dots.png')" alt="decorative green dots">
		<small><a href="/bccampus-news">view all news</a></small>
	</h3>
	@foreach(\App\App::getLatestNews( 1 ) as $feature)
		<?php
		// not using $child->guid since guid does not
		// update to current domain when importing content
		$link = site_url() . '/' . $feature->post_name;
		$date = date( 'M d, Y', strtotime( $feature->post_date ) );

		if (has_post_thumbnail( $feature->ID ) ): ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $feature->ID ), 'single-post-thumbnail' ); ?>
		<div class="row" style="background-image: url('{{$image[0]}}')">
			<?php else: ?>
			<div class="row">
				<?php endif; ?>
				<h4 class="up-and-over"><a class="text-inverse purple-bkgd" href="{{$link}}">{{$feature->post_title}}</a>
				</h4>
			</div>
			<article class="row">
				<p class="upper">{{$date}}</p>
				<p><?php echo wp_trim_words( $feature->post_content, '30', "<a href='{$link}'>&hellip;</a>" );?></p>
			</article>
	@endforeach
</section>
