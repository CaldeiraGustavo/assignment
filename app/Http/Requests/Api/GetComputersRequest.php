<?php

namespace App\Http\Requests\Api;

use App\Adapters\Contracts\ComputersImportInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetComputersRequest extends FormRequest
{
    private $adapter;

    public function __construct(ComputersImportInterface $adapter)
    {
        $this->adapter = $adapter;
    }
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ram' => ['nullable', 'array'],
            'ram.*' => ['required',  Rule::in($this->adapter->getRams())],
            'max_storage' => ['required_with:min_storage', Rule::in($this->adapter->getStorages())],
            'min_storage' => ['required_with:max_storage', Rule::in($this->adapter->getStorages())],
            'harddisk' => ['nullable', Rule::in($this->adapter->getHdds())],
            'location' => ['nullable', Rule::in($this->adapter->getLocations())],
        ];
    }
}
