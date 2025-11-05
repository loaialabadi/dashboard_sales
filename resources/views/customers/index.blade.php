@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif

            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">{{ __('customer.list_title') }}</h4>
                    <p class="mb-0">{{ __('customer.list_desc') }}</p>
                </div>

                <div>
                    <a href="{{ route('customers.create') }}" class="btn btn-primary add-list">
                        <i class="fa-solid fa-plus mr-3"></i>{{ __('customer.add') }}
                    </a>

                    <a href="{{ route('customers.index') }}" class="btn btn-danger add-list">
                        <i class="fa-solid fa-trash mr-3"></i>{{ __('customer.clear') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('customers.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">{{ __('customer.row') }}:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10') selected @endif>10</option>
                                <option value="25" @if(request('row') == '25') selected @endif>25</option>
                                <option value="50" @if(request('row') == '50') selected @endif>50</option>
                                <option value="100" @if(request('row') == '100') selected @endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">{{ __('customer.search') }}:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input 
                                    type="text" 
                                    id="search" 
                                    class="form-control" 
                                    name="search" 
                                    placeholder="{{ __('customer.search_placeholder') }}"
                                    value="{{ request('search') }}"
                                >
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary">
                                        <i class="fa-solid fa-magnifying-glass font-size-20"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>{{ __('customer.no') }}</th>
                            <th>{{ __('customer.photo') }}</th>
                            <th>@sortablelink('name', __('customer.name'))</th>
                            <th>@sortablelink('email', __('customer.email'))</th>
                            <th>@sortablelink('phone', __('customer.phone'))</th>
                            <th>@sortablelink('shopname', __('customer.shopname'))</th>
                            <th>{{ __('customer.action') }}</th>
                        </tr>
                    </thead>

                    <tbody class="ligth-body">
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ (($customers->currentPage() * 10) - 10) + $loop->iteration }}</td>

                            <td>
                                <img class="avatar-60 rounded" 
                                     src="{{ $customer->photo ? asset('storage/customers/'.$customer->photo) : asset('assets/images/user/1.png') }}">
                            </td>

                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->shopname }}</td>

                            <td>
                                <div class="d-flex align-items-center list-action">

                                    <a class="badge badge-info mr-2" 
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="{{ __('customer.view') }}"
                                       href="{{ route('customers.show', $customer->id) }}">
                                        <i class="ri-eye-line mr-0"></i>
                                    </a>

                                    <a class="badge bg-success mr-2"
                                       data-toggle="tooltip" data-placement="top"
                                       data-original-title="{{ __('customer.edit') }}"
                                       href="{{ route('customers.edit', $customer->id) }}">
                                        <i class="ri-pencil-line mr-0"></i>
                                    </a>

                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="margin-bottom: 5px">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            class="badge bg-warning mr-2 border-none"
                                            onclick="return confirm('{{ __('customer.confirm_delete') }}')"
                                            data-toggle="tooltip" data-placement="top"
                                            data-original-title="{{ __('customer.delete') }}">
                                            <i class="ri-delete-bin-line mr-0"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            {{ $customers->links() }}

        </div>
    </div>
</div>
@endsection
