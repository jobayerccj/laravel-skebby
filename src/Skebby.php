<?php
namespace jobayerccj\Skebby;
class Skebby
{	
	protected $_url = 'https://gateway.skebby.it/api/send/smseasy/advanced/http.php';
    protected $_username;
    protected $_password;
    
    protected $_recipients = array();
    protected $_sender = 'Jobayer';
    protected $_method = 'send_sms_basic';
    protected $_text = 'SMS sending from laravel';
    
	/*
     * Set skebby account's username
     * (string)
     */
    public function set_username($string) {
        $this->_username = $string;
    }
	
	/*
     * Set skebby account's password
     * (string)
     */
    public function set_password($string) {
        $this->_password = $string;
    }
	
	/*
     * Set recipients phone number
     * array('+391234567890','+391234567891') recipients list with country code
     */
    public function set_recipients($array) {
        $this->_recipients = $array;
    }
    
    /*
     * set text for your SMS 
     * (string) 
     */
    public function set_text($string) {
        $this->_text = $string;
    }
    
    /* 
     * set sending method
     * (string) classic, classic_plus, basic
     */
    public function set_method($method) {
        $this->_method = $method;
    }
    
    /*
     * Set Sender information
     * (string) 
     */
    public function set_sender($string) {
        $this->_sender = $string;
    }
    
    /*
     * Send SMS
     */
    public function send_sms() {
        return $this->call_skebby_4_sending_sms();
    }
	
    /*
     * get available credit information
    */
    public function get_credit_info() {
       
        $parameters = array(
            'method' => 'get_credit',
            'username' => $this->_username,
            'password' => $this->_password,
            'charset' => 'UTF-8'
        );
        parse_str($this->call_skebby(http_build_query($parameters)), $ret);
        return $ret;
    }
	
	/*
     * this method will prepare data & call skebby api for sending sms
    */
    protected function call_skebby_4_sending_sms() {
        $parameters = array(
            'method' => $this->_method,
            'username' => $this->_username,
            'password' => $this->_password,
            'text' => $this->_text,
            'recipients[]' => implode('&recipients[]=', $this->_recipients),
            'charset' => 'UTF-8'
        );
        
		if(!is_int($this->_sender)) {
            $parameters['sender_string'] = $this->_sender;
        } else {
            $parameters['sender_number'] = $this->_sender;
        }
        
        parse_str($this->call_skebby(http_build_query($parameters)), $ret);
        return $ret;
    }
	
	/*
     * this method will initiate CURL & execute code for sending sms
    */
    protected function call_skebby($data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Jobayer');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}