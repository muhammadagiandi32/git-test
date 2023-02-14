<?php

namespace App\Http\Controllers\PO;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class PoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data =  DB::table('T_PO_Head_Showroom');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {

                    // $btn = '
                    // <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="' . $row->idpo . '" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>

                    // <a href="javascript:void(0)" data-toggle="tooltip" id="editData"  data-id="' . $row->idpo . '" data-original-title="Edit" class="edit btn btn-warning btn-sm editData">Edit</a>';

                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->idpo . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';
                    $btn = '
                    <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="' . $row->idpo . '" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>';
                    return $btn;
                })
                ->toJson();
        }
        return view('pages.PO.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $JenisPO =  DB::table('T_Remark')->where('Grup', 'JenisPO')->get();
        $Currency =  DB::table('T_Remark')->where('Grup', 'Currency')->get();
        $Supplier =   DB::connection('mysql2')->table('bsw_supplier')->get();

        return response()->json([
            'JenisPO' => $JenisPO,
            'Currency' => $Currency,
            'NamaSupplier' => $Supplier
        ]);
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
        $data_header = [
            'nopo' => $request->NomorPO,
            'tgl' => now(),
            'Mitra' => $request->NamaSupplier,
            'JenisPO' => $request->Kategori,
            'PPn' => $request->PPn,
            'ttd' => $request->Menyetujui,
            'JenisPPn' => $request->JenisPPn,
            'Discount' => $request->Discount,
            'Kat' => $request->Kategori,
            'Currency' => $request->Currency,
        ];
        $result_header =  DB::table('T_PO_Head_Showroom')->insertGetId($data_header);
        for ($i = 0; $i < count($request->input('details')['kodeBarang']); $i++) {
            $data[] = [
                'kodebrg' => $request->input('details')['kodeBarang'][$i],
                'NamaBrg' => $request->input('details')['NamaBarang'][$i],
                'qty' => $request->input('details')['qty'][$i],
                // 'qty' => 1500,
                'satuan' => $request->input('details')['satuan'][$i],
                'harga' => $request->input('details')['Harga'][$i],
                // 'harga' => 1500,
                'total' => $request->input('details')['Total'][$i],
                // 'total' => 5000,
                'poid' => $result_header,
                'created_at' => now()
            ];
        }
        $result = DB::table('T_PO_Detail_Showroom')->insert($data);


        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //``````
        // $data_head = DB::table('T_PO_Head_Showroom')->where('idpo', $id)->first();
        // $data_details = DB::table('T_PO_Detail_Showroom')->where('poid', $id)->get();
        // return response()->json($id);
        if ($request->ajax()) {
            $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', $id)->get();
            $data_head =  DB::table('T_PO_Head_Showroom')->where('idpo', $id)->first();

            return response()->json([
                'data_head' => $data_head,
                'data_details' => $data_details
            ]);
        }
        // $data_header =  DB::table('T_PO_Head_Showroom')->where('idpo', $id)->get();

        return view('pages.PO.index');
    }

    public function next(Request $request, $id)
    {
        //
        if ($request->ajax()) {
            $result =  DB::table('T_PO_Head_Showroom')->where('idpo', '>', $id)->orderBy('idpo', 'asc')->first();
            if ($result) {
                $data_head =  DB::table('T_PO_Head_Showroom')->where('idpo', '>', $id)->orderBy('idpo', 'asc')->first();
                $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', '=', $data_head->idpo)->get();
                return response()->json([
                    'data_head' => $data_head,
                    'data_details' => $data_details
                ]);
            } else {
                $data_head =  DB::table('T_PO_Head_Showroom')->where('idpo', '=', $id)->first();
                $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', '=', $data_head->idpo)->get();

                return response()->json([
                    'data_head' => $data_head,
                    'data_details' => $data_details
                ]);
            }
        }
        return view('pages.PO.index');
    }
    public function previous(Request $request, $id)
    {
        DB::enableQueryLog();
        if ($request->ajax()) {
            $result =  DB::table('T_PO_Head_Showroom')->where('idpo', '<', $id)->orderBy('idpo', 'desc')->first();
            if ($result) {
                $data_head =  DB::table('T_PO_Head_Showroom')->where('idpo', '<', $id)->orderBy('idpo', 'desc')->first();
                $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', '=', $data_head->idpo)->get();
                return response()->json([
                    'data_head' => $data_head,
                    'data_details' => $data_details
                ]);
            } else {
                $data_head =  DB::table('T_PO_Head_Showroom')->where('idpo', '=', $id)->first();
                $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', '=', $data_head->idpo)->get();
                return response()->json([
                    'data_head' => $data_head,
                    'data_details' => $data_details
                ]);
            }
        }
        return view('pages.PO.index');
    }
    public function min(Request $request)
    {
        if ($request->ajax()) {
            $data_find =  DB::table('T_PO_Head_Showroom')->min('idpo');
            $data_head = DB::table('T_PO_Head_Showroom')->where('idpo', '=', $data_find)->first();
            $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', '=', $data_find)->get();
            return response()->json([
                'data_head' => $data_head,
                'data_details' => $data_details
            ]);
        }
        // return view('pages.PO.index');
    }
    public function max(Request $request)
    {
        if ($request->ajax()) {
            $data_find =  DB::table('T_PO_Head_Showroom')->max('idpo');
            $data_head = DB::table('T_PO_Head_Showroom')->where('idpo', '=', $data_find)->first();
            $data_details =  DB::table('T_PO_Detail_Showroom')->where('poid', '=', $data_find)->get();
            return response()->json([
                'data_head' => $data_head,
                'data_details' => $data_details
            ]);
        }
        // return view('pages.PO.index');
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
        $data_head = DB::table('T_PO_Head_Showroom')->where('idpo', $id)->first();
        $data_details = DB::table('T_PO_Detail_Showroom')->where('poid', $id)->get();

        return response()->json([
            'data_head' => $data_head,
            'data_details' => $data_details
        ]);
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
        // return response()->json($request);

        $data_header = [
            'nopo' => $request->NomorPO,
            'tgl' => now(),
            'Mitra' => $request->NamaSupplier,
            'JenisPO' => $request->Kategori,
            'PPn' => $request->PPn,
            'ttd' => $request->Menyetujui,
            'JenisPPn' => $request->JenisPPn,
            'Discount' => $request->Discount,
            'Kat' => $request->Kategori,
            'Currency' => $request->Currency,
        ];
        $result_header =  DB::table('T_PO_Head_Showroom')->where('idpo', $id)->update($data_header);

        for ($i = 0; $i < count($request->input('details')['kodeBarang']); $i++) {
            $result = DB::table('T_PO_Detail_Showroom')->whereIn('idpo', [$request->input('details')['idDetails'][$i]])->update([
                'kodebrg' => $request->input('details')['kodeBarang'][$i],
                'NamaBrg' => $request->input('details')['NamaBarang'][$i],
                'qty' => $request->input('details')['qty'][$i],
                'satuan' => $request->input('details')['satuan'][$i],
                'harga' => $request->input('details')['Harga'][$i],
                'total' => $request->input('details')['Total'][$i],
                'created_at' => now()
            ]);
        }
        return ApiFormatter::CallBackApi(200, 'OK', $request);
        // return response()->json($request);
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
        $data['1'] =  DB::table('T_PO_Head_Showroom')->where('idpo', $id)->delete();
        $data['2'] =  DB::table('T_PO_Detail_Showroom')->where('poid', $id)->delete();

        return ApiFormatter::CallBackApi(200, 'OK', $data);
    }


    public function destroyDetails($id)
    {
        //
        $data =  DB::table('T_PO_Detail_Showroom')->where('idpo', $id)->delete();

        return ApiFormatter::CallBackApi(200, 'OK', $data);
    }
}
