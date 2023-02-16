<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // if ($request->ajax()) {
        //     $data =  DB::table('T_PO_Head_Showroom');
        //     return DataTables::of($data)
        //         ->addColumn('action', function ($row) {

        //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->idpo . '" data-original-title="View" class="edit btn btn-primary btn-sm viewData">View</a>';

        //             // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_barang . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';

        //             return $btn;
        //         })
        //         ->toJson();
        // }
        return view('pages.Report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if ($request->ajax()) {
            $data =  DB::table('T_PO_Detail_Showroom')->get();
            return response()->json($data);
        }
        return view('pages.Report.index');
    }
    public function po(Request $request)
    {
        //
        DB::enableQueryLog();
        if ($request->ajax()) {
            if ($request->jenisReport == 'PO') {
                $total_bayar =  DB::table('T_PO_Showroom_head')
                    ->leftJoin('T_Bayar', 'T_Bayar.Nopo', 'T_PO_Showroom_head.nopo')
                    ->selectRaw('sum(T_Bayar.nilaitagihan) as nilaitagihan,T_Bayar.Nopo')
                    ->groupBy('T_PO_Showroom_head.nopo');

                $total_PO = DB::table('T_PO_Showroom_Detail')
                    ->selectRaw('
                        T_PO_Showroom_Detail.nopo as nopo,
                        sum(T_PO_Showroom_Detail.total) as Total_PO
                ')->groupBy('T_PO_Showroom_Detail.nopo');
                $total_terima = DB::table('T_RcvdDetail_Showroom')
                    ->selectRaw(
                        '
                        T_RcvdDetail_Showroom.nopo as nopo,
                        sum(T_RcvdDetail_Showroom.total) as total_terima
                        '
                    )
                    ->groupBy('T_RcvdDetail_Showroom.nopo');

                $data =  DB::table('T_PO_Showroom_head')
                    ->leftJoinSub($total_PO, 'T_total_PO', function ($join) {
                        $join->on('T_total_PO.nopo', '=', 'T_PO_Showroom_head.nopo');
                    })
                    ->leftJoinSub($total_terima, 'T_total_Terima', function ($join) {
                        $join->on('T_total_Terima.nopo', '=', 'T_PO_Showroom_head.nopo');
                    })
                    ->leftJoinSub($total_bayar, 'T_total_bayar', function ($join) {
                        $join->on('T_total_bayar.nopo', '=', 'T_PO_Showroom_head.nopo');
                    })
                    ->selectRaw(
                        '
                            T_PO_Showroom_head.nopo,
                            T_PO_Showroom_head.tgl_po,
                            T_PO_Showroom_head.sup,
                            T_PO_Showroom_head.cur,
                            T_PO_Showroom_head.ppn,
                            T_PO_Showroom_head.jenis_ppn,
                            T_PO_Showroom_head.Kat,
                            T_total_PO.Total_PO as Total,
                            T_total_Terima.total_terima as total_terima,
                            T_total_bayar.nilaitagihan as total_bayar,
                            CASE 
                                WHEN T_total_PO.Total_PO - T_total_bayar.nilaitagihan IS NULL THEN T_total_PO.Total_PO
                                ELSE T_total_PO.Total_PO - T_total_bayar.nilaitagihan
                            END Balance
                        '
                    )
                    ->where('T_PO_Showroom_head.Kat', 'PO')
                    ->whereBetween('T_PO_Showroom_head.tgl_po', [$request->date1, $request->date2])
                    ->groupBy('T_PO_Showroom_head.nopo')
                    ->orderBy('T_PO_Showroom_head.nopo', 'DESC')
                    ->get();
                return response()->json($data);
            } else if ($request->jenisReport == 'PENERIMAAN') {
                $data = DB::table('T_RcvdDetail_Showroom')
                    ->leftJoin('T_RcvdBrg_Head', 'T_RcvdDetail_Showroom.idrcvd', 'T_RcvdBrg_Head.idrcvd')
                    ->selectRaw(
                        '
                        T_RcvdDetail_Showroom.kodebrg,
                        T_RcvdDetail_Showroom.NamaBrg,
                        T_RcvdDetail_Showroom.satuan,
                        sum(T_RcvdDetail_Showroom.qty) as qty,
                        T_RcvdDetail_Showroom.idrcvd as poid
                        '
                    )
                    ->whereBetween('T_RcvdBrg_Head.tglRcvd', [$request->date1, $request->date2])
                    ->groupBy('T_RcvdDetail_Showroom.kodebrg')
                    ->orderBy('T_RcvdDetail_Showroom.kodebrg', 'DESC')
                    ->get();
                return response()->json($data);
            } else if ($request->jenisReport == 'PEMBELIAN') {

                $data = DB::table('T_PO_Showroom_Detail')
                    ->leftJoin('T_PO_Showroom_head', 'T_PO_Showroom_Detail.nopo', 'T_PO_Showroom_head.nopo')
                    ->selectRaw(
                        '
                        T_PO_Showroom_Detail.kode as kodebrg,
                        T_PO_Showroom_Detail.nama as NamaBrg,
                        T_PO_Showroom_Detail.sat as satuan,
                    sum(T_PO_Showroom_Detail.qty) as qty,
                    T_PO_Showroom_Detail.kode as poid,
                    sum(T_PO_Showroom_Detail.total) as total
                    '
                    )
                    ->groupBy('T_PO_Showroom_Detail.kode')
                    ->whereBetween('T_PO_Showroom_head.tgl_po', [$request->date1, $request->date2])
                    // ->orderBy('T_PO_Showroom_Detail.kode', 'DESC')
                    ->get();
                return response()->json($data);
            } else if ($request->jenisReport == 'PEMBAYARAN') {
                $table_BAYAR = DB::table('T_Bayar')
                    ->leftJoin('T_PO_Showroom_head', 'T_PO_Showroom_head.nopo', 'T_Bayar.nopo')
                    ->selectRaw(
                        '
                        T_Bayar.nopo as nopo,
                        sum(T_Bayar.nilaitagihan) as total_tagihan
                        '
                    )
                    ->groupBy('T_PO_Showroom_head.nopo');

                $data = DB::table('T_PO_Showroom_head')
                    ->leftJoin('T_PO_Showroom_Detail', 'T_PO_Showroom_Detail.nopo', 'T_PO_Showroom_head.nopo')
                    ->leftJoinSub($table_BAYAR, 'T_total_bayar', function ($join) {
                        $join->on('T_total_bayar.nopo', '=', 'T_PO_Showroom_head.nopo');
                    })
                    ->selectRaw(
                        '
                        T_PO_Showroom_head.sup,
                        T_PO_Showroom_head.nopo,
                        T_PO_Showroom_head.cur,
                        T_PO_Showroom_head.tgl_po,
                        sum(total) as nilai_PO,
                        total_tagihan,
                        CASE
                            WHEN total_tagihan - sum(total) IS NULL THEN ' . '- ' . ' sum(total)
                            ELSE total_tagihan - sum(total)
                        END AS sisa
                        '
                    )
                    ->groupBy('T_PO_Showroom_head.nopo')
                    ->whereBetween('T_PO_Showroom_head.tgl_po', [$request->date1, $request->date2])
                    ->orderBy('T_PO_Showroom_head.nopo', 'DESC')
                    ->get();
                return response()->json($data);
            }
            // return DB::getQueryLog();
        }
        return view('pages.Report.index');
    }

    public function getDetail(Request $request)
    {
        if ($request->ajax()) {
            if ($request->dataJenis == 'PO') {
                $table_penerimaan = DB::table('T_RcvdDetail_Showroom')
                    ->selectRaw(
                        '
                        T_RcvdDetail_Showroom.nopo, 
                        sum(T_RcvdDetail_Showroom.qty) as qty_terima,
                        T_RcvdDetail_Showroom.kodebrg as kodebrg
                        '
                    )
                    ->where('T_RcvdDetail_Showroom.nopo', $request->id)
                    ->groupBy('T_RcvdDetail_Showroom.kodebrg');
                $data =  DB::table('T_PO_Showroom_Detail')
                    ->leftJoinSub($table_penerimaan, 'T_Terima', function ($join) {
                        $join->on('T_Terima.kodebrg', '=', 'T_PO_Showroom_Detail.kode');
                    })
                    ->leftJoin('T_PO_Showroom_head', 'T_PO_Showroom_Detail.nopo', 'T_PO_Showroom_head.nopo')
                    ->selectRaw(
                        '
                    T_PO_Showroom_Detail.qty - T_Terima.qty_terima as Total_qty,
                    T_PO_Showroom_Detail.nopo as nopo,
                    T_PO_Showroom_Detail.kode as kodebrg,
                    T_PO_Showroom_Detail.nama as NamaBrg,
                    T_PO_Showroom_Detail.qty as qty_PO,
                    T_Terima.qty_terima as qty_receipt,
                    T_PO_Showroom_head.sup,
                    T_PO_Showroom_head.tgl_po as tgl,
                    T_PO_Showroom_head.acc
                    '
                    )
                    ->where('T_PO_Showroom_Detail.nopo', $request->id)
                    ->get();
                return response()->json($data);
            } elseif ($request->dataJenis == 'PEMBELIAN') {
                // return response()->json(['success' => 'ini pembelian']);
                // $data = DB::table('T_PO_Showroom_Detail')
                //     ->leftJoin('T_PO_Showroom_head', 'T_PO_Showroom_Detail.nopo', 'T_PO_Showroom_head.nopo')
                //     ->leftJoin('T_RcvdDetail_Showroom', 'T_PO_Showroom_Detail.nopo', 'T_PO_Showroom_head.nopo')
                //     ->selectRaw(
                //         '
                //         T_PO_Showroom_head.tgl_po as tgl,
                //         sum(T_PO_Showroom_Detail.qty) as qty_po,
                //         T_PO_Showroom_head.sup,
                //         T_PO_Showroom_Detail.nopo,
                //         T_RcvdDetail_Showroom.qty as qty_terima,
                //         T_PO_Showroom_Detail.kode as kodebrg
                //         '
                //     )
                //     ->where('T_PO_Showroom_Detail.kode', $request->id)
                //     ->groupBy('T_PO_Showroom_Detail.kode')
                //     ->toSql();
                $table_penerimaan = DB::table('T_RcvdDetail_Showroom')
                    ->selectRaw(
                        '
                        T_RcvdDetail_Showroom.nopo, 
                        T_RcvdDetail_Showroom.rcvdid, 
                        sum(T_RcvdDetail_Showroom.qty)as qty_terima,
                        T_RcvdDetail_Showroom.kodebrg as kodebrg
                        '
                    )
                    ->where('T_RcvdDetail_Showroom.kodebrg', $request->id)
                    ->groupBy('T_RcvdDetail_Showroom.nopo');
                $data =  DB::table('T_PO_Showroom_Detail')
                    ->leftJoinSub($table_penerimaan, 'T_Terima', function ($join) {
                        $join->on('T_Terima.nopo', '=', 'T_PO_Showroom_Detail.nopo');
                    })
                    ->leftJoin('T_PO_Showroom_head', 'T_PO_Showroom_Detail.nopo', 'T_PO_Showroom_head.nopo')
                    ->selectRaw(
                        '
                        CASE
                            WHEN T_Terima.qty_terima IS NULL THEN ' . '- ' . ' T_PO_Showroom_Detail.qty
                            ELSE T_PO_Showroom_Detail.qty - T_Terima.qty_terima
                        END AS Total_qty
                    ,
                    T_PO_Showroom_Detail.nopo as nopo,
                    T_PO_Showroom_Detail.kode as kodebrg,
                    T_PO_Showroom_Detail.nama as NamaBrg,
                    T_PO_Showroom_Detail.qty as qty_po,
                    CASE
                        WHEN T_Terima.qty_terima IS NULL THEN 0
                        ELSE T_Terima.qty_terima
                    END qty_terima,
                    T_PO_Showroom_head.sup,
                    T_PO_Showroom_head.tgl_po as tgl,
                    T_PO_Showroom_head.acc,
                    CASE
                        WHEN T_Terima.rcvdid IS NULL THEN 0
                        ELSE T_Terima.rcvdid
                    END AS rcvdid
                    '
                    )
                    ->where('T_PO_Showroom_Detail.kode', $request->id)
                    ->get();
                return response()->json($data);
            } elseif ($request->dataJenis == 'PENERIMAAN') {
                $data = DB::table('T_RcvdDetail_Showroom')
                    ->leftJoin('T_RcvdBrg_Head', 'T_RcvdDetail_Showroom.idrcvd', 'T_RcvdBrg_Head.idrcvd')
                    ->selectRaw(
                        '
                        CASE
                            WHEN T_RcvdDetail_Showroom.rcvdid IS NULL THEN 0
                            ELSE T_RcvdDetail_Showroom.rcvdid
                        END AS rcvdid,
                        T_RcvdBrg_Head.tglRcvd,
                        T_RcvdDetail_Showroom.qty,
                        T_RcvdBrg_Head.Mitra,
                        T_RcvdDetail_Showroom.nopo,
                        T_RcvdDetail_Showroom.NamaBrg,
                        T_RcvdDetail_Showroom.kodebrg
                        '
                    )
                    ->where('T_RcvdDetail_Showroom.kodebrg', $request->id)
                    // ->groupBy('T_RcvdDetail_Showroom.kodebrg')
                    ->get();
                return response()->json($data);
            } else {
                return response()->json(403);
            }
        }
    }
    public function getDetailPembelian(Request $request, $id)
    {
        if ($request->ajax()) {
            $data =  DB::table('T_RcvdDetail_Showroom')
                ->leftJoin('T_PO_Showroom_Detail', 'T_RcvdDetail_Showroom.nopo', 'T_PO_Showroom_Detail.nopo')
                ->leftJoin('T_PO_Showroom_head', 'T_PO_Showroom_head.nopo', 'T_PO_Showroom_Detail.nopo')
                ->selectRaw(
                    '
                    T_PO_Showroom_Detail.qty - T_RcvdDetail_Showroom.qty as Total_qty,
                    T_PO_Showroom_Detail.kode as kodebrg,
                    T_PO_Showroom_Detail.nama as NamaBrg,
                    T_PO_Showroom_Detail.qty as qty_PO,
                    T_RcvdDetail_Showroom.qty as qty_receipt,
                    T_PO_Showroom_head.sup,
                    T_PO_Showroom_head.tgl_po as tgl,
                    T_PO_Showroom_head.nopo
                    '
                )
                ->where('T_RcvdDetail_Showroom.nopo', $id)
                ->groupBy('T_PO_Showroom_Detail.kode')
                ->get();
            return response()->json($data);
            // return DB::getQueryLog();
        }
        return view('pages.Report.index');
    }

    public function getDetailPembelianBarang(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('T_RcvdDetail_Showroom')
                ->leftJoin('T_RcvdBrg_Head', 'T_RcvdDetail_Showroom.idrcvd', 'T_RcvdBrg_Head.idrcvd')
                ->selectRaw(
                    '
                    T_RcvdDetail_Showroom.kodebrg,
                    T_RcvdDetail_Showroom.NamaBrg,
                    T_RcvdDetail_Showroom.satuan,
                    T_RcvdDetail_Showroom.qty,
                    T_RcvdDetail_Showroom.kodebrg as poid
                    '
                )
                // ->groupBy('T_RcvdDetail_Showroom.kodebrg')
                ->where('T_RcvdDetail_Showroom.kodebrg', $id)
                ->get();
            return response()->json($data);
            // return DB::getQueryLog();
        }
        return view('pages.Report.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
}
