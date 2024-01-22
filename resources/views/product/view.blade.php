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
                <th>Image1</th>
                <th>Image2</th>
                <th>Image3</th>
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
                    <td> <img src="{{ asset('products/'.$product->image) }}" alt="{{ $product->name }} "></td>
                    <td> <img src="{{ asset('products/'.$product->image1) }}" alt="{{ $product->name }} "></td>
                    <td> <img src="{{ asset('products/'.$product->image2) }}" alt="{{ $product->name }} "></td>
                    <td> <img src="{{ asset('products/'.$product->image3) }}" alt="{{ $product->name }} "></td>
                    </form>
                </tr>
             @endforeach
        </tbody>
    </table>
</body>
</html>
