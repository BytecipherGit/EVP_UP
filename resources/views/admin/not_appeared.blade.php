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
 <input type="hidden" id="interview_status" name="interview_status" value="{{ $interviewStatus }}">
 <input type="hidden" id="interview_id" name="interview_id" value="{{ $interviewRoundId }}">
<div class="form-group">
    <label>Descriptions</label>
    <textarea rows="3" name="comment" class="form-control" placeholder="Add description"></textarea>
</div>

               
      
   

