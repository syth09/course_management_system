<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status'      => 'required|in:draft,published',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên khóa học không được để trống.',
            'price.min'     => 'Giá khóa học phải lớn hơn 0.',
            'image.image'   => 'File phải là hình ảnh.',
        ];
    }
}
