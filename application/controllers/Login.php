<?php 

class Login extends CI_Controller
{
	public function index()
	{
		if ($this->input->post('login'))
		{
			$data = [
				'username'	=> $this->input->post('username'),
				'password'	=> $this->input->post('password')
			];

			$this->load->library('gz');
			$response = json_decode($this->gz->POST('user/login', $data));
			if ($response->status === false)
			{
				$message = '<div class="alert alert-danger">' . $response->message . '</div>';
				$this->session->set_flashdata('msg', $message);
				redirect('login');
			}

			echo $response->message . '. <a href="' . base_url('login') . '">Login</a>';
			exit;
		}

		$this->load->view('login');
	}
}