@extends('layouts.admin')
@section('header','Penerimaan / Reciv')


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
            <span class="card-label fw-bolder fs-3 mb-1">Penerimaan / Reciv</span>
        </h3>
        {{-- <div class="card-toolbar">
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
        </div> --}}
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table
                class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline data-table"
                role="grid">
                <!--begin::Table head-->
                <thead>

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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form class="form" id="dataForm" name="dataForm">
                    <input type="hidden" name="idPo" id="idPo">
                    <div class="card-body">
                        <div class="form-group row mb-5">
                            <div class="col-lg-3">
                                <label>Nomor PO / SPK:</label>
                                <input type="text" id="NomorPO" name="NomorPO" class="form-control"
                                    placeholder="Enter PO / SPK" />
                            </div>
                            <div class="col-lg-3">
                                <label>PPn (%):</label>
                                <input type="text" id="PPn" name="PPn" class="form-control"
                                    placeholder="Enter your PPn" />
                            </div>
                            <div class="col-lg-3">
                                <label>Menyetujui:</label>
                                <input type="text" id="Menyetujui" name="Menyetujui" class="form-control"
                                    placeholder="Enter your Menyutujui" />
                            </div>
                            <div class="col-lg-3">
                                <label>Jenis PPn:</label>
                                <input type="text" id="JenisPPn" name="JenisPPn" class="form-control"
                                    placeholder="Enter your Jenis PPn" />
                            </div>
                        </div>
                        <div class="form-group row pt-5 mb-5">
                            <div class="col-lg-3">
                                <label>Nama Supplier:</label>
                                {{-- <input type="text" id="NamaSupplier" name="NamaSupplier" class="form-control"
                                    placeholder="Enter Nama Supplier" /> --}}
                                <select class="form-control selectpicker" data-size="7" data-live-search="true"
                                    id="NamaSupplier" name="NamaSupplier" required>
                                    <option data-tokens="-">-</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label>Tanggal PO:</label>
                                {{-- <input type="text" id="TanggalPO" name="TanggalPO" class="form-control"
                                    placeholder="Enter your Tanggal PO" /> --}}
                                <div id="datetimepicker1" class="input-append date">
                                    <input data-format="dd/MM/yyyy hh:mm:ss" id="date" name="tgl" type="date"></input>
                                    <span class="add-on">
                                        <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                        </i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>Nilai Discount:</label>
                                <input type="text" id="Discount" name="Discount" class="form-control"
                                    placeholder="Enter your Tanggal Nilai Discount" />
                            </div>
                            <div class="col-lg-2">
                                <label>Kategori:</label>
                                {{-- <input type="text" id="Kategori" name="Kategori" class="form-control"
                                    placeholder="Enter your Kategori" /> --}}
                                <select class="form-control selectpicker" id="Kategori" name="Kategori"
                                    title="Choose one of the following..." required tabindex="null">
                                    <option title="Enter your Kategori">-</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label>Currency:</label>
                                {{-- <input type="text" id="Currency" name="Currency" class="form-control"
                                    placeholder="Enter your Kategori" /> --}}
                                <select class="form-control selectpicker" id="Currency" name="Currency"
                                    title="Enter your Currency" required tabindex="null">
                                    <option title="Enter your Currency">-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 text-end">
                                <a href="javascript:void(0)" id="addDetail" onclick="addDetail()"
                                    class="btn btn-success addMore"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        {{--
                        <hr> --}}
                        <div class="border-top my-3"></div>
                        <h3>Details PO</h3>
                        <div class="table-responsive">
                            <div class="form-group row">
                                <div class="col-12">
                                    <table class="table table-separate" id="table-so">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <!-- <th scope="col">Code Item</th> -->
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody id="body-so">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6 button-group">
                                <button type="submit" hidden="true" id="saveBtn"
                                    class="btn btn-primary mr-2">Save</button>
                                <button type="submit" hidden="true" id="updateBtn"
                                    class="btn btn-primary mr-2">Update</button>
                            </div>
                            <div class="col-lg-6 text-end">
                                <button type="reset" class="btn btn-danger" onclick="cancel()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeadingView"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h1>List Penerimaan</h1>
                    <div class="form-group row mb-5">
                        <div class="col-lg-4">
                            <label>Nama Supplier:</label>
                            <input type="text" id="NamaSupplierMitra" class="form-control" placeholder="Nama Supplier"
                                readonly />
                        </div>
                        <div class="col-lg-4">
                            <label>Tanggal Rcvd:</label>
                            <input type="text" id="tglRcvd" class="form-control" readonly />
                        </div>
                        <div class="col-lg-4">
                            <label>No. SJ:</label>
                            <input type="text" id="nosj" class="form-control" placeholder="Enter your Menyutujui"
                                readonly />
                        </div>

                    </div>
                </div>
                <div class="row" id="row-data-details">

                </div>
                <div class="row">
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table
                                class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline data-view"
                                role="grid">
                                <!--begin::Table head-->
                                <thead>
                                    <tr>
                                        <th>kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th style="text-align: right;">Harga</th>
                                        <th style="text-align: right;">Total</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody id="body-view">

                                </tbody>
                                <!--end::Table body-->
                                <tfoot id="total-details">

                                </tfoot>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                </div>
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
        },
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        scrollY: 500,
        scrollX: true,
        ajax: "{{ route('showroom.penerimaan.index') }}",
        columns: [
            {
                title:'Nama Supplier',
                data: 'Mitra'
            },
            {
                title:'Tanggal',
                data: 'created_at',
            },
            {
                title:'No. Sj',
                data: 'nosj',
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
        url:  '{{ route("showroom.po.create") }}', 
        success: function(data) { 
            // $('#jurusan').html(response); 
            // console.log(data);
            // const htmlData = ``;
            $.each(data.JenisPO, function(key, value){
                $('#Kategori').append(`<option value="`+value.nama+`">`+value.nama+`</option>`);
            });
            $.each(data.Currency, function(key, value){
                $('#Currency').append(`<option value="`+value.nama+`">`+value.nama+`</option>`);
            });
            $.each(data.NamaSupplier, function(key, value){
                $('#NamaSupplier').append(`<option data-tokens="`+value.namasup+`" value="`+value.namasup+`">`+value.namasup+`</option>`);
            });
        }
    });
    $('#createNew').click(function () {
        $('#ItemId').val('');
        $('#addDetail').show();
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Create New PO");
        $('#ajaxModel').modal('show');
        
        if($('#saveBtn').attr('hidden')=='true'){
            // console.log('ada1');
            $('#saveBtn').attr('hidden', true);
        }else{
            $('#saveBtn').attr('hidden', false);
            $('#updateBtn').attr('hidden', true)
            // console.log('gaada');
        }
    });

    $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Save');
        // console.log($('#dataForm').serialize());
        $.ajax({
            data: $('#dataForm').serialize(),
            url: "{{ route('showroom.po.store') }}",
            type: "POST",
            dataType: 'json',
            async: true,
            success: function (data) {
                console.log(data);
                if(data.status == 200){
                    $('#dataForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
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

    $('body').on('click', '.editData', function (e) {
        e.preventDefault();
        var ItemsId = $(this).data('id');
        $('#addDetail').hide();
        if($('#updateBtn').attr('hidden')=='true'){
            // console.log('ada1');
            $('#updateBtn').attr('hidden', true);
        }else{
            $('#updateBtn').attr('hidden', false);
            $('#saveBtn').attr('hidden', true);
            // console.log('gaada');
        }

        $.get("{{ route('showroom.po.index') }}" + '/' + ItemsId + '/edit', function (data) {
            // console.log(data.data_detail);
            $('#modelHeading').html("Edit Items");
            $('#idPo').val(data.data_head.idpo);
            $('#ajaxModel').modal('show');
            $('#NomorPO').val(data.data_head.nopo);
            $('#PPn').val(data.data_head.ppn);
            $('#Menyetujui').val(data.data_head.ttd);
            $('#JenisPPn').val(data.data_head.JenisPPn);
            $('#NamaSupplier').val(data.data_head.Mitra).change();
            $('#date').val(data.data_head.tgl);
            $('#Discount').val(data.data_head.Discount);
            $('#Kategori').val(data.data_head.Kat).change();
            $('#Currency').val(data.data_head.Currency).change();

            // var lineNo = 1;
            // lineNo++;
            $('#table-so').show();
            $('#body-so').html('');
            $.each(data.data_details, function(key, value){
                markup = `<tr id="row-`+key+`">`
                            +`<td data-id=""></td><input type="hidden"name="details[idDetails][]" value="`+value.idpo+`" class="form-control"
                                    placeholder="Enter your Kode Barang" />`
                            +
                            `<td><input type="text" id="kodeBarang" name="details[kodeBarang][]" value="`+value.kodebrg+`" class="form-control"
                                    placeholder="Enter your Kode Barang" /></td>
                            <td><input type="text" id="NamaBarang"  name="details[NamaBarang][]" value="`+value.NamaBrg+`" class="form-control"
                                    placeholder="Enter your Nama Barang" /></td>
                            <td><input type="text" id="qty" name="details[qty][]" value="`+value.qty+`" class="form-control"
                                    placeholder="Enter your qty" /></td>
                            <td><input type="text" id="satuan" name="details[satuan][]" value="`+value.satuan+`" class="form-control"
                                    placeholder="Enter your Satuan" /></td>
                            <td><input type="text" id="Harga" name="details[Harga][]" value="`+value.harga+`" class="form-control"
                                    placeholder="Enter your Harga" /></td>
                            <td><input readonly type="text" id="Total" name="details[Total][]" value="`+value.total+`" class="form-control form-control-solid"
                                    placeholder="ReadonlyTotal" /></td>
                            <td><a href="javascript:void(0)" onclick="deleteDetail(`+key+`, `+value.idpo+`)" class="btn btn-danger addMore"><i
                                            class="fas fa-trash"></i></a></td>  
                                    `
                        +`<tr>`;
                            tableBody = $("#body-so").append(markup);
                // alert(value);
            });
        })
    });
    // $('#viewDetails').on('click',function(){
    $('body').on('click', '.viewDetails', function (e) {
        // alert('sadas');
        const dataId = $(this).data('id');       
        $.ajax({
            url: `{{ url('showroom/penerimaan/${dataId}') }}`,
            type: "GET",
            dataType: 'json',
            beforeSend: function() {
                swal.fire({
                    html: '<h5>Loading...</h5>',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                $('#body-view').html('');
                $('#row-data-details').html('');
                $('#modelHeadingView').html("Details PO");
            },
            success: function (data) {
                swal.close();
                // console.log(data);
                //
                $('#NamaSupplierMitra').val(data.data_head.Mitra);
                $('#tglRcvd').val(data.data_head.tglRcvd);
                $('#nosj').val(data.data_head.nosj);
                Total(data.data_details);

                $.each(data.data_details, function(key, value){
                    // console.log(value);
                    markup = `
                        <tr>
                            <td>`+value.kodebrg+`</td>
                            <td>`+value.NamaBrg+`</td>
                            <td>`+value.qty+`</td>
                            <td>`+value.satuan+`</td>
                            <td style="text-align: right;">`+value.harga+`</td>
                            <td style="text-align: right;">`+value.total+`</td>
                        </tr>
                        
                        `;
                        $("#body-view").append(markup);
                });
                const button_data = `
                    <div class="col-2">
                        <a class="btn btn-warning" style="width:100%" href="javascript:void(0)" id="Previous" onclick="Previous(`+dataId+`)">
                            <i class="fa fa-arrow-left"></i>
                            Previous</a>
                    </div>
                    <div class="col-2">
                        <a class="btn btn-primary" style="width:100%" href="javascript:void(0)" id="Next" onclick="Next(`+dataId+`)">
                            Next
                            <i class="fa fa-arrow-right"></i>
                            </a>
                    </div>
                    <div class="col-2">
                        <a class="btn btn-info" style="width:100%"  href="javascript:void(0)" id="Min" onclick="Min(`+dataId+`)">Min</a>
                    </div>
                    <div class="col-2">
                        <a class="btn btn-secondary" style="width:100%"  href="javascript:void(0)" id="Max" onclick="Max(`+dataId+`)">Max</a>
                    </div>
                    <div class="col-2">
                        <a class="btn btn-success" style="width:100%">Home</a>
                    </div>
                    <div class="col-2">
                        <a class="btn btn-danger" style="width:100%" href="javascript:void(0)" id="Close" onclick="Close()">Close</a>
                    </div>
                `;
                $('#row-data-details').append(button_data);
                $('#viewModal').modal('show');
            },
            error: function (data) {
                // console.log('Error:', data);
                // $('#saveBtn').html('Save Changes');
                Swal.fire(
                    'Filed is Reuired',
                    'That thing is still around?',
                    'error'
                );
            }
        });
    });

    $('#updateBtn').click(function (e) {
            e.preventDefault();
        // $(this).html('Save');
        // console.log($('#dataForm').serialize());
        const idPo = $('#idPo').val();
        $.ajax({
            data: $('#dataForm').serialize(),
            url: `{{ url('showroom/po/${idPo}') }}`,
            type: "PUT",
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
                    url: `{{ url('showroom/po/${SiteId}')}}`,
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
});
var lineNo = 0;

function addDetail(){
        // this.form.reset();
    
        const NomorPO = $('#NomorPO').val();
        const PPn = $('#PPn').val();

        const Menyetujui = $('#Menyetujui').val();
        const qty = $('#qty').val();
        const JenisPPn = $('#JenisPPn').val();
        // const total = qty * price;
        const NamaSupplier = $('#NamaSupplier').val();
        const TanggalPO = $('#TanggalPO').val();
        const Kategori = $('#Kategori').val();
            $('#table-so').show();
            markup = `<tr id="row-`+lineNo+`">`
                        +`<td data-id="`+`">`+lineNo+ `</td>`
                        +
                        `<td><input type="text" id="kodeBarang" name="details[kodeBarang][]" class="form-control"
                                placeholder="Enter your Kode Barang" /></td>
                        <td><input type="text" id="NamaBarang"  name="details[NamaBarang][]" class="form-control"
                                placeholder="Enter your Nama Barang" /></td>
                        <td><input type="text" id="qty" name="details[qty][]" class="form-control"
                                placeholder="Enter your qty" /></td>
                        <td><input type="text" id="satuan" name="details[satuan][]" class="form-control"
                                placeholder="Enter your Satuan" /></td>
                        <td><input type="text" id="Harga" name="details[Harga][]" class="form-control"
                                placeholder="Enter your Harga" /></td>
                        <td><input readonly type="text" id="Total" name="details[Total][]" class="form-control form-control-solid"
                                placeholder="Readonly Total" /></td>
                        <td><a href="javascript:void(0)" onclick="removeDetail(`+lineNo+`)" class="btn btn-danger addMore"><i
                                        class="fas fa-trash"></i></a></td>  
                                `
                    +`<tr>`
                ;
            tableBody = $("#body-so").append(markup);
}

function removeDetail(rowIndex){
    $('#row-'+rowIndex).remove();
};
function deleteDetail(key, id){

    Swal.fire({
            title: 'Do you want to Delete?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                console.log(id);
                $.ajax({
                    type: "DELETE",
                    url: `{{ url('showroom/delete-detail/${id}')}}`,
                    success: function (data) {
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
                $('#row-'+key).remove();
            }
        });

}
function Next(id){
    // console.log(id);
    $.ajax({
        url: `{{ url('showroom/penerimaan/next/${id}') }}`,
        type: "GET",
        dataType: 'json',
        beforeSend: function() {
            swal.fire({
                html: '<h5>Loading...</h5>',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('#body-view').html('');
            $('#row-data-details').html('');
            $('#modelHeadingView').html("Details Penerimaan");
        },
        success: function (data) {
            swal.close();
            $('#NamaSupplierMitra').val(data.data_head.Mitra);
            $('#tglRcvd').val(data.data_head.tglRcvd);
            $('#nosj').val(data.data_head.nosj);
            Total(data.data_details);

            $.each(data.data_details, function(key, value){
                // console.log(value);
                    markup = `
                            <tr>
                                <td>`+value.kodebrg+`</td>
                                <td>`+value.NamaBrg+`</td>
                                <td>`+value.qty+`</td>
                                <td>`+value.satuan+`</td>
                                <td style="text-align: right;">`+value.harga+`</td>
                                <td style="text-align: right;">`+value.total+`</td>
                            </tr>
                            `;
                    $("#body-view").append(markup);
            });
            const button_data = 
            `
                <div class="col-2">
                    <a class="btn btn-warning" style="width:100%" href="javascript:void(0)" id="Previous" onclick="Previous(`+data.data_head.idrcvd+`)">
                        <i class="fa fa-arrow-left"></i>
                        Previous</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-primary" style="width:100%" href="javascript:void(0)" id="Next" onclick="Next(`+data.data_head.idrcvd+`)"> 
                        Next
                        <i class="fa fa-arrow-right"></i>
                        </a>
                </div>
                <div class="col-2">
                    <a class="btn btn-info" style="width:100%"  href="javascript:void(0)" id="Min" onclick="Min(`+data.data_head.idrcvd+`)">Min</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-secondary" style="width:100%"  href="javascript:void(0)" id="Max" onclick="Max(`+data.data_head.idrcvd+`)">Max</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-success" style="width:100%">Home</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" style="width:100%" href="javascript:void(0)" id="Close" onclick="Close()">Close</a>
                </div>
            `;
            $('#row-data-details').append(button_data);
            $('#viewModal').modal('show');    
        },
        error: function (data) {
            // console.log('Error:', data);
            // $('#saveBtn').html('Save Changes');
            Swal.fire(
                'Filed is Reuired',
                'That thing is still around?',
                'error'
            );
        }
    });
}
function Previous(id){
    $.ajax({
        url: `{{ url('showroom/penerimaan/previous/${id}') }}`,
        type: "GET",
        dataType: 'json',
        beforeSend: function() {
            swal.fire({
                html: '<h5>Loading...</h5>',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('#body-view').html('');
            $('#row-data-details').html('');
            $('#modelHeadingView').html("Details Penerimaan");
        },
        success: function (data) {
            swal.close();
            $('#NamaSupplierMitra').val(data.data_head.Mitra);
            $('#tglRcvd').val(data.data_head.tglRcvd);
            $('#nosj').val(data.data_head.nosj);
            Total(data.data_details);

            $.each(data.data_details, function(key, value){
                // console.log(value);
                    markup = `
                            <tr>
                                <td>`+value.kodebrg+`</td>
                                <td>`+value.NamaBrg+`</td>
                                <td>`+value.qty+`</td>
                                <td>`+value.satuan+`</td>
                                <td style="text-align: right;">`+value.harga+`</td>
                                <td style="text-align: right;">`+value.total+`</td>
                            </tr>
                            `;
                    $("#body-view").append(markup);
            });
            const button_data = 
            `
                <div class="col-2">
                    <a class="btn btn-warning" style="width:100%" href="javascript:void(0)" id="Previous" onclick="Previous(`+data.data_head.idrcvd+`)">
                        <i class="fa fa-arrow-left"></i>
                        Previous</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-primary" style="width:100%" href="javascript:void(0)" id="Next" onclick="Next(`+data.data_head.idrcvd+`)"> 
                        Next
                        <i class="fa fa-arrow-right"></i>
                        </a>
                </div>
                <div class="col-2">
                    <a class="btn btn-info" style="width:100%"  href="javascript:void(0)" id="Min" onclick="Min(`+data.data_head.idrcvd+`)">Min</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-secondary" style="width:100%"  href="javascript:void(0)" id="Max" onclick="Max(`+data.data_head.idrcvd+`)">Max</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-success" style="width:100%">Home</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" style="width:100%" href="javascript:void(0)" id="Close" onclick="Close()">Close</a>
                </div>
            `;
            $('#row-data-details').append(button_data);
            $('#viewModal').modal('show');    
        },
        error: function (data) {
            // console.log('Error:', data);
            // $('#saveBtn').html('Save Changes');
            Swal.fire(
                'Filed is Reuired',
                'That thing is still around?',
                'error'
            );
        }
    });
}
function Min(id){
    // console.log(id);   
    $.ajax({
        url: `{{ url('po/min') }}`,
        type: "GET",
        dataType: 'json',
        beforeSend: function() {
            swal.fire({
                html: '<h5>Loading...</h5>',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('#body-view').html('');
            $('#row-data-details').html('');
            $('#modelHeadingView').html("Details PO");
        },
        success: function (data) {
            swal.close();
            
            // swal.close();
            Total(data.data_details);
            //
            $('#deatilNomorPO').val(data.data_head.nopo);
            $('#deatilPPn').val(data.data_head.ppn);
            $('#deatilMenyetujui').val(data.data_head.ttd);
            $('#deatilJenisPPn').val(data.data_head.JenisPPn);
            $('#deatilNamaSupplier').val(data.data_head.Mitra);
            $('#deatildate').val(data.data_head.tgl);
            $('#deatilDiscount').val(data.data_head.Discount);
            $('#deatilKategori').val(data.data_head.Kat);
            $('#deatilCurrency').val(data.data_head.Currency);

            $.each(data.data_details, function(key, value){
                // console.log(value);
                    markup = `
                            <tr>
                                <td>`+value.kodebrg+`</td>
                                <td>`+value.NamaBrg+`</td>
                                <td>`+value.qty+`</td>
                                <td>`+value.satuan+`</td>
                                <td>`+value.harga+`</td>
                                <td>`+value.total+`</td>
                            </tr>
                            `;
                    $("#body-view").append(markup);
            });
            const button_data = 
            `
                <div class="col-2">
                    <a class="btn btn-warning" style="width:100%" href="javascript:void(0)" id="Previous" onclick="Previous(`+data.data_head.idpo+`)">
                        <i class="fa fa-arrow-left"></i>
                        Previous</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-primary" style="width:100%" href="javascript:void(0)" id="Next" onclick="Next(`+data.data_head.idpo+`)">
                        Next
                        <i class="fa fa-arrow-right"></i>
                        </a>
                </div>
                <div class="col-2">
                    <a class="btn btn-info" style="width:100%"  href="javascript:void(0)" id="Min" onclick="Min(`+data.data_head.idpo+`)">Min</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-secondary" style="width:100%"  href="javascript:void(0)" id="Max" onclick="Max(`+data.data_head.idpo+`)">Max</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-success" style="width:100%">Home</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" style="width:100%" href="javascript:void(0)" id="Close" onclick="Close()">Close</a>
                </div>
            `;
            $('#row-data-details').append(button_data);
            $('#viewModal').modal('show');    
        },
        error: function (data) {
            console.log('Error:', data);
            // $('#saveBtn').html('Save Changes');
            Swal.fire(
                'Filed is Reuired',
                'That thing is still around?',
                'error'
            );
        }
    });
}
function Max(id){
    // console.log(id);   
    $.ajax({
        url: `{{ url('po/max') }}`,
        type: "GET",
        dataType: 'json',
        beforeSend: function() {
            swal.fire({
                html: '<h5>Loading...</h5>',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $('#body-view').html('');
            $('#row-data-details').html('');
            $('#modelHeadingView').html("Details PO");
        },
        success: function (data) {
            swal.close();
            
            // swal.close();
            Total(data.data_details);
            //
            $('#deatilNomorPO').val(data.data_head.nopo);
            $('#deatilPPn').val(data.data_head.ppn);
            $('#deatilMenyetujui').val(data.data_head.ttd);
            $('#deatilJenisPPn').val(data.data_head.JenisPPn);
            $('#deatilNamaSupplier').val(data.data_head.Mitra);
            $('#deatildate').val(data.data_head.tgl);
            $('#deatilDiscount').val(data.data_head.Discount);
            $('#deatilKategori').val(data.data_head.Kat);
            $('#deatilCurrency').val(data.data_head.Currency);

            $.each(data.data_details, function(key, value){
                // console.log(value);
                    markup = `
                            <tr>
                                <td>`+value.kodebrg+`</td>
                                <td>`+value.NamaBrg+`</td>
                                <td>`+value.qty+`</td>
                                <td>`+value.satuan+`</td>
                                <td>`+value.harga+`</td>
                                <td>`+value.total+`</td>
                            </tr>
                            `;
                    $("#body-view").append(markup);
            });
            const button_data = 
            `
                <div class="col-2">
                    <a class="btn btn-warning" style="width:100%" href="javascript:void(0)" id="Previous" onclick="Previous(`+data.data_head.idpo+`)">
                        <i class="fa fa-arrow-left"></i>
                        Previous</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-primary" style="width:100%" href="javascript:void(0)" id="Next" onclick="Next(`+data.data_head.idpo+`)">
                        Next
                        <i class="fa fa-arrow-right"></i>
                        </a>
                </div>
                <div class="col-2">
                    <a class="btn btn-info" style="width:100%"  href="javascript:void(0)" id="Min" onclick="Min(`+data.data_head.idpo+`)">Min</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-secondary" style="width:100%"  href="javascript:void(0)" id="Max" onclick="Max(`+data.data_head.idpo+`)">Max</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-success" style="width:100%">Home</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-danger" style="width:100%" href="javascript:void(0)" id="Close" onclick="Close()">Close</a>
                </div>
            `;
            $('#row-data-details').append(button_data);
            $('#viewModal').modal('show');    
        },
        error: function (data) {
            // console.log('Error:', data);
            // $('#saveBtn').html('Save Changes');
            Swal.fire(
                'Filed is Reuired',
                'That thing is still around?',
                'error'
            );
        }
    });
}
function Total(data){
    $('#total-details').html('');
    var qty_total = 0;
    var harga_total = 0;
    var total_total = 0;
    $.each(data, function(key,val){
        qty_total +=parseInt(val.qty);
        harga_total +=parseInt(val.harga);
        total_total +=parseInt(val.total);


    });
    // return console.log([qty_total, harga_total, total_total]);
    var html_data = 
    `
    <tr>
        <td style="font-weight:bold;">Total</td>
        <td style="font-weight:bold;">&nbsp;</td>
        <td style="font-weight:bold;">`+qty_total+`,00</td>
        <td style="font-weight:bold;">&nbsp;</td>
        <td style="font-weight:bold; text-align: right;">`+harga_total+`,00</td>
        <td style="font-weight:bold; text-align: right;">`+total_total+`,00</td>
    </tr>
    `
    $('#total-details').append(html_data);
}
function Close(){
    $('#viewModal').modal('hide');
}
function cancel(){
    $('#ajaxModel').modal('hide');
    $('#body-so').html('');
}
</script>
@endsection