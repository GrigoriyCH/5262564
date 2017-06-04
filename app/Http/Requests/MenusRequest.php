<?php

namespace Japblog\Http\Requests;

use Japblog\Http\Requests\Request;

class MenusRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('EDIT_MENU');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
			'title'=>'required|max:255'
        ];
    }
}
