@extends('layouts/app')
@section('content')
    <div class="container">
        <h1>Upload Video</h1>
        <div class="row justify-center">
            <div class="col-xs-12 col-md-8">
                <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="input-filename" class="form-label">Filename</label>
                        <input placeholder="Input video filename" required="required" class="form-control"
                            id="input-filename" name="name">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">File video</label>
                        <input accept=".mp4" class="form-control" required="required" type="file" id="formFile"
                            name="video">
                        @error('video')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <label for="preview" class="form-label">Preview video</label><br />
                        <video id="preview" width="320" height="240" id="preview" controls></video>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Upload Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let preview = document.querySelector('#preview');
        let fileInput = document.querySelector('input[type="file"]');

        fileInput.addEventListener('change', function() {
            let file = this.files[0];
            let reader = new FileReader();

            reader.addEventListener('load', function() {
                preview.src = reader.result;
            });

            reader.readAsDataURL(file);
        });
    </script>
@endsection
