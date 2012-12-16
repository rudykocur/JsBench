<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oesk extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->view('header');
            $this->load->view('oesk_index');
            $this->load->view('footer');
	}
        
        public function test()
	{
            $this->load->view('header');
            $this->load->view('oesk_test');
            $this->load->view('footer');
	}
        
        public function results()
	{
            $this->load->view('header');
            $this->load->view('oesk_results');
            $this->load->view('footer');
	}
        
        public function test_kraken() {
            $this->load->view('test_kraken');
        }
        
        public function test_sunspider() {
            $this->load->view('test_sunspider');
        }
        
        public function test_v8() {
            $this->load->view('test_v8');
        }
        
        public function post_result() {
            $results = $this->input->post('results');
            $browser = $this->input->post('browser');
            $platform = $this->input->post('platform');
            
            error_log('AAAAA CALLED ' . $results);
            
            $results = json_decode($results, true);
            error_log('DECODED ' . print_r($results, true));
            
            $this->load->model('ResultModel');
            $runId = $this->ResultModel->record_results($browser, $platform, $results);
            
            echo $runId;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */