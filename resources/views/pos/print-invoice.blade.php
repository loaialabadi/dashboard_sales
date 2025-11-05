<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ __('invoice.title') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backend.css?v=1.0.0') }}">
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
</head>
<body>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block">
                    <div class="card-header d-flex justify-content-between bg-primary">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">{{ __('invoice.invoice_no', ['id' => $invoice_number ?? '1234567']) }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Customer Greeting --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="{{ asset('assets/images/logo.png') }}" class="logo-invoice img-fluid mb-3">
                                <h5 class="mb-3">{{ __('invoice.greeting', ['name' => $customer->name]) }}</h5>
                            </div>
                        </div>

                        {{-- Customer Details Table --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('invoice.order_date') }}</th>
                                                <th>{{ __('invoice.order_status') }}</th>
                                                <th>{{ __('invoice.invoice_no_column') }}</th>
                                                <th>{{ __('invoice.billing_address') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ now()->format('M d, Y') }}</td>
                                                <td><span class="badge badge-danger">{{ __('invoice.unpaid') }}</span></td>
                                                <td>{{ $invoice_number ?? '250028' }}</td>
                                                <td>
                                                    <p class="mb-0">
                                                        {{ $customer->address }}<br>
                                                        {{ __('invoice.shop_name') }}: {{ $customer->shopname ?? '-' }}<br>
                                                        {{ __('invoice.phone') }}: {{ $customer->phone }}<br>
                                                        {{ __('invoice.email') }}: {{ $customer->email }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Order Summary --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="mb-3">{{ __('invoice.order_summary') }}</h5>
                                <div class="table-responsive-lg">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>{{ __('invoice.item') }}</th>
                                                <th class="text-center">{{ __('invoice.quantity') }}</th>
                                                <th class="text-center">{{ __('invoice.price') }}</th>
                                                <th class="text-center">{{ __('invoice.totals') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($content as $item)
                                            <tr>
                                                <th class="text-center">{{ $loop->iteration }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-center">{{ $item->price }}</td>
                                                <td class="text-center"><b>{{ $item->subtotal }}</b></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <b class="text-danger">{{ __('invoice.notes') }}:</b>
                                <p class="mb-0">{{ __('invoice.notes_text') }}</p>
                            </div>
                        </div>

                        {{-- Totals --}}
                        <div class="row mt-4 mb-3">
                            <div class="offset-lg-8 col-lg-4">
                                <div class="or-detail rounded">
                                    <div class="p-3">
                                        <h5 class="mb-3">{{ __('invoice.order_details') }}</h5>
                                        <div class="mb-2">
                                            <h6>{{ __('invoice.bank') }}</h6>
                                            <p>{{ $customer->bank_name }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>{{ __('invoice.account_number') }}</h6>
                                            <p>{{ $customer->account_number }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>{{ __('invoice.due_date') }}</h6>
                                            <p>{{ $due_date ?? '12 August 2020' }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>{{ __('invoice.sub_total') }}</h6>
                                            <p>${{ Cart::subtotal() }}</p>
                                        </div>
                                        <div>
                                            <h6>{{ __('invoice.vat', ['rate' => '5%']) }}</h6>
                                            <p>${{ Cart::tax() }}</p>
                                        </div>
                                    </div>
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6>{{ __('invoice.total') }}</h6>
                                        <h3 class="text-primary font-weight-700">${{ Cart::total() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
window.addEventListener("load", (event) => {
    window.print();
});
</script>

</body>
</html>
