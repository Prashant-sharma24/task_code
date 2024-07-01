<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    

	public function register() {
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('form_validation_errors', validation_errors());
			$this->load->view('register');
		} else {
			// Upload profile picture
			$cover_image = $this->upload_file('profile_picture');			
			if ($cover_image === '') {
				// Handle upload failure (optional)
				$this->session->set_flashdata('error', 'Failed to upload profile picture.');
				redirect('users/register');
			}
	
			// Prepare data for registration
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'profile_picture' => $cover_image
			];
	
			// Call the model to register user
			$this->User_model->register($data);
			
			// Set success message and redirect to login page
			$this->session->set_flashdata('success', 'Registration successful. You can now log in.');
			redirect('users/login');
		}
	
		// Clear form validation errors and old input data
		$this->session->unset_userdata('form_validation_errors');
		$this->session->unset_userdata('old_input');
	}
	

	private function upload_file($file_name, $path = NULL)
	{
		$upload_path1 = "uploads/" . $path . "/profile"; // Specify the Dandiya subfolder
		$config1['upload_path'] = $upload_path1;
		$config1['allowed_types'] = "*";
		$config1['max_size'] = "20480000";
		$img_name1 = strtolower($_FILES[$file_name]['name']);
		$img_name1 = preg_replace('/[^a-zA-Z0-9\.]/', "_", $img_name1);
		$config1['file_name'] = date("YmdHis") . rand(0, 9999999) . "_" . $img_name1;
		$this->load->library('upload', $config1);
		$this->upload->initialize($config1);

		if ($this->upload->do_upload($file_name)) {
			$fileDetailArray1 = $this->upload->data();
			return $fileDetailArray1['file_name'];
		} else {
			// File upload failed, return an error or handle it as needed
			$upload_error = $this->upload->display_errors();
			// You can log the error or display it to the user
			// Example: log_message('error', 'File upload failed: ' . $upload_error);
			// Or: $this->session->set_flashdata('error', 'File upload failed: ' . $upload_error);
			return ''; // Return an empty string to indicate failure
		}
	}
	


    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $user = $this->User_model->get_user($this->input->post('email'));
            if ($user && password_verify($this->input->post('password'), $user['password'])) {
                $this->session->set_userdata('user', $user);
                redirect('users/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('users/login');
            }
        }
    }

    public function dashboard() {
        if (!$this->session->userdata('user')) {
            redirect('users/login');
        }
        $data['user'] = $this->session->userdata('user');
        $this->load->view('dashboard', $data);
    }

    public function profile() {
        if (!$this->session->userdata('user')) {
            redirect('users/login');
        }
        $data['user'] = $this->session->userdata('user');
        $this->load->view('profile', $data);
    }

    public function update_profile() {
        if (!$this->session->userdata('user')) {
            redirect('users/login');
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->session->userdata('user');
            $this->load->view('profile', $data);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            ];
            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            if (!empty($_FILES['profile_picture']['name'])) {
                $data['profile_picture'] = $this->upload_file('profile_picture');
            }

            $this->User_model->update_profile($this->session->userdata('user')['id'], $data);
            $user = $this->User_model->get_user_by_id($this->session->userdata('user')['id']);
            $this->session->set_userdata('user', $user);
			$this->session->set_flashdata('success', 'Profile updated successfully.');

            redirect('users/dashboard');
        }
    }


    public function search() {
        if (!$this->session->userdata('user')) {
            redirect('users/login');
        }

        $query = $this->input->post('query');
        $apiKey = '44725568-fd35daee9f53809a35c6cbea0';
        $url = "https://pixabay.com/api/?key=$apiKey&q=" . urlencode($query);
        $response = file_get_contents($url);
        $data['results'] = json_decode($response, true)['hits'];
        $this->load->view('search', $data);
    }



public function logout() {
    $this->session->unset_userdata('user');
    redirect('users/login'); // Redirect to the login page after logout
}
}
