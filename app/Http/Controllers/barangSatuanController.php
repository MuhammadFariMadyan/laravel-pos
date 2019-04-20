<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

use Session;
use App\BarangSatuan;
use App\Supplier;

class barangSatuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function barang_satuan(Request $request, Builder $htmlBuilder)
    {
        $user = $request->user();
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            if ($request->ajax()) {
                $barang_satuan = BarangSatuan::all();
                return DataTables::of($barang_satuan)
                ->addColumn('action', function ($barang_satuan) {
                    return view('datatable._barangTb', [
                    'model' => $barang_satuan,
                    'form_url' => route('hapusbarang_satuan', $barang_satuan->idbarang_unit),
                    'edit_url'=> route('ngubahbarang_satuan', $barang_satuan->idbarang_unit)]);
                })
                  ->addColumn('content', function ($barang_satuan) {
                      return strip_tags($barang_satuan->content);
                  })
                ->addIndexColumn()
                ->make(true);
            }

            $html = $htmlBuilder->addIndex(['title'=>'Nomor'])          
          ->addColumn(['data'=>'unit', 'name'=>'unit', 'title'=>'Satuan Barang'])
          ->addColumn(['data' => 'action','name' => 'action', 'title'=> 'Lainnya', 'orderable' => false, 'searchable' => false]);
            return view('barang_satuan.databarang_satuan', ['user'=>$user])->with(compact('html'));
            ;
        }
    }

    public function simpanbarang_satuan(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            $this->validate($request, ['unit'=>'required',]);
            $posts = BarangSatuan::create(['unit'=> $request->unit]);
            Session::flash("notif", [
                       "level"=>"success",
                       "message"=>"Data Satuan Barang Berhasil Tersimpan"
                       ]);
            if ($user->hasRole('penjaga')) {
                return redirect()->route('databarang_satuan');
            } else {
                //return buat pemilik
            }
        }
    }

    public function ubahbarang_satuan(Request $request,$id)
    {
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          $this->validate($request, ['unit'=>'required']);
      $posts = BarangSatuan::find($id);
      $posts->update(['unit' => $request->unit]);
      Session::flash("notif", ["level" => "info", "message" =>"Data Satuan Barang berhasil diubah"]);
      if ($user->hasRole('penjaga')) {
          return redirect()->route('databarang_satuan');
      } else {
          //return buat pemilik
      }
    }
  }

    public function hapusbarang_satuan(Request $request, $id)
    {
        $user = $request->user();
        BarangSatuan::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Data Satuan Barang berhasil dihapus"
          ]);
          if ($user->hasRole('penjaga')) {
              return redirect()->route('databarang_satuan');
          } else {
              //return buat pemilik
          }
    }
}
