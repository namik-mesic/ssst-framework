<?php

namespace System\Database\MySQL;

use mysqli_result;

/**
 * Class ObjectAdapter
 * @package System\Database\MySQL
 */
class ObjectAdapter
{
    /**
     * Transforms a mysqli result set into an array of objects
     *
     * @param mysqli_result $result
     * @return Object[]
     */
    public function adapt(mysqli_result $result)
    {
        $data = [];

        while ($row = $result->fetch_assoc())
            $data[] = (object) $row;

        return $data;
    }
}