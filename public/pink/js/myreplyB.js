function sayHello(name,id) {
			document.getElementById('comment').value=name;
			document.getElementById('comment_to_user_id').value=id;
		}
function cancelHello(id_author) {
			document.getElementById('comment').value='';
			document.getElementById('comment_to_user_id').value=id_author;
		}