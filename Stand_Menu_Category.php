<?php 
	class Stand_Menu_Category{
		function __construct(){
			$this->conn = mysqli_connect('localhost', 'root', '', 'db_foodcourt');

			if (mysqli_connect_errno()) {
				echo mysqli_connect_error();
			}
		}

		function getMenuCategory(){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_menu_category");
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function getMenuCategoryById($id){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_menu_category WHERE id_menu_category = ".$id);
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function addMenuCategory($stand, $category_name){
			$ins = mysqli_query($this->conn, "INSERT INTO tb_menu_category VALUES(null,'$stand', '$category_name')");
			
			return $ins;
		}

		function updateMenuCategory($id, $stand, $category_name){
			$ed = mysqli_query($this->conn, "UPDATE tb_menu_category SET id_stand = '$stand', category_name = '$category_name' WHERE id_menu_category = $id");
			return $ed;
		}

		function deleteMenuCategory($id){
			$del = mysqli_query($this->conn, "DELETE FROM tb_menu_category WHERE id_menu_category = $id");
			return $del;
		}
	}
 ?>