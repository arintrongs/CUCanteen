@extends('layouts.layout')
@php
    $i = 'content_';
    $num = '1';
    $str1 = $i.$num;
    $str2 = $i.'2';
    $str3 = $i.'3';
@endphp
@section('store')
    @component('layouts.store')
        @slot('img')
            {{URL :: asset('img/food/test.jpg')}}
        @endslot
    @endcomponent
@endsection
@section('comment')
    @component('layouts.comment')
    @endcomponent
@endsection
@section('others')
    @component('layouts.others')
    @endcomponent
    @component('layouts.others')
    @endcomponent
    @component('layouts.others')
    @endcomponent
@endsection
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

@section($str3)
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

@section('footer')

<br><br>
<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>
@endsection