<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
        if(!empty($this->user['id']) ) {
            $user = $this->user['id'];
        } 
        else ($user = null );
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'. $user,
            'phone_number' => 'required|min:10|max:11|regex:/^[0-9]*$/|unique:users,phone_number,' . $user,
            'address' => ['required','max:255'],
            'password' =>  $user ? 'nullable' : 'required' . '|min:6|max:150|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/u',
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
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.max' => 'Email không quá 255 ký tự',
            'email.unique' => 'Email đã được sử dụng',
            'address.required' => 'Địa chỉ không được để trống',
            'address.max' => 'Địa chỉ không quá 255 ký tự',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.min' =>  'Số điện thoại tối thiểu 10 ký tự',
            'phone_number.max' => 'Số điện thoại tối đa 11 ký tự',
            'phone_number.regex' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone_number.unique' => 'Số điện thoại đã được sử dụng',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.max' =>'Mật khẩu tối đa 150 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ hoa, chữ thường và 1 số',
        );
        return $messages;
    }
}
