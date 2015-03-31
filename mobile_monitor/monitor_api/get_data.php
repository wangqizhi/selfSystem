<?php 

// 测试开启所有网站的访问
header("Access-Control-Allow-Origin: *");

if ($_GET["monitor"]) {
    // echo $_GET["monitor"];
    if ($_GET["monitor"] == "node") {
        $out = exec("python ../script/get_nodeinfo.py");
        echo $out;
    }elseif ($_GET["monitor"] == "push") {
        $out = exec("python ../script/get_push_queue.py");
        echo $out;
    }elseif ($_GET["monitor"] == "hadooplog") {
        $out = exec("python ../script/get_hadoopLog.py");
	#$out = "1234";
        echo $out;
    }
    else {
        die("[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]");
    }
   
    // var_dump($out);
    // echo json_encode($out);
} else {
    die("[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]");
    // die("错误的参数");
}



 ?>
