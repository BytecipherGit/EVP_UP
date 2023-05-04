<form id="employee_skills_form" action="{{ url('employee_skills/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="is_add" value="{{ $qualificationExist ? '' : 1 }}" />
    <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeExists ? $employeeExists->id : '' }}" />
    <table class="table table-bordered" id="dynamicAddRemove">
        <tr>
            <th>Add Skills<span style="color:red">*</span></th>
            <th></th>
        </tr>
        <tr>
            <td><input type="text" name="skill[]" placeholder="Enter subject" class="form-control" required />
                <strong class="error" id="skill-error"></strong>
            </td>
            <td>
                <h6>
                    <span><input type="radio" id="customRadioInline1" name="skill_type[]" class="" value="Beginner" checked=""> <label class="" for="customRadioInline1">Beginner</label></span>
                    <span><input type="radio" id="customRadioInline2" name="skill_type[]" class="" value="Intermediate"> <label class="" for="customRadioInline2">Intermediate</label></span>
                    <span><input type="radio" id="customRadioInline3" name="skill_type[]" class="" value="Expert">
                    <label class="" for="customRadioInline3">Expert</label></span>
                </h6>
            </td>
            <td><a name="add" id="dynamic-ar" class="add-plus extra-fields-customer"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span>
            </td>
        </tr>
    </table>

    <h2>Known Language</h2>
    <table class="table table-bordered" id="dynamicAddRemove1">
        <tr>
            <th>Add Languages<span style="color:red">*</span></th>
            <th></th>
        </tr>
        <tr>
            <td><input type="text" name="lang[]" placeholder="Enter subject" class="form-control" required />
                <strong class="error" id="lang-error"></strong>
            </td>
            <td>
                <h6>
                    <span><input type="radio" id="customRadioInline4" name="lang_type[]" class="" value="Beginner" checked=""> <label class=""for="customRadioInline4">Beginner</label></span>
                    <span><input type="radio" id="customRadioInline5" name="lang_type[]" class="" value="Intermediate"> <label class="" for="customRadioInline5">Intermediate</label></span>
                    <span><input type="radio" id="customRadioInline6" name="lang_type[]" class=""value="Expert">
                    <label class="" for="customRadioInline6">Expert</label></span>
                </h6>
            </td>
            <td><a name="add" id="dynamic-ar1" class="add-plus extra-fields-customer"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/button-plus.png"></span>
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
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="skill[' + i +
            ']" placeholder="Enter subject" class="form-control" /></td><td><h6><span><input type="radio" id="customRadioInline1" name="skill_type[' +
            i +
            ']" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline1">Beginner</label></span> <span><input type="radio" id="customRadioInline2" name="skill_type[' +
            i +
            ']" class="" value="Intermediate">  <label class="" for="customRadioInline2">Intermediate</label></span> <span><input type="radio" id="customRadioInline3" name="skill_type[' +
            i +
            ']" class="" value="Expert">  <label class="" for="customRadioInline3">Expert</label></span></h6></td><td><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
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
        $("#dynamicAddRemove1").append('<tr><td><input type="text" name="lang[' + j +
            ']" placeholder="Enter subject" class="form-control" /></td><td><h6><span><input type="radio" id="customRadioInline4" name="lang_type[' +
            j +
            ']" class=""  value="Beginner" checked="">  <label class="" for="customRadioInline4">Beginner</label></span>  <span><input type="radio" id="customRadioInline5" name="lang_type[' +
            j +
            ']" class="" value="Intermediate">  <label class="" for="customRadioInline5">Intermediate</label></span> <span><input type="radio" id="customRadioInline6" name="lang_type[' +
            j +
            ']" class="" value="Expert">  <label class="" for="customRadioInline6">Expert</label></span></h6></td><td><a href=""class="remove-input-field remove-field btn-remove-customer add-plus minus-icon"><span class="button_background_color"><img src="{{ asset('assets') }}/admin/images/minus-icon.png"></span></td></tr>'
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