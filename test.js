/*handle event*/
$(document).ready(function(){
	var checkStatus = function(response,callbackFunctions){
		if(response.status=='success'){
			callbackFunctions[1](response);
		}else{
			callbackFunctions[2](response);
		}
	}
	var successFunction = function(response){

	}
	var errorFunction = function(response){

	}
	$(document).on('click','.budget-modal-btn',function(){
		var object = $(this);
		var formObject = $('.formClass');
		var settings = setUpForAjax(object);
		var data = createFormData(formObject);
		var callbackFunctions = [checkStatus,successFunction,errorFunction];
		createAjaxrequest(settings.url,'post',data,callbackFunctions);
	});

});
function getObject(elementIdentity){
	return $(elementIdentity);
}
function checkStatus(response){
	if(response.status=='success'){
		return true;
	}else
		return false;
}
function setUpForAjax(object){
	var url = object.data('url');
	var outerElement = object.data('html');
	var settings = [url,outerElement];
	return settings;
}
function createFormData(formObject){
	/*usually formdata*/
	var data = formObject.serializeArray();
	return data;
}
function createAjaxrequest(url,type,data,callbackFunctions){

$.ajax({
	url:url,
	type:type,
	data:data,
	dataType:'json',
	success:function(response){
		var status = callbackFunctions[0](response,callbackFunctions);
	},
	error:function(){

	}
});

}
/*ajaxrequest*/
/*message*/
/*remove messages and remove*/