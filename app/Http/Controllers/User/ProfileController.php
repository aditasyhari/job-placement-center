<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\InfoUser;
use App\Skill;
use App\Pendidikan;
use App\Licensi;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $user = User::find(Auth::user()->id);
        $licensis = Licensi::where('id_user', Auth::user()->id)->get();
        $skills = Skill::where('id_user', Auth::user()->id)->get();
        $pendidikans = Pendidikan::where('id_user', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $infoUser = InfoUser::firstWhere('id_user', Auth::user()->id);
        return view('user.profile', compact(['infoUser', 'skills', 'pendidikans', 'licensis']));
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
        $profile = InfoUser::find($id);

        $profile->update($request->all());

        return back()->with('status', 'Data diri berhasil diperbarui');
    }

    public function updateProfile(Request $request, $id)
    {
        //
        $profile = InfoUser::find($id);

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
