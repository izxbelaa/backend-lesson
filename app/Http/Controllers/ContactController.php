<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;

class ContactController extends Controller
{
    public function index(IndexRequest $request)
    {
        $query = Contact::query()->withCount('matters');

        $this->filters($query, $request->validated());

        return $query->get();
    }

    private function filters($query, array $filters): void
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
