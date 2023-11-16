<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index', [
            'kategori' => Kategori::orderBy('nama_ket', 'ASC')->get()
        ]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ket' => 'required',
            'jns_ket' => 'required',
            'deskripsi' => 'required'
        ]);

        $post = Kategori::create([
            'nama_ket' => $request->nama_ket,
            'jns_ket' => $request->jns_ket,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($post) {
            return redirect()
                ->route('kate.index')
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

    public function edit(Kategori $kate)
    {
        return view('kategori.edit', compact('kate'));
    }

    public function update(Request $request, Kategori $kate)
    {
        $request->validate([
            'nama_ket' => 'required',
            'jns_ket' => 'required',
            'deskripsi' => 'required'
        ]);

        $post = $kate->update($request->all());

        if ($post) {
            return redirect()
                ->route('kate.index')
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

    public function destroy(Kategori $kate)
    {
        $post = $kate->delete();

        if ($post) {
            return redirect()
                ->route('kate.index')
                ->with([
                    'success' => 'Data Berhasil Dihapus'
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
}
