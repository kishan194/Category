<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategories</title>
    <link rel="stylesheet" href="{{asset('css/vproduct.css')}}" type="text/css">
    
</head>
<body>

    <h1>Product</h1>
{{-- 
    <a href="/subcategories/create" class="btn btn-success mb-2">Create Subcategory</a>
    <a href="/categories" class="btn btn-primary">View-Parent-Category</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                {{-- <th>Parent Category Name</th> --}}
                <th>Name</th>
                <th>Category_id</th>
                <th>Subcategory_id</th>
                <th>Image</th>
               
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
             @foreach ($products as $id=>$product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{ $product->name }} </td>
                    <td>{{ $product->category_id}} </td>
                    <td>{{ $product->subcategory_id}} </td>
                  <div class="image-container">
      <td>  @if (!empty($product->image))
            @foreach (json_decode($product->image) as $image)
                @if (file_exists(public_path('products/'.$image)))
                    <img src="{{ asset('products/'.$image) }}" class="rounded-circle product-image" alt="Example Image">
                @else
                    <p>Image not found: {{ $image }}</p>
                @endif
            @endforeach
        @else
            <p>No images for this product.</p>
        @endif
    </div>
</td>
                    </form>
                </tr>
             @endforeach
        </tbody>
    </table>
</body>
</html>
