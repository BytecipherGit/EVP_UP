 <div class="row">
     <div class="col-xl-6">
         <div class="col-xl-12">
             <h2>Skills <span class="ml-auto on-head-right" data-toggle="modal" data-target="#add_skills"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"><small>Add</small> </span></h2>
         </div>
 
         <div class="eml-per-main">
             <div class="table-responsive">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>Skill Name</th>
                             <th>Competency Levels</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     @foreach ($employeeSkillsViewExists as $employeeSkills)
                         <tr>
                             <td>{{ $employeeSkills->skill }}</td>
                             <td>{{ $employeeSkills->skill_type }}</td>
                             <td><button type="button" class="border-none" data-toggle="modal" data-target="#edit_skills{{ $employeeSkills->id }}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button></td>
                         </tr>
                     @endforeach
                     <tbody>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <div class="col-xl-6">
         <div class="col-xl-12">
             <h2>Language <span class="ml-auto on-head-right" data-toggle="modal" data-target="#add_skills_Language"><img src="{{ asset('assets') }}/admin/images/button-plus-clr.png"> <small>Add</small> </span></h2>
         </div>
         <div class="eml-per-main">
             <div class="table-responsive">
                 <table class="table">
                     <thead>
                         <tr>
                             <th>Language</th>
                             <th>Competency Levels</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     @foreach ($employeeLanguageViewExists as $employeeSkills)
                           <tr>
                             <td>{{ $employeeSkills->lang }}</td>
                             <td>{{ $employeeSkills->lang_type }}</td>
                             <td><button type="button" class="border-none" data-toggle="modal" data-target="#edit_language{{ $employeeSkills->id }}"><img src="{{ asset('assets') }}/admin/images/edit-icon.png"></button>
                          </td>
                         </tr>
                     @endforeach
                     <tbody>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>

 <!-- The Modal Skills Add -->
<div class="modal fade custu-modal-popup" id="add_skills" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Skills</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <form id="employee_skills_form_edit" action="{{ url('add_employee_skills/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeSkillsExists ? $employeeSkillsExists->employee_id : '' }}" />
               <div class="modal-body">
                   <div class="comman-body">
                        <div class="form-group inputtag-custom">
                            <label>Add Skill</label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" name="skill" class="form-control input-search-box typeahead" data-provide="typeahead" placeholder="Language">
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" name="skill_type" id="customRadioInline4" class="" value="Beginner" checked="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>

                                        <span><input type="radio" name="skill_type" id="customRadioInline5" value="Intermediate" class="">
                                            <label class=""for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" name="skill_type" id="customRadioInline6" value="Expert" class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="customer_records_dynamic"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
            </div>
          </form>
        </div>
    </div>
</div>

<!-- The Modal Language Add -->
<div class="modal fade custu-modal-popup" id="add_skills_Language" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Add Language</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form id="employee_lang_form_edit" action="{{ url('add_employee_lang_skills/submit') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeSkillsExists ? $employeeSkillsExists->employee_id : '' }}" />
                        <div class="form-group inputtag-custom">
                            <label>Add Language</label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" name="lang" class="form-control input-search-box typeahead1" data-provide="typeahead" placeholder="Language">
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" id="customRadioInline4" name="lang_type"value="Beginner" class="" checked="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>
                                        <span><input type="radio" id="customRadioInline5" name="lang_type" value="Intermediate" class="">
                                            <label class="" for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" id="customRadioInline6" name="lang_type" value="Expert" class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="customer_records_dynamic1"></div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- The Modal Skill Edit -->
@foreach ($employeeLanguageViewExists as $employeeSkills)

<div class="modal fade custu-modal-popup" id="edit_language{{ $employeeSkills->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Language</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <div class="modal-body">
                <div class="comman-body">
                    <form id="employee_lang_submit" action="{{ url('edit_language/update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeSkillsExists ? $employeeSkillsExists->employee_id : '' }}" />
                        <div class="form-group inputtag-custom">
                            <label>Add Language</label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" name="lang" value="{{ $employeeSkills ? $employeeSkills->lang : ''}}" class="form-control input-search-box typeahead1" data-provide="typeahead" placeholder="Language">
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" id="customRadioInline4" name="lang_type" value="Beginner"   <?php  if ($employeeSkills->lang_type == 'Beginner') { ?> checked <?php } ?> class="" checked="">
                                            <label class="" for="customRadioInline4">Beginner</label></span>
                                        <span><input type="radio" id="customRadioInline5" name="lang_type" value="Intermediate" <?php  if ($employeeSkills->lang_type == 'Intermediate') { ?> checked <?php } ?> class="">
                                            <label class="" for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" id="customRadioInline6" name="lang_type" value="Expert"  <?php  if ($employeeSkills->lang_type == 'Expert') { ?> checked <?php } ?> class="">
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="customer_records_dynamic1"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

 <!-- The Modal Skills Edit -->
 @foreach ($employeeSkillsViewExists as $employeeSkills)
 <div class="modal fade custu-modal-popup" id="edit_skills{{ $employeeSkills->id  }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Edit Skills</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets') }}/admin/images/close-btn-icon.png">
                </button>
            </div>
            <form id="employee_skills_update" action="{{ url('edit_skills/update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="employee_id" name="employee_id" value="{{ $employeeSkillsExists ? $employeeSkillsExists->employee_id : '' }}" />
               <div class="modal-body">
                   <div class="comman-body">
                        <div class="form-group inputtag-custom">
                            <label>Add Skill</label>
                            <div class="row customer_records1">
                                <div class="col-md-8">
                                    <input type="text" name="skill" class="form-control input-search-box typeahead"  value="{{ $employeeSkills ? $employeeSkills->skill : ''}}"  data-provide="typeahead" placeholder="Language">
                                </div>
                                <div class="col-md-8">
                                    <h6>
                                        <span><input type="radio" name="skill_type" id="customRadioInline4" class="" value="Beginner" <?php if ($employeeSkills->skill_type == 'Beginner') { ?> checked <?php } ?>>
                                            <label class="" for="customRadioInline4">Beginner</label></span>
                                        <span><input type="radio" name="skill_type" id="customRadioInline5" value="Intermediate" class="" <?php  if ($employeeSkills->skill_type == 'Intermediate') { ?> checked <?php } ?>>
                                            <label class=""for="customRadioInline5">Intermediate</label></span>
                                        <span><input type="radio" name="skill_type" id="customRadioInline6" value="Expert" class="" <?php  if ($employeeSkills->skill_type == 'Expert') { ?> checked <?php } ?>>
                                            <label class="" for="customRadioInline6">Expert</label></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="customer_records_dynamic"></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary-cust" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn-primary-cust button_background_color"><span class="button_text_color">Save</span></button>
            </div>
          </form>
        </div>
    </div>
</div>
@endforeach

