<html>
<head>
	<title>灯E购-后台管理</title>
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/admin.css')}}">
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="icon" href="{{URL::asset('imgs/logo.ico')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
	<script src="{{URL::asset('editor/release/wangEditor.min.js')}}"></script>
</head>
<body>

	<section class="login-info">
		<span style="color:white;font-size: bold;"><i class="far fa-user"></i>&nbsp;{{ Auth::user()->name }}&nbsp;|&nbsp;</span>
		<a href="{{ route('logout') }}"
		onclick="event.preventDefault();
		document.getElementById('logout-form').submit();">
		<i class="fas fa-sign-out-alt" title="登出"></i>
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
</section>

<div class="wrapper">
	<!-- 操作面板 -->
	<div class="panel">
		<div class="accordion" id="accordion">
			<!-- 发表文章 -->
			<a class="tag-title" data-toggle="collapse" data-target="#collapseOne">发表文章</a>
			<!-- class加show的话会直接显示 -->
			<div id="collapseOne" class="collapse" data-parent="#accordion">
				<div class="tag-content">
					<form action="/artical" method="POST">
						{{csrf_field()}}
						<div class="form-group">
							<label for="artical_title">文章标题</label>
							<input id="artical_title" type="text" name="artical_title" class="form-control" placeholder="标题" required>
						</div>
						<div class="form-group">
							<label for="artical_content">文章内容</label>
							<div id="postEditorToobar">
							</div>
							<small style="color: lightgray;">小提示：如需插入图片推荐使用链接地址</small>
							<!-- <div style="padding: 5px 0; color: #ccc"></div> -->
							<div id="postEditorArea" style="background: white;height: 400px;min-height:300px;resize: vertical;overflow: auto;">
							</div>
							<textarea id="artical_content" name="artical_content" style="display: none;" required></textarea>
						</div>
						<div class="form-group">
							<label for="publish_time">发表时间</label>
							<input id="publish_time" type="datetime-local" name="publish_time" class="form-control" required>
						</div>
						<button type="submit" class="btn btn-block btn-success">发表</button>
					</form>
				</div>
			</div>
			<!-- 循环两次，列出已发表和未发表的文章 -->
			@for($i=0; $i<2; $i++)
			<!-- 操作已发表文章 -->
			<a class="tag-title" data-toggle="collapse" data-target="#collapse{{$i==0?'Two':'Three'}}">{{$i==0?'已发表文章('.$articals_count["published"].')':'未发表文章('.$articals_count["unpublish"].')'}}</a>
			<div id="collapse{{$i==0?'Two':'Three'}}" class="collapse 
			{{session('case')?(session('case')=='published' && $i==0?'show':'' || session('case')=='unpublish' && $i==1?'show':''):''}}" data-parent="#accordion">
			<div class="tag-content">
				@if($articals_count["published"]==0&&$i==0)
				<div class="text-muted non-case"><p>暂无文章发布</p></div>
				@elseif($articals_count["unpublish"]==0&&$i==1)
				<div class="text-muted non-case"><p>暂无文章未发布</p></div>
				@else
				<!-- 覆盖表格背景颜色 -->
				<table class="table table-dark table-hover" style="background: #3F2626">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">文章标题</th>
							<th scope="col" width="22%;">发表时间</th>
							@if($i == 1)
							<th scope="col" width="8%;">状态</th>
							@endif
							<th scope="col" width="10%;">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($articals[$i==0?"published":"unpublish"] as $key=>$artical)
						<tr>
							<th scope="row">{{$key+1}}</th>
							<td>
								<a id="a{{$artical->id}}" data-toggle="modal" data-target="#artical{{$artical->id}}Modal" style="cursor: pointer;">
									{{$artical->title}}
								</a>
								<!-- Modal模型框 -->
								<div class="modal fade" id="artical{{$artical->id}}Modal" tabindex="-1" role="dialog" >
									<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
										<div class="modal-content artical-show">
											<div class="modal-header">
												<h5 class="modal-title">{{$artical->title}}
													<br>
													<small class="text-muted">{{$artical->publish_time}}</small>
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
										<div class="modal-content artical-edit" style="display: none;">
											<form action="/artical/{{$artical->id}}" method="POST">
												<input type="hidden" name="_method" value="PUT">
												<input type="hidden" name="case" value="{{$i==0?'published':'unpublish'}}">
												{{csrf_field()}}
												<div class="modal-header form-group">
													<input type="text" name="artical_update_title" value="{{$artical->title}}" placeholder="标题" class="form-control">
												</div>
												<div class="modal-body form-group">
													<div class="editEditor" name="artical_update_content">
														<p>{!!$artical->content!!}</p>
													</div>
													<textarea name="artical_update_content" style="display: none;">{{$artical->content}}</textarea>
												</div>
												<div class="modal-footer form-group">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
													<button type="submit" data-p="{{$i==0?'published':'unpublish'}}" data-i="{{$key}}" data-artical-id="{{$artical->id}}" class="btn btn-success updateButton">更新</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</td>
							<td><span>{{$artical->publish_time}}</span></td>
							@if($i != 0)
							<td>{{$artical->publish_time>Carbon\Carbon::now()?"未发表":"已撤销"}}</td>
							@endif
							<td>
								<i data-artical-id="{{$artical->id}}" class="far fa-edit a-icon-edit" title="更新"></i>
								|
								<i class="far fa-trash-alt a-icon-delete" title="删除" data-artical-title="{{$artical->title}}"></i>
								<form action="artical/{{$artical->id}}" method="POST" style="display: none;">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="case" value="{{$i==0?'published':'unpublish'}}">
									{{csrf_field()}}
								</form>
								|
								@if($i==0)
								<i class="fas fa-angle-double-down a-icon-down" title="撤销"></i>
								<form style="display: none;" action="artical/{{$artical->id}}" method="POST">
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="_case" value="revoke">
									<input type="hidden" name="case" value="published">
									{{csrf_field()}}
								</form>
								@else
								<i class="fas fa-angle-double-up a-icon-up" title="立即发布"></i>
								<form style="display: none;" action="artical/{{$artical->id}}" method="POST">
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="_case" value="publish">
									<input type="hidden" name="case" value="unpublish">
									{{csrf_field()}}
								</form>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
				<div class="page">
					{{$articals[$i==0?"published":"unpublish"]->appends(['case'=>$i==0?'published':'unpublish'])->render()}}
				</div>
				<style type="text/css">
				.page{
					width: 100%;
					color: white;
				}
				.pagination{
					justify-content: center;
				}
				.pagination>li{
					font-size: 20px;
					margin: 0 15px;
				}
			</style>
		</div>
	</div>
	@endfor
	<!-- 留言消息 -->
	<a class="tag-title" data-toggle="collapse" data-target="#collapseFour">留言消息({{$contacts_count}})</a>
	<div id="collapseFour" class="collapse {{session('case')=='contact'?'show':''}}" data-parent="#accordion">
		<div class="tag-content">
			@if($contacts_count==0)
			<div class="text-muted non-case"><p>暂无留言消息</p></div>
			@else
			<table class="table table-dark table-hover" style="background: #3F2626">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">留言人</th>
						<th scope="col">单位</th>
						<th scope="col">电话号码</th>
						<th scope="col">电子邮件</th>
						<th scope="col">留言时间</th>
						<th scope="col" width="10%">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($contacts as $key=>$contact)
					<tr>
						<th scope="row">{{$key+1}}</th>
						<td>{{$contact->name}}</td>
						<td>{{$contact->organization}}</td>
						<td>{{$contact->number}}</td>
						<td>{{$contact->email}}</td>
						<td>{{$contact->sent_time}}</td>
						<td>
							<a id="c{{$contact->id}}" data-toggle="modal" data-target="#contact{{$contact->id}}Modal" style="cursor: pointer;">
								<i class="far fa-comment c-icon-view" title="浏览内容"></i>
							</a>
							<div class="modal fade" id="contact{{$contact->id}}Modal" tabindex="-1" role="dialog" >
								<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">{{$contact->name}}&nbsp;的留言消息</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<dl>
												<dt>留言人</dt>
												<dd>{{$contact->name}}</dd>
												<dt>单位</dt>
												<dd>{{$contact->organization}}</dd>
												<dt>地址</dt>
												<dd>{{$contact->address}}</dd>
												<dt>电话号码</dt>
												<dd>{{$contact->number}}</dd>
												<dt>电子邮件</dt>
												<dd>{{$contact->email}}</dd>
												<dt>留言内容</dt>
												<dd>{{$contact->content}}</dd>
											</dl>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
											<button type="button" class="btn btn-danger c-modal-delete">删除</button>
										</div>
									</div>
								</div>
							</div>
							|
							<i class="far fa-trash-alt c-icon-delete" title="删除" data-contact-name="{{$contact->name}}"></i>
							<form action="contact/{{$contact->id}}" method="POST" style="display: none;">
								<input type="hidden" name="_method" value="DELETE">
								<input type="hidden" name="case" value="contact">
								{{csrf_field()}}
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif

			<div class="page">
				{{$contacts->appends(['case'=>'contact'])->render()}}
			</div>
		</div>
	</div>
	<a class="tag-title" data-toggle="collapse" data-target="#collapseFive">轮播图更换</a>
	<div id="collapseFive" class="collapse {{session('case')=='carousel'?'show':''}}" data-parent="#accordion">
		<div class="tag-content">
			@foreach($carousels as $key => $carousel)
			<div class="carousel">
				<img src="{{URL::asset($carousel)}}">
				<form id="carousels-form" action="carousels" method="POST" enctype="multipart/form-data" style="display: none;">
					{{csrf_field()}}
					<input type="hidden" name="key" value="{{$key}}">
					<input type="file" name="file">
				</form>
			</div>
			@endforeach
			<script>
				$(function(){
					$(".carousel>img").on("click", function(){
						$(this).next("form").find("input[name='file']").click().on("change", function(){
							$(this).parents("form").submit()
						})
					})
				})
			</script>
		</div>
	</div>
