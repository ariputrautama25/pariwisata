<?php
require_once('../config.php');
Class Zone extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_zone(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if($k != 'id'){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(empty($id)){
			$chk = $this->conn->query("SELECT * FROM barangay_list where code = '$code' ")->num_rows;
			if($chk > 0){
				return 3;
			}else{
				$qry = $this->conn->query("INSERT INTO barangay_list set {$data}");
				if($qry){
					$this->settings->set_flashdata('success','zone successfully saved.');
					return 1;
				}else{
					return "INSERT INTO barangay_list set {$data}";
				}
			}

		}else{
			$chk = $this->conn->query("SELECT * FROM barangay_list where code = '$code' and id != $id")->num_rows;
			if($chk > 0){
				return 3;
			}else{
				$qry = $this->conn->query("UPDATE barangay_list set $data where id = {$id}");
				if($qry){
					$this->settings->set_flashdata('success','zone successfully updated.');
					return 1;
				}else{
					return "INSERT INTO barangay_list set {$data}";
				}
			}