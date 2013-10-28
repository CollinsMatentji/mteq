<?php

class DBMan
{
    function send_query($query)
    {
        $this->db_select();

        $result = mysql_query($query);
        
        if(!$result)
        {
            echo "Could not submitt query";
            exit;
        }
        
        return $result;
        
    }
    private function db_select()
    {
        $conn = $this->db_conn();
        
        $db = mysql_select_db('mteq', $conn);
        
        if(!$db)
        {
           echo 'Could not enter Diary database';
           exit;
        }
        
    }
    private function db_conn()
    {
        $conn = mysql_connect('localhost','root', '');

        if(!$conn)
        {
           echo 'Could not connect to Diary database';
           exit;
        }

        return $conn;
    }
}
?>
