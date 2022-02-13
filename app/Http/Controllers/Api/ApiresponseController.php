<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiresponseController extends Controller
{
    public static function apiresponse($code = 1, $message = "success", $content = null)
    {
        if($code == 1){
            $status = 200;
        }elseif($code == 2){
            $status = 999;
        }elseif($code == 3){
            $status = 400;
        }else{
            $status = 404;
        }
        if(is_array($content) && count($content) == 0){
          $content = [];
        }
        else{
          if($content == null){
            $content = (object)[];
          }
        }
        $interResponse = array(
            'code' => $status,
            'message' => $message,
            'data' => $content
        );
        $response = new Response($interResponse);
        return $response;
    }

    public static function mergeWithKey(array $array) {
      foreach($array as $key => $value) {
        if (is_array($value)) {
          $array[$key] = ApiresponseController::mergeWithKey($value);
        }else{
          if($value === null){
            $array[$key] = "";
          }
        }
      }
      return $array;
    }

}
