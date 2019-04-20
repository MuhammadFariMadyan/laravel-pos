<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

use Session;
use App\BarangKategori;
use App\Supplier;

class barangKategoriController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function barang_kategori(Request $request, Builder $htmlBuilder)
    {
        $user = $request->user();        
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            if ($request->ajax()) {
                $barang_kategori = BarangKategori::all();
                return DataTables::of($barang_kategori)
                ->addColumn('action', function ($barang_kategori) {
                    return view('datatable._barangTb', [
                    'model' => $barang_kategori,
                    'form_url' => route('hapusbarang_kategori', $barang_kategori->idbarang_kategori),
                    'edit_url'=> route('ngubahbarang_kategori', $barang_kategori->idbarang_kategori)]);
                })
                  ->addColumn('content', function ($barang_kategori) {
                      return strip_tags($barang_kategori->content);
                  })
                ->addIndexColumn()
                ->make(true);
            }

            $html = $htmlBuilder->addIndex(['title'=>'Nomor'])          
          ->addColumn(['data'=>'kategori', 'name'=>'kategori', 'title'=>'Kategori Barang'])
          ->addColumn(['data' => 'action','name' => 'action', 'title'=> 'Lainnya', 'orderable' => false, 'searchable' => false]);
            return view('barang_kategori.databarang_kategori', ['user'=>$user])->with(compact('html'));
            ;
        }
    }

    public function simpanbarang_kategori(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            $this->validate($request, ['kategori'=>'required',]);
            $posts = BarangKategori::create(['kategori'=> $request->kategori]);
            Session::flash("notif", [
                       "level"=>"success",
                       "message"=>"Data Kategori Barang Berhasil Tersimpan"
                       ]);
            if ($user->hasRole('penjaga')) {
                return redirect()->route('databarang_kategori');
            } else {
                //return buat pemilik
            }
        }
    }

    public function ubahbarang_kategori(Request $request,$id)
    {
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          $this->validate($request, ['kategori'=>'required']);
      $posts = BarangKategori::find($id);
      $posts->update(['kategori' => $request->kategori]);
      Session::flash("notif", ["level" => "info", "message" =>"Data Kategori Barang berhasil diubah"]);
      if ($user->hasRole('penjaga')) {
          return redirect()->route('databarang_kategori');
      } else {
          //return buat pemilik
      }
    }
  }

    public function hapusbarang_kategori(Request $request, $id)
    {
        $user = $request->user();
        BarangKategori::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Data Kategori Barang berhasil dihapus"
          ]);
          if ($user->hasRole('penjaga')) {
              return redirect()->route('databarang_kategori');
          } else {
              //return buat pemilik
          }
    }
}
