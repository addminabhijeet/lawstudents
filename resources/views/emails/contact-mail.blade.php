<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Form Submission</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:20px;">

    <div style="max-width:600px; margin:auto; background:#fff; padding:20px; border-radius:8px;">

        <h2 style="color:#333;">New Contact Form Submission</h2>

        <table width="100%" cellpadding="8" cellspacing="0" style="font-size:14px; color:#555;">

            <tr>
                <td><strong>Name:</strong></td>
                <td>{{ isset($lines[0]) ? str_replace('Name: ', '', $lines[0]) : '' }}</td>
            </tr>

            <tr>
                <td><strong>Phone:</strong></td>
                <td>{{ isset($lines[1]) ? str_replace('Phone: ', '', $lines[1]) : '' }}</td>
            </tr>

            <tr>
                <td><strong>Email:</strong></td>
                <td>{{ isset($lines[2]) ? str_replace('Email: ', '', $lines[2]) : '' }}</td>
            </tr>

            <tr>
                <td><strong>Service:</strong></td>
                <td>{{ isset($lines[3]) ? str_replace('Service: ', '', $lines[3]) : '' }}</td>
            </tr>

            <tr>
                <td><strong>Message:</strong></td>
                <td>{{ isset($lines[4]) ? str_replace('Message: ', '', $lines[4]) : '' }}</td>
            </tr>

        </table>

    </div>

</body>

</html>