<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_create');
    }

    public function rules()
    {
        return [
            'grupo' => [
                'required',
            ],
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'final_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'dias' => [
                'required',
            ],
        ];
    }
}
