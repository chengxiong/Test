@foreach($items as $item)
    <li class="">
        <a href="{!! $item->url() !!}"><i class="fa fa-circle-o"></i> {!! $item->title !!}</a>
    </li>
@endforeach