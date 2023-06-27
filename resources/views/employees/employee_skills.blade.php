<style>
    .velidation {
      color: red;
      font-size: 12px;
      display: block;
      margin: 5px 0;
      display: flex;
  }
</style>
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
                @error('skill')
                 <span class="velidation">{{ $message }}</span>
                @enderror
                
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
                @error('lang')
                <span class="velidation">{{ $message }}</span>
               @enderror
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
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td class="addskill"><input type="text" name="skill[' + i +
            ']" placeholder="Enter skill" class="form-control skilleffect" /></td><td class="addskill"><h5><span><input type="radio" id="customRadioInline1" name="skill_type[' +
            i +
            ']" class="mr-2"  value="Beginner" checked="">  <label class="mr-2" for="customRadioInline1">Beginner</label></span> <span><input type="radio" id="customRadioInline2" name="skill_type[' +
            i +
            ']" class="mr-2" value="Intermediate">  <label class="mr-2" for="customRadioInline2">Intermediate</label></span> <span><input type="radio" id="customRadioInline3" name="skill_type[' +
            i +
            ']" class="mr-2" value="Expert">  <label class="mr-2" for="customRadioInline3">Expert</label></span></h5></td><td class="addskill"><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
    var j = 0;
    $("#dynamic-ar1").click(function() {
        ++j;
        $("#dynamicAddRemove1").append('<tr><td class="addskill"><input type="text" name="lang[' + j +
            ']" placeholder="Enter language" class="form-control skilleffect" /></td><td class="addskill"><h5><span><input type="radio" id="customRadioInline4" name="lang_type[' +
            j +
            ']" class="mr-2"  value="Beginner" checked="">  <label class="mr-2" for="customRadioInline4">Beginner</label></span>  <span><input type="radio" id="customRadioInline5" name="lang_type[' +
            j +
            ']" class="mr-2" value="Intermediate">  <label class="mr-2" for="customRadioInline5">Intermediate</label></span> <span><input type="radio" id="customRadioInline6" name="lang_type[' +
            j +
            ']" class="mr-2" value="Expert">  <label class="mr-2" for="customRadioInline6">Expert</label></span></h5></td><td class="addskill"><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field1', function() {
        $(this).parents('tr').remove();
    });
</script>

<script>
    $('.extra-fields-customer1').click(function() {
        $('.customer_records1').clone().appendTo('.customer_records_dynamic1');
        $('.customer_records_dynamic1 .customer_records1').addClass('single remove');
        $('.single .extra-fields-customer1').remove();
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
            );
        $('.customer_records_dynamic1 > .single').attr("class", "row");

        $('.customer_records_dynamic1 input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });

    });

    $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
    });
</script>

<script>
    $('.extra-fields-customeroff').click(function() {
        $('.customer_recordsoff').clone().appendTo('.customer_records_dynamicoff');
        $('.customer_records_dynamicoff .customer_recordsoff').addClass('single remove');
        $('.single .extra-fields-customeroff').remove();
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer add-plus minus-icon"><span><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></a>'
            );
        $('.customer_records_dynamicoff > .single').attr("class", "row");

        $('.customer_records_dynamicoff input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });

    });

    $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.row').remove();
        e.preventDefault();
    });
</script>
