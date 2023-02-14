<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data =  DB::table('T_Bayar');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {

                    // $btn = '
                    // <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="' . $row->idpo . '" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>

                    // <a href="javascript:void(0)" data-toggle="tooltip" id="editData"  data-id="' . $row->idpo . '" data-original-title="Edit" class="edit btn btn-warning btn-sm editData">Edit</a>';

                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->idpo . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData">Delete</a>';
                    $btn = '
                        <a href="javascript:void(0)" data-toggle="tooltip" id="viewDetails"  data-id="' . $row->idbayar . '" data-original-title="View" class="edit btn btn-info btn-sm viewDetails">View</a>';
                    return $btn;
                })
                ->toJson();
        }
        return view('pages.Pembayaran.index');
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
            $data_details =  DB::table('T_Bayar')->where('idbayar', $id)->get();
            $data_head =  DB::table('T_Bayar')->where('idbayar', $id)->first();

            return response()->json([
                'data_head' => $data_head,
                'data_details' => $data_details
            ]);
        }
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
