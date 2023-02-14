<?php

namespace App\Http\Controllers\MasterItem;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class MasteritemController extends Controller
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
            $data =  DB::table('master_barangs_showroom');
            return Datatables::of($data)
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_barang . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editData">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_barang . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';

                    return $btn;
                })
                ->toJson();
        }
        return view('pages.MasterItems.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data =  DB::table('T_Remark')->where('Grup', 'PO')->get();
        return response()->json($data);
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
        $data =   DB::table('master_barangs_showroom')->updateOrInsert(
            ['id_barang' => $request->ItemId],
            [
                'kode_barang'  => Str::upper($request->KodeBarang),
                'nama_barang' => Str::upper($request->NamaBarang),
                'jenis_id' => $request->JenisId,
                'created_at' => now(),
            ]
        );

        return ApiFormatter::CallBackApi(200, 'OK', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data =  DB::table('master_barangs_showroom')->where('id_barang', $id)->first();
        return response()->json($data);
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
        $data =  DB::table('master_barangs_showroom')->where('id_barang', $id)->delete();

        return ApiFormatter::CallBackApi(200, 'OK', $data);
    }
}
