<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Pending Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            background-color: #fff;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #4CAF50;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .order-code {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">    
        <h3>Hello, {{ $data['username'] }}!</h3>
        <p>Your order is currently <strong>pending</strong>. Please find your order code below:</p>
        <p>Your order code is: <span class="order-code">{{ $data['order_code'] }}</span></p>
        <p>Thank you for shopping with us. We appreciate your business!</p>
    </div>

    <div class="footer">
        <p>&copy; All rights reserved.</p>
    </div>
</body>
</html>
