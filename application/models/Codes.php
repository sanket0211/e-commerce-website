<?php
class Codes extends CI_Model {
	public function __construct() {
		$this->load->database();	
	}

	public function is_code_matches($recharge_code = NULL) {
		if (is_null($recharge_code))
			return EXIT_ERROR;
		$this->db->select('recharge_value');
		$this->db->from('recharge_codes');
		$this->db->where('recharge_code', $recharge_code);

		$query = $this->db->get();
		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$result = $query->result();
		if (count($result) == 0)
			return FALSE;
		return TRUE;
	}
	public function get_code_details($recharge_code = NULL) {
		if (is_null($recharge_code))
			return EXIT_ERROR;
		$this->db->select('*');
		$this->db->from('recharge_codes');
		$this->db->where('recharge_code', $recharge_code);

		$query = $this->db->get();
		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		$result = $query->result();
		return $result[0];
	}

	public function code_used($recharge_code = NULL, $used_by = NULL) {
		if (is_null($recharge_code) OR is_null($used_by))
			return EXIT_ERROR;
		$this->db->where('recharge_code', $recharge_code);
		$data = array(
			'used' => 1,
			'used_by' => $used_by
		);
		$this->db->set('date_used', 'NOW()', FALSE);
		$this->db->update('recharge_codes', $data);

		$error = $this->db->error();
		if ($error['code'] > 0) {
			return EXIT_DATABASE;
		}
		return EXIT_SUCCESS;	
	}
}
?>