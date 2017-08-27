@extends('chef.layout')
@section('page_head')

@endsection
@section('page_content')
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12">
                    <ul>
                        <li>
                            <span style="font-size: 20px;">Ratings</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            @forelse($ratings as $rating)
                @if($rating->is_rated==1)
                <div class="card">
                    <div class="card-panel">
                        <h4>Rated By: {{$rating->foodie->first_name.' '.$rating->foodie->last_name}}</h4>
                        @if($rating->rating == 5)
                            @for($i=0; $i<5; $i++)
                                <span><i class="fa fa-star" style="color: yellow"></i></span>
                            @endfor
                        @elseif($rating->rating == 4)
                            @for($i=0; $i<4; $i++)
                                <span><i class="fa fa-star" style="color: yellow"></i></span>
                            @endfor
                        @elseif($rating->rating == 3)
                            @for($i=0; $i<3; $i++)
                                <span><i class="fa fa-star" style="color: yellow"></i></span>
                            @endfor
                        @elseif($rating->rating == 2)
                            @for($i=0; $i<2; $i++)
                                <span><i class="fa fa-star" style="color: yellow"></i></span>
                            @endfor
                        @elseif($rating->rating == 1)
                            @for($i=0; $i<1; $i++)
                                <span><i class="fa fa-star" style="color: yellow"></i></span>
                            @endfor
                        @endif
                        <p>Comment: {{$rating->feedback}}</p>
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