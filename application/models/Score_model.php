<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/14
 * Time: 下午9:44
 */

class Score_model extends CI_Model
{

    //--------------------------------------------------------------------------

    public function __construct()
    {
        $this->load->database();  // you can config auto load
    }

    //--------------------------------------------------------------------------

    /**
     * @param array $stu_id
     * @return mixed
     * @usage $result = $this->score_model->get(['stu_id' => 'something_todo']);
     */

    public function get($stu_id = false)
    {

        if ($stu_id === false) {
            // all of users

        } elseif (is_array($stu_id)) {
            $this->db->where($stu_id);

        } else {
            $this->db->where(['stu_id' => $stu_id]);
        }

        $q = $this->db->get('score_105vspe');

        return $q->result_array();
    }

    //--------------------------------------------------------------------------

    /**
     * @param array $data
     * @return int
     * @usage $result = $this->score_model->insert(['content' => 'something_todo']);
     */
    public function insert($data)
    {
        if ( $this->db->insert('score_105vspe', $data) )
        {
            return $this->db->insert_id();
        }

        return false;
    }

    //--------------------------------------------------------------------------


}