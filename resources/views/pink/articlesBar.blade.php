			            
				            <div class="widget-first widget recent-posts">
				                <h3>{{ Lang::get('ru.random_projects') }}</h3>
				                <div class="recent-post group">
				                
				                  @if(!$randomposts->isEmpty())
				                      
				                      @foreach($randomposts as $randompost )
				                         
				                         <div class="hentry-post group">
				                           <div class="thumb-img mini-img"><img src="{{$randompost->img_mini}}" alt="{{$randompost->title}}" title="{{$randompost->title}}" /></div>
				                           <div class="text">
				                            <a href="{{route('posts.show',['id'=>$randompost->id])}}" title="{{$randompost->title}}" class="title">{{$randompost->title}}</a>
				                            <p>{!!str_limit($randompost->text, 130)!!} </p>
				                            <a class="read-more" href="{{route('posts.show',['id'=>$randompost->id])}}">&rarr; {{Lang::get('ru.read_more')}}</a>
				                           </div>
				                        </div>
				                         
				                      @endforeach
				                      
				                  @endif
				                  
				                    </div>

				            </div>
							
							@if($comments)
				            @if(!$comments->isEmpty())
				            <div class="widget-last widget recent-comments">
				                <h3>{{Lang::get('ru.last_comments')}}</h3>
				                   <div class="recent-post recent-comments group">
				                   
				                   @foreach($comments as $comment)
				                   
				                    <div class="the-post group">
				                        <div class="avatar">
				                            @set($hash, ($comment->email) ? md5($comment->email) : $comment->user->email)
				                            <img alt="" src="https://www.gravatar.com/avatar/{{$hash}}?d=mm&s=55" class="avatar" />   
				                        </div>
				                        <span class="author"><strong><a href="#">{{isset($comment->user) ? $comment->user->name : $comment->name}}</a></strong> in</span> 
				                        <a class="title" href="{{route('posts.show',['id'=>$comment->posts->id])}}">{{$comment->posts->title}}</a>
				                        <p class="comment">
                                            {!!str_limit($comment->text)!!} <a class="goto" href="{{route('posts.show',['id'=>$comment->posts->id])}}">&#187;</a>
                                        </p>
				                    </div>
				                   
				                   @endforeach
				                   
				                   </div>
				            </div>    
				            @endif
							@endif
				            
				            
				                
                                
				            