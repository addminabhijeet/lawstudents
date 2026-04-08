<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>

    <meta name="x-apple-disable-message-reformatting">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #E4E4E4;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        .container {
            width: 600px;
            max-width: 100%;
            background-color: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .content {
            padding: 40px;
        }

        .label {
            font-weight: 600;
            color: #222;
            width: 160px;
            font-size: 18px;
        }

        .value {
            color: #444;
            font-size: 18px;
        }

        .row-alt {
            background-color: #f8f9fb;
        }

        .footer {
            background-color: #F4F4F4;
            padding: 30px;
            font-size: 15px;
            color: #777;
            line-height: 24px;
        }

        .heading {
            font-size: 28px;
            font-weight: 700;
        }

        .intro {
            font-size: 18px;
            line-height: 28px;
        }

        .logo {
            width: 260px;
            max-width: 100%;
            height: auto;
        }

        .btn {
            background: #1473E6;
            color: #ffffff;
            padding: 16px 34px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            font-weight: 600;
        }

        /* 🔥 MOBILE FIX (EDGE TO EDGE LIKE GMAIL PROMOTIONS) */
        @media only screen and (max-width:480px) {

            body {
                background: #E4E4E4 !important;
            }

            /* ✅ REMOVE SIDE GAP COMPLETELY */
            td[align="center"] {
                padding: 0 !important;
            }

            table[width="100%"] {
                margin: 0 !important;
                padding: 0 !important;
            }

            /* ✅ FULL WIDTH CARD */
            .container {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }

            .content {
                padding: 20px !important;
            }

            /* 🔥 BIG SUBJECT STYLE */
            .heading {
                font-size: 34px !important;
                line-height: 42px !important;
                font-weight: 800 !important;
            }

            .intro {
                font-size: 20px !important;
                line-height: 30px !important;
            }

            /* 🔥 STACK */
            td {
                display: block !important;
                width: 100% !important;
            }

            tr {
                display: block !important;
                margin-bottom: 12px;
            }

            /* 🔥 CLEAN ROW STYLE */
            .row-alt,
            tr:not(.row-alt) {
                background: #ffffff !important;
            }

            .label {
                font-size: 20px !important;
                margin-bottom: 4px;
            }

            .value {
                font-size: 22px !important;
                margin-bottom: 10px;
                font-weight: 500;
            }

            /* ✅ BIGGER LOGO (LIKE PROMOTIONS HEADER) */
            .logo {
                width: 92% !important;
                max-width: 320px !important;
                margin: 0 auto !important;
                display: block;
            }

            /* 🔥 FULL WIDTH BUTTON */
            .btn {
                font-size: 20px !important;
                padding: 18px !important;
                width: 100% !important;
                text-align: center;
                border-radius: 0 !important;
            }

            .footer {
                font-size: 16px !important;
                line-height: 26px !important;
                padding: 20px !important;
            }
        }
    </style>
</head>

<body>

    <div style="display:none; max-height:0; overflow:hidden; font-size:1px; color:#E4E4E4;">
        New contact form submission received from your website.
    </div>

    <table width="100%" bgcolor="#E4E4E4">
        <tr>
            <td align="center" style="padding:20px;">

                <table class="container" style="border-top:4px solid #FA0F00;">

                    <tr>
                        <td class="content" style="padding-bottom:10px;">
                            <img src="https://law.norloxsolutionscrm.com/assets/images/logo-full.png"
                                class="logo" alt="Logo">
                        </td>
                    </tr>

                    <tr>
                        <td class="content" style="padding-top:10px;">
                            <h2 class="heading" style="margin:0; color:#222;">
                                New Contact Form Submission
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td class="content intro" style="padding-top:0; color:#555;">
                            Hello Admin,<br><br>
                            You’ve received a new enquiry from your website. Details are below:
                        </td>
                    </tr>

                    <tr>
                        <td class="content" style="padding-top:0;">
                            <table width="100%" cellpadding="14">

                                <tr class="row-alt">
                                    <td class="label">Name</td>
                                    <td class="value">
                                        {{ isset($lines[0]) ? str_replace('Name: ', '', $lines[0]) : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label">Phone</td>
                                    <td class="value">
                                        {{ isset($lines[1]) ? str_replace('Phone: ', '', $lines[1]) : '' }}
                                    </td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Email</td>
                                    <td class="value">
                                        {{ isset($lines[2]) ? str_replace('Email: ', '', $lines[2]) : '' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label">Service</td>
                                    <td class="value">
                                        {{ isset($lines[3]) ? str_replace('Service: ', '', $lines[3]) : '' }}
                                    </td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Message</td>
                                    <td class="value">
                                        {{ isset($lines[4]) ? str_replace('Message: ', '', $lines[4]) : '' }}
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-bottom:40px;">
                            <a href="mailto:{{ isset($lines[2]) ? str_replace('Email: ', '', $lines[2]) : '' }}"
                                class="btn">
                                Reply to Customer
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td class="footer">
                            This email was generated automatically from your website contact form.<br><br>
                            Please review and respond promptly.<br><br>
                            © {{ date('Y') }} Law Students. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>