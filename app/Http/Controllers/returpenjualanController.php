<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;

use Session;
use App\Returpenjualan;
use App\Supplier;
use App\Barang;

class returpenjualanController extends Controller
{
    //

    public function datareturpenjualan(Request $request, Builder $htmlBuilder)
    {
        $user = $request->user();

        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {

            return view('returpenjualan.datareturpenjualan');
        }
    }

    public function simpanreturpenjualan(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $kode_barang = explode(",", $request->plu);

        $posts = Returpenjualan::create(['no_retur'=> $request->no_retur,
                              'tanggal'=>$request->tanggal,
                              'nama_penjaga'=>$request->nama_penjaga,
                              'kode_barang'=>$kode_barang[0],
                              'nama_barang'=>$request->nama_barang,
                              'jumlah'=>$request->jumlah,
                              'keterangan'=>$request->keterangan]);

        Session::flash("notif", [
                   "level"=>"success",
                   "message"=>"Retur <strong>Penjualan</strong> Berhasil Tersimpan"
                   ]);
        if ($user->hasRole('penjaga')) {
            return redirect()->route('datareturpenjualan');
        } else {
            //return buat pemilik
        }
      }
    }

    public function lihat_tanggal(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $returs = Returpenjualan::where('tanggal', $request->tanggal)
                               ->orderBy('tanggal', 'desc')
                               ->get();
        return view('returpenjualan.lihat',['returs'=>$returs, 'tanggal'=>$request->tanggal]);

      }
    }

    public function hapusretur(Request $request, $id)
    {
        $user = $request->user();
        Returpenjualan::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Retur <strong>Penjualan</strong> berhasil dihapus"
          ]);
          if ($user->hasRole('penjaga')) {
              return back();
          } else {
              //return buat pemilik
          }
    }

    public function cetak(Request $request,$id){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $returs = Returpenjualan::where('tanggal', $id)
                               ->orderBy('tanggal', 'desc')
                               ->get();
        $total = DB::table('returpenjualan')
                ->where('tanggal',$id)
                ->count();

        return view('returpenjualan.cetak',['returs'=>$returs,'total'=>$total]);

      }
    }
}
