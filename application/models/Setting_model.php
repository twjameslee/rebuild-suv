<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/14
 * Time: 下午9:44
 */

class Setting_model extends CI_Model
{

    //--------------------------------------------------------------------------

    public function __construct()
    {
        $this->load->database();  // you can config auto load
    }

    //--------------------------------------------------------------------------

    /**
     * @param array $name
     * @return mixed
     * @usage $result = $this->setting_model->get(['name' => 'something_todo']);
     */

    public function getByName($name=null)
    {

        if (empty($name))
        {
            // all of users

        }
        elseif (is_array($name))
        {
            $this->db->where($name);

        }
        else
        {
            $this->db->where('name', $name);
        }

        $q = $this->db->get('setting');

        if (!empty($name))
        {
            return $q->row();
        }
        else
        {
            return $q->result_array();
        }
    }

    //--------------------------------------------------------------------------

    /**
     * @param array $data
     * @return int
     * @usage $result = $this->score_model->insert(['content' => 'something_todo']);
     */
    public function insert($data)
    {
        if ( $this->db->insert('setting', $data) )
        {
            return $this->db->insert_id();
        }

        return false;
    }

    //--------------------------------------------------------------------------


}