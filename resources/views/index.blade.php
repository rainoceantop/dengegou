@extends('layouts.page')

@section('title', '首页')

@section('content')
<!-- 幻灯片 -->
<div id="carousel" class="carousel slide" data-ride="carousel">
	<!-- 幻灯片轮播图的选项栏 -->
	<ol class="carousel-indicators">
		<li data-target="#carousel" data-slide-to="0" class="active"></li>
		<li data-target="#carousel" data-slide-to="1"></li>
		<li data-target="#carousel" data-slide-to="2"></li>
	</ol>
	<!-- 幻灯片的轮播图片 -->
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block" src="{{$carousels['carousel-1']}}">
		</div>
		<div class="carousel-item">
			<img class="d-block" src="{{$carousels['carousel-2']}}">
		</div>
		<div class="carousel-item">
			<img class="d-block" src="{{$carousels['carousel-3']}}">
		</div>
	</div>
	<!-- 幻灯片的向前向后图标 -->
	<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">上一页</span>
	</a>
	<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">下一页</span>
	</a>
</div>
<style type="text/css">
@media(min-width: 750px){
	.carousel-item>img{
	width: 100%;
	height: 500px;
	}
}
@media(max-width: 750px){
	.carousel-item>img{
	width: 100%;
	height: 200px;
	}
}
</style>
<!-- 关于我们区域 -->
<div class="block-a">
	<div class="container">
		<h2 class="title">关于我们<a href="about" class="float-right" title="更多">--></a></h2>
		<hr>
		<div class="about-us">
			<img src="{{URL::asset('imgs/company.jpg')}}">
			<div class="detail">
				<h3>公司简介</h3>
				<p>
					灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。
				</p>
				<a href="about" class="float-right">更多</a>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
@media(min-width: 750px){
.about-us{
	display: flex;
	flex-direction: row;
	justify-content: center;
	flex-wrap: wrap;
	align-items: center;
}
.about-us img{
	width: 50%;
	border-radius: 5px;
}
.about-us .detail{
	width: 50%;
	background: #C9D8E6;
	border-radius: 5px;
	padding: 20px;
}
.about-us .detail>a{
	position: relative;
	right: 50px;
}
}
@media(max-width: 750px){
.about-us{
	display: flex;
	flex-direction: column;
	justify-content: center;
	flex-wrap: wrap;
	align-items: center;
}
.about-us img{
	width: 80%;
	border-radius: 5px;
}
.about-us .detail{
	width: 80%;
	background: #C9D8E6;
	border-radius: 5px;
	padding: 15px;
}
.about-us .detail>a{
	position: relative;
	right: 15px;
}
}
</style>
<!-- 近期新闻区域 -->
<div class="block-b">
	<div class="container">
		<h2 class="title">近期新闻<a href="news" class="float-right" title="更多">--></a></h2>
		<hr>
		<div class="latest-news">
			<div class="news-card">
			<div class="news-list">
				@foreach($articals as $artical)
				<div class="detail">
					<h6 class="text-muted">新闻 | {{$artical->publish_time}}</h6>
					<a id="a{{$artical->id}}" data-toggle="modal" data-target="#artical{{$artical->id}}Modal">
						{{$artical->title}}
					</a>
					<!-- Modal模型框 -->
					<div class="modal fade" id="artical{{$artical->id}}Modal" tabindex="-1" role="dialog" >
						<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">
										{{$artical->title}}
										<br>
										<span class="text-muted">
											{{$artical->publish_time}}
										</span>
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									{!!$artical->content!!}
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<style type="text/css">
.latest-news{
	display: flex;
	justify-content: flex-start;
	flex-wrap: wrap;
}
.modal-body img{
	max-width: 100%;
}
.news-list{
	width: 100%;
	min-width: 300px;
}
.news-list a{
	cursor: pointer;
}
.news-list a:hover{
	text-decoration: underline !important;
}
.news-list>.detail{
	margin-bottom: 40px;
}
</style>
<!-- 合作商家区域 -->
<div class="block-a" id="contact-us-area">
	<div class="container">
		<h2 class="title">联系我们</h2>
		<hr>
		<!-- 联系表单 -->
		<form action="contact" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<input class="form-control" type="text" name="name" placeholder="*姓名" maxlength="15" minlength="2" required>
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="organization" placeholder="单位" minlength="2" maxlength="50">
			</div>
			<div class="form-group">
				<input class="form-control" minlength="2" type="text" name="address" placeholder="地址" maxlength="50">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="number" placeholder="*电话号码（区号用 - 隔开）" pattern="([0-9]{1,5}-)?[0-9]{4,11}" required>
			</div>
			<div class="form-group">
				<input class="form-control" type="email" name="email" placeholder="*email" required>
			</div>
			<div class="form-group">
				<textarea class="form-control" rows="3" name="content" placeholder="*留言内容" required></textarea>
			</div>
			<button type="submit" class="btn btn-primary form-control">提交</button>
		</form>
	</div>
	@if (session('status')||$errors->status != '[]')
	<!-- Button trigger modal -->
	<a style="display: none" id="callbackbutton" data-toggle="modal" data-target="#callbackMsg"></a>

	<!-- Modal -->
	<div class="modal fade" id="callbackMsg" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">操作反馈</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{{session('status')}}
					{{$errors->status=='[]'?'':$errors->status}}
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$("#callbackbutton").click()
			function cancel(){
				$("#callbackMsg").find("button").click()
			}
			setTimeout(cancel, 1500)
		})
	</script>
	@endif
</div>
<style type="text/css">

</style>

<!-- 共同样式 -->
<style type="text/css">
.block-a{
	background: #F4F4F4;
	padding: 25px 0;
}
.block-b{
	background: #EDDCD5;
	padding: 25px 0;
}
</style>
@endsection

@section('jquery-script')
<script src="{{URL::asset('js/index.jq.js')}}"></script>
@endsection