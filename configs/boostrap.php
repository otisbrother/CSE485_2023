<?php
define("APP_ROOT", dirname(__DIR__, 2));

require APP_ROOT . '/config/functions.php';              
require APP_ROOT . '/config/config.php';                

if (DEV === false) {
    set_exception_handler('handle_exception');           
    set_error_handler('handle_error');                  
    register_shutdown_function('handle_shutdown');       
}
?>