<?php
function random($length = 8)
{
    return substr(bin2hex(random_bytes($length)), 0, $length);
}
