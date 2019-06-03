<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingsRequest extends FormRequest
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

       // id, region, venue, start_date, end_date, type_of_training, sponsor, created_at, updated_at, deleted_at, comments, title
        return [
            'start_date' => 'nullable|date_format:'.config('app.date_format'),
            'end_date' => 'nullable|date_format:'.config('app.date_format'),
            'region'=>'required',
            'venue'=>'required',
            'type_of_training'=>'required'
        ];
    }
}
