@if (session()->has('msg'))
    <div class="alert alert-success">
        {{ session()->get('msg') }}
    </div>
@endif

<div class="employee-tab-bar" style="margin:0;">
    <div class="eml-persnal ">
        <div class="add-emply-details exit-custom-page">
            <div class="row">
                <input type="hidden" id="is_add" value="{{ $employee ? '' : 1 }}" />
                <input type="hidden" id="employee_id" name="employee_id" value="{{ $employee ? $employee->id : '' }}" />
                <div class="col-lg-12">
                    @if (empty($offerSendRecord))
                        <form method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text"  name="name" value="{{ $employee->first_name . '  ' . $employee->last_name }}" class="form-control readonly" placeholder="Name" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control readonly" value="{{ $employee->email }}"  placeholder="Email" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="phone" name="phone" class="form-control readonly" value="{{ $employee->phone }}"  placeholder="Phone" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea rows="3" name="comment" class="form-control" placeholder="Comment"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Document<span style="color:red">*</span></label>
                                        <input type="file" id="document" name="document" class="form-control" accept="image/jpeg,image/doc,image/pdf" />
                                        <strong class="error" id="document-error"></strong>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                </div>
            </div>
            {{-- @endif --}}
        </div>
    </div>
</div>
<!--- Main Container Close ----->
