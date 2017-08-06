var step = 0;

jQuery(document).ready(function($) {
	/*
	$('.commentlist li').each(function(i) {
		
		$(this).find('div.commentNumber').text('#' + (i + 1));
		
	});
	*/
      
	/////////////////
	
	$('#commentform').on('click','#submit',function(e) {
		
		e.preventDefault();
		
		var comParent = $(this);
		
		$('.wrap_result').
					css('color','green').
					text('Сохранение комментария').
					fadeIn(500,function() {
						
						var data = $('#commentform').serializeArray();
						
						$.ajax({
							
							url:$('#commentform').attr('action'),
							data:data,
							headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							type:'POST',
							datatype:'JSON',
							success: function(html) {
								if(html.error) {
									$('.wrap_result').css('color','red')
									.append('<br /><strong>Ошибка: </strong>' + html.error.join('<br />'));
									
									$('.wrap_result').delay(2000).fadeOut(500);
								}
								else if(html.success) {
									$('.wrap_result')
													.append('<br /><strong>Сохранено!</strong>')
													.delay(2000)
													.fadeOut(500,function() {
														
														if(html.data.parent_id > 0) {
															comParent.parents('div#respond').prev().after('<ul class="children">' + html.comment + '</ul>');
														}
														else{
															if($.contains('#comments','ol.commentlist')){
																$('ol.commentlist').append(html.comment);
															}
															else{
																$('#respond').before('<ol class="commentlist group">' + html.comment + '</ol>');
															}
														}
														
														var countComments = parseInt($('#countComments').val());
														$('#countComments').val(countComments+1);
														$('#spanCountComms').text(countComments+1);
														
														$('#cancel-comment-reply-link').click();
														
														if(countComments > 10)
														{
															$('.borGreen').stop().animate({
																height: "0px", // высоту к нулю
																/*width: "0px", // ширину к нулю*/
																opacity: 0 // прозрачность к нулю к нулю
															}, 5000, function() 
																{
																	$(this).remove(); // удаляем из DOM (если требуется, если же нет, то "закомментируйте" эту строку)
																});
														}
													})
													
								}
								
								
							},
							error:function() {
								$('.wrap_result').css('color','red').append('<br /><strong>Ошибка...</strong>');
								$('.wrap_result').delay(2000).fadeOut(500, function(){
									$('#cancel-comment-reply-link').click();
									
								});
							}
							
						});
					});
		
	});
//////////////////////////////////////////////	
$(document).ready(function(){	
	
$('#getContent').on('click',function(e){
e.preventDefault();

var countComments = parseInt($('#countComments').val());
var postID = $('#postID').val();
var stepComments = parseInt($('#stepComments').val());
var typeComments = $('#typeComments').val();

$('#divWait').css('display','');
$('#getContent').css('display','none');

$.ajax({
url: "/"+typeComments+"/"+postID+"/"+step,
cache: false,
success: function(data){
	
	if(data != 0){
		
	$('#divWait').css('display','none');
	$('#divContent').append(data);
	$('#ajaxels').append($('#divContent').html());
	$('#divContent').html('');
	step+=stepComments;
	if((step+1)>countComments){$('#getContent').css('display','none');}else{$('#getContent').css('display','');}
	
	}else 
	{   /*alert("Больше комментариев нет.")*/;
		$('#cent').css('display','none');}
	
	},
error:function() {alert("Неизвестная ошибка...");$('#cent').css('display','none');}
});
return false;
});
});
//////////////////////////////////////////////
$(document).ready(function() 
{
	var countComments = parseInt($('#countComments').val());
	if(countComments > 0)
	{
		$("#getContent").click();
	}
	else
	{
		$('#cent').css('display','none');
	}
});
//////////////////////////////////////////////////////////////
$(function(){
	var block_width = 816;
	
  $('.img-head').height($('.img-head').width()/(block_width/282));

  $(window).resize(function(){
    $('.img-head').height($('.img-head').width()/(block_width/282));
  });
});
//////////////////////////////////////////////////////////////
});