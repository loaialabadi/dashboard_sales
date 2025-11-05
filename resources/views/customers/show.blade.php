@extends('dashboard.body.main')

@section('container')
<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card car-transparent">
                <div class="card-body p-0">
                    <div class="profile-image position-relative">
                        <img src="{{ asset('assets/images/page-img/profile.png') }}" class="img-fluid rounded h-30 w-100" alt="profile-image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <!-- begin: Left Detail Employee -->
        <div class="col-lg-4 card-profile mb-5 h-50">
            <div class="card card-block card-stretch card-height mb-5">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="profile-img position-relative">
                            <img src="{{ $customer->photo ? asset('storage/customers/' . $customer->photo) : asset('assets/images/user/1.png') }}" class="img-fluid rounded avatar-110" alt="profile-image">
                        </div>
                        <div class="ml-3">
                            <h4 class="mb-1">{{ $customer->name }}</h4>
                            <p class="mb-2">{{ $customer->shopname }}</p>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary font-size-14">{{ __('customer.edit') }}</a>
                            <a href="{{ route('customers.index') }}" class="btn btn-danger font-size-14">{{ __('customer.back') }}</a>
                        </div>
                    </div>
                    <ul class="list-inline p-0 m-0">
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $customer->email }}</p>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $customer->phone }}</p>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $customer->city ? $customer->city : __('customer.unknown') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: Left Detail Employee -->

        <!-- begin: Right Detail Employee -->
        <div class="col-lg-8 card-profile">
            <div class="card card-block card-stretch mb-0">
                <div class="card-header px-3">
                    <div class="header-title">
                        <h4 class="card-title">{{ __('customer.info') }}</h4>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-inline p-0 mb-0">

                        @php
                            $fields = [
                                'name' => $customer->name,
                                'email' => $customer->email,
                                'phone' => $customer->phone,
                                'shop_name' => $customer->shopname,
                                'account_holder' => $customer->account_holder,
                                'bank_name' => $customer->bank_name,
                                'account_number' => $customer->account_number,
                                'bank_branch' => $customer->bank_branch,
                                'city' => $customer->city,
                            ];
                        @endphp

                        @foreach($fields as $label => $value)
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('customer.' . $label) }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $value }}" readonly>
                                </div>
                            </div>
                        </li>
                        @endforeach

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('customer.address') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <textarea class="form-control bg-white" readonly>{{ $customer->address }}</textarea>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- end: Right Detail Employee -->
    </div>
</div>
@endsection
