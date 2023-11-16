@extends('layout.app')
@section('title', 'kategori')
@section('content')

@if (session('success'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{ session('success') }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{ session('error') }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
@endif

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <a href="{{ @route('kate.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Kategori</a>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th>Jenis Kategori</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php $n = 1; ?>
               @foreach ($kategori as $item)    
               <tr>
                  <td>{{$n++}}</td>
                  <td>{{$item->nama_ket}}</td>
                  <td>{{$item->jns_ket}}</td>
                  <td>{{$item->deskripsi}}</td>
                  <td>
                     <form action="{{ route('kate.destroy',$item->id_ket) }}" method="POST">
                        <a href="{{ route('kate.edit', $item->id_ket) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>

@endsection