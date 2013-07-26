@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
        </ul>
    <!-- ./ tabs -->

    {{-- Create Advertiser Form --}}
    <form class="form-horizontal" method="post" action="" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <!-- ./ csrf token -->

        <!-- Tabs Content -->
        <div class="tab-content">
            <!-- Tab General -->
            <div class="tab-pane active" id="tab-general">
                <!-- Name -->
                <div class="control-group {{{ $errors->has('name') ? 'error' : '' }}}">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls">
                        <input type="text" name="name" id="name" value="{{{ Input::old('name') }}}" />
                        {{{ $errors->first('name', '<span class="help-inline">:message</span>') }}}
                    </div>
                </div>
                <!-- ./ name -->
                <!-- Description -->
                <div class="control-group {{{ $errors->has('description') ? 'error' : '' }}}">
                    <label class="control-label" for="content">Description</label>
                    <div class="controls">
                        <textarea class="full-width span10 wysihtml5" name="description" value="description" rows="10">{{{ Input::old('description') }}}</textarea>
                        {{{ $errors->first('description', '<span class="help-inline">:message</span>') }}}
                    </div>
                </div>
                <!-- ./ description -->
            </div>
            <!-- ./ tab general -->
        </div>
        <!-- ./ tabs content -->

        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
                <element class="btn-cancel close_popup">Cancel</element>
                <button type="reset" class="btn">Reset</button>
                <button type="submit" class="btn btn-success">Create Advertiser</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop
