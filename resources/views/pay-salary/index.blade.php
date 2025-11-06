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
                    <h4 class="mb-3">{{ __('pay-salary.pay_salary_list') }}</h4>
                    <p class="mb-0">{!! __('pay-salary.pay_salary_desc') !!}</p>
                </div>
                <div>
                    <a href="{{ route('advance-salary.index') }}" class="btn btn-danger add-list">
                        <i class="fa-solid fa-trash mr-3"></i>{{ __('pay-salary.clear_search') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('advance-salary.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">{{ __('pay-salary.row') }}:</label>
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
                        <label class="control-label col-sm-3 align-self-center" for="search">{{ __('pay-salary.search') }}:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="{{ __('pay-salary.search_employee') }}" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20"></i></button>
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
                            <th>Photo</th>
                            <th>@sortablelink('employee.name', __('pay-salary.employee_name'))</th>
                            <th>@sortablelink('date', __('pay-salary.date'))</th>
                            <th>@sortablelink('employee.salary', __('pay-salary.salary'))</th>
                            <th>@sortablelink('advance_salary', __('pay-salary.advance_salary'))</th>
                            <th>{{ __('pay-salary.due') }}</th>
                            <th>{{ __('pay-salary.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($advanceSalaries as $advanceSalary)
                        <tr>
                            <td>{{ (($advanceSalaries->currentPage() * 10) - 10) + $loop->iteration }}</td>
                            <td>
                                <img class="avatar-60 rounded" src="{{ $advanceSalary->employee->photo ? asset('storage/employees/'.$advanceSalary->employee->photo) : asset('assets/images/user/1.png') }}">
                            </td>
                            <td>{{ $advanceSalary->employee->name }}</td>
                            <td>{{ Carbon\Carbon::parse($advanceSalary->date)->format('M/Y') }}</td>
                            <td>${{ $advanceSalary->employee->salary }}</td>
                            <td>{{ $advanceSalary->advance_salary ? '$'.$advanceSalary->advance_salary : __('pay-salary.no_advance') }}</td>
                            <td>${{ $advanceSalary->employee->salary - $advanceSalary->advance_salary }}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-info mr-2" data-toggle="tooltip" title="{{ __('pay-salary.pay_now') }}" href="{{ route('pay-salary.paySalary', $advanceSalary->id) }}">
                                        {{ __('pay-salary.pay_now') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert text-white bg-danger" role="alert">
                                    <div class="iq-alert-text">{{ __('pay-salary.data_not_found') }}</div>
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
            {{ $advanceSalaries->links() }}
        </div>
    </div>
</div>
@endsection
