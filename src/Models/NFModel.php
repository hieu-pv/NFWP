<?php

namespace NFWP\Models;

use Illuminate\Database\Eloquent\Model;
use NFWP\Database\DBManager;

class NFModel extends Model
{
    public function __construct()
    {
        $manager = DBManager::getInstance();
        $manager->bootEloquent();
    }
}
