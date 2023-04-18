<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $theme ? '' : 1 }}" />
<input type="hidden" id="theme_id" name="theme_id" value="{{ $theme ? $theme->id : '' }}" />
<input type="hidden" id="theme_type" name="theme_type" value="logo" />
<div class="form-group">
    <label>logo</label>
    <input type="file" name="logo" id="logo" class="form-control">
    <strong class="error" id="title-error"></strong>
</div>
