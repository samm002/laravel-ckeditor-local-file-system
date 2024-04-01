<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Post By Id</title>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
</head>
<body>
  <h1>CK Editor Create Post</h1>
  <form action="{{ route('update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
      <label>Title</label>
      <input type="text" name="title" value="{{ $post->title }}">
    </div>
    <div>
      <label>Description</label>
      <textarea name="description" id="editor">{!! $post->description !!}</textarea>
    </div>
    
    <div>
      <input type="submit" value="Update Data">
    </div>
  </form> 
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'), {
        ckfinder: {
          uploadUrl: "{{ route('ckeditor.upload.update', ['_token' => csrf_token()]) }}",
        }
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</body>
</html>