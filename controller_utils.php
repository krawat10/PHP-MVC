<?php

function &get_cart()
 {
     if (!isset($_SESSION['user_id'])) {
         $_SESSION['user_id'] = []; //pusty koszyk
     }

     return $_SESSION['user_id'];
 }
