<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */
namespace adapters;

class Feedback extends Main
{
	protected $action;

	function __construct( \Config $config, $template ) {
		parent::__construct( $config, $template );
		$this->type = 'feedback';
	}

	public function show($block, $i, $view, &$params)
	{
		$this->type = $block['type'];
		$this->id = $block['alias'];
		$this->title = $block['name'];
		$this->input = json_decode($block['input'], true);
		$this->action = 'index.php?task=send_mail&adapter=feedback';
		$this->loadTpl();
	}

	public function send_mail(){
		$input = new \Input();
		$name = $input->getString('name', '');
		$phone = $input->getString('phone', '');
		$email = $input->getString('email', '');
		$company = $input->getString('company', '');
		$message = $input->getString('message', '');
		$id = $input->getString('id', '');

		$json = array('error' => 1, 'message' => '');

		if(empty($id)){
			$json['message'] = 'Внутренняя ошибка';
			echo json_encode($json);
			return;
		}

		$data = $this->getData();


		if(!isset($data["blocks"][$id]) || $data["blocks"][$id]['type'] != 'feedback'){
			$json['message'] = 'Внутренняя ошибка';
			echo json_encode($json);
			return;
		}

		$blockData = $data["blocks"][$id]["input"];
		$html = '';

		if(!empty($name) ){
			$html .= "Имя: $name<br />";
		}
		else if($blockData['required_name']){
			$json['message'] = 'Введите ваше имя';
			echo json_encode($json);
			return;
		}

		if(!empty($phone)){
			$html .= "Телефон: $phone<br />";
		}
		else if($blockData['required_phone']){
			$json['message'] = 'Введите ваш телефон';
			echo json_encode($json);
			return;
		}

		if(!empty($email)){
			$html .= "Email: $email<br />";
		}
		else if($blockData['required_email']){
			$json['message'] = 'Введите ваш Email';
			echo json_encode($json);
			return;
		}

		if(!empty($company)){
			$html .= "Компания: $company<br />";
		}
		else if($blockData['required_company']){
			$json['message'] = 'Введите компанию';
			echo json_encode($json);
			return;
		}

		if(!empty($message)){
			$html .= "Сообщение: $message<br />";

		}
		else if($blockData['required_message']){
			$json['message'] = 'Введите ваш вопрос';
			echo json_encode($json);
			return;
		}

		$toMail = $blockData['email'];
		if(!filter_var($toMail, FILTER_VALIDATE_EMAIL)){
			$json['message'] = 'Ошибка отправки письма '.$toMail;
			echo json_encode($json);
			return;
		}

		$fromEmail = $this->config->get('site_email');

		$mail = new \Mail($fromEmail); // Создаём экземпляр класса
		$mail->setFromName("Your site"); // Устанавливаем имя в обратном адресе
		if ($mail->send($toMail, "Вопрос с сайта", $html)){
			$json['message'] = 'Письмо отправлено';
			$json['error'] = 0;
			echo json_encode($json);
			return;
		}
		else{
			$json['message'] = 'Письмо не отправлено';
			echo json_encode($json);
			return;
		}

	}
}