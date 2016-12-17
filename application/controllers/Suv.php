<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/15
 * Time: 上午12:40
 */

class Suv extends CI_Controller
{
    private $op_no;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('setting_model');
        $this->op_no = $this->setting_model->getByName('梯次')->value;

        $this->output->set_content_type('application_json');
    }

    public function index()
    {
        $this->load->view('suv/suv_view');
    }



    //----------------------------------------------------------------------


    /**
     * 取得目前辦理梯次
     */
    public function getCurrentOp()
    {
        $this->output->set_output(json_encode([
            'result'    => 1,
            'data'      => ['op_no' => $this->op_no]
        ]));
    }

    /**
     * 取得本梯次的學生
     * @param null $stu_id
     */
    public function getOpStudent($stu_id = null)
    {
        // 取得form post進來的資料
        if (!isset($stu_id))
        {
            $stu_id = $this->input->post('stu_id');
        }
        $this->load->model('student_model');

        $stu_id = empty($stu_id) ?
            ['op_no' => $this->op_no] :
            ['op_no' => $this->op_no, 'stu_id' => $stu_id];

        // 執行查詢
        $result = $this->student_model->getById($stu_id);

        // 執行後結果
        if ($result)
        {               // 成功
            $this->output->set_output(json_encode([
                'result'    => 1,
                'data'      => $result
            ], JSON_NUMERIC_CHECK));
        }
        else            // 失敗
        {
            $this->output->set_output(json_encode([
                'result'    => 0,
                'error'     => '查無此學生...'
            ]));
        }
    }

    /**
     * 取得本梯次的學生
     * @param null $stu_id
     */
    public function getOpSubject($stu_id = null)
    {
        // 取得form post進來的資料
        if (!isset($stu_id))
        {
            $stu_id = $this->input->post('stu_id');
        }

        $stu_id = empty($stu_id) ?
            ['op_no' => $this->op_no] :
            ['op_no' => $this->op_no, 'stu_id' => $stu_id];

        // 執行查詢
        $this->load->model('subject_model');
        $result = $this->subject_model->getByStuId($stu_id);

        // 執行後結果
        if ($result)
        {               // 成功
            $this->output->set_output(json_encode([
                'result'    => 1,
                'data'      => $result
            ], JSON_NUMERIC_CHECK));
        }
        else            // 失敗
        {
            $this->output->set_output(json_encode([
                'result'    => 0,
                'error'     => '查無此學生...'
            ]));
        }
    }

    /**
     * 取得本梯次的學生
     */
    public function updSubjects()
    {
        $this->load->model('student_model');
        $this->student_model->update(
            [   //$where
                'op_no' => $this->op_no,
                'stu_id' => $this->input->post('stu_id')
            ],
            [   //$data
                'attend' => $this->input->post('attend')
            ]
        );

        $subjects_WBU = $this->input->post('subjects_WBU');

        if (count($subjects_WBU) !== 0)
        {
            // 執行查詢
            $this->load->model('subject_model');
            $result = $this->subject_model->update($subjects_WBU);

            // 執行後結果
            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => $result
            ], JSON_NUMERIC_CHECK));

        } else {

            $this->output->set_output(json_encode([
                'result' => 1,
                'data' => 0
            ], JSON_NUMERIC_CHECK));

        }
    }
}