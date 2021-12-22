<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gundam_m extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function get($id = NULL, $limit=5, $offset = 0)
    {
        if($id==null){
            return $this->db->get('tb_kamar', $limit, $offset)->result();
        }
        else{
            return $this->db->get_where('tb_kamar',['id'=>$id])->result_array();
        }
         
    }

    public function count()
    {
        return $this->db->get('tb_kamar')->num_rows();
    }

    public function add($data)
  {
    try {
      $this->db->insert('tb_kamar', $data);
      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }

  public function update($id, $data)
  {
    try {
      $this->db->update('tb_kamar', $data, ['id' => $id]);
      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }
  public function delete($id)
  {
    try {
      $this->db->delete('tb_kamar', ['id' => $id]);
      $error = $this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan: ' . $error['message']);
        return false;
      }
      return ['status' => true, 'data' => $this->db->affected_rows()];
    } catch (Exception $ex) {
      return ['status' => false, 'msg' => $ex->getMessage()];
    }
  }

}
