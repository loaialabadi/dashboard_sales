@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ __('category.edit_title') }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.update', $category->slug) }}" method="POST">
                        @csrf
                        @method('put')

                        <!-- begin: Input Data -->
                        <div class="row align-items-center">

                            <div class="form-group col-md-12">
                                <label for="name">
                                    {{ __('category.name') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $category->name) }}"
                                       required>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="slug">
                                    {{ __('category.slug') }}
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       class="form-control @error('slug') is-invalid @enderror"
                                       id="slug"
                                       name="slug"
                                       value="{{ old('slug', $category->slug) }}"
                                       required
                                       readonly>

                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <!-- end: Input Data -->

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">
                                {{ __('category.save') }}
                            </button>

                            <a href="{{ route('categories.index') }}" class="btn bg-danger">
                                {{ __('category.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug   = document.querySelector("#slug");

    title.addEventListener("keyup", function() {
        slug.value = title.value.replace(/ /g, "-").toLowerCase();
    });
</script>

@include('components.preview-img-form')
@endsection
