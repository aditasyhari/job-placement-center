<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Application;
use App\Job;
use App\User;
use App\InfoUser;
use App\Skill;
use App\Pendidikan;
use App\Licensi;
use App\Notifikasi;

class PelamarController extends Controller
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
        $apps = Application::where('id_company', Auth::user()->id)->get();

        return view('company.pelamar', compact(['apps']));
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
        $id_app = Crypt::decryptString($id);
        $app = Application::find($id_app);

        $app->update([
            'baca_perusahaan' => true
        ]);

        $id_pelamar = $app->id_pelamar;
        $id_job = $app->id_job;

        $job = Job::firstWhere('id', $id_job);
        $licensis = Licensi::where('id_user', $id_pelamar)->get();
        $skills = Skill::where('id_user', $id_pelamar)->get();
        $pendidikans = Pendidikan::where('id_user', $id_pelamar)->orderBy('created_at', 'DESC')->get();
        $infoUser = InfoUser::firstWhere('id_user', $id_pelamar);

        return view('company.detail-pelamar', compact(['app', 'job', 'infoUser', 'skills', 'pendidikans', 'licensis']));
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
        $app = Application::find($id);
        $u = User::find($app->id_pelamar);
        $pesan = Notifikasi::find(1);

        $app->update($request->all());

        $email = $u->email;
        if($request->status == 'diterima') {
            $data = [
                'title' => 'Lamaran Diterima!',
                'url' => 'http://127.0.0.1:8000/login',
                'pesan' => $pesan->pesan_diterima,
            ];
        } elseif($request->status == 'ditolak') {
            $data = [
                'title' => 'Lamaran Ditolak!',
                'url' => 'http://127.0.0.1:8000/login',
                'pesan' => $pesan->pesan_ditolak,
            ];
        }
        Mail::to($email)->send(new SendMail($data));

        return back()->with('status', 'Status pelamar berhasil diperbarui !!');
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

    public function notifikasi() {
        $apps = Application::where('id_company', Auth::user()->id)->where('baca_perusahaan', false)->get();

        return view('company.notifikasi', compact(['apps']));
    }
}
