	
clickButton={deletePost:function(formName,post_id,title)
	{		
		jQuery.confirm({
			
			'title'		: 'Подтверждение удаления!',
			'message'	: 'Вы собираетесь удалить: '+'"'+title+'".'+'<br />Вы не сможете его восстановить позже! Продолжить?',
			'buttons'	: {
				'Да'	: {
					'class'	: 'blue',
					'action': function(){				
						document.getElementById(formName + post_id).submit();
					}
				},
				'Нет'	: {
					'class'	: 'gray',
					'action': function(){
						
					}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		
	}
}