@extends('chef.layout')
@section('page_head')

@endsection
@section('page_content')
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col s12 m2">
                <div class="row">
                    <div>
                        MESSAGES
                    </div>
                </div>
                <div class="divider"></div>
                <ul class="collection">
                    <li class="collection-item" >
                        <a href="{{route("chef.order.view", ['id'=> 0])}}"  >Orders</a>
                    </li>
                    <li class="collection-item" >
                        <a href="{{route('chef.plan')}}" >View Your Plans</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.profile')}}">Profile</a>
                    </li>
                    <li class="collection-item" >
                        <a href="{{route('chef.message.index')}}" >Messages</a>
                        @if($messages->count()>0)
                            <span class="new badge red">{{$messages->count()}}</span>
                        @endif
                    </li>
                    <li class="collection-item" style="border: 1px solid #f57c00;">
                        <a href="{{route('chef.ratings')}}" style="color: #f57c00;">Ratings</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m10">
                <ul class="collection">
                    @forelse($ratings as $key=>$rating)
                        @if($rating->is_rated==1)
                        <li class="collection-item">
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
                        </li>
                        @endif
                    @empty
                        <li class="collection-item">No ratings yet!</li>
                    @endforelse
                </div>
            </div>
        </div>
@endsection