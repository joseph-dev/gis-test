<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class GetDataRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'feed_id' => 'required|integer|min:1|max:2'
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('language', 'nullable|string', function ($input) {
            return $input->feed_id == 1;
        });

        $validator->sometimes('page', 'nullable|integer', function ($input) {
            return $input->feed_id == 1;
        });

        $validator->sometimes('region', 'nullable|string', function ($input) {
            return $input->feed_id == 1;
        });

        return $validator;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'feed_id'  => 'Feed',
            'language' => 'Language',
            'page'     => 'Page',
            'region'   => 'Region',
        ];
    }
}