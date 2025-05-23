@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<title>Master Data E-Book</title>


<body>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body" style="border-radius: 15px;">
              <h1 class="text-center mb-4">Edit Data E-Book</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                  <form method="POST" action="{{ route('masterebook.update', $item->id) }}" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')


                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input value="{{ $item->judul }}" type="text" name="judul" class="form-control"
                                             placeholder="Masukan judul" required>
                                     </div>

                                     <div class="form-group">
                                        <label for="author">Pengarang</label>
                                        <input value="{{ $item->judul }}" type="text" name="author" class="form-control"
                                             placeholder="Masukan Pengarang" required>
                                     </div>

                                     <div class="form-group">
                                        <label for="sipnosis">Sipnosis</label>
                                        <input value="{{ $item->sipnosis }}" type="text" name="sipnosis" class="form-control"
                                             placeholder="Masukan Sipnosis" required>
                                     </div>

                                     <div class="form-group">
                                        <label for="publisher">Penerbit</label>
                                        <input value="{{ $item->publisher }}" type="text" name="publisher" class="form-control"
                                             placeholder="Masukan Penerbit" required>
                                     </div>

                                     <div class="form-group">
                                        <label for="isbn">ISBN</label>
                                        <input value="{{ $item->isbn }}" type="number" name="isbn" class="form-control"
                                             placeholder="Masukan ISBN" required>
                                     </div>

                                     <div class="form-group">
                                        <label for="tahun">Tahun Terbit</label>
                                        <input value="{{ $item->tahun }}" type="number" name="tahun" class="form-control"
                                             placeholder="Masukan Tahun Terbit" required>
                                     </div>


                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
</body>

























<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@endsection
