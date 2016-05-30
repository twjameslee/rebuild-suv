<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/15
 * Time: 上午12:40
 */

class Score extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('score/header_view');
        $this->load->view('score/score_view');
        $this->load->view('score/footer_view');
    }

    public function show($stu_id = false)
    {
        $this->output->set_content_type('application_json');

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'stu_id','身分證號',
            'required'
        );

        if ($this->form_validation->run() == false)
        {
            $this->output->set_output(json_encode([
                'result'    => 0,
                'error'     => $this->form_validation->error_array()
            ]));
            return false;
        }

        // 取得form post進來的資料
        $stu_id = strtoupper($this->input->post('stu_id'));

        // 使用model
        $this->load->model('score_model');

        // 執行查詢
        $result = $this->score_model->get([
            'stu_id' => $stu_id
        ]);

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
                'error'     => '查無此考生...'
            ]));
        }
    }

}