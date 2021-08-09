<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengumuman;
use App\Models\Projek;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(session()->all());
        $file = DB::table('templates')->get();
        $projek = Projek::Orderby('all_status', 'DESC')->get();
        $user = User::find(Auth::user()->id);
        $pengumuman = Pengumuman::orderBy('created_at', 'DESC')->get();
        return view('home', compact('file', 'pengumuman', 'user', 'projek'));
    }

    public function admin()
    {
        // dd(session()->all());
        $file = DB::table('templates')->get();
        $projek = Projek::Orderby('all_status', 'DESC')->get();
        $user = User::find(Auth::user()->id);
        $pengumuman = Pengumuman::orderBy('created_at', 'DESC')->get();
        return view('admin.home', compact('file', 'pengumuman', 'user', 'projek'));
    }

    public function show_pengumuman($id)
    {
        return Pengumuman::find($id);
    }
}
