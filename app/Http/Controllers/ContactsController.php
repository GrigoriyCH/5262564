<?php

namespace Japblog\Http\Controllers;

use Illuminate\Http\Request;

use Japblog\Http\Requests;

use Mail;

class ContactsController extends SiteController
{
    //
    public function __construct() {
    	
    	parent::__construct(new \Japblog\Repositories\MenusRepository(new \Japblog\Menu));
    	
    	
    	$this->bar = 'left';
    	
    	$this->template = config('settings.theme').'.contacts';
		
	}
	
	 public function index(Request $request) {
	 	
	 	
	 	if ($request->isMethod('post')) {
		    
			$messages = [
			    'required' => 'Поле :attribute Обязательно к заполнению',
			    'email'    => 'Поле :attribute должно содержать правильный email адрес',
			];
			
			 $this->validate($request, [
		        'name' => 'required|max:255',
		        'email' => 'required|email',
				'text' => 'required'
		    ]/*,$messages*/);
			
			$data = $request->all();
			
			$result = Mail::send(config('settings.theme').'.email', ['data' => $data], function ($m) use ($data) {
				$mail_admin = config('settings.mail_admin');
				
	            $m->from($data['email'], $data['name']);

	            $m->to($mail_admin, 'Mr. Admin')->subject('сайт: moyzhurnal.com');
	        });
			
			if($result) {
				return redirect()->route('contacts')->with('status', 'Письмо отправлено!');
			}
			else{
				return redirect()->route('contacts')->with('notsend', 'Письмо не отправлено! Техническая неисправность, попробуйте позже...');
			}
			
		}
	 	
	 	
	 	$this->title = 'Контакты';
	 	
	 	$content = view(config('settings.theme').'.contact_content')->render();
	 	$this->vars = array_add($this->vars,'content',$content);
	 	
	 	$this->contentLeftBar = view(config('settings.theme').'.contact_bar')->render();
	 	
	 	return $this->renderOutput();
    }
				
    
}
