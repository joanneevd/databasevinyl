<?php
    
namespace App\Http\Controllers;
    
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PembeliController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:pembeli-list|pembeli-create|pembeli-edit|pembeli-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pembeli-create', ['only' => ['create','store']]);
         $this->middleware('permission:pembeli-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pembeli-delete', ['only' => ['destroy']]);
    }

    public function getPembelis(){
        $pembeli = DB::table('pembelis')->where('deleted_at', null)->get();
        return view('pembelis.index')->with(['pembelis'=>$pembeli]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = Request()->keyword;
        // $pembelis = pembeli::where('nama_pembeli','LIKE','%'.$keyword.'%')->paginate(5);
        $pembelis = DB::table('pembelis')->where('nama_pembeli', 'like', "%$keyword%")->get();
        return view('pembelis.index')->with(['pembelis' => $pembelis]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembelis.create');
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
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'no_telp' => 'required',
            'alamat_pembeli' => 'required',
        ]);
    
        DB::insert('INSERT INTO pembelis(id_pembeli, nama_pembeli, no_telp, alamat_pembeli) VALUES (:id_pembeli, :nama_pembeli, :no_telp, :alamat_pembeli)',
        [
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'no_telp' => $request->no_telp,
            'alamat_pembeli' => $request->alamat_pembeli,
        
        ]
        );
    
        return redirect()->route('pembelis.index')
                        ->with('success','pembeli created successfully.');
    }
    

    public function show($id)
    {
        $pembeli_table = DB::table('pembelis')->where('id_pembeli', $id)->get()->first();
        return view('pembelis.show')->with(['pembeli'=>$pembeli_table]);
    }
    
    
    public function edit($id)
    {
        $pembeli = DB::table('pembelis')->where('id_pembeli', $id)->first();
        // return ($pembeli);
        return view('pembelis.edit')->with(['pembeli'=>$pembeli]);
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
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'no_telp' => 'required',
            'alamat_pembeli' => 'required'
        ]);
        $data = [
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'no_telp' => $request->no_telp,
            'alamat_pembeli' => $request->alamat_pembeli,
        ];
        // $pembeli->update($request->all());
        DB::table('pembelis')->where('id_pembeli', $request->id_pembeli)->update($data);
    
        return redirect()->route('pembelis.index')
                        ->with('success','pembeli updated successfully');
    }
    
    public function destroy($id)
    {
        $data=[
            'deleted_at' => Carbon::now(),
        ];
        DB::table('pembelis')->where('id_pembeli', $id)->update($data);
    
        return redirect()->route('pembelis.index')
                        ->with('success','pembeli deleted successfully');
    }
    public function deletelist()
    {
        $deleted_table = DB::table('pembelis')->where('deleted_at','!=',null)->get();
        return view('pembelis.trash')->with(['pembelis'=>$deleted_table]);
        // return ($deleted_table);
    }
    public function restore($id)
    {
        DB::table('pembelis')->where('id_pembeli', $id)->update(["deleted_at" => null]);
        return redirect()->route('pembelis.index')
                        ->with('success','pembeli Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::table('pembelis')->where('id_pembeli', $id)->delete();
        return redirect()->route('pembelis.index')
                        ->with('success','pembeli Deleted Permanently');
    }
}