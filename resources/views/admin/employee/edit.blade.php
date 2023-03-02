<div class="card">
    <div class="card-body">
        {!! Form::open(['id' => 'editForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        @method('patch')
        <input type="hidden" name="id" value="{{ $employee_detail->user_id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $employee_detail->user->name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone_number">Phone number</label>
                    <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $employee_detail->user->phone_number }}">
                </div>
            </div>

        </div>
        <div class="row mt-4">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="{{ $employee_detail->gender }}">
                            {{ $employee_detail->gender }}
                        </option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dob">Date of birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ @$employee_detail->dob }}">
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $employee_detail->address }}">

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hour_rate">Hourly Rate</label>
                    <input type="number" name="hour_rate" id="hour_rate" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $employee_detail->hour_rate }}">

                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select class="form-control" name="department_id" id="department_id">
                        <option value="{{ @$employee_detail->department_id }}">
                            {{ @$employee_detail->department->name }}
                        </option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="schedule_id">Schedule</label>
                    <select class="form-control" name="schedule_id" id="schedule_id">
                        <option value="{{ @$employee_detail->schedule_id }}">
                            {{ @$employee_detail->schedule->time_in }}-{{ @$employee_detail->schedule->time_out }}
                        </option>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">
                                {{ $schedule->time_in }}-{{ $schedule->time_out }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                Deductions
                <hr style="margin: 2px">
                @foreach ($deductions as $deduction)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="deduction_id[]" id=""
                                value="{{ $deduction->id }}"
                                @if (in_array($deduction->id, $employee_deductions)) checked @disabled(true) @endif>
                            {{ $deduction->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                Tax
                <hr style="margin: 2px">
                @foreach ($taxes as $tax)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="tax_id[]" id=""
                                value="{{ $tax->id }}">
                            {{ $tax->name }} ({{ $tax->value }}%)
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $employee_detail->user->email }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
