<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .form-control,
        .form-select {
            border: 1px solid #bdbdbd;
            color: #909090;
            outline: none;
            height: 50px;
            padding: 12px 20px;
            border-radius: 4px;
        }

        .event {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 150px;
            bottom: 3px;
            left: calc(50% - 1.5px);
            content: " ";
            display: block;
            background: #9f19f8;
        }

        .event.busy {
            background: #f64747;
        }

        .highlighted-date {
            background-color: yellow;
        }

        p {
            color: #9f19f8;
            font-weight: 600;
            line-height: 25.6px;
        }

        .flatpickr-calendar .flatpickr-innerContainer .flatpickr-rContainer .flatpickr-days .dayContainer .flatpickr-day.selected {
            background: #9f19f8;
            border-color: #9f19f8;
            color: #fff;
        }

        .flatpickr-calendar .flatpickr-innerContainer .flatpickr-rContainer .flatpickr-days .dayContainer .flatpickr-day.today {
            background-color: #eed4ff;
            border-color: #eed4ff;
            color: #9313e7;
        }

        /* Let's make sure all tables have defaults */
        table td {
            vertical-align: top;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */
        body {
            background-color: #f6f6f6;
        }

        .body-wrap {
            background-color: #f6f6f6;
            width: 100%;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            display: block;
            padding: 20px;
        }

        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #fff;
            border: 1px solid #e9e9e9;
            border-radius: 3px;
        }

        .content-wrap {
            padding: 20px;
        }

        .content-block {
            padding: 0 0 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .footer {
            width: 100%;
            clear: both;
            color: #999;
            padding: 20px;
        }

        .footer a {
            color: #999;
        }

        .footer p,
        .footer a,
        .footer unsubscribe,
        .footer td {
            font-size: 12px;
        }

        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */


        p,
        ul,
        ol {
            margin-bottom: 10px;
            font-weight: normal;
        }

        p li,
        ul li,
        ol li {
            margin-left: 5px;
            list-style-position: inside;
        }

        /* -------------------------------------
            LINKS & BUTTONS
        ------------------------------------- */


        .btn-primary {
            text-decoration: none;
            color: #FFF;
            background-color: #1ab394;
            border: solid #1ab394;
            border-width: 5px 10px;
            line-height: 2;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
        }

        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .aligncenter {
            text-align: center;
        }

        .alignright {
            text-align: right;
        }

        .alignleft {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        /* -------------------------------------
            ALERTS
            Change the class depending on warning email, good email or bad email
        ------------------------------------- */
        .alert {
            font-size: 16px;
            color: #fff;
            font-weight: 500;
            padding: 20px;
            text-align: center;
            border-radius: 3px 3px 0 0;
        }

        .alert a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
        }

        .alert.alert-warning {
            background: #f8ac59;
        }

        .alert.alert-bad {
            background: #ed5565;
        }

        .alert.alert-good {
            background: #1ab394;
        }

        /* -------------------------------------
            INVOICE
            Styles for the billing table
        ------------------------------------- */
        .invoice {
            margin: 40px auto;
            text-align: left;
            width: 80%;
        }

        .invoice td {
            padding: 5px 0;
        }

        .invoice .invoice-items {
            width: 100%;
        }

        .invoice .invoice-items td {
            border-top: #eee 1px solid;
        }

        .invoice .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: 700;
        }

        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 640px) {

            h1,
            h2,
            h3,
            h4 {
                font-weight: 600 !important;
                margin: 20px 0 5px !important;
            }

            h1 {
                font-size: 22px !important;
            }

            h2 {
                font-size: 18px !important;
            }

            h3 {
                font-size: 16px !important;
            }

            .container {
                width: 100% !important;
            }

            .content,
            .content-wrap {
                padding: 10px !important;
            }

            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        {{-- <h2>You have successfully purchased this item</h2> --}}

        <table class="body-wrap">
            <tbody>
                <tr>
                    <td></td>
                    <td class="container" width="600">
                        <div class="content">
                            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="content-wrap aligncenter">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="content-block">
                                                            <h2>You have successfully purchased this course</h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block">
                                                            <table class="invoice">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{ $user->full_name }}<br>#
                                                                            {{ $order->order_number }}<br>{{ $order->created_at->format('m/d/Y') }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <table class="invoice-items" cellpadding="0"
                                                                                cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>{{ $course->name }}</td>
                                                                                        <td class="alignright">$
                                                                                            {{ number_format($order->grand_total, 2) }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr class="total">
                                                                                        <td class="alignright"
                                                                                            width="80%">Total
                                                                                        </td>
                                                                                        <td class="alignright">$
                                                                                            {{ number_format($order->grand_total, 2) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
