@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <h4 class="mb-4">إنشاء تحويل جديد</h4>
    <a href="{{ route('transfers.index') }}" class="btn btn-secondary mb-3">الرجوع لكل التحويلات</a>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transfers.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="form-group col-md-6">
                        <label>من فرع</label>
                        <select name="from_branch" class="form-control" required>
                            <option selected disabled>اختر الفرع</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>إلى فرع</label>
                        <select name="to_branch" class="form-control" required>
                            <option selected disabled>اختر الفرع</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>المنتج</label>
                        <select name="product_id" class="form-control" required>
                            <option selected disabled>اختر المنتج</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>الكمية</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>تاريخ التحويل</label>
                        <input type="date" name="transfer_date" class="form-control" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label>ملاحظات</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-success mt-3">حفظ التحويل</button>
                <a href="{{ route('transfers.index') }}" class="btn btn-secondary mt-3">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
