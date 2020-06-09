<?php

namespace App\Repository;

use DB;

class UserRepository{

    /**
     * @return mixed
     * Возвращаем кол-во активных юзеров за заданный интервал времени.
     */

    public static function getUserOnline($interval){

        $PDO = DB::connection('mysql')->getPdo();

        $billingStmt = $PDO->prepare("
                SELECT COUNT(*) AS status_one
                FROM metrics t1
                WHERE t1.`status` = 1
                AND created_at >= DATE_SUB(NOW(), INTERVAL $interval)
                UNION ALL
                SELECT COUNT(*) AS status_two
                FROM metrics t1
                WHERE t1.`status` = 2
                AND created_at >= DATE_SUB(NOW(), INTERVAL $interval);");

        $billingStmt->execute();
        $usersOnline = $billingStmt->fetchAll((\PDO::FETCH_ASSOC));

        if($usersOnline)
            $res_array = ["Users Online" => $usersOnline[0]["status_one"] - $usersOnline[1]["status_one"]];
        else
            $res_array = ["Error" => "Request error."];

        return response($res_array);
    }
}
