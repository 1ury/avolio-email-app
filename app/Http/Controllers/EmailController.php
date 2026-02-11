<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{     
    /**
     * Register personal information and send email, then log the email in the database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $emails = EmailLog::with('user')
            ->orderByDesc('sent_at')
            ->get();

        return view('emails.index', compact('emails'));
    }
    /**
     * Store a newly created email log in storage and send the email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:20',
            'content' => 'required|string',
        ]);

        $user = User::create([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        Mail::raw($data['content'], function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Message from Avolio Squad App');
        });

        EmailLog::create([
            'user_id' => $user->id,
            'content' => $data['content'],
            'sent_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
