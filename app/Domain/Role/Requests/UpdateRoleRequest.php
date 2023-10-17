<?php

namespace App\Domain\Role\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Database\Query\Builder;

class UpdateRoleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('role')->id;
        return [
            'name' => [
                'nullable', 'string', 'max:255',
                Rule::unique('roles')->where(
                    fn (Builder $query) => $query->whereNull('deleted_at')
                )->ignore($id)
            ],
        ];
    }
}
