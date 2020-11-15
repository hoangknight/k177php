<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
class EditUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->id,
            'fullname' => 'required | max: 255'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'fullname.required' => 'Tên người dùng không được để trống',
            'fullname.max' => 'Tên người dùng không được quá 255 ký tự'    
        ];
    }
}
