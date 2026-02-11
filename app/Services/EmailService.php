<?php

namespace App\Services;

use App\Models\User;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EmailService
{
    public function sendAndLog(array $data): void
    {
        DB::transaction(function () use ($data) {
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
        });
    }
}
