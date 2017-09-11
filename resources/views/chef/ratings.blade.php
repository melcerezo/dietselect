@extends('chef.layout')
@section('page_head')

@endsection
@section('page_content')
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            @forelse($ratings as $key=>$rating)
                @if($rating->is_rated==1)
                <div class="card">
                    <div class="card-panel">
                        <div>
                            <h4><img class="circle" style="width: 60px;" src="/img/{{ $rating->foodie->avatar }}"> {{$rating->foodie->first_name.' '.$rating->foodie->last_name}}</h4>
                        </div>
                        <div id="rateYo{{$key}}">
                        </div>
                        <script>
                            $(function () {
                                $("#rateYo{{$key}}").rateYo({
                                    rating: '{{$rating->rating}}',
                                    fullStar: true,
                                    readOnly: true
                                });
                            });
                        </script>
                        {{--@if($rating->rating == 5)--}}
                            {{--@for($i=0; $i<5; $i++)--}}
                                {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                            {{--@endfor--}}
                        {{--@elseif($rating->rating == 4)--}}
                            {{--@for($i=0; $i<4; $i++)--}}
                                {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                            {{--@endfor--}}
                        {{--@elseif($rating->rating == 3)--}}
                            {{--@for($i=0; $i<3; $i++)--}}
                                {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                            {{--@endfor--}}
                        {{--@elseif($rating->rating == 2)--}}
                            {{--@for($i=0; $i<2; $i++)--}}
                                {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                            {{--@endfor--}}
                        {{--@elseif($rating->rating == 1)--}}
                            {{--@for($i=0; $i<1; $i++)--}}
                                {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                            {{--@endfor--}}
                        {{--@endif--}}
                        @if($rating->feedback!=null)
                            <p>Comment: {{$rating->feedback}}</p>
                        @endif
                    </div>
                </div>
                @endif
            @empty
                <p>No ratings yet!</p>
            @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection