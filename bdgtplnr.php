<?php
public function actionPlanner($id=''){
	/*default budget*/
	$this->createDefaultBudget();
	/* some budget is set*/
	if($id){
		/*query the set budget*/

	}else{
		/*budget is not set*/
		/*query for default budget*/
	}
	/*list of budgets with id and name for select drop down*/
	/*budget configuration
	 *set the period,actuals	
	*/
	/*post data*/
	/*is ledger or group*/
	/*no post data */
	/*render the default page*/
	echo CJSON::encode(array('status'=>'success','data'=>$this->renderPartial('planner',array('form_data'=>$form_data))));
	exit;

}
/* default budget*/

?>