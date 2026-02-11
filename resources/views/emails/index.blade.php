<!DOCTYPE html>
<html>
<head>
    <title>Email App</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px 20px; }
        ul { margin-top: 30px; }
        li { margin-bottom: 15px; }
    </style>
</head>
    <body>

        <h1>Send Email</h1>

        @if(session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('email.send') }}">
            @csrf

            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone">
            <textarea name="content" placeholder="Email content" required></textarea>

            <button type="submit">Send</button>
        </form>

        <h2>Sent Emails</h2>

        <ul>
        @foreach($emails as $email)
            <li>
                <strong>{{ $email->user->name }}</strong>
                ({{ $email->user->email }})<br>
                {{ Str::limit($email->content, 50) }}<br>
                <small>{{ $email->sent_at }}</small>
            </li>
        @endforeach
        </ul>

    </body>
</html>
