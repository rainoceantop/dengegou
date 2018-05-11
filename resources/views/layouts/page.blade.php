<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>灯E购-@yield('title')</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="icon" href="{{URL::asset('imgs/logo.ico')}}">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
	@yield('style')
	@yield('script')

</head>
<body style="background: #F4F4F4;">
<!-- 导航栏 -->
@include('layouts.navbar')
<!-- 内容 -->
@yield('content')
<!-- 页脚 -->
@include('layouts.footer')


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
@yield('jquery-script')
</body>
</html>