 <!--- Main Container Start ----->
  
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
                 
                  <div class="col-lg-12">

                    <form method="post">
                      @csrf
                      <div class="row">
                        <div class="col-xl-12 col-lg-6 col-md-12">
                          <div class="form-group">
                            <label>Date of Exit<span style="color:red">*</span></label>
                            <input type="date" name="date_of_exit" class="form-control" placeholder="Date" required>
                          </div>
                        </div>  

                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label>Reason for leaving<span style="color:red">*</span></label>
                            <textarea rows="3" name="reason_of_exit" class="form-control" required placeholder="Reason"></textarea>
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label>Rating</label>
                            <fieldset class="rating">
                              <input type="radio" id="textiles-star5" name="rating" value="5" />
                              <label class = "full" for="textiles-star5"></label>
                              <input type="radio" id="textiles-star4half" name="rating" value="4.5" />
                              <label class="half" for="textiles-star4half"></label>

                              <input type="radio" id="textiles-star4" name="rating" value="4" />
                              <label class = "full" for="textiles-star4" ></label>
                              <input type="radio" id="textiles-star3half" name="rating" value="3.5" />
                              <label class="half" for="textiles-star3half"></label>

                              <input type="radio" id="textiles-star3" name="rating" value="3" />
                              <label class = "full" for="textiles-star3"></label>
                              <input type="radio" id="textiles-star2half" name="rating" value="2.5" />
                              <label class="half" for="textiles-star2half" ></label>

                              <input type="radio" id="textiles-star2" name="rating" value="2" />
                              <label class = "full" for="textiles-star2"></label>
                              <input type="radio" id="textiles-star1half" name="textiles-rating" value="1.5" />
                              <label class="half" for="textiles-star1half" ></label>

                              <input type="radio" id="textiles-star1" name="rating" value="1" />
                              <label class = "full" for="textiles-star1"></label>
                              <input type="radio" id="textiles-starhalf" name="textiles-rating" value="0.5" />
                              <label class="half" for="textiles-starhalf"></label>

                            </fieldset>
                            {{-- <span class="theme-tem-active ml-2">(0.0)</span> --}}
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label>Review / Comment</label>
                            <textarea rows="3" name="review" class="form-control" placeholder="Review"></textarea>
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label>Decipline</label>
                            <textarea rows="3" name="decipline" class="form-control" placeholder="Decipline"></textarea>
                          </div>
                        </div>
                        @if($exitproces)
                          <div class="col-lg-12 col-md-12">
                            <label>Note for file uploads<span style="color:red">*</span></label></br>
                            <b>File type should be:</b> Only .jpeg, .pdf, .docs, or .doc files allowed. </br><b>File size should be:</b> Max:10MB</p>
                          </div>
                           @php $a = 0 @endphp
                          @foreach($exitprocess as $process)

                             <div class="col-md-12">
                                <div class="form-group">
                                  <input type="hidden" name="exit_process_id[]" value={{$process->id}}>
                                
                                    {{-- <label>{{$process->title}} --}}
                                      {{-- <input type="checkbox" name="status" class="switch-input" value="1"/> --}}
                                      {{-- <input type="hidden" name="status" value="0" /> --}}
                                    {{-- <input type="checkbox" name="status[{{ $a }}]"/>
                                    </label> --}}
                                    <label class="exitonboard"> <input type="checkbox" name="status[{{ $a }}]" class="checkboxexitform"/>   {{$process->title}} </label>
                                    {{-- <label>Document</label> --}}
                                    {{-- <div class="upload-img-file"> --}}
                                        <input type="file" id="document" name="document[]" class="form-control" accept="image/jpeg,image/doc,image/pdf" />
                                    {{-- </div> --}}
                                </div>  
                               </div>  
                              @php $a++ @endphp
                            @endforeach
                          @endif
                    </div>
                    </form>
                 
                  </div>
                </div>
                {{-- @endif --}}
              </div>
        </div>
      </div>
    <!--- Main Container Close ----->


