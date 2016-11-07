@extends('layouts.system')
@section('content')

<div class="row">

	<div class="col-lg-5">

		<form method="post" action="{{URL::to('users/password/'.$user->id)}}">


        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>


        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
        </div>

         <div class="form-actions form-group">
        
          <button type="submit" class="btn btn-info btn-sm">Update Password</button>
        </div>

        </form>

        @if (Session::has('error'))
            <div class="alert alert-error alert-danger">
                
                    {{ Session::get('error') }}
               
            </div>
        @endif
		

  </div>
</div>










@stop