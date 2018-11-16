<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IotModel;
use App\Models\ProductModel;
use App\Services\ProductService;
class IotController extends Controller
{

    private $IotModel;

    function __construct(){
        $this->IotModel = new IotModel();
        $this->ProductModel = new ProductModel();
    }

    public function index(){
        echo 'aaa';
    }

    public function iot(){

        $pageSize = '50';
        $currentPage = '1';
        $this->IotModel->queryProductList($pageSize,$currentPage);
        echo time();
        echo "<br/>";
        echo $aa = '1542165362000.0';
        echo date('Y-m-d',$aa/1000);
    }

    public function productlist(){

        $pageSize = '50';
        $currentPage = '1';
        $result = $this->IotModel->queryProductList($pageSize,$currentPage);
        if($result['Success']){
            if(empty($result['Data']['List']['ProductInfo'])){
                echo '暂无产品';
            }else{
                app(ProductService::class)->productCreateOrUpdate($result['Data']['List']['ProductInfo']);
            }
        }else{
            echo '失败';
        }
    }

}
