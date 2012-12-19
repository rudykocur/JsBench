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
            $this->db->query($str);
        }
        
        return $runId;
    }
    
    function getUserResult($runId) {
        $query = "select * from results WHERE run_id = $runId";
        $rs = $this->db->query($query);
        
        $out = array();
        foreach($rs->result_array()  as $row) {
            $out[$row['test_name']] = $row;
        }
        
        return $out;
    }
    
    function getResults() {
        $query = "select test_name, platform, user_agent, AVG(duration) AS dur FROM results GROUP BY test_name, platform, user_agent";
        $rs = $this->db->query($query);
        
        $result = array();
        $categories = array();
        
        foreach($rs->result_array()  as $row) {
            if(!isset($result[$row['test_name']])) {
                $result[$row['test_name']] = array(
                    'name' => 'times',
                    'data' => array()
                );
            }
            if(!isset($categories[$row['test_name']])) {
                $categories[$row['test_name']] = array();
            }
            
            $colName = $row['platform'] . ' ' . $row['user_agent'];
            
            $categories[$row['test_name']][] = $colName;
            
            $result[$row['test_name']]['data'][] = floatval($row['dur']);
            
//            $result[$row['test_name']][] = array(
//                'name' => $colName,
//                'data' => array(floatval($row['dur']))
//            );
            
            
        }
        
        return array(
            'categories' => $categories,
            'data' => $result
        );
    }
}

?>
