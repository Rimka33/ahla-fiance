<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // L'utilisateur doit être authentifié (vérifié par le middleware)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Section Hero
            'hero.id' => 'nullable|exists:hero_sections,id',
            'hero.main_title' => 'nullable|string|max:255',
            'hero.description' => 'nullable|string|max:1000',
            'hero.typed_strings' => 'nullable|string|max:500',
            'hero.video_url' => 'nullable|url|max:500',

            // Section À propos
            'about.id' => 'nullable|exists:home_page_sections,id',
            'about.badge_text' => 'nullable|string|max:100',
            'about.title' => 'nullable|string|max:255',
            'about.content' => 'nullable|string|max:2000',
            'about.image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'about.video_thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'about.button_text' => 'nullable|string|max:100',
            'about.button_link' => 'nullable|string|max:255',
            'about.remove_image' => 'nullable|boolean',
            'about.remove_video_thumbnail' => 'nullable|boolean',

            // Section Solution adoptée
            'used_app_text.id' => 'nullable|exists:home_page_sections,id',
            'used_app_text.title' => 'nullable|string|max:255',
            'used_app_text.content' => 'nullable|string|max:1000',

            // Statistiques
            'statistics.id' => 'nullable|exists:statistics,id',
            'statistics.users_count' => 'nullable|integer|min:0',
            'statistics.users_suffix' => 'nullable|string|max:10',
            'statistics.reviews_count' => 'nullable|integer|min:0',
            'statistics.reviews_suffix' => 'nullable|string|max:10',
            'statistics.countries_count' => 'nullable|integer|min:0',
            'statistics.countries_suffix' => 'nullable|string|max:10',
            'statistics.subscribers_count' => 'nullable|integer|min:0',
            'statistics.subscribers_suffix' => 'nullable|string|max:10',

            // Propositions de valeur
            'value_propositions' => 'nullable|array|max:6',
            'value_propositions.*.id' => 'nullable|exists:value_propositions,id',
            'value_propositions.*.title' => 'nullable|string|max:255',
            'value_propositions.*.description' => 'nullable|string|max:1000',
            'value_propositions.*.icon' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024',
            'value_propositions.*.remove_icon' => 'nullable|boolean',
            'value_propositions.*._delete' => 'nullable|boolean',

            // En-tête Comment ça fonctionne
            'how_it_works_header.id' => 'nullable|exists:home_page_sections,id',
            'how_it_works_header.badge_text' => 'nullable|string|max:100',
            'how_it_works_header.title' => 'nullable|string|max:255',
            'how_it_works_header.button_text' => 'nullable|string|max:100',
            'how_it_works_header.button_link' => 'nullable|string|max:255',

            // Étapes Comment ça fonctionne
            'how_it_work_steps' => 'nullable|array|max:3',
            'how_it_work_steps.*.id' => 'nullable|exists:how_it_work_steps,id',
            'how_it_work_steps.*.step_number' => 'nullable|integer|min:1|max:3',
            'how_it_work_steps.*.title' => 'nullable|string|max:255',
            'how_it_work_steps.*.tag_text' => 'nullable|string|max:100',
            'how_it_work_steps.*.description' => 'nullable|string|max:1000',
            'how_it_work_steps.*.icon' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024',
            'how_it_work_steps.*.remove_icon' => 'nullable|boolean',

            // Section Interface
            'interface_section.id' => 'nullable|exists:home_page_sections,id',
            'interface_section.badge_text' => 'nullable|string|max:100',
            'interface_section.title' => 'nullable|string|max:255',

            // Screenshots
            'app_screenshots' => 'nullable|array|max:9',
            'app_screenshots.*.id' => 'nullable|exists:app_screenshots,id',
            'app_screenshots.*.title' => 'nullable|string|max:255',
            'app_screenshots.*.image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'app_screenshots.*.remove_image' => 'nullable|boolean',
            'app_screenshots.*._delete' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'hero.main_title.max' => 'Le titre principal ne peut pas dépasser 255 caractères.',
            'hero.description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'about.image.image' => 'Le fichier doit être une image.',
            'about.image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
            'value_propositions.max' => 'Vous ne pouvez pas ajouter plus de 6 propositions de valeur.',
            'how_it_work_steps.max' => 'Vous ne pouvez pas ajouter plus de 3 étapes.',
            'app_screenshots.max' => 'Vous ne pouvez pas ajouter plus de 9 screenshots.',
            'value_propositions.*.icon.max' => 'L\'icône ne peut pas dépasser 1 Mo.',
            'how_it_work_steps.*.icon.max' => 'L\'icône ne peut pas dépasser 1 Mo.',
            'app_screenshots.*.image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        ];
    }
}
