<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;

use Session;
use App\Returpembelian;
use App\Supplier;
use App\Barang;

class returpembelianController extends Controller
{
    //
    public function datareturpembelian(Request $request, Builder $htmlBuilder)
    {
        $user = $request->user();

        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {

            return view('returpembelian.datareturpembelian');
        }
    }

    public function simpanreturpembelian(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $kode_barang = explode(",", $request->plu);

        $posts = Returpembelian::create(['no_retur'=> $request->no_retur,
                              'tanggal'=>$request->tanggal,
                              'nama_supplier'=>$request->nama_supplier,
                              'kode_barang'=>$kode_barang[0],
                              'nama_barang'=>$request->nama_barang,
                              'jumlah'=>$request->jumlah,
                              'keterangan'=>$request->keterangan]);

        Session::flash("notif", [
                   "level"=>"success",
                   "message"=>"Retur <strong>Pembelian</strong> Berhasil Tersimpan"
                   ]);
        if ($user->hasRole('penjaga')) {
            return redirect()->route('datareturpembelian');
        } else {
            //return buat pemilik
        }
      }
    }

    public function lihat_tanggal(Request $request){
      $user = $request->user();
      $tanggal = $request->tanggal;
      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $returs = Returpembelian::where('tanggal', $request->tanggal)
                               ->orderBy('tanggal', 'desc')
                               ->get();
        return view('returpembelian.lihat',['returs'=>$returs, 'tanggal'=>$tanggal]);

      }
    }

    public function hapusretur(Request $request, $id)
    {
        $user = $request->user();
        Returpembelian::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Retur <strong>Pembelian</strong> berhasil dihapus"
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
        $returs = Returpembelian::where('tanggal', $id)
                               ->orderBy('tanggal', 'desc')
                               ->get();
        $total = DB::table('returpembelian')
                ->where('tanggal',$id)
                ->count();

        return view('returpembelian.cetak',['returs'=>$returs,'total'=>$total]);

      }
    }
}
