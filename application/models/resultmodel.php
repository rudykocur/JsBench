<?php

class ResultModel extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function record_results($browser, $platform, $results) {
        $runIdResult = $this->db->query('SELECT IFNULL(MAX(run_id)+1, 1) AS run_id FROM results');
        $runIdObj = $runIdResult->row();
        $runId = $runIdObj->run_id;
        
        foreach($results as $row) {
            $data = array(
                'test_name' => $row['name'],
                'duration' => $row['time'],
                'executed' => date('Y-m-d H:i:s'),
                'user_agent' => $browser,
                'platform' => $platform,
                'run_id' => $runId,
            );
            
            $str = $this->db->insert_string('results', $data); 
            
            //error_log($str);
            $this->db->query($str);
        }
        
        return $runId;
    }
}

?>
