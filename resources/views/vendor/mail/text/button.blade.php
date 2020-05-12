@php
    $url = str_replace('password/reset','public/index.php/password/reset',$url);
@php
{{ $slot }}: {{ $url }}
