<?php 
/*action for rendering settings page*/
public function actionSettings(){
	/*common code goes here*/
	$tab = isset($_GET['tab'])?$_GET['tab']:'';
	switch($tab){
		case 'general_info':$general_info = $this->general_info();
								$renderedPage = $this->renderPartial('_general_info',$general_info,true);
								echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
								exit;												    
								break;
		case 'contact_info': $contact_info = $this->contact_info();
								$renderedPage = $this->renderPartial('_contact_info',$contact_info,true);
								echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
								break;
		case 'account_settings':$account_settings = $this->account_settings();
								$renderedPage = $this->renderPartial('_account_settings',$account_settings,true);
								echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
								break;
		default:$general_info =  $this->general_info();
								$renderedPage = $this->renderPartial('_general_info',$general_info,true);
								echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
								exit;									
								break;
	}

}
public function general_info(){
	$model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	$old_model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	$industries = RcfIndustryType::model()->findAll();
	$industries = CHtml::listData($industries,'id','name');
	/*data required for rendering general info*/
	return array('model'=>$model,'industries'=>$industries);
}
public function contact_info(){

}
public function account_settings(){

}

?>