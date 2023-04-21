<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>

<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $theme ? '' : 1 }}" />
<input type="hidden" id="theme_id" name="theme_id" value="{{ $theme ? $theme->id : '' }}" />
<input type="hidden" id="theme_type" name="theme_type" value="button_text_color" />
<div class="form-group">
    <label>Theme Button Text Color</label>
    <div id="cp2" class="input-group colorpicker-component">
        <input class="form-control" type="text" value="{{ $theme ? $theme->value : '#00AABB' }}" name="button_text_color" id="button_text_color">
        <span class="input-group-addon"><i></i></span>
        <strong class="error" id="button_text_color-error"></strong>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cp2').colorpicker();
            });
        </script>
      </div>
</div>





