<!DOCTYPE html>
<html lang="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Meals Finder</title>
        <link rel="stylesheet" href="{{ url('css/normalize.css') }}" />
        <link rel="stylesheet" href="{{ url('css/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ url('css/style.css') }}" />
    </head>
    <body>
        <div class="container">
            <div class="form-area">
                <form method="POST" class="finder-form">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                    <div class="form-message">
                        <p>psdaf adsfasd</p>
                    </div>

                    <div class="form-item @if($errors->first("meal_name")) error @endif">
                        <label for="">Meal <span class="required">*</span></label>
                        <input type="text" name="meal_name" value="{{ request('meal_name') }}" />
                    </div>
                    <div class="form-item @if($errors->first("latitude")) error @endif"">
                        <label for="">Latitude <span class="required">*</span></label>
                        <input type="text" name="latitude" value="{{ $latitude }}" />
                    </div>
                    <div class="form-item @if($errors->first("longitude")) error @endif"">
                        <label for="">Longitude <span class="required">*</span></label>
                        <input type="text" name="longitude" value="{{ $longitude }}" />
                    </div>
                    <div class="form-item">
                        <a href="javascript:void(0)"  class="location-detector">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                            Detect you location
                        </a>
                        <button type="submit">Find</button>
                    </div>
                </form>
            </form>
        </div>

        @if(count($restaurants))
        <div class="result-area">
            <div class="meals">
                @foreach($restaurants as $restaurant)
                <div class="meal">
                    <div class="name">{{ ucfirst($restaurant["meal_name"]) }} - {{ $restaurant["name"] }}</div>
                    <div class="recommenations">
                        Recommendations: {{ $restaurant["recommendations"] }}
                    </div>
                    <div class="recommenations">
                        Meal Recommendations: {{ $restaurant["meal_recommendations"] }}
                    </div>
                    <i class="distance">
                        {{ round($restaurant["distance"], 3) }} km from here.
                    </i>
                    <div class="rank">
                        Rank: {{ $restaurant["rank"] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <script type="text/javascript" src="{{ url('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/script.js') }}"></script>
    </body>
</html>
