@extends('dashboard.body.main')

@section('container')
@php
    $group_names = [
        ['slug' => 'pos', 'name' => __('role.pos')],
        ['slug' => 'employee', 'name' => __('role.employee')],
        ['slug' => 'customer', 'name' => __('role.customer')],
        ['slug' => 'supplier', 'name' => __('role.supplier')],
        ['slug' => 'salary', 'name' => __('role.salary')],
        ['slug' => 'attendence', 'name' => __('role.attendence')],
        ['slug' => 'category', 'name' => __('role.category')],
        ['slug' => 'product', 'name' => __('role.product')],
        ['slug' => 'orders', 'name' => __('role.orders')],
        ['slug' => 'stock', 'name' => __('role.stock')],
        ['slug' => 'roles', 'name' => __('role.roles')],
        ['slug' => 'user', 'name' => __('role.user')],
        ['slug' => 'database', 'name' => __('role.database')],
        ['slug' => 'branches', 'name' => __('role.branches')]
    ]
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ __('role.create_permission') }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                        <!-- begin: Input Data -->
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('role.permission_name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="off">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="group_name">{{ __('role.group_name') }} <span class="text-danger">*</span></label>
                                <select class="form-control @error('group_name') is-invalid @enderror" name="group_name" required>
                                    <option selected="" disabled>-- {{ __('role.select_group') }} --</option>
                                    @foreach ($group_names as $item)
                                        <option value="{{ $item['slug'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('group_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('role.save') }}</button>
                            <a class="btn bg-danger" href="{{ route('permission.index') }}">{{ __('role.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
