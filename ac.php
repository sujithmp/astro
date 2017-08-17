
/*stepsettingspage*/
/*common design*/
/*document ready*/
<script type="text/javascript">
	
	$(document).ready(function(){
		/*hide the slides by default*/
		defaultHideSlide();
		/*onlick handlers for form submission*/
		$(document).on("click",'#contact_info_submit',function(){
			var settings = handlerConfig();
		});
		$(document).on("click",'#general_info_submit',function(){
				var settings = handlerConfig();
		});
		$(document).on("click",'#account_settings_submit',function(){
				var settings = handlerConfig();
		});

	});
	function handlerConfig(actingElement){
		/*settings*/
		
			var actingElement = $(this);
			var tabName = actingElement.data('tabname');
			var url = actingElement.data('url');
			var defaultAjaxRequest='post';
			var defaultData = '';
			var slideTo = actingElement.data('slideto');
			var aimOfRequest =  actingElement.data('aim');
			var formClass = actingElement.data('formclass');
			var currentActiveElement = findCurrentActive(); 
			var settings = {
				actingElement:actingElement,
				tabName:tabName,
				url:url,
				defaultAjaxRequest:defaultAjaxRequest,
				defaultData:defaultData,
				slideTo:slideto,
				aimOfRequest:aimOfRequest,
				formClass:formclass,
				currentActiveElement:currentActiveElement
			};
			return settings;
	}
	function defaultHideSlide(){
		$('#firtslider','#secondslider').hide();
	}
</script>