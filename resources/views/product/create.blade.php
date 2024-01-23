<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}"  type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


    <h1>Create Product</h1>

     @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
          <strong>{{$message}}</strong>
          </div>
   @endif

    <form action="/product" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">product Name:</label>
            <input type="text" name="name"  required>
        </div>
              <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" required>
             <option value="Select SubCategory">Category</option>
                @foreach ($categories as $category)
                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subcategory_id">Select Category:</label>
            <select name="subcategory_id" required>
             <option value="Select SubCategory">Select SubCategory</option>
                @foreach ($subcategories as $subcategory)
                 <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
         <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" name="image[]" multiple>
        </div>
        <button type="submit" cladd="btn btn-success">Create Category</button>
        <a href="{{url('categories')}}" class="btn btn-success">Back</a>
    </form>
</body>
</html>
