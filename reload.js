/*function initializing the variables */
var config = function(requestedUrl,custom=''){
	var doReload = false;
	var type = 'post';
	var data='';
	var default = {url:requestedUrl,type:type,dataType:'json',data:data};

}
/*common code*/

var reloadPages = function (requestedUrl){
	
	createAjaxRequest(default,options);

}
/*create ajax request function*/
function createAjaxRequest(ajaxSettings,options){
	$.ajax({
		url:ajaxSettings.url,
		type:ajaxSettings.type,
		data:ajaxSettings.data,
		dataType:ajaxSettings.dataType,
		success:function(response){
			options.callback(response);
		}
	});
}
function errorMessage(){

}
function goback(){
	if(doReload){
		/*reload the page*/
	}
}