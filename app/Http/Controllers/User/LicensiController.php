<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Licensi;

class LicensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // upload file to storage
        $path = public_path().'/img/sertifikat/';
        $licensi = $request->file;
        $licensi_name = now().'_'.$licensi->getClientOriginalName();
        $licensi->move($path, $licensi_name);

        Licensi::create([
            'nama' => $request->nama,
            'penerbit' => $request->penerbit,
            'is_expired' => $request->is_expired,
            'thn_terbit' => $request->thn_terbit,
            'thn_expired' => $request->thn_expired,
            'file' => $licensi_name,
            'id_user' => $request->id_user,
        ]);

        return back()->with('status', 'Data berhasil disimpan !!');
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
        $path = public_path().'/img/sertifikat/';
        $licensi = Licensi::find($id);
        unlink($path.$licensi->file);

        Licensi::destroy($id);

        return back()->with('status', 'Data berhasil dihapus !!');
    }
}
