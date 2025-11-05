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
                        <h4 class="card-title">{{ __('attendance.edit_title') }}</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('attendence.store') }}" method="POST">
                        @csrf
                        <!-- begin: Input Data -->
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="datepicker">{{ __('attendance.date') }} <span class="text-danger">*</span></label>
                                <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $date) }}" />
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
                                            @foreach ($attendences as $attendence)
                                            <tr>
                                                <th scope="row">{{ $key = $loop->iteration  }}</th>
                                                <td>{{ $attendence->employee->name}}</td>
                                                <td>
                                                    <input type="hidden" name="employee_id[{{ $key }}]" value="{{ $attendence->employee_id }}">
                                                    <div class="input-group justify-content-center">
                                                        <div class="input-group-text">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="present{{ $key }}" name="status{{ $key }}" class="custom-control-input" value="present" {{ $attendence->status == 'present' ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="present{{ $key }}">{{ __('attendance.present') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-text mx-2">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="leave{{ $key }}" name="status{{ $key }}" class="custom-control-input" value="leave" {{ $attendence->status == 'leave' ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="leave{{ $key }}">{{ __('attendance.leave') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group-text">
                                                            <div class="custom-radio">
                                                                <input type="radio" id="absent{{ $key }}" name="status{{ $key }}" class="custom-control-input" value="absent" {{ $attendence->status == 'absent' ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="absent{{ $key }}">{{ __('attendance.absent') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">{{ __('attendance.update_btn') }}</button>
                            <a href="{{ route('attendence.index') }}" class="btn btn-danger">{{ __('attendance.cancel_btn') }}</a>
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
