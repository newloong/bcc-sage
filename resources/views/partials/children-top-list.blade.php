<section class="topics-of-practice feature-box-sm">
	<div class="featured-image-box" style="background-image: url({{\App\App::getThumbUrl($get_topics_of_practice_id)}});">
		<h5 class="blue-bkgd text-inverse"><a href="@php echo get_permalink($get_topics_of_practice_id); @endphp">Topics of Practice</a></h5>
	</div>
	<p class="mt-3">At BCcampus, we support the adaptation and evolution of teaching and learning practices in post-secondary institutions across British Columbia through collaboration, communication, and innovation.</p>
	<div class="mb-3 list-group">
		@foreach(\App\Page::getChildrenOfPage($get_topics_of_practice_id) as $child)
			@php
			// not using $child->guid since guid does not d
			// update to current domain when importing content
			$link = site_url() . '/' . $child->post_name;
			@endphp
			<a class="list-group-item list-group-item-action purple font-weight-bold" href="{{$link}}">{{wp_specialchars_decode($child->post_title)}}<i class="fa fa-arrow-right pull-right"></i></a>
		@endforeach
	</div>
</section>
