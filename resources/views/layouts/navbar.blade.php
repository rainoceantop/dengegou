<!-- 设置导航栏背景颜色以及折叠扩张界限 -->
<nav class="navbar navbar-expand-md navbar-light">
	<div class="container">
		<!-- 网站logo -->
		<a class="navbar-brand" href="/">
			<img style="height: 32px;" src="{{URL::asset('imgs/logo.jpg')}}">
		</a>
		<!-- 目标指向折叠扩张导航栏目 -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			<!-- 折叠后的图标 -->
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- 折叠扩张导航栏目 -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- mr-auto将不在此标签内的兄弟标签挤到右侧 -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="/">首页</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/about">关于</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/news">新闻</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/#contact-us-area" id="contact-us-button">联系我们</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<style type="text/css">
	nav{
		background: #F4F4F4;
		font-weight: bold;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
	}
</style>
