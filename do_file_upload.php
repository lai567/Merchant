<?php
header("content-type:text/html;charset=utf-8");


if(isset($_POST["dir"])){

    $dir = $_POST["dir"];
    $flat = $_POST["flat"];
    $url=$_POST['imgURL'];

    session_start();
    $_SESSION['dir'] = $dir;
    $_SESSION['flat'] = $flat;
    $_SESSION['url'] = $url;

    echo $_SESSION['dir'].$_SESSION['flat'];
}
else{


    if(true){

        session_start();
        $dir =$_SESSION['dir'];
        $flat =$_SESSION['flat'];
        $url=$_SESSION['url'];

        $count = file_count($dir,$flat);
//        $upFilePath = "F:/tecent/FileRecv/zui-master-me/Merchant/{$dir}/{$flat}{$count}.png";
        $upFilePath = "./{$dir}/{$flat}{$count}.png";
//echo $upFilePath;
//      $upFilePath = "d:/wamp/www/{$dir}/{$flat}{$count}.png";

        $ok=@move_uploaded_file($_FILES['img']['tmp_name'],$upFilePath);
//        while(!file_exists($upFilePath));
        $success = array(
//            'file_infor'=>"{$dir}/{$flat}{$count}.png{$url}",
            'file_infor'=>"{$dir}/{$flat}{$count}.png++{$url}",

//         'file_infor' => "<img src='./{$dir}/{$flat}{$count}.png' width='150'height='80'/>",

        );

        $fail = array(
            'file_infor'=>'fail'.$count,
        );

        if($ok === FALSE){
            echo json_encode($fail);
        }else{
            echo json_encode($success);
        }

        unset($_SESSION['dir']);
        unset($_SESSION['flat']);
        unset($_SESSION['url']);

    }

}

/*判断上传图片的目标文件夹中有多少个图片*/
 function file_count($dir,$flat)
{
//    $dir = '135';
    $current_dir = "./{$dir}/";
//    $current_dir = 'd:/wamp/www/'.$dir.'/';
    $dir = opendir($current_dir);
    $countF = 0;

    while (false !== ($file = readdir($dir)))
    {
        if ($file != '.' && $file != '..' )
        {
            $countF++;
            //$Fpicarr[]
        }
    }

    closedir($dir);
    return $countF;

}



//$file_infor = var_export($_FILES,true);
//file_put_contents("file_infor.php",$file_infor);
//echo($file_infor);
//var_dump($file_infor)

//$name=$_POST['name'];
//echo $name;
