@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <h4 class="mb-4">تفاصيل التحويل</h4>
    <a href="{{ route('transfers.index') }}" class="btn btn-secondary mb-3">الرجوع لكل التحويلات</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>من فرع</th>
                    <td>{{ $transfer->from_branch?->name }}</td>
                </tr>
                <tr>
                    <th>إلى فرع</th>
                    <td>{{ $transfer->to_branch?->name }}</td>
                </tr>
                <tr>
                    <th>المنتج</th>
                    <td>{{ $transfer->product?->product_name }}</td>
                </tr>
                <tr>
                    <th>الكمية</th>
                    <td>{{ $transfer->quantity }}</td>
                </tr>
                <tr>
                    <th>تاريخ التحويل</th>
                    <td>{{ $transfer->transfer_date }}</td>
                </tr>
                <tr>
                    <th>الحالة</th>
                    <td>{{ $transfer->status }}</td>
                </tr>
                <tr>
                    <th>مسؤول العملية</th>
                    <td>{{ $transfer->creator?->name }}</td>
                </tr>
                <tr>
                    <th>ملاحظات</th>
                    <td>{{ $transfer->note }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
