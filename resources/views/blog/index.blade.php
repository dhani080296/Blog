@extends('layout.main')

@section('content')
<!-- kategori tidak boleh kosong... 
atu bisa jg !is_null($post->category) ? $post->category->title  -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            @if(!$posts->count())
            <div class="alert alert-warning">
                <p>Nothing Found</p>
            </div>
            @else
            @if(isset($categoryName))
            <div class="alert alert-info">
                <p>Category: <strong>{{$categoryName}}</strong></p>
            </div>
            
            @endif
            @if(isset($authorName))
            <div class="alert alert-info">
                <p>Author: <strong>{{$authorName}}</strong></p>
            </div>
            @endif
             @foreach($posts as $post)
              @if(!is_null($post->category))
                <article class="post-item">
                @if($post->image_url)
                    <div class="post-item-image">
                        <a href="{{route('blog.show',$post->slug)}}">
                            <img src="{{$post->image_url}}" alt="">
                        </a>
                    </div>
                    @endif

                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a></h2>
                            {!!$post->excerpt_html!!}
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('author',$post->author->slug)}}">{{$post->author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time>{{$post->date}}</time></li>
                                   <li><i class="fa fa-folder"></i><a href=""> {{ $post->category->title }}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('blog.show',$post->slug)}}">Continue Reading &raquo;</a>
                            </div>
                        </div>
                    </div>
                </article>
                @endif
                @endforeach
                @endif
                <nav>
                <ul class="pager">
                  {{$posts->links()}}
                  </ul>
                </nav>
            </div>
            @include('layout.sidebar')
        </div>
    </div>

  
@endsection
