<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 支付
 * @version 1.0.0 12-10-22 下午9:31
 * @author 张浩
 */
class Test extends CI_Controller {

	private $timestamp;
	private $uid;

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
		$this->timestamp = time();
		$this->uid = $this->session->userdata('uid');
		$mode = 0;
		$this->host = $mode == 0 ? 'sandbox.itunes.apple.com' : 'buy.itunes.apple.com';
	}

	public function index() {
		$receipt = '{
	"signature" = "AgAgwmLsiEz9+h9CQld3jpHo45gYejrpWHcVjrST/F+IH6S8JrEGJqyaQS5rRCsxL5w+0E3Y8b7lr5NXN3O9/q2WgTIaQLDMms3T7sa5OdsdG9oGMEoYTkTWYOlNvEnrNe/NerfHa9nbdioVwgYPploDvDd1QVM3ThvaUtc6MFGaAAADVzCCA1MwggI7oAMCAQICCGUUkU3ZWAS1MA0GCSqGSIb3DQEBBQUAMH8xCzAJBgNVBAYTAlVTMRMwEQYDVQQKDApBcHBsZSBJbmMuMSYwJAYDVQQLDB1BcHBsZSBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTEzMDEGA1UEAwwqQXBwbGUgaVR1bmVzIFN0b3JlIENlcnRpZmljYXRpb24gQXV0aG9yaXR5MB4XDTA5MDYxNTIyMDU1NloXDTE0MDYxNDIyMDU1NlowZDEjMCEGA1UEAwwaUHVyY2hhc2VSZWNlaXB0Q2VydGlmaWNhdGUxGzAZBgNVBAsMEkFwcGxlIGlUdW5lcyBTdG9yZTETMBEGA1UECgwKQXBwbGUgSW5jLjELMAkGA1UEBhMCVVMwgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMrRjF2ct4IrSdiTChaI0g8pwv/cmHs8p/RwV/rt/91XKVhNl4XIBimKjQQNfgHsDs6yju++DrKJE7uKsphMddKYfFE5rGXsAdBEjBwRIxexTevx3HLEFGAt1moKx509dhxtiIdDgJv2YaVs49B0uJvNdy6SMqNNLHsDLzDS9oZHAgMBAAGjcjBwMAwGA1UdEwEB/wQCMAAwHwYDVR0jBBgwFoAUNh3o4p2C0gEYtTJrDtdDC5FYQzowDgYDVR0PAQH/BAQDAgeAMB0GA1UdDgQWBBSpg4PyGUjFPhJXCBTMzaN+mV8k9TAQBgoqhkiG92NkBgUBBAIFADANBgkqhkiG9w0BAQUFAAOCAQEAEaSbPjtmN4C/IB3QEpK32RxacCDXdVXAeVReS5FaZxc+t88pQP93BiAxvdW/3eTSMGY5FbeAYL3etqP5gm8wrFojX0ikyVRStQ+/AQ0KEjtqB07kLs9QUe8czR8UGfdM1EumV/UgvDd4NwNYxLQMg4WTQfgkQQVy8GXZwVHgbE/UC6Y7053pGXBk51NPM3woxhd3gSRLvXj+loHsStcTEqe9pBDpmG5+sk4tw+GK3GMeEN5/+e1QT9np/Kl1nj+aBw7C0xsy0bFnaAd1cSS6xdory/CUvM6gtKsmnOOdqTesbp0bs8sn6Wqs0C9dgcxRHuOMZ2tm8npLUm7argOSzQ==";
	"purchase-info" = "ewoJIm9yaWdpbmFsLXB1cmNoYXNlLWRhdGUtcHN0IiA9ICIyMDEyLTEwLTMxIDA4OjQ1OjI5IEFtZXJpY2EvTG9zX0FuZ2VsZXMiOwoJInB1cmNoYXNlLWRhdGUtbXMiID0gIjEzNTY0MTU0NjIwMDAiOwoJInVuaXF1ZS1pZGVudGlmaWVyIiA9ICIwMDAwYjAyMTg5ZjgiOwoJIm9yaWdpbmFsLXRyYW5zYWN0aW9uLWlkIiA9ICIxMDAwMDAwMDU3OTAxOTExIjsKCSJleHBpcmVzLWRhdGUiID0gIjEzNTY0MTU3NjIwMDAiOwoJInRyYW5zYWN0aW9uLWlkIiA9ICIxMDAwMDAwMDYwOTE1MjYyIjsKCSJvcmlnaW5hbC1wdXJjaGFzZS1kYXRlLW1zIiA9ICIxMzUxNjk4MzI5MDAwIjsKCSJ3ZWItb3JkZXItbGluZS1pdGVtLWlkIiA9ICIxMDAwMDAwMDI2NTAyNDc2IjsKCSJidnJzIiA9ICIxLjAuNCI7CgkiZXhwaXJlcy1kYXRlLWZvcm1hdHRlZC1wc3QiID0gIjIwMTItMTItMjQgMjI6MDk6MjIgQW1lcmljYS9Mb3NfQW5nZWxlcyI7CgkiaXRlbS1pZCIgPSAiNDgwMTY3MDI0IjsKCSJleHBpcmVzLWRhdGUtZm9ybWF0dGVkIiA9ICIyMDEyLTEyLTI1IDA2OjA5OjIyIEV0Yy9HTVQiOwoJInByb2R1Y3QtaWQiID0gImNvbS5jaGlsZHJvYWQucGF5LjFtb250aCI7CgkicHVyY2hhc2UtZGF0ZSIgPSAiMjAxMi0xMi0yNSAwNjowNDoyMiBFdGMvR01UIjsKCSJvcmlnaW5hbC1wdXJjaGFzZS1kYXRlIiA9ICIyMDEyLTEwLTMxIDE1OjQ1OjI5IEV0Yy9HTVQiOwoJImJpZCIgPSAiY29tLmNoaWxkcm9hZC5pcGFkIjsKCSJwdXJjaGFzZS1kYXRlLXBzdCIgPSAiMjAxMi0xMi0yNCAyMjowNDoyMiBBbWVyaWNhL0xvc19BbmdlbGVzIjsKCSJxdWFudGl0eSIgPSAiMSI7Cn0=";
	"environment" = "Sandbox";
	"pod" = "100";
	"signing-status" = "0";
}';
		$password = "4482fa472b8143bd8c2783afd1b4f0ff";
		$receipt = base64_encode($receipt);
		$receipt_data = array('receipt-data' => $receipt, "password" => $password);
        if (!$receipt_resp = $this->HttpPost($receipt_data)) {
            $ret['status'] = 0;
            $ret['msg'] = 'App Store validation failed: ' . $this->errmsg;
        } else {
            $ret['status'] = 1;
            $ret['receipt'] = $receipt_resp;
        }
		
		debug($ret);
	}
	
    function HttpPost($receipt) {
    
        $API_Endpoint = "https://$this->host/verifyReceipt";
        $encodedData = json_encode($receipt);
        // Set the curl parameters.
        $ch = curl_init();
		$methodName_ = '';
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Get response from the server.
        $httpResponse = curl_exec($ch);
        
        if(!$httpResponse) {
            $this->errmsg = "$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')';
            return false;
        }

        curl_close($ch);

        // Extract the response details.
        $httpResponseAr = json_decode($httpResponse, true);

        if (count($httpResponseAr) == 0) {
            $this->errmsg = "Invalid HTTP Response for POST request to $API_Endpoint.";
            return false;
        }
        
        if ($httpResponseAr['status'] != 0) {
            $this->errmsg = "$methodName_ failed: invalid app receipt, status: " . $httpResponseAr['status'];
            return false;
        }

        $receiptResponse = $httpResponseAr['receipt'];

        if (count($receiptResponse) == 0) {
            $this->errmsg = "$methodName_ failed: empty app receipt";
            return false;
        }

        return $receiptResponse;
    }	
}