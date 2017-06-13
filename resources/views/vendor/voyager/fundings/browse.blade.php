@extends('voyager::master')

@section('page_title',$dataType->display_name_plural)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        {{--@if (Voyager::can('add_'.$dataType->name))--}}
            {{--<a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success">--}}
                {{--<i class="voyager-plus"></i> 新增--}}
            {{--</a>--}}
        {{--@endif--}}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>保证金</th>
                                    <th>倍数</th>
                                    <th>持续时间</th>
                                    <th>配额</th>
                                    <th>总操盘资金</th>
                                    <th>亏损警戒线</th>
                                    <th>亏损平仓线</th>
                                    <th>结束时间</th>
                                    <th>月利息</th>
                                    <th>管理费</th>
                                    <th>总费用</th>
                                    <th class="actions">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    <td>{{ucwords($data->name)}}</td>
                                    <td>{{ucwords($data->username)}}</td>
                                    <td>{{ $data->role ? $data->role->display_name : '' }}</td>
                                    <td>{{$data->email}}</td>
                                    <td>
                                        <img src="@if( strpos($data->avatar, 'http://') === false && strpos($data->avatar, 'https://') === false){{ Voyager::image( $data->avatar ) }}@else{{ $data->avatar }}@endif" style="width:100px">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d H:i:s') }}</td>
                                    <td class="no-sort no-click">
                                        @if (Voyager::can('delete_'.$dataType->name))
                                            <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}" id="delete-{{ $data->id }}">
                                                <i class="voyager-trash"></i> 删除
                                            </div>
                                        @endif
                                        {{--@if (Voyager::can('edit_'.$dataType->name))--}}
                                            {{--<a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}" class="btn-sm btn-primary pull-right edit">--}}
                                                {{--<i class="voyager-edit"></i> 修改--}}
                                            {{--</a>--}}
                                        {{--@endif--}}
                                        {{--@if (Voyager::can('read_'.$dataType->name))--}}
                                            {{--<a href="{{ route('voyager.'.$dataType->slug.'.show', $data->id) }}" class="btn-sm btn-warning pull-right">--}}
                                                {{--<i class="voyager-eye"></i> 详情--}}
                                            {{--</a>--}}
                                        {{--@endif--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if (isset($dataType->server_side) && $dataType->server_side)
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite">显示从 {{ $dataTypeContent->firstItem() }} 至 {{ $dataTypeContent->lastItem() }} 记录,共 {{ $dataTypeContent->total() }} 条</div>
                            </div>
                            <div class="pull-right">
                                {{ $dataTypeContent->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> 你确认要删除 {{ $dataType->display_name_singular }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                 value="确认删除 {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">取消</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    <!-- DataTables -->
    <script>
        @if (!$dataType->server_side)
            $(document).ready(function () {
                $('#dataTable').DataTable({ "order": [] });
            });
        @endif

        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
@stop
