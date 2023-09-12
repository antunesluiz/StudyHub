<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait UsernameSuggestionTrait
{
    public function generateUsernameSuggestions(array $fields, string $table, string $column = 'username')
    {
        $baseSuggestions = [];

        if (isset($fields['name']) && isset($fields['submittedUsername'])) {
            $baseSuggestions[] = Str::slug($fields['name']);
            $baseSuggestions[] = $fields['submittedUsername'] . '123';
        }

        if (isset($fields['birthdate']) && isset($fields['name'])) {
            $baseSuggestions[] = Str::slug($fields['name'] . $fields['birthdate']);
        }

        if (isset($fields['submittedUsername'])) {
            $baseSuggestions[] = Str::slug($fields['submittedUsername'] . Str::random(3));
            $baseSuggestions[] = Str::slug($fields['submittedUsername'] . '_laravel');
        }

        // Remove null values from the suggestions list
        $baseSuggestions = array_filter($baseSuggestions);

        // Check if the suggestions are unique
        return $this->filterUniqueUsernames($baseSuggestions, $table, $column);
    }

    public function filterUniqueUsernames(array $suggestions, string $table, string $column = 'username')
    {
        return array_filter($suggestions, function ($suggestion) use ($table, $column) {
            return !DB::table($table)->where($column, $suggestion)->exists();
        });
    }
}
