<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSiswa = Siswa::all();

        return response()->json([
            'success' => true,
            'message' => 'data siswa', 
            'data' => $dataSiswa
        ], 200);
        

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
        $validated = Validator::make($request->all(),[
            'nama' => 'required',
            'kelas' => 'required',
            'deskripsi' => 'required'

        ]);

        if($validated ->fails()){
            return response()->json($validated->errors(), 400);
        }

        $data = Siswa::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi
        ]);


        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $data

            ],201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak berhasil disimpan'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::find($id);

        if($data){
            return response()->json([
                'success' => true,
                'message' => 'datanya ada coyy', 
                'data' => $data
            ], 203);
            return response()->json([
                'message' => 'datanya gk ada coyy', 
            ], 404);
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
        $data = Siswa::find($id);

        if($data){
            
        $validated = Validator::make($request->all(),[
            'nama' => 'required',
            'kelas' => 'required',
            'deskripsi' => 'required'

        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $data->update([
            'nama'=>$request->nama,
            'kelas'=>$request->kelas,
            'deskripsi'=>$request->deskripsi,
            
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil Diubah',
            'data' => $data

        ],201);

        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);

        if($data){
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data lu ilang euy',

            ],201);
        }
    }
}
