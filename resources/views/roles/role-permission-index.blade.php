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
                    <h4 class="mb-3">{{ __('role.title') }}</h4>
                </div>
                <div>
                    <a href="{{ route('rolePermission.create') }}" class="btn btn-primary add-list">
                        <i class="fa-solid fa-plus mr-3"></i>{{ __('role.add_button') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>{{ __('role.no') }}</th>
                            <th>{{ __('role.role_name') }}</th>
                            <th>{{ __('role.permission_name') }}</th>
                            <th>{{ __('role.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ (($roles->currentPage() * 10) - 10) + $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="badge rounded-pill bg-danger">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('rolePermission.destroy', $role->id) }}" method="POST" style="margin-bottom: 5px">
                                    @method('delete')
                                    @csrf
                                    <div class="d-flex align-items-center list-action">
                                        <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="{{ __('role.edit') }}"
                                            href="{{ route('rolePermission.edit', $role->id) }}"><i class="ri-pencil-line mr-0"></i>
                                        </a>
                                        <button type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('{{ __('role.confirm_delete') }}')" data-toggle="tooltip" data-placement="top" title="{{ __('role.delete') }}">
                                            <i class="ri-delete-bin-line mr-0"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $roles->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
