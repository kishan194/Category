<link rel="stylesheet" href="{{asset('css/sindex.css')}}" type="text/css">

 <h1>{{ $category->name }} Products</h1>


@if($category->subcategories->count() > 0)
   
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
            </tr>
        </thead>
        @foreach($category->subcategories as $subcategory)
        <tr>
                <td>{{ $subcategory->id}}</td>
                <td>{{ $subcategory->name }}</td>
              <td> <img src="{{ asset('products/'.$subcategory->image) }}" alt="{{ $subcategory->name }} "></td>
              </tr> 
        @endforeach
    
@endif
