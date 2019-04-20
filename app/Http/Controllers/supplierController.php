<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

use App\Barang;
use App\Supplier;
use Session;

class supplierController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function datasupplier(Request $request, Builder $htmlBuilder){
      $user = $request->user();
      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
        if($user->hasRole('penjaga')){
          if ($request->ajax()) {
              $supplier = Supplier::select(['id','kode_supplier','nama_supplier','alamat_supplier','no_hp','keterangan']);
              return DataTables::of($supplier)
              ->addColumn('action', function ($supplier) {
                  return view('datatable._supplierTb', [
                  'model' => $supplier,
                  'form_url' => route('hapussupplier', $supplier->id),
                  'edit_url'=> route('ngubahsupplier', $supplier->id)]);
              })
                ->addColumn('content', function ($supplier) {
                    return strip_tags($supplier->content);
                })
              ->addIndexColumn()
              ->make(true);
          }
        }else {
          if ($request->ajax()) {
              $supplier = Supplier::select(['id','kode_supplier','nama_supplier','alamat_supplier','no_hp','keterangan']);
              return DataTables::of($supplier)
              ->addColumn('action', function ($supplier) {
                  return view('datatable._supplierTb', [
                  'model' => $supplier,
                  'form_url' => route('hapussupplierpm', $supplier->id),
                  'edit_url'=> route('ngubahsupplierpm', $supplier->id)]);
              })
                ->addColumn('content', function ($supplier) {
                    return strip_tags($supplier->content);
                })
              ->addIndexColumn()
              ->make(true);
          }
        }


          $html = $htmlBuilder->addIndex(['title'=>'Nomor'])
        ->addColumn(['data'=>'kode_supplier', 'name'=>'kode_supplier', 'title'=>'Kode Supplier'])
        ->addColumn(['data'=>'nama_supplier', 'name'=>'nama_supplier', 'title'=>'Nama Supplier'])
        ->addColumn(['data'=>'alamat_supplier', 'name'=>'alamat_supplier', 'title'=>'Alamat Supplier'])
        ->addColumn(['data'=>'no_hp', 'name'=>'no_hp', 'title'=>'Nomor Handphone'])
        ->addColumn(['data'=>'keterangan', 'name'=>'keterangan', 'title'=>'Keterangan'])
        ->addColumn(['data' => 'action','name' => 'action', 'title'=> 'Lainnya', 'orderable' => false, 'searchable' => false]);

          return view('supplier.datasupplier', ['user'=>$user])->with(compact('html'));
      }
    }

    public function simpansupplier(Request $request){
      $user = $request->user();

      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          $this->validate($request, ['kode_supplier'=>'required',
                                'nama_supplier'=>'required',
                                'alamat_supplier'=>'required',
                                'no_hp'=>'required',
                                'keterangan'=>'required']);
          $posts = Supplier::create(['kode_supplier'=> $request->kode_supplier,
                                'nama_supplier'=>$request->nama_supplier,
                                'alamat_supplier'=>$request->alamat_supplier,
                                'no_hp'=>$request->no_hp,
                                'keterangan'=>$request->keterangan]);

          Session::flash("notif", [
                     "level"=>"success",
                     "message"=>"Data Supplier Berhasil Tersimpan"
                     ]);
          if ($user->hasRole('penjaga')) {
              return redirect()->route('datasupplier');
          } else {
              //return buat pemilik
          }
      }
    }

    public function ubahsupplier(Request $request, $id){
      $user = $request->user();
      if ($user->hasRole('penjaga') || $user->hasRole('pemilik')) {
          // $this->validate($request, ['kode_supplier'=>'required',
          //                       'nama_supplier'=>'required',
          //                       'alamat_supplier'=>'required',
          //                       'no_hp'=>'required',
          //                       'keterangan'=>'required']);
      $posts = Supplier::find($id);
      $posts->update(['kode_supplier'=> $request->kode_supplier,
                            'nama_supplier'=>$request->nama_supplier,
                            'alamat_supplier'=>$request->alamat_supplier,
                            'no_hp'=>$request->no_hp,
                            'keterangan'=>$request->keterangan]);
      Session::flash("notif", ["level" => "info", "message" =>"Data Supplier berhasil diubah"]);
      if ($user->hasRole('penjaga')) {
          return redirect()->route('datasupplier');
      } else {
          //return buat pemilik
      }
    }
    }

    public function hapussupplier(Request $request, $id)
    {
        $user = $request->user();
        Supplier::destroy($id);
        Session::flash("notif", [
          "level"=>"info",
          "message"=>"Data Supplier berhasil dihapus"
          ]);
          if ($user->hasRole('penjaga')) {
              return redirect()->route('datasupplier');
          } else {
              //return buat pemilik
          }
    }
}
