@extends('adminlte::page')

@section('title', 'Pengelolaan Buku')

@section('content_header')
    <h1>Pengelolaan Buku</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('Pengelolaan Buku') }}</div>
                <div class="card-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Tambah Data</button>
                    </hr>
                     <table id="table-data" class="table table-borderer">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>JUDUL</th>
                                <th>PENULIS</th>
                                <th>TAHUN</th>
                                <th>PENERBIT</th>
                                <th>COVER</th>
                                <th>AKSI</th>    
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->tahun }}</td>
                                    <td>{{ $book->penerbit }}</td>
                                        <td>
                                         @if($book->cover !==null)
                                            <img src="{{ asset('storage/cover_buku/'.$book->cover) }}" width="10px"/>
                                         @else
                                            [gambar tak tersedia]
                                         @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" ariaa-label="Basic example">
                                                <button type="button" id="btn-edit-buku" class="btn btn-success" data-toggle="modal" data-target="#editBukuModal" data-id="{{$book->id}}">Edit</button>

                                                <button type="button" id="btn-delete-buku" class="btn btn-danger">Hapus</button>

                                            </div>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal tambah buku --}}
<div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.book.submit') }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBukuLabel">{{ _('Tambah Data Buku') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputJudul">Judul Buku</label>
                            <input type="text" class="form-control" id="inputJudul" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="inputPenulis">Penulis</label>
                            <input type="text" class="form-control" id="inputPenulis" name="penulis">
                        </div>
                        <div class="form-group">
                            <label for="inputTahun">Tahun</label>
                            <input type="number" class="form-control" id="inputTahun" name="tahun">
                        </div>
                        <div class="form-group">
                            <label for="inputPenerbit">Penerbit</label>
                            <input type="text" class="form-control" id="inputPenerbit" name="penerbit">
                        </div>
                        <div class="form-group">
                            <label for="inputCover">Cover</label>
                            <input type="file" class="form-control-file" id="inputCover" name="cover">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- end Modal tambah buku--}}
    
    {{-- Modal edit buku --}}
    <div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="editBukuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.book.update') }}" enctype="multipart/form-data">
                   @csrf
                   @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBukuLabel">{{ _('Edit Data Buku') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" id="editId" name="id">
                                <input type="hidden" id="editOldCover" name="old_cover">
                                <div class="form-group">
                                    <label for="editJudul">Judul Buku</label>
                                    <input type="text" class="form-control" id="editJudul" name="judul">
                                </div>
                                <div class="form-group">
                                    <label for="editPenulis">Penulis</label>
                                    <input type="text" class="form-control" id="editPenulis" name="penulis">
                                </div>
                                <div class="form-group">
                                    <label for="editTahun">Tahun</label>
                                    <input type="number" class="form-control" id="editTahun" name="tahun">
                                </div>
                                <div class="form-group">
                                    <label for="editPenerbit">Penerbit</label>
                                    <input type="text" class="form-control" id="editPenerbit" name="penerbit">
                                </div>
                            </div>
                            <div class="col">
                                <div id="image-area" class="pt-3"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editCover">Cover</label>
                            <input type="file" class="form-control-file" id="editCover" name="cover">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{-- end Modal edit buku--}}
@stop

@section('js')
<script>
    $(function(){
        $(document).on('click', '#btn-edit-buku', function(){
            let id = $(this).data('id');
            $('#image-area').empty();
            $.ajax({
                type: "get",
                url: `${baseUrl}/admin/ajaxadmin/dataBuku/${id}`,
                dataType: "json",
                success: function(res){
                    $('#editjudul').val(res.judul);
                    $('#editpenerbit').val(res.penerbit);
                    $('#edittahun').val(res.tahun);
                    $('#editpenulis').val(res.penulis);
                    $('#editid').val(res.id);
                    $('#editoldCover').val(res.cover);
                    if (res.cover !== null) {
                        $('#image-area').append(`<img class="img-thumbnail" src="${baseUrl}/storage/cover_buku/${res.cover}" width="200px" />`);
                    } else {
                        $('#image-area').append(`[Gambar tidak tersedia]`);
                    }
                },
            });
        });
    });
</script>
@stop