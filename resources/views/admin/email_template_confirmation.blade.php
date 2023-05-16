<!-- The Modal Updates Status INFO -->

<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>
<h2 class="modal-title" id=""></h2>
<div class="form-group">
    {{-- <label>Are you sure you want to update status?</label>  --}}
</div>
<div class="form-group">
    {{-- <input type="hidden" id="interview_status" name="interview_status" value="{{ $interviewStatus }}"> --}}
    <label><h4>Please checked checkbox if you want to send email to employee 
        <input type="hidden" id="interview_status" name="interview_status" value="{{ $interviewStatus }}">
        <input type="hidden" id="interview_id" name="interview_id" value="{{ $interviewRoundId }}">
        <input type="checkbox" name="status" class="switch-input" value="1"/></h4>
    </label>
   
</div>

               
      
   

