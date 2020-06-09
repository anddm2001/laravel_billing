<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Repository\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    protected $error = [1 => "Error send data"];

    public function index(Request $request){

        if(!empty($request->get('interval')) && $request->get('interval') == "sec")
            $interval = "1 second";
        elseif(!empty($request->get('interval')) && $request->get('interval') == "min")
            $interval = "1 minute";
        elseif(!empty($request->get('interval')) && $request->get('interval') == "hour")
            $interval = "1 hour";
        elseif(!empty($request->get('interval')) && $request->get('interval') == "day")
            $interval = "1 day";
        elseif(!empty($request->get('interval')) && $request->get('interval') == "week")
            $interval = "1 week";
        elseif(!empty($request->get('interval')) && $request->get('interval') == "month")
            $interval = "1 month";
        else
            $interval = "3 hour";

        $usersOnline = UserRepository::getUserOnline($interval);

        if($usersOnline)
            return response()->json(["status" => "success", "users_online" => $usersOnline, "interval" => $interval], 200);
        else
            return response()->json(["status" => "error", "error" => $this->error[1]], 500);
    }
}
