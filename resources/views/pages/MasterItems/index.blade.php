@extends('layouts.admin')
@section('header','Master Item Showroom')


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
            <span class="card-label fw-bolder fs-3 mb-1">Master Item</span>
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
                <!--end::Svg Icon-->Create
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-4 data-uom data-table">
                <!--begin::Table head-->
                <thead>
                    {{-- <tr class="fw-bolder text-muted bg-light">
                        <th class="min-w-50px">#</th>
                        <th class="min-w-125px">Kode Barang</th>
                        <th class="min-w-200px">Nama Barang</th>
                        <th class="min-w-150px">Jenis ID</th>
                        <th class="min-w-150px">Created</th>
                        <th class="min-w-150px">User Created</th>

                        <th class="min-w-200px text-end rounded-end"></th>
                    </tr> --}}
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
                    <input type="hidden" name="ItemId" id="ItemId">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Kode Barang</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="KodeBarang" name="KodeBarang"
                                placeholder="Enter Kode Barang" value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nama Barang</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control select" id="NamaBarang" name="NamaBarang"
                                placeholder="Enter Nama Barang" value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Jenis ID</label>
                        <div class="col-sm-12">
                            {{-- <input type="text" class="form-control select" id="JenisId" name="JenisId"
                                placeholder="Enter Jenis ID" value="" maxlength="50" required=""> --}}
                            <div class="dropdown bootstrap-select form-control">
                                <select class="form-control selectpicker" id="JenisId" name="JenisId"
                                    title="Choose one of the following..." required tabindex="null">
                                    <option title="Combo 3">-</option>
                                </select>
                            </div>
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
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
        scrollY: 500,
        scrollX: true,
        ajax: "{{ route('showroom.master-items.index') }}",
        columns: [
            {
                title:'Kode Barang',
                data: 'kode_barang'
            },
            {
                title:'Nama Barang',
                data: 'nama_barang',
            },
            {
                title:'Jenis ID',
                data: 'jenis_id',
            },
            {
                title:'Action',
                data: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    $.ajax({
        type: 'GET', 
        url:  '{{ route("showroom.master-items.create") }}', 
        success: function(data) { 
            // $('#jurusan').html(response); 
            // console.log(response);
            const htmlData = ``;
            $.each(data, function(key, value){
                $('#JenisId').append(`<option value="`+value.nama+`">`+value.nama+`</option>`);
            });
        }
    });
    $('#createNew').click(function () {
            $('#saveBtn').html("Submit");
            $('#ItemId').val('');
            $('#dataForm').trigger("reset");
            $('#modelHeading').html("Create New Master Item");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editData', function () {
        var ItemsId = $(this).data('id');
            // console.log(ItemsId);

        $.get("{{ route('showroom.master-items.index') }}" +'/' + ItemsId +'/edit', function (data) {
            // console.log(data);
            $('#modelHeading').html("Edit Items");
            $('#saveBtn').html("Submit");
            $('#ajaxModel').modal('show');
            $('#ItemId').val(data.id_barang);
            $('#KodeBarang').val(data.kode_barang);
            $('#NamaBarang').val(data.nama_barang);
            $('#JenisId').val(data.jenis_id);
        })
    });
    $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Save');
        
        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ route('showroom.master-items.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                if(data.status == 200){
                    $('#dataForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    // alert('Data saved successfully');
                    Swal.fire(
                        'Succes',
                        'Your Data Hasben Created !!',
                        'success'
                    );
                }
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
                Swal.fire(
                    'Filed is Reuired',
                    'That thing is still around?',
                    'error'
                );
            }
        });
    });
    $('body').on('click', '.deleteData', function () {
        var SiteId = $(this).data("id");
        // confirm("Are You sure want to delete !");
        Swal.fire({
            title: 'Do you want to Delete?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                // console.log(SiteId);
                $.ajax({
                    type: "DELETE",
                    url: `{{ url('showroom/master-items/${SiteId}')}}`,
                    success: function (data) {
                        table.draw();
                        Swal.fire(
                            'Succes',
                            'Your Data Hasben Delete !!',
                            'success'
                        );
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });

    // <option class="bs-title-option" selected="" value="">Please Select Jenis ID</option>
    //                                 <option title="Combo 1">Hot Dog, Fries and a Soda</option>
    //                                 <option title="Combo 2">Burger, Shake and a Smile</option>
    //                                 <option title="Combo 3">Sugar, Spice and all things nice</option>
    
});

</script>
@endsection