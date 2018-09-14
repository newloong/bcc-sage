<?php
$post_types = [ 'post', 'page' ];
$limit = 3;
$i = 0;
;?>
<div class="shady-bkgd my-3 p-2">
	<h3>Related News <img src="@asset('images/green-dots.png')" alt="decorative green dots">
		<small><a href="{{get_site_url()}}/news">view all news</a></small>
	</h3>
	<section class="relevant d-flex flex-row flex-wrap no-gutters">
		@foreach(\App\App::getRelevant($post, $post_types, $limit, $tag) as $related_post )
			<?php
			// not using $child->guid since guid does not
			// update to current domain when importing content
			$link = site_url() . '/' . $related_post->post_name;

			// make the first one bigger
			if ( 0 === $i ): ;?>
			<div class="col-6 px-2">
				<div class="row featured-news-front" style="background-image: url({{\App\App::getThumbUrl($related_post->ID)}});">
				<article class="col feature-box-md purple-bkgd" itemscope itemtype="http://schema.org/Article">
					<p><time itemprop="datePublished" class="updated" datetime="{{ get_post_time('c', true, $related_post->ID) }}">{{ get_the_date('',$related_post->ID) }}</time></p>
					<h4><a class="text-inverse" href="{{$link}}">{{$related_post->post_title}}</a>
					</h4>
				</article>
				<div class="col"></div>
				</div>
			</div>
			<?php else: ;?>
			<article class="col feature-box-sm px-1 border" itemscope itemtype="http://schema.org/Article">
				<div class="featured-image-box" style="background-image: url({{\App\App::getThumbUrl($related_post->ID)}});">
					<a href="{{$link}}"></a>
				</div>
				<p class="upper pad-top"><time itemprop="datePublished" class="updated" datetime="{{ get_post_time('c', true, $related_post->ID) }}">{{ get_the_date('',$related_post->ID) }}</time></p>
				<h4><a class="purple" href="{{$link}}">{{$related_post->post_title}}</a>
				</h4>
			</article>
			<?php endif;?>
			<?php $i ++; unset($image); ?>
		@endforeach
	</section>
</div>
