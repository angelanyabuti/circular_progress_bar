<?php
/**
 * Created by PhpStorm.
 * User: muturi muraya <muturi.muraya@gmail.com>
 * Date: 07/08/2021
 * Time: 12:51 AM
 * Project kouponzetu
 */

namespace App\Traits;

use App\Configs\Configs;
use Illuminate\Support\Facades\Auth;

trait RedirectTo
{
    public function RedirectUserTo($role_id){

        switch ($role_id) {
            case Configs::ADMIN_ROLE_TYPE:
                return 'dashboard';
            case Configs::MERCHANT_ROLE_TYPE:
                return 'merchant/dashboard';
            case Configs::CUSTOMER_ROLE_TYPE:
                return 'customer/dashboard';
        }

    }
}
