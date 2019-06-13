<?php

	if(!empty($_POST['login']) && !empty($_POST['pass'])) {
		$connect=mysqli_connect('localhost', 'root', '', 'creatures');
 		
 		$log=mysqli_real_escape_string($connect,$_POST['login']);
    
        $pass=mysqli_real_escape_string($connect,$_POST['pass']);
 		
        $hash=password_hash($pass,PASSWORD_BCRYPT);
        
		$query=mysqli_query($connect,"SELECT pass FROM `elfes` WHERE firstname='{$log}'");
		$str=mysqli_fetch_row($query);
		
		date_default_timezone_set('Asia/Yekaterinburg');
		$date = date('Y-m-d H:i', time());

		if (empty($str)){
			$query=mysqli_query($connect,"SELECT pass FROM `dwarf` WHERE firstname='{$log}'");
			$str=mysqli_fetch_row($query);

			// $sql_q="INSERT INTO `user_online` (user, last_date_online) VALUES ('{$log}','{$date}')";
   //    $res=mysqli_query($connect,$sql_q);	
      $res=UserDateAutoriz($connect, $log, $date);

			if (password_verify($pass, $str[0]) == true && $res) {
        		session_start();
        		$_SESSION['user']=$log;

        		echo "success";
	        } 
    	    else {
    	    	echo "Пароль введен неверно или пользователь не существует";
    	    }
		} 
  		else {
  			// $sql_q="INSERT INTO `user_online` (user, last_date_online) VALUES ('{$log}','{$date}')";
     //    $res=mysqli_query($connect,$sql_q);	
        $res=UserDateAutoriz($connect, $log, $date);
  			if (password_verify($pass, $str[0]) == true && $res) {
  				session_start();
        		$_SESSION['user']=$log;
        		echo "success";
	        } 
    	    else {
    	    	echo "Пароль введен неверно или пользователь не существует";
    	    }
  		}
  			
	}
	else { 
		echo "Не все поля заполнены";
		}
function UserDateAutoriz($connect, $log, $date)
{
  $sql_q=mysqli_query($connect,"SELECT user FROM `user_online` WHERE user='{$log}'");
  $str=mysqli_fetch_row($sql_q);
  if(empty($str)){
    $sql_q="INSERT INTO `user_online` (user, last_date_online) VALUES ('{$log}','{$date}')";
    $res=mysqli_query($connect,$sql_q);
    if ($res) {
      return true;
    }
  }
  else {
    $query=mysqli_query($connect,"UPDATE user_online SET last_date_online='{$date}' WHERE user='{$log}'");
    if ($query) {
      return true;
    }
  }
  
}
?>