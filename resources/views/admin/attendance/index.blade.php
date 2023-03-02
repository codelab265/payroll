@extends('layout.admin.app')
@section('title', 'Attendance')

@section('body')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">
                    @yield('title') for {{ date('F Y', strtotime('01-' . $current_month . '-' . $current_year)) }}
                </h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">

                <a href="{{ route('admin.attendance.create') }}" type="button" class="btn btn-primary btn-sm">
                    <i data-feather="plus-circle" width="24" height="24"></i>
                    Create
                </a>
            </div>

        </div>
        <div class="row mb-4">
            <div class="col-md-5">
                <div class="form-group">
                    <select class="form-control" name="current_month" id="current_month">
                        <option value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">Februry</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">

                <div class="form-group">
                    <select class="form-control" name="current_year" id="current_year">
                        <option value="">Select Year</option>
                        @for ($i = 2018; $i <= 2025; $i++)
                            <option value="{{ $i }}">
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-warning block btn-sm float-end" id="attendanceFilterButton">
                    <i data-feather="search"></i>
                    Appy
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="attendance-data"></div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".select2").select2();
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
