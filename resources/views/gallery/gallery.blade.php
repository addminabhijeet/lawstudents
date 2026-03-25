@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
    <!--===== WELCOME STARTS =======-->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>Gallery</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span>Gallery</a>
                        <img src="/img/elements/elementor20.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== WELCOME ENDS =======-->

    <!--===== TEAM STARTS =======-->
    <div class="team2-section-area team-inner sp3">
        <div class="container">
            <div class="row">

                @foreach ($gallery as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="team2-parent-boxarea">
                            <div class="team2-boxarea">
                                <div class="team2images">

                                    <img src="{{ asset('storage/app/public/' . $item->image) }}" alt="">

                                </div>
                            </div>

                            <div class="team2-textarea">

                                <div class="teamsname">
                                    <a>
                                        {{ $item->description }}
                                    </a>
                                </div>

                                <div class="shareicon">
                                    <a href="#">
                                        <i class="fa-light fa-share-nodes"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!--===== TEAM ENDS =======-->
@endsection
