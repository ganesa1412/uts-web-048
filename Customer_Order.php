<?php 
	class Customer_Order{
		function __construct(){
			$this->conn = mysqli_connect('localhost', 'root', '', 'db_foodcourt');

			if (mysqli_connect_errno()) {
				echo mysqli_connect_error();
			}
		}

		function setTable($table, $customer){
			$_SESSION['table'] = $table;
			$_SESSION['customer_name'] = $customer;
		}

		function addOrder($stand, $items){
			$table = $_SESSION['table'];
			$customer = $_SESSION['customer_name'];
			$datetime = date('Y-m-d H:i:S');
			$status = 1;

			$ins = mysqli_query($this->conn, "INSERT INTO tb_order VALUES(null,'$stand', '$table', '$datetime', '$customer', '$status')");
			if ($ins) {
				foreach ($items as $item) {
					$menu = $item->menu;
					$quantity = $item->quantity;

					$ins2 = mysqli_query($this->conn, "INSERT INTO tb_order_item(null, null, '$menu', '$quantity')");
				}
			}

			return $ins;
		}

		function getActiveOrder($id){
			$table = $_SESSION['table'];

			$data = mysqli_query($this->conn, "SELECT * FROM tb_order WHERE status = 1 AND id_table = $table");
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function getOrderDetail($id){
			$data = mysqli_query($this->conn, "SELECT tb_menu.menu_name as menu, tb_order_item.quantity as quantity, (tb_menu.price * tb_order_item.quantity) AS price FROM tb_menu, tb_order_item, tb_order WHERE tb_menu.id_menu = tb_order_item.id_menu AND tb_order_item.id_order = tb_order.id_order AND tb_order.id_order = $id");

			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function getOrderBill($id){
			$data = mysqli_query($this->conn, "SELECT (tb_menu.price * tb_order_item.quantity) AS price FROM tb_menu, tb_order_item, tb_order WHERE tb_menu.id_menu = tb_order_item.id_menu AND tb_order_item.id_order = tb_order.id_order AND tb_order.id_order = $id");

			$bill = 0;
			while ($row = mysqli_fetch_array($data)) {
				$bill += $row['price'];
			}

			return $bill;
		}


	}
 ?>