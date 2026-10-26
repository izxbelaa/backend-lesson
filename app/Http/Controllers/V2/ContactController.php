<?php

namespace App\Http\Controllers\V2;

use App\Actions\ApplyContactFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Attributes\Authorize;
use Illuminate\Http\Attributes\Middleware;

#[Middleware('auth:sanctum')]
class ContactController extends Controller
{
    #[Authorize('viewAny', Contact::class)]
    public function index(IndexRequest $request, ApplyContactFilters $applyContactFilters)
    {
        $contacts = Contact::query()->withCount('matters')->with('matters');

        $applyContactFilters->handle($contacts, $request->validated());

        return ContactResource::collection($contacts->paginate(10));
    }

    #[Authorize('create', Contact::class)]
    public function store(StoreRequest $request)
    {
        $contact = Contact::create($request->validated());

        return new ContactResource($contact);
    }

    #[Authorize('view', 'contact')]
    public function show(Contact $contact)
    {
        return new ContactResource($contact->loadCount('matters')->load('matters'));
    }
}
