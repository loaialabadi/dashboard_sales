<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <title>{{ __('invoice.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">

    @if(app()->getLocale() == 'ar')
        <style>
            body {
                direction: rtl;
                text-align: right;
                font-family: 'Tajawal', sans-serif;
            }
            .text-end {
                text-align: left !important;
            }
        </style>
    @endif
</head>
<body>
    <div class="invoice-16 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner-9" id="invoice_wrapper">
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="logo">
                                        <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 text-end">
                                    <div class="invoice">
                                        <h1>#<span>{{ $order->invoice_no }}</span></h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-sm-6 mb-50">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">{{ __('invoice.invoice_date') }}</h4>
                                        <p class="invo-addr-1">{{ $order->order_date }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-end mb-50">
                                    <h4 class="inv-title-1">{{ __('invoice.company_name') }}</h4>
                                    <p class="inv-from-1">{{ __('invoice.company_email') }}</p>
                                    <p class="inv-from-2">{{ __('invoice.company_address') }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-50">
                                    <h4 class="inv-title-1">{{ __('invoice.customer') }}</h4>
                                    <p class="inv-from-1">{{ $order->customer->name }}</p>
                                    <p class="inv-from-1">{{ $order->customer->email }}</p>
                                    <p class="inv-from-1">{{ $order->customer->phone }}</p>
                                    <p class="inv-from-2">{{ $order->customer->address }}</p>
                                </div>
                                <div class="col-sm-6 text-end mb-50">
                                    <h4 class="inv-title-1">{{ __('invoice.details') }}</h4>
                                    <p class="inv-from-1">{{ __('invoice.payment_status') }}: {{ $order->payment_status }}</p>
                                    <p class="inv-from-1">{{ __('invoice.total_pay') }}: ${{ $order->pay }}</p>
                                    <p class="inv-from-1">{{ __('invoice.due') }}: ${{ $order->due }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary">
                            <div class="table-outer">
                                <table class="default-table invoice-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('invoice.description') }}</th>
                                            <th>{{ __('invoice.price') }}</th>
                                            <th>{{ __('invoice.quantity') }}</th>
                                            <th>{{ __('invoice.total_vat') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orderDetails as $item)
                                            <tr>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>${{ $item->unitcost }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong class="text-danger">{{ __('invoice.total') }}</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong class="text-danger">${{ $order->total }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-print">
                                {{ __('invoice.print_invoice') }}
                            </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-download">
                                {{ __('invoice.download_invoice') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/invoice/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/html2canvas.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/app.js') }}"></script>
</body>
</html>
