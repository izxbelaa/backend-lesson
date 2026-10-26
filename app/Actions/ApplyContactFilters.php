<?php

namespace App\Actions;

class ApplyContactFilters
{
    public function handle($query, array $filters): void
    {
        $query
            ->when(
                isset($filters['first_name']),
                fn ($query) => $query->where('first_name', $filters['first_name'])
            )
            ->when(
                isset($filters['last_name']),
                fn ($query) => $query->where('last_name', $filters['last_name'])
            )
            ->when(
                isset($filters['email']),
                fn ($query) => $query->where('email', $filters['email'])
            );
    }
}
