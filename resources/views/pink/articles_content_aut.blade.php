<div id="content-blog" class="content group">
	@if($articles)
		@foreach($articles as $item)
	      <div class="sticky hentry hentry-post blog-big group">
				                <!-- post featured & title -->
				                <div class="thumbnail">
				                    <!-- post title -->
				                    <h2 class="post-title"><a href="{{ route('posts.show',['id'=>$item->id]) }}">{{ $item->title }}</a></h2>
				                    <!-- post featured -->
									
				                    <div class="image-wrap img-head">
										<img style="width:100%" src="{{$item->img}}" alt="{{ $item->title }}" title="{{ $item->title }}" />
				                    </div>

				                    <p class="date">
				                        <span class="month">{{$item->created_at->format('M')}}</span>
				                        <span class="day">{{$item->created_at->format('d')}}</span>
				                    </p>
				                </div>
				                <!-- post meta -->
				                <div class="meta group">
				                    <p class="author"><span><a href="{{route('postsAut',['aut_alias' => $item->user_id])}}" title="Posts by {{$item->user->name}}" rel="author">{{$item->user->name}}</a></span></p>
				                    <p class="categories"><span><a href="{{route('postsCat',['cat_alias' => $item->category->alias])}}" title="View all posts in {{$item->category->title}}" rel="category tag">{{$item->category->title}}</a></span></p>
				                    <p class="comments"><span><a href="{{ route('posts.show',['id'=>$item->id]) }}#respond" title="Comment on Section shortcodes &amp; sticky posts!">{{count($item->comments) ? count($item->comments) : '0'}} {{Lang::choice('ru.comments',count($item->comments))}}</a></span></p>
				                </div>
				                <!-- post content -->
				                <div class="the-content group">
				                    <p>{!!str_limit(strip_tags($item->text, '<a><p><br><strong><i>'),512)!!}</p>
				                    <p><a href="{{route('posts.show',['id'=>$item->id])}}" class="btn   btn-beetle-bus-goes-jamba-juice-4 btn-more-link">→ {{Lang::get('ru.read_more')}}</a></p>
				                    <!--<hr size="1" color="grey">-->
				                </div>
				                <div class="clear"></div>
		 </div>
		@endforeach			            
				        
				        @if($articles->lastPage() > 1)     
				            <div class="general-pagination group">
				            		
				            		@if($articles->currentPage() !== 1)
				            			<a href="{{ $articles->url(($articles->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
				            		@endif
				            		
				            		@for($i = 1; $i <= $articles->lastPage(); $i++)
				            			@if($articles->currentPage() == $i)
				            				<a class="selected disabled">{{ $i }}</a>
				            			@else
				            				<a href="{{ $articles->url($i) }}">{{ $i }}</a>
				            			@endif		
				            		@endfor
				            		
				            		@if($articles->currentPage() !== $articles->lastPage())
				            			<a href="{{ $articles->url(($articles->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
				            		@endif
				            		
				            </div>	
				        @endif   
				            
			@else
			
				<h3>{!! Lang::get('ru.authorless') !!}</h3>
			
			@endif           
	</div>