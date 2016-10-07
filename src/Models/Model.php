<?php

namespace NFWP\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use NFWP\Database\DBManager;

class Model extends EloquentModel
{
    public function __construct()
    {
        $manager = DBManager::getInstance();
        $manager->bootEloquent();
    }
}
