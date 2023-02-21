<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        if(!empty($this->product['id']) ) {
            $product = $this->product['id'];
        } 
        else ($product = null );
        $rules = [
            'name'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'thumbnail'=> $product ? 'nullable' : 'required'.'image',
            'description'=>['required','min:15'],
            'inventory'=>['required','between:0,1000'],
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
            'name.required' => 'Tên sản phẩm không được để trống',
            'price.required' => 'Giá sản phẩm không được để trống',
            'discount.required' => 'Giá khuyến mãi không được để trống',
            'thumbnail.required' => 'Hình ảnh sản phẩm không được để trống',
            'thumbnail.image' =>  'Vui lòng chọn đúng định dạng ảnh',
            'description.min' => 'Vui lòng nhập mô tả tối thiểu 15 ký tự',
            'description.required' =>'Mô tả không được để trống',
            'inventory.required' => 'Số lượng không được để trống',
            'inventory.between' => 'Số lượng chỉ từ 1 đến 1000',
        );
        return $messages;
    }
}
