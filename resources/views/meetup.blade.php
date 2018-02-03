<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <title>Meetup</title>
</head>

<body>
<div class="select-wrapper">
    <div class="select-wrapper-inner">
        <div class="wrap">
            <header class="projects__heading">
                <h1>Upcoming Meeetups on your interests</h1>
                <p class="headline">Over 100 to receive notifications from.</p>
            </header>
            <div class="table">
                <?php foreach ($interests['events'] as $key=>$interest) { ?>
                    <div class="table__meetup">
                        <img src="assets/code.png" alt="" class="table__meetup-image">
                        <div class="table__meeetup-info">
                            <h3 class="table__meeetup-heading purple">
                                {{ $interests['events'][$key]['name'] }}
                            </h3>
                            <div class="table__meetup-desc">
                                <a href="{{ $interests['events'][$key]['link'] }}">
                                    link
                                </a>
                            </div>
                            <p class="table__meetup-loaction  small-gray-text">
                                {{--{{ $interests['events'][$key]['venue']['name'] }}
                                {{ $interests['events'][$key]["venue"]["address_1"] }}--}}
                                {{ $interests['city']['city'] }} - {{ $interests['city']['country'] }}
                            </p>
                            <p class="table__meetup-time  small-gray-text">
                                {{ $interests['events'][$key]['local_date'] }} -
                                {{ $interests['events'][$key]['local_time'] }}
                            </p>
                        </div>
                        <a href="" class="table__meetup-calendar">
                            <i class="fa fa-calendar"></i>
                            <p class="small-gray-text">
                                {{ $interests['events'][$key]['local_date'] }}
                            </p>
                        </a>
                </div>
                <?php } ?>
            </div>
            <div class="button-wrapper">
                <a href="#0" class="btn btn-text">&larr; Prev</a>
                <a href="#0" class="btn btn-text">Next &rarr;</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>