@extends('layouts.page')
@section('title', '新闻资讯')
@section('style')
<link rel="stylesheet" href="{{URL::asset('css/news.css')}}">
@endsection
@section('content')
<div class="container">
	<div class="page-title">
		<h3>新闻资讯</h3>	
	</div>
	<hr>
	<div class="news-list">
		@foreach($articals as $artical)
			<div class="news-body">
				<h6 class="text-muted">新闻 | {{$artical->publish_time}}</h6>
				<a href="news/detail/{{$artical->id}}">{{$artical->title}}</a>
			</div>
		@endforeach
		<div class="page">
			{{$articals->links()}}
		</div>
	</div>
</div>
@endsection