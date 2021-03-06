@php
	$post_types = [ 'ai1ec_event' ];
	$limit = 4;
@endphp
<div class="container-fluid my-3">
<h3>Related Events <img class="mx-2 mb-1" src="@asset('images/green-dots.png')" alt="decorative green dots">
	<small><a href="{{get_site_url()}}/events">view all events</a></small>
</h3>
<section class="related-events d-flex flex-row flex-wrap">
	@foreach(\App\App::getRelevant($post, $post_types, $limit, $tag) as $related_post )
		<article class="col-md-3 my-2" itemscope itemtype="http://schema.org/Event">
			<div class="border p-3 min-height-sm">
			<p class="text-uppercase font-size-sm"><time itemprop="startDate" datetime="{{ get_post_time('c', true, $related_post->ID) }}">{{ get_the_date('',$related_post->ID) }}</time></p>
			<h4><a class="purple" itemprop="name" href="@php echo esc_url( $related_post->guid ); @endphp">{!! wp_trim_words( $related_post->post_title, 7 ) !!}</a></h4>
			</div>
			<span itemprop="location" itemscope itemtype="http://schema.org/Place">
			<meta itemprop="address" content="{!! $related_post->location !!}"/>
			</span>
		</article>
	@endforeach
</section>
</div>
