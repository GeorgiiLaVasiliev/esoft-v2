<?php
    $r1 = false;
    $r2 = false;
    if(empty($_POST['simple_name'])){ echo "name is null";}
    if(empty($_POST['first_name'])){ echo "name is null";}
    if (!empty($_POST['rad1'])) {
        $r1 = true;
    }
    if (!empty($_POST['rad2'])) {
        $r2 = true;
    }
    
    if(!empty($_POST['simple_name']) && !empty($_POST['first_name']) && !empty($_POST['pass']) && !empty($_POST['repeat_pass'])) {
        $connect=mysqli_connect('localhost', 'root', '', 'creatures');
////////////////////////////////////////////////////////////////////////////////
        $simplename=mysqli_real_escape_string($connect,$_POST['simple_name']);

        $name=mysqli_real_escape_string($connect,$_POST['first_name']);
    
        $pass=mysqli_real_escape_string($connect,$_POST['pass']);
        
        $repeatpass=mysqli_real_escape_string($connect,$_POST['repeat_pass']);
////////////////////////////////////////////////////////////////////////////////
        
////////////////////////////////////////////////////////////////////////////////
        if ($pass != $repeatpass) {
            echo "Пароли не совпадают";
        }
        else {
            $hash=password_hash($pass,PASSWORD_BCRYPT);
            $query=mysqli_query($connect,"SELECT * FROM `elfes` WHERE firstname='{$name}'");
            $numr=mysqli_num_rows($query);
            if($numr==0)
            {
                 $sql_q="INSERT INTO `elfes` (simplename, firstname,pass) VALUES ('{$simplename}', '{$name}', '{$hash}')";
                 $res=mysqli_query($connect,$sql_q);
                 if($res){
                 echo "Аккаунт успешно создан";
                 }
                 else {
                     echo "Не удалось добавить информацию";
                }
             }
            else {
             echo "Этот ник занятый. Попробуйте другой!";
             }            
        }

    }
	else {
 		echo "Все поля обязательны для заполнения!";
	}
?>