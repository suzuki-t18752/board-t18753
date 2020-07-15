<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:20',
            'article' => 'required|max:200',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'article' => '本文',
            'image' => '画像',
        ];
    }
}
