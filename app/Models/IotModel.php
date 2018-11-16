<?php

namespace App\Models;

require_once(base_path().'/app/Libs/Iot/aliyun-php-sdk-core/Config.php');
use Illuminate\Database\Eloquent\Model;
use \Iot\Request\V20180120 as Iot;

class IotModel extends Model
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

	//产品管理API

	/**
     * 创建产品。
     * @param $pageSize
     * @param $currentPage
     */
    public function createProduct($pageSize,$currentPage)
    {

        $request = new Iot\CreateProductRequest();
        //必须
        $request->setProductName($currentPage);//设置产品名
        $request->setNodeType($currentPage);
        $request->setAliyunCommodityCode($pageSize);
        $request->setDataFormat($pageSize);
        $request->setCategoryId($currentPage);
        $request->setDescription($pageSize);
        $request->setProtocolType($currentPage);
        $request->setId2($pageSize);
        
        $response = $this->client->getAcsResponse($request);
        $response =  json_decode( json_encode( $response),true);
        dump($response);
    }

	/**
     * 查看当前账号下所有的IoT产品列表。
     * @param $pageSize
     * @param $currentPage
     */
    public function queryProductList($pageSize,$currentPage,$CommodityCode = '')
    {

        $request = new Iot\QueryProductListRequest();
        $request->setPageSize($pageSize);   // 每页显示的记录数量
        $request->setCurrentPage($currentPage); // 返回结果中的第几页开始显示
        if(!empty($CommodityCode)){
        	//指定要查看的产品类型:1、iothub_senior：物联网平台高级版   iothub：物联网平台基础版
        	//非必须参数   不传入该参数，则返回所有产品的列表
        	$request->setAliyunCommodityCode($CommodityCode);
        }
        $response = $this->client->getAcsResponse($request);
        $response =  json_decode( json_encode( $response),true);
        return $response;
    }

}
