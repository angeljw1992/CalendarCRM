<?php

namespace App\Http\Requests;

use App\Models\Pago;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePagoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pago_create');
    }

    public function rules()
    {
        return [
            'estudiante_id' => [
                'required',
                'integer',
            ],
            'concepto' => [
                'required',
            ],
            'monto' => [
                'required',
            ],
            'metodo' => [
                'required',
            ],
            'fecha_asignada_de_pago' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'fecha' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'descripcion' => [
                'string',
                'nullable',
            ],
        ];
    }
}
