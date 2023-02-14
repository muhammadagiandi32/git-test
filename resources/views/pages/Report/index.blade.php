@extends('layouts.admin')
@section('header','Report')


@section('css')
<!-- dataTables -->
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
--}}
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->

{{--
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
    integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="card mb-5 mb-xl-12">
    <form id="formSearch">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Report</span>
            </h3>
            <div class="col-lg-12">
                <div class="form-group row mb-5">
                    <div class="col-lg-3">
                        <label>Date 1:</label>
                        <input autocomplete="off" type="text" name="date1" id="datepicker" class="form-control" />
                    </div>
                    <div class="col-lg-3">
                        <label>Date 2:</label>
                        <input autocomplete="off" type="text" name="date2" id="datepicker2" class="form-control" />
                    </div>
                    <div class="col-lg-3">
                        <label>Jenis Report:</label>
                        <select class="form-control selectpicker" name="jenisReport" tabindex="null">
                            <option value="-">-</option>
                            <option value="PO">List PO</option>
                            <option value="PEMBELIAN">Pembelian</option>
                            <option value="PENERIMAAN">Penerimaan</option>
                            <option value="PEMBAYARAN">Pembayaran</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <button type="submit" class="btn btn-primary form-control">Cari</button>
                    </div>
                    <div class="col-lg-1">
                        <br>
                        <a href="https://bswmalang.com/admin" class="btn btn-primary form-control">Back</a>
                    </div>
                </div>
            </div>
    </form>
</div>
<!--end::Header-->
<!--begin::Body-->
<div class="card-body py-3">
    <!--begin::Table container-->
    <div class="table-responsive" style="max-height: 450px">
        <!--begin::Table-->
        <table id="table-data" class="table">
            <thead style="position: sticky;top: 0" class="bg-light text-center">

            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-center">

            </tbody>
            <!--end::Table body-->
            <!--begin::Table foot-->
            <tfoot style="position: sticky;bottom: 0" class="bg-light">

            </tfoot>
            <!--end::Table foot-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Table container-->
</div>
<!--begin::Body-->
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
                            <label>No. PO:</label>
                            <input type="text" id="nopo" class="form-control" placeholder="Enter your Menyutujui"
                                readonly />
                        </div>
                        <div class="col-lg-4">
                            <label>Tanggal Order:</label>
                            <input type="text" id="tglOrder" class="form-control" readonly />
                        </div>
                        <div class="col-lg-4">
                            <label>Nama Supplier:</label>
                            <input type="text" id="NamaMitra" class="form-control" placeholder="Nama Supplier"
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
                                <thead style="position: sticky;top: 0" class="bg-light">
                                    <tr>
                                        <th>kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th class='text-end'>Qty PO</th>
                                        <th class='text-end'>Qty Receipt</th>
                                        <th class='text-end'>Qty Balance</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody id="body-view">

                                </tbody>
                                <!--end::Table body-->
                                <tfoot style="position: sticky;top: 0" class="bg-light" id="total-details">

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

<div class="modal fade" id="viewModalPembelian" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeadingView"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h1>List Pembelian Barang</h1>
                    <div class="form-group row mb-5">
                        <div class="col-lg-4">
                            <label>Kode Barang:</label>
                            <input type="text" id="KodeBarang" class="form-control" placeholder="Enter your Menyutujui"
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
                                <thead style="position: sticky;top: 0" class="bg-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Tanggal Order</th>
                                        <th>Qty PO</th>
                                        <th>Qty Receipt</th>
                                        <th>Qty Balance</th>
                                        <th>Nama Supplier</th>
                                        <th>No PO</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody id="body-view-pembelian">

                                </tbody>
                                <!--end::Table body-->
                                <tfoot style="position: sticky;top: 0" class="bg-light" id="total-details-pembelian">

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

<div class="modal fade" id="viewModalPenerimaan" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeadingView"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h1>List Penerimaan Barang</h1>
                    <div class="form-group row mb-5">
                        <div class="col-lg-4">
                            <label>Kode Barang:</label>
                            <input type="text" id="KodeBarangPenerimaan" class="form-control"
                                placeholder="Enter your Menyutujui" readonly />
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <label>Nama Barang:</label>
                            <input type="text" id="NamaBarang" class="form-control" placeholder="Nama Supplier"
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
                                <thead style="position: sticky;top: 0" class="bg-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Tanggal Terima</th>
                                        <th>Qty Terima</th>
                                        <th>Nama Supplier</th>
                                        <th>No PO</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody id="body-view-penerimaan">

                                </tbody>
                                <!--end::Table body-->
                                <tfoot style="position: sticky;top: 0" class="bg-light" id="total-details-penerimaan">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
    integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).ready(function(){
    $('#datepicker').datepicker({ 
        dateFormat: "yy-mm-dd" 
    });
    $('#datepicker2').datepicker({ 
        dateFormat: "yy-mm-dd" 
    });

    // $('#table-data').DataTable({
    //     scrollY: '200px',
    //     scrollCollapse: true,
    //     paging: false,
    //     order: 1,
    //     searching: false,
    //     lengthChange:false,
    //     info:false,
    // });
    $('#formSearch').submit(function(e){
        e.preventDefault();
        // console.log($( this ).serialize());
        var data_form = $( this ).serialize();
        if($('select[name="jenisReport"]').val()=='PO'){
            // console.log('ini PO');
            var thead =  $('#table-data').find('thead');
            var tbody=  $('#table-data').find('tbody');
            thead.html('');
            tbody.html('');
            $.ajax({
                data: $('#dataForm').serialize(),
                url: "{{ route('showroom.report.post.po') }}",
                type: "POST",
                dataType: 'json',
                async: true,
                data:$( this ).serialize(),
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function (data) {
                    // console.log(data);
                    swal.close();
                    var append_thead=
                    ` <tr>
                        <th>Nomor PO</th>
                        <th>Mitra</th>
                        <th>Tanggal</th>
                        <th>PPn</th>
                        <th>Jenis PPn</th>
                        <th>Jenis PO</th>
                        <th>Currency</th>
                        <th class='text-end'>Nilai PO</th>
                        <th class='text-end'>Nilai Terima</th>
                        <th class='text-end'>Nilai Pembayaran</th>
                        <th>Action</th>
                    </tr>`;
                    thead.append(append_thead);
                    // Total(data);
                    $.each(data, function(key, value){
                        var  apped_tbody= 
                            `<tr>
                                <td scope="row">`+value.nopo+`</td>
                                <td>`+value.sup+`</td>
                                <td>`+value.tgl_po+`</td>
                                <td>`+value.ppn+`</td>
                                <td>`+value.jenis_ppn+`</td>
                                <td>`+value.Kat+`</td>
                                <td>`+value.cur+`</td>
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.Total)+`</td>
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.total_terima)+`</td>
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.total_bayar)+`</td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="`+value.nopo+`" data-jenis="`+$('select[name="jenisReport"]').val()+`" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>
                                </td>
                            </tr>
                            `;
                        tbody.append(apped_tbody);
                    });
                    var tfoot=  $('#table-data').find('tfoot');
                    
                    tfoot.html('');
                    var Total = 0;
                    var Total_terima = 0;
                    var Total_bayar = 0;
                    $.each(data, function(key,val){
                        Total +=parseInt(val.Total);
                        Total_terima +=isNaN(parseInt(val.total_terima)) ? 0 : parseInt(val.total_terima);
                        Total_bayar += isNaN(parseInt(val.total_bayar)) ? 0 : parseInt(val.total_bayar);
                    });
                    var  apped_tfoot= 
                        `<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='text-end'>`+Total.toLocaleString()+`</td>
                            <td class='text-end'>`+Total_terima.toLocaleString()+`</td>
                            <td class='text-end'>`+Total_bayar.toLocaleString()+`</td>
                            <td></td>
                        </tr>
                        `;
                    tfoot.append(apped_tfoot);
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
        }
        else if($('select[name="jenisReport"]').val()=='PEMBELIAN'){
            console.log('ini Pembelian');
            var thead =  $('#table-data').find('thead');
            var tbody=  $('#table-data').find('tbody');
            var tfoot=  $('#table-data').find('tfoot');

            thead.html('');
            tbody.html('');
            tfoot.html('');
            
            $.ajax({
                data: $('#dataForm').serialize(),
                url: "{{ route('showroom.report.post.po') }}",
                type: "POST",
                dataType: 'json',
                async: true,
                data:$( this ).serialize(),
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function (data) {
                    console.log(data);
                    swal.close();
                    var append_thead=
                    ` <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th style='text-align:right'>Nilai Barang</th>
                        <th>Action</th>
                    </tr>`;
                    thead.append(append_thead);
                    
                    $.each(data, function(key, value){
                        var  apped_tbody= 
                            `<tr>
                                <td>`+value.kodebrg+`</td>
                                <td>`+value.NamaBrg+`</td>
                                <td>`+value.satuan+`</td>
                                <td>`+value.qty+`</td>
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.total)+`</td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="`+value.poid+`" data-jenis="`+$('select[name="jenisReport"]').val()+`" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>
                                </td>
                            </tr>
                            `;
                        tbody.append(apped_tbody);
                    });

                    var Total = 0;
                    var Total_terima = 0;
                    var Total_bayar = 0;
                    $.each(data, function(key,val){
                        Total +=parseInt(val.total);
                        Total_terima +=isNaN(parseInt(val.qty)) ? 0 : parseInt(val.qty);
                        // Total +=isNaN(parseInt(val.Total)) ? 0 : parseInt(val.Total);
                        
                    });
                    var  apped_tfoot= 
                        `<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='text-center'>`+Total_terima.toLocaleString()+`</td>
                            <td class='text-end'>`+new Intl.NumberFormat('en-ID').format(Total)+`</td>
                            <td></td>
                        </tr>
                        `;
                    tfoot.append(apped_tfoot);
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
        }
        else if($('select[name="jenisReport"]').val()=='PEMBAYARAN'){
            // console.log('ini Pembayaran');
            var thead =  $('#table-data').find('thead');
            var tbody=  $('#table-data').find('tbody');
            var tfoot=  $('#table-data').find('tfoot');

            thead.html('');
            tbody.html('');
            tfoot.html('');
            $.ajax({
                data: $('#dataForm').serialize(),
                url: "{{ route('showroom.report.post.po') }}",
                type: "POST",
                dataType: 'json',
                async: true,
                data:$( this ).serialize(),
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function (data) {
                    console.log(data);
                    swal.close();  
                    var append_thead=
                    `<tr>
                        <th>Supplier</th>
                        <th>No PO</th>
                        <th>Tanggal PO</th>
                        <th>Currency</th>
                        <th style='text-align:right'>Nilai PO</th>
                        <th style='text-align:right'>Nilai Tagihan</th>
                        <th style='text-align:right'>Sisa Tagihan</th>
                    </tr>`;
                    thead.append(append_thead);

                    $.each(data, function(key, value){
                        var  apped_tbody= 
                            `<tr>
                                <td>`+value.sup+`</td>
                                <td>`+value.nopo+`</td>
                                <td>`+value.tgl_po+`</td> 
                                <td>`+value.cur+`</td> 
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.nilai_PO)+`</td>
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.total_tagihan)+`</td>
                                <td style='text-align:right'>`+new Intl.NumberFormat('en-ID').format(value.sisa)+`</td>
                            </tr>
                            `;
                        tbody.append(apped_tbody);
                    });
                    var tfoot=  $('#table-data').find('tfoot');
                    
                    tfoot.html('');
                    var Total = 0;
                    var Total_terima = 0;
                    var Total_bayar = 0;
                    $.each(data, function(key,val){
                        Total +=parseInt(val.nilai_PO);
                        Total_terima +=isNaN(parseInt(val.total_tagihan)) ? 0 : parseInt(val.total_tagihan);
                        Total_bayar += isNaN(parseInt(val.sisa)) ? 0 : parseInt(val.sisa);
                    });
                    var  apped_tfoot= 
                        `<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='text-end'>`+Total.toLocaleString()+`</td>
                            <td class='text-end'>`+Total_terima.toLocaleString()+`</td>
                            <td class='text-end'>`+Total_bayar.toLocaleString()+`</td>
                        </tr>
                        `;
                    tfoot.append(apped_tfoot);
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
        }
        else if($('select[name="jenisReport"]').val()=='PENERIMAAN'){
            // console.log('ini PENERIMAAN');

            var thead =  $('#table-data').find('thead');
            var tbody=  $('#table-data').find('tbody');
            var tfoot=  $('#table-data').find('tfoot');

            thead.html('');
            tbody.html('');
            tfoot.html('');

            $.ajax({
                data: $('#dataForm').serialize(),
                url: "{{ route('showroom.report.post.po') }}",
                type: "POST",
                dataType: 'json',
                async: true,
                data:$( this ).serialize(),
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                },
                success: function (data) {
                    console.log(data);
                    swal.close();  var append_thead=
                    ` <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>`;
                    thead.append(append_thead);

                    $.each(data, function(key, value){
                        var  apped_tbody= 
                            `<tr>
                                <td>`+value.kodebrg+`</td>
                                <td>`+value.NamaBrg+`</td>
                                <td>`+value.satuan+`</td>
                                <td>`+new Intl.NumberFormat('en-US').format(value.qty)+`</td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="`+value.kodebrg+`" data-jenis="`+$('select[name="jenisReport"]').val()+`" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>
                                </td>
                            </tr>
                            `;
                        tbody.append(apped_tbody);
                    });
                    
                    var Total_qty = 0;
                    $.each(data, function(key,val){
                        Total_qty +=parseInt(val.qty);
                    });
                    var  apped_tfoot= 
                        `<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='text-center'>`+Total_qty.toLocaleString()+`</td>
                            <td></td>
                        </tr>
                        `;
                    tfoot.append(apped_tfoot);
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
        }
        else{
            // console.log('ini Gaada HAHAH');
            Swal.fire(
                'Filed is Reuired',
                'That thing is still around?',
                'error'
            );
        }
    });

    $('body').on('click', '.viewDetails', function(e){
        const dataId=  $(this).data('id');
        const dataJenis=$(this).data('jenis');
        // console.log(dataId);

        // $('#viewModal').modal('show');
        if(dataJenis == 'PO'){
            $.ajax({
                url: `{{ route('showroom.report.get.detail') }}`,
                type: "POST",
                data:{
                    'id':dataId,
                    'dataJenis':dataJenis
                },
                dataType: 'json',
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $('#nopo').val('');
                    $('#tglOrder').val('');
                    $('#NamaMitra').val('');
                    $('#body-view').html('');
                    $('#total-details').html('');
                },
                success: function (data) {
                    swal.close();
                    console.log(data);
                    if(data.length==0){
                        Swal.fire(
                            'Failed Request',
                            'That thing is still around?',
                            'error'
                        );
                    }else{
                        $('#nopo').val(data[0].nopo);
                        $('#tglOrder').val(data[0].tgl);
                        $('#NamaMitra').val(data[0].sup);
                        $.each(data, function(key, value){
                            const data_details = ` 
                                <tr>
                                    <td>`+value.kodebrg+`</td>
                                    <td>`+value.NamaBrg+`</td>
                                    <td class='text-end'>`+value.qty_PO+`</td>
                                    <td class='text-end'>`+value.qty_receipt+`</td>
                                    <td class='text-end'>`+new Intl.NumberFormat('en-US').format(value.Total_qty)+`</td>
                                </tr>
                            `;
                            $('#body-view').append(data_details);
                        });
                        var qty_PO_total = 0;
                        var qty_receipt_totsl = 0;
                        var qty_balance_total = 0;
                        $.each(data, function(key,val){
                            qty_PO_total +=parseInt(val.qty_PO);
                            qty_receipt_totsl +=parseInt(val.qty_receipt);
                            qty_balance_total += parseInt(val.Total_qty);
                        });
                        var apped_tfoot = 
                        `<tr>
                            <td></td>
                            <td></td>
                            <td class='text-end'>`+qty_PO_total.toLocaleString()+`</td>
                            <td class='text-end'>`+qty_receipt_totsl.toLocaleString()+`</td>
                            <td class='text-end'>`+qty_balance_total.toLocaleString()+`</td>
                        </tr>`;
                        $('#total-details').append(apped_tfoot);

                        $('#viewModal').modal('show');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                    Swal.fire(
                        'Failed Request',
                        'That thing is still around?',
                        'error'
                    );
                }
            });
        }else if(dataJenis == 'PEMBELIAN'){
            console.log('ini pembelian');
            $.ajax({
                url: `{{ route('showroom.report.get.detail') }}`,
                type: "POST",
                data:{
                    'id':dataId,
                    'dataJenis':dataJenis
                },
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $('#nopo').val('');
                    $('#tglOrder').val('');
                    $('#NamaMitra').val('');
                    $('#body-view-pembelian').html('');
                    $('#total-details-pembelian').html('');
                },
                success: function (data) {
                    swal.close();
                    console.log(data);
                    if(data.length==0){
                        Swal.fire(
                            'Failed Request',
                            'That thing is still around?',
                            'error'
                        );
                    }else{
                        $('#KodeBarang').val(data[0].kodebrg);
                        // $('#tglOrder').val(data[0].tgl);
                        // $('#NamaMitra').val(data[0].sup);
                        $.each(data, function(key, value){
                            // var Total_qty = value.qty_po - value.qty_terima;
                            // console.log(value.qty_po);
                            // console.log(value.qty_terima);

                            const data_details = ` 
                                <tr>
                                    <td>`+value.rcvdid+`</td>
                                    <td>`+value.tgl+`</td>
                                    <td>`+new Intl.NumberFormat('en-US').format(value.qty_po)+`</td>
                                    <td>`+new Intl.NumberFormat('en-US').format(value.qty_terima)+`</td>
                                    <td>`+new Intl.NumberFormat('en-US').format(value.Total_qty)+`</td>
                                    <td>`+value.sup+`</td>
                                    <td>`+value.nopo+`</td>
                                </tr>
                            `;
                            $('#body-view-pembelian').append(data_details);
                        });
                        var qty_PO_total = 0;
                        var qty_receipt_totsl = 0;
                        var qty_balance_total = 0;
                        $.each(data, function(key,val){
                            qty_PO_total +=parseInt(val.qty_po);
                            qty_receipt_totsl +=parseInt(val.qty_terima);
                            qty_balance_total += parseInt(val.Total_qty);
                        });
                        var apped_tfoot = 
                        `<tr>
                            <td></td>
                            <td></td>
                            <td>`+qty_PO_total.toLocaleString()+`</td>
                            <td>`+qty_receipt_totsl.toLocaleString()+`</td>
                            <td>`+qty_balance_total.toLocaleString()+`</td>
                            <td></td>
                            <td></td>
                            </tr>`;
                        $('#total-details-pembelian').append(apped_tfoot);
                        
                        $('#viewModalPembelian').modal('show');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                    Swal.fire(
                        'Failed Request',
                        'That thing is still around?',
                        'error'
                    );
                }
            });
        }else if(dataJenis == 'PENERIMAAN'){
            console.log('this penerimaan');
            $.ajax({
                url: `{{ route('showroom.report.get.detail') }}`,
                type: "POST",
                data:{
                    'id':dataId,
                    'dataJenis':dataJenis
                },
                dataType: 'json',
                beforeSend: function() {
                    swal.fire({
                        html: '<h5>Loading...</h5>',
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $('#total-details-pembelian').html('');
                    $('#body-view-penerimaan').html('');

                },
                success: function (data) {
                    swal.close();
                    console.log(data);
                    if(data.length==0){
                        Swal.fire(
                            'Failed Request',
                            'That thing is still around?',
                            'error'
                        );
                    }else{
                        $('#KodeBarangPenerimaan').val(data[0].kodebrg);
                        $('#NamaBarang').val(data[0].NamaBrg);

                        $.each(data, function(key, value){
                            const data_details = ` 
                                <tr>
                                    <td>`+value.rcvdid+`</td>
                                    <td>`+value.tglRcvd+`</td>
                                    <td>`+new Intl.NumberFormat('en-US').format(value.qty)+`</td>
                                    <td>`+value.Mitra+`</td>
                                    <td>`+value.nopo+`</td>
                                </tr>
                            `;
                            $('#body-view-penerimaan').append(data_details);
                        });

                        $('#total-details-penerimaan').html('');
                        var Total = 0;
                        $.each(data, function(key,val){
                            Total +=parseInt(val.qty);
                        });
                        var  apped_tfoot= 
                            `<tr>
                                <td></td>
                                <td></td>
                                <td class='text-start'>`+Total.toLocaleString()+`</td>
                                <td></td>
                                <td></td>
                            </tr>
                            `;
                        $('#total-details-penerimaan').append(apped_tfoot);
                        $('#viewModalPenerimaan').modal('show');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                    Swal.fire(
                        'Failed Request',
                        'That thing is still around?',
                        'error'
                    );
                }
            });
        }
    });
});
// function Total(data){
//     // console.log(data);

// }
</script>
@endsection