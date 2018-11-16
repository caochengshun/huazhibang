<?php

namespace App\Services;

use DB;

use App\Models\ProductModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Input;

class ProductService 
{
    

    public function productCreateOrUpdate($param){
        // DB::beginTransaction();
        // DB::rollBack();
        // DB::commit();
        if(empty($param)){
            return false;
        }else{
            foreach ($param as $key => $value) {
                dump($value);
                $ProductKey = $value['ProductKey'];
                unset($value['ProductKey']);
                dump($value);
                // $result = ProductModel::where(['ProductKey' => $value['ProductKey']])->get();
                // if(empty($result->toArray())){
                //     $id = ProductModel::insert($value);
                // }else{
                //     $id = $result[0]->save($value);
                // }
            }
        }
        $date = ProductModel::get()->toArray();
        dump($date);
    }
}