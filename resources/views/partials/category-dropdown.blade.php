
<link rel="stylesheet" href="{{ asset('css/dropdown.css') }}"  type="text/css">
<div class="dropdown-content">
    <ul class="category-list">
        @foreach($categories as $category)
            <li class="dropdown-item parent-category">
                 <a href="{{ route('categories.showProducts', $category->id) }}">{{ $category->name }}</a>
                @if(isset($category->children) && count($category->children) > 0)
                    <ul class="sub-category-list">
                        @include('partials.category-dropdown', ['categories' => $category->children])
                       
                    </ul>
                @endif
                @foreach($category->subcategories as $subcategory)
                    <li class="dropdown-item child-category">
                       <a href="{{ route('subcategories.showProducts', $subcategory->id) }}">{{ $subcategory->name }}</a>
                    </li>
                @endforeach
            </li>
        @endforeach
    </ul>
</div>







