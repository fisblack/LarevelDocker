@extends('layouts.website.template')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/website/writer/index.css')}}"/>
@endsection

@section('body')
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <div class="writer-header">
                <h1>Writer list ...</h1>
                <img src="{{ asset('images/website/writer/writer-sign.png') }}" alt="writer-sign" class="img-responsive" />
                <h3>Work with us</h3>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <ul class="writer">
                @foreach($writers as $item)
                <li>
                    <div class="writer-main">
                        <a href="{{ route('writer.show', $item->id) }}">
                            @if($item->image)
                                <img src="{{ getImage($item->image) }}"
                                     alt="writer-1"
                                     width="190"
                                     height="190" />
                            @else
                                <img src="{{ getImage('images/website/writer/writer-1.png')}}"
                                     alt="writer-1"
                                     width="190"
                                     height="190" />
                            @endif
                            
                            
                            @if(getLang() == 'en')
	  						<p class="writer-name">{{ $item->fullname_en }}</p>
	  						@else
	  						<p class="writer-name">{{ $item->fullname_th }}</p>
	  						@endif

                            
                        </a>
                    </div>
                </li>
                @endforeach
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                        {{--<a href="{{ route('writer.show', 1) }}">--}}
                            {{--<img src="{{ asset('images/website/writer/writer-2.png') }}" alt="writer-2" class="img-responsive" />--}}
                            {{--<p class="writer-name">Chai_Hong</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                        {{--<a href="{{ route('writer.show', 1) }}">--}}
                            {{--<img src="{{ asset('images/website/writer/writer-3.png') }}" alt="writer-3" class="img-responsive" />--}}
                            {{--<p class="writer-name">Meawparadise</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                    {{--<a href="{{ route('writer.show', 1) }}">--}}
                        {{--<img src="{{ asset('images/website/writer/writer-4.png') }}" alt="writer-4" class="img-responsive" />--}}
                        {{--<p class="writer-name">โอ้วว ชีทเค้ก</p>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                    {{--<a href="{{ route('writer.show', 1) }}">--}}
                        {{--<img src="{{ asset('images/website/writer/writer-5.png') }}" alt="writer-5" class="img-responsive" />--}}
                        {{--<p class="writer-name">Lta Luktarn</p>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                        {{--<a href="{{ route('writer.show', 1) }}">--}}
                            {{--<img src="{{ asset('images/website/writer/writer-6.png') }}" alt="writer-6" class="img-responsive" />--}}
                            {{--<p class="writer-name">หม่อมแม่</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                    {{--<a href="{{ route('writer.show', 1) }}">--}}
                        {{--<img src="{{ asset('images/website/writer/writer-7.png') }}" alt="writer-7" class="img-responsive" />--}}
                        {{--<p class="writer-name">MA-NELL</p>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                    {{--<a href="{{ route('writer.show', 1) }}">--}}
                        {{--<img src="{{ asset('images/website/writer/writer-8.png') }}" alt="writer-8" class="img-responsive" />--}}
                        {{--<p class="writer-name">J.P. JAY</p>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                        {{--<a href="{{ route('writer.show', 1) }}">--}}
                            {{--<img src="{{ asset('images/website/writer/writer-9.png') }}" alt="writer-9" class="img-responsive" />--}}
                            {{--<p class="writer-name">ต้นผัก</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                        {{--<a href="{{ route('writer.show', 1) }}">--}}
                            {{--<img src="{{ asset('images/website/writer/writer-10.png') }}" alt="writer-10" class="img-responsive" />--}}
                            {{--<p class="writer-name">เจนฮยอน</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<div class="writer-main">--}}
                        {{--<a href="{{ route('writer.show', 1) }}">--}}
                            {{--<img src="{{ asset('images/website/writer/writer-11.png') }}" alt="writer-11" class="img-responsive" />--}}
                            {{--<p class="writer-name">เช็ค'บิล</p>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
