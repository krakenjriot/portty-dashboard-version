<?php
if (isset($_GET['pins']) && $_GET['board_name'])
{

    //b=$board_name&
    //p=$pins&
    //exe_dir=$exe_dir&
    //server_timezone=$server_timezone";
    $pins = $_GET['pins'];
    $board_name = $_GET['board_name'];
    $server_timezone = $_GET['server_timezone'];
    $htdocs_dir = $_GET['htdocs_dir'];
    $exe_dir = $_GET['exe_dir'];
    $server_refresh_sec = $_GET['server_refresh_sec'];	
    $board_refresh_sec = $_GET['board_refresh_sec'];	
	
	//echo $server_refresh_sec."</br>";
	
	//$board_refresh_sec = (int) $board_refresh_sec;
	
	//$config = include $htdocs_dir . '\\config';		
	//var_dump($config);		
	//$config['server_refresh_sec']= $server_refresh_sec;	
	//file_put_contents($htdocs_dir.'\\config', '<?php return ' . var_export($config, true) . ';');		
	//file_put_contents($htdocs_dir . '\\config', '<?php return ' . var_export($config, true) . ';');	
	
	

    $out_file = $exe_dir . "\\conf\\" . $board_name . ".output";
    file_put_contents($out_file, $pins);

    //$path = '$exe_dir ."\\conf\\"x\\';
    //mkdir($path, null, true);
    $dht_file = $exe_dir . "\\conf\\" . $board_name . ".dht";
    //create file if not exist
    if (!file_exists($dht_file))
    {
        //touch($dht_file, "0,0");
        file_put_contents($dht_file, "0,0");
    }
	

    //$file_last_modified = filemtime($dht_file);
    //echo "</br>Last modified " . date("l, dS F, Y, h:ia", $file_last_modified)."\n";
    $diff = time() - filemtime($dht_file);


	//echo "diff ".$diff."</br>";	

    //echo "diff ".$diff."</br>";
    //echo "</br>";
    //echo "dht_file ".$dht_file."</br>";
    //value is zero then set it to 3 secs
    //if(!$board_refresh_sec) $board_refresh_sec = 3;
    

    //if ($diff < $board_refresh_sec * 3)
    if ($diff < $board_refresh_sec * 3)
    { // 10 seconds
        //echo "</br>porttymon for board ($board_name) is running";
        //return true;
        $monitor = 1;
    }
    else
    {
        //echo "</br>porttymon for board ($board_name) is not running";
        //return false;
        $monitor = 0;
    }

    //echo "</br>";
    //echo "</br>";
    //echo "$config: ". var_dump($config)."</br>";
    //echo "dht hum: ". $dht_arr[1]."</br>";
    date_default_timezone_set($server_timezone);
    $dht_csv = @file_get_contents($dht_file);
    $dt = date('Y-m-d H:i:s');

    //echo "</br>";
    //echo "</br>";
    //echo "return porttysen.exe input file";
    //if(empty($dht_csv))$dht_csv = "0,0";
    if (!empty($dht_csv)) echo "$board_name,$dt,$dht_csv,0ld7vcxm72c2g3yz,$server_timezone,$monitor";
}

/*
	$new_datetime = date("H:i:s");
	echo " [0ld7vcxm72c2g3yz] ";
	echo " [". $new_datetime . "] - Board Name: $b</br>";
	echo "todo list - create auto batch file for new add board</br>";
	echo "todo list - add com ports in add/edit board</br>";
	echo "todo list - add cascading links server -> boards -> pins with filter table</br>";
	echo "todo list - create board output if not present</br>";
	echo "todo list - settings to modal to add worker refresh rate</br>";
*/

//echo "server_refresh_sec ".$server_refresh_sec."</br>";

?>
