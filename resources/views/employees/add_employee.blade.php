@extends('company.layouts.app')
@section('content')
@section('title', 'EVP - Onboarding-Employee')

<style>
    .doc {
        margin-top: 38px !important;
    }
</style>
<!--- Wapper Start ----->
<div class="wapper">
    <!--- Main Container Start ----->
    <div class="main-container">

        <div class="main-heading">
            <div class="row">
                <div class="col-md-12">
                    <h1>Onboarding</h1>
                    {{-- <p>Here’s your report overview by today</p> --}}
                </div>
            </div>
        </div>
        <!--- Main Heading ----->
        <div id="successMessage">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
        </div>
        
        <div class="employee-tab-bar">
            <ul class="nav nav-tabs table-responsive-width primary_color" role="tablist">
                <li class="nav-item">
                    <li class="nav-item">
                    <a class="nav-link @if (Request::segment(3) == null) active @endif  secondary_color" data-toggle="tab" href="#basicInformation" role="tab">Basic Info</a>
                   {{-- <a href="#hardware" data-toggle="tab"><strong>Hardware(s)</strong></a></li> --}}

                </li>
                {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Identity</a>
          </li> --}}
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(3) == 'qualification') active @endif secondary_color" data-toggle="tab" href="#qualification" role="tab">Qualification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(3) == 'workhistory') active @endif secondary_color" data-toggle="tab" href="#workhistory" role="tab">Work History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(3) == 'skills') active @endif secondary_color" data-toggle="tab" href="#skills" role="tab">Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link secondary_color" data-toggle="tab" href="#official" role="tab">Official Use</a>
                </li>

            </ul>
            <div class="tab-content">
                <div  class="tab-pane @if (Request::segment(3) == null) active @endif" id="basicInformation" role="tabpanel">
                    <div class="eml-persnal ">
                        <div class="add-emply-details">
                            @if (empty($employeeExists))
                                @include('employees.employee_basicinfo')
                            @else
                                @include('employees.edit_basicinfomation')
                            @endif
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="official" role="tabpanel">
                    <div class="eml-persnal ">
                      <div class="add-emply-details">                
                        <div class="row">
                          <div class="col-lg-12">
                            @if (empty($employeeOfficials))
                                @include('employees.employee_official_details')
                            @else
                                @include('employees.view_official_details')
                            @endif
                          </div>
                        </div>                
                      </div>
                    </div>
                </div> 
        
                <div class="tab-pane @if (Request::segment(3) == 'qualification') active @endif" id="qualification" role="tabpanel">
                    <div class="eml-persnal ">
                        <div class="add-emply-details">
                            <div class="row">
                                <div class="col-xl-12">
                                  {{-- <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#qualificationAdd"><img src="assets/images/button-plus-clr.png"> <small>Add</small></span></h2> --}}
                       
                                  <h2>Qualification <span class="ml-auto on-head-right" data-toggle="modal" data-target="#create_qualification" href="#" id="qualification_add"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                                @if (empty($qualificationExist))
                                    <p class="no-data-clg">No Data Available</p>
                                @else
                                    @include('employees.view_qualification')
                                @endif
                               </div>
                           </div>
                        </div>
                    </div>
                </div>

        
                <div class="tab-pane @if (Request::segment(3) == 'workhistory') active @endif" id="workhistory" role="tabpanel">
                  <div class="eml-persnal ">
                      <div class="add-emply-details">
                          <div class="row">
                              <div class="col-xl-12">
                             <h2>Work History <span class="ml-auto on-head-right" data-toggle="modal" data-target="#create_workhistory" href="#" id="workhistory_add"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small></span></h2>
                              @if (empty($workhistoryExists))
                                  <p class="no-data-clg">No Data Available</p>
                              @else
                                  @include('employees.view_workhistory')
                              @endif

                          </div>
                      </div>
                   </div>
                  </div>
                </div>

                <div class="tab-pane @if (Request::segment(3) == 'skills') active @endif" id="skills" role="tabpanel">
                    <div class="eml-persnal ">
                      <div class="add-emply-details">                
                        <div class="row">
                          <div class="col-lg-12">
                            @if (empty($employeeSkillsExists))
                                @include('employees.employee_skills')
                            @else
                                @include('employees.view_employee_skills')
                            @endif
                          </div>
                        </div>                
                      </div>
                    </div>
                </div>
            
            </div>
        </div>

    </div>
    <!--- Main Container Close ----->
</div>

<!--- Wapper Close ----->

<!-- The Modal Qualification Add -->
<div class="modal fade custu-modal-popup" id="create_qualification" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Qualification</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    @include('employees.employee_qualification')         
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Workhistory Add -->
<div class="modal fade custu-modal-popup" id="create_workhistory" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Workhistory</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    @include('employees.employee_workhistory')         
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('pagescript')

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    window.jQuery || document.write(
        '<script src="../../{{ asset('assets') }}/admin/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="{{ asset('assets') }}/admin/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/admin/js/file-upload.js"></script>
 {{-- <script src="{{ asset('assets') }}/admin/js/typeahead.min.js"></script>  --}}

<script>
    $(".selectBox").on("click", function(e) {
        $(this).toggleClass("show");
        var dropdownItem = e.target;
        var container = $(this).find(".selectBox__value");
        container.text(dropdownItem.text);
        $(dropdownItem)
            .addClass("active")
            .siblings()
            .removeClass("active");
    });
</script>

<script>
    // Initializes  input( name of states)
    // with a typeahead
    var $input = $(".typeahead");
    $input.typeahead({
        source: [
            "Css",
            "Css3",
            "Java",
            "Figma",
            "Html",
            "Html5",
            "Laravel",
            "Php",
            "ios",
            "React Js",
            "React Native",
        ],
        autoSelect: true,
    });

    $input.change(function() {
        var current = $input.typeahead("getActive");
        matches = [];

        if (current) {

            // Some item from your input matches
            // with entered data
            if (current.name == $input.val()) {
                matches.push(current.name);
            }
        }
    });
</script>

<script>
    var $input = $(".typeahead1");
    $input.typeahead({
        source: [
            "Bhojpuri",
            "Bengali",
            "English",
            "French",
            "Gujarati",
            "Hindi",
            "Russian",
            "Spanish",
            "Tamil",
        ],
        autoSelect: true,
    });

    $input.change(function() {
        var current = $input.typeahead("getActive");
        matches = [];

        if (current) {

            // Some item from your input matches
            // with entered data
            if (current.name == $input.val()) {
                matches.push(current.name);
            }
        }
    });
</script>

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

<script>
    $(document).ready(function() {

        $("#employee_basic_form").validate({

            rules: {
                first_name: "required",
                last_name: "required",
                email: "required",
                blood_group: "required",
                gender: "required",
                dob: "required",
                phone: "required",
                emg_phone: "required",
                permanent_address: "required",
                current_address: "required",
                marital_status: "required",
                emg_name: "required",
                emg_address: "required",
                emg_relationship: "required",
                document_type: "required",
                document_number: "required",
                document_id: "required",

            },

            messages: {
                firstName: "first name is required",
                last_name: "Last name is required",
                email: "Email is required",
                blood_group: "Blood group is required",
                gender: "Gender  is required",
                dob: "Date of birth is required",
                phone: "Phone number is required",
                emg_phone: "Emergency phone number is required",
                permanent_address: "Permanent address is required",
                current_address: "Current address is required",
                marital_status: "Marital status is required",
                emg_name: "Emergency name is required",
                emg_relationship: "Emergency relationship is required",
                emg_address: "Emergency address is required",
                document_id: "document id is required",
                document_number: "document number is required",
                document_type: "document type is required",

            }
        });

    });
</script>

@stop