</div>
</div>
@if (session('status'))
<!-- 调用modal按钮 -->
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


<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{URL::asset('js/admin.js')}}"></script>
<script>
	$(function(){
		const E = window.wangEditor
		var postEditor = new E('#postEditorToobar', '#postEditorArea')
		postEditor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $("#artical_content").val(html)
        }
        postEditor.customConfig.uploadImgServer = "artical/upload"
        postEditor.customConfig.uploadFileName = "uploaded_files"
        postEditor.customConfig.zIndex = 0
        postEditor.customConfig.uploadImgParams = {
        	_token: "{{csrf_token()}}"
        }
        postEditor.create()

        $(".editEditor").each(function(){
        	var editEditor = new E($(this)[0])
        	editEditor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $(".artical-edit").find("textarea[name='artical_update_content']").val(html)
        }
        editEditor.create()
    })
    })
</script>

<script>
	const articals = @json($articals)

	$(function(){
		$(".a-icon-edit").on("click", function(){
			let id = $(this).data("artical-id")
			let aid = "#a"+id
			let mid = $(aid).data("target")
				//点击按钮更改显示为编辑
				$(mid).find(".artical-show").css("display", "none")
				$(mid).find(".artical-edit").css("display", "")
				//显示模态框
				$(aid).click()
				//监听模态框关闭，显示回浏览
				$(mid).on("hidden.bs.modal", function(){
					$(mid).find(".artical-show").css("display", "")
					$(mid).find(".artical-edit").css("display", "none")
				})
			})
		$(".a-icon-delete").on("click", function(){
			if(confirm("确认删除《"+$(this).data("artical-title")+"》这篇文章吗？")){
				$(this).next("form").submit()
			}
		})
		$(".a-icon-up, .a-icon-down").on("click", function(){
			$(this).next("form").submit()
		})
		$(".c-modal-delete").on("click", function(){
			$(this).parents("td").find(".c-icon-delete").click()
		})
		$(".c-icon-delete").on("click", function(){
			if(confirm("确认删除留言人"+$(this).data("contact-name")+"的留言消息吗？")){
				$(this).next("form").submit()
			}
		})
	})
</script>
</body>
</html>