<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\NewContactMail;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function newContact(ContactRequest $request)
    {

        $contact = new NewContactMail($request);
        $email = User::select('email')->where('id', 1)->get();
        Mail::to($email)->send($contact);
        $message = 'Messaggio inviato con successo! ';
        $isSubscribed = Newsletter::select('email')->where('email', $request->email)->get();
        if ($request->subscribe && !count($isSubscribed)) {
            $new_user = new Newsletter();
            $new_user->first_name = $request->first_name;
            $new_user->last_name = $request->last_name;
            $new_user->email = $request->email;
            $new_user->save();
            $message = 'Grazie per esserti sottoscritto alla newsletter, il messaggio è stato inviato con successo!';
        }
        return response()->json(['success' => true, 'message' => $message]);
    }
}
