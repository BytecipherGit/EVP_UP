<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $feedback ? '' : 1 }}" />
<input type="hidden" id="feedback_id" name="feedback_id" value="{{ $feedback ? $feedback->id : '' }}" />
<div class="form-group">
    <label>Title<span style="color:red"> *</span></label>
    <input type="type" name="title" class="form-control" value="{{ $feedback ? $feedback->title : '' }}">
    <strong class="error" id="title-error"></strong>
</div>