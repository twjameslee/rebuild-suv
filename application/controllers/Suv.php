<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/15
 * Time: 上午12:40
 */

class Suv extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('suv/suv_view');
    }

    public function getStudent($stu_id = null)
    {
        $this->output->set_content_type('application_json');

        // 取得form post進來的資料
        if (empty($stu_id))
        {
            $stu_id = $this->input->post('stu_id');
        }
        // 取得目前辦理梯次
        $this->load->model('setting_model');
        $this->load->model('student_model');

        $result = $this->setting_model->getByName('梯次');

        $batch_no = empty($result) ? [] : ['batch_no' => $result->value];
        $stu_id = empty($stu_id) ? [] : ['stu_id' => $stu_id];
        $stu_id = array_merge($batch_no, $stu_id);

        // 執行查詢
        $result = $this->student_model->getById($stu_id);

        // 執行後結果
        if ($result)
        {               // 成功
            $this->output->set_output(json_encode([
                'result'    => 1,
                'data'      => $result
            ]));
        }
        else            // 失敗
        {
            $this->output->set_output(json_encode([
                'result'    => 0,
                'error'     => '查無此學生...'
            ]));
        }
    }

}