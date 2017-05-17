<table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<td width="80">Action</td>
                    			<td>Name</td>
                    			<td>Email</td>
                                   <td>Role</td>
                    			
                    		</tr>
                    	</thead>
                    	<tbody>
                         <?php $currentUser= auth()->user(); ?>
                    	@foreach($users as $user)
                    		<tr>
                    			<td>

                          <!-- {!! Form::open(['method'=>'DELETE','route'=>['users.destroy',$user->id]])!!}
 -->
                    			<a href="{{route('users.edit',$user->id)}}" class="btn btn-xs btn-default">
                    				<i class="fa fa-edit"></i>
                    			</a>
                                    @if($user->id == config('cms.default_user_id')|| $user->id == $currentUser->id)
                                   <a type="submit" class="btn btn-xs btn-danger disabled" href="{{route('backend.users.confirm',$user->id)}}">
                                        <i class="fa fa-times"></i>
                    			</a>
                                   @else
                                   <a type="submit" class="btn btn-xs btn-danger" href="{{route('backend.users.confirm',$user->id)}}">
                                        <i class="fa fa-times"></i>
                                   </a>
                                   @endif
                          <!-- {!!Form::close()!!} -->

                    			</td>
                    			<td>{{$user->name}}</td>
                    			<td>{{$user->email}}</td>
                                   <td>-</td>
                    			
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>