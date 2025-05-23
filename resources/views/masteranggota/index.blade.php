@extends('layout.admin')
@push('css')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
          <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <div class="content-header">
                      <div class="row mb-2">
                          <div class="col-sm-6">
                              <h1 class="m-0">Master Data Anggota</h1>
                          </div><!-- /.col -->
                          <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                  <li class="breadcrumb-item active">Master Data Anggota</li>
                              </ol>
                          </div><!-- /.col -->
                      </div><!-- /.row -->
              </div>

              {{-- CRUD --}}
              <!-- Required meta tags -->
              {{--
              <meta charset="utf-8" />
              <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> --}}



              <div class="container">
                  {{-- search --}}
                  <div class="row g-3 align-items-center mb-4">
                      <div class="col-auto">
                          <form action="masteranggota" method="GET">
                              <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                          </form>
                      </div>

                      {{-- Button Export PDF --}}
                      @if (Auth::user()->hakakses('siswa'))
                      <div class="col-auto">
                          <a href="{{ route('masteranggota.create')}}" class="btn btn-success">
                              Tambah Data
                          </a>
                          {{-- <a href="{{ route('masteranggotapdf')}}" class="btn btn-danger">
                              Export PDF
                          </a> --}}
                      </div>
                      @endif
                  </div>

                  <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="px-6 py-2">No</th>
                                <th class="px-6 py-2">Nama Anggota</th>
                                <th class="px-6 py-2">Email</th>
                                <th class="px-6 py-2">No Telpon</th>
                                <th class="px-6 py-2">Kelas</th>
                                <th class="px-6 py-2">Jenis Kelamin</th>
                                <th class="px-6 py-2">Tanggal Lahir</th>
                                @if (Auth::user()->hakakses('kepalaperpus') || Auth::user()->hakakses('petugas'))
                                <th class="px-6 py-2">Status</th>
                                @endif
                                @if (Auth::user()->hakakses('siswa'))
                                <th class="px-6 py-2">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($masteranggota as $index => $item)
                            <tr>
                                <th class="px-6 py-2">{{ $index + $masteranggota->firstItem() }}</th>
                                <td class="px-6 py-2">{{ $item->user->name }}</td>
                                <td class="px-6 py-2">{{ $item->email }}</td>
                                <td class="px-6 py-2">{{ $item->no_telp }}</td>
                                <td class="px-6 py-2">{{ $item->kelas }}</td>
                                <td class="px-6 py-2">{{ $item->jeniskelamin }}</td>
                                <td class="px-6 py-2">{{ $item->tgl_lahir }}</td>
                                @if (Auth::user()->hakakses('kepalaperpus') || Auth::user()->hakakses('petugas'))
                                <td class="px-6 py-2">
                                    {{ $item->status }}
                                    <!-- Tombol Verifikasi -->
                                    @if($item->status !== 'verifikasi')
                                    <form action="{{ route('items.verify', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Verifikasi</button>
                                    </form>
                                    @endif
                                </td>
                                @endif
                                @if (Auth::user()->hakakses('siswa'))
                                <td class="px-6 py-2">
                                    <a href="{{ route('masteranggota.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('masteranggota.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                      {{ $masteranggota->links() }}
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<!-- Optional JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script>
    @if(Session::has('success'))
toastr.success("{{ Session::get('success')}}")
@endif
</script>
@endpush
