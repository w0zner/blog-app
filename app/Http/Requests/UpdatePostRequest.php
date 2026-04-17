<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        //dd($this->all());
        $post = $this->route('post');

        return [
             'title' => [
                    Rule::requiredIf(function() use ($post) {
                        return !$post->published_at;
                    }),
                    'string',
                    'max:255',
             ],
            /*'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,*/

            'slug' => [
                Rule::unique('posts', 'slug')->ignore($post->id),
                Rule::requiredIf(function() use ($post) {
                    return !$post->published_at;
                }),
                'string',
                'max:255',
                //'unique:posts,slug,' . $post->id,
            ],
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required_if:is_published,1|string',
            'content' => 'required_if:is_published,1|string',
            'tags' => 'array',
            'is_published' => 'boolean',
        ];
    }
}
