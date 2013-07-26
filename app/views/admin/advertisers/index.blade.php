@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')advertisers administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')advertisers administration index @stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h3>
           {{{ $title }}}


            <div class="pull-right">
                <a href="{{{ URL::to('admin/advertisers/create') }}}" class="btn btn-small btn-info iframe"><i class="icon-plus-sign icon-white"></i> Create</a>
            </div>
        </h3>
    </div>

    <table id="advertisers" class="table table-bordered table-hover">
        <thead>
          <tr>
                <th class="span8">{{{ Lang::get('admin/advertisers/table.name') }}}</th>
                <th class="span8">{{{ Lang::get('admin/advertisers/table.description') }}}</th>
                <th class="span2">{{{ Lang::get('admin/advertisers/table.created_at') }}}</th>
                <th class="span2">{{{ Lang::get('table.actions') }}}</th>
            </tr> 
        </thead>
        <tbody>
        </tbody>
    </table>
@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
            oTable = $('#advertisers').dataTable( {
                "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('admin/advertisers/data') }}",
                "fnDrawCallback": function ( oSettings ) {
                    $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
                }
            });
        });
    </script>
@stop