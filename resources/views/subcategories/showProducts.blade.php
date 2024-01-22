<link rel="stylesheet" href="{{asset('css/sindex.css')}}" type="text/css">
<h1>{{ $subcategory->name }} Products</h1>
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
            </tr>
        </thead>
        <tbody>
             @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{ $product->name }} </td>
                    <td>{{$product->category_id}}</td>
                    <td>{{$product->subcategory_id}}</td>
                  <td> <img src="{{ asset('products/'.$product->image) }}" alt="{{ $product->name }} "></td>
                   <td> <img src="{{ asset('products/'.$product->image1) }}" alt="{{ $product->name }} "></td>
                    <td> <img src="{{ asset('products/'.$product->image2) }}" alt="{{ $product->name }} "></td>
                     <td> <img src="{{ asset('products/'.$product->image3) }}" alt="{{ $product->name }} "></td>
                    <td><a href="{{route('product.show',$product -> id)}}" class="btn btn-success">View</a>
                        </form>
                   
                </tr>
             @endforeach
        </tbody>
    </table>
@if($subcategories && $subcategories->count() > 0)
    <ul>
        @foreach($subcategories as $sub)
            <li>
                <a href="{{ route('subcategories.showProducts', $sub->id) }}">{{ $sub->name }}</a>
            </li>
        @endforeach
    </ul>
@endif
