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
use App\Kas;
use App\Barang;
use App\Supplier;
use App\Pembelian;
use App\DetailPembelian;
use App\DetailPembelianTBS;
use App\BarangPersediaan;
use App\KartuPersediaan;

class pembelianController extends Controller
{
        public function __construct()
        {
            $this->middleware('auth');
        }

        public function datapembelian(Request $request, Builder $htmlBuilder)
        {                                                
          $user = $request->user();
          if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            $pembelians = Pembelian::select(DB::raw("pembelians.id, kode_pembelian, tanggal, nama_supplier, total_harga_beli"))                                    
                  ->join('suppliers', 'pembelians.id_supplier', '=', 'suppliers.id')
                  ->get();
            
            return view('pembelian.datapembelian',['pembelians'=>$pembelians]);
            // return view('pembelian.datapembelian_1',['pembelians'=>$pembelians]);
          }
        }

        public function lihat_nota(Request $request, $id){
          $user = $request->user();

          if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            $pembelian = Pembelian::find($id);
            $detail_pembelians = DetailPembelian::select(DB::raw("nama_barang, harga_beli, harga_jual, jumlah_beli, sub_total_harga"))
            ->join('barang', 'pembelian_details.id_barang', '=', 'barang.id')
            ->where('id_pembelian', $id)->get();                        
            $nama_supplier = Supplier::where('id', $pembelian->id_supplier)->first()->nama_supplier;                                    
            return view('pembelian.cetak_pembelian',['pembelians'=>$pembelian,'nama_supplier'=>$nama_supplier,'detailPembelian'=>$detail_pembelians]);
            // return view('pembelian.nota',['pembelian'=>$pembelian]);
          }
        }

        public function hapuspembelian(Request $request, $id)
        {
            $user = $request->user();
            Pembelian::destroy($id);  
            Session::flash("notif", [
              "level"=>"info",
              "message"=>"Data <strong>Pembelian</strong> berhasil dihapus"
              ]);
              if ($user->hasRole('pemilik')) {
                  return back();
              } 
        }                       

        public function simpanpembelian_hapusdetail(Request $request, $id){              
          $user = $request->user();
          if ($user->hasRole('pemilik')) {
              DetailPembelianTBS::where('id',$id)->delete(); 
              return back();
          }          
        }

        public function simpanpembelian(Request $request){
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
            // dd($input);
            $pesan = array(              
                'id_barang.required'     => 'Pilih Nama Barang Dahulu.',
                'jumlah_beli.required'     => 'Tentukan Jumlah Barang Dahulu.',              
            );

            $aturan = array(
                'id_barang' => 'required',
                'jumlah_beli'  => 'required'
            );            
            $validator = Validator::make($input,$aturan, $pesan);        
            if($validator->fails()) {
                # Kembali kehalaman yang sama dengan pesan error              
                return Redirect::back()->withErrors($validator)->withInput();
            }
            # Bila validasi sukses
            $tambah_barang = DetailPembelianTBS::create(['kode_pembelian'=>$request->kode_pembelian,
                                  'id_barang'=>$request->id_barang,
                                  'jumlah_beli'=>$request->jumlah_beli,
                                  'sub_total_harga'=>$request->sub_total_harga,
                                  'createdby'=>$request->createdby]);     
            return redirect()->route('tambahpembelian');                                               
          } 
          if ($request->has('simpanpembelian')) { 
            $input =$request->all();        
            // dd($input);
            $pesan = array(              
                'total_harga_beli.required'     => 'Pilih Barang Dahulu.'
            );

            $aturan = array(
                'total_harga_beli' => 'required'
            );            
            $validator = Validator::make($input,$aturan, $pesan);        
            if($validator->fails()) {
                # Kembali kehalaman yang sama dengan pesan error              
                return Redirect::back()->withErrors($validator)->withInput();
            }      
            if (!is_null($cek_pembelian = Pembelian::where('kode_pembelian', $request->kode_pembelian)->first())) {                
                Session::flash("notif", [
                     "level"=>"warning",
                     "message"=>"Data pembelian ini sudah ada, buat data pembelian baru"
                     ]);
                return back();
              }      
            $pembelians = new Pembelian;            
            $pembelians->kode_pembelian = $request->kode_pembelian;
            $pembelians->id_supplier = $request->id_supplier;
            $pembelians->tanggal = $request->tanggal;
            $pembelians->total_harga_beli = $request->total_harga_beli;
            // $pembelians->total_bayar = $request->total_bayar;
            // $pembelians->total_kembalian = $request->total_kembalian;
            $pembelians->tipe_pembayaran = $request->tipe_pembayaran;
            $pembelians->status = $request->status;
            $pembelians->createdby = $request->createdby;            
            $pembelians->save();

            // laporan penerimaan kas berdasarkan harian transaksi
            $kas = new Kas;
            $kas->kode_kas = $kd;
            $kas->id_pembelian = $pembelians->id;
            $kas->tanggal = $pembelians->tanggal;
            
            $kas->ref = $pembelians->kode_pembelian;
            $kas->debit = 0;
            $kas->kredit = $pembelians->total_harga_beli;
            $kas->createdby = $pembelians->createdby;            
            
            if( Kas::count() > 0 ) {
              $saldo_akhir = Kas::orderBy('id', 'desc')->first()->saldo;  
              $kas->saldo = $saldo_akhir - $pembelians->total_harga_beli;
              $kas->keterangan = $pembelians->tipe_pembayaran;
            } else {
              $kas->saldo = $pembelians->total_harga_beli;
              $kas->keterangan = 'Saldo Awal';
            }

            // if ($saldo_akhir - $pembelians->total_harga_beli > 0) {
            //   $kas->saldo = $saldo_akhir - $pembelians->total_harga_beli;
            // } else {
            //   $kas->saldo = 0;
            // }
            
            // dd($kas->saldo);
            $kas ->save();

            // process save detail pembelian 
            $pembelianItems = DetailPembelianTBS::all();
            foreach ($pembelianItems as $value) {
              $detail_pembelians = new DetailPembelian;
              $detail_pembelians->id_pembelian = $pembelians->id;
              $detail_pembelians->id_barang = $value->id_barang;
              $detail_pembelians->tanggal = $pembelians->tanggal;
              $detail_pembelians->jumlah_beli = $value->jumlah_beli;
              $detail_pembelians->sub_total_harga = $value->sub_total_harga;
              $detail_pembelians->status = $value->status;
              $detail_pembelians->createdby = $pembelians->createdby;              
              $detail_pembelians->save();
              //process barang persediaans
              $barang = Barang::find($value->id_barang);              
              $barang->stok = $barang->stok + $value->jumlah_beli;                          
              $barang->save();

              $cek_barang_persediaan = BarangPersediaan::where('id_barang', $value->id_barang)->get();
              if (count($cek_barang_persediaan) > 0) {               
                // barang ada di persediaan, maka timpah datanya
                $cek_barang_persediaans = BarangPersediaan::where('id_barang', $value->id_barang)->first();
                $cek_barang_persediaans->tanggal_beli = $pembelians->tanggal;
                $cek_barang_persediaans->stok_beli += $value->jumlah_beli;
                $cek_barang_persediaans->save();  
              } else {
                $barang_persediaan = new BarangPersediaan;
                $barang_persediaan->id_barang = $value->id_barang;
                $barang_persediaan->id_supplier = $pembelians->id_supplier;
                $barang_persediaan->tanggal_beli = $pembelians->tanggal;
                $barang_persediaan->stok_beli += $value->jumlah_beli;
                $barang_persediaan->createdby = $value->createdby;
                $barang_persediaan->save();              
              }              

              $kartu_persediaan = new KartuPersediaan;
              $kartu_persediaan->id_barang = $value->id_barang;
              $kartu_persediaan->keterangan = $pembelians->tipe_pembayaran;
              $kartu_persediaan->no_transaksi = $pembelians->kode_pembelian;
              $kartu_persediaan->tanggal = $pembelians->tanggal;
              $kartu_persediaan->masuk = $value->jumlah_beli;
              $kartu_persediaan->keluar = 0;
              $kartu_persediaan->sisa = $barang->stok;
              $kartu_persediaan->createdby = $pembelians->createdby;  
              $kartu_persediaan->save();
              
            }
            //delete all data on ReceivingTemp model
            DetailPembelianTBS::truncate();

            // menampilkan struk pembelian
            // $detail_pembelians = DetailPembelian::select(DB::raw("nama_barang, harga_beli, harga_jual, jumlah_beli, sub_total_harga"))->join('barang', 'pembelian_details.id_barang', '=', 'barang.id')
            //                     ->where('id_pembelian', $pembelians->id)->get();
            // $pembelian = Pembelian::find($pembelians->id);
            // $nama_supplier = Supplier::where('id', $request->id_supplier)->first()->nama_supplier;            
            // return view('pembelian.cetak_pembelian',['pembelians'=>$pembelian,'nama_supplier'=>$nama_supplier,'detailPembelian'=>$detail_pembelians]);

            // kembali ke tambah transaksi dengan message sukses
            Session::flash("notif", [
                     "level"=>"success",
                     "message"=>"Transaksi <strong>Pembelian</strong> Berhasil Tersimpan"
                     ]);
            return redirect()->route('tambahpembelian');                           
          }                    
          }
        }

        public function lihat_tanggal(Request $request){
          $user = $request->user();
          $tanggal = $request->tanggal;

          if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {            
            $pembelians = Pembelian::select(DB::raw("pembelians.id, kode_pembelian, tanggal, nama_supplier, total_harga_beli"))
                  ->join('suppliers', 'pembelians.id_supplier', '=', 'suppliers.id')
                  // ->orderBy('tanggal', 'desc')
                  ->whereBetween('tanggal', [$request->tanggalawal, $request->tanggalakhir])
                  ->get();
            $harga_total =  DB::table('pembelians')
                          ->whereBetween('tanggal', [$request->tanggalawal, $request->tanggalakhir])
                          ->sum('total_harga_beli');

            return view('pembelian.lihatdata',['pembelians'=>$pembelians,'harga_total'=>$harga_total, 'awal'=>$request->tanggalawal,'akhir'=>$request->tanggalakhir]);            
          }
        }
        public function cetak(Request $request,$awal,$akhir){
          $user = $request->user();

          if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
            $pembelians = Pembelian::select(DB::raw("pembelians.id, kode_pembelian, tanggal, nama_supplier, total_harga_beli"))
                  ->join('suppliers', 'pembelians.id_supplier', '=', 'suppliers.id')
                  // ->orderBy('tanggal', 'desc')
                  ->whereBetween('tanggal', [$awal, $akhir])
                  ->get();
            $total =  DB::table('pembelians')
                          ->whereBetween('tanggal', [$awal, $akhir])
                          ->sum('total_harga_beli');

            return view('pembelian.cetak',['pembelians'=>$pembelians,'total'=>$total, 'awal'=>$awal,'akhir'=>$akhir]);

          }
        }
}
