<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
public function create(): Response
{
    return Inertia::render('Contact');
}

public function store(ContactMessageRequest $request): RedirectResponse
{
    $contactMessage = ContactMessage::create($request->validated());

    Mail::to(config('mail.from.address'))->send(new ContactMessageReceived($contactMessage));

    Inertia::flash('toast', ['type' => 'success', 'message' => 'Merci, votre message est bien parti.']);

    return to_route('contact');
}

}
