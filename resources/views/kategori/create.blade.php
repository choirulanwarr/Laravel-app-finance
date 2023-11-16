@extends('layout.app')
@section('title', 'tambah kategori')
@section('content')

<div class="col-6">
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="text-primary">Tambah Kategori</h6>
      </div>
      <div class="card-body">
         <form action="{{ route('kate.store') }}" method="post">
            @csrf
            <div class="form-group">
               <label>Nama</label>
               <input type="text" name="nama_ket" class="form-control">
               @error('nama_ket')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Kategori</label>
               <select name="jns_ket" class="form-control">
                  <option value="">-Pilih Satu-</option>
                  <option value="Pengeluaran">Pengeluaran</option>
                  <option value="Pemasukan">Pemasukan</option>
               </select>
               @error('jns_ket')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Deskripsi</label>
               <input type="text" name="deskripsi" class="form-control">
               @error('deskripsi')
                  {{$message}}
               @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('kate.index') }}" type="button" class="btn btn-light"><i class="fa fa-ban"></i> Cancel</a>
         </form>
      </div>
   </div>
</div>

@endsection