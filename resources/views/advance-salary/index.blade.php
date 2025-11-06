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
                    <h4 class="mb-3">{{ __('advance-salary.title') }}</h4>
                    <p class="mb-0">{{ __('advance-salary.desc') }}</p>
                </div>
                <div>
                    <a href="{{ route('advance-salary.create') }}" class="btn btn-primary add-list">
                        <i class="fas fa-plus mr-3"></i>{{ __('advance-salary.create') }}
                    </a>
                    <a href="{{ route('advance-salary.index') }}" class="btn btn-danger add-list">
                        <i class="fa-solid fa-trash mr-3"></i>{{ __('advance-salary.clear_search') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('advance-salary.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">

                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">{{ __('advance-salary.row') }}:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row')=='10') selected @endif>10</option>
                                <option value="25" @if(request('row')=='25') selected @endif>25</option>
                                <option value="50" @if(request('row')=='50') selected @endif>50</option>
                                <option value="100" @if(request('row')=='100') selected @endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">{{ __('advance-salary.search') }}:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search"
                                       placeholder="{{ __('advance-salary.search_employee') }}"
                                       value="{{ request('search') }}">
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
                            <th>{{ __('advance-salary.no') }}</th>
                            <th>{{ __('advance-salary.photo') }}</th>
                            <th>@sortablelink('employee.name', __('advance-salary.name'))</th>
                            <th>@sortablelink('date', __('advance-salary.date'))</th>
                            <th>@sortablelink('advance_salary', __('advance-salary.advance_salary'))</th>
                            <th>{{ __('advance-salary.action') }}</th>
                        </tr>
                    </thead>

                    <tbody class="ligth-body">
                        @forelse ($advance_salaries as $advance_salary)
                        <tr>
                            <td>{{ (($advance_salaries->currentPage() * 10) - 10) + $loop->iteration }}</td>

                            <td>
                                <img class="avatar-60 rounded"
                                     src="{{ $advance_salary->employee->photo
                                        ? asset('storage/employees/'.$advance_salary->employee->photo)
                                        : asset('assets/images/user/1.png') }}">
                            </td>

                            <td>{{ $advance_salary->employee->name }}</td>
                            <td>{{ Carbon\Carbon::parse($advance_salary->date)->format('M/Y') }}</td>
                            <td>
                                {{ $advance_salary->advance_salary
                                    ? '$'.$advance_salary->advance_salary
                                    : __('advance-salary.no_advance')
                                }}
                            </td>

                            <td>
                                <form action="{{ route('advance-salary.destroy', $advance_salary->id) }}" method="POST" style="margin-bottom: 5px">
                                    @method('delete')
                                    @csrf
                                    <div class="d-flex align-items-center list-action">
                                        <a class="btn btn-success mr-2"
                                            title="{{ __('advance-salary.edit') }}"
                                            href="{{ route('advance-salary.edit', $advance_salary->id) }}">
                                            <i class="ri-pencil-line mr-0"></i>
                                        </a>

                                        <button type="submit" class="btn btn-warning mr-2 border-none"
                                            onclick="return confirm('{{ __('advance-salary.confirm_delete') }}')"
                                            title="{{ __('advance-salary.delete') }}">
                                            <i class="ri-delete-bin-line mr-0"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <div class="alert text-white bg-danger" role="alert">
                            <div class="iq-alert-text">{{ __('advance-salary.not_found') }}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $advance_salaries->links() }}
        </div>
    </div>
</div>
@endsection
