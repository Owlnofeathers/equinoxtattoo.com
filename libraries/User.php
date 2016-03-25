<?php

class User {

	public function getAllUsers()
	{
		$users = "SELECT * FROM tblUsers";

		return $users;
	}

	public function getUserById($id)
	{
		$user = "SELECT * FROM tblUsers WHERE id =" .$id;

		return $user;
	}
	
	
	public function getUserByName($name)
	{
		$user = "SELECT * FROM tblUsers WHERE Name ='$name'";

		return $user;
	}

	public function getPasswordById($id)
	{
		$password = "SELECT Password FROM tblUsers WHERE id =" .$id;

		return $password;
	}
	
	public function updatePassword($newPassword, $id)
	{
		$update_row = "UPDATE tblUsers SET Password ='$newPassword' WHERE id =" .$id;

		return $update_row;
	}
	
	public function insertUser($name, $hash, $setAdmin)
	{
		$insert_row = "INSERT INTO tblUsers (Name, Password, isAdmin) 
					VALUES ('$name', '$hash', '$setAdmin')";

		return $insert_row;
	}
	
	public function updateUser($name, $setAdmin, $id)
	{
		$update_row = "UPDATE tblUsers 
					SET Name='$name', 
						isAdmin='$setAdmin'
          			WHERE id =" .$id;

        return $update_row;
	}

	public function deleteUser($id)
	{
		$delete_row = "DELETE FROM tblUsers WHERE id =" .$id;

		return $delete_row;
	}	
	
}