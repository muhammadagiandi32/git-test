@extends('layouts.admin')

@section('content')
<div class="card">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Heading-->
        <div class="card-px text-center pt-15 pb-15">
            <!--begin::Title-->
            <h2 class="fs-2x fw-bolder mb-0">Welcome to Module Showroom BSW Malang</h2>
            <!--end::Title-->
            <!--begin::Description-->
            <p class="text-gray-400 fs-4 fw-bold py-7">Menu yang sudah aktif
                <!-- <br>a upgrade plan example. -->
            </p>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ url('showroom/master-items') }}" class="btn btn-primary btn-lg"
                        style="width: 100%;">Master
                        Barang</a></li>
                <li class="list-group-item"><a href="{{ url('showroom/po') }}" class="btn btn-primary btn-lg"
                        style="width: 100%;">PO Showroom</a>
                </li>
                <li class="list-group-item"><a href="{{ url('showroom/penerimaan') }}" class="btn btn-primary btn-lg"
                        style="width: 100%;">Penerimaan
                        Barang</a></li>
                <li class="list-group-item"><button class="btn btn-primary btn-lg" style="width: 100%;">Pembayaran
                        Tagihan</button>
                </li>
                <li class="list-group-item"><button class="btn btn-primary btn-lg" style="width: 100%;">Rekap Data
                        Tagihan</button>
                </li>
                <li class="list-group-item"><button class="btn btn-primary btn-lg" style="width: 100%;">Rekap
                        Pembayaran</button>
                </li>
            </ul>
            <!--end::Description-->
            <!--begin::Action-->
            <!-- <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a> -->
            <!--end::Action-->
        </div>
        <!--end::Heading-->
        <!--begin::Illustration-->
        <div class="text-center pb-15 px-5">
            <img src="assets/media/illustrations/sketchy-1/8.png" alt="" class="mw-100 h-200px h-sm-325px">
        </div>
        <!--end::Illustration-->
    </div>
    <!--end::Card body-->
</div>
@endsection

@section('js')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
    integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>

@endsection