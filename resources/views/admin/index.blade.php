
@extends('admin.layouts.app_admin')
@section('content')
@includeIf('admin.includes.header')
@includeIf('admin.includes.left')
@includeIf($view)
@includeIf('admin.includes.footer')
<aside class="control-sidebar control-sidebar-dark">
</aside>
@endsection
