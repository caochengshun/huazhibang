<?php

namespace App\Http\Controllers;

require_once(base_path().'/app/Libs/Iot/aliyun-php-sdk-core/Config.php');
use Illuminate\Http\Request;
use \Iot\Request\V20180120 as Iot;
class IotController extends Controller
{

	private $accessKeyId;
	private $accessSecret;
	private $client;

	function __construct(){
		$this->accessKeyId = env('ACCESSKEYID');
		$this->accessSecret = env('ACCESSKEYSECRET');
		$iClientProfile = \DefaultProfile::getProfile("cn-shanghai", $this->accessKeyId, $this->accessSecret);
		$this->client = new \DefaultAcsClient($iClientProfile);
	}

    public function index(){
    	echo 'aaa';
    }

    public function iot(){

    	$pageSize = '50';
    	$currentPage = '1';
		$this->queryDeviceByNameTest($pageSize,$currentPage);
    }

    /**
     * 根据devicename查询所有产品列表。
     * @param $pageSize
     * @param $currentPage
     */
    public function queryDeviceByNameTest($pageSize,$currentPage)
    {
        $request = new Iot\QueryProductListRequest();
        $request->setPageSize($pageSize);
        $request->setCurrentPage($currentPage);
        $response = $this->client->getAcsResponse($request);
        print_r($response);
    }
}
