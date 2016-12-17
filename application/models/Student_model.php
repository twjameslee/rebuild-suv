<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/14
 * Time: 下午9:44
 */

class Student_model extends CI_Model
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
     * @usage $result = $this->student_model->get(['stu_id' => 'something_todo']);
     */

    public function getById($stu_id = null)
    {

        if ($stu_id === null) {
            // all of users

        } elseif (is_array($stu_id)) {
            $this->db->where($stu_id);

        } else {
            $this->db->where('stu_id', $stu_id);
        }

        $q = $this->db->get('student');

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
        if ( $this->db->insert('student', $data) )
        {
            return $this->db->insert_id();
        }

        return false;
    }

    //--------------------------------------------------------------------------

    public function update($where, $data)
    {
        $this->db->update('student', $data, $where);

        return $this->db->affected_rows();
    }
}