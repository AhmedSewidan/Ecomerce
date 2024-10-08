<!-- resources/views/test-sending-mail.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <div>    
        <strong>Hi {{ $data['username'] }}.... </strong><p>Your OTP is: <strong>{{ $data['otp'] }}</strong></p>
        <p>This OTP will expire at {{ $data['expireTime'] }}</p>
    </div>
</body>
</html>
