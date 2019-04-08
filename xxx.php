<?php
namespace app\index\controller;
use Think\Controller;
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
//允许跨域
class AccountController extends Controller {
	public function login() {
		$name = $_GET['name'];
		// 获取参数
		$password = $_GET['password'];
		// 获取参数
		$data = $this -> mysql_select($name);
		if (!$data['password'] || $data['password'] !== $password) {
			$re -> state = 0;
		} else {
			$re -> state = 1;
			$re -> data -> id = $data['id'];
		} $this -> ajaxReturn($re);
	}

	public function addAccount() {
		$name = $_GET['name'];
		// 获取参数
		$password = $_GET['password'];
		// 获取参数
		$result = $this -> mysql_insert($name, $password);
		$this -> ajaxReturn($result);
	}

	public function deleteAccount() {
		$name = $_GET['name'];
		// 获取参数
		$result = $this -> mysql_delete($name);
		$this -> ajaxReturn($result);
	}

	public function setPassword() {
		$name = $_GET['name'];
		// 获取参数
		$password = $_GET['password'];
		// 获取参数
		$result = $this -> mysql_updata($name, $password);
		$this -> ajaxReturn($result);
	}

	public function mysql_insert($name, $password) {
		if (json_encode($this -> mysql_select($name)) == 'false') {//是否重名
			include '_A_mysql.php';
			mysql_query("INSERT INTO db_account (name, password) VALUES ('{$name}', '{$password}')");
			mysql_close($con);
			$re = 1;
		} else {
			$re = 0;
		}
		return $re;
	}

	public function mysql_delete($name) {
		include '_A_mysql.php';
		mysql_query("DELETE FROM db_account WHERE name='{$name}'");
		mysql_close($con);
		return;
	}

	public function mysql_updata($name, $password) {
		include '_A_mysql.php';
		mysql_query("UPDATE db_account SET password = '{$password}' WHERE name = '{$name}' ");
		mysql_close($con);
		return;
	}

	public function mysql_select($name) {
		include '_A_mysql.php';
		$sql = "SELECT * FROM db_account WHERE name='{$name}'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		//获取一行数据
		mysql_close($con);
		return $row;
	}

}
?>