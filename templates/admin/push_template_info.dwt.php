<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_template_info.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
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
					<label class="control-label">{t}消息模板：{/t}</label>
					<div class="controls users">
						<input type="text" name="template_code" id="template_code" value="{$template.template_code}" class="span4"/>
						<span class="input-must">{$lang.require_field}</span>
					</div>
				</div>
				<div class="control-group formSep">
					<label class="control-label">{t}消息主题：{/t}</label>
					<div class="controls">
						<input type="text" name="subject" id="subject" value="{$template.template_subject}" class="span4"/>
						<span class="input-must">{$lang.require_field}</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t}消息内容：{/t}</label>
					<div class="controls">
					<textarea class="span11 h200" name="content" id="content" rows="16" >{$template.template_content}</textarea>
					<span class="input-must">{$lang.require_field}</span>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<input type="hidden" value="{$template.template_code}" name="old_template_code"/>
					<input type="hidden" value="{$template.template_id}" name="id"/>
						{if $action eq "insert"}
						<button class="btn btn-gebo" type="submit">{t}确定{/t}</button>
						{else}
						<button class="btn btn-gebo" type="submit">{t}更新{/t}</button>
						{/if}
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->