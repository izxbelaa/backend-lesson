<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreRequest;

class ContactController extends Controller
{
    public function index(IndexRequest $request)
    {
        $contacts = Contact::query()->withCount('matters');

        $this->filters($contacts, $request->validated());

        return $contacts->get();
    }

    public function store(StoreRequest $request)
    {
        $contact = Contact::create($request->validated());

        return response()->json($contact, 201);
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
