<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use DB;
use Session;
use App\Barang;
use App\Supplier;

class barangController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function barang(Request $request, Builder $htmlBuilder)
    {      
        $user = $request->user();                
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          $barang = Barang::select(DB::raw("id, kode_barang, nama_barang, unit, kategori, stok, harga_beli, harga_jual,diskon, harga_jual_akhir"))
                  ->join('barang_kategori', 'barang.idbarang_kategori', '=', 'barang_kategori.idbarang_kategori') 
                  ->join('barang_unit', 'barang.idbarang_unit', '=', 'barang_unit.idbarang_unit')
                  ->get();
                  // dd($barang);          
          return view('barang.databarang', ['user'=>$user, 'barang'=>$barang]);
          
        }
    }

    public function barang2(Request $request, Builder $htmlBuilder)
    {      
        $user = $request->user();                
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            if ($request->ajax()) {
                $barang = Barang::select(DB::raw("id, kode_barang, nama_barang, unit, kategori, stok, harga_beli, harga_jual,diskon, harga_jual_akhir"))
                  ->join('barang_kategori', 'barang.idbarang_kategori', '=', 'barang_kategori.idbarang_kategori') 
                  ->join('barang_unit', 'barang.idbarang_unit', '=', 'barang_unit.idbarang_unit')
                  ->get();
                return DataTables::of($barang)
                ->addColumn('action', function ($barang) {
                    return view('datatable._barangTb', [
                    'model' => $barang,
                    'form_url' => route('hapusbarang', $barang->id),
                    'edit_url'=> route('ngubahbarang', $barang->id)]);
                })
                  ->addColumn('content', function ($barang) {
                      return strip_tags($barang->content);
                  })
                ->addIndexColumn()
                ->make(true);
            }

            $html = $htmlBuilder->addIndex(['title'=>'Nomor'])
          ->addColumn(['data'=>'kode_barang', 'name'=>'kode_barang', 'title'=>'Kode Barang'])
          ->addColumn(['data'=>'nama_barang', 'name'=>'nama_barang', 'title'=>'Nama Barang'])          
          ->addColumn(['data'=>'unit', 'name'=>'unit', 'title'=>'Satuan'])
          ->addColumn(['data'=>'kategori', 'name'=>'kategori', 'title'=>'Kategori'])          
          ->addColumn(['data'=>'stok', 'name'=>'stok', 'title'=>'Stok'])
          ->addColumn(['data'=>'harga_beli', 'name'=>'harga_beli', 'title'=>'Harga Beli (Rp)'])
          ->addColumn(['data'=>'harga_jual', 'name'=>'harga_jual', 'title'=>'Harga Jual (Rp)'])
          ->addColumn(['data'=>'diskon', 'name'=>'diskon', 'title'=>'Diskon (%)'])
          ->addColumn(['data'=>'harga_jual_akhir', 'name'=>'harga_jual_akhir', 'title'=>'Harga (Rp)'])
          ->addColumn(['data' => 'action','name' => 'action', 'title'=> 'Lainnya', 'orderable' => false, 'searchable' => false]);
            return view('barang.databarang', ['user'=>$user])->with(compact('html'));            
        }
    }

    public function simpanbarang(Request $request)
    {
        $user = $request->user();
        
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            if ($request->stok == null) {
              $stok = 0;
            }else {$stok = $request->stok;}
            // dd($request, $stok);
            $this->validate($request, ['kode_barang'=>'required',
                                  'nama_barang'=>'required',
                                  'harga_beli'=>'required|numeric',
                                  'harga_jual'=>'required|numeric',
                                  'idbarang_kategori'=>'required|numeric',
                                  'idbarang_unit'=>'required|numeric']);                
            $posts = Barang::create(['kode_barang'=> $request->kode_barang,
                                  'nama_barang'=>$request->nama_barang,
                                  'harga_beli'=>(int)$request->harga_beli,
                                  'harga_jual'=>(int)$request->harga_jual,
                                  'diskon'=>(int)$request->diskon,
                                  'createdby'=>$user->name,
                                  'harga_jual_akhir'=>(int)$request->harga_jual_akhir,
                                  'idbarang_kategori'=>(int)$request->idbarang_kategori,
                                  'idbarang_unit'=>(int)$request->idbarang_unit]);
            Session::flash("notif", [
                       "level"=>"success",
                       "message"=>"Data Barang Berhasil Tersimpan"
                       ]);
            if ($user->hasRole('penjaga')) {
                return redirect()->route('databarang');
            } else {
                //return buat pemilik
            }
        }
    }

    public function ubahbarang(Request $request,$id)
    {
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          $this->validate($request, ['kode_barang'=>'required',
                                  'nama_barang'=>'required',
                                  'harga_beli'=>'required|numeric',
                                  'harga_jual'=>'required|numeric',
                                  'idbarang_kategori'=>'required|numeric',
                                  'idbarang_unit'=>'required|numeric']);
      $posts = Barang::find($id);
      $posts->update(['kode_barang'=> $request->kode_barang,
                                  'nama_barang'=>$request->nama_barang,
                                  'harga_beli'=>(int)$request->harga_beli,
                                  'harga_jual'=>(int)$request->harga_jual,
                                  'diskon'=>(int)$request->diskon,
                                  'updatedby'=>$user->name,
                                  'harga_jual_akhir'=>(int)$request->harga_jual_akhir,
                                  'idbarang_kategori'=>(int)$request->idbarang_kategori,
                                  'idbarang_unit'=>(int)$request->idbarang_unit]);
      Session::flash("notif", ["level" => "info", "message" =>"Data Barang berhasil diubah"]);
      if ($user->hasRole('penjaga')) {
          return redirect()->route('databarang');
      } else {
          //return buat pemilik
      }
    }
  }

    public function hapusbarang(Request $request, $id)
    {
        $user = $request->user();
        Barang::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Data Barang berhasil dihapus"
          ]);
          if ($user->hasRole('penjaga')) {
              return redirect()->route('databarang');
          } else {
              //return buat pemilik
          }
    }
}
