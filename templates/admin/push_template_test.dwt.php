<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_template_test.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div class="error-success"></div>
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid edit-page" id="conent_area">
	<div class="span12">
		<form id="form-privilege" class="form-horizontal" name="theForm"  method="post" action="{$form_action}">
			<fieldset>
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}推送对象：{/t}</label>
					<div class="controls chk_radio">
						<input type="radio" class="uni_style" name="target" value="user" checked="checked"/><span>{t domain="push"}用户{/t}</span>
						<input type="radio" class="uni_style" name="target" value="merchant" /><span>{t domain="push"}商家用户{/t}</span>
						<input type="radio" class="uni_style" name="target" value="admin" /><span>{t domain="push"}管理员{/t}</span>
					</div>
				</div>
				
				<div id="userdiv" class="push_object formSep">
					<div class="control-group">
						<label class="control-label">{t domain="push"}会员手机号：{/t}</label>
						<div class="controls">
							<input type="text" name="user_keywords" id="user_keywords" />
							<button type="button" class="btn searchUser" data-url='{url path="push/admin/search_user_list"}'>{t domain="push"}搜索{/t}</button>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">{t domain="push"}选择要推送的会员：{/t}</label>
						<div class="controls">
							<select name="user_id" class='user_list'></select>
							<span class="help-block">{t domain="push"}需要先搜索会员，然后再选择。{/t}</span>
						</div>
					</div>
				</div>
				
				<div id="admindiv" class="push_object hide formSep">
					<div class="control-group">
						<label class="control-label">{t domain="push"}管理员名称：{/t}</label>
						<div class="controls">
							<input type="text" name="admin_keywords" id="admin_keywords" />
							<button type="button" class="btn searchAadmin" data-url='{url path="push/admin/search_admin_list"}'>{t domain="push"}搜索{/t}</button>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">{t domain="push"}选择要推送的管理员：{/t}</label>
						<div class="controls">
							<select name="admin_id" class='admin_list'></select>
							<span class="help-block">{t domain="push"}需要先搜索管理员，然后再选择。{/t}</span>
						</div>
					</div>
				</div>
				
				<div id="merdiv" class="push_object hide formSep">
					<div class="control-group">
						<label class="control-label">{t domain="push"}商家会员手机号：{/t}</label>
						<div class="controls">
							<input type="text" name="mer_keywords" id="mer_keywords" />
							<button type="button" class="btn searchMer" data-url='{url path="push/admin/search_merchant_list"}'>{t domain="push"}搜索{/t}</button>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">{t domain="push"}选择要推送的商家会员：{/t}</label>
						<div class="controls">
							<select name="merchant_user_id" class='merchant_user_list'></select>
							<span class="help-block">{t domain="push"}需要先搜索商家会员，然后再选择。{/t}</span>
						</div>
					</div>
				</div>
			
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}消息主题：{/t}</label>
					<div class="controls l_h30">{$data.template_subject}[{$data.template_code}]</div>
				</div>
							
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}消息模板内容：{/t}</label>
					<div class="controls l_h30">{$data.template_content}</div>
				</div>
				
				<!-- {foreach from=$variable item=val} -->
					<div class="control-group formSep">
						<label class="control-label">{$val}：</label>
						<div class="controls">
							<input type="text" name="data[{$val}]" class="span6"  onkeydown="if(event.keyCode==13) return false;"/>
							<span class="input-must">*</span>
						</div>
					</div>
				<!-- {/foreach} -->
				
				<div class="control-group">
					<div class="controls">
						<input type="hidden" value="{$data.template_code}" name="template_code"/>
						<button class="btn btn-gebo" type="submit">{t domain="push"}提交测试{/t}</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->