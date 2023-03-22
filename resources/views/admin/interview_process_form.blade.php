<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $interview ? '' : 1 }}" />
<input type="hidden" id="interview_id" name="interview_id" value="{{ $interview ? $interview->id : '' }}" />
<div class="form-group">
    <label>Title<span style="color:red">*</span>(Ex. Round 1)</label>
    <input type="type" name="title" class="form-control" placeholder="Round 1"
        value="{{ $interview ? $interview->title : '' }}">
    <strong class="error" id="title-error"></strong>
</div>
<div class="form-group">
    <label>Descriptions<span style="color:red">*</span></label>
    <input type="type" name="descriptions" class="form-control" placeholder="Interview Scheduled"
        value="{{ $interview ? $interview->descriptions : '' }}">
    <strong class="error" id="descriptions-error"></strong>
</div>
