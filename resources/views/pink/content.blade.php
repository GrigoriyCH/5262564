<div id="content-home" class="content group">
				            <div class="hentry group">
				                <div class="section portfolio">
								
				                @if($posts && count($posts)>0)    
									
				                    <h3 class="title">{{ trans('ru.from_blog') }}</h3>
			 
				                    @foreach($posts as $k=>$item)
				                        @if($k==0)
				                        
				                           <div class="hentry work group portfolio-sticky portfolio-full-description">
				                             <div class="work-thumbnail">
				                               <a class="thumb" href="{{ route('posts.show',['id' => $item->id]) }}"><img src="{{ $item->img }}" alt="{{ $item->title }}" title="{{ $item->title }}" /></a>
				                             </div>
				                             <div class="work-description">
				                                <h2><a href="{{ route('posts.show',['id' => $item->id]) }}">{{ $item->title }}</a></h2>
				                                <hr size="1" color="grey">
				                                 <p>{{$item->meta_desc}}</p>
				                                <a href="{{ route('posts.show',['id' => $item->id]) }}" class="read-more">|| {{Lang::get('ru.read_more')}}</a>
				                             </div>
				                           </div>
				                    
				                           <div class="clear"></div>
										<div class="portfolio-projects">
				                        @continue
				                        @endif		                    
				                    
				                    
				                    @if($k!=0)	   
				                        <div class="related_project  {{ ($k==4) ? ' related_project_last' : '' }}">
				                            <div class="overlay_a related_img image-wrap">
				                                
													<a href="{{ route('posts.show',['id' => $item->id]) }}">
														<img class="home-img-cover" src="{{ $item->img }}" alt="{{ $item->title }}" title="{{ $item->title }}" style="width: 100%;object-fit: cover;"/>						
													</a>
				                                
				                            </div>
				                            <h4 class="home" style="border-bottom:1px solid #D3D3D3"><a href="{{ route('posts.show',['id' => $item->id]) }}">{{ $item->title }}</a></h4>
											
				                            <p>{{str_limit($item->meta_desc, 128)}}</p>
				                        </div>
										
				                    @endif  
											
				                    @endforeach	
										</div>
				                @else
									
									<h3>Постов нет...</h3>				        
								@endif    
				                </div>
				                <div class="clear"></div>
				            </div>
				            <!-- START COMMENTS -->
				            <div id="comments"></div>
				            <!-- END COMMENTS -->
</div>