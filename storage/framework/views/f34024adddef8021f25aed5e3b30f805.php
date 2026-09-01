<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>

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

        /* 🔥 MOBILE EDGE-TO-EDGE (NO OUTER PADDING ANYWHERE) */
        @media only screen and (max-width:480px) {

            body {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            html {
                margin: 0 !important;
                padding: 0 !important;
            }

            /* ✅ REMOVE ALL OUTER SPACING (TOP, BOTTOM, LEFT, RIGHT) */
            table[width="100%"],
            body,
            table,
            tr,
            td {
                margin: 0 !important;
                padding: 0 !important;
            }

            td[align="center"] {
                padding: 0 !important;
            }

            /* ✅ FULL WIDTH FLAT CARD */
            .container {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                background-color: #ffffff !important;
            }

            /* INNER SPACING ONLY */
            .content {
                padding: 20px !important;
            }

            .heading {
                font-size: 34px !important;
                line-height: 42px !important;
                font-weight: 800 !important;
            }

            .intro {
                font-size: 20px !important;
                line-height: 30px !important;
            }

            td {
                display: block !important;
                width: 100% !important;
            }

            tr {
                display: block !important;
                margin: 0 !important;
            }

            .row-alt,
            tr:not(.row-alt) {
                background: transparent !important;
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

            .logo {
                width: 92% !important;
                max-width: 320px !important;
                margin: 0 auto !important;
                display: block;
            }

            .btn {
                display: inline-block !important;
                width: auto !important;
                max-width: 260px !important;
                font-size: 16px !important;
                padding: 10px 18px !important;
                text-align: center !important;
                border-radius: 25px !important;
                margin: 10px auto !important;
            }

            .footer {
                font-size: 16px !important;
                line-height: 26px !important;
                padding: 20px !important;
                background: #ffffff !important;
            }
        }
    </style>
</head>

<body>

    <div style="display:none; max-height:0; overflow:hidden; font-size:1px; color:#E4E4E4;">
        Laws Students Payment Details
    </div>

    <table width="100%" bgcolor="#E4E4E4">
        <tr>
            <td align="center" style="padding:20px;">

                <table class="container" style="border-top:4px solid #FA0F00;">

                    <!-- LOGO -->
                    <tr>
                        <td class="content" style="padding-bottom:10px;">
                            <img src="https://law.norloxsolutionscrm.com/assets/images/logo-full.png"
                                class="logo" alt="Logo">
                        </td>
                    </tr>

                    <!-- HEADING -->
                    <tr>
                        <td class="content" style="padding-top:10px;">
                            <h2 class="heading" style="margin:0; color:#222;">
                                Invoice: <?php echo e($payment->invoice_number); ?>

                            </h2>
                        </td>
                    </tr>

                    <!-- INTRO -->
                    <tr>
                        <td class="content intro" style="padding-top:0; color:#555;">
                            Hello <?php echo e($payment->student->name); ?>,<br><br>
                            Here are your payment details:
                        </td>
                    </tr>

                    <!-- DETAILS TABLE -->
                    <tr>
                        <td class="content" style="padding-top:0;">
                            <table width="100%" cellpadding="14">

                                <tr class="row-alt">
                                    <td class="label">Student Name</td>
                                    <td class="value"><?php echo e($payment->student->name); ?></td>
                                </tr>

                                <tr>
                                    <td class="label">Email</td>
                                    <td class="value"><?php echo e($payment->student->email); ?></td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Issue Date</td>
                                    <td class="value"><?php echo e($payment->issue_date); ?></td>
                                </tr>

                                <tr>
                                    <td class="label">Due Date</td>
                                    <td class="value"><?php echo e($payment->due_date); ?></td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Sub Total</td>
                                    <td class="value"><?php echo e($payment->sub_total); ?></td>
                                </tr>

                                <tr>
                                    <td class="label">Tax</td>
                                    <td class="value"><?php echo e($payment->tax_amount); ?></td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Discount</td>
                                    <td class="value"><?php echo e($payment->discount); ?></td>
                                </tr>

                                <tr>
                                    <td class="label">Grand Total</td>
                                    <td class="value"><?php echo e($payment->grand_total); ?></td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Paid Amount</td>
                                    <td class="value"><?php echo e($payment->paid_amount); ?></td>
                                </tr>

                                <tr>
                                    <td class="label">Remaining</td>
                                    <td class="value"><?php echo e($payment->remaining_amount); ?></td>
                                </tr>

                                <tr class="row-alt">
                                    <td class="label">Status</td>
                                    <td class="value"><?php echo e(ucfirst($payment->payment_status)); ?></td>
                                </tr>

                                <tr>
                                    <td class="label">Note</td>
                                    <td class="value"><?php echo e($payment->invoice_note); ?></td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    <tr>
                        <td align="center" style="padding-bottom:40px;">
                            <a href="mailto:<?php echo e($payment->student->email); ?>"
                                class="btn"
                                style="color:#ffffff !important; text-decoration:none;">
                                Contact Support
                            </a>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td class="footer">
                            This email was generated automatically from your payment system.<br><br>
                            Please review your invoice and complete the payment if pending.<br><br>
                            © <?php echo e(date('Y')); ?> Law Students. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/emails/payment-mail.blade.php ENDPATH**/ ?>