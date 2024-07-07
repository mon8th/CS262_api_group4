<!DOCTYPE html>
<html>
<head>
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <p>You have received new messages from your website contact form.</p>
        @foreach($mail as $message)
            <p><strong>Name:</strong> {{ $message->name }}</p>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $message->message }}</p>
            <hr>
        @endforeach
    </div>
</body>
</html>
