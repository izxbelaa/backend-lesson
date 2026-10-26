<?php

namespace App\Http\Controllers;

use App\Actions\ApplyContactFilters;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(IndexRequest $request, ApplyContactFilters $applyContactFilters)
    {
        $contacts = Contact::query()->withCount('matters');

        $applyContactFilters->handle($contacts, $request->validated());

        return $contacts->get();
    }

    public function store(StoreRequest $request)
    {
        $contact = Contact::create($request->validated());

        return response()->json($contact, 201);
    }

    public function show(Contact $contact)
    {
        return $contact;
    }
}
