@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создать новость</div>

                <div class="card-body">
                  <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label for="title">Название</label>
                      <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" placeholder="Введите название новости" name="title" value="{{old('title')}}">
                      @error('title')
                          <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <div class="custom-file">
                       <input type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" id="image" name="image">
                       <label class="custom-file-label" for="image">Прикрепить главное изображение</label>
                       @error('image')
                           <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                       @enderror
                     </div>

                     <div class="form-group">
                       <label for="description">Описание</label>
                       <textarea id="description" name="description" rows="8" cols="50" class="form-control summernote"></textarea>
                       @error('description')
                           <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                       @enderror
                     </div>

                    <div class="form-group">
                      <label for="content">Содержимое</label>
                      <textarea id="content" name="content" rows="8" cols="50" class="form-control summernote"></textarea>
                      @error('content')
                          <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                      @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Создать</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
        $('.summernote').summernote({
          height: 200,
          minHeight: 200,
          callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
                that = $(this);
            }
          }
        });
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "{{ route('upload') }}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    $(that).summernote('insertImage', url)
                }
            });
        };
    });
  </script>
@endsection
