@extends('site.layouts.default')

{{-- Content --}}
@section('content')

        <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- START THE FEATURETTES -->
    <div class="page-header">
       <h1></h1>
    </div>

    <div class="row">
      <div class="span6">
        <a href="{{{ URL::to('user/create') }}}" class="btn btn-primary btn-large">Create An Account</a>
        <form method="POST" action="{{ URL::to('user/login') }}" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <fieldset>
            <label for="email">{{ Lang::get('confide::confide.username_e_mail') }}</label>
            <input tabindex="1" placeholder="{{ Lang::get('confide::confide.username_e_mail') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">

              <label for="password">
                {{ Lang::get('confide::confide.password') }}
                <small>
                   <a href="forgot">{{ Lang::get('confide::confide.login.forgot_password') }}</a>
                </small>
              </label>
              <input tabindex="2" placeholder="{{ Lang::get('confide::confide.password') }}" type="password" name="password" id="password">

                <label for="remember" class="checkbox">{{ Lang::get('confide::confide.login.remember') }}
                  <input type="hidden" name="remember" value="0">
                  <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
                </label>

                @if ( Session::get('error') )
                  <div class="alert alert-error">{{ Session::get('error') }}</div>
                @endif

                @if ( Session::get('notice') )
                  <div class="alert">{{ Session::get('notice') }}</div>
                @endif

                <button tabindex="3" type="submit" class="btn">{{ Lang::get('confide::confide.login.submit') }}</button>
          </fieldset>
        </form>
      </div>
      <div class="span6">
      </div>
    </div>
    <!-- /END THE FEATURETTES -->
  </div>


@stop