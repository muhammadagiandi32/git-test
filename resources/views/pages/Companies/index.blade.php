@extends('layouts.admin')
@section('header','Company')


@section('css')
    <!-- dataTables -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
@endsection

@section('content')
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Company</span>
        </h3>
        <div class="card-toolbar">
            <a href="javascript:void(0)" id="createNew" class="btn btn-sm btn-light-primary">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->Create</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-4 data-table">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="min-w-50px">#</th>
                        <th class="min-w-125px">Company Name</th>
                        <th class="min-w-125px">Address</th>
                        <th class="min-w-125px">City</th>
                        <th class="min-w-125px">Post Code</th>
                        <th class="min-w-125px">Phone</th>
                        <th class="min-w-125px">Fax</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">User Created</th>
                        <th class="min-w-125px">Created At</th>
                        <th class="min-w-125px">Updated At</th>
                        <th class="min-w-200px text-end rounded-end"></th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--begin::Body-->
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="dataForm" name="dataForm" class="form-horizontal">
                   <input type="hidden" name="CompanyId" id="CompanyId">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyName" name="CompanyName" placeholder="Enter Site" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyAddress" name="CompanyAddress" placeholder="Enter Address" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyCity" name="CompanyCity" placeholder="Enter Address2" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Post Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyPostCode" name="CompanyPostCode" placeholder="Enter Warehose" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyPhone" name="CompanyPhone" placeholder="Enter Warehose" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyFax" name="CompanyFax" placeholder="Enter Warehose" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="CompanyEmail" name="CompanyEmail" placeholder="Enter Warehose" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10 mt-3">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  
<script type="text/javascript">
   
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('companies.index') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'CompanyName'},
            {data: 'CompanyAddress'},
            {data: 'CompanyCity'},
            {data: 'CompanyPostCode'},
            {data: 'CompanyPhone'},
            {data: 'CompanyFax'},
            {data: 'CompanyEmail'},
            {data: 'UserCreated'},
            {data: 'tglBuat'},
            {data: 'tglUpdate'},
            {data: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNew').click(function () {
        $('#saveBtn').html("Submit");
        $('#SiteId').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Create New Company");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editData', function () {
      var CompanyId = $(this).data('id');
      $.get("{{ route('companies.index') }}" +'/' + CompanyId +'/edit', function (data) {
          $('#modelHeading').html("Edit Company");
          $('#saveBtn').html("Submit");
          $('#ajaxModel').modal('show');
          $('#CompanyId').val(data.CompanyId);
          $('#CompanyName').val(data.CompanyName);
          $('#CompanyAddress').val(data.CompanyAddress);
          $('#CompanyCity').val(data.CompanyCity);
          $('#CompanyPostCode').val(data.CompanyPostCode);
          $('#CompanyPhone').val(data.CompanyPhone);
          $('#CompanyFax').val(data.CompanyFax);
          $('#CompanyEmail').val(data.CompanyEmail);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
    
        $.ajax({
          data: $('#dataForm').serialize(),
          url: "{{ route('companies.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#dataForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
              Swal.fire(
                        'Succes',
                        'Your data saved successfully !!',
                        'success'
                    );
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteData', function () {
     
        var CompanyId = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('companies.store') }}"+'/'+CompanyId,
            success: function (data) {
                table.draw();
                Swal.fire(
                        'Succes',
                        'Your data has been removed !!',
                        'success'
                    );
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
@endsection