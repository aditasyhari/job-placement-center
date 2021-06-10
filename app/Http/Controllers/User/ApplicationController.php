<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;
use App\Job;
use App\Pendidikan;
use App\InfoUser;

class ApplicationController extends Controller
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
        //
        $user = InfoUser::firstWhere('id_user', $request->id_pelamar);
        $pendidikan = Pendidikan::where('id_user', $request->id_pelamar)->count();

        if($user->nim != null || $user->nama != null) {
            if($pendidikan > 0) {
                Application::create($request->all());
                return back()->with('status', 'BERHASIL !! Apply lowongan status PENDING. Silhkan tunggu info selanjutnya dari pihak perusahaan.');
            } else {
                return back()->with('status', 'GAGAL !! Silahkan lengkapi terlebih dahulu RIWAYAT PENDIDIKAN anda.');
            }
        }

        return back()->with('status', 'GAGAL !! Silahkan lengkapi terlebih dahulu PROFILE anda.');
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
    }

    public function pending() {
        $apply = Application::where('id_pelamar', Auth::user()->id)->where('status', 'pending')->get();
        $status = 'pending';
        // dd($apply);
        return view('user.riwayat-apply', compact(['apply', 'status']));
    }

    public function ditolak() {
        $apply = Application::where('id_pelamar', Auth::user()->id)->where('status', 'ditolak')->get();
        $status = 'ditolak';
        // dd($apply);
        return view('user.riwayat-apply', compact(['apply', 'status']));
    }

    public function diterima() {
        $apply = Application::where('id_pelamar', Auth::user()->id)->where('status', 'diterima')->get();
        $status = 'diterima';
        // dd($apply);
        return view('user.riwayat-apply', compact(['apply', 'status']));
    }

    public function notifikasi() {
        $apps = Application::where('id_pelamar', Auth::user()->id)->whereIn('status', ['ditolak', 'diterima'])->where('baca_pelamar', false)->get();

        return view('user.notifikasi', compact(['apps']));
    }

    public function detail($id) {
        $id_app = Crypt::decryptString($id);
        $app = Application::find($id_app);

        $app->update([
            'baca_pelamar' => true
        ]);

        $job = Job::find($app->id_job);

        return view('user.detail-loker', compact(['job', 'app']));
    }

    
}
