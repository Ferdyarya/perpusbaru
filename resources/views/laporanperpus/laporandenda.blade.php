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
                                <h3 class="m-0">Laporan Data Denda Siswa</h3>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Laporan Data Denda Siswa</li>
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
                        <form action="{{ route('laporandenda') }}" method="GET" class="row">
                            <div class="col-md-3">
                                <label for="dari">Start Date:</label>
                                <input type="date" id="dari" name="dari" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label for="sampai">End Date:</label>
                                <input type="date" id="sampai" name="sampai" class="form-control">
                            </div>

                            <div class="col-md-1 pt-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                            <div class="col-md-2 pt-4">
                                @if (!empty($filter))
                                    <a href="{{ route('laporandendapdf', $filter) }}"
                                        class="btn btn-danger btn-block">Export PDF</a>
                                @else
                                    <a href="{{ route('laporandendapdf', 'all') }}"
                                        class="btn btn-danger btn-block">Export PDF</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="px-6 py-2">No</th>
                                    <th class="px-6 py-2">Nama Peminjam</th>
                                    <th class="px-6 py-2">Tanggal Pinjam</th>
                                    <th class="px-6 py-2">Judul Buku</th>
                                    <th class="px-6 py-2">Status</th>
                                    <th class="px-6 py-2">Dibayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                              $no=1;
                              @endphp --}}
                                @foreach ($laporandenda as $index => $item)
                                    <tr>
                                        <th class="px-6 py-2">{{ $index + $laporandenda->firstItem() }}</th>
                                        <td class="px-6 py-2"><b>{{ $item->user->name }}</b></td>
                                        <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->tanggalpinjam)->format('d M Y') }}</td>
                                            <td class="px-6 py-2"><b>
                                                {{ $item->masterbuku->judul }},{{ $item->masterbuku->tahun }}
                                                <p class="text-body mt-2"></b>Author: {{ $item->masterbuku->author }}</p>
                                            </td>
                                            <td>
                                                @php
                                                    // Mengambil nilai tenggat dari objek $item
                                                    $tenggat = \Carbon\Carbon::parse($item->tenggat);

                                                    // Mendapatkan tanggal hari ini
                                                    $today = \Carbon\Carbon::now();
                                                    @endphp
                                                    @if ($today->greaterThan($tenggat))
                                                    <span class="badge bg-danger">TERLAMBAT</span>
                                                    @else
                                                    <span class="badge bg-success">NORMAL</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-2">
                                                    @if ($item->bayar)
                                                        Rp {{ $item->bayar }}
                                                        <br>
                                                        <span class="badge bg-success mt-1">LUNAS</span>
                                                    @else
                                                        Rp.0
                                                        <br>
                                                        <span class="badge bg-danger mt-1">BELUM DIBAYAR</span>
                                                    @endif
                                                </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $laporandenda->links() }}
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
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endpush
