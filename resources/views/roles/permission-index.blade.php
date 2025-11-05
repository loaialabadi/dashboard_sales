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
                    <h4 class="mb-3">{{ __('permission.title') }}</h4>
                    <p class="mb-0">{{ __('permission.description') }}</p>
                </div>
                <div>
                    <a href="{{ route('permission.create') }}" class="btn btn-primary add-list"><i class="fa-solid fa-plus mr-3"></i>{{ __('permission.add_permission') }}</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>{{ __('permission.no') }}</th>
                            <th>{{ __('permission.permission_name') }}</th>
                            <th>{{ __('permission.group_name') }}</th>
                            <th>{{ __('permission.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ (($permissions->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->group_name }}</td>
                            <td>
                                <form action="{{ route('permission.destroy', $permission->id) }}" method="POST" style="margin-bottom: 5px">
                                    @method('delete')
                                    @csrf
                                    <div class="d-flex align-items-center list-action">
                                        <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="{{ __('permission.edit') }}"
                                            href="{{ route('permission.edit', $permission->id) }}"><i class="ri-pencil-line mr-0"></i>
                                        </a>
                                        <button type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('{{ __('permission.delete_confirm') }}')" data-toggle="tooltip" data-placement="top" title="{{ __('permission.delete') }}"><i class="ri-delete-bin-line mr-0"></i></button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $permissions->links() }}
        </div>
    </div>
</div>
@endsection
