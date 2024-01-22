<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subcategory</title>
    <link rel="stylesheet" href="{{asset('css/screate.css')}}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <h1>Create Subcategory</h1>
      @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
          <strong>{{$message}}</strong>
          </div>
   @endif

    <form action="/subcategories" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="category_id">Select Category:</label>
            <select name="category_id" required>
             <option value="Select SubCategory">Select SubCategory</option>
                @foreach ($categories as $category)
                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Subcategory Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label for="image">Subcategory Image:</label>
            <input type="file" name="image">
        </div>

        <button type="submit">Create Subcategory</button>
         <a href="{{url('categories')}}" class="btn btn-primary">Back</a>
    </form>
</body>
</html>
