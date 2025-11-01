@extends('layouts.master')
@section('title','Log Activities')
@section('content')
    <div class="ibox">
        <div class="ibox-body">

            <form method="GET" action="{{ route('logs.filtered') }}" class="mb-4" autocomplete="off">
                <div class="row">
                    <div class="col-md-3">
                        <select name="user_id" class="form-control">
                            <option value="">All Users</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name ?? $user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="action" class="form-control">
                            <option value="">All Actions</option>
                            <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Created</option>
                            <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Updated</option>
                            <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="from_date" class="form-control datePicker" placeholder="Start Date" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="to_date" class="form-control datePicker" placeholder="End Date" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
{{--                        <a href="{{ route('logs.index') }}" class="btn btn-secondary">Reset</a>--}}
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-9" style="padding-top: 2vh">
                    <h5 class="font-strong">LOG ACTIVITIES</h5>
                </div>
                <div class="col-3" style="text-align: right">

                </div>
            </div>






            <hr class="mt-3 mb-4"/>
            <div class="clearfix"></div>

            @include('layouts.table_header')

            <div class="table-responsive row">
                <table class="table table-bordered table-hover table-sm" id="datatable">
                    <thead class="thead-default thead-lg">
                    <tr>
                        <th>S/N</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Model</th>
                        <th>Changes</th>
                        <th>IP</th>
                        <th>URL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($logs as $key=>$log)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ optional($log->causer)->full_name ?? 'System' }}</td>
                            <td>{{ $log->properties['action'] ?? '-' }}</td>
                            <td>{{ $log->subject_type ?? '-' }}</td>
                            <td>
                                @if(isset($log->properties['attributes']))
                                    <ul>
                                        @foreach ($log->properties['attributes'] as $key => $value)
                                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                @elseif(isset($log->properties['old']) || isset($log->properties['new']))
                                    <div>
                                        <strong>Old:</strong>
                                        <ul>
                                            @foreach ($log->properties['old'] ?? [] as $key => $value)
                                                <li>{{ $key }}: {{ $value }}</li>
                                            @endforeach
                                        </ul>
                                        <strong>New:</strong>
                                        <ul>
                                            @foreach ($log->properties['new'] ?? [] as $key => $value)
                                                <li>{{ $key }}: {{ $value }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $log->properties['ip'] ?? '-' }}</td>
                            <td>{{ $log->properties['url'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('Scripts')
    <script>
        datePickerLoad()
    </script>
@endsection
