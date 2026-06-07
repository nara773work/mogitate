<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|integer|min:0|max:10000',
            'season_ids' => 'required|array',
            'season_ids.*' => 'integer|exists:seasons,id',
            'description' => 'required|max:120',
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = 'filled|image|mimes:png,jpeg';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'image.filled' => '画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'season_ids.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
