<?php

class RoistatSubmitAdmin {
    private $pluginName;
    private $version;

    public function __construct($pluginName, $version) {
        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    private function test() {}

	private function test1() {}

	private function test3() {}

	private function test2() {}

	private function frommaster() {}

    public function onRoistatSubmit($data) {
        $submission = WPCF7_Submission::get_instance();
        $emailData = $submission->get_posted_data();

        if($data->id == 4471) { //Заявка на лечение (горизонтальная)
            $comment = empty($emailData['horizontal-comment']) ? '' : $emailData['horizontal-comment'];
            $name = empty($emailData['horizontal-fio']) ? '' : $emailData['horizontal-fio'];
            $email = empty($emailData['horizontal-email']) ? '' : $emailData['horizontal-email'];
            $phone = empty($emailData['horizontal-phone']) ? '' : $emailData['horizontal-phone'];
        } else { // остальные формы
            $comment = empty($emailData['comment']) ? '' : $emailData['comment'];
            $name = empty($emailData['fio']) ? '' : $emailData['fio'];
            $email = empty($emailData['email']) ? '' : $emailData['email'];
            $phone = empty($emailData['phone']) ? '' : $emailData['phone'];
        }


        $roistatData = ['roistat' => !empty($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie', 'key' => 'MjE3MTQ0OjE1MjA5MTo4M2M5YzEyNzdlOTY1NjE2NTliMzMzNTA1YjE4NjcxNw==', 'title' => $data->title, // Название сделки
            'comment' => $comment,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'order_creation_method' => 'LeadForm', // Способ создания сделки (необязательный параметр). Укажите то значение, которое затем должно отображаться в аналитике в группировке "Способ создания заявки"
            'is_need_callback' => '0', // После создания в Roistat заявки, Roistat инициирует обратный звонок на номер клиента, если значение параметра равно 1 и в Ловце лидов включен индикатор обратного звонка.
            'callback_phone' => $phone, // Переопределяет номер, указанный в настройках обратного звонка.
            'sync' => '0', 'is_need_check_order_in_processing' => '1', // Включение проверки заявок на дубли
            'is_need_check_order_in_processing_append' => '1', // Если создана дублирующая заявка, в нее будет добавлен комментарий об этом
            'is_skip_sending' => '0', // Не отправлять заявку в CRM.
            'is_need_send_proxylead' => '1',
            'fields' => []];

        file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
    }
}