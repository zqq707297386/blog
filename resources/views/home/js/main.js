$(function() {
	'use strict';
	var sidebar = $('#sidebar')
		var mask = $('.mask')
		var backButton = $('#back-to-top')
		var sidebar_trigger = $('#sidebar_trigger')

		//左侧边栏显示与隐藏
		function showSideBar() {
			mask.fadeIn()
			sidebar.css('left', 0)
		}

		function hideSideBar() {
			mask.fadeOut()
			sidebar.css('left', -sidebar.width())
		}

		sidebar_trigger.on('click',showSideBar)

		mask.on('click',hideSideBar)


		//右侧边栏
		var maskright = $('.maskright')
		var sidebarright = $('#sidebarright')
		var sidebar_right = $('#sidebar_right')
		
		function showright() {
			maskright.fadeIn()
			sidebarright.css('right', 0)
		}
		function hideright() {
			maskright.fadeOut()
			sidebarright.css('right', -sidebarright.width())
		}
		sidebar_right.on('click',showright)
		maskright.on('click',hideright)

		
        //回到顶部 
		backButton.on('click',function () {
			$('html, body').animate({
				scrollTop:0
			},500)
		})

		// 判断是否高出屏幕长度。不是就不显示回到顶部
		$(window).on('scroll',function () {
			if ($(window).scrollTop()>$(window).height()) {
				backButton.fadeIn()
			}else{
				backButton.fadeOut()
			}
})
			$(window).trigger('scroll')

			//下拉滚动
			var more = $('.more')
			function down() {
				var m = $(window).scrollTop()
				$('body,html').animate({'scrollTop':m+$(window).height()},500)
			}
			more.on('click',down)

			
})
		