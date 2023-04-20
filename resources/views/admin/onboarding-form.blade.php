<style>
    .error {
        color: red;
        font-weight: 400;
    }

    .Checkbox {
        width: 20px;
        height: 20px;
    }


</style>
<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $onboardProcess ? '' : 1 }}" />
<input type="hidden" id="employee_id" name="employee_id" value="{{ $employee->id }}" />
     @if(empty($employeeonboarding))
            @if($onboardProcess)
            @php $a = 0 @endphp
            @foreach($onboardProcess as $process)
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="hidden" name="process_id[]" value={{$process->id}}>
                        <label> <input type="checkbox" name="status[{{ $a }}]" class="Checkbox"/>  {{$process->title}}</label>   
                    </div>     
                </div>  
                @php $a++ @endphp
            @endforeach
     @else
        <p>Onboarding already submited.</p>
     @endif


