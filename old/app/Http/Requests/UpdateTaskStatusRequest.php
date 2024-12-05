<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
