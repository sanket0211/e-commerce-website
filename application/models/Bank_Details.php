<?php
class Bank_Details extends CI_Model {
	public function __construct()
	{   
		$this->load->database();
	}

	public function insert($user_id){
		$data = array(
			'user_id' => $user_id,
			'account_number' => $this->input->post('account_number'),
			'account_name' => $this->input->post('account_name'),
			'account_type' => $this->input->post('account_type'),
			'branch' => $this->input->post('branch'),
			'ifsc' => $this->input->post('ifsc'),
			'amount' => $this->input->post('amount')
		);

		$this->db->set('date', 'NOW()', FALSE); // posting date of item
		$this->db->insert('Bank_Details', $data);
		$error = $this->db->error();	
		if($error['code'] > 0) {
			return 0;
		}

	}
}
?>