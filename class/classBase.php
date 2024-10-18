<?php


/**
 * Description of classBase
 *
 * @author andreych
 */
class classBase
{
    public function getConnect()
    {
        $db = new mysqli('localhost', 'componentsd', 'JsCyZabq]gJg3!BF', 'components');
        if (!$db) {
            return false;
        }
        return $db;
    }
}
