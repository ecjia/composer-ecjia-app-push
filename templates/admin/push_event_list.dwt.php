<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->

<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}"  id="sticky_a"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>
<div class="row-fluid list-page">
	<div class="span12">
		<div class="tab-content">
			<!-- system start -->
			<div class="tab-pane active">
				<table class="table table-striped table-hide-edit" data-rowlink="a">
					<thead>
						<tr>
							<th class="w200">{t domain="push"}事件名称{/t}</th>
							<th>{t domain="push"}Code{/t}</th>
							<th>{t domain="push"}应用名称{/t}</th>
							<th class="w100">{t domain="push"}创建时间{/t}</th>
						</tr>
					</thead>
					<!-- {foreach from=$push_event item=item key=key name=children} -->
					<tr>
						<td c>
							{$item.event_name}
						</td>
						<td class="hide-edit-area">
							{$item.event_code}
							<div class="edit-list">
								<a class="data-pjax" href="{RC_Uri::url('push/admin_event/edit',"code={$item.event_code}")}" title='{t domain="push"}编辑{/t}'>{t domain="push"}编辑{/t}</a>&nbsp;|&nbsp;
								<a data-toggle="ajaxremove" class="ajaxremove ecjiafc-red" data-msg='{t domain="push"}您确定要删除该消息事件吗？{/t}' href="{RC_Uri::url('push/admin_event/remove',"code={$item.event_code}")}" title='{t domain="push"}移除{/t}'>{t domain="push"}删除{/t}</a>
						    </div>
						</td>
						<td>
							<!-- {foreach from=$item.appname item=items } -->
							{$items}<br/>
							<!-- {/foreach} -->
						</td>
						<td>
							{$item.create_time}
						</td>
					</tr>
					<!-- {foreachelse} -->
					   <tr><td class="no-records" colspan="7">{t domain="push"}没有找到任何记录{/t}</td></tr>
					<!-- {/foreach} -->
				</table>
			</div>
			<!-- system end -->
		</div>
	</div>
</div>
{$mobile_manage_page}
<!-- {/block} -->