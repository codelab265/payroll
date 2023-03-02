<div class="card">
    <div class="card-body">
        {!! Form::open(['id' => 'editForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        @method('patch')
        <input type="hidden" name="id" value="{{ $deduction->id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $deduction->name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Value</label>
                    <input type="number" class="form-control" name="value" id="value"
                        aria-describedby="emailHelpId" placeholder="" value="{{ $deduction->value }}">

                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
