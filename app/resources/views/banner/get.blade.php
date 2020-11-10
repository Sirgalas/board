@php
{{
    /**
    * @var $banner \App\Entity\Banner\Banner
    */
}}
@endphp
<a href="{{ route('banner.click', $banner) }}" target="_blank">
    <img width="{{ $banner->getWidth() }}" height="{{ $banner->getHeight() }}" src="{{ Storage::url($banner->file) }}">
</a>