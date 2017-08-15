<?php 
/*general info form is submitted with tabname set*/
/*to same action actionSettings*/
/*tab is set */
/*set for general_info switch case
 *check is post data set 
 *pass the post data along with general_info function call 	
 *not set tab then default switch case 
 *	
*/
/*action for rendering settings page*/
public function actionSettings(){
	/*common code goes here*/
	$tab = isset($_GET['tab'])?$_GET['tab']:'';
	switch($tab){
		case 'general_info':	/*check is post data set*/
								if(isset($_POST['MasterSettingsStep1'])){
									$postData = $_POST;
									$contact_info = $this->general_info($postData);
									if($contact_info['status']=='error'){
										/*render error summary*/
										$renderError = $this->renderPartial('_error_summary',$contact_info,true);
										echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderError));
										exit;
									}
									$renderedPage = $this->renderPartial('_contact_info',$contact_info,true);
									echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
									exit;
								}else{
									$general_info = $this->general_info();
									$renderedPage = $this->renderPartial('_general_info',$general_info,true);
									echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
									exit;		
								}										    
								break;

		case 'contact_info': 	if(isset($_GET['id'])){
									$id = $_GET['id'];
								}else{
									$general_info =  $this->general_info();
									$renderedPage = $this->renderPartial('_general_info',$general_info,true);
									echo CJSON::encode(array('status'=>'success',
																  'data'=>$renderedPage));
									exit;									
								}
								/*check is post data set */
								if(isset($_POST['MasterSettingsStep2'])){
									
									$postData = $_POST;
									$account_settings = $this->contact_info($id,$postData);
									if($account_settings['status']=='error'){
										/*render error summary*/
										$renderError = $this->renderPartial('_error_summary',$account_settings,true);
										echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderError));
										exit;
									}
									$renderedPage = $this->renderPartial('_account_settings',$account_settings,true);
									echo CJSON::encode(array('status'=>'success','data'=>$renderedPage));
									exit;
								}else{
									$contact_info = $this->contact_info($id);
									$renderedPage = $this->renderPartial('_contact_info',$contact_info,true);
									echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
									exit;
								}
								break;
		case 'account_settings':if(isset($_GET['id'])){
									$id = $_GET['id'];
								}else{
									$general_info =  $this->general_info();
									$renderedPage = $this->renderPartial('_general_info',$general_info,true);
									echo CJSON::encode(array('status'=>'success',
																  'data'=>$renderedPage));
									exit;									
								}
								/*check is post data set */
								if(isset($_POST['MasterSettingsStep3'])){
									
									$postData = $_POST;
									$account_settings = $this->account_settings($id,$postData);
									if($account_settings['status']=='error'){
										/*render error summary*/
										$renderError = $this->renderPartial('_error_summary',$account_settings,true);
										echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderError));
										exit;
									}
									$renderedPage = $this->renderPartial('_account_settings',$account_settings,true);
									echo CJSON::encode(array('status'=>'success','data'=>$renderedPage));
									exit;
								}else{
									$account_settings = $this->account_settings();
									$renderedPage = $this->renderPartial('_account_settings',$account_settings,true);
									echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
									exit;
								}
								
								break;
		default:$general_info =  $this->general_info();
								$renderedPage = $this->renderPartial('_general_info',$general_info,true);
								echo CJSON::encode(array('status'=>'success',
														  'data'=>$renderedPage));
								exit;									
								break;
	}

}
public function general_info($postData=Array()){
	$model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	$old_model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	$industries = RcfIndustryType::model()->findAll();
	$industries = CHtml::listData($industries,'id','name');
	if(isset($postData['MasterSettingsStep1'])){
		if($model->step_completed < 1){
			$model->step_completed = 1; 
		}
		$model->attributes = $postData['MasterSettingsStep1'];
		if($model->save()){
			$details = json_encode($old_model->attributes);
			Setup::insert_activity_log("MasterSettingsStep1","general_info",$model->id,'',$details);
			/*render the second tab*/
			/*set the contact info render data 
			 *call contact_info function with $id 
			 *$id is the only argument
			 * returns the render data details	
			*/
			$renderData = $this->contact_info($model->id);
			/*returns the renderdata array details to switch case back*/
			return  $renderData;

		}else{
			/*failed to save 
			 *some errors are there
			 *show error message
			 *return the array of error messages to render	
			*/
			return array('status'=>'error','msg'=>'failed to update','errors'=>$model->getErrors());
		}
	}
	return array('model'=>$model,'industries'=>$industries);
}
public function contact_info($id,$postData=array()){
	/*contact_info render page code*/
	/*post data set code */
	if(isset($postData['MasterSettingsStep2'])){
		$model->attributes = $postData['MasterSettingsStep2'];
		if($model->save()){
			$details = json_encode($old_model->attributes);
			Setup::insert_activity_log("MasterSettingsStep2","contact_info",$model->id,'',$details);
			/*render the second tab*/
			/*set the contact info render data 
			 *call contact_info function with $id 
			 *$id is the only argument
			 * returns the render data details	
			*/
			$renderData = $this->account_settings($model->id);
			/*returns the renderdata array details to switch case back*/
			return  $renderData;

		}	
	}
	/*post data not set */
	/* return render data array*/

}
public function account_settings($id,$postData=array()){
	/*account_settings render page code*/
	/*post data set code */
	if(isset($postData['MasterSettingsStep3'])){
		$model->attributes = $postData['MasterSettingsStep3'];
		if($model->save()){
			$details = json_encode($old_model->attributes);
			Setup::insert_activity_log("MasterSettingsStep3","account_settings",$model->id,'',$details);
			/*render the second tab*/
			/*set the contact info render data 
			 *call contact_info function with $id 
			 *$id is the only argument
			 * returns the render data details	
			*/
			$renderData = $this->account_settings($model->id);
			/*returns the renderdata array details to switch case back*/
			return  $renderData;

		}	
	}
	/*post data not set */
	/* return render data array*/
}
public function actionPostGeneralInfo(){
	$model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	$old_model = MasterSettingsStep1::model()->findByAttributes(array('company_id'=>Setup::get_user_company_id()));
	$industries = RcfIndustryType::model()->findAll();
	$industries = CHtml::listData($industries,'id','name');
	/*isset post code here*/
	if(isset($_POST['MasterSettingsStep1'])){
		if($model->step_completed < 1){
			$model->step_completed = 1; 
		}
		$model->attributes = $_POST['MasterSettingsStep1'];
		if($model->save()){
			$details = json_encode($old_model->attributes);
			Setup::insert_activity_log("MasterSettingsStep1","general_info",$model->id,'',$details);
			/*render the second tab*/

		}
	}
}
?>