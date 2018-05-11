@extends('layouts.page')
@section('title', '关于我们')
@section('style')
<link rel="stylesheet" href="{{URL::asset('css/about.css')}}">
@endsection
@section('script')
<script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=661UxHcZiTmrY5zLD3iamGnSxot4rswf"></script>
@endsection
@section('content')
<div class="container">
	<div class="page-title">
		<h3>关于我们</h3>
		<hr>
	</div>
	<div class="about-wrap">
		<div class="row">
			<div class="col-4">
				<div id="about-list" class="list-group about-navbar">
					<a class="list-group-item list-group-item-action" href="#list-item-1">公司简介</a>
					<a class="list-group-item list-group-item-action" href="#list-item-2">服务范围</a>
					<a class="list-group-item list-group-item-action" href="#list-item-3">企业文化</a>
					<a class="list-group-item list-group-item-action" href="#list-item-4">联系方式</a>
					<a class="list-group-item list-group-item-action" href="#list-item-5">坐标位置</a>
				</div>
			</div>
			<div class="col-8">
				<div data-spy="scroll" data-target="#about-list" data-offset="0" class="about-scrollbar">
					<h4 id="list-item-1">公司简介</h4>
					<p>灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。灯E购是一家专注整合古镇优质厂货的综合型商城，商城内含有上百家优质厂商，数千款精美商品，各类目俱全，采购必看。</p>
					<hr>
					<h4 id="list-item-2">服务范围</h4>
					<p>公司一贯秉承 “ 诚信、优质、规范、务实 ” 为宗旨，奉行勇于进取、真诚合作的精神，以高品质、高技术含量及优质的服务，真诚地满足广大的新老客户</p>
					<ul>
						<li>LED工程设计施工</li>
						<li>泛光照明设计施工</li>
						<li>建筑智能化工程设计施工</li>
						<li>市政亮化工程规划设计施工</li>
						<li>园林景观照明设计施工</li>
						<li>户外照明节能改造设计施工</li>
						<li>户外照明产品研发、生产及销售</li>
					</ul>
					<hr>
					<h4 id="list-item-3">企业文化</h4>
					<dl>
						<dt>灯E购企业宣言</dt>
						<dd>
							专注科技之光,
							引领光明事业
						</dd>
						<dt>灯E购环保宣言</dt>
						<dd>
							节能、减碳,
							创造绿色生活,
							先从照明开始……
						</dd>
						<dt>灯E购的企业宗旨</dt>
						<dd>
							产品质量第一,
							服务用户第一,
							追求专业一流,
							打造金牌品质
						</dd>
						<dt>灯E购的管理方针</dt>
						<dd>
							走科技之路,造高质产品;
							建绿色工程,做安全楷模;
							创形象品牌,求完美发展
						</dd>
						<dt>荣获 资质</dt>
						<dd>
							<ul>
								<li>荣获城市及道路专业照明工程专业承包壹级施工资质</li>
								<li>荣获市政预选工程合格的施工单位</li>
								<li>荣获节能减排合同能源管理示范单位称号</li>
								<li>荣获“施特朗”深圳独家代理商</li>
								<li>荣获 ISO/SC管理认证</li>
								<li>荣获 节能产品国家级证书</li>
								<li>荣获工厂节能改造工程国家级认证</li>
								<li>正式成为深圳照明协会会员</li>
								<li>正式成为塔里木石油基地公司供应商会员</li>
							</ul>
						</dd>
					</dl>
					<hr>
					<h4 id="list-item-4">联系方式</h4>
					<dl>
						<dt>业务咨询专线</dt>
						<dd>0755-25427755 | 0755-86642611</dd>
						<dt>售后服务专线</dt>
						<dd>0755-25427755-888</dd>
						<dt>工程拓展部</dt>
						<dd>0755-25427755-810 罗经理</dd>
						<dt>供应商专线</dt>
						<dd>0755-86642611-815</dd>
						<dt>企业负责人专线</dt>
						<dd>13751132028</dd>
						<dt>公司地址</dt>
						<dd>深圳市南山区龙珠大道香瑞园南区118号</dd>
						<dt>电话</dt>
						<dd>+86-755-25427755</dd>
						<dt>传真</dt>
						<dd>+86-755-25416486</dd>
						<dt>E-MAIL</dt>
						<dd>TY25400821@126.com</dd>
						<dt>工厂地址</dt>
						<dd>深圳市龙岗区布吉上李朗联大工业区B区</dd>
						<dt>工厂电话</dt>
						<dd>+86-755-86642611</dd>
					</dl>
					<hr>
					<h4 id="list-item-5">坐标位置</h4>
					<div id="map" style="width: 100%;height: 400px;">
						
					</div>
					<script type="text/javascript">
						var map = new BMap.Map("map");    
						var point = new BMap.Point(113.996845,22.564765);
						map.centerAndZoom(point, 10); 
						setTimeout(function(){
							map.setZoom(17);   
						}, 2000);  //2秒后放大到14级
						var opts = {
									width : 200,     // 信息窗口宽度
									height: 30,     // 信息窗口高度
									enableMessage:true//设置允许信息窗发送短息
								};
						var marker = new BMap.Marker(point);        // 创建标注  
						map.addOverlay(marker);
						addClickHandler("地铁7号线深云站D出口直走至香瑞园右转",marker);
						function addClickHandler(content,marker){
							marker.addEventListener("click",function(e){
								openInfo(content,e)
							});
						}
						function openInfo(content,e){
							var p = e.target;
							var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
							var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象 
							map.openInfoWindow(infoWindow,point); //开启信息窗口
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
