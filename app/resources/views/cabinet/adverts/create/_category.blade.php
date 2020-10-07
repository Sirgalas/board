@php
{{
    /**
    * @var $categories \App\Entity\Adverts\Category[]
    */
}}
@endphp
<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('cabinet.adverts.create.region', $category) }}">{{ $category->name }}</a>
            @include('cabinet.adverts.create._category', ['categories' => $category->children])
        </li>
    @endforeach
</ul>