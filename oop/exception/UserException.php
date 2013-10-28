<?php

class UserException
{
    function validateEamail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else{
            throw new Exception("<div class='exception'><b>Error: Please enter a valid e-mail</b></div>");
        }
    }
    function compare($var1, $var2, $name1,$name2){
        if($var1 != $var2){
            throw new Exception("<div class='exception'><b>$name1 must match $name2 </b></div>");
        }
        else{
            return true;
        }
    }
    function null_int_string($var,$name)
    {
        $bool = false;
        
        $strlen = strlen($var);
        
        for($i = 0; $i < $strlen; $i++)
        {
            if(filter_var($va[$i], FILTER_VALIDATE_INT))
            {
                $bool = true;

                $i = $strlen;
            }
        }
        if(!$bool)
        {
            throw new Exception("<div class='exception'><b>$name Error:</b> $name must contain a number</div>");
        }
        else
        {
            return $bool;
        }
        
    }
    function char_in_string($var,$name)
    {
        $bool = true;
        
        $strlen = strlen($var);

        $char = array("~","`","!","@","#","$","%","^","&","*","(",")","_","-","+",
                      "=","{","}","[","]","|","'\'",";",":","'",",",'"',"<",">",",",".","?","/");
        
        for($i = 0; $i < $strlen; $i++)
        {
            if(in_array($var[$i], $char))
            {
                $bool = false;

                $i  = $strlen;
            }
        }
        if(!$bool)
        {
            throw new Exception("<div class='exception'><b>$name Error:</b> $name must not contain special charcters</div>");
        }
        else
        {
            return $bool;
        }
        
    }
    function space_in_string($var,$name)
    {
        $bool = true;
        
        $words = explode(" ", $var);
        
        if(sizeof($words) > 1 && $bool == true)
        {
            $bool = false; 
        }
        if($bool == false)
        {
            throw new Exception("<div class='exception'><b>$name Error:</b> $name must not contain spaces</div>");
        }
        else
        {
            return $bool;
        }
    }
    function invalid_string_input($var,$name)
    {
        $bool = true;

        for($i = 0; $i < strlen($var); $i++)
        {
            if(filter_var($var[$i], FILTER_VALIDATE_FLOAT) && $bool == true)
            {
                $bool = false; 
            }
        }
        if($bool == false)
        {
            throw new Exception("<div class='exception'><b>$name must contain letters only</b></div>");
        }
        else
        {
            $this->space_in_string($var, $name);

            return $bool;
        }
    }
    function invalid_int_input_exception($var,$name)
    {
        if(!filter_var($var, FILTER_VALIDATE_FLOAT))
        {
             throw new Exception("<div class='exception'><b>$name Error:</b> $name must be numeric</div>");
        }
        else
        {
            return true;
        }
    }
    function invalid_input_length_exception($var,$name,$length,$type)
    {
        $int = strlen($var);

        if($length != $int)
        {
            throw new Exception("<div class='exception'><b>$name must be $length $type long</b></div>");
        }
        else
        {
            return true;
        }
    }
    function invalid_input_range_exception($var,$name,$num1,$num2,$type)
    {
        $length = strlen($var);

        if($length < $num1 || $length > $num2)
        {
            throw new Exception("<div class='exception'><b>$name must be $num1 to $num2 $type long</b></div>");
        }
        else
        {
            return true;
        }   
    }
    function required_inputs_exception($inputs){
        $i = 0;
        foreach ($inputs as $input){
            if(!filter_var($input)){
                $i++;
            }
        }
        if($i > 0){
            throw new Exception("<div class='exception'><b>Please enter all required form fields!</div>");
        }
        else{
            return true;
        }
    }
}
?>
