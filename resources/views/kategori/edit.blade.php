@extends('layout.app')
@section('title', 'edit kategori')
@section('content')

<div class="col-6">
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="text-primary">Edit Kategori</h6>
      </div>
      <div class="card-body">
         <form action="{{ route('kate.update',$kate->id_ket) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
               <label>Nama</label>
               <input type="text" name="nama_ket" class="form-control" value="{{ $kate->nama_ket }}">
               @error('nama_ket')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Kategori</label>
               <select name="jns_ket" class="form-control">
                  @if ($kate->jns_ket == "Pemasukan")
                     <option value="{{ $kate->jns_ket }}">{{ $kate->jns_ket }}</option>
                     <option value="Pengeluaran">Pengeluaran</option>
                  @else
                     <option value="{{ $kate->jns_ket }}">{{ $kate->jns_ket }}</option>
                     <option value="Pemasukan">Pemasukan</option>
                  @endif
               </select>
               @error('jns_ket')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Deskripsi</label>
               <input type="text" name="deskripsi" class="form-control" value="{{ $kate->deskripsi }}">
               @error('deskripsi')
                  {{$message}}
               @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
            <a href="{{ route('kate.index') }}" type="button" class="btn btn-light"><i class="fa fa-ban"></i> Cancel</a>
         </form>
      </div>
   </div>
</div>

@endsection