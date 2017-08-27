@extends('layouts.layout')
@php
    $i = 'content_';
    $num = '1';
    $str1 = $i.$num;
    $str2 = $i.'2';
@endphp
@section($str1)
    @component('layouts.card')
        @slot('img')
            {{URL :: asset('img/food/test.jpg')}}
        @endslot
        @slot('title')
            ตามสั่งวิดวะจ้า
        @endslot
        @slot('description')
            อร่อยตุดยอดฟหกด่าฟหกดาฟหกา่ด้าฟหก้ด่าฟหก้ดาฟหก้ดา่้หฟกาด้าหฟก้ดาฟหก้ดา้ฟหกาด้า
        @endslot
    @endcomponent
@endsection

@section($str2)

@endsection

@section('content_3')

@endsection

@section('footer')

@endsection