<?php
    if(!empty($_POST['simple_name']) && !empty($_POST['first_name']) && !empty($_POST['pass']) && !empty($_POST['repeat_pass']) && !empty($_POST['radio1'])) {
        $connect=mysqli_connect('localhost', 'root', '', 'creatures');
////////////////////////////////////////////////////////////////////////////////
        $simplename=mysqli_real_escape_string($connect,$_POST['simple_name']);

        $name=mysqli_real_escape_string($connect,$_POST['first_name']);
    
        $pass=mysqli_real_escape_string($connect,$_POST['pass']);
        
        $repeatpass=mysqli_real_escape_string($connect,$_POST['repeat_pass']);
        
        $r1 = $_POST['radio1'];

        date_default_timezone_set('Asia/Yekaterinburg');
        $date = date('Y-m-d', time());
////////////////////////////////////////////////////////////////////////////////
        if ($pass != $repeatpass) {
            echo "Пароли не совпадают";
        }
        else {
            $hash=password_hash($pass,PASSWORD_BCRYPT);

            $query=mysqli_query($connect,"SELECT * FROM `elfes` WHERE firstname='{$name}'");
            $numr=mysqli_num_rows($query);

            $query2=mysqli_query($connect,"SELECT * FROM `dwarf` WHERE firstname='{$name}'");
            $numr2=mysqli_num_rows($query2);
            if($numr==0 && $numr2==0)
            {
                if ($r1 =="elf") {
                    $sql_q="INSERT INTO `elfes` (simplename, firstname,pass, date_of_reg) VALUES ('{$simplename}', '{$name}', '{$hash}', '{$date}')";
                    $res=mysqli_query($connect,$sql_q);
                    if($res){
                        echo "success";
                    }
                    else {
                         echo "Не удалось добавить информацию";
                    }
                }
                else {
                    $sql_q="INSERT INTO `dwarf` (simplename, firstname,pass, date_of_reg) VALUES ('{$simplename}', '{$name}', '{$hash}', '{$date}')";
                    $res=mysqli_query($connect,$sql_q);
                    if($res){
                        echo "success";
                    }
                    else {
                         echo "Не удалось добавить информацию";
                    }
                }
                 
             }
                
            else {
             echo "Этот ник занятый. Попробуйте другой!";
             }            
        }

    }
	else {
 		if (empty($_POST['simple_name'])) {
            echo ("Имя не заполнено \n");
        }
        if (empty($_POST['first_name'])) {
            echo ("Логин не заполнен \n");
        }
        if (empty($_POST['pass'])) {
            echo ("Пароль не заполнен \n");
        }
        if (empty($_POST['repeat_pass'])) {
            echo ("Подтвердите пароль \n");
        }
        if (empty($r1)) {
            echo ("Выберите расу \n");
        }
	}
?>