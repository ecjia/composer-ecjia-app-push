// JavaScript Document

;(function(app, $) {
	app.push_config = {
		init : function() {
			
		}
	};
	
	app.push_config_edit = {
			init : function() {
				app.push_config_edit.check_balance();
				app.push_config_edit.submit_form();
				app.push_config_edit.add_app_push();
				app.push_config_edit.del_app_push();
			},
			
			submit_form : function(formobj) {
				var $form = $("form[name='theForm']");
				var option = {
					rules : {
						app_name : { required : true }
					},
					messages : {
						app_name : { required : "请填写应用名称！" }
					},
					submitHandler : function() {
						$form.ajaxSubmit({
							dataType : "json",
							success : function(data) {
								ecjia.admin.showmessage(data);
							}
						});
						
					}
				}
				var options = $.extend(ecjia.admin.defaultOptions.validate, option);
				$form.validate(options);
			},
			
			check_balance : function(){
				$('.check').on('click', function() {
					var checkURL = $('.checkaction').attr('data-url');
					$.get(checkURL,function(data) {
						app.sms_config_edit.load_balance_opt(data);
					}, "JSON");
				})
			},
			
			load_balance_opt : function(data) {
				var html = data.content;
				$('.balance').html(html);
			},
			
			add_app_push : function() {
				$('.select_app_type li')
				.on('click', function() {
					var $this = $(this),
						tmpobj = $( '<li class="ms-elem-selection"><input type="hidden" name="app_id[]" value="' + $this.attr('data-id') + '" />' + $this.text() + '<span class="edit-list"><i class="fontello-icon-minus-circled ecjiafc-red del"></i></span></li>' );
					if (!$this.hasClass('disabled')) {
						tmpobj.appendTo( $( ".ms-selection .nav-list-content" ) );
						$this.addClass('disabled');
					}
					//给新元素添加点击事件
					tmpobj.on('dblclick', function() {
						$this.removeClass('disabled');
						tmpobj.remove();
					})
					.find('i.del').on('click', function() {
						tmpobj.trigger('dblclick');
					});
				});
			},
			del_app_push : function() {
				$('.ms-elem-selection').each(function(index){
					var $this = $(this);
					$('.nav-list-ready li').each(function(i){
						if ($( ".nav-list-ready li" ).eq(i).attr('id') == 'appId_' + $this.find('input').val()) {
							$( ".nav-list-ready li" ).eq(i).addClass('disabled');
						}
					});
				}); 
				
				//给右侧元素添加点击事件
				$('.nav-list-content .ms-elem-selection').on('dblclick', function() {
					var $this = $(this);
					$( ".nav-list-ready li" ).each(function(index) {
						if ($( ".nav-list-ready li" ).eq(index).attr('id') == 'appId_' + $this.find('input').val()) {
							$( ".nav-list-ready li" ).eq(index).removeClass('disabled');
						}
					});
					$this.remove();
				})
				.find('i.del').on('click', function() {
					$(this).parents('li').trigger('dblclick');
				});
			},
			
			
		};
	
})(ecjia.admin, jQuery);

// end