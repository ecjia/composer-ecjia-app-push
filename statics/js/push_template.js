// JavaScript Document

;(function(app, $) {
	app.push_template_list = {
		init : function() {
			app.push_template_list.data_table();
		},

		data_table : function() {
			$('#plugin-table').dataTable({
				"sDom": "<'row page'<'span6'<'dt_actions'>l><'span6'f>r>t<'row page pagination'<'span6'i><'span6'p>>",
				"sPaginationType": "bootstrap",
				"iDisplayLength": 15,
				"aLengthMenu": [15, 25, 50, 100],
				"aaSorting": [[ 2, "asc" ]],
				"oLanguage" : {
					"oPaginate": {
						"sFirst" : '首页',
						"sLast" : '尾页',
						"sPrevious" : '上一页',
						"sNext" : '下一页',
					},
					"sInfo" : "共_TOTAL_条记录 第_START_ 到 第_END_条",
				},
				"aoColumns": [
					{ "sType": "string" },
					{ "bSortable": false },
					{ "bSortable": false }
				],
				"fnInitComplete": function(){
					$("select").not(".noselect").chosen({
						add_class: "down-menu-language",
						no_results_text: "未找到搜索内容!",
						allow_single_deselect: true,
						disable_search_threshold: 8
					})
				},
			});
		},

	};
	app.push_template_info = {
		init : function() {
			app.push_template_info.change_editor();
			app.push_template_info.submit_info();
			app.push_template_info.validate_mail();
		},

		change_editor : function() {
			$('[data-toggle="change_editor"]').on('click', function() {
				url = $(this).attr('data-url');
				ecjia.pjax(url);
			});
		},

		submit_info : function() {
			$('[name="theForm"]').on('submit', function(e) {
				e.preventDefault();
				var type = $('input[name="mail_type"]:checked').val();
				if(type == 1) {
//					var textinfo = tinyMCE.get('content').getContent();
//					$('#content').css({'display' : 'block', 'height' : '0px', 'padding' : '0px', 'opacity' : 0}).val(textinfo);
				}
			})
		},

		validate_mail : function() {
			var option = {
				rules:{
					template_code : { required : true },
					subject : { required : true },
					content : { required : true }
				},
				messages:{
					template_code : { required : "消息模板名称不能为空!" },
					subject : { required : "消息主题不能为空!" },
					content : { required : "消息内容不能为空！" }
				},
				submitHandler:function(){
					$("form[name='theForm']").ajaxSubmit({
						dataType : "json",
						success : function(data) {
							ecjia.admin.showmessage(data);
						}
					});
				}
			}
			var options = $.extend(ecjia.admin.defaultOptions.validate, option);
			$("form[name='theForm']").validate(options);
		},
	};

})(ecjia.admin, jQuery);

// end