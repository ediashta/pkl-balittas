@extends('admin/main')

@section('title', 'Pengumuman')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Pengumuman</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active"><i class="fa fa-dashboard"></i></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    @if (session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span>
            {{session('success')}}
    </div>
    @endif

    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <h3 class="m-0  text-primary">Pengumuman</h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-borderless" id="table-pengumuman">
                    <thead>
                        <tr>
                            <th hidden>id</th>
                            <th width="1%">No.</th>
                            <th width="40%">Judul</th>
                            <th width="30%">Pengumuman</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumuman as $data)
                        <tr data-id="{{$data->id}}">
                            <td hidden>{{ $data->id }}</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->judul }}</td>
                            <td>{{ $data->isi_pengumuman }}</td>
                            <td class="text-center">
                                <a href="{{ url('admin/pengumuman/' .$data->id) }}" class="btn btn-warning btn-xs btn-edit" id="edit" style="color: white;"><i class="menu-icon fa fa-pencil"></i> Edit</a>
                                <a href="javascript:void(0)" id="deletebtn" class="btn btn-danger btn-xs btn-hapus" data-id="{{$data->id}}"><i class="fa fa-trash-o"></i> Hapus </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Pengumuman</button>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Ini adalah Bagian Header Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengumuman</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Ini adalah Bagian Body Modal -->
                <form action="{{ url('admin/pengumuman') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengumuman</label>
                            <input type="text" name="judul" class="form-control" id="judulpengumuman" placeholder="Isikan Judul Pengumuman Disini" required oninvalid="this.setCustomValidity('Masukkan Judul Pengumuman Terlebih Dahulu')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="isi_pengumuman" class="form-label">Isi Pengumuman</label>
                            <textarea name="isi_pengumuman" class="form-control" id="isi_pengumuman" rows="5" placeholder="Isikan Pengumuman Disini" required oninvalid="this.setCustomValidity('Masukkan Isi Pengumuman Terlebih Dahulu')" oninput="setCustomValidity('')"></textarea>
                        </div>

                    </div>
                    <!-- Ini adalah Bagian Footer Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <!-- End Modal buat Pengumuman -->

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="deletemodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="deletemodalform" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <input type="text" hidden id="inputjudul">
                        <input type="text" hidden id="inputid">
                        <h5><strong>Yakin ingin hapus data ini?</strong></h5>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger hapus-btn">Hapus Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Modal Delete Pengumuman -->
</div>
<script>
    $(document).ready(function() {
        $('#table-pengumuman').DataTable({
            "autoWidth": false
        });
        $('#table-pengumuman').on('click', '.btn-hapus', function() {
            const id = $(this).attr('data-id');
            console.log(id);
            // var col2=currentRow.find("td:eq(1)").text();
            // var datajudul=col2;

            $tr = $(this).closest("tr");
            var dataid = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            // $('#inputjudul').val(datajudul);
            $('#inputid').val(dataid[0]);
            $('#deletemodalform').attr('action', 'admin/pengumuman/' + dataid[0]);
            $('#deletemodal').modal('show');
        });
    });
</script>

{{-- <script>
    jQuery(document).ready(function() {
        $('.btn-hapus').click(function() {
            const id = $(this).attr('data-id');
            console.log(id)
            $.ajax({
                url: 'admin/pengumuman/' + id,
                type: 'DELETE',
                data: {
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    $('#inputjudul').html(data.judul);
                    $('#inputid').html(data.id);
                }
            });
            
        });
    });
</script> --}}
@endsection