<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="{{asset('css/sindex.css')}}" type="text/css">

</head>
<body>

    <h1>Product</h1>

    <a href="/product/create" class="btn btn-success mb-2">Create product</a>
    <a href="/categories" class="btn btn-primary">View-Parent-product</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category_id</th>
                <th>Subcategory_id</th>
                <th>Image</th>
                <th>Image1</th>
                <th>Image2</th>
                <th>Image3</th>
                <th>View</th>

                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
             @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{ $product->name }} </td>
                    <td>{{$product->category_id}}</td>
                    <td>{{$product->subcategory_id}}</td>
                    <td><img src="products/{{$product->image}}" class="rounded-circle" width="50" height="50" alt="Example Image"></td>
                     <td><img src="products/{{$product->image1}}" class="rounded-circle" width="50" height="50" alt="Example Image"></td>
                      <td><img src="products/{{$product->image2}}" class="rounded-circle" width="50" height="50" alt="Example Image"></td>
                       <td><img src="products/{{$product->image2}}" class="rounded-circle" width="50" height="50" alt="Example Image"></td>
                    {{-- <td><a href="{{ route('subcategories.view',$product -> id)}}" class="btn btn-primary">View</a> --}}
                    <td><a href="{{route('product.show',$product -> id)}}" class="btn btn-success">View</a>
                        </form>
                   
                </tr>
             @endforeach
        </tbody>
    </table>
</body>
</html>
