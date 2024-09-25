<?php 
class Validation
{
public function sanitize($input)
{
    return trim(htmlspecialchars($input));
}
public function check_empty($input)
{
    if(empty($input))
    {
        return true;
    }
    return false;
}
public function minlen($input,$len)
{
    if(strlen($input)<$len)
    {
        return true;
    }
    return false;
}
public function maxlen($input,$len)
{
    if(strlen($input)>$len)
    {
        return true;
    }
    return false;
}
public function number($input)
{
    return !is_numeric($input);
}
}