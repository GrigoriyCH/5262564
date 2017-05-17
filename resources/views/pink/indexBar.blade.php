
				            <div class="widget-first widget recent-posts">
				            
				            @if($posts)
				               <h3>{{ trans('ru.from_blog') }}</h3>
				               <div class="recent-post group">
				               
				                   @foreach($posts as $post)
				               
				                   <div class="hentry-post group">
				                        <div class="thumb-img"><img id="mini-img" src="{{$post->img_mini}}" alt="{{$post->title}}" title="{{$post->title}}" /></div>
				                        <div class="text">
				                            <a href="{{route('posts.show',['id'=>$post->id])}}" title="{{$post->title}}" class="title">{{$post->title}}</a>
											@if($post->created_at)
				                            <p class="post-date">{{ $post->created_at->format('F d, Y') }}</p>
											@endif
				                        </div>
				                    </div>
				                    
				                   @endforeach
				                    
				               </div>
				            @endif
				            
				            <div class="widget-last widget text-image">
				                <h3>Customer support</h3>
				                <div class="text-image" style="text-align:left"><img src="{{asset(env('THEME'))}}/images/callus.gif" alt="Customer support" /></div>
				                <p>Proin porttitor dolor eu nibh lacinia at ultrices lorem venenatis. Sed volutpat scelerisque vulputate. </p>
				            </div>
				            