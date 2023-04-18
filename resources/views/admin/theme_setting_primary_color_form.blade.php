<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $theme ? '' : 1 }}" />
<input type="hidden" id="theme_id" name="theme_id" value="{{ $theme ? $theme->id : '' }}" />
<input type="hidden" id="theme_type" name="theme_type" value="primary_color" />
<div class="form-group">
    <label>Theme Primary Color</label>
    <input type="text" name="primary_color" id="primary_color" class="form-control">
    <strong class="error" id="primary_color-error"></strong>
</div>
