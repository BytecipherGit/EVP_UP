
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $exitemployee ? '' : 1 }}" />
<input type="hidden" id="employee_id" name="employee_id" value="{{ $exitemployee ? $exitemployee->id : '' }}" />
<div class="form-group">
    <label>Title<span style="color:red">*</span></label>
    <input type="type" name="title" class="form-control" placeholder="Process title"
        value="{{ $exitemployee ? $exitemployee->title : '' }}">
    <strong class="error" id="title-error"></strong>
</div>
<div class="form-group">
    <label>Descriptions<span style="color:red">*</span></label>
    <textarea rows="3" name="descriptions" class="form-control">{{ $exitemployee ? $exitemployee->descriptions : '' }}</textarea>
    <strong class="error" id="descriptions-error"></strong>
</div>
