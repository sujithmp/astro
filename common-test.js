/*event handler*/

$(document).ready(function(){
	/*by default hide the second and third slider*/
	$("#sldr_contact_info,#sldr_account_settings").hide();
	/*function reference*/
	var showFirstSlider = function(response,hideElement){
		$("#sldr_general_info").html(response.data);
		$("sldr_"+hideElement.data('tabname')).fadeOut('2204',function(){
			$("#sldr_general_info").show("slide",{direction:"left"},400);
		});
	}
	var showSecondSlider = function(response,hideElement){
		$("#centralized_contact_info").html(response.data);
		$("sldr_"+hideElement.data('tabname')).fadeOut('2204',function(){
			$("#sldr_contact_info").show("slide",{direction:"left"},400);
		});
	}
	var showThirdSlider = function(response,hideElement){
		$("#centralized_account_settings").html(response.data);
		$("sldr_"+hideElement.data('tabname')).fadeOut('2204',function(){
			$("#sldr_account_settings").show("slide",{direction:"left"},400);
		});
	}
	/*catch the tab click event */
	$(document).on("click",".tab-step",function(){
		var actingElement = $(this);
		var defaultAjaxRequest = 'post';
		var defaultData = '';
		var tabName = actingElement.data('tabname');
		var aimOfRequest = actingElement.data('aim');
		var classNameToBeUsed = actingElement.data('classname');
		var url  = actingElement.data('url');
		var isActiveElement  = actingElement.hasClass('active');
		var currentActiveElement  = findCurrentActive();
		/* active element is not current element*/
		if(url!="#" && !isActiveElement){
			/*create ajax call*/
			if(aimOfRequest!=''){
				switch(aimOfRequest){
					case "form_submission": var formObject =  $("#"+actingElement.data('formclass'));
											var data = formObject.serializeArray();
											break;
					case "render_page_only":var data =({'tab':tabName});
											if(tabName=='general_info')
												var option = {callback:showFirstSlider,active:currentActiveElement};
											else if(tabName=='contact_info')
												var option = [{'callback':showSecondSlider,'active':currentActiveElement}];
												//var option = showSecondSlider;
											else 
												var option = [{'callback':showThirdSlider,'active':currentActiveElement}];
												//var option = showThirdSlider;
											break;
					default:var data = ({'tab':tabName});

				}

			}
			
			createAjaxRequest(url,type,data=defaultData,option);
		}
	});
	
});
function createAjaxRequest(url,type='get',data,option=''){
		$.ajax({
			url:url,
			type:type,
			dataType:"json",
			data:data,
			beforeSend:function(){

			},
			success:function(response){
				option.callback(response,option.active);
			},
			error:function(){

			}
		});
}
function findCurrentActive(){
	var classNameToBeUsed = '.tab-step';
	var allTabs = $(classNameToBeUsed);
	var activeTab = '';
	$.each(allTabs,function(i,tab){
		if($(tab).hasClass('active')){
			activeTab = $(tab);	
		}
	});
	return activeTab;
}