<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnMsg($status, $info, $data = array(), $extra_data = array())
    {
        $items           = array();
        $items['status'] = $status;
        $items['info']   = $info;
        if (!empty($data)) {
            $items['data'] = $data;
        }
        if (!empty($extra_data)) {
            $items['extra_data'] = $extra_data;
        }
        return json_encode($items);
    }

    protected function formatValidationErrors(Validator $validator)
    {
        $message = $validator->errors()->first();
        return ['message' => $message, 'status_code' => 500];
    }
}
