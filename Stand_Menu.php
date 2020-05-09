<?php 
	class Stand_Menu{
		function __construct(){
			$this->conn = mysqli_connect('localhost', 'root', '', 'db_foodcourt');

			if (mysqli_connect_errno()) {
				echo mysqli_connect_error();
			}
		}

		function getMenu(){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_menu");
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function getMenuById($id){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_menu WHERE id_menu = ".$id);
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function addMenu($category, $menu_name, $description, $price, $img){
			$ins = mysqli_query($this->conn, "INSERT INTO tb_menu VALUES(null,'$category', '$menu_name', '$description', '$price', '$img')");
			
			return $ins;
		}

		function updateMenu($id, $category, $menu_name, $description, $price, $img){
			$ed = mysqli_query($this->conn, "UPDATE tb_menu SET id_menu_category
			 = '$category', menu_name = '$menu_name', description = '$description', price = '$price', img = '$img' WHERE id_menu = $id");
			return $ed;
		}

		function deleteMenu($id){
			$del = mysqli_query($this->conn, "DELETE FROM tb_menu WHERE id_menu = $id");
			return $del;
		}
	}
 ?>