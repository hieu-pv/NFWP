<?php

namespace NFWP\Models;

class BaseModel
{
    public function first($collection)
    {
        if (!is_array($collection)) {
            throw new Exception("the param is not an array", 0);
        } else {
            if (count($collection) == 0) {
                throw new Exception("the array is empty", 0);
            } else {
                $keys = key($collection);
                return $collection[$key[0]];
            }
        }
    }
}
