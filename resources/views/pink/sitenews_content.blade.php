<div id="content-blog" class="content group">
				            @if($sitenews)
				            @foreach($sitenews as $news)
				            <div class="hentry hentry-post blog-small group ">
				                <!-- post featured & title -->
				                <div class="thumbnail">
				                    <!-- post title -->
				                    <h2 class="post-title"><a href="{{route('sitenews.show',['id' => $news->id])}}">{{$news->title}}</a></h2>
				                    <!-- post meta -->
				                    <div class="meta group">
				                    @if($news->created_at)
				                        <p class="date">{{ $news->created_at->format('F d, Y') }}</p>
				                    @endif
				                    </div>
				                    <!-- post featured -->
				                    <div class="image-wrap">
				                        <img src="{{$news->img_mini}}" alt="{{$news->title}}" title="{{$news->title}}" style="max-width:175px; max-height:175px;" />        
				                    </div>
				                </div>
				                <!-- post content -->
				                <div class="the-content group">
									<!--
										$text = $news->text;
										$text = preg_replace( "/<span.+?>/", '', $text);
										$text = str_replace("</span>", "", $text);
									-->
				                	<p>{!! str_limit(strip_tags($news->text, '<a><p><br><strong><i>'), 512) !!}</p>
				                    <p><a href="{{route('sitenews.show',['id' => $news->id])}}" class="btn   btn-beetle-bus-goes-jamba-juice-4 btn-more-link">→ {{Lang::get('ru.read_more')}}</a></p>
				                </div>
				            </div>
				            @endforeach
				            @endif
				            
				            <div class="clear"></div>
				            
				            <div class="general-pagination group">
				            
				            	@if($sitenews->lastPage() > 1) 
				            		
				            		@if($sitenews->currentPage() !== 1)
				            			<a href="{{ $sitenews->url(($sitenews->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
				            		@endif
				            		
				            		@for($i = 1; $i <= $sitenews->lastPage(); $i++)
				            			@if($sitenews->currentPage() == $i)
				            				<a class="selected disabled">{{ $i }}</a>
				            			@else
				            				<a href="{{ $sitenews->url($i) }}">{{ $i }}</a>
				            			@endif		
				            		@endfor
				            		
				            		@if($sitenews->currentPage() !== $sitenews->lastPage())
				            			<a href="{{ $sitenews->url(($sitenews->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
				            		@endif
				            		
				            	
				            	@endif
				           
				            </div>
				            
				        </div>