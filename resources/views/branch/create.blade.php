@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">إضافة فرع</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('branches.store') }}" method="POST">
                        @csrf

                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="name">اسم الفرع <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">الهاتف</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="address">العنوان</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address') }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                            <a class="btn bg-danger" href="{{ route('branches.index') }}">إلغاء</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection