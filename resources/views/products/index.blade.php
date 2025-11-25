@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            {{-- ✅ Success Message --}}
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif

            {{-- ✅ Error Message --}}
            @if (session()->has('error'))
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif

            {{-- ✅ Page Title --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">{{ __('product.list_title') }}</h4>
                    <p class="mb-0">{{ __('product.list_desc') }}</p>
                </div>

                <div>
                    <a href="{{ route('products.importView') }}" class="btn btn-success add-list">
                        {{ __('product.import') }}
                    </a>
                    <a href="{{ route('products.exportData') }}" class="btn btn-warning add-list">
                        {{ __('product.export') }}
                    </a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary add-list">
                        {{ __('product.add') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- ✅ Filter --}}
        <div class="col-lg-12">
            <form action="{{ route('products.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">

                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">
                            {{ __('product.rows') }}:
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @selected(request('row') == '10')>10</option>
                                <option value="25" @selected(request('row') == '25')>25</option>
                                <option value="50" @selected(request('row') == '50')>50</option>
                                <option value="100" @selected(request('row') == '100')>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">
                            {{ __('product.search') }}:
                        </label>

                        <div class="input-group col-sm-8">
                            <input type="text" id="search" class="form-control"
                                name="search" placeholder="{{ __('product.search_placeholder') }}"
                                value="{{ request('search') }}">

                            <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-primary">
                                    <i class="fa-solid fa-magnifying-glass font-size-20"></i>
                                </button>
                                <a href="{{ route('products.index') }}" class="input-group-text bg-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        {{-- ✅ Table --}}
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">

                            <th>#</th>
                            <th>{{ __('product.photo') }}</th>
                            <th>@sortablelink('product_name', __('product.name'))</th>
                            <th>@sortablelink('category.name', __('product.category'))</th>
                            <th>@sortablelink('supplier.name', __('product.supplier'))</th>
                            <th>@sortablelink('selling_price', __('product.price'))</th>
                            <th>{{ __('product.status') }}</th>
                            <th>{{ __('product.action') }}</th>

                        </tr>
                    </thead>

                    <tbody class="ligth-body">
                        @forelse ($products as $product)

                        <tr>
                            <td>{{ (($products->currentPage() * 10) - 10) + $loop->iteration }}</td>

                            <td>
                                <img class="avatar-60 rounded"
                                src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/images/product/vertical-banners-sales-promo.jpg') }}">
                            </td>

                            <td>
                                @if(app()->getLocale() === 'ar')
                                    {{ $product->product_name_ar ?? $product->product_name }}
                                @else
                                    {{ $product->product_name }}
                                @endif
                            </td>

                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->supplier->name }}</td>
                            <td>{{ $product->selling_price }}</td>

                            <td>
                                @if ($product->expire_date > now()->format('Y-m-d'))
                                    <span class="badge rounded-pill bg-success">{{ __('product.valid') }}</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">{{ __('product.invalid') }}</span>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <div class="d-flex align-items-center list-action">

                                        <a class="btn btn-info mr-2"
                                            href="{{ route('products.show', $product->id) }}">
                                            <i class="ri-eye-line mr-0"></i>
                                        </a>

                                        <a class="btn btn-success mr-2"
                                            href="{{ route('products.edit', $product->id) }}">
                                            <i class="ri-pencil-line mr-0"></i>
                                        </a>

                                        <button type="submit"
                                            class="btn btn-warning border-none"
                                            onclick="return confirm('{{ __('product.delete_confirm') }}')">
                                            <i class="ri-delete-bin-line mr-0"></i>
                                        </button>

                                    </div>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert text-white bg-danger">{{ __('product.not_found') }}</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{ $products->links() }}
        </div>

    </div>
</div>
@endsection
