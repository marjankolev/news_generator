<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
<style type="text/css">
	img {
		width: 180px;
		height: 150px;
	}
	a {
		color: black;
		text-decoration: none;
	}
	a:hover{
		color: black;
		text-decoration: none;
	}
</style>
<title>Bitcon Latest News</title>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
        <li><a href="/bitcoin">Bitcoin</a></li>
        <li><a href="/techcrunch">Technology</a></li>
        <li><a href="/walstreet">Wall Street Journal</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
      <div class="row">
          <div class="col-sm-2">
            <div class="list-group list-group-flush">
              <form method="POST" action="/bitcoin">
                @csrf
                <h4>Sort By:</h4>
                <div class="radio">
                  <label><input type="radio" name="sortby" value="publishedAt">Published At</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="sortby" value="popularity">Popularity</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="sortby" value="relevancy">Relevancy</label>
                </div>
                <input type="submit" name="applyfilter" value="Apply Filter" class="btn btn-default">
              </form>
            </div>
          </div>
          <div class="col-sm-8">
                @foreach($bitcoinnews as $news)
                <div class="well">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="{{ $news['urlToImage'] }}">
                    </a>
                    <div class="media-body">
                      <h4 class="media-heading"><a href="{{ $news['url'] }}">{{ $news['title'] }}</a></h4>
                      @if($news['author'])
                        <p class="text-right"><b>By: {{ $news['author'] }}</b></p>
                      @else
                        <p class="text-right"><b>By: Unknown</b></p>  
                      @endif
                      <p>{{ $news['description'] }}</p>
                      <ul class="list-inline list-unstyled">
                        <li>
                          <span>
                            <i class="glyphicon glyphicon-calendar"></i> 
                            @if($news['publishedAt'])
                              {{ $news['publishedAt'] }}
                           @else
                              Unknown
                           @endif 
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                @endforeach
          </div>
          <div class="col-sm-2">
            <h4>Latest News</h4>
            <p>Here you can find Latest 5 news from this category</p>
            <div class="latestnews">
              <?php $count = 0; ?>
              @foreach($bitcoinnews as $news)
                <?php if($count == 5) break; ?>
                <ul>
                  <li>
                    <b><a href="{{ $news['url'] }}">{{ str_limit($news['title'], 30) }}</a><br></b>
                  </li>
                </ul>
              <?php $count++; ?>
              @endforeach
            </div>
          </div>
      </div>
   </div>