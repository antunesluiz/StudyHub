<?php

namespace App\Http\Requests\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Traits\UsernameSuggestionTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminStudentRequest extends FormRequest
{
    use PasswordValidationRules, UsernameSuggestionTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('createUser', $this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'birthdate' => ['required', 'string', 'max:255'],
            'gender'    => ['required', 'string', 'max:255', Rule::in(['masculino', 'feminino', 'outros']),]
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'username'  => Str::slug($this->username),
            'gender'    => Str::lower($this->gender),
        ]);
    }


    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->has('username')) {
                $suggestions = $this->generateUsernameSuggestions(
                    [
                        'submittedUsername' => $this->username,
                        'name' => $this->name,
                        'birthdate' => $this->birthdate ? Carbon::parse($this->birthdate)->format('Y') : null,
                    ],
                    'users'
                );

                $validator->errors()->add('username_suggestions', $suggestions);
            }
        });
    }
}
