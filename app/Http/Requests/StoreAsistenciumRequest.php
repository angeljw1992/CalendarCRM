<?php

namespace App\Http\Requests;

use App\Models\Asistencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAsistenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asistencium_create');
    }

    public function rules()
    {
        return [
            'estudiante_id' => [
                'required',
                'integer',
            ],
            'asistencia' => [
                'required',
            ],
            'fecha' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'fecha_reposicion' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
