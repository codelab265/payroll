<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CREATE</h5>
                <button type="button" class="btn text-danger" data-bs-dismiss="modal" aria-label="btn-close">
                    <i data-feather="x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['id' => 'createForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_in">Time in</label>
                                    <input type="time" name="time_in" id="time_in" class="form-control"
                                        placeholder="" aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_out">Time out</label>
                                    <input type="time" name="time_out" id="time_out" class="form-control"
                                        placeholder="" aria-describedby="helpId">
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createButton">Save</button>
            </div>
        </div>
    </div>
</div>
