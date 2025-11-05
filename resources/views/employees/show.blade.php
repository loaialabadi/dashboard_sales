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
                            <img src="{{ $employee->photo ? asset('storage/employees/' . $employee->photo) : asset('assets/images/user/1.png') }}" class="img-fluid rounded avatar-110" alt="profile-image">
                        </div>
                        <div class="ml-3">
                            <h4 class="mb-1">{{ $employee->name }}</h4>
                            <p class="mb-2">UI/UX Designer</p>

                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary font-size-14">
                                {{ __('employees.edit') }}
                            </a>

                            <a href="{{ route('employees.index') }}" class="btn btn-danger font-size-14">
                                {{ __('employees.back') }}
                            </a>
                        </div>
                    </div>

                    <ul class="list-inline p-0 m-0">

                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $employee->email }}</p>
                            </div>
                        </li>

                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $employee->phone }}</p>
                            </div>
                        </li>

                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $employee->city ? $employee->city : 'Unknown' }}</p>
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
                        <h4 class="card-title">
                            {{ __('employees.profile') }}
                        </h4>
                    </div>
                </div>

                <div class="card-body p-3">
                    <ul class="list-inline p-0 mb-0">

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">
                                        {{ __('employees.name') }}
                                    </label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->name }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.email') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->email }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.phone') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->phone }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.experience') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->experience }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.salary') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="${{ $employee->salary }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.vacation') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->vacation }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.city') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->city }}" readonly>
                                </div>
                            </div>
                        </li>

                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">{{ __('employees.address') }}</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <textarea class="form-control bg-white" readonly>{{ $employee->address }}</textarea>
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
