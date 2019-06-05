<?php
$baseUrl = base_url();
define("LOGIN", "<a class='g-signout2' href='{$baseUrl}' ><i class='fas fa-sign-in-alt'></i>登入</a>");
define("LOGOUT", '<a class="g-signout2" href="#" onclick="signOut();"><i class="fas fa-sign-out-alt"></i>登出</a>');

define('touristURL', array(
    "onboard/touristJoin"
));

define('userURL', array(
    "onboard",
    "showLearn",
));

define('manageURL', array(
    "onboardAdmin",
    "deptCategoryManage/deptRoute",
    "onboardAdmin/userRoute",
    "manageLearn",
));

define('adminURL', array(
    "deptManage",
    "userManage"
));

define('icon', array(
    "onboard" => "fas fa-torah",
    "showLearn" => "fas fa-book-open"
));

if (!function_exists('header_permission')) {
    function header_permission($baseUrl, $isAdmin)
    {
        $CI = &get_instance();
        $CI->lang->load('header', 'zhtw');
        $backend_menu = array();
        if (!isset($_SESSION['uid'])) {
            foreach (touristURL as $value) {
                $key = (explode("/", $value));
                $header_menu[] = array(
                    "menu_name" => $CI->lang->line($key[0]),
                    "route" => $baseUrl . $value,
                    "icon" => icon[$key[0]]
                );
            }
            $logtype = LOGIN;
            $userName = $CI->lang->line('touristJoin');
        } else {
            foreach (userURL as $value) {
                $key = (explode("/", $value));
                $header_menu[] = array(
                    "menu_name" => $CI->lang->line(end($key)),
                    "route" => $baseUrl . $value,
                    "icon" => icon[$key[0]]
                );
            }
            if ($isAdmin['count']) {
                foreach (manageURL as $value) {
                    $key = (explode("/", $value));
                    $backend_menu[] = array(
                        "menu_name" => $CI->lang->line(end($key)),
                        "route" => $baseUrl . $value,
                    );
                }
            }
            if ($isAdmin['isAdmin']) {
                foreach (adminURL as $value) {
                    $key = (explode("/", $value));
                    $backend_menu[] = array(
                        "menu_name" => $CI->lang->line(end($key)),
                        "route" => $baseUrl . $value,
                    );
                }
            }
            $logtype = LOGOUT;
            $userName = $_SESSION['name'];
        }
        $URL = array(
            "header_menu" => $header_menu,
            "backend_menu" => $backend_menu,
            "logtype" => $logtype,
            "userName" => $userName
        );
        return $URL;
    }
}
