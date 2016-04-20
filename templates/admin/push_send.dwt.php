<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_send.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a href="{$action_link.href}" class="btn plus_or_reply data-pjax"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

	
<div class="row-fluid push_list ">
	<div class="span12">
		<form id="form-privilege"  class="form-horizontal"  name="theForm" action="{$form_action}" method="post">
			<fieldset>
				<div class="row-fluid edit-page">
					<div class="control-group formSep">
						<label class="control-label">{t}消息主题：{/t}</label>
						<div class="controls">
							<input type="text" name="title" value="{$push.title}"/>
							<span class="input-must">{$lang.require_field}</span>
							<span class="help-block">用于标识消息，方便查找和管理</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">{t}消息内容：{/t}</label>
						<div class="controls">
							<textarea class="span8" name="content">{$push.content}</textarea>
							<span class="input-must">{$lang.require_field}</span>
							<span class="help-block">这里是要推送的消息内容</span>
						</div>
					</div>
	
					<h3 class="heading">{t}推送行为{/t}</h3>
					<div class="control-group" >
						<label class="control-label">{t}打开动作{/t}：</label>
						<div class="controls chk_radio">
							<div>
								<div class="choose">
									<label class="nomargin">
										<input type="radio" class="uni_style" name="action" value="0" {if $extradata.open_type eq 0}checked{/if}/><span>无</span>
									</label>
								</div>
								<div class="choose">
									<label class="nomargin">
										<input type="radio" class="uni_style" name="action" value="main" {if $extradata.open_type eq 'main'}checked{/if}/><span>主页</span>
									</label>
								</div>
							</div>
							
							<div class="clear_both">
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="singin" {if $extradata.open_type eq 'singin'}checked{/if}/><span>登陆</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="signup" {if $extradata.open_type eq 'signup'}checked{/if}/><span>注册</span>
									</label>
								</div>
							</div>
							
							<div class="clear_both">
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="discover" {if $extradata.open_type eq 'discover'}checked{/if}/><span>发现</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="qrcode" {if $extradata.open_type eq 'qrcode'}checked{/if}/><span>二维码扫描</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="qrshare" {if $extradata.open_type eq 'qrshare'}checked{/if}/><span>二维码分享</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="history" {if $extradata.open_type eq 'history'}checked{/if}/><span>浏览记录</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="feedback" {if $extradata.open_type eq 'feedback'}checked{/if}/><span>咨询</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="map" {if $extradata.open_type eq 'map'}checked{/if}/><span>地图</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="message" {if $extradata.open_type eq 'message'}checked{/if}/><span>消息中心</span>
									</label>
								</div>
							</div>
						
							<div class="clear_both">
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="webview" {if $extradata.open_type eq 'webview'}checked{/if}/><span>内置浏览器</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="setting" {if $extradata.open_type eq 'setting'}checked{/if}/><span>设置</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="language" {if $extradata.open_type eq 'language'}checked{/if}/><span>语言选择</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="cart" {if $extradata.open_type eq 'cart'}checked{/if}/><span>购物车</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="search" {if $extradata.open_type eq 'search'}checked{/if}/><span>搜索</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="help" {if $extradata.open_type eq 'help'}checked{/if}/><span>帮助中心</span>
									</label>
								</div>
							</div>
							
							<div class="clear_both">
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="goods_list" {if $extradata.open_type eq 'goods_list'}checked{/if}/><span>商品列表</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="goods_comment" {if $extradata.open_type eq 'goods_comment'}checked{/if}/><span>商品评论</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="goods_detail" {if $extradata.open_type eq 'goods_detail'}checked{/if}/><span>商品详情</span>
									</label>
								</div>
								
							</div>
							
							<div class="clear_both">
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="orders_list" {if $extradata.open_type eq 'orders_list'}checked{/if}/><span>我的订单</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="orders_detail" {if $extradata.open_type eq 'orders_detail'}checked{/if}/><span>订单详情</span>
									</label>
								</div>
							</div>
							
							<div class="clear_both">
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="user_center" {if $extradata.open_type eq 'user_center'}checked{/if}/><span>用户中心</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="user_wallet" {if $extradata.open_type eq 'user_wallet'}checked{/if}/><span>我的钱包</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="user_address" {if $extradata.open_type eq 'user_address'}checked{/if}/><span>地址管理</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="user_account" {if $extradata.open_type eq 'user_account'}checked{/if}/><span>账户余额</span>
									</label>
								</div>
								<div class="choose">
									<label>
										<input type="radio" class="uni_style" name="action" value="user_password" {if $extradata.open_type eq 'user_password'}checked{/if}/><span>修改密码</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div id="urldiv" class="control-group hide">
						<label class="control-label">{t}URL：{/t}</label>
						<div class="controls">
							<input type="text" id="url" name="url" value="{$push.url}"/>
						</div>
					</div>
					<div id="keyworddiv" class="control-group hide">
						<label class="control-label">{t}关键字：{/t}</label>
						<div class="controls">
							<input type="text"  id="keyword" name="keyword" value="{$push.keyword}"/>
						</div>
					</div>
					<div id="catdiv" class="control-group hide">
						<label class="control-label">{t}商品分类ID：{/t}</label>
						<div class="controls">
							<input type="text" id="category_id" name="category_id" value="{$push.category_id}"/>
						</div>
					</div>
					<div id="goodsdiv" class="control-group hide">
						<label class="control-label">{t}商品ID：{/t}</label>
						<div class="controls">
							<input type="text" id="goods_id" name="goods_id" value="{$push.goods_id}"/>
						</div>
					</div>
					<div id="ordersdiv" class="control-group hide">
						<label class="control-label">{t}订单ID：{/t}</label>
						<div class="controls">
							<input type="text" id="order_id" name="order_id" value="{$push.order_id}"/>
						</div>
					</div>

					<h3 class="heading">{t}推送对象{/t}</h3>
					
					<div class="control-group" >
						<label class="control-label">{t}推送给{/t}：</label>
						<!-- {if $action eq 'add'} -->
						<div class="controls chk_radio">
							<input type="radio" class="uni_style" name="target" value="0" checked="checked"/><span>所有人</span>
							<input type="radio" class="uni_style" name="target" value="1" /><span>单播</span>
							<input type="radio" class="uni_style" name="target" value="2" /><span>用户</span>
							<input type="radio" class="uni_style" name="target" value="3" /><span>管理员</span>
						</div>
						<!-- {else} -->
						<div class="controls chk_radio">
							<input type="radio" class="uni_style" name="target" value="0" {if $push.device_token eq 'broadcast'}checked{/if}/><span>所有人</span>
							<input type="radio" class="uni_style" name="target" value="1" {if $push.device_token neq 'broadcast'}checked{/if}/><span>单播</span>
							<input type="radio" class="uni_style" name="target" value="2" /><span>用户</span>
							<input type="radio" class="uni_style" name="target" value="3" /><span>管理员</span>
						</div>
						<!-- {/if} -->
					</div>
				
					<div id="onediv" class="control-group hide">
						<label class="control-label">{t}Device Token：{/t}</label>
						<div class="controls">
							<input type="text"  id="devive_token" name="devive_token" value="{if $push.device_token neq 'broadcast'}{$push.device_token}{/if}"/>
						</div>
					</div>
					
					<div id="userdiv" class="control-group hide">
						<label class="control-label">{t}用户ID：{/t}</label>
						<div class="controls">
							<input type="text" id="user_id" name="user_id"/>
						</div>
					</div>
					
					<div id="admindiv" class="control-group hide">
						<label class="control-label">{t}管理员ID：{/t}</label>
						<div class="controls">
							<input type="text" id="admin_id" name="admin_id"/>
						</div>
					</div>
					
					
					<h3 class="heading">{t}推送时机{/t}</h3>
					<div class="control-group formSep">
						<label class="control-label">{t}发送时间：{/t}</label>
						<div class="controls chk_radio">
							<input type="radio" name="priority" value="1" checked="checked" /> {t}立即发送{/t}&nbsp;&nbsp;
							<input type="radio" name="priority" value="0" /> {t}稍后发送{/t}
						</div>
					</div>
					
					<div class="control-group">
						<div class="controls m_t10">
							<input type="hidden" name="appid" value="{$appid}"/>
							<input class="btn btn-gebo" type="submit" value="{t}确定{/t} ">&nbsp;&nbsp;&nbsp;
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->