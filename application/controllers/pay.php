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
	 * 计算订单总价,生成订单
	 */
	public function figureUp() {
		$this->permission->login_check();
		$pids = $this->input->get('pids');
		$amount = 0;
		write_log($pids, 'pay', 'pay');

		$user = $this->base->get_data('account', array('id'=>$this->uid), 'parent_id, id')->row_array();

		$lists = $this->db->query('SELECT price_base,id,sku,price_type FROM ab_product WHERE id IN('.$pids.')')->result_array();
		$invoice_id = getId('invoice_id');

		foreach($lists as $v) {
			$invoice_item[] = array(
				'id'				=> getId('invoice_item_id'),
				'site_id'			=> 1,
				'date_orig'			=> $this->timestamp,
				'parent_id'			=> $user['parent_id'],
				'account_id'		=> $this->uid,
				'invoice_id'		=> $invoice_id,
				'product_id'		=> $v['id'],
				'sku'				=> $v['sku'],
				'quantity'			=> 1,
				'total_amt'			=> $v['price_base'],
				'item_type'			=> 0,
				'price_type'		=> $v['price_type'],
				'price_base'		=> $v['price_base'],
				'recurring_schedule'=> 1,
			);
			$amount += $v['price_base'];
		}

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

		write_log(debug($invoice_data, 0, 1), 'pay', 'pay');
		$this->base->insert_data('invoice', $invoice_data);
		if($invoice_item) {
			$this->db->insert_batch('ab_invoice_item', $invoice_item);
			write_log(debug($invoice_item, 0, 1), 'pay', 'pay');
		}
		output(0, array('invoid_id'=>$invoice_id, 'amount'=>$amount));
	}

	/**
	 * 支付成功
	 */
	public function billover() {
		$option = $this->input->post('option');
		if($option == 54 || $option == 56) {
			$invoid_id = $this->input->post('invoid_id');
			/**
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
			 */
			//if(count($receiptResponse) == 0) {
			if(false) {
				output(3004, 'empty app receipt');
			} else {
				$updata_array = array(
					'date_last'			=> $this->timestamp,
					'due_date'			=> $this->timestamp,
					'process_status'	=> 1,
					'billing_status'	=> 1,
					//'billed_amt'		=> $receiptResponse['product_id'] == 'com.childroad.pay.1month' ? 1.99 : 0,
					'billed_amt'		=> 1.99,
					'checkout_plugin_id'=> $option,
				);
				$this->base->update_data('invoice', $updata_array, array('id'=>$invoid_id));

				$invoice = $this->base->get_data('invoice', array('id'=>$invoid_id), 'parent_id,account_id,date_orig')->row_array();
				$items = $this->base->get_data('invoice_item', array('invoice_id'=>$invoid_id))->result_array();

				foreach($items as $v) {
					$prod = $this->base->get_data('product', array('id'=>$v['product_id']), 'taxable,price_recurr_type,price_recurr_weekday,price_recurr_week,price_recurr_schedule,price_recurr_cancel,price_recurr_modify,assoc_grant_group,assoc_grant_group_type,assoc_grant_group_days')->row_array();
					if($v['price_type'] == 2) {
						$bind = 1;
					} else if($v['price_type'] == 1) {
						$bind = 1;
					} else if($v['price_type'] == 0) {
						$bind = 0;
					} else {

					}

					//开通服务数据
					$ser_data[] = array(
						'id'					=> getId('service_id'),
						'site_id'				=> 1,
						'date_orig'				=> $this->timestamp,
						'parent_id'				=> $v['parent_id'],
						'invoice_id'			=> $v['invoice_id'],
						'invoice_item_id'		=> $v['id'],
						'account_id'			=> $v['account_id'],
						'account_billing_id'	=> $invoice['account_id'],
						'product_id'			=> $v['product_id'],
						'sku'					=> $v['sku'],
						'active'				=> 1,
						'bind'					=> $bind,
						'type'					=> 'group',		//item_type好像都为0
						'queue'					=> 'none',
						'price'					=> $v['price_base'],
						'price_type'			=> $v['price_type'],
						'taxable'				=> $prod['taxable'],
						'date_last_invoice'		=> $invoice['date_orig'],
						'date_next_invoice'		=> '', //待定
						'recur_schedule'		=> $v['recurring_schedule'],
						'recur_type'			=> $prod['price_recurr_type'],
						'recur_weekday' 		=> $prod['price_recurr_weekday'],
						'recur_week'			=> $prod['price_recurr_week'],
						'recur_schedule_change' => $prod['price_recurr_schedule'],
						'recur_cancel'			=> $prod['price_recurr_cancel'],
						'recur_modify' 			=> $prod['price_recurr_modify'],
						'group_grant'			=> $prod['assoc_grant_group'],
						'group_type' 			=> $prod['assoc_grant_group_type'],
						'group_days'			=> $prod['assoc_grant_group_days'],
						'checkdata'				=> $receipt,
					);

					//用户阅读权限组
					if ($prod['assoc_grant_group_type'] == 0) {
						$expire = $this->timestamp + (86400*$prod['assoc_grant_group_days']);
					} else {
						$expire = 0;
					}
					$group_ids = unserialize($prod['assoc_grant_group']);
					foreach($group_ids as $group_id) {
						$group_data[] = array(
							'id'			=> getId('account_group_id'),
							'site_id'		=> 1,
							'date_orig'		=> $this->timestamp,
							'date_start'	=> $this->timestamp,
							'date_expire'	=> $expire,
							'group_id'		=> $group_id,
						);
					}

				}

				if($ser_data) {
					$this->db->insert_batch('ab_service', $ser_data);
					$this->db->insert_batch('ab_account_group', $group_data);
					write_log(debug($ser_data, 0, 1), 'pay', 'pay');
				}
				//output(0, $receiptResponse);
				output(0, 'ok');
			}
		}
	}
}