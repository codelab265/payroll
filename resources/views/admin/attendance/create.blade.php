@extends('layout.admin.app')
@section('title', 'Create Attendance')

@section('body')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">
                    @yield('title')
                </h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">

                <a href="{{ route('admin.attendance') }}" class="btn btn-danger btn-sm">
                    <i data-feather="arrow-left" width="24" height="24"></i>
                    Back
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['id' => 'createForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label for="attendance_date">Date</label>
                            <input type="date" name="attendance_date" id="attendance_date" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_in">Time in</label>
                                    <input type="time" name="time_in" id="time_in" class="form-control" placeholder=""
                                        aria-describedby="helpId">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_out">Time out</label>
                                    <input type="time" name="time_out" id="time_out" class="form-control" placeholder=""
                                        aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="user_id">Employee</label>
                            <select class="select2 form-select form-control" multiple="multiple" data-width="100%"
                                name="user_id[]">
                                <option value="">Select</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <a style="button" class="btn btn-success" id="createButton">
                                Save
                            </a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".select2").select2();


                $('body').on('click', '#createButton', function(e) {
                    e.preventDefault();
                    $.easyAjax({
                        url: '{{ route('admin.attendance.create') }}',
                        type: "POST",
                        container: '#createForm',
                        data: $('#createForm').serialize(),
                        success: function(response) {
                            if (response.status == 'success') {}
                        }
                    })


                })



            });
        </script>
    @endpush
