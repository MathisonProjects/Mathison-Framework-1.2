<!DOCTYPE html>
<html lang="en">
    <head>
        @include('templates.metaheader')

        <link href="css/shop-item.css" rel="stylesheet">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Home</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @foreach ($menu as $key => $item)
                            <li>
                                <a href="{{ $item->urllink }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <p class="lead">{{ $constant['sitename'] }}</p>
                    <div class="list-group">
                        @foreach ($categories as $key => $item)
                            <a href="/category/{{ $item->id }}" class="list-group-item">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="thumbnail">
                        <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                        <div class="caption-full">
                            <h4 class="pull-right">$24.99</h4>
                            <h4><a href="#">Product Name</a>
                            </h4>
                            <p>See more snippets like these online store reviews at <a target="_blank" href="http://bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                            <p>Want to make these reviews work? Check out
                                <strong><a href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this building a review system tutorial</a>
                                </strong>over at maxoffsky.com!</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">3 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                4.0 stars
                            </p>
                        </div>
                    </div>

                    <div class="well">

                        <div class="text-right">
                            <a class="btn btn-success">Leave a Review</a>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">10 days ago</span>
                                <p>This product was great in terms of quality. I would definitely buy another!</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">12 days ago</span>
                                <p>I've alredy ordered another one!</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                Anonymous
                                <span class="pull-right">15 days ago</span>
                                <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- /.container -->

        <div class="container">

            <hr>
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; {{ $constant['sitename'] }} <?php echo date("Y"); ?></p>
                    </div>
                </div>
            </footer>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
