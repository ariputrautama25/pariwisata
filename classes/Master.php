<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	
	function save_package(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		if(empty($id)){
			$sql = "INSERT INTO `packages` set {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
		}else{
			$sql = "UPDATE `packages` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			if(isset($_FILES['img']) && count($_FILES['img']['tmp_name']) > 0){
				if(!is_dir(base_app.'uploads/package_'.$id)){
					mkdir(base_app.'uploads/package_'.$id);
					$data = " `upload_path`= 'uploads/package_{$id}' ";
				}else{
					$data = " `upload_path`= 'uploads/package_{$id}' ";
				}
				$this->conn->query("UPDATE `packages` set {$data} where id = '{$id}' ");
				foreach($_FILES['img']['tmp_name'] as $k =>$v){
					move_uploaded_file($_FILES['img']['tmp_name'][$k],base_app.'uploads/package_'.$id.'/'.$_FILES['img']['name'][$k]);
				}
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"New Package successfully saved.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function delete_p_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'unlink file failed.';
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'unlink file failed. File do not exist.';
		}
		return json_encode($resp);
	}
	function delete_package(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `packages` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			if(is_dir(base_app.'uploads/package_'.$id)){
				$file = scandir(base_app.'uploads/package_'.$id);
				foreach($file as $img){
					if(in_array($img,array('..','.')))
						continue;
					unlink(base_app.'uploads/package_'.$id.'/'.$img);
				}
				rmdir(base_app.'uploads/package_'.$id);
			}
			$this->settings->set_flashdata('success',"Tour Package successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
}
	function book_tour(){
		extract($_POST);
		$data = " user_id = '".$this->settings->userdata('id')."' ";
		foreach($_POST as $k =>$v){
			$data .= ", {$k} = '{$v}' ";
		}
		$save = $this->conn->query("INSERT INTO book_list set $data");
		if($save){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_book_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE book_list set status = '{$status}' where id ='{$id}' ");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Book successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
			return json_encode($resp);
	}
	function register(){
		extract($_POST);
		$data = "";
		$_POST['password'] = md5($password);
		foreach($_POST as $k =>$v){
				if(!empty($data)) $data .=",";
					$data .= " {$k}='{$v}' ";
		}
		$check = $this->conn->query("SELECT * FROM users where username='{$username}' ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Username already taken.";
			return json_encode($resp);
			exit;
		}
		$save = $this->conn->query("INSERT INTO users set $data ");
		if($save){
			foreach($_POST as $k =>$v){
				$this->settings->set_userdata($k,$v);
			}
			$this->settings->set_userdata('id',$this->conn->insert_id);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_account(){
		extract($_POST);
		$data = "";
		if(!empty($password)){
			$_POST['password'] = md5($password);
			if(md5($cpassword) != $this->settings->userdata('password')){
				$resp['status'] = 'failed';
				$resp['msg'] = "Current Password is Incorrect";
				return json_encode($resp);
				exit;
			}