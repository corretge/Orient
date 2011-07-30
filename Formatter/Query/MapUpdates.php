<?php

/*
 * This file is part of the Orient package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class MapUpdates
 *
 * @package     Orient
 * @subpackage  Formatter
 * @author      Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace Orient\Formatter\Query;

use Orient\Formatter\Query;
use Orient\Formatter\String;
use Orient\Contract\Formatter\Query\Token as TokenFormatter;

class MapUpdates extends Query implements TokenFormatter
{
    public static function format(array $values)
    {
        $updates = array();
      
        foreach ($values as $map => $update) {
            $map = String::filterNonSQLChars($map);
            
            if ($map && is_array($update)) {
                foreach ($update as $key => $rid) {
                  $rid = String::filterRid($rid);
                  $key = String::filterNonSQLChars($key);
                }
              
                $updates[$map] = "$map = '$key', $rid";
            }
        }

        return count($updates) ? self::implode($updates) : NULL;
    }
}