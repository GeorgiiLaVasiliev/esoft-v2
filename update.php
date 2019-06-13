<?php
	//echo $_POST['welcome'];
	// if (!empty($_POST['param']){
	// 	$old_log=json_decode(param);
	// 	echo $old_log;
	// }
	// else echo "err";
	if (!empty($_POST['name']) && !empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['pass_rep'])) {
///////////////////////////////////////////////////////////////////////////////////
		$connect=mysqli_connect('localhost', 'root', '', 'creatures');

		$old_log=mysqli_real_escape_string($connect,$_POST['welcome']);
		$new_name=mysqli_real_escape_string($connect,$_POST['name']);
	    $new_login=mysqli_real_escape_string($connect,$_POST['login']);
		$new_pass=mysqli_real_escape_string($connect,$_POST['pass']);
		$pass_rep=mysqli_real_escape_string($connect,$_POST['pass_rep']);

///////////////////////////////////////////////////////////////////////////////////
		
		if ($new_pass != $pass_rep){
			echo "Пароли не совпадают.";
		}
		else {
            $hash=password_hash($new_pass,PASSWORD_BCRYPT);

            $query=mysqli_query($connect,"SELECT * FROM `elfes` WHERE firstname='{$old_log}'");
			$num_row=mysqli_num_rows($query);

			if ($num_row == 0) {
				$query2=mysqli_query($connect,"SELECT * FROM `dwarf` WHERE firstname='{$old_log}'");
				$num_row2=mysqli_num_rows($query2);

				if ($num_row2 > 0){
					$query=mysqli_query($connect,"UPDATE dwarf SET simplename='{$new_name}', firstname='{$new_login}', pass='{$hash}' WHERE firstname='{$old_log}'");
					
					session_start();
					$_SESSION['user']=null;
					$_SESSION['user']=$new_login;

					echo "update ok";
				}
			}
			else {
				$query=mysqli_query($connect,"UPDATE elfes SET simplename='{$new_name}', firstname='{$new_login}', pass='{$hash}' WHERE firstname='{$old_log}'");
				
				session_start();
				$_SESSION['user']=null;
				$_SESSION['user']=$new_login;
				
				echo "update ok";
			}
	   		
		}
	}
	else {
		echo "Все поля пустые. \nПожалуйста, заполните все поля.";
	}

///////////////////////////////////////////////////////////////////////////////////



?>