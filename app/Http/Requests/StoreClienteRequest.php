<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClienteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cliente_create');
    }

    public function rules()
    {
        return [
            'fullname' => [
                'string',
                'required',
            ],
            'identificacion' => [
                'string',
                'required',
                'unique:clientes',
            ],
            'fecha_nacimiento' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'correo' => [
                'required',
            ],
            'telefono' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'observaciones' => [
                'string',
                'min:1',
                'max:300',
                'nullable',
            ],
            'activo' => [
                'required',
            ],
        ];
    }
}
