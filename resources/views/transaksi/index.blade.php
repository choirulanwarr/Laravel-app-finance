@extends('layout.app')
@section('title', 'transaksi')
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
      <a href="{{ @route('trans.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Transaksi</a>
      <span>Saldo Saat ini:@currency($saldo)</span>
   </div>
   <div class="card-body">
      <form action="{{ url('home/search')}}" method="GET">
         <div class="row" style="margin-bottom:20px;">
            <div class="col-4">
               <input type="date" class="form-control" name="start_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-4">
               <input type="date" class="form-control" name="end_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-4">
               <button type="submit" class="btn btn-light">Filter Pencarian</button>
            </div>
         </div>
      </form>
      
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Jenis Transakasi</th>
                  <th>Tanggal</th>
                  <th>Kategori</th>
                  <th>Nominal</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php $n = 1; ?>
               @foreach ($transaksi as $item)    
               <tr>
                  <td>{{$n++}}</td>
                  <td>{{$item->jns_ket}}</td>
                  <td>{{$item->tanggal}}</td>
                  <td>{{$item->nama_ket}}</td>
                  <td>@currency($item->nominal)</td>
                  <td>{{$item->deskripsi}}</td>
                  <td>
                     <form action="{{ route('trans.destroy',$item->id_trans) }}" method="POST">
                        <a href="{{ route('trans.edit', $item->id_trans) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
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