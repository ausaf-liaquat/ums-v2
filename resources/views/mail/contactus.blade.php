<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us - {{ $type_contact }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">Contact Us - {{ $type_contact }}</h2>
        <p>Hello,</p>
        <p>You have received a new message from the Contact Us form on your website. Here are the details:</p>
        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Full Name:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $full_name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Email:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $email }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Phone:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $phone }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Message:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $message }}</td>
            </tr>
        </table>
        <p style="margin-top: 20px;">Thank you,</p>
        <p>Your Website Team</p>
    </div>
</body>
</html>
