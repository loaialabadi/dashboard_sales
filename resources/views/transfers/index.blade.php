@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <h4 class="mb-4">كل التحويلات</h4>
    <a href="{{ route('transfers.create') }}" class="btn btn-primary mb-3">إنشاء تحويل جديد</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>من فرع</th>
                        <th>إلى فرع</th>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>تاريخ التحويل</th>
                        <th>الحالة</th>
                        <th>ملاحظة</th>
                    </tr>
                </thead>
                <tbody>
@foreach ($transfers as $transfer)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $transfer->from_branch?->name }}</td>
    <td>{{ $transfer->to_branch?->name }}</td>
    <td>{{ $transfer->product?->product_name }}</td>
    <td>{{ $transfer->quantity }}</td>
    <td>{{ $transfer->transfer_date }}</td>
    <td>
        @if($transfer->status == 'pending')
            <span class="badge bg-warning text-dark">قيد الإرسال</span>
        @elseif($transfer->status == 'done')
            <span class="badge bg-success">تم الاستلام</span>
        @elseif($transfer->status == 'canceled')
            <span class="badge bg-danger">ملغى</span>
        @endif
    </td>
    <td>
        @if($transfer->status == 'pending')
            <form action="{{ route('transfers.accept', $transfer->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">قبول</button>
            </form>
            <form action="{{ route('transfers.cancel', $transfer->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">رفض</button>
            </form>
        @endif
    </td>
</tr>
@endforeach

                </tbody>
            </table>

            {{ $transfers->links() }}
        </div>
    </div>
</div>
@endsection
