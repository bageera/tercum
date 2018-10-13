<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Jobs\PostContactJob;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $this->dispatch(new PostContactJob($request->only('name','email','message')));
        return redirect()->back()->with('flash_message', 'Message Received');
    }
}
