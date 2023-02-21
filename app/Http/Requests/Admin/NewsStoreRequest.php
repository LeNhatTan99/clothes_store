<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsStoreRequest extends FormRequest
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
        $rules = [
            'title'=>'required',
            'content'=>'required|min:30',
            'thumbnail'=>'image',
        ];
        return $rules;
    }

      /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $messages = array(
            'title.required' => 'Tiêu đề bài viết không được để trống',
            'content.required' => 'Nội dung bài viết không được để trống',
            'content.min' => 'Nội dung bài viết tối thiểu nhập 30 ký tự',
            'thumbnail.image' =>  'Vui lòng chọn đúng định dạng ảnh',
        );
        return $messages;
    }
}
