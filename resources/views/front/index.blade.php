@extends('front.layouts.app_front')
@section('content')
<section class="">
@includeIf('front.include.header')
</section>
@includeIf($view)
@includeIf('front.include.footer')
@endsection