@if(session('message'))
              <div class="alert alert-success">
                {{session('message')}}
              </div>
@elseif(session('error-message'))
<div class="alert alert-danger">
     {{session('error-message')}}
</div>
@elseif(session('trash-message'))
<div class="alert alert-success">
        <?php list($message,$postid)=session('trash-message') ?>
            {{$message}}
            {!!Form::open(['method'=>'PUT','route'=>['backend.blog.restore',$postid]])!!}
            <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-undo"></i> Undo</button>
              {!!Form::close()!!}
              </div>

              @endif