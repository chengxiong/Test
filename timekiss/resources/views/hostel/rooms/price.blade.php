@extends('layouts.admin')
@section('css')
<style>
    *{ margin: 0; padding: 0; list-style: none; box-sizing: border-box;}
    #time_room{ width: 1000px; float: left; margin: 20px;}
    #time_room ul{ width: 700px; float: left;}
    #time_room ul li{ border: 1px solid #ccc; margin-bottom: -1px; width: 20%;  text-align: center; line-height: 22px; padding: 10px; text-align: center; float: left; margin-right: -2px;}
    #time_room ul li p{ margin-bottom: 10px; font-size: 20px;}
    #time_room ul li p i{ font-style: normal; color: red;}
    #time_room ul li.active{ background: #ccc;}
    #time_room div.timer_money{ padding: 20px; float: left;}
    #time_room div.timer_money input{ height: 50px; float: left; margin-bottom: 10px;}
    #time_room div.timer_money input:last-child{ border:none; padding: 5px 10px; margin-left: 10px;}
</style>
@endsection
@section('content-header')
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
{!! Breadcrumbs::render('hostel_create') !!}
@endsection
@section('content')
<div id="time_room">
    <ul>
        @if($room->tkTime()->count() > 0)
        @foreach($room->tkTime()->get() as $price)
        <li>
            <p>{{ $price->priceDate }}</p>
            <p><i>{{ $price->price }}</i>元</p>
            <p style="display:none;"><i>{{ $price->id }}</i>元</p>
        </li>  
        @endforeach
        @endif
    </ul>
    <div class="timer_money">
        <form action="{{ route('rooms.updatePrice') }}" method="post">
            <input type="text" value="" name="price" />
            <input type="hidden" value="" name='price_id' />
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="submit" value="修改"/>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    window.onload = function () {
        var Room = document.getElementById('time_room');
        var aLi = Room.getElementsByTagName('li');

        var money = Room.getElementsByTagName('div');
        var oInput = Room.getElementsByTagName('input');

        for (var i = 0; i < aLi.length; i++) {
            aLi[i].onclick = function () {
                for (var i = 0; i < aLi.length; i++) {
                    aLi[i].className = '';
                }
                this.className = 'active';
                oInput[0].value = this.getElementsByTagName('i')[0].innerHTML;
                oInput[1].value = this.getElementsByTagName('i')[1].innerHTML;;
            };

        }
        ;
    };
</script>
@endsection
