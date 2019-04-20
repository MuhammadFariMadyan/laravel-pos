<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use App\Barang;
use App\Kas;
use App\Supplier;
use App\Penjualan;
use App\DetailPenjualan;
use App\DetailPenjualanTBS;
use App\BarangPersediaan;
use App\KartuPersediaan;

class penjualanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function datapenjualan(Request $request, Builder $htmlBuilder)
    {
            
        $user = $request->user();
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            return view('penjualan.datapenjualan');
        }
    }

    // public function simpanpenjualan_editdetail(Request $request, $id){
    //       $user = $request->user();
    //       if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) { 
    //         $detail_barang = DetailPenjualanTBS::find($id); 
    //         return view('penjualan.tambah', ['detail_barang'=>$detail_barang]);
    //       }
    //     }

      public function simpanpenjualan_hapusdetail(Request $request, $id){              
        $user = $request->user();
        if ($user->hasRole('penjaga')) {
            DetailPenjualanTBS::where('id',$id)->delete(); 
            return back();
        }          
      }

    public function simpanpenjualan(Request $request){
      $user = $request->user(); 
      $prefix = DB::table('config')->select('value')->where('key','prefix_kode_kas')->first()->value;
      $data = Kas::count();                    
      $prx=$prefix;
      if($data>0)
      {                        
        $kode_kas = Kas::orderBy('id', 'desc')->first()->kode_kas;      
        $kd_max = Str::substr($kode_kas, 7);        
        $tmp = ((int)$kd_max)+1;
        $kd = $prx.sprintf("%04s", $tmp);            
      }
      else
      {
          $kd = $prx."0001";
      }
        if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          if ($request->has('tambah_barang')) {                        
            $input =$request->all();        
            $pesan = array(              
                'id_barang.required'     => 'Pilih Nama Barang Dahulu.',
                'jumlah_jual.required'     => 'Tentukan Jumlah Barang Dahulu.',              
            );

            $aturan = array(
                'id_barang' => 'required',
                'jumlah_jual'  => 'required'
            );            
            $validator = Validator::make($input,$aturan, $pesan);        
            if($validator->fails()) {
                # Kembali kehalaman yang sama dengan pesan error              
                return Redirect::back()->withErrors($validator)->withInput();
            }
            # Bila validasi sukses
            $tambah_barang = new DetailPenjualanTBS;
            $tambah_barang->kode_penjualan = $request->kode_penjualan;
            $tambah_barang->id_barang = $request->id_barang;

            $stok_barang = Barang::where('id', $request->id_barang)->first()->stok;            
            if ($stok_barang - (int)$request->jumlah_jual >= 0 ) {
              $tambah_barang->jumlah_jual = $request->jumlah_jual;
              $tambah_barang->harga_jual_akhir = $request->harga_jual_akhir;
              $tambah_barang->sub_total_harga = $request->sub_total_harga;
              $tambah_barang->createdby = $request->createdby;
              $tambah_barang->save();
              return redirect()->route('tambahpenjualan');
            }else {
              Session::flash("notif", [
                     "level"=>"warning",
                     "message"=>"Penambahan barang Gagal, Stok Tidak Cukup | stok = {$stok_barang} "
                     ]);
              return redirect()->route('tambahpenjualan');
            }
          } 
          if ($request->has('simpanpenjualan')) {             
            $input =$request->all();        
            // dd($input);
            $pesan = array(              
                'total_bayar.required'     => 'Tentukan Nominal Jumlah Bayar Dahulu.',
                'tanggal.required'     => 'Tentukan Tanggal Pembayaran Penjualan Dahulu.',
            );

            $aturan = array(
                'total_bayar' => 'required',
                'tanggal' => 'required',
            );            
            $validator = Validator::make($input,$aturan, $pesan);        
            if($validator->fails()) {
                # Kembali kehalaman yang sama dengan pesan error              
                return Redirect::back()->withErrors($validator)->withInput();
            }
            # Bila validasi sukses   
            if (!is_null($cek_penjualan = Penjualan::where('kode_penjualan', $request->kode_penjualan)->first())) {
                // dd('data penjualan ini sudah ada, buat data penjualan baru');
                Session::flash("notif", [
                     "level"=>"warning",
                     "message"=>"Data penjualan ini sudah ada, buat data penjualan baru"
                     ]);
                return back();
              }      
            $penjualans = new Penjualan;            
            $penjualans->kode_penjualan = $request->kode_penjualan;
            // $penjualans->pelanggan = $request->pelanggan;
            $penjualans->tanggal = $request->tanggal;
            $penjualans->total_harga_jual = $request->total_harga_jual;
            $penjualans->total_bayar = $request->total_bayar;
            $penjualans->total_kembalian = $request->total_kembalian;
            $penjualans->tipe_pembayaran = $request->tipe_pembayaran;
            $penjualans->status = $request->status;
            $penjualans->createdby = $request->createdby;              
            $penjualans->save();
            // laporan penerimaan kas berdasarkan harian transaksi
            $kas = new Kas;
            $kas->kode_kas = $kd;
            $kas->id_penjualan = $penjualans->id;
            $kas->tanggal = $penjualans->tanggal;
            $kas->keterangan = $penjualans->tipe_pembayaran;
            $kas->ref = $penjualans->kode_penjualan;
            $kas->debit = $penjualans->total_harga_jual;
            $kas->kredit = 0;
            $kas->createdby = $penjualans->createdby;                        
            
            if (Kas::count() > 0){
              $saldo_akhir = Kas::orderBy('id', 'desc')->first()->saldo;
            } else {
              $saldo_akhir = 0;
            }

            // if ($saldo_akhir + $penjualans->total_harga_jual > 0) {
            //   $kas->saldo = $saldo_akhir + $penjualans->total_harga_jual;
            // } else {
            //   $kas->saldo = 0;
            // }  
            $kas->saldo = $saldo_akhir + $penjualans->total_harga_jual;          
            // dd($kas->saldo);
            $kas ->save();                                                         
            // process save detail penjualan berdasarkan barang dan supplier untuk merincikan penyediaan barang.
            $penjualanItems = DetailPenjualanTBS::all();
            foreach ($penjualanItems as $value) {
              $detail_penjualans = new DetailPenjualan;
              $detail_penjualans->id_penjualan = $penjualans->id;
              $detail_penjualans->id_barang = $value->id_barang;              
              $detail_penjualans->jumlah_jual = $value->jumlah_jual;
              $detail_penjualans->harga_jual_akhir = $value->harga_jual_akhir;              
              $detail_penjualans->sub_total_harga = $value->sub_total_harga;
              $detail_penjualans->status = $value->status;
              $detail_penjualans->createdby = $penjualans->createdby;              
              $detail_penjualans->save();
              //process barang persediaans
              $barang = Barang::where('id', $value->id_barang)->first(); 
              $barang->stok = $barang->stok - $value->jumlah_jual;                          
              $barang->save();              

              $cek_barang_persediaan = BarangPersediaan::where('id_barang', $value->id_barang)->get();
              if (count($cek_barang_persediaan) > 0) {                
                $cek_barang_persediaans = BarangPersediaan::where('id_barang', $value->id_barang)->first();
                $cek_barang_persediaans->tanggal_jual = $penjualans->tanggal;
                $cek_barang_persediaans->stok_jual += $value->jumlah_jual;
                $cek_barang_persediaans->save();  
              } else {
                $barang_persediaan = new BarangPersediaan;
                $barang_persediaan->id_barang = $value->id_barang;
                $barang_persediaan->id_supplier = $value->id_supplier;
                $barang_persediaan->tanggal_jual = $penjualans->tanggal;
                $barang_persediaan->stok_jual += $value->jumlah_jual;
                $barang_persediaan->createdby = $value->createdby;
                $barang_persediaan->save();              
              } 

              $kartu_persediaan = new KartuPersediaan;
              $kartu_persediaan->id_barang = $value->id_barang;
              $kartu_persediaan->keterangan = $penjualans->tipe_pembayaran;
              $kartu_persediaan->no_transaksi = $penjualans->kode_penjualan;
              $kartu_persediaan->tanggal = $penjualans->tanggal;
              $kartu_persediaan->masuk = 0;
              $kartu_persediaan->keluar = $value->jumlah_jual;
              $kartu_persediaan->sisa = $barang->stok;
              $kartu_persediaan->createdby = $penjualans->createdby;   
              $kartu_persediaan->save();

            }
            //delete all data on ReceivingTemp model
            DetailPenjualanTBS::truncate();
            $detail_penjualans = DetailPenjualan::select(DB::raw("nama_barang, harga_jual, jumlah_jual, diskon, penjualan_details.harga_jual_akhir,sub_total_harga"))->join('barang', 'penjualan_details.id_barang', '=', 'barang.id')
              ->where('id_penjualan', $penjualans->id)
              ->get();
            $penjualan = Penjualan::find($penjualans->id);            
            Session::flash("notif", [
                     "level"=>"success",
                     "message"=>"Transaksi <strong>Penjualan</strong> Berhasil Tersimpan"
                     ]);
            return view('penjualan.cetak_penjualan',['penjualans'=>$penjualan,'detailPenjualan'=>$detail_penjualans]);                          
          }                    
          }
        }

    public function lihat_tanggal(Request $request){
      $user = $request->user();
      $tanggal = $request->tanggal;

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $penjualans = Penjualan::where('tanggal', $request->tanggal)
                               ->orderBy('tanggal', 'desc')
                               ->get();
        return view('penjualan.lihatdata',['penjualans'=>$penjualans, 'tanggal'=>$tanggal]);

      }
    }

    public function lihat_nota(Request $request, $id){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $penjualan = Penjualan::find($id);
        $detail_penjualans = DetailPenjualan::select(DB::raw("nama_barang, harga_jual, jumlah_jual, diskon, penjualan_details.harga_jual_akhir,sub_total_harga"))->join('barang', 'penjualan_details.id_barang', '=', 'barang.id')
              ->where('id_penjualan', $id)
              ->get(); 
        // cetak nota                       
        return view('penjualan.cetak_penjualan',['penjualans'=>$penjualan,'detailPenjualan'=>$detail_penjualans]);
      }
    }

    public function cetak(Request $request,$id){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        $penjualans = Penjualan::where('tanggal', $id)
                               ->orderBy('tanggal', 'desc')
                               ->get();
        $total = DB::table('penjualans')
                ->where('tanggal',$id)
                ->sum('total_harga_jual');

        return view('penjualan.cetak',['penjualans'=>$penjualans,'total'=>$total]);

      }
    }

    public function hapuspenjualan(Request $request, $id)
    {
        $user = $request->user();
        Penjualan::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Data <strong>Penjualan</strong> berhasil dihapus"
          ]);
          if ($user->hasRole('penjaga')) {
              return back();
          } else {
              //return buat pemilik
          }
    }
}
