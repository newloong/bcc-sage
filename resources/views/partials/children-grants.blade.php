<h4 class="pt-5">Grants Currently Offered</h4>
<section class="grants d-flex flex-row flex-wrap">
	@foreach(\App\Page::getChildrenOfPage() as $child)
		@php
			$link = site_url() . '/' . $child->post_name;
		@endphp
		<article class="grants-current col-sm-6 no-gutters mb-2 px-2" itemscope itemtype="http://schema.org/Article">
			<div class="featured-grant row-fluid d-flex" style="background-image: url({{\App\App::getThumbUrl($child->ID)}});">
				<h4 class="purple-bkgd text-inverse col-sm mt-auto"><a href="{{$link}}">{{$child->post_title}}</a>
				</h4>
			</div>
			<div class="row-fluid border-left border-right border-bottom">
				<p class="pad-top pad-left pad-right"><?php echo wp_trim_words( $child->post_content, '30', "<a href='{$link}'>&hellip;<i class='fa fa-arrow-right'></i></a>" );?></p>
			</div>
		</article>
	@endforeach
</section>
