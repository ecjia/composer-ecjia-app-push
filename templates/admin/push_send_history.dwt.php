<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
ecjia.admin.push_list.init();
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

<ul class="nav nav-pills">
<!-- {foreach from=$applistdb.item item=val key=key} -->
	<li class="{if $listdb.filter.appid eq $val.app_id}active{elseif $key eq 0 and $listdb.filter.appid eq ''}active{/if}"><a class="data-pjax" href='{url path="push/admin/init" args="appid={$val.app_id}"}'>{$val.app_name} <span class="badge badge-info">{$val.count}</span></a></li>
<!-- {/foreach} -->
</ul>

<!-- 批量操作、筛选、搜索 -->
<div class="row-fluid batch" >
	<form method="post" action="{$search_action}&pushval={$listdb.filter.pushval}" name="searchForm">
		<div class="btn-group f_l m_r5">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fontello-icon-cog"></i>{t}批量操作{/t}
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a class="button_remove" data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url="{url path='push/admin/batch'}" data-msg="您确定要这么做吗？" data-noSelectMsg="请先选中要删除的消息！" data-name="message_id" href="javascript:;"><i class="fontello-icon-trash"></i>{t}删除消息{/t}</a></li>
				<li><a class="button_remove" data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url="{url path='push/admin/batch_resend'}" data-msg="您确定要这么做吗？" data-noSelectMsg="请先选中要再次推送的消息！" data-name="message_id" href="javascript:;"><i class="fontello-icon-chat-empty"></i>{t}再次推送消息{/t}</a></li>
			</ul>
		</div>
		
		<div class="choose_list f_l">
			<div class="screen">
				<!-- 级别 -->
				<select name="status" class="no_search w150"  id="select-status">
					<option value=''>{t}选择推送状态{/t}</option>
					<option value='0' {if $smarty.get.status eq '0'} selected="true" {/if}>推送失败</option>
					<option value='1' {if $smarty.get.status eq '1'} selected="true" {/if}>推送完成</option>
				</select>
				<button class="btn screen-btn" type="button">{t}筛选{/t}</button>
			</div>
		</div>
		
		<div class="choose_list f_r" >
			<input type="text" name="keywords" value="{$listdb.filter.keywords}" placeholder="请输入消息主题"/>
			<button class="btn search_push" type="button">{t}搜索{/t}</button>
		</div>
	</form>
</div>

<div class="row-fluid list-page">
	<div class="span12">	
		<form method="POST" action="{$form_action}" name="listForm">
			<table class="table table-striped smpl_tbl table-hide-edit table_vam " id="smpl_tbl" data-uniform="uniform" >
				<thead>
					<tr>
						<th class="table_checkbox"><input type="checkbox" name="select_rows" data-toggle="selectall" data-children=".checkbox"/></th>
						<th class="w200">{t}消息主题{/t}</th>
						<th class="w350">{t}消息内容{/t}</th>
						<th class="w350">{t}推送状态{/t}</th>
						<th class="w200">{t}添加时间{/t}</th>
					</tr>
				</thead>
				<tbody>
					<!-- {foreach from=$listdb.item item=val} -->
						<tr>
							<td>
								<span><input type="checkbox" name="checkboxes[]" class="checkbox" value="{$val.message_id}"/></span>
							</td>
							<td class="hide-edit-area">
								<span>{$val.title}</span>
								<div class="edit-list">
										<!-- {if $val.in_status neq 1} -->
										<a class="ajaxpush" data-msg='{t name="{$val.title}"}您确定要推送[ %1 ]这条消息吗？{/t}' href='{url path="push/admin/push" args="message_id={$val.message_id}&appid={$val.app_id}"}'>{t}推送{/t}</a>&nbsp;|&nbsp;
										<!-- {else} -->
										<a class="ajaxpush" data-msg='{t name="{$val.title}"}您确定要再次推送[ %1 ]这条消息吗？{/t}' href='{url path="push/admin/push" args="message_id={$val.message_id}&appid={$val.app_id}"}'>{t}再次推送{/t}</a>&nbsp;|&nbsp;
										<!-- {/if} -->
										{assign var=edit_url value=RC_Uri::url('push/admin/push_copy',"message_id={$val.message_id}&appid={$val.app_id}")}
								      	<a class="data-pjax" href="{$edit_url}">{t}消息复用{/t}</a>&nbsp;|&nbsp;
										<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg='{t name="{$val.title}"}您确定要删除[ %1 ]这条消息吗？{/t}' href='{url path="push/admin/remove" args="message_id={$val.message_id}"}' title="{t}删除{/t}">{t}删除{/t}</a>
								</div>
							</td>
							<td>{$val.content}</td>
							<td>
							{if $val.in_status == 1}
								推送完成<br>
								该消息已经被推送了<font class="ecjiafc-red">{$val.push_count}</font>次<br>
								推送于：{$val.push_time}
							{else}
								推送失败
							{/if}
							</td>
							<td>{$val.add_time}</td>
						</tr>
						<!--  {foreachelse} -->
					<tr><td class="no-records" colspan="10">{$lang.no_records}</td></tr>
					<!-- {/foreach} -->
				</tbody>
			</table>
			<!-- {$listdb.page} -->
		</form>
	</div>
</div> 
<!-- {/block} -->