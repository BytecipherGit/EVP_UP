<style>
    .error {
        color: red;
        font-weight: 400;
    }

</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $onboardProcess ? '' : 1 }}" />
<input type="hidden" id="employee_id" name="employee_id" value="{{ $employee->id }}" />
     @if(empty($employeeonboarding))
         @if($onboardProcessExist)
            @php $a = 0 @endphp
            @foreach($onboardProcess as $process)
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="hidden" name="process_id[]" value={{$process->id}}>
                        <label class="exitonboard"> <input type="checkbox" name="status[{{ $a }}]" class="checkboxexitform"/>  {{$process->title}}</label>   
                    </div>     
                </div>  
                @php $a++ @endphp
            @endforeach
         @else
         <p>Onboarding process not created</p>
         @endif
     @else
        <p>Onboarding already submited.</p>
     @endif


