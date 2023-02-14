<script>
    $("#headertable").hide();
    $(".navbar-brand").html("<center> SHOWROOM BSW</center>");
</script>

<title>SHOWROOM BSW</title>
<style>
    .as2 {
        margin-left: 25%;
    }
</style>
<div class="col-xs-12" style="padding:0px;margin-top:10px;">
    <div class="col-xs-6 as2" style="max-height:78vh;">
        <div id="accordion-season" class="panel-group" style="margin:0px;">

            <div class="panel panel-primary">
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="https://bswmalang.com/index.php?p=produksi&modul=rekap&action=input-test"
                            style="font-size:14px;color:white !important;">
                            <center>
                                MASTER BARANG
                            </center>
                        </a>

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="" style="font-size:14px;color:white !important;">
                            <center>
                                MASTER SUPPLIER
                        </a>

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="https://bswmalang.com/index.php?p=produksi&modul=rekap&action=po-showrom"
                            style="font-size:14px;color:white !important;">
                            <center>
                                PEMBELIAN BARANG / SPK

                        </a>

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="" style="font-size:14px;color:white !important;">
                            <center>
                                PEMBAYARAN
                            </center>
                        </a>

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="" style="font-size:14px;color:white !important;">
                            <center>
                                REKAP DATA PEMBELIAN
                            </center>
                        </a>

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="" style="font-size:14px;color:white !important;">
                            <center>
                                REKAP DATA PEMBAYARAN
                            </center>
                        </a>

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        {{-- <a class="accordion-toggle collapsed" data-toggle="collapse"
                            data-parent="#accordion-season" href="#season-<?= $d['season']; ?>" aria-expanded="false"
                            onclick="getDataBulan('<?= $no; ?>','<?= $d['season']; ?>')"
                            style="font-size:14px;color:white !important;">
                            <center>
                                CARI DATA
                            </center>
                        </a> --}}

                    </h6>
                </div>
                <div class="panel-heading" style="padding:8px;border:1px solid white;">
                    <h6 class="panel-title" style="font-weight:normal;padding:0px;">

                        <a href="https://bswmalang.com/" style="font-size:14px;color:white !important;">
                            <center>
                                HOME
                            </center>
                        </a>

                    </h6>
                </div>
                {{-- <div id="season-<?= $d['season']; ?>" class="panel-collapse collapse" aria-expanded="false"
                    style="height: 0px;">
                    <div class="panel-body" style="padding:2px;">
                        <div class="col-xs-12 bulan-<?= $d['season']; ?>" id="bulan-<?= $d['season']; ?>"
                            style="padding:0px;">

                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
</div>
<div id="ModalEdit" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="overflow:hidden;">

</div>
<div id="ModalEdit2" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="overflow:hidden;">

</div>
<div id="ModalEdit3" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="overflow:hidden;">

</div>
<div id="ModalEdit12345" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="overflow:hidden;">

</div>