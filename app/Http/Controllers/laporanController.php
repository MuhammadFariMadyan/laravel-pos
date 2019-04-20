<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Auth;
use Session;
use Charts;
use App\User;
use App\Barang;
use App\Supplier;
use App\Penjualan;
use App\Pembelian;
use App\BarangPersediaan;
use App\DetailPenjualan;
use App\KartuPersediaan;

class laporanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function penjualan(Request $request, Builder $htmlBuilder)
    {
        $user = $request->user();

        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {

            return view('laporan.penjualan');
        }
    }
    public function lihatpenjualan(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
      
        $laps =  DetailPenjualan::select(DB::raw("penjualans.tanggal, penjualans.kode_penjualan, barang.nama_barang, penjualan_details.harga_jual_akhir, penjualan_details.jumlah_jual, penjualan_details.sub_total_harga"))
                ->join('penjualans', 'penjualan_details.id_penjualan', '=' ,'penjualans.id')
                ->join('barang', 'penjualan_details.id_barang', '=' ,'barang.id')
                ->whereBetween('penjualans.tanggal', [$request->tanggalawal, $request->tanggalakhir])
                ->get();        
        $harga_total =  DB::table('penjualans')
                    ->whereBetween('tanggal', [$request->tanggalawal, $request->tanggalakhir])
                    ->sum('total_harga_jual'); 
                                       
        return view('laporan._penjualan',['laps'=>$laps,'harga_total'=>$harga_total, 'awal'=>$request->tanggalawal,'akhir'=>$request->tanggalakhir]);

      }
    }

    public function persediaan(Request $request, Builder $htmlBuilder)
    {
      $user = $request->user();
      if ($user->hasRole('penjaga')) {        
        return view('laporan._persediaan');
      } else {
        return view('laporan._persediaan_pmpn');
      }
    }

    public function lihatpersediaan(Request $request){
      $user = $request->user();
      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        // dd($request);

        $persediaans = BarangPersediaan::select(DB::raw("id_barang, nama_barang, harga_jual, harga_beli, tanggal_beli, tanggal_jual, stok, stok_beli, stok_jual"))
                        ->join('barang', 'barang_persediaans.id_barang', '=', 'barang.id')
                        ->whereBetween('tanggal_beli', [$request->tanggalawal, $request->tanggalakhir])
                        ->orderBy('barang_persediaans.id', 'asc')
                        ->get();                    
        // dd($request);
        if ($user->hasRole('penjaga')) {
          return view('laporan.persediaan',['persediaans'=>$persediaans,'awal'=>$request->tanggalawal,'akhir'=>$request->tanggalakhir, 'id_barang'=>$request->id_barang]);    
        } else {
          return view('laporan.persediaan_pmpn',['persediaans'=>$persediaans,'awal'=>$request->tanggalawal,'akhir'=>$request->tanggalakhir, 'id_barang'=>$request->id_barang]);    
        }

      }
    }

    public function grafikpenjualan(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {                       
        
        $data = Penjualan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), 2018)->orderBy('tanggal','asc')->get(); 
        $chart = Charts::create('bar', 'highcharts')
             ->title('Grafik Penjualan 2018')
             ->elementLabel('Total Harga Penjualan')
             ->labels($data->pluck('tanggal')) 
             ->values($data->pluck('total_harga_jual'))
             ->responsive(true);

        return view('grafik.index',['chart'=>$chart]);

      }
    }

    public function lihatgrafik(Request $request){
      $user = $request->user(); 

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {        
      $title = "Grafik Penjualan ".$request->tahun ;                  

      $data = Penjualan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $request->tahun)->orderBy('tanggal','asc')->get();        
      $chart = Charts::create('bar', 'highcharts')
           ->title($title)
           ->elementLabel('Total Harga Penjualan')
           ->labels($data->pluck('tanggal')) 
           ->values($data->pluck('total_harga_jual'))
           ->responsive(true);

        return view('grafik.index',['chart'=>$chart]);

      }
    }

    public function cetak_penjualan(Request $request,$awal,$akhir){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) { 
        $laps =  DetailPenjualan::select(DB::raw("penjualans.tanggal, penjualans.kode_penjualan, barang.nama_barang, penjualan_details.harga_jual_akhir, penjualan_details.jumlah_jual, penjualan_details.sub_total_harga"))
                ->join('penjualans', 'penjualan_details.id_penjualan', '=' ,'penjualans.id')
                ->join('barang', 'penjualan_details.id_barang', '=' ,'barang.id')
                ->whereBetween('penjualans.tanggal', [$awal, $akhir])
                ->get();        
        $harga_total =  DB::table('penjualans')
                    ->whereBetween('tanggal', [$awal, $akhir])
                    ->sum('total_harga_jual'); 
        return view('laporan.cetakpenjualan',['laps'=>$laps,'harga_total'=>$harga_total, 'awal'=>$awal,'akhir'=>$akhir]);
      }
    }
        
    public function cetak_persediaan(Request $request,$awal,$akhir){
      $user = $request->user();
      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {      
        $persediaans = BarangPersediaan::select(DB::raw("nama_barang, harga_jual, harga_beli, tanggal_beli, tanggal_jual, stok, stok_beli, stok_jual"))
                        ->join('barang', 'barang_persediaans.id_barang', '=', 'barang.id')
                        ->whereBetween('tanggal_beli', [$awal, $akhir])
                        // ->where('id_barang', $request->id_barang)
                        ->orderBy('barang_persediaans.id', 'asc')->get();     
        
        $total = count($persediaans);
        // dd($persediaans);
        return view('laporan.cetakpersediaan',['persediaans'=>$persediaans,'total'=>$total, 'awal'=>$awal,'akhir'=>$akhir]);
      }
    }

    public function cetak_kartu_persediaan(Request $request,$awal,$akhir,$id_barang){
      $user = $request->user();
      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {  

      $kartu_persediaan = KartuPersediaan::select(DB::raw("kode_barang, nama_barang, keterangan, no_transaksi, tanggal, masuk, keluar, sisa"))
                    ->join('barang', 'kartu_persediaans.id_barang', '=' ,'barang.id')
                    ->whereBetween('tanggal', [$awal, $akhir])
                    ->where('id_barang', $id_barang)
                    ->orderBy('kartu_persediaans.id', 'asc')->get();                                
      $barang = Barang::find($id_barang);

      $total_in = 0;
      $total_out = 0;
      foreach ($kartu_persediaan as $kp ) {
        $total_out += $kp->keluar;
        $total_in += $kp->masuk;
      }

    return view('laporan.cetak_kartu_persediaan',['kartu_persediaan'=>$kartu_persediaan,'kartu_persediaan_keterangan'=>$barang, 'awal'=>$awal,'akhir'=>$akhir, 'total_in'=> $total_in, 'total_out'=> $total_out]); 
      }
    }

}
