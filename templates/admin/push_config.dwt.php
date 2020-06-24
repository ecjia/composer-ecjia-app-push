<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_config_edit.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		{t domain="push"}平台配置{/t}
		{if $action_link}
		<a class="btn data-pjax" href="{$action_link.href}" id="sticky_a" style="float:right;margin-top:-3px;"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid edit-page">
	<div class="span12">
		<form method="post" class="form-horizontal" action="{$form_action}" name="theForm"  >
			<fieldset>
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}应用名称：{/t}</label>
					<div class="controls">
						<input type='text' name='app_name' value="{$config_appname}"/> 
						<span class="input-must"><span class="require-field" style="color:#FF0000">*</span></span>
						<span class="help-block">{t domain="push"}仅限于Android应用接收消息通知时提示{/t}</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}推送环境：{/t}</label>
					<div class="controls">
						<input type="radio" name="app_push_development" value="1" {if $config_apppush eq 1} checked="true" {/if}/>{t domain="push"}开发环境{/t}
						<input type="radio" name="app_push_development" value="0" {if $config_apppush eq 0} checked="true" {/if}/>{t domain="push"}生产环境{/t}
						<span class="help-block">{t domain="push"}App上线运行请务必切换置生产环境{/t}</span>
					</div>
				</div>

				<div>
					<h3 class="heading">
						<!-- {if $ur_here}{$ur_here}{/if} -->
					</h3>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}客户下单：{/t}</label>
					<div class="controls chk_radio">
						<input type="radio" name="config_order" value="1" {if $config_pushplace eq 1} checked="true" {/if}/>{t domain="push"}推送{/t}
						<input type="radio" name="config_order" value="0" {if $config_pushplace eq 0} checked="true" {/if}/>{t domain="push"}不推送{/t}
						<span class="help-block">{t domain="push"}客户下订单时是否给商家推送消息{/t}</span>
					</div>
					<div class="controls control-group draggable">
						<div class="ms-container span6" id="ms-custom-navigation">
							<div class="ms-selectable">
								<div class="search-header">
									<input class="span12" id="ms-search" type="text" placeholder='{t domain="push"}筛选搜索到的应用名称{/t}' autocomplete="off">
								</div>
								<ul class="ms-list nav-list-ready select_app_type">
									<!-- {foreach from=$mobile_manage item=type key=key} -->
									<li data-id="{$type.app_id}" id="appId_{$type.app_id}" class="ms-elem-selectable isShow"><span>{$type.app_name}</span></li>
									<!-- {foreachelse}-->
									<li class="ms-elem-selectable disabled"><span>{t domain="push"}暂无内容{/t}</span></li>
									<!-- {/foreach} -->
								</ul>
							</div>
							<div class="ms-selection">
								<div class="custom-header custom-header-align">{t domain="push"}使用应用名称{/t}</div>
								<ul class="ms-list nav-list-content">
									<!-- {foreach from=$apps_group item=item key=key} -->
									<li class="ms-elem-selection">
										<input type="hidden" value="{$item.app_id}" name="app_id[]" />
										<!-- {$item.app_name} -->
										<span class="edit-list"><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span>
									</li>
									<!-- {/foreach} -->
								</ul>
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}客户付款：{/t}</label>
					<div class="controls chk_radio">
						<input type="radio" name="config_money" value="1" {if $config_pushpay eq 1} checked="true" {/if}/>{t domain="push"}推送{/t}
						<input type="radio" name="config_money" value="0" {if $config_pushpay eq 0} checked="true" {/if}/>{t domain="push"}不推送{/t}
						<span class="help-block">{t domain="push"}客户付款时是否给商家推送消息{/t}</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}商家发货：{/t}</label>
					<div class="controls chk_radio">
						<input type="radio" name="config_shipping" value="1" {if $config_pushship eq 1} checked="true" {/if}/>{t domain="push"}推送{/t}
						<input type="radio" name="config_shipping" value="0" {if $config_pushship eq 0} checked="true" {/if}/>{t domain="push"}不推送{/t}
						<span class="help-block">{t domain="push"}商家发货时是否给客户推送消息{/t}</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}用户注册：{/t}</label>
					<div class="controls chk_radio">
						<input type="radio" name="config_user" value="1" {if $config_pushsignin eq 1} checked="true" {/if}/>{t domain="push"}推送{/t}
						<input type="radio" name="config_user" value="0" {if $config_pushsignin eq 0} checked="true" {/if}/>{t domain="push"}不推送{/t}
						<span class="help-block">{t domain="push"}用户注册时是否给客户推送消息{/t}</span>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<input type="submit" value='{t domain="push"}确定{/t}' class="btn btn-gebo" />
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->