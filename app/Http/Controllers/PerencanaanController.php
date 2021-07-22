<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Analisis;
use App\Models\KAK;
use App\Models\Matriks;
use App\Models\Proposal;
use App\Models\RAB;

use function PHPUnit\Framework\fileExists;

class PerencanaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function perencanaan()
    {
        $analisis = Analisis::get();
        $matriks = Matriks::get();
        $proposal = Proposal::get();
        $rab = RAB::get();
        $kak = KAK::get();
        $user = User::get();
        return view('perencanaan', ['analisis' => $analisis, 'kak' => $kak, 'matriks' => $matriks, 'proposal' => $proposal, 'rab' => $rab, 'user' => $user]);
    }

    public function perencanaan_upload(Request $request)
    {
        $this->validate($request, [
            // 'matriks' => 'required|file|mimes:docx,pdf,|max:15000',
            // 'rab' => 'required|file|mimes:xlsx,xls,|max:15000',
            // 'kak' => 'required|file|mimes:docx,pdf,|max:15000',
            // 'proposal' => 'required|file|mimes:docx,pdf,|max:15000',
            // 'analisis' => 'required|file|mimes:xlsx,xls,|max:15000',
            'matriks' => 'nullable|file|max:15000',
            'rab' => 'nullable|file|max:15000',
            'kak' => 'nullable|file|max:15000',
            'proposal' => 'nullable|file|max:15000',
            'analisis' => 'nullable|file|max:15000',

        ]);

        //get user
        $id = Auth::id();
        $user = User::find($id);
        $path = "public/$user->name";

        //variable file
        $matriks = $request->file('matriks');
        $rab = $request->file('rab');
        $kak = $request->file('kak');
        $proposal = $request->file('proposal');
        $analisis = $request->file('analisis');


        // upload ke db
        // matriks
        if (file_exists($matriks)) {
            $namaFileMatriks = $matriks->getClientOriginalName();
            $pathMatriks = Storage::putFileAs($path, $matriks, $namaFileMatriks);
            Matriks::create([
                'path' => $pathMatriks,
                'file' => $namaFileMatriks,
                'user_id' => $user->id,
                'projek_id' => '1',
                'status' => '1'
            ]);
        };
        // rab
        if (file_exists($rab)) {
            $namaFileRab = $rab->getClientOriginalName();
            $pathRab = Storage::putFileAs($path, $rab, $namaFileRab);

            RAB::create([
                'path' => $pathRab,
                'file' => $namaFileRab,
                'user_id' => $user->id,
                'projek_id' => '1',
                'status' => '1'
            ]);
        };
        // kak
        if (file_exists($kak)) {
            $namaFileKak = $kak->getClientOriginalName();
            $pathKak = Storage::putFileAs($path, $kak, $namaFileKak);

            KAK::create([
                'path' => $pathKak,
                'file' => $namaFileKak,
                'user_id' => $user->id,
                'projek_id' => '1',
                'status' => '1'
            ]);
        };
        // proposal
        if (file_exists($proposal)) {
            $namaFileProposal = $proposal->getClientOriginalName();
            $pathProposal = Storage::putFileAs($path, $proposal, $namaFileProposal);
            Proposal::create([
                'path' => $pathProposal,
                'file' => $namaFileProposal,
                'user_id' => $user->id,
                'projek_id' => '1',
                'status' => '1'
            ]);
        };
        // analisis
        if (file_exists($analisis)) {
            $namaFileAnalisis = $analisis->getClientOriginalName();
            $pathAnalisis = Storage::putFileAs($path, $analisis, $namaFileAnalisis);
            Analisis::create([
                'path' => $pathAnalisis,
                'file' => $namaFileAnalisis,
                'user_id' => $user->id,
                'projek_id' => '1',
                'status' => '1'
            ]);
        };
        return redirect()->back();
    }

    public function perencanaan_download(Request $request)
    {
        $this->validate($request, [
            'path' => 'required'
        ]);
        $path = $request->path;

        try {
            // return $path;
            return Storage::disk('local')->download($path);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        // return redirect()->back();
    }
}
