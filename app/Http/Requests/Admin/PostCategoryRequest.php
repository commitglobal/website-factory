<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Post;
use App\Services\TranslatableFormRequestRules;
use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class PostCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return TranslatableFormRequestRules::make(Post::class, [
            'title'               => ['required', 'string', 'max:200'],
            'slug'                => ['nullable', 'string', 'max:200'],
            'description'         => ['nullable', 'string'],
        ]);
    }
}
