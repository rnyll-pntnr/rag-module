<?php

namespace Modules\RAG\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class RAGUploadRequest extends FormRequest
{
    public function prepareForValidation() {
        $this->merge([
            'filename' => $this->file('file')->getClientOriginalName()
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array {
        if ($this->route()->getName() == 'api.document.update') {
            return [
                'file' => 'required|mimes:pdf,txt,doc,docx',
                'filename' => 'unique:documents,name' . $this->route('id') . ',id,user_id,' . auth()->id(),
            ];
        }
        return [
            'file' => 'required|mimes:pdf,txt,doc,docx',
            'filename' => 'unique:documents,name',
        ];
    }

    public function messages(): array {
        return [
            'filename.unique' => 'A document with this name already exists',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return auth()->check();
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        throw new \Illuminate\Validation\ValidationException($validator,
            response()->json([
                'success' => false,
                'message' => 'Validation errors occurred',
                'error' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
