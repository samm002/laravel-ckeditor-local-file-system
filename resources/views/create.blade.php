<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CK Editor</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}">
  <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
</head>
<body>
  <h1>CK Editor Create Post</h1>
  <form action="{{ route('create') }}" method="POST">
    @csrf
    <div>
      <label>Title</label>
      <input type="text" name="title">
    </div>
    <div>
      <label>Description</label>
      <textarea name="description" id="editor"></textarea>
    </div>
    
    <div>
      <input type="submit" value="Add Data">
    </div>
  </form>
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'), {
        ckfinder: {
          uploadUrl: "{{ route('ckeditor.upload.create', ['_token' => csrf_token()]) }}",
        }
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</body>
</html>