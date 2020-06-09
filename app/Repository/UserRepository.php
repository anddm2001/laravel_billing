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
                SELECT COUNT(*)
                FROM metrics t1
                WHERE t1.`status` = 1
                AND created_at >= DATE_SUB(NOW(), INTERVAL $interval)
                UNION ALL
                SELECT COUNT(*)
                FROM metrics t1
                WHERE t1.`status` = 2
                AND created_at >= DATE_SUB(NOW(), INTERVAL $interval);");

        $billingStmt->execute();
        $usersOnline = $billingStmt->fetchAll((\PDO::FETCH_ASSOC));

        return response($usersOnline);
    }
}
