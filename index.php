<?php
include_once "config.php";
$retarr = array();
$reqcommands = array("version", "retrievedata","isvalid");
if(isset($_GET["req"]) and in_array($_GET["req"],$reqcommands)){
    $retarr["response"] = "OK";
    if($_GET["req"] == "version"){
        $retarr["command"]["name"] = "version";
        $retarr["command"]["arguments"]["none"] = "none";
        $retarr["result"]["version"] = "SFR-A9I003";
    }
    elseif($_GET["req"] == "isvalid"){
        if(isset($_GET["token"])){
            $sql = "SELECT * FROM token WHERE token='".mysqli_real_escape_string($link,$_GET["token"])."'";
            if($result = mysqli_query($link,$sql)){
                if(mysqli_num_rows($result) == 1){
                    while($row = mysqli_fetch_array($result)){
                        if($row["expire"] > time()){
                            $retarr["response"] = "OK";
                            $retarr["command"]["name"] = "isvalid";
                            $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                            $retarr["env"]["version"] = "SFR-A9I003";
                            $retarr["result"]["isvalid"] = "YES";
                            $retarr["result"]["token_exists"] = "YES";
                            $retarr["result"]["expired"] = "NO";
                        } else {
                            $retarr["response"] = "OK";
                            $retarr["command"]["name"] = "isvalid";
                            $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                            $retarr["env"]["version"] = "SFR-A9I003";
                            $retarr["result"]["isvalid"] = "NO";
                            $retarr["result"]["token_exists"] = "YES";
                            $retarr["result"]["expired"] = "YES";
                        }
                    }
                } else {
                    $retarr["response"] = "OK";
                    $retarr["command"]["name"] = "isvalid";
                    $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                    $retarr["env"]["version"] = "SFR-A9I003";
                    $retarr["result"]["isvalid"] = "NO";
                    $retarr["result"]["token_exists"] = "NO";
                    $retarr["result"]["expired"] = "NO";
                }
            } else {
                $retarr["response"] = "FAILED";
                $retarr["command"]["name"] = "isvalid";
                $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                $retarr["env"]["version"] = "SFR-A9I003";
            }
        }else {
            $retarr["response"] = "MISSING_ARGUMENT";
            $retarr["command"]["name"] = "isvalid";
            $retarr["command"]["arguments"]["token"] = "null";
            $retarr["env"]["version"] = "SFR-A9I003";
        }
    }
    elseif ($_GET["req"] == "retrievedata"){
        if(isset($_GET["token"])){
            $sql = "SELECT * FROM token WHERE token='".mysqli_real_escape_string($link,$_GET["token"])."'";
            if($result = mysqli_query($link,$sql)){
                if(mysqli_num_rows($result) == 1) {
                    while ($row = mysqli_fetch_array($result)) {
                            $retarr["response"] = "OK";
                            $retarr["command"]["name"] = "retrievedata";
                            $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                            $retarr["env"]["version"] = "SFR-A9I003";
                            $retarr["result"]["username"] = $row["username"];
                            $retarr["result"]["expire"] = $row["expire"];
                            $retarr["result"]["create"] = $row["creation"];
                            $retarr["result"]["permission"] = $row["permission"];
                            $retarr["result"]["command"] = $row["command"];
                            $retarr["result"]["creator"] = $row["creator"];
                    }
                } else {
                    $retarr["response"] = "INVALID_ARGUMENT";
                    $retarr["command"]["name"] = "retrievedata";
                    $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                    $retarr["env"]["version"] = "SFR-A9I003";
                }
                } else {
                $retarr["response"] = "FAILED";
                $retarr["command"]["name"] = "retrievedata";
                $retarr["command"]["arguments"]["token"] = mysqli_real_escape_string($link,$_GET["token"]);
                $retarr["env"]["version"] = "SFR-A9I003";
            }
        }else {
            $retarr["response"] = "MISSING_ARGUMENT";
            $retarr["command"]["name"] = "retrievedata";
            $retarr["command"]["arguments"]["token"] = "null";
            $retarr["env"]["version"] = "SFR-A9I003";
        }
    }
} else {
    $retarr["response"] = "Invalid or No Command Entered.";
    $retarr["command_received"] = $_GET["req"];
    $retarr["available_commands"] = $reqcommands;
}
die(json_encode($retarr));