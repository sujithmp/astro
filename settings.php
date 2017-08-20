<?php

public function actionStepSettings(){
	$tab = isset($_GET['tab'])?$_GET['tab']:'';
	if(!$tab){
		$model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
		if($model->step_completed < 1){
			
			$tab = 'general_info';
		}

	}
	/*switch case for filtering the selected tab*/
}
?>