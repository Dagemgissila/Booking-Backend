<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role === 'admin';
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_number'    => 'required|unique:rooms,room_number',
            'floor'          => 'required|integer',
            'beds'           => 'required|integer|min:1',
            'price_per_hour' => 'required|numeric|min:0',
            'status'         => 'boolean',
            'image'          => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }
}
