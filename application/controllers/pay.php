<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 支付
 * @version 1.0.0 12-10-22 下午9:31
 * @author 张浩
 */
class Pay extends CI_Controller {

	private $timestamp;
	private $uid;

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
		$this->timestamp = time();
		$this->uid = $this->session->userdata('uid');
	}

	/**
	 * @deprecated 计算订单总价,生成订单
	 */
	public function figureUp() {
		$this->permission->login_check();
		$pids = $this->input->get('pids');
		$amount = 0;
		write_log($pids, 'pay', 'pay');

		$lists = $this->db->query('SELECT price_base FROM ab_product WHERE id IN('.$pids.')')->result_array();
		foreach($lists as $v) {
			$amount += $v['price_base'];
		}
		$invoice_id = getId('invoice_id');
		$invoice_data = array(
			'id'				=> $invoice_id,
			'site_id'			=> 1,
			'date_orig'			=> $this->timestamp,
			'type'				=> 0,
			'process_status'	=> 0,
			'billing_status'	=> 0,
			'refund_status'		=> 0,
			'suspend_billing'	=> 0,
			'print_status'		=> 0,
			'account_id'		=> $this->uid,
			'account_billing_id'=> 0,
			'total_amt'			=> $amount,
			'ip'				=> $this->input->ip_address(),
		);
		$this->base->insert_data('invoice', $invoice_data);
		output(0, array('invoid_id'=>$invoice_id, 'amount'=>$amount));
	}

	public function billover() {
		$option = $this->input->post('option');
		if($option == 54 || $option == 56) {
			$invoid_id = $this->input->post('invoid_id');
			$mode = $this->input->post('mode');
			$receipt = $this->input->post('receipt');
			$host = $mode == 0 ? 'sandbox.itunes.apple.com' : 'buy.itunes.apple.com';
			$password = "4482fa472b8143bd8c2783afd1b4f0ff";
			$API_Endpoint = "https://".$host."/verifyReceipt";
			$encodedData = json_encode(array('receipt-data' => base64_encode($receipt), "password" => $password));

			write_log("app_store checkout ($API_Endpoint)__".$encodedData, 'pay', 'pay');

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
			$httpResponse = curl_exec($ch);
			curl_close($ch);
			if(!$httpResponse) {
				write_log("app_store receiptcheck failed".curl_error($ch).'('.curl_errno($ch).')', 'pay', 'pay');
				output(3000, 'app_store receiptcheck failed');
			}

			$httpResponseAr = json_decode($httpResponse, true);
			write_log("app_store response".print_r($httpResponseAr, true), 'pay', 'pay');

			if(count($httpResponseAr) == 0) {
				output(3001, 'receipt响应无效');
				write_log("receipt响应无效", 'pay', 'pay');
			}

			if($httpResponseAr['status'] == 21006) {
				output(3002, 'receipt过期');
			} elseif($httpResponseAr['status'] != 0) {
				output(3003, 'receipt验证失败');
			}

			$receiptResponse = $httpResponseAr['receipt'];
			if(count($receiptResponse) == 0) {
				output(3004, 'empty app receipt');
			} else {
				$updata_array = array(
					'date_last'			=> $this->timestamp,
					'due_date'			=> $this->timestamp,
					'process_status'	=> 1,
					'billing_status'	=> 1,
					'billed_amt'		=> $receiptResponse['product_id'] == 'com.childroad.pay.1month' ? 1.99 : 0,
					'checkout_plugin_id'=> $option,
				);
				$this->base->update_data('invoice', $updata_array, array('id'=>$invoid_id));

				output(0, $receiptResponse);
			}
		}
	}
}