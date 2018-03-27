<?php
class City extends CI_Model {
    public function __construct()
    {   
        $this->load->database();
    }

	public function getCity() {
		$this->db->select('city_id, city_name, city_state');
        $this->db->from('cities');
        $query = $this->db->get();
        return $query->result();
	}
}
