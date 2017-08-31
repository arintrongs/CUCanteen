@extends('canteen/layouts/layout')

@section('others')
    @component('canteen/layouts/others')
    @endcomponent
@endsection
@section('comment')
    @component('canteen/layouts/comment')
    @endcomponent
@endsection

@php
    $count = count($shops);
@endphp

@section('content')
    @for ($i = 0; $i < $count; ++$i)
        @include('canteen/layouts/card', [
            'img' => URL :: asset('img/food/test.jpg'),
            'id' => $shops[$i]['shop_id'],
            'rating' => $shops[$i]['rating'],
            'title' => $shops[$i]['shop_name'],
            'location' => $shops[$i]['shop_location'],
            'description' => $shops[$i]['shop_description'],
        ])
    @endfor
@endsection
    
@section('footer')

<br><br>
@endsection