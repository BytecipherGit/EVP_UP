<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $position ? '' : 1 }}" />
<input type="hidden" id="position_id" name="position_id" value="{{ $position ? $position->id : '' }}" />
<div class="form-group">
    <label>Title<span style="color:red"> *</span></label>
    <input type="type" name="title" class="form-control" placeholder="Ex. NodeJs"
        value="{{ $position ? $position->title : '' }}">
    <strong class="error" id="title-error"></strong>
</div>