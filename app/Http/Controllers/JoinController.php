<?php
    
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function index()
    {
        // $joins = DB::table('vinyljos')
        //     ->join('penjuals', 'vinyljos.id_penjual', '=', 'penjuals.id_penjual')
        //     ->join('pembelis', 'vinyljos.id_pembeli', '=', 'pembelis.id_pembeli')
        //     ->select('vinyljos.title as title', 'penjuals.nama_penjual as nama_penjual','pembelis.nama_pembeli as nama_pembeli')
        //     ->paginate(6);
        //     return view('totals.index',compact('joins'))
        //         ->with('i', (request()->input('page', 1) - 1) * 6);

                $joins = DB::table('vinyljos')
                ->join('pembelis', 'pembelis.id_pembeli', '=', 'vinyljos.id_pembeli')
                ->join('penjuals', 'penjuals.id_penjual', '=', 'vinyljos.id_penjual')
                ->select('pembelis.nama_pembeli as nama_pembeli', 'penjuals.nama_penjual as nama_penjual', 'vinyljos.title as title', 'vinyljos.artist as artist', 'vinyljos.stats as stats')
                ->paginate(6);
                return view('totals.index',compact('joins'))
                    ->with('i', (request()->input('page', 1) - 1) * 6);
    }
}