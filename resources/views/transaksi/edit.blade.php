@extends('layout.app')
@section('title', 'edit transaksi')
@section('content')

<div class="col-6">
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="text-primary">Edit Transaksi</h6>
      </div>
      <div class="card-body">
         <form action="{{ route('trans.update',$tran->id_trans) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
               <label>Transaksi</label>
               <select name="kategori_id" class="form-control">
                  <option value="">-Pilih Satu-</option>
                  @foreach ($kate as $kat) 
                     <option value="{{ $kat->id_ket }}" {{ $kat->id_ket == $tran->kategori_id ? 'selected' : '' }}>{{ $kat->nama_ket }}</option>
                  @endforeach
               </select>
               @error('kategori_id')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Nominal</label>
               <input type="number" name="nominal" class="form-control" value="{{ $tran->nominal }}">
               @error('nominal')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Tanggal</label>
               <input type="date" name="tanggal" class="form-control" value="{{ $tran->tanggal }}">
               @error('tanggal')
                  {{$message}}
               @enderror
            </div>
            <div class="form-group">
               <label>Deskripsi</label>
               <textarea name="deskripsi" cols="30" rows="5" class="form-control">{{ $tran->deskripsi }}</textarea>
               @error('deskripsi')
                  {{$message}}
               @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
            <a href="{{ route('trans.index') }}" type="button" class="btn btn-light"><i class="fa fa-ban"></i> Cancel</a>
         </form>
      </div>
   </div>
</div>

@endsection