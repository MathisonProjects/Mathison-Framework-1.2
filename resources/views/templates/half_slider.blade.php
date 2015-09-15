<!DOCTYPE html>
<html lang="en">
    <head>
        @include('templates.metaheader')
        <link href="css/half-slider.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Home</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @foreach ($menu as $key => $item)
                        <li>
                            <a href="{{ $item->urllink }}">{{ $item->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <header id="myCarousel" class="carousel slide">
            <ol class="carousel-indicators">
                @foreach ($items as $item)
                    @if ($item->order == 0)
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    @else
                        <li data-target="#myCarousel" data-slide-to="{{$item->order}}"></li>
                    @endif
                @endforeach
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach ($items as $item)
                    @if ($item->order == 0)
                    <div class="item active">
                    @else
                    <div class="item">
                    @endif
                        <div class="fill" style="background-image:url('{{$item->imageurl}}');"></div>
                        <div class="carousel-caption">
                            <h2>{{$item->caption}}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{$header}}</h1>
                    {{$content}}
                </div>
            </div>
            <hr>
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; {{ $constant['sitename'] }} <?php echo date("Y"); ?></p>
                    </div>
                </div>
            </footer>
        </div>
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
        </script>
    </body>
</html>
