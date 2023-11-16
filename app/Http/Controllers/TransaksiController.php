<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $currentTime = Carbon::now();
        $time = $currentTime->toDateTimeString();
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $time)->month;
        $year = Carbon::createFromFormat('Y-m-d H:i:s', $time)->year;
        $transaksi = Transaksi::join('kategoris','kategoris.id_ket','=','transaksis.kategori_id')
            ->whereMonth('transaksis.tanggal','=',$month)
            ->whereYear('transaksis.tanggal','=',$year)
            ->get(['transaksis.id_trans','transaksis.tanggal', 'kategoris.nama_ket', 'kategoris.jns_ket', 'transaksis.nominal','transaksis.deskripsi']);
        $saldo = DB::table('transaksis')
            ->sum('transaksis.nominal');
        
        return view('transaksi.index', compact('transaksi','saldo'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('transaksi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);

        $post = Transaksi::create([
            'kategori_id' => $request->kategori_id,
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($post) {
            return redirect()
                ->route('trans.index')
                ->with([
                    'success' => 'Data Berhasil Ditambahkan'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }

    }

    public function edit(Transaksi $tran)
    {
        $kate = Kategori::all();
        return view('transaksi.edit', compact('tran','kate'));
    }

    public function update(Request $request, Transaksi $tran)
    {
        $request->validate([
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);

        $post = $tran->update($request->all());

        if ($post) {
            return redirect()
                ->route('trans.index')
                ->with([
                    'success' => 'Data Berhasil Diubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function destroy(Transaksi $tran)
    {
        $post = $tran->delete();

        if ($post) {
            return redirect()
                ->route('trans.index')
                ->with([
                    'success' => 'Data Berhasil Dihapus'
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }
}
