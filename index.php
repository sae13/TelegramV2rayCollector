<?php

error_reporting(0);
header("Content-type: application/json;");

include "modules/getv2ray.php";
include "modules/config.php";

$mix_data = "";
$vmess_data = "";
#$vmess_array = [];
$trojan_data = "";
#trojan_array = [];
$vless_data = "";
#vless_array = [];
$shadowsocks_data = "";
#$shadowsocks_array = [];

for ($p = count($Channel) - 1; $p >= 0; $p--) {
    $CH = $Channel[$p];
    for (
        $type_count = count($Types[$CH]) - 1;
        $type_count >= 0;
        $type_count--
    ) {
        if ($Types[$CH][$type_count] === "vmess"){
            if ($vmess_data === ""){
                $vmess_data = get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$vmess_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
            }
            else{
                $vmess_data .= "\n" . get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$vmess_temp_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
                #$result = array_merge($vmess_array, $vmess_temp_array);
                #$vmess_array = $result;
            }
        }
        elseif ($Types[$CH][$type_count] === "vless"){
            if ($vless_data === ""){
                $vless_data = get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$vless_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
            }
            else{
                $vless_data .= "\n" . get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$vless_temp_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
                #$result = array_merge($vless_array, $vless_temp_array);
                #$vless_array = $result;
            }
        }
        elseif ($Types[$CH][$type_count] === "trojan"){
            if ($trojan_data === ""){
                $trojan_data = get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$trojan_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
            }
            else{
                $trojan_data .= "\n" . get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$trojan_temp_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
                #$result = array_merge($trojan_array, $trojan_temp_array);
                #$trojan_array = $result;
            }
        }
        elseif ($Types[$CH][$type_count] === "ss"){
            if ($shadowsocks_data === ""){
                $shadowsocks_data = get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$shadowsocks_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
            }
            else{
                $shadowsocks_data .= "\n" . get_v2ray($CH, $Types[$CH][$type_count] , "text");
                #$shadowsocks_temp_array = get_v2ray($CH, $Types[$CH][$type_count] , "json");
                #$result = array_merge($shadowsocks_array, $shadowsocks_temp_array);
                #$shadowsocks_array = $result;
            }
        }

    }
}


$fixed_string_vless = str_replace("&amp;", "&", $vless_data);
$fixed_string_trojan = str_replace("&amp;", "&", $trojan_data);
$mix_data = $vmess_data . "\n" . $fixed_string_vless . "\n" . $fixed_string_trojan . "\n" . $shadowsocks_data ;

file_put_contents("sub/mix" , $mix_data);
file_put_contents("sub/vmess", $vmess_data);
file_put_contents("sub/vless", $fixed_string_vless);
file_put_contents("sub/trojan", $fixed_string_trojan);
file_put_contents("sub/shadowsocks", $shadowsocks_data);

?>
