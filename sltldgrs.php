<?php 
public function actionSelectLedgers(){
	$master_model = FinanceMasterSettings::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	if($master_model->step_completed <=3){
		/**/
	}
}

?>