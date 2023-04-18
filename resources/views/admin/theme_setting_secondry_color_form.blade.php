<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $theme ? '' : 1 }}" />
<input type="hidden" id="theme_id" name="theme_id" value="{{ $theme ? $theme->id : '' }}" />
<input type="hidden" id="theme_type" name="theme_type" value="secondry_color" />
<div class="form-group">
    <label>Theme Secondry Color</label>
    <input type="text" name="secondry_color" id="secondry_color" class="form-control">
    <strong class="error" id="secondry_color-error"></strong>
</div>
