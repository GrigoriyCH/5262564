			            
				            <div class="widget-first widget recent-posts">
				                <h3>{{ Lang::get('ru.random_projects') }}</h3>
				                <div class="recent-post group">
									@if($randomposts)
									@if(!$randomposts->isEmpty())
				                      
										@foreach($randomposts as $randompost)
				                         
				                        <div class="hentry-post group">
				                           <div class="thumb-img"><div style="overflow:hidden;width:55px;max-height:55px"><img src="{{$randompost->user->avatar}}" alt="{{$randompost->title}}" title="{{$randompost->title}}" style="width:100%;"/></div></div>
				                           <div class="text">
				                            <a href="{{route('posts.show',['id'=>$randompost->id])}}" title="{{$randompost->title}}" class="title">{{$randompost->title}}</a>
				                            <p>{!!str_limit($randompost->meta_desc, 130)!!} </p>
				                            <a class="read-more" href="{{route('posts.show',['id'=>$randompost->id])}}">&rarr; {{Lang::get('ru.read_more')}}</a>
				                           </div>
				                        </div>
				                         
										@endforeach
				                      
									@endif
									@endif
				                </div>

				            </div>
							
							@if($comments)
				            @if(!$comments->isEmpty())
				            <div class="widget-last widget recent-comments">
				                <h3>{{Lang::get('ru.last_comments')}}</h3>
				                   <div class="recent-post recent-comments group">
				                   
				                   @foreach($comments as $comment)
				                   
				                    <div class="hentry-post group">
				                        <div class="thumb-img">
											<div style="overflow:hidden;width:55px;max-height:55px">
												<img src="{{ isset($comment->user) ? $comment->user->avatar : config('settings.default_avatar')}}" style="width:100%;"/>
											</div>
										</div>
										<div class="text">
											<span class="author"><strong><a href="{{route('posts.show',['id'=>$comment->posts->id])}}#respond">{{isset($comment->user) ? $comment->user->name : $comment->name}}</a></strong> в</span> 
											<a class="title" href="{{route('posts.show',['id'=>$comment->posts->id])}}">{{$comment->posts->title}}</a>
											<p class="comment">
												{!!str_limit($comment->text)!!} <a class="goto" href="{{route('posts.show',['id'=>$comment->posts->id])}}">&#187;</a>
											</p>
										</div>
				                    </div>
				                   
				                   @endforeach
				                   
				                   </div>
				            </div>    
				            @endif
							@endif
				            
				            
				                
                                
				            