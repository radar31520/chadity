@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
        </ul>
    <!-- ./ tabs -->

    {{-- Create Ad Form --}}
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
                <!-- URL -->                
                 <div class="control-group {{{ $errors->has('url') ? 'error' : '' }}}">
                    <label class="control-label" for="url">Url</label>
                    <div class="controls">
                        <input type="text" name="url" id="url" value="{{{ Input::old('url') }}}" />
                        {{{ $errors->first('url', '<span class="help-inline">:message</span>') }}}
                    </div>
                </div>
                <!-- ./ url -->
                <!-- Advertisers -->
                <div class="control-group {{{ $errors->has('advertisers') ? 'error' : '' }}}">
                    <label class="control-label" for="advertiser">Advertisers</label>
                    <div class="controls">
                        <select name="advertiser" id="advertiser">
                                @foreach ($advertisers as $advertiser)
                                        <option value="{{{ $advertiser->id }}}"{{{ ( in_array($advertiser->id, $selectedAdvertisers) ? ' selected="selected"' : '') }}}>{{{ $advertiser->name }}}</option>
                                @endforeach
                        </select>
                        <span class="help-block">
                            Which advertiser is sponsoring this ad?
                        </span>
                    </div>
                </div>
                <!-- ./ advertisers -->
                <!-- Type -->
                <div class="control-group {{{ $errors->has('types') ? 'error' : '' }}}">
                    <label class="control-label" for="type">Types</label>
                    <div class="controls">
                        <select name="type" id="type">
                                @foreach ($types as $type)
                                        <option value="{{{ $type->id }}}"{{{ ( in_array($type->id, $selectedTypes) ? ' selected="selected"' : '') }}}>{{{ $type->name }}}</option>
                                @endforeach
                        </select>
                        <span class="help-block">
                            What type of ad is this?
                        </span>
                    </div>
                </div>
                <!-- ./ type -->
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
                <button type="submit" class="btn btn-success">Create Ad</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop
