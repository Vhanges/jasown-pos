<?php

function getAction($action){
    
    if (isset($_GET[$action])) {
        
        $getData = trim($_GET[$action]);
        $getData = htmlspecialchars($_GET[$action]);
        $getData = stripslashes($_GET[$action]);

        return $getData;

        
    }else{

        return "";

    }


}

