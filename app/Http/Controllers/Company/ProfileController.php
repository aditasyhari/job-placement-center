<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\InfoCompany;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $infoCompany = InfoCompany::firstWhere('id_user', Auth::user()->id);
        return view('company.profile', compact(['infoCompany']));
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
        $infoCompany = InfoCompany::find($id);
        $infoCompany->update($request->all());

        return back()->with('status', 'Info Perusahaan berhasil diperbarui !!');
    }

    public function updateProfile(Request $request, $id)
    {
        //
        $profile = InfoCompany::find($id);

        if($request->profile != '') {
            $path = public_path().'/img/profile/';

            // hapus foto profile lama
            if($profile->profile != 'default.jpg' && $profile->profile != null) {
                $pic_old = $path.$profile->profile;
                unlink($pic_old);
            }

            // upload foto profile baru
            $pic_new = $request->profile;
            $profile_name = time().'_'.$pic_new->getClientOriginalName();
            $pic_new->move($path, $profile_name);

            $profile->update([
                'profile' => $profile_name,
            ]);

            return back()->with('status', 'Foto Profile berhasil diperbarui !!');
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
        //
    }
}
