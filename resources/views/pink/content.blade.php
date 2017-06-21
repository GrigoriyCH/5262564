@if($news && count($news)>0)

<div id="content-home" class="content group">
				            <div class="hentry group">
				                <div class="section portfolio">
				                    
				                    <h3 class="title">{{ trans('ru.latest_projects') }}</h3>
			 
				                    @foreach($news as $k=>$item)
				                        @if($k==0)
				                        
				                           <div class="hentry work group portfolio-sticky portfolio-full-description">
				                             <div class="work-thumbnail">
				                               <a class="thumb" href="{{ route('sitenews.show',['id' => $item->id]) }}"><img src="{{ $item->img }}" alt="{{ $item->title }}" title="{{ $item->title }}" /></a>
				                             </div>
				                            <div class="work-description">
				                                <h2><a href="{{ route('sitenews.show',['id' => $item->id]) }}">{{ $item->title }}</a></h2>
				                                <hr size="1" color="grey">
				                                 <p>{!! str_limit(strip_tags($item->text, $iskl), 384) !!}</p>
				                                <a href="{{ route('sitenews.show',['id' => $item->id]) }}" class="read-more">|| Read more</a>
				                            </div>
				                           </div>
				                    
				                           <div class="clear"></div>
				                    
				                        @continue
				                        @endif
				                
				                    
				                    @if($k==1)
				                    <div class="portfolio-projects">
				                    @endif    
				                        <div class="related_project  {{ ($k==4) ? ' related_project_last' : '' }}">
				                            <div class="overlay_a related_img">
				                                <div class="overlay_wrapper"><a href="{{ route('sitenews.show',['id' => $item->id]) }}">
				                                    <img src="{{ $item->img_mini }}" alt="{{ $item->title }}" title="{{ $item->title }}" />						
				                                    <!--<div class="overlay">-->
				                                        <!--<a class="overlay_img" href="{{asset(env('THEME'))}}/images/projects/0061.jpg" rel="lightbox" title=""></a>-->
				                                        <!--<a class="overlay_project" href="project.html"></a>-->
				                                        <!--<span class="overlay_title">{{ $item->title }}</span>-->
				                                   <!-- </div>--></a>
				                                </div>
				                            </div>
				                            <h4><a href="{{ route('sitenews.show',['id' => $item->id]) }}">{{ $item->title }}</a></h4>
				                            <p>{!! str_limit(strip_tags($item->text, $iskl), 200) !!}</p>
				                        </div>
				                        
				                        @endforeach				                        
				                    </div>
				                </div>
				                <div class="clear"></div>
				            </div>
				            <!-- START COMMENTS -->
				            <div id="comments">
				            </div>
				            <!-- END COMMENTS -->
				        </div>
@else
	<br>
<h3>Новостей нет...</h3>				        
@endif