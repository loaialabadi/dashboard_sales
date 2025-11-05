@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ __('attendance.create_title') }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('attendence.store') }}" method="POST">
                    @csrf
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="datepicker">{{ __('attendance.date') }} <span class="text-danger">*</span></label>
                                <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" />
                                @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <div class="table-responsive rounded mb-3">
                                    <table class="table mb-0">
                                        <thead class="bg-white text-uppercase">
                                            <tr class="ligth ligth-data">
                                                <th>{{ __('attendance.no') }}</th>
                                                <th>{{ __('attendance.employee') }}</th>
                                                <th class="text-center">{{ __('attendance.status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ligth-body">
                                            @foreach ($employees as $employee)
                                            <tr>
                                                <th scope="row">{{ $key = $loop->iteration }}</th>
                                                <td>{{ $employee->name }}</td>
                                                <td>
                                                    <input type="hidden" name="employee_id[{{ $key }}]" value="{{ $employee->id }}">
                                                    <div class="input-group justify-content-center">
                                                        @php
                                                            $statuses = ['present', 'leave', 'absent'];
                                                        @endphp
                                                        @foreach ($statuses as $status)
                                                        <div class="input-group-text {{ $loop->index == 1 ? 'mx-2' : '' }}">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="{{ $status }}{{ $key }}" name="status{{ $key }}" class="custom-control-input position-relative" style="height: 20px" value="{{ $status }}">
                                                                <label class="custom-control-label" for="{{ $status }}{{ $key }}">{{ __('attendance.' . $status) }}</label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">{{ __('attendance.save') }}</button>
                            <a href="{{ route('attendence.index') }}" class="btn btn-danger">{{ __('attendance.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
</script>
@endsection
