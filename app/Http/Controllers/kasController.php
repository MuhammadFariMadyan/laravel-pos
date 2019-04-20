<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

use App\Kas;

class kasController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          $kases = Kas::orderBy('tanggal','desc')->paginate(10);
          return view('kas.index',['kases'=>$kases]);
      }
    }

    public function lihat_tanggal(Request $request){
      $user = $request->user();
      $tanggal = $request->tanggal;

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $kases =  DB::table('kas')
                  ->whereBetween('tanggal', [$request->tanggalawal, $request->tanggalakhir])
                  ->get();

        if (Kas::count() > 0) {
          $kas_total =  Kas::orderBy('id','desc')->first()->saldo;  
        } else {
          $kas_total = 0;
        }        

        $total_kredit= 0;
        $total_debit= 0;
        
        foreach ($kases as $kas) {
          $total_kredit += $kas->kredit;
          $total_debit += $kas->debit;
        }

        return view('kas.lihatdata',['kases'=>$kases,'kas_total'=>$kas_total, 'awal'=>$request->tanggalawal,'akhir'=>$request->tanggalakhir, 'total_kredit'=> $total_kredit, 'total_debit'=> $total_debit]);

      }
    }

    // tidak terpakai
    public function cetak(Request $request,$id){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $kases = Kas::where('tanggal', $id)
                   ->orderBy('tanggal', 'desc')
                   ->get();        
         $total = Kas::orderBy('id','desc')->first()->saldo;
         // dd('total : '+$total);
        return view('kas.cetak',['kases'=>$kases,'total'=>$total]);
      }
    }

    public function cetak_kas(Request $request,$awal,$akhir){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $kases =  DB::table('kas')
                  ->whereBetween('tanggal', [$awal, $akhir])
                  ->get();
        if (Kas::count() > 0) {
          $kas_total =  Kas::orderBy('id','desc')->first()->saldo;  
        } else {
          $kas_total = 0;
        }

        $total_kredit= 0;
        $total_debit= 0;
        
        foreach ($kases as $kas) {
          $total_kredit += $kas->kredit;
          $total_debit += $kas->debit;
        }
        
        return view('kas.cetak',['kases'=>$kases,'kas_total'=>$kas_total, 'awal'=>$awal,'akhir'=>$akhir, 'total_kredit'=> $total_kredit, 'total_debit'=> $total_debit]);

      }
    }
}
