							@if(!empty($subscribe))
							@if($subscribe == 'animation')
							<div class="widget recent-posts">
						
								<a target="_blank" href="http://feeds.feedburner.com/~r/moyzhurnal-animation/~6/2"><img src="http://feeds.feedburner.com/moyzhurnal-animation.2.gif" alt="RSS-лента о аниме и мультиках" style="border:0;width:100%;"></a>
								
								<form style="border:1px solid #ccc;padding:3px;text-align:center;" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=moyzhurnal-animation', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
									<h3>Подписаться на рассылку?</h3>
									
									<p class="divforinput">
									<input class="INPUT_1" style="width:80%" placeholder="Введите адрес Эл.почты" type="text" name="email"/>
									<br/>
									Рассылка обновлений об аниме и мультиках
									</p>
									
									<input type="hidden" value="moyzhurnal-animation" name="uri"/>
									<input type="hidden" name="loc" value="ru_RU"/>
									<input id="butsend" type="submit" value="Подписаться" />
									
								</form>
							</div>
							@endif
							@if($subscribe == 'movies')
							<div class="widget recent-posts">
						
								<a target="_blank" href="http://feeds.feedburner.com/~r/moyzhurnal-movies/~6/1"><img src="http://feeds.feedburner.com/moyzhurnal-movies.1.gif" alt="RSS-лента о кино и сериалах" style="border:0;width:100%;"></a>
								
								<form style="border:1px solid #ccc;padding:3px;text-align:center;" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=moyzhurnal-movies', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
									<h3>Подписаться на рассылку?</h3>
									
									<p class="divforinput">
									<input class="INPUT_1" style="width:80%" placeholder="Введите адрес Эл.почты" type="text" name="email"/>
									<br/>
									Рассылка обновлений о кино и сериалах
									</p>
									
									<input type="hidden" value="moyzhurnal-movies" name="uri"/>
									<input type="hidden" name="loc" value="ru_RU"/>
									<input id="butsend" type="submit" value="Подписаться" />
									
								</form>
							</div>
							@endif
							@endif
							
				            <div class="widget-first widget recent-posts">
								@if($randomposts)
								@if(!$randomposts->isEmpty())
								@if(count($randomposts)>1)
				                <h3>{{ Lang::get('ru.random_projects') }}</h3>
				                <div class="recent-post group">
									
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
				                      
				                </div>
								@endif
								@endif
								@endif
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
				            
							
				            
				                
                                
				            