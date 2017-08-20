/*onclick goback to account settings page
 *display the div 	
*/
function goback(){
	$("#sldr_select_ledger").fadeOut(2204,function(){
		$("#onselect-ledger").show("slide",{direction:"left"});
		$("#tab-3").trigger("click");
	});
}
function gobackToLedger(){
	$("#sldr_setopeningbalacnce").fadeOut(2204,function(){
		$("sldr_select_ledger").show("slide",{direction:"left"});
	});
}
