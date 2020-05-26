{{-- forma za promenu profilne slike --}}
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body class="body">
<div>
    <br><br><br>
    <hr>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">{{--
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @else--}}
                <br> <br> <br>
{{--            @endif--}}
            <br>
            <form method="POST" action="{{ route('profile.picture', ['id'=>Auth::id()]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">

                    <label for="path" class="col-md-4 offset-md-4 col-form-label text-md-right form_label_text box
                           @error('path') is-invalid @enderror" name="path">{{ __('Kliknite ovde kako biste odabrali fajl') }}</label>
                    <div class="col-md-6">
                        <input aria-describedby="fileHelp" id="path" type="file" name="path" class="custom-file-input"/>
{{--                        <small id="fileHelp" class="form-text text-muted">Fajl ne sme biti veći od 2MB.</small>--}}

                        @error('path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 float-md-right">
                        <button type="submit" class="btn btn-warning">
                            {{ __('Promeni profilnu sliku') }}
                        </button>
                    </div>
                </div>
            </form>
            <br> <br>
            <div class="form-group row mb-0">
                <div class="col-md-2 offset-md-10 float-md-left">
                    <a class="btn btn-link-btn" href="{{ route('home') }}">
                        <button type="button" class="btn btn-warning">
                            {{ __('Povratak na početnu') }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
</footer>
</body>>
</html>