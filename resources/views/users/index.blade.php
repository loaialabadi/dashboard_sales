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
                    <h4 class="mb-3">{{ __('users.user_list') }}</h4>
                </div>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary add-list">
                        <i class="fa-solid fa-plus mr-3"></i>{{ __('users.create_user') }}
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-danger add-list">
                        <i class="fa-solid fa-trash mr-3"></i>{{ __('users.clear_search') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('users.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">{{ __('users.row') }}</label>
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
                        <label class="control-label col-sm-3 align-self-center" for="search">{{ __('users.search') }}</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="{{ __('users.search') }}" value="{{ request('search') }}">
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
                            <th>No.</th>
                            <th>{{ __('users.photo') }}</th>
                            <th>@sortablelink('name', __('users.name'))</th>
                            <th>@sortablelink('username', __('users.username'))</th>
                            <th>@sortablelink('email', __('users.email'))</th>
                            <th>{{ __('users.role') }}</th>
                            <th>{{ __('users.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($users as $item)
                            <tr>
                                <td>{{ (($users->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                <td>
                                    <img class="avatar-60 rounded" src="{{ $item->photo ? asset('storage/profile/'.$item->photo) : asset('assets/images/user/1.png') }}">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @foreach ($item->roles as $role)
                                        <span class="badge bg-danger">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', $item->username) }}" method="POST" style="margin-bottom: 5px">
                                        @method('delete')
                                        @csrf
                                        <div class="d-flex align-items-center list-action">
                                            <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="{{ route('users.edit', $item->username) }}">
                                                <i class="ri-pencil-line mr-0"></i>
                                            </a>
                                            <button type="submit" class="btn btn-warning mr-2 border-none" onclick="return confirm('{{ __('users.delete_confirm') }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                <i class="ri-delete-bin-line mr-0"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="alert text-white bg-danger" role="alert">
                                        <div class="iq-alert-text">{{ __('users.no_data') }}</div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
