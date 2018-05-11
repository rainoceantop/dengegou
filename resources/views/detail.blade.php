@extends('layouts.page')
@section('title', $artical->title)
@section('style')
<link rel="stylesheet" href="{{URL::asset('css/detail.css')}}">
@endsection
@section('content')
<div class="container">
	<div class="wrapper">
		<div class="artical-body">
			<div class="artical-title">
				<h5>{{$artical->title}}</h5>
				<span class="text-muted">{{$artical->publish_time}}</span>
				<hr>
			</div>
			<div class="artical-content">
				{!!$artical->content!!}
			</div>
			<div class="artical-footer text-right">
				<a href="javascript:history.go(-1)" class="btn btn-secondary" style="color: white;">
					返回
				</a>
			</div>
		</div>
	</div>
</div>
@endsection