<style>
    .error {
        color: red;
        font-weight: 400;
    }
</style>

<h2 class="modal-title" id=""></h2>
<input type="hidden" id="is_add" value="{{ $onboardProcess ? '' : 1 }}" />
<input type="hidden" id="employee_id" name="employee_id" value="{{ $employee->id }}" />

@if (empty($employeeonboarding))
    @if ($onboardProcessExist)
        @php $a = 0 @endphp
        @foreach ($onboardProcess as $process)
      
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" name="process_id[]" value={{ $process->id }}>
                        <label class="exitonboard"> <input type="checkbox" name="status[{{ $a }}]"
                                class="checkboxexitform" /> {{ $process->title }}</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description </label>
                        <textarea rows="3" name="description[]" class="form-control" placeholder="description"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Document</label>
                        <input type="file" id="document" name="document[]" class="form-control"
                            accept="image/jpeg,image/doc,image/pdf" />
                    </div>
                </div>
                
            @php $a++ @endphp
            
        @endforeach
        <div class="modal-footer">
            <div class="loadingImg"></div>
            <div style="font-size: 16px; display:none;" class="text-success" id="success">Onboarding
                successfully done.</div>
            <div style="font-size: 16px; display:none;" class="text-danger" id="failed">Onboarding already
                done.</div>
            <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-primary-cust button_background_color"><span
                    class="button_text_color">Submit</span></button>
        </div>
    @else
        <p>Onboarding process not created</p>
    @endif
@else
    <p>Onboarding already submited.</p>
@endif
