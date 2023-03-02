@extends('layout.admin.app')
@section('title', 'Generate Payroll')

@section('body')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">
                    @yield('title')
                </h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">

            </div>

        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select class="form-control select2" multiple="multiple" name="department_id" id="department_id">
                        <option>All</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <a name="" id="" class="btn btn-primary btn-sm" href="#" role="button">
                    <i data-feather="download" size="20"></i>
                    Generate
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="attendance-dat"></div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".select2").select2({
                    'placeholder': 'Select department'
                });
                var table;
                loadTable();

                function loadTable() {

                    var url = '{!! route('admin.attendance') !!}';

                    $.easyAjax({
                        type: 'GET',
                        data: {},
                        url: url,
                        success: function(response) {
                            $('#attendance-data').html(response.data);
                        }
                    });
                }

                $('#attendanceFilterButton').click(function(e) {
                    e.preventDefault();
                    var url = '{!! route('admin.attendance') !!}';
                    var month = $('#current_month').val();
                    var year = $('#current_year').val();

                    $.easyAjax({
                        type: 'GET',
                        data: {
                            month: month,
                            year: year
                        },
                        url: url,
                        success: function(response) {
                            $('#attendance-data').html(response.data);
                        }
                    });

                });
            });
        </script>
    @endpush
