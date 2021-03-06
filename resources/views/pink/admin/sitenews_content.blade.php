
	<div id="content-page" class="content group">
				            <div class="hentry group">
							@if($articles)
				                <h2>Добавленные Новости сайта</h2>
				                <div class="short-table white">
				                    <table style="width: 100%" cellspacing="0" cellpadding="0">
				                        <thead>
				                            <tr>
				                                <th class="align-left">ID</th>
				                                <th>Заголовок</th>
				                                <th>Текст</th>
				                                <th>Изображение</th>
												<th>Автор(ID)</th>
				                                <th>Дествие</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                            
											@foreach($articles as $article)
											<tr>
				                                <td class="align-left">{{$article->id}}</td>
				                                <td class="align-left">{!! Html::link(route('admin.sitenews.edit',['articles'=>$article->id]),$article->title) !!}</td>
				                                <td class="align-left">{{str_limit($article->text,200)}}</td>
				                                <td>
												<center style="	overflow:hidden;width:82px;height:28px">
														<div style="width:100%;">
															@if(isset($article->img))
															{!! Html::image($article->img) !!}
															@endif
														</div>
												</center>
												</td>
												<td>{{$article->user->name}} ( {{$article->user->id}} )</td>
				                                <td>
												{!! Form::open(['url' => route('admin.sitenews.destroy',['articles'=>$article->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
												{!! Form::close() !!}
												</td>
											 </tr>	
											@endforeach	
				                           
				                        </tbody>
				                    </table>
				                </div>
								{!! HTML::link(route('admin.sitenews.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}
								<div class="general-pagination group">
				            
				            	@if($articles->lastPage() > 1) 
				            		
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
				            		
				            	@endif
				           
								</div>	
							@else
								{!! Html::link(route('admin.sitenews.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}
							@endif
				            </div>
							
				            <!-- START COMMENTS -->
				            <div id="comments">
				            </div>
				            <!-- END COMMENTS -->
	</div>
