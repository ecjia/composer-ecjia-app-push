<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_template_info.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
{if !$template_code_list}
<div class="alert">
	<a class="close" data-dismiss="alert">×</a>
	{t domain="push"}<strong>温馨提示：</strong>暂时未有消息模板可添加。{/t}
</div>
{/if}

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
					<label class="control-label">{t domain="push"}消息事件：{/t}</label>
					<div class="controls">
						<select name="template_code" class="span6" id="template_code">
	                        <option value='0'>{t domain="push"}请选择{/t}</option>
	        				<!-- {html_options options=$template_code_list selected=$data.template_code} -->
						</select>
					</div>
				</div>
								
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}消息主题：{/t}</label>
					<div class="controls">
						<input type="text" name="subject" id="subject" value="{$data.template_subject}" class="span6"/>
						<span class="input-must">*</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="push"}模板内容：{/t}</label>
					<div class="controls">
						<textarea class="span6 h200" name="content" id="content" >{$data.template_content}</textarea>
						<span class="input-must">*</span>
						<span class="help-block">
							{if $desc}
								<!-- {foreach from=$desc item=list} -->
									{$list}<br>
								<!-- {/foreach} -->
							{/if}
						
						</span>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<input type="hidden" value="{$data.id}" name="id"/>
						<input type="hidden" value="{url path='push/admin_template/ajax_event'}" id="data-href"/>
						<input type="hidden" value="{$channel_code}" name="channel_code" id="channel_code"/>
						{if $action eq "insert"}
						<button class="btn btn-gebo" type="submit">{t domain="push"}确定{/t}</button>
						{else}
						<button class="btn btn-gebo" type="submit">{t domain="push"}更新{/t}</button>
						{/if}
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->