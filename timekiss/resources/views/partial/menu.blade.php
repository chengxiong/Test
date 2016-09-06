@foreach($items as $item)
    {{ $tmp = false }}
    @foreach($item->children() as $child)
        @if($child->url() == Request::url() && $_SERVER['REQUEST_URI']!= '/')
            <input type="hidden" value="{{ $tmp = true }}">
        @endif
    @endforeach
    @if($item->url() == Request::url())
        <input type="hidden" value="{{ $tmp = true }}">
    @endif
    <li class="treeview @if($tmp) active @endif">
        <a href="{!! $item->url() !!}">
            <i class="{!! $item->icon !!}"></i>
            <span>{!! $item->title !!}</span>
            @if($item->hasChildren())
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            @endif
        </a>
        @if($item->hasChildren())
            <ul class="treeview-menu">
                @foreach($item->children() as $child)
                    @if(Request::url() == $child->url() && $_SERVER['REQUEST_URI'] != '/')
                        <li class="active">
                            <a href="{!! $child->url() !!}"><i class="fa fa-circle-o"></i> {!! $child->title !!}</a>
                        </li>
                    @else
                        <li>
                            <a href="{!! $child->url() !!}"><i class="fa fa-circle-o"></i> {!! $child->title !!}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
@endforeach