<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>

<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $onboarding ? '' : 1 }}" />
<input type="hidden" id="employee_id" name="employee_id" value="{{ $onboarding ? $onboarding->id : '' }}" />
<div class="form-group">
    <label>Title<span style="color:red">*</span></label>
    <input type="type" name="title" class="form-control" placeholder="Process title"
        value="{{ $onboarding ? $onboarding->title : '' }}">
    <strong class="error" id="title-error"></strong>
</div>

<div class="form-group">
    <label>Descriptions<span style="color:red">*</span></label>
    <textarea rows="3" name="descriptions" class="form-control">{{ $onboarding ? $onboarding->descriptions : '' }}</textarea>
    <strong class="error" id="descriptions-error"></strong>
</div>
