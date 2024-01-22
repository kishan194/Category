<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategories</title>
    <link rel="stylesheet" href="{{asset('css/sindex.css')}}" type="text/css">

</head>
<body>

    <h1>SubCategory</h1>

    <a href="{{url('subcategories/create')}}" class="btn btn-success mb-2">Create Subcategory</a>
    <a href="{{url('categories')}}" class="btn btn-primary">View-Parent-Category</a>
    <a href="{{url('categories')}}" class="btn btn-primary">Back</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Parent Category Name</th>
                <th>SubCategory Name</th>
                <th>Image</th>
                <th>view</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{$subcategory->id}}</td>
                    <td>{{ $subcategory->category->name}}</td>
                    <td>{{ $subcategory->name }} </td>
                    <td><img src="products/{{$subcategory->image}}" class="rounded-circle" width="50" height="50" alt="Example Image"></td>
                    <td><a href="{{url('subcategories/view')}}" class="btn btn-primary">View</a>
                   
                        </form>
                </tr>
             @endforeach
        </tbody>
    </table>
</body>
</html>
