@extends('layout.admin')

@section('content')
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
</head>

<title>Peminjaman</title>

<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body">
                <h1 class="text-center mb-4">Tambah Data Peminjaman</h1>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="card" style="border-radius: 10px;">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('peminjaman.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label for="id_buku">Judul Buku</label>
                                            <select class="form-select" name="id_buku" id="judulbuku" style="border-radius: 8px;">
                                                <option></option>
                                                @foreach ($masterbuku as $item)
                                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="id_anggota">Nama Anggota</label>
                                            <input type="text" class="form-control" id="id_anggota" value="{{ Auth::user()->name }}" readonly>
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="id_anggota">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="tanggalpinjam">Tanggal Peminjaman</label>
                                            <input type="date" name="tanggalpinjam" class="form-control @error('tanggalpinjam') is-invalid @enderror" id="tanggalpinjam" style="border-radius: 8px;" value="{{ old('tanggalpinjam') }}" min="{{ \Carbon\Carbon::now()->toDateString() }}" max="2100-12-31" required>
                                            @error('tanggalpinjam')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="jumlah">Qty</label>
                                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" style="border-radius: 8px;" value="{{ old('jumlah') }}" required>
                                            @error('jumlah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div id="newrow"></div>

                                        <div class="container">
                                            <div class="row justify-content-end mb-4">
                                                <div class="col-auto">
                                                    <button type="button" name="name" id="addrow" class="btn btn-primary">
                                                        Add More
                                                    </button>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-success">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for the initial select element
            $('#judulbuku').select2({
                theme: 'bootstrap-5',
                placeholder: 'PILIH JUDUL BUKU',
                width: '100%'
            });

            // Add new row functionality
            $('#addrow').click(function() {
                var html = `
                <div class="card" style="border-radius: 10px; margin-bottom: 15px;">
                    <div class="card-body hapus">
                        <div class="form-group mb-3">
                            <label for="id_buku">Judul Buku</label>
                            <select class="form-select" name="id_buku[]" style="border-radius: 8px;">
                                <option></option>
                                @foreach ($masterbuku as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_anggota">Nama Anggota</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            <input type="hidden" value="{{ Auth::user()->id }}" name="id_anggota[]">
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggalpinjam">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalpinjam" class="form-control @error('tanggalpinjam') is-invalid @enderror" id="tanggalpinjam" style="border-radius: 8px;" value="{{ old('tanggalpinjam') }}" min="{{ \Carbon\Carbon::now()->toDateString() }}" max="2100-12-31" required>
                                @error('tanggalpinjam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah">Qty</label>
                            <input type="number" name="jumlah[]" class="form-control" style="border-radius: 8px;"
                                value="{{ old('jumlah') }}" required>
                        </div>

                        <button type="button" class="btn btn-danger mt-3 remove-table-row">Remove</button>
                    </div>
                </div>`;

                $('#newrow').append(html);

                // Initialize Select2 for the newly added select element
                $('#newrow').find('select:last').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'PILIH JUDUL BUKU',
                    width: '100%'
                });
            });

            // Remove row functionality
            $(document).on('click', '.remove-table-row', function() {
                $(this).closest('.hapus').remove();
            });
        });
    </script>
@endsection
