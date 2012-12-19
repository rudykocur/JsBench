<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oesk extends CI_Controller {

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
            $this->load->model('ResultModel');
            $results = $this->ResultModel->getResults();
            
            $runId = $this->input->get('runId');
            
            if($runId) {
                $runData = $this->ResultModel->getUserResult($runId);
                
                foreach($runData as $runType => $runRow) {
                    $results['categories'][$runType][] = 'Twój wynik';
                    $results['data'][$runType]['data'][] = array(
                        'y' => floatval($runRow['duration']),
                        'color' => '#FF0000'
                    );
                }
            }
            
            $htmlData = array(
                'categories' => json_encode($results['categories']),
                'data' => json_encode($results['data']),
            );
            
            $this->load->view('header');
            $this->load->view('oesk_results', $htmlData);
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
            $resultsStr = $this->input->post('results');
            $browser = $this->input->post('browser');
            $platform = $this->input->post('platform');
            
            $results = json_decode($resultsStr, true);
            
            $this->load->model('ResultModel');
            $runId = $this->ResultModel->record_results($browser, $platform, $results);
            
            echo json_encode(array('runId' => $runId));
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */