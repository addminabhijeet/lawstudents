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
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        .container {
            width: 600px;
            max-width: 100%;
            background-color: #ffffff;
        }

        .content {
            padding: 40px;
        }

        .label {
            font-weight: bold;
            color: #333333;
            width: 160px;
            font-size: 16px;
        }

        .value {
            color: #555555;
            font-size: 16px;
        }

        .row-alt {
            background-color: #f9f9f9;
        }

        .footer {
            background-color: #F4F4F4;
            padding: 30px;
            font-size: 14px;
            color: #888888;
            line-height: 22px;
        }

        .heading {
            font-size: 24px;
        }

        .intro {
            font-size: 17px;
        }

        .logo {
            width: 250px;
            max-width: 100%;
            height: auto;
        }

        .btn {
            background: #1473E6;
            color: #ffffff;
            padding: 14px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a1a1a !important;
            }

            .container {
                background-color: #2a2a2a !important;
            }

            .label {
                color: #ffffff !important;
            }

            .value {
                color: #dddddd !important;
            }

            .row-alt {
                background-color: #333333 !important;
            }

            .footer {
                background-color: #1f1f1f !important;
                color: #bbbbbb !important;
            }
        }

        /* Mobile Optimization */
        @media only screen and (max-width:480px) {

            .content {
                padding: 20px !important;
            }

            .heading {
                font-size: 22px !important;
            }

            .intro {
                font-size: 16px !important;
            }

            .label,
            .value {
                font-size: 15px !important;
                display: block;
                width: 100% !important;
            }

            .logo {
                width: 180px !important;
            }

            .btn {
                font-size: 15px !important;
                padding: 12px 25px !important;
            }
        }
    </style>
</head>

<body>

    <!-- Preheader -->
    <div style="display:none; max-height:0; overflow:hidden; font-size:1px; color:#E4E4E4;">
        New contact form submission received from your website.
    </div>

    <table width="100%" bgcolor="#E4E4E4">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table class="container" style="border-top:4px solid #FA0F00;">

                    <!-- Logo -->
                    <tr>
                        <td class="content" style="padding-bottom:10px;">
                            <img src="https://law.norloxsolutionscrm.com/assets/images/logo-full.png"
                                class="logo" alt="Logo">
                        </td>
                    </tr>

                    <!-- Heading -->
                    <tr>
                        <td class="content" style="padding-top:10px;">
                            <h2 class="heading" style="margin:0; color:#333;">
                                New Contact Form Submission
                            </h2>
                        </td>
                    </tr>

                    <!-- Intro -->
                    <tr>
                        <td class="content intro" style="padding-top:0; color:#555; line-height:26px;">
                            Hello Admin,<br><br>
                            You’ve received a new enquiry from your website. Details are below:
                        </td>
                    </tr>

                    <!-- Data Table -->
                    <tr>
                        <td class="content" style="padding-top:0;">
                            <table width="100%" cellpadding="12">

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

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding-bottom:40px;">

                            <!--[if mso]>
                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                href="mailto:{{ isset($lines[2]) ? str_replace('Email: ', '', $lines[2]) : '' }}"
                                style="height:45px;v-text-anchor:middle;width:240px;" arcsize="50%"
                                strokecolor="#1473E6" fillcolor="#1473E6">
                                <w:anchorlock/>
                                <center style="color:#ffffff;font-size:16px;font-weight:bold;">
                                    Reply to Customer
                                </center>
                            </v:roundrect>
                            <![endif]-->

                            <!--[if !mso]><!-- -->
                            <a href="mailto:{{ isset($lines[2]) ? str_replace('Email: ', '', $lines[2]) : '' }}"
                                class="btn">
                                Reply to Customer
                            </a>
                            <!--<![endif]-->

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            This email was generated automatically from your website contact form.<br><br>

                            Please review and respond to the customer promptly.<br><br>

                            © {{ date('Y') }} Law Students. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>