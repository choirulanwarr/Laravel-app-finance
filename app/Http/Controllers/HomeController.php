<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
   public function index()
   {
      $saldo = DB::table('transaksis')
               ->sum('transaksis.nominal');
      $pemasukan = DB::table('transaksis')
               ->join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id_ket')
               ->where('kategoris.jns_ket', '=', 'Pemasukan')
               ->sum('transaksis.nominal');
      $pengeluaran = DB::table('transaksis')
               ->join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id_ket')
               ->where('kategoris.jns_ket', '=', 'Pengeluaran')
               ->sum('transaksis.nominal');
       return view('home', compact('pemasukan','pengeluaran','saldo'));
   }

   public function search(Request $request)
    {
        $start_date= $request->input('start_date');
        $end_date= $request->input('end_date');
        $transaksi = Transaksi::join('kategoris','kategoris.id_ket','=','transaksis.kategori_id')
                        ->whereBetween('transaksis.tanggal',[$start_date, $end_date])
                        ->get(['transaksis.id_trans','transaksis.tanggal', 'kategoris.nama_ket', 'kategoris.jns_ket', 'transaksis.nominal','transaksis.deskripsi']);
        $saldo = DB::table('transaksis')
            ->sum('transaksis.nominal');
        return view('transaksi.index', compact('transaksi','saldo'));
    }

}