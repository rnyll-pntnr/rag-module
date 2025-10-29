<?php

namespace Modules\RAG\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class RAGUploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array {
        return [
            'file' => 'required|mimes:pdf,txt,doc,docx'
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
