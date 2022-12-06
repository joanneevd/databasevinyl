<?php
    
namespace App\Http\Controllers;
    
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PenjualController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:penjual-list|penjual-create|penjual-edit|penjual-delete', ['only' => ['index','show']]);
         $this->middleware('permission:penjual-create', ['only' => ['create','store']]);
         $this->middleware('permission:penjual-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:penjual-delete', ['only' => ['destroy']]);
    }

    public function getPenjuals(){
        $penjual = DB::table('penjuals')->where('deleted_at', null)->get();
        return view('penjuals.index')->with(['penjuals'=>$penjual]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = Request()->keyword;
        // $penjuals = penjual::where('nama_penjual','LIKE','%'.$keyword.'%')->paginate(5);
        $penjuals = DB::table('penjuals')->where('nama_penjual', 'like', "%$keyword%")->get();
        return view('penjuals.index')->with(['penjuals' => $penjuals]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjuals.create');
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
            'id_penjual' => 'required',
            'nama_penjual' => 'required',
            'no_telp' => 'required',
            'alamat_penjual' => 'required',
        ]);
    
        DB::insert('INSERT INTO penjuals(id_penjual, nama_penjual, no_telp, alamat_penjual) VALUES (:id_penjual, :nama_penjual, :no_telp, :alamat_penjual)',
        [
            'id_penjual' => $request->id_penjual,
            'nama_penjual' => $request->nama_penjual,
            'no_telp' => $request->no_telp,
            'alamat_penjual' => $request->alamat_penjual,
        
        ]
        );
    
        return redirect()->route('penjuals.index')
                        ->with('success','penjual created successfully.');
    }
    

    public function show($id)
    {
        $penjual_table = DB::table('penjuals')->where('id_penjual', $id)->get()->first();
        return view('penjuals.show')->with(['penjual'=>$penjual_table]);
    }
    
    
    public function edit($id)
    {
        $penjual = DB::table('penjuals')->where('id_penjual', $id)->first();
        // return ($penjual);
        return view('penjuals.edit')->with(['penjual'=>$penjual]);
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
            'id_penjual' => 'required',
            'nama_penjual' => 'required',
            'no_telp' => 'required',
            'alamat_penjual' => 'required'
        ]);
        $data = [
            'id_penjual' => $request->id_penjual,
            'nama_penjual' => $request->nama_penjual,
            'no_telp' => $request->no_telp,
            'alamat_penjual' => $request->alamat_penjual,
        ];
        // $penjual->update($request->all());
        DB::table('penjuals')->where('id_penjual', $request->id_penjual)->update($data);
    
        return redirect()->route('penjuals.index')
                        ->with('success','penjual updated successfully');
    }
    
    public function destroy($id)
    {
        $data=[
            'deleted_at' => Carbon::now(),
        ];
        DB::table('penjuals')->where('id_penjual', $id)->update($data);
    
        return redirect()->route('penjuals.index')
                        ->with('success','penjual deleted successfully');
    }
    public function deletelist()
    {
        $deleted_table = DB::table('penjuals')->where('deleted_at','!=',null)->get();
        return view('penjuals.trash')->with(['penjuals'=>$deleted_table]);
        // return ($deleted_table);
    }
    public function restore($id)
    {
        DB::table('penjuals')->where('id_penjual', $id)->update(["deleted_at" => null]);
        return redirect()->route('penjuals.index')
                        ->with('success','penjual Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::table('penjuals')->where('id_penjual', $id)->delete();
        return redirect()->route('penjuals.index')
                        ->with('success','penjual Deleted Permanently');
    }
}