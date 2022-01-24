<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('no_kamar', 'no_kamar', 'required');
		$this->form_validation->set_rules('nama_penghuni', 'nama_penghuni', 'required');
		$this->form_validation->set_rules('asal', 'asal', 'required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'no_kamar'	=>	$this->input->post('no_kamar'),
				'nama_penghuni'	=>	$this->input->post('nama_penghuni'),
				'asal'		=>	$this->input->post('asal'),
				'pekerjaan'		=>	$this->input->post('pekerjaan')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'no_kamar_error'		=>	form_error('no_kamar'),
				'nama_penghuni_error'		=>	form_error('nama_penghuni'),
				'asal_error'		=>	form_error('asal'),
				'pekerjaan_error'		=>	form_error('pekerjaan')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('id'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('id'));

			foreach($data as $row)
			{
				$output['no_kamar'] = $row['no_kamar'];
				$output['nama_penghuni'] = $row['nama_penghuni'];
				$output['asal'] = $row['asal'];
				$output['pekerjaan'] = $row['pekerjaan'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('no_kamar', 'no_kamar', 'required');
		$this->form_validation->set_rules('nama_penghuni', 'nama_penghuni', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'no_kamar'		=>	$this->input->post('no_kamar'),
				'nama_penghuni'			=>	$this->input->post('nama_penghuni'),
				'asal'			=>	$this->input->post('asal'),
				'pekerjaan'			=>	$this->input->post('pekerjaan')
			);

			$this->api_model->update_api($this->input->post('id'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	ture,
				'no_kamar_error'		=>	form_error('no_kamar'),
				'nama_penghuni_error'		=>	form_error('nama_penghuni'),
				'asal_error'		=>	form_error('asal'),
				'pekerjaan_error'		=>	form_error('pekerjaan')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id'))
		{
			if($this->api_model->delete_single_user($this->input->post('id')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

}


?>