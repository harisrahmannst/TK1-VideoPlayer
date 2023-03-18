@extends('layouts/app')

@section('style')
<link href="{{ asset('css/video.css') }}" rel="stylesheet" />
<link href="{{ asset('css/list.css') }}" rel="stylesheet" />
@endsection
@section('title', 'ONEPLAY - Video Management') @section('content')
<div class="container">
  @if (session('success'))
  <div class="row justify-center">
    <div class="col-xs-12 col-md-8">
      <div class="alert alert-success alert-dismissible fade show" role="alert" id="myAlert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="closeAlert()">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </div>
  @endif
  <h1>List of Video</h1>
  <div class="row justify-center">
    <div class="col-xs-12 col-md-8 text-center">
      <table class="table table-striped" style="margin-bottom: 60px;">
        <thead>
          <tr>
            <th>No</th>
            <th style="text-align: left;">Filename</th>
            <th colspan="2" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($files) < 1) <tr>
            <td colspan="4" class="text-center">
              Videos not found.
            </td>
            </tr>
            @else
            @foreach ($files as $index=> $file)
            <tr>
              <td>{{$index + 1}}</td>
              <td data-src="{{ 'videos/' . $file->getFilename() }}" class="video-link cursor-pointer"
                data-toggle="modal" data-target="#video-modal" style="text-align: left;">{{$file->getFilename()}}</td>
              <td class="text-center">
                <a href="{{ route('dashboard.edit', $file->getFilename()) }}" class="text-secondary cursor-pointer"
                  target="_self">Edit</a>
              </td>
              <td class="text-secondary cursor-pointer text-center" data-toggle="modal" data-target="#confirm-delete"
                data-name="{{ $file->getFilename() }}">Delete</td>
            </tr>
            @endforeach
            @endif
        </tbody>
      </table>
      <a href="{{ route('dashboard.create') }}" class="btn btn-primary">+ Upload New Video</a>
    </div>
  </div>
</div>
@if(count($files) > 0)
{{-- modal video --}}
<div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="video-modal-label"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="video-modal-label"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <video src="" controls width="100%"></video>
      </div>
    </div>
  </div>
</div>
<!-- modal delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Delete</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this file?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <form id="delete-form" action="{{ route('dashboard.destroy', $file->getFilename()) }}" method="POST">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id" value="">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@section('scripts')
<script>
  const links = document.querySelectorAll('.video-link');
  const modal = document.querySelector('#video-modal');
  const video = modal.querySelector('video');
  const modalTitle = modal.querySelector('.modal-title');

  links.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const src = link.getAttribute('data-src');
      const title = link.textContent;
      video.setAttribute('src', src);
      modalTitle.textContent = title;
    });
  });

  modal.addEventListener('shown.bs.modal', e => {
    video.focus();
  });

  modal.addEventListener('hidden.bs.modal', e => {
    video.pause();
  });
</script>
<script>
  setTimeout(function () {
    document.getElementById('myAlert').classList.add('d-none');
  }, 5000);
  function closeAlert() {
    document.getElementById('myAlert').remove();
  }
</script>
<script>
  $(document).ready(function () {
    $('.delete-btn').click(function () {
      var name = $(this).data('name');
      var id = $(this).data('id');
      $('#confirm-delete .modal-body p').text('Are you sure you want to delete "' + name + '"?');
      $('#delete-form input[name="id"]').val(id);
    });
  });
</script>
@endsection