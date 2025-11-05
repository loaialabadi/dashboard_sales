@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ __('supplier.title') }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Image -->
                        <div class="form-group row align-items-center">
                            <div class="col-md-12 text-center">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" 
                                             src="{{ old('photo') ? asset('storage/' . old('photo')) : asset('assets/images/user/1.png') }}" 
                                             alt="profile-pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="input-group col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" 
                                           id="photo" name="photo" accept="image/*" onchange="previewImage();">
                                    <label class="custom-file-label" for="photo">{{ __('supplier.photo') }}</label>
                                </div>
                                @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Input Data -->
                        <div class="row align-items-center">

                            <div class="form-group col-md-6">
                                <label for="name">{{ __('supplier.name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="shopname">{{ __('supplier.shopname') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('shopname') is-invalid @enderror" 
                                       id="shopname" name="shopname" value="{{ old('shopname') }}" required>
                                @error('shopname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">{{ __('supplier.email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">{{ __('supplier.phone') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="account_holder">{{ __('supplier.account_holder') }}</label>
                                <input type="text" class="form-control @error('account_holder') is-invalid @enderror" 
                                       id="account_holder" name="account_holder" value="{{ old('account_holder') }}">
                                @error('account_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bank_name">{{ __('supplier.bank_name') }}</label>
                                <select class="form-control @error('bank_name') is-invalid @enderror" name="bank_name">
                                    <option value="">{{ __('supplier.bank_select') }}</option>
                                    <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                    <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                    <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                    <option value="BSI" {{ old('bank_name') == 'BSI' ? 'selected' : '' }}>BSI</option>
                                    <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                </select>
                                @error('bank_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="account_number">{{ __('supplier.account_number') }}</label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" 
                                       id="account_number" name="account_number" value="{{ old('account_number') }}">
                                @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="bank_branch">{{ __('supplier.bank_branch') }}</label>
                                <input type="text" class="form-control @error('bank_branch') is-invalid @enderror" 
                                       id="bank_branch" name="bank_branch" value="{{ old('bank_branch') }}">
                                @error('bank_branch')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="city">{{ __('supplier.city') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="type">{{ __('supplier.type') }} <span class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type" required>
                                    <option value="">{{ __('supplier.type_select') }}</option>
                                    <option value="Distributor" {{ old('type') == 'Distributor' ? 'selected' : '' }}>Distributor</option>
                                    <option value="Whole Seller" {{ old('type') == 'Whole Seller' ? 'selected' : '' }}>Whole Seller</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="address">{{ __('supplier.address') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          name="address" required>{{ old('address') }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <!-- End Input Data -->

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('supplier.save') }}</button>
                            <a class="btn bg-danger" href="{{ route('suppliers.index') }}">{{ __('supplier.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.preview-img-form')
@endsection
