<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_template_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>
<div class="row-fluid">
	<table class="table table-striped smpl_tbl dataTable table-hide-edit" id="plugin-table">
		<thead>
			<tr>
				<th class="w200">{t}消息模板名称{/t}</th>
				<th class="w200">{t}消息主题{/t}</th>
				<th>{t}消息内容{/t}</th>
			</tr>
		</thead>
		<tbody>
			<!-- {foreach from=$templates item=list} -->
			<tr>
				 <td class="hide-edit-area hide_edit_area_bottom"> {$list.template_code}
					<div class="edit-list">
					 <a class="data-pjax no-underline" href='{url path="push/admin_template/edit" args="id={$list.template_id}"}' title="{$lang.edit}">{t}编辑{/t}</a>&nbsp;|&nbsp;
	                 <a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg="{t}您确定要删除该消息模板吗？{/t}" href="{RC_Uri::url('push/admin_template/remove',"id={$list.template_id}")}" title="{t}移除{/t}"> {t}删除{/t}</a>
					</div>
				 </td>
				<td>{$list.template_subject}</td>
				<td>{$list.template_content}</td>
			</tr>
			<!-- {/foreach} -->
		</tbody>
	</table>
</div>
<!-- {/block} -->