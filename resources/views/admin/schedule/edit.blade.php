<div class="card-body">
    {!! Form::open(['id' => 'editForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
    @method('patch')
    <input type="hidden" name="id" value="{{ $schedule->id }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="time_in">Time in</label>
                <input type="time" name="time_in" id="time_in" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $schedule->time_in }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="time_out">Time out</label>
                <input type="time" name="time_out" id="time_out" class="form-control" placeholder=""
                    aria-describedby="helpId" value="{{ $schedule->time_out }}">
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
