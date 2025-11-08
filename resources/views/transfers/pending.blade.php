@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <h4 class="mb-3">التحويلات قيد الإرسال</h4>
    <a href="{{ route('transfers.index') }}" class="btn btn-secondary mb-3">الرجوع لكل التحويلات</a>

    <div class="table-responsive rounded mb-3">
        <table class="table mb-0 table-bordered">
            <thead class="bg-white text-uppercase">
                <tr>
                    <th>#</th>
                    <th>من فرع</th>
                    <th>إلى فرع</th>
                    <th>تاريخ التحويل</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{ (($transfers->currentPage() - 1) * $transfers->perPage()) + $loop->iteration }}</td>
                    <td>{{ $transfer->from_branch->name }}</td>
                    <td>{{ $transfer->to_branch->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($transfer->transfer_date)->format('Y-m-d') }}</td>
                    <td><span class="badge bg-warning text-dark">قيد الإرسال</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $transfers->links() }}
</div>
@endsection
