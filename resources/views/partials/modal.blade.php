<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          {{ Form::hidden('type', null, ['id' => 'data-type']) }}
          <div class="form-group">
            {{ Form::label('title', 'title') }}
            {{ Form::text('title', null, ['class' => ['form-control'], 'id' => 'title']) }}
          </div>

          <div class="form-group">
              {{ Form::label('date', 'date') }}
              {{ Form::text('date', null, ['class' => ['form-control', 'datepicker'], 'id' => 'date']) }}
          </div>
          <div class="form-group">
            {{ Form::label('sum', 'sum') }}
            {{ Form::number('sum', null, ['class' => ['form-control'], 'id' => 'sum', 'min' => 1]) }}
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary w-40" id="save-data-btn">Save</button>
        <button type="button" class="btn btn-secondary w-40" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>