@extends('layouts.app_simple_bulma')

@section('title','File Uploader')

@section('content')

<div class="section">
    <div class="container">
        <h1 class="title">File Upload Test</h1>
        <form action="/process" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{-- <div class="field">
                <label class="label">File Name</label>
                <div class="control">
                    <input class="input" type="text" name="filename">
                </div>
            </div> --}}
            {{-- Select file: <input type="file" name="image"><br><br> --}}
            <div class="file">
              <label class="file-label">
                <input class="file-input" type="file" name="file">
                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fas fa-upload"></i>
                  </span>
                  <span class="file-label">
                    Choose a file…
                  </span>
                </span>
              </label>
            </div>
            <br>
            <div class="field">
              <div class="control">
                <button class="button is-link">Submit</button>
              </div>
            </div>

        </form>
    </div>
</div>


@endsection
