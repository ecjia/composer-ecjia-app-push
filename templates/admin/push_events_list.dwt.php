<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.push_event.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a class="data-pjax btn plus_or_reply" id="sticky_a" href="{$action_link.href}"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
		<a class="all_close plus_or_reply" data-msg='{t domain="push"}您确定要关闭全部推送消息事件吗？{/t}' data-href='{url path="push/admin_events/all_close"}'><button class="btn" type="button">{t domain="push"}全部关闭{/t}</button></a>     
	    <a class="all_open plus_or_reply"  data-msg='{t domain="push"}您确定要开启全部推送消息事件吗？{/t}' data-href='{url path="push/admin_events/all_open"}'><button class="btn btn-gebo" type="button">{t domain="push"}全部开启{/t}</button></a>     
	</h3>
</div>

<div class="row-fluid search_page">
	<div class="span12">
        <table class="table table-striped smpl_tbl dataTable table-hide-edit" id="plugin-table">
            <thead>
            <tr>
                <th class="w50">{t domain="push"}编号{/t}</th>
                <th class="w300">{t domain="push"}事件代号{/t}</th>
                <th>{t domain="push"}事件名称{/t}</th>
                <th>{t domain="push"}事件描述{/t}</th>
                <th>{t domain="push"}事件状态{/t}</th>
                <th>{t domain="push"}操作{/t}</th>
            </tr>
            </thead>
            <tbody>
            <!-- {foreach from=$data key=key item=list name=data} -->
            <tr>
                <td>{$smarty.foreach.data.index+1}</td>
                <td>{$list.code}</td>
                <td>{$list.name}</td>
                <td>{$list.description}</td>
                <td>{if $list.status eq 'open'}<span class="label label-info">{t domain="push"}开启中{/t}</span>{else}<span class="label">{t domain="push"}已关闭{/t}</span>{/if}</td>
                <td>
                    <a class="change_status" style="cursor: pointer;"  data-msg='{if $list.status eq 'open'}{t domain="mail"}您确定要关闭该推送事件吗？{/t}{else}{t domain="push"}您确定要开启该推送事件吗？{/t}{/if}' data-href='{if $list.status eq "open"}{url path="push/admin_events/close" args="code={$list.code}&id={$list.id}"}{else}{url path="push/admin_events/open" args="code={$list.code}&id={$list.id}"}{/if}' >
                    {if $list.status eq 'open'}
                    <button class="btn btn-mini btn-success" type="button">{t domain="push"}点击关闭{/t}</button>
                    {else}
                    <button class="btn btn-mini" type="button">{t domain="push"}点击开启{/t}</button>
                    {/if}
                    </a>
                </td>
            </tr>
            <!-- {foreachelse} -->
            <tr><td class="no-records" colspan="5">{t domain="push"}没有找到任何记录{/t}</td></tr>
            <!-- {/foreach} -->
            </tbody>
        </table>
	</div>
</div>
<!-- {/block} -->