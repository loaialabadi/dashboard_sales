@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تعديل فرع</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">اسم الفرع <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $branch->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $branch->address) }}" class="form-control @error('address') is-invalid @enderror">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">الهاتف</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $branch->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">تحديث</button>
                            <a href="{{ route('branches.index') }}" class="btn btn-secondary">رجوع</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
