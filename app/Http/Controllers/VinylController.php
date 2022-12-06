<?php
    
namespace App\Http\Controllers;
    
use App\Models\Vinyl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class VinylController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:vinyl-list|vinyl-create|vinyl-edit|vinyl-delete', ['only' => ['index','show']]);
         $this->middleware('permission:vinyl-create', ['only' => ['create','store']]);
         $this->middleware('permission:vinyl-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vinyl-delete', ['only' => ['destroy']]);
    }

    public function getVinyljos(){
        $vinyl = DB::table('vinyljos')->where('deleted_at', null)->get();
        return view('vinyls.index')->with(['vinyls'=>$vinyl]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = Request()->keyword;
        // $vinyls = vinyl::where('nama_vinyl','LIKE','%'.$keyword.'%')->paginate(5);
        $vinyljos = DB::table('vinyljos')->where('title', 'like', "%$keyword%")->get();
        return view('vinyls.index')->with(['vinyls' => $vinyljos]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vinyls.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_vinyl' => 'required',
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'stats' => 'required',
            'stok' => 'required',
            'id_penjual' => 'required',
            'id_pembeli' => 'required',
        ]);
    
        DB::insert('INSERT INTO vinyljos(id_vinyl, title, artist, genre, stats, stok, id_penjual, id_pembeli) VALUES (:id_vinyl, :title, :artist, :genre, :stats, :stok, :id_penjual, :id_pembeli)',
        [
            'id_vinyl' => $request->id_vinyl,
            'title' => $request->title,
            'artist' => $request->artist,
            'genre' => $request->genre,
            'stats' => $request->stats,
            'stok' => $request->stok,
            'id_penjual' => $request->id_penjual,
            'id_pembeli' => $request->id_pembeli,
        
        ]
        );
    
        return redirect()->route('vinyls.index')
                        ->with('success','vinyl created successfully.');
    }
    

    public function show($id)
    {
        $vinyl_table = DB::table('vinyljos')->where('id_vinyl', $id)->get()->first();
        return view('vinyls.show')->with(['vinyl'=>$vinyl_table]);
    }
    
    
    public function edit($id)
    {
        $vinyl = DB::table('vinyljos')->where('id_vinyl', $id)->first();
        // return ($vinyl);
        return view('vinyls.edit')->with(['vinyl'=>$vinyl]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_vinyl' => 'required',
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'stats' => 'required',
            'stok' => 'required',
            'id_penjual' => 'required',
            'id_pembeli' => 'required'
        ]);
        $data = [
            'id_vinyl' => $request->id_vinyl,
            'title' => $request->title,
            'artist' => $request->artist,
            'genre' => $request->genre,
            'stats' => $request->stats,
            'stok' => $request->stok,
            'id_penjual' => $request->id_penjual,
            'id_pembeli' => $request->id_pembeli,
        ];
        // $vinyl->update($request->all());
        DB::table('vinyljos')->where('id_vinyl', $request->id_vinyl)->update($data);
    
        return redirect()->route('vinyls.index')
                        ->with('success','vinyl updated successfully');
    }
    
    public function destroy($id)
    {
        $data=[
            'deleted_at' => Carbon::now(),
        ];
        DB::table('vinyljos')->where('id_vinyl', $id)->update($data);
    
        return redirect()->route('vinyls.index')
                        ->with('success','vinyl deleted successfully');
    }
    public function deletelist()
    {
        $deleted_table = DB::table('vinyljos')->where('deleted_at','!=',null)->get();
        return view('vinyls.trash')->with(['vinyls'=>$deleted_table]);
        // return ($deleted_table);
    }
    public function restore($id)
    {
        DB::table('vinyljos')->where('id_vinyl', $id)->update(["deleted_at" => null]);
        return redirect()->route('vinyls.index')
                        ->with('success','vinyl Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::table('vinyljos')->where('id_vinyl', $id)->delete();
        return redirect()->route('vinyls.index')
                        ->with('success','vinyl Deleted Permanently');
    }
}