<?php  
class ControllerModuleNewsletter extends Controller {
	public function index() {
		$this->language->load('module/newsletter');
		
    	$data['heading_title'] = $this->language->get('heading_title');
    	$data['entry_name'] = $this->language->get('entry_name');
    	$data['entry_email'] = $this->language->get('entry_email');
    	$data['button_submit'] = $this->language->get('button_submit');
    	$data['text_success'] = $this->language->get('text_success');
    	$data['error_email'] = $this->language->get('error_email');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/newsletter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/newsletter.tpl', $data);
		} else {
			return $this->load->view('default/template/module/newsletter.tpl', $data);
		}

	}
	public function save() {
		//load model
		$this->load->model('module/newsletter');
		//save data
		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			echo false;
		}else{
			$insert=$this->model_module_newsletter->save($_REQUEST['name'],$_REQUEST['email']);
			//echo $this->language->get('success');
			echo $insert;
		}
	}
}
?>