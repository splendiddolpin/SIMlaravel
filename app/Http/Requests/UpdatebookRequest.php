<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatebookRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'cover_image' => [
                'nullable', // File boleh kosong jika tidak ingin diubah
                'file', // Pastikan ini adalah file yang dapat diakses Laravel
                'image', // Memastikan hanya file gambar yang bisa dikirim
                'mimes:jpg,jpeg,png,gif', // Hanya menerima format gambar
                'max:10240' // Maksimal 10MB
            ],
        ];
    }
}
