<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return
            [
                'truck_maker' => ['required', 'max:255'],
                'truck_plate' => ['required', 'alpha_dash', 'max:20'],
                'truck_make_year' => ['required', 'numeric', 'digits:4'],
                'image' => 'sometimes|file|mimes:jpg,jpeg,gif,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip'
            ];
    }
}
