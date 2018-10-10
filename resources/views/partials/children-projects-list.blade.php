<section class="projects feature-box-sm">
	<div class="featured-image-box" style="background-image: url({{\App\App::getThumbUrl($get_projects_id)}});">
		<h5 class="blue-bkgd text-inverse"><a href="@php echo get_permalink($get_projects_id); @endphp">Projects</a></h5>
	</div>
	<p class="mt-3">We actively participate in opportunities to improve the student experience in B.C. by facilitating technology advancements; enabling research activities; creating collaborative spaces; and more.</p>
	<ul class="mb-3">
		@foreach(\App\Page::getChildrenOfPage($get_projects_id) as $child)
			@php
			// not using $child->guid since guid does not
			// update to current domain when importing content
			$link = site_url() . '/' . $child->post_name;
			@endphp
			<li class="border-top border-right border-left border-last"><a class="purple font-weight-bold" href="{{$link}}">{{$child->post_title}}<i class="fa fa-arrow-right pull-right"></i></a></li>
		@endforeach
	</ul>
</section>
