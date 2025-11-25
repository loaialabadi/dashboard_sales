@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ __('product.edit_product') }}</h4>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <!-- ========== Image ============ -->
                        <div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" 
                                            src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/vertical-banners-sales-promo.jpg') }}" 
                                            alt="profile-pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('product_image') is-invalid @enderror" 
                                        id="image" name="product_image" accept="image/*" onchange="previewImage();">
                                    <label class="custom-file-label" for="product_image">{{ __('product.choose_file') }}</label>
                                </div>
                                @error('product_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- ========== Data ============ -->
                        <div class="row align-items-center">

                            {{-- English Name --}}
                            <div class="form-group col-md-6">
                                <label for="product_name">{{ __('product.product_name_en') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                    id="product_name" name="product_name"
                                    value="{{ old('product_name', $product->product_name) }}" required>
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Arabic Name --}}
                            <div class="form-group col-md-6">
                                <label for="product_name_ar">{{ __('product.product_name_ar') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product_name_ar') is-invalid @enderror"
                                    id="product_name_ar" name="product_name_ar"
                                    value="{{ old('product_name_ar', $product->product_name_ar) }}">
                                @error('product_name_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="form-group col-md-6">
                                <label for="category_id">{{ __('product.category') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" required>
                                    <option selected disabled>{{ __('product.select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Supplier --}}
                            <div class="form-group col-md-6">
                                <label for="supplier_id">{{ __('product.supplier') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="supplier_id" required>
                                    <option selected disabled>{{ __('product.select_supplier') }}</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" 
                                            {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- More --}}
                            <div class="form-group col-md-6">
                                <label for="product_garage">{{ __('product.product_garage') }}</label>
                                <input type="text" class="form-control" name="product_garage"
                                    value="{{ old('product_garage', $product->product_garage) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="product_store">{{ __('product.product_store') }}</label>
                                <input type="text" class="form-control" name="product_store"
                                    value="{{ old('product_store', $product->product_store) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="buying_date">{{ __('product.buying_date') }}</label>
                                <input id="buying_date" class="form-control" name="buying_date"
                                    value="{{ old('buying_date', $product->buying_date) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="expire_date">{{ __('product.expire_date') }}</label>
                                <input id="expire_date" class="form-control" name="expire_date"
                                    value="{{ old('expire_date', $product->expire_date) }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="buying_price">{{ __('product.buying_price') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="buying_price"
                                    value="{{ old('buying_price', $product->buying_price) }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="selling_price">{{ __('product.selling_price') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="selling_price"
                                    value="{{ old('selling_price', $product->selling_price) }}" required>
                            </div>

                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('product.save') }}</button>
                            <a class="btn bg-danger" href="{{ route('products.index') }}">{{ __('product.cancel') }}</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#buying_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
    $('#expire_date').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
</script>

@include('components.preview-img-form')
@endsection
