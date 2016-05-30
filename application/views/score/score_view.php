<div align="center">

    <table style="border 0;border-collapse:collapse; border-spacing:0; width:750px; height:550px; background-image: url(<?php echo base_url()?>public/img/score/bg_105vspe_score.jpg)">
        <tr>
            <td valign="top">
                <div style="width:100%; padding:140px 240px 0 60px;">
                    <table id="data-table" border="1" width="100%">
                            <tr>
                                <td class="field-title">身分證號</td>
                                <td align="center">
                                    <form id="score_form" class="form-inline" role="form" method="POST" action="<?php echo site_url('score/show')?>">
                                        <input type="text" name="stu_id" class="form-control" style="width: 180px;" placeholder="請輸入你的身分證號碼"/>
                                        <button type="submit" class="btn btn-default">查詢</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-title">學校名稱</td>
                                <td align="center">
                                    <span class="form-control-static data-field" id="jsch"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-title">姓名</td>
                                <td align="center">
                                    <span class="form-control-static data-field" id="stu_name"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-title">報考班別</td>
                                <td align="center">
                                    <span class="form-control-static data-field" id="exam_class"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-title">准考證號</td>
                                <td align="center">
                                    <span class="form-control-static data-field" id="exam_no"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-title">成績</td>
                                <td align="center">
                                    <p class="form-control-static data-field" id="score"></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="field-title remark">備註</td>
                                <td align="center">
                                    <span class="form-control-static data-field" id="remark" style="text-align:left"></span>
                                </td>
                            </tr>
                        </table>
                    <div id="score_form_error" class="alert alert-danger hide_me" style="font-size: small;">
                        <!-- Dynamic -->
                    </div>
                    <div style="color: #FF0000;font-size: small;text-align: center">
                        ＊ 成績複查及後續事宜請至彰商特招網站(<a href="http://reg.chsc.tw/spec" target="_blank">http://reg.chsc.tw/spec</a>)查詢
                    </div>
                </div>
            </td>
        </tr>
    </table>

</div>