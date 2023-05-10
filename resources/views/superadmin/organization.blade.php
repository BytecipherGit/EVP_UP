@extends('superadmin.layouts.app')
@section('content')
@section('title','EVP - Organization')
 
 <!--- Wapper Start ----->
 <div class="wapper">
  <!--- Main Container Start ----->
  <div class="main-container">
    <div class="main-heading">        
      <div class="row">
        <div class="col-md-12">
          <h1>Organization</h1>
        </div>
        <div class="col-md-0">
          
        </div>
      </div>
    </div><!--- Main Heading ----->

    <div class="employee-view-page">
      <div class="table-responsive">
          <div class="table-effect-box">
          </div>

          <table id="example" class="table-bordered nowrap table table-striped" style="width:100%">
              <thead class="primary_color">
                  <tr>
                      <th>Organization Id</th>
                      <th>Registration Date</th>
                      <th>Organization Name</th>
                      <th>Admin Name</th>
                      <th>Status</th>
                      <th>Action</th>

                  </tr>
              </thead>

              <tbody>
                  @foreach ($getCompany as $company)
                      <tr>
                          <td>#{{ $company->id }}</td>
                          <td>{{ $company->created_at->format('d-m-Y') }}</td>
                          <td>{{ $company->org_name }}</td>
                          <td>{{$company->name }}</td>
                          @if ($company->status == 1)
                              <td style="color:#5BD94E"><b>Verified</b></td>
                              {{-- <td><button class="pushme active-btn-bg">Verified</button></td> --}}
                              <td class="d-flex"><a href="organization_details/{{ $company->id }}"class="edit-btn fa fa-eye" data-title="Edit"></a>
                              @else
                              <td style="color:#ac2029"><b>Pending</b></td>
                              <td class="d-flex">
                              </td>
                          @endif
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>

  </div> <!--- Main Container Close ----->
</div>
<!--- Wapper Close ----->
</div> 


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script>
    window.jQuery || document.write('<script src="../../{{ asset('assets') }}/superadmin/js/vendor/jquery.min.js"><\/script>')
  </script>
  {{-- <script src="{{ asset('assets') }}/superadmin/js/bootstrap.min.js"></script>  --}}
  {{-- <script src="{{ asset('assets') }}/superadmin/js/pagination-script.js"></script> --}}
  
<script>
  $(document).ready(function() {

      setTimeout(function(){
        $('#successMessage').fadeOut('fast');
    }, 2000);

      var table = $('#example').DataTable({
          responsive: true,
          pagination: false
      });

      new $.fn.dataTable.FixedHeader(table);
  });
</script>

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

@endsection

