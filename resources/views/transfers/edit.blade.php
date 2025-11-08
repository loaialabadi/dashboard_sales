@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <h4 class="mb-4">تعديل التحويل</h4>
    <a href="{{ route('transfers.index') }}" class="btn btn-secondary mb-3">الرجوع لكل التحويلات</a>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transfers.update', $transfer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="form-group col-md-6">
                        <label>من فرع</label>
                        <select name="from_branch" class="form-control" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $transfer->from_branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>إلى فرع</label>
                        <select name="to_branch" class="form-control" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $transfer->to_branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>المنتج</label>
                        <select name="product_id" class="form-control" required>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $transfer->product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>الكمية</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $transfer->quantity }}" min="1" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>تاريخ التحويل</label>
                        <input type="date" name="transfer_date" class="form-control" value="{{ $transfer->transfer_date }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label>الحالة</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $transfer->status == 'pending' ? 'selected' : '' }}>قيد الإرسال</option>
                            <option value="done" {{ $transfer->status == 'done' ? 'selected' : '' }}>تم الاستلام</option>
                            <option value="canceled" {{ $transfer->status == 'canceled' ? 'selected' : '' }}>ملغى</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>ملاحظات</label>
                        <textarea name="note" class="form-control">{{ $transfer->note }}</textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-success mt-3">تحديث التحويل</button>
                <a href="{{ route('transfers.index') }}" class="btn btn-secondary mt-3">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
