<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application;

class CompanyController extends Controller
{
    //
    public function index()
    {
        $all = Application::where('id_company', Auth::user()->id)->count();
        $pending = Application::where('id_company', Auth::user()->id)->where('status', 'pending')->count();
        $ditolak = Application::where('id_company', Auth::user()->id)->where('status', 'ditolak')->count();
        $diterima = Application::where('id_company', Auth::user()->id)->where('status', 'diterima')->count();
        $apps = Application::skip(0)->take(6)->where('id_company', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('company.index', compact(['all', 'pending', 'ditolak', 'diterima', 'apps']));
    }
    public function Name()
    {
        // dd(Auth()->user());
        return view('company.view');
    }
}
