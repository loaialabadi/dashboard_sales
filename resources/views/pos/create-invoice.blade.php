@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block">
                <div class="card-header d-flex justify-content-between bg-primary">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">{{ __('invoice.title') }}</h4>
                    </div>

                    <div class="invoice-btn d-flex">
                        <form action="{{ route('pos.printInvoice') }}" method="post">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <button type="submit" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> {{ __('invoice.print') }}</button>
                        </form>

                        <button type="button" class="btn btn-primary-dark mr-2" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __('invoice.create') }}</button>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-white">
                                        <h3 class="modal-title text-center mx-auto">{{ __('invoice.customer_invoice', ['name' => $customer->name, 'total' => Cart::total()]) }}</h3>
                                    </div>
                                    <form action="{{ route('pos.storeOrder') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="payment_status">{{ __('invoice.payment') }}</label>
                                                    <select class="form-control @error('payment_status') is-invalid @enderror" name="payment_status">
                                                        <option selected disabled>{{ __('invoice.select_payment') }}</option>
                                                        <option value="HandCash">{{ __('invoice.handcash') }}</option>
                                                        <option value="Cheque">{{ __('invoice.cheque') }}</option>
                                                        <option value="Due">{{ __('invoice.due') }}</option>
                                                    </select>
                                                    @error('payment_status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pay">{{ __('invoice.pay_now') }}</label>
                                                    <input type="text" class="form-control @error('pay') is-invalid @enderror" id="pay" name="pay" value="{{ old('pay') }}">
                                                    @error('pay')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('invoice.close') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ __('invoice.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Customer Info --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="{{ asset('assets/images/logo.png') }}" class="logo-invoice img-fluid mb-3">
                            <h5 class="mb-3">{{ __('invoice.greeting', ['name' => $customer->name]) }}</h5>
                        </div>
                    </div>

                    {{-- Customer Details --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('invoice.order_date') }}</th>
                                            <th scope="col">{{ __('invoice.order_status') }}</th>
                                            <th scope="col">{{ __('invoice.billing_address') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ Carbon\Carbon::now()->format('M d, Y') }}</td>
                                            <td><span class="badge badge-danger">{{ __('invoice.unpaid') }}</span></td>
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

                    {{-- Order Totals --}}
                    <div class="row mt-4 mb-3">
                        <div class="offset-lg-8 col-lg-4">
                            <div class="or-detail rounded">
                                <div class="p-3">
                                    <h5 class="mb-3">{{ __('invoice.order_details') }}</h5>
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
@endsection
