<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Interests</title>
</head>
<body>
<div class="select-wrapper">
    <div class="select-wrapper-inner">
        <div class="wrap">
            <form id="submitInterest" method="post" action="{{ route('submit.interest') }}">
                {{ csrf_field() }}
                <header class="projects__heading">
                    <h1>Select Interested Technologies </h1>
                    <p class="headline">Over 100 to receive notifications from.</p>
                </header>
                <div class="projects">
                    @foreach($interests as $key => $interest)
                        <div class="project">
                            <img src="{{ $interest['photo']['thumb_link'] }}" class="icon">
                            <h2 class="project__heading">{{ $interest['name'] }}</h2>
                            <div class="round">
                                <input type="checkbox" id="checkbox{{ $key }}" name="interest[]" value="{{ $interest['name']  }}"/>
                                <label for="checkbox{{ $key }}"></label>
                            </div>
                            {{--<div class="project__description">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi
                                unde ipsam aspernatur praesentium animi
                            </div>--}}
                        </div>
                    @endforeach
                </div>
                <div class="button-wrapper">
                    <button class="btn btn-text" type="submit">Submit Interest</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>