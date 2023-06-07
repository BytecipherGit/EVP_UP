<form id="employee_skills_form" action="{{ url('employee_skills/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $qualificationExist ? '' : 1 }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
    <h2>Add Skills</h2>
    <table class="table table-bordered skilltable" id="dynamicAddRemove">
        <tr>
            <th>Add Skills<span style="color:red">*</span></th>
        </tr>
        <tr>
            <td class="addskill"><input type="text" name="skill[]" id="skill" placeholder="Enter skill" class="form-control skilleffect" />
                <strong class="error" id="skill-error"></strong>
            </td>
            <td class="addskill">
                <h5>
                    <span><input type="radio" id="customRadioInline1" name="skill_type[]" class="mr-2" value="Beginner" checked=""> <label class="mr-2" for="customRadioInline1">Beginner</label></span>
                    <span><input type="radio" id="customRadioInline2" name="skill_type[]" class="mr-2" value="Intermediate"> <label class="mr-2" for="customRadioInline2">Intermediate</label></span>
                    <span><input type="radio" id="customRadioInline3" name="skill_type[]" class="mr-2" value="Expert">
                    <label class="mr-2" for="customRadioInline3">Expert</label></span>
                </h5>
            </td>
            <td class="addskill"><a name="add" id="dynamic-ar" class="add-plus extra-fields-customer"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span>
            </td>
        </tr>
    </table>

    <h2>Add Language</h2>
    <table class="table table-bordered skilltable" id="dynamicAddRemove1">
        <tr>
            <th>Add Languages<span style="color:red">*</span></th>
        </tr>
        <tr>
            <td class="addskill"><input type="text" name="lang[]" id="lang" placeholder="Enter language" class="form-control skilleffect" />
                <strong class="error" id="lang-error"></strong>
            </td>
            <td class="addskill">
                <h5>
                    <span><input type="radio" id="customRadioInline4" name="lang_type[]" class="mr-2" value="Beginner" checked=""> <label class="mr-2" for="customRadioInline4">Beginner</label></span>
                    <span><input type="radio" id="customRadioInline5" name="lang_type[]" class="mr-2" value="Intermediate"> <label class="mr-2" for="customRadioInline5">Intermediate</label></span>
                    <span><input type="radio" id="customRadioInline6" name="lang_type[]" class="mr-2"value="Expert">
                    <label class="mr-2" for="customRadioInline6">Expert</label></span>
                </h5>
            </td>
            <td class="addskill"><a name="add" id="dynamic-ar1" class="add-plus extra-fields-customer"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span>
            </td>
        </tr>
    </table>

    <div class="col-md-12 ">
        <div class="form-group">
            <div class="add-btn-part">
                {{-- <button type="" class="btn-secondary-cust">Back</button> --}}
                <button type="submit" name="workskill" class="btn-primary-cust button_background_color"><span class="button_text_color">Next</span></button>
            </div>
        </div>
    </div>
</form>  
