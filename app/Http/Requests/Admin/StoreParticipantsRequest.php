<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantsRequest extends FormRequest
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
            'pin'=>'required|unique:participants,pin',
            'first_name' => 'required',
            'sex' => 'required',
            'dob' => 'nullable|date_format:'.config('app.date_format'),
            'photo' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}