@extends('dashboard.body.main')

@section('container')
<div class="container-fluid" style="{{ app()->getLocale() == 'ar' ? 'direction: rtl; text-align: right;' : '' }}">
    <div class="row">
        <div class="col-lg-12">

            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif

            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">{{ __('orders.completed_orders') }}</h4>
                </div>
                <div>
                    <a href="{{ route('order.pendingOrders') }}" class="btn btn-danger add-list">
                        <i class="fa-solid fa-trash ml-2"></i> {{ __('orders.clear_search') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- نموذج البحث --}}
        <div class="col-lg-12">
            <form action="{{ route('order.completeOrders') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">

                    <div class="form-group row" style="margin-left: 0;">
                        <label for="row" class="col-sm-3 align-self-center">{{ __('orders.rows') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-left: 0;">
                        <label class="control-label col-sm-3 align-self-center" for="search">{{ __('orders.search') }}</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="{{ __('orders.search_placeholder') }}" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary">
                                        <i class="fa-solid fa-magnifying-glass font-size-20"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        {{-- جدول الطلبات --}}
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0 {{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>م</th>
                            <th>{{ __('orders.invoice_no') }}</th>
                            <th>@sortablelink('customer.name', __('orders.customer_name'))</th>
                            <th>@sortablelink('order_date', __('orders.order_date'))</th>
                            <th>@sortablelink('pay', __('orders.paid'))</th>
                            <th>{{ __('orders.payment_status') }}</th>
                            <th>{{ __('orders.order_status') }}</th>
                            <th>{{ __('orders.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ (($orders->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                            <td>{{ $order->invoice_no }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->pay }}</td>
                            <td>{{ $order->payment_status == 'Paid' ? __('orders.paid_text') : __('orders.unpaid_text') }}</td>
                            <td>
                                <span class="badge badge-success">{{ $order->order_status == 'complete' ? __('orders.complete_text') : $order->order_status }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-info ml-2" data-toggle="tooltip" data-placement="top" title="{{ __('orders.details') }}" href="{{ route('order.orderDetails', $order->id) }}">
                                        {{ __('orders.details') }}
                                    </a>
                                    <a class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="{{ __('orders.print') }}" href="{{ route('order.invoiceDownload', $order->id) }}">
                                        {{ __('orders.print') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
