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
                 <div class="image-container">
                            <td>@if (!empty($product->image))
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
                    <td><a href="{{route('product.show',$product -> id)}}" class="btn btn-success">View</a>
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
