<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Job;
use App\InfoCompany;
use App\Application;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $apps = Application::
        $companies = InfoCompany::skip(0)->take(8)->whereNotNull('npwp')->orderBy('created_at', 'desc')->get();
        $jobs = Job::skip(0)->take(4)->orderBy('created_at', 'desc')->get();
        return view('welcome', compact(['jobs', 'companies']));
    }

    public function search(Request $request) {
        $jobs = Job::where('posisi', 'LIKE', "%{$request->search}%")
            ->orderBy('id', 'desc')
            ->paginate(2);
        $jobs->appends($request->all())->links();

        $total = Job::where('posisi', 'LIKE', "%{$request->search}%")->count();

        $keyword = $request->search;

        return view('search', compact(['jobs', 'keyword', 'total']));
    }

    public function loker() {
        $jobs = Job::orderBy('created_at', 'desc')->paginate(6);
        $total = Job::count();
        return view('loker', compact(['jobs', 'total']));
    }

    public function filter(Request $request) {
        if(isset($request->jenis)) {
            $jobs = Job::whereIn('jenis', $request->jenis)->orderBy('created_at', 'desc')->paginate(6);
            $total = Job::whereIn('jenis', $request->jenis)->orderBy('created_at', 'desc')->count();
            $jeniss = $request->jenis;
            return view('filter', compact(['jobs', 'jeniss', 'total']));
        }

        $jobs = Job::orderBy('created_at', 'desc')->paginate(6);
        $total = Job::count();
        return view('filter', compact(['jobs', 'total']));
    }

    public function detail($id) {
        $id_job = Crypt::decryptString($id);
        $job = Job::find($id_job);
        // dd($job);

        return view('detail-loker', compact(['job']));
    }

    public function company() {
        $companies = InfoCompany::whereNotNull('npwp')->orderBy('nama', 'asc')->paginate(8);

        return view('list-company', compact(['companies']));
    }
}
