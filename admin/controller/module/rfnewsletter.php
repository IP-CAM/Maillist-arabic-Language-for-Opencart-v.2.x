<?php
class ControllerModuleRfnewsletter extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/rfnewsletter');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('rfnewsletter', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_data'] = $this->language->get('button_data');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/rfnewsletter/data', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('module/rfnewsletter', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['data'] = $this->url->link('module/rfnewsletter/data', 'token=' . $this->session->data['token'], 'SSL');
				
		$data['modules'] = array();
		
		if (isset($this->request->post['rfnewsletter_module'])) {
			$data['modules'] = $this->request->post['rfnewsletter_module'];
		} elseif ($this->config->get('rfnewsletter_module')) { 
			$data['modules'] = $this->config->get('rfnewsletter_module');
		}		
		
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
				
		$this->response->setOutput($this->load->view('module/rfnewsletter.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/rfnewsletter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	public function install() {
		$this->load->model('module/rfnewsletter');
		$this->model_module_rfnewsletter->createTable();
	}
	public function delete() {
		$this->load->language('module/rfnewsletter');
	
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('module/rfnewsletter');
		
    	if (isset($this->request->post['selected']) && $this->validate()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_module_rfnewsletter->deleteData($id);
			}
			      		
			$this->session->data['success'] = $this->language->get('text_success');

   		}
		$this->response->redirect($this->url->link('module/rfnewsletter/data', 'token=' . $this->session->data['token'], 'SSL'));
	
  	}
	public function data() {   
		$this->load->language('module/rfnewsletter');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_time'] = $this->language->get('entry_time');
		
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_send'] = $this->language->get('button_send');
		$data['button_data'] = $this->language->get('button_data');
		$data['button_add_module'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_export'] = $this->language->get('button_export');
		

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('button_data'),
			'href'      => $this->url->link('module/rfnewsletter/data', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		$data['export'] = $this->url->link('module/rfnewsletter/export', 'token=' . $this->session->data['token'], 'SSL');
		$data['send'] = $this->url->link('module/rfnewsletter/send', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/rfnewsletter/delete', 'token=' . $this->session->data['token'], 'SSL');

		$this->load->model('module/rfnewsletter');
		$data['data'] = $this->model_module_rfnewsletter->getData();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
				
		$this->response->setOutput($this->load->view('module/rfnewsletter_data.tpl', $data));
	}

	public function export() {
		$this->load->model('module/rfnewsletter');
		$data = $this->model_module_rfnewsletter->getData();
		foreach ($data as $user) {
			echo($user['name']) .',';
			echo($user['email']) .',';
			echo  ';';
		}	
		
		header("Pragma: public");
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Content-Type: application/force-download");
	    header("Content-Type: application/octet-stream");
	    header("Content-Type: application/download");
	    header("Content-Disposition: attachment;filename=export.csv");
	    header("Content-Transfer-Encoding: binary");
	}

	public function send() {
		$this->load->language('module/rfnewsletter');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->language('marketing/contact');
		$data['entry_subject'] = $this->language->get('entry_subject');
		$data['entry_message'] = $this->language->get('entry_message');
		
		$data['button_send'] = $this->language->get('button_send');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['token'] = $this->session->data['token'];
		$data['cancel'] = $this->url->link('module/rfnewsletter/data', 'token=' . $this->session->data['token'], 'SSL');

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/rfnewsletter/data', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$json = array();
			if (!$this->user->hasPermission('modify', 'module/rfnewsletter')) {
				$json['error']['warning'] = $this->language->get('error_permission');
			}
					
			if (!$this->request->post['subject']) {
				$json['error']['subject'] = $this->language->get('error_subject');
			}
	
			if (!$this->request->post['message']) {
				$json['error']['message'] = $this->language->get('error_message');
			}
			
			if (!$json) {
				$this->load->model('setting/store');
				$store_name = $this->config->get('config_name');
								
				$email_total = 0;
							
				$emails = array();

				$this->load->model('module/rfnewsletter');
				$results = $this->model_module_rfnewsletter->getData();
				foreach ($results as $result) {
					$emails[$result['id']] = $result['email'];
					$email_total++;
				}
				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else {
					$page = 1;
				}
				if ($emails) {
					$start = ($page - 1) * 10;
					$end = $start + 10;
					
					if ($end < $email_total) {
						$json['success'] = sprintf($this->language->get('text_sent'), $start, $email_total);
					} else { 
						$json['success'] = $this->language->get('text_success');
					}				
						
					if ($end < $email_total) {
						//$json['next'] = str_replace('&amp;', '&', $this->url->link('sale/contact/send', 'token=' . $this->session->data['token'] . '&page=' . ($page + 1), 'SSL'));
					} else {
						//$json['next'] = '';
					}
					$json['success'] = $this->language->get('text_success');
										
					$message  = '<html dir="ltr" lang="en">' . "\n";
					$message .= '  <head>' . "\n";
					$message .= '    <title>' . $this->request->post['subject'] . '</title>' . "\n";
					$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
					$message .= '  </head>' . "\n";
					$message .= '  <body>' . html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
					$message .= '</html>' . "\n";
					
					foreach ($emails as $email) {
						$mail = new Mail();	
						$mail->protocol = $this->config->get('config_mail_protocol');
						$mail->parameter = $this->config->get('config_mail_parameter');
						$mail->hostname = $this->config->get('config_smtp_host');
						$mail->username = $this->config->get('config_smtp_username');
						$mail->password = $this->config->get('config_smtp_password');
						$mail->port = $this->config->get('config_smtp_port');
						$mail->timeout = $this->config->get('config_smtp_timeout');				
						$mail->setTo($email);
						$mail->setFrom($this->config->get('config_email'));
						$mail->setSender($store_name);
						$mail->setSubject(html_entity_decode($this->request->post['subject'], ENT_QUOTES, 'UTF-8'));					
						$mail->setHtml($message);
						$mail->send();
					}
				}
			}
			echo(json_encode($json));
			// $this->response->setOutput(json_encode($json));
			exit;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
				
		$this->response->setOutput($this->load->view('module/rfnewsletter_send.tpl', $data));
	}
}
?>