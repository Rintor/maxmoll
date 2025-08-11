@if(! empty($meta['description']))
    <meta name="description" content="{{ $meta['description'] }}">
@endif
@if(! empty($meta['keywords']))
    <meta name="keywords" content="{{ $meta['keywords'] }}">
@endif
@if(! empty($meta['robots']))
    <meta name="robots" content="{{ $meta['robots'] }}">
@endif
@if(! empty($meta['title']))
    <meta property="og:title" content="{{ $meta['title'] }}">
@endif
@if(! empty($meta['description']))
    <meta property="og:description" content="{{ $meta['description'] }}">
@endif
@if(! empty($meta['image']))
    <meta property="og:image" content="{{ $meta['image'] }}">
@endif
@if(! empty($meta['url']))
    <meta property="og:url" content="{{ $meta['url'] }}">
@else
    <meta property="og:url" content="{{ url()->current() }}">
@endif