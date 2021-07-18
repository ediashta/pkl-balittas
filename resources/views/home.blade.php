@extends('main')

@section('title', 'Home')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Home</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active"><i class="fa fa-home"></i></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid" style="padding-top: 16px;">
    <div class="row justify-content-center">
        <!-- template -->
        <div class="col-sm-8 p-r-16">
            <div class="card shadow" style="height: 70vh;">
                <div class="card-header py-3">
                    <h6 class="m-0 text-primary">Pengumuman</h6>
                </div>
                <div class="card-body">
                    <p>Pengumuman disini
                    </p>
                </div>
            </div>
        </div>
        <div class="col w-40">
            <!-- perencanaan -->
            <div class="col">
                <div class="card order-card shadow">
                    <div class="card-block">
                        <a href="/upload" class="stretched-link">
                            <h4 class="m-b-20">Perencanaan</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- report  -->
            <div class="col">
                <div class="card order-card shadow">
                    <div class="card-block">
                        <a href="/report" class="stretched-link">
                            <h4 class="m-b-20">Report</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- revisi -->
            <div class="col">
                <div class="card order-card shadow">
                    <div class="card-block">
                        <a href="/revisi" class="stretched-link">
                            <h4 class="m-b-20">Revisi</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- template -->
            <div class="col">
                <div class="card order-card shadow">
                    <div class="card-block">
                        <a href="#" class="stretched-link" data-toggle="modal" data-target="#myModal">
                            <h4 class="m-b-20">Download Template</h4>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="column">
                    <div class="card shadow" style="height: 60vh;">
                        <div class="card-header py-3">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Download</a>     
                        </div>
                        <div class="card-body">
                            <p>Template disini
                            </p>
                        </div>
                    </div>
                </div> --}}

        </div>
    </div>
</div>
<!-- End of Main Content -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Ini adalah Bagian Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Download Template</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Ini adalah Bagian Body Modal -->
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>File Name</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi dari keluaran data -->
                        @foreach($file as $f)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $f->nama_file }}</td>
                            <td class="text-center"><a href=""><i class="btn btn-success">Download</i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Ini adalah Bagian Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>


@endsection