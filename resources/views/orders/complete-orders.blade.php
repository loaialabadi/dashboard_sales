@extends('dashboard.body.main')

@section('container')
<div class="container-fluid" style="direction: rtl; text-align: right;">
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
                    <h4 class="mb-3">قائمة الطلبات المكتملة</h4>
                </div>
                <div>
                    <a href="{{ route('order.pendingOrders') }}" class="btn btn-danger add-list">
                        <i class="fa-solid fa-trash ml-2"></i> مسح البحث
                    </a>
                </div>
            </div>
        </div>

        {{-- ✅ نموذج البحث --}}
        <div class="col-lg-12">
            <form action="{{ route('order.completeOrders') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">

                    <div class="form-group row" style="margin-left: 0;">
                        <label for="row" class="col-sm-3 align-self-center">عدد الصفوف:</label>
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
                        <label class="control-label col-sm-3 align-self-center" for="search">بحث:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="ابحث عن الطلب" value="{{ request('search') }}">
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

        {{-- ✅ جدول عرض الطلبات --}}
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0 text-right">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>م</th>
                            <th>رقم الفاتورة</th>
                            <th>@sortablelink('customer.name', 'اسم العميل')</th>
                            <th>@sortablelink('order_date', 'تاريخ الطلب')</th>
                            <th>@sortablelink('pay', 'المدفوع')</th>
                            <th>حالة الدفع</th>
                            <th>حالة الطلب</th>
                            <th>إجراءات</th>
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
                            <td>{{ $order->payment_status == 'Paid' ? 'مدفوع' : 'غير مدفوع' }}</td>
                            <td>
                                <span class="badge badge-success">{{ $order->order_status == 'complete' ? 'مكتمل' : $order->order_status }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-info ml-2" data-toggle="tooltip" data-placement="top" title="تفاصيل" href="{{ route('order.orderDetails', $order->id) }}">
                                        تفاصيل
                                    </a>
                                    <a class="btn btn-success ml-2" data-toggle="tooltip" data-placement="top" title="طباعة" href="{{ route('order.invoiceDownload', $order->id) }}">
                                        طباعة
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
