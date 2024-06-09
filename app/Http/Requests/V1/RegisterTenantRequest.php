<?php

namespace App\Http\Requests\V1;

use App\Rules\RegistrationDomainRequiredRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

/**
 * @property string $domain
 */
class RegisterTenantRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^(06|07|05)\d{8}$/', 'unique:users,phone'],
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'association' => 'required|string|max:255',
            'association_email' => 'sometimes|email',
            'domain' => ['required', 'string', 'max:255', new RegistrationDomainRequiredRule, 'unique:domains,domain'],
            'address' => 'required|string|max:255',
            'landline' => 'sometimes|nullable|regex:/^(0)\d{8}$/',
            'phones' => 'required|array|min:1',
            'phones.0' => ['required', 'regex:/^(06|07|05)\d{8}$/'],
            'phones.1' => ['sometimes', 'nullable', 'regex:/^(06|07|05)\d{8}$/'],
            'phones.2' => ['sometimes', 'nullable', 'regex:/^(06|07|05)\d{8}$/'],
            'links' => 'sometimes|array',
            'links.facebook' => ['sometimes', 'nullable', 'url', "regex:/^(https?:\/\/)?(www\.)?facebook\.com\/[a-zA-Z0-9.]*$/i"],
            'city' => 'required|integer',
            'links.instagram' => ['sometimes', 'nullable', 'url', "regex:/^(https?:\/\/)?(www\.)?instagram\.com\/[a-zA-Z0-9._-]*$/i"],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'domain' => Str::domain($this->domain),
        ]);
    }
}
