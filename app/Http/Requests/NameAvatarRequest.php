<?php

namespace Japblog\Http\Requests;

use Japblog\Http\Requests\Request;

class NameAvatarRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('VIEW_USER_PAGE');
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
			'name' => 'required|max:55'
        ];
    }
}
