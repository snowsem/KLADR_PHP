<?php

if (isset($_GET['query'])) {


     $dblocation = ""; // Имя сервера
    $dbuser = "";          // Имя пользователя
    $dbpasswd = "";
    $dbname ='';// Пароль
    $dbcnx = mysql_connect($dblocation,$dbuser,$dbpasswd);
    if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
    {
        echo("<P>В настоящий момент сервер базы данных не доступен, поэтому
           корректное отображение страницы невозможно.</P>");
        exit();
    }
    if (!@mysql_select_db($dbname, $dbcnx))
    {
        echo( "<P>В настоящий момент база данных не доступна, поэтому
            корректное отображение страницы невозможно.</P>" );
        exit();
    }
    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER SET 'utf8'");
    $id =  mysql_real_escape_string($_GET['query']);
    //AND NAME  LIKE '%$id%'
    $ath = mysql_query("SELECT * FROM KLADR  WHERE `CODE` LIKE '%00000000000' AND `NAME` LIKE '%$id%'");
    $arr='';
    if($ath)
    {

        while($row = mysql_fetch_array($ath, MYSQL_ASSOC)) {

            $arr[] = array('id'=>$row['CODE'], 'name'=>$row['NAME'].' '.$row['SOCR'], 'GNINMB' => $row['GNINMB']);

            //print $row['NAME'];

        }
        print json_encode($arr);

    }
    else
    {
        echo "<p><b>Error: ".mysql_error()."</b></p>";
        exit();
    }

}





?>