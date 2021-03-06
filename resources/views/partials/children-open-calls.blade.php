<h4 class="pt-5">Open Calls for Proposals</h4>
<p>We are looking for applications for the following:</p>
<section class="grants d-flex flex-row flex-wrap no-gutters">
	@php
		$ids= [155,451]; // open call for proposals is 451 on cert, 155 on prod
		$limit = 4;
		$last_day = 0;
	@endphp
	@foreach(\App\App::getUpcomingEvents( $limit, $ids, $last_day ) as $open)
		@php($link=\App\App::maybeGuid($open['post_id'], $open['title']))
		<article class="grants-open col-md-6 my-2" itemscope itemtype="http://schema.org/Event">
			<a href="{{$link}}" class="img-link">
			<div class="featured-grant row-fluid d-flex"
				 style="background-image: url({{\App\App::getThumbUrl($open['post_id'])}});">
				<h4 itemprop="name" class="text-center purple-bkgd text-inverse col-sm mt-auto">{{wp_specialchars_decode($open['title'])}}
				</h4>
			</div>
			</a>
			<div class="row-fluid border min-height-md">
				<p class="pt-3 px-2">{!! \App\App::maybeExcerpt($open['post_id'],$open['post_content'],$link,25) !!}</p>
			</div>
			<span itemprop="location" itemscope itemtype="http://schema.org/Place">
			<meta itemprop="address" content="{!! $open['location'] !!}"/>
			</span>
		</article>
	@endforeach
</section>
