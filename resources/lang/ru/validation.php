<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute должно быть принято.',
    'active_url'           => ':attribute не является допустимым URL.',
    'after'                => ':attribute должна быть дата, после :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, числа, и тире.',
    'alpha_num'            => ':attribute может содержать только буквы и числа.',
    'array'                => ':attribute должно быть массивом.',
    'before'               => ':attribute должна быть дата перед :date.',
    'between'              => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file'    => ':attribute должно быть между :min и :max килобай.',
        'string'  => ':attribute должно быть между :min и :max символов.',
        'array'   => ':attribute должно быть между :min и :max пунктами.',
    ],
    'boolean'              => ':attribute поле должно быть истинным или ложным.',
    'confirmed'            => ':attribute подтверждение не совпадает.',
    'date'                 => ':attribute это не корректная дата.',
    'date_format'          => ':attribute не соответствует формату :format.',
    'different'            => ':attribute и :other должны быть разными.',
    'digits'               => ':attribute должно быть :digits цифрами.',
    'digits_between'       => ':attribute должно быть между :min и :max цифрами.',
    'dimensions'           => ':attribute недействительные размеры изображения.',
    'distinct'             => ':attribute поле имеет повторяющееся значение.',
    'email'                => ':attribute должен быть действительным.',
    'exists'               => 'Выбранное :attribute является недействительным.',
    'file'                 => ':attribute должен быть файлом.',
    'filled'               => ':attribute поле, обязательное для заполнения.',
    'image'                => ':attribute должно быть изображением.',
    'in'                   => 'selected :attribute является недействительным.',
    'in_array'             => ':attribute поле не найдено в :other.',
    'integer'              => ':attribute должно быть целым числом.',
    'ip'                   => ':attribute должен быть действительный IP-адрес.',
    'json'                 => ':attribute должна быть действительной строкой JSON.',
    'max'                  => [
        'numeric' => ':attribute не может быть больше, чем :max.',
        'file'    => ':attribute не может быть больше, чем :max килобайт.',
        'string'  => ':attribute не может быть больше, чем :max символов.',
        'array'   => ':attribute не может иметь более :max пунктов.',
    ],
    'mimes'                => ':attribute должно быть файлом типа: :values.',
    'min'                  => [
        'numeric' => 'The :attribute должен быть не менее :min.',
        'file'    => 'The :attribute должен быть не менее :min килобайт.',
        'string'  => 'The :attribute должен быть не менее :min символов.',
        'array'   => 'The :attribute должны иметь по крайней мере :min пунктов.',
    ],
    'not_in'               => 'Выбранное :attribute является недействительным.',
    'numeric'              => ':attribute должно быть ислом.',
    'present'              => ':attribute поле должно присутствовать.',
    'regex'                => ':attribute формат является недействительным.',
    'required'             => ':attribute поле, обязательное для заполнения.',
    'required_if'          => ':attribute поле, обязательное для заполнения, где :other есть :value.',
    'required_unless'      => ':attribute поле, обязательное для заполнения, если :other есть в :values.',
    'required_with'        => ':attribute поле, обязательное для заполнения, где :values присутствует.',
    'required_with_all'    => ':attribute поле, обязательное для заполнения, где :values присутствует.',
    'required_without'     => ':attribute поле, обязательное для заполнения, где :values не присутствует.',
    'required_without_all' => ':attribute поле, обязательное для заполнения, где ни один из :values присутсвуют.',
    'same'                 => ':attribute и :other должны соответствовать.',
    'size'                 => [
        'numeric' => ':attribute должно быть :size.',
        'file'    => ':attribute должно быть :size килобайт.',
        'string'  => ':attribute должно быть :size символов.',
        'array'   => ':attribute must contain :size пунктов.',
    ],
    'string'               => ':attribute должно быть строкой.',
    'timezone'             => ':attribute должно быть действительной зоной.',
    'unique'               => ':attribute уже был взят.',
    'url'                  => ':attribute формат является недействительным.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
		'email' => [
			'required' => 'Укажите ваш e-mail адрес!',
		],
		'name' => [
			'required' => 'Укажите ваше имя!',
		],
		'text' => [
			'required' => 'Вы не ввели текст сообщения!',
		],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
