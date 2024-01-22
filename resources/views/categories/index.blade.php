<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"  type="text/css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
</head>
<body>
  <style>
        /* Basic styling to make it look nice */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            text-decoration:none;
        }

        /* Style the parent link */
        .dropdown:hover .dropdown-content {
            display: block;
            text-decoration:none;
        }
        .header-link{
            color:white;
            text-decoration:none;
        }
        </style>
        <header>
        <nav>
        <div class="header">
    <div class="dropdown">
        <a href="#"  class="header-link">All Categories</a>
        @include('partials.category-dropdown', ['categories' => $categories])
    </div>
</div>
        
   
        </nav>
      
    </header>

    <a href="{{url('categories/create')}}" class="btn btn-success mb-2">Create Parent Category</a>
    <a href="{{url('subcategories/create')}}" class="btn btn-primary mb-2">Create Subcategory</a>
    <a href="{{url('subcategories')}}"class="btn btn-primary mb-2">View Subcategory</a>
     <a href="{{url('product/create')}}" class="btn btn-secondary mb-2">Create Product</a>
     <a href="{{url('product')}}" class="btn btn-secondary mb-2">View Product</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td> {{$category->id}} </td>
                    <td>{{$category->name}}</td>
                         <td><img src="{{ asset('products/'.$category->image) }}" class="rounded-circle" width="50" height="50" alt="Example Image"></td>
                </tr>
             @endforeach
        </tbody>
    </table>
</body>
</html>
