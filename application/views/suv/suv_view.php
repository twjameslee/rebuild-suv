<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="91806396317-nnbu2id5vsr05mj10ta2frispkolcc3r.apps.googleusercontent.com">
    <meta name="author" content="STeam of CHSC">
    <title>重補修調查</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/suv/css/third-party/Features-Blue.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/suv/css/third-party/Header-Blue.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/suv/css/third-party/Footer-Dark.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/suv/css/styles.css">
</head>

<body>
<div id="vm">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="fa fa-google-wallet"></i> <strong>重補修選課系統 </strong><i class="fa fa-google-wallet fa-flip-horizontal"></i><strong> </strong></a>
                <button class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">第一階段 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">1_重修課目調查</a></li>
                            <li class="divider" role="presentation"></li>
                            <li role="presentation"><a href="#">2_保留選項</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">第二階段 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">1_重修班加退選 </a></li>
                            <li class="divider" role="presentation"></li>
                            <li role="presentation"><a href="#">2_產生繳費單 </a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">第三階段 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">1_課表查詢 </a></li>
                            <li class="divider" role="presentation"></li>
                            <li role="presentation"><a href="#">2_保留選項 </a></li>
                        </ul>
                    </li>
                </ul>
                <p class="navbar-text navbar-right" id="signIn-btn" v-show="!user.gid"> Google登入</p>
                <p class="navbar-text navbar-right" id="user-profile" v-show="user.gid" :title="userInfo">{{user.email}}</p>
            </div>
        </div>
    </nav>
    <div class="header-blue">
        <div class="container hero">
            <div class="row" id="ct">
                <div class="col-lg-5 col-lg-offset-1 col-md-6 col-md-offset-0">
                    <h1>辦理梯次：{{ op_no }} 梯次 </h1>
                    <ol>
                        <li>如不參加本梯次重補修，請勾選下方「不參加」選項。 </li>
                        <li>勾選了不表示一定可以開班成功，參加人數、指導老師、時間衝堂都是關鍵。 </li>
                        <li>選擇完畢請按下方「提交」按鈕。 </li>
                    </ol>
                    <div class="checkbox" style="margin-top:20px;margin-left:40px;color:#fff;font-size:20px;">
                        <label><input type="checkbox"
                                      :checked="chkOpt_out"
                                      @click="onAttendClick($event)">
                            不參加
                        </label>
                    </div>
                    <div id="submit">
                        <button class="btn btn-default btn-lg action-button" type="button" @click="onSubmit">儲 存</button>
                    </div>
                </div>
                <div class="col-lg-5 col-lg-offset-0 col-md-6 col-md-offset-0">
                    <h2 style="color:#fff;margin-top:30px;">請選擇欲重補修科目 </h2>
                    <div class="subj-list">
                        <div class="col-md-12"
                             v-for="subj in subjects">
                            <div class="checkbox">
                                <label><input type="checkbox"
                                              v-model="selected_subj_id"
                                              :value="subj.id"
                                              :disabled="chkOpt_out">
                                    {{subj.subject}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 item text">
                        <h3>Company Name</h3>
                        <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                    </div>
                    <div class="col-md-3 col-md-pull-6 col-sm-4 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-md-pull-6 col-sm-4 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-sm-4 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">Company Name © 2016</p>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://apis.google.com/js/platform.js"></script>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="<?php echo base_url() ?>public/suv/js/utility/jquery-plugin.js"></script>
<script src="<?php echo base_url() ?>public/suv/js/main.js"></script>
<script>var base_url = '<?php echo base_url() ?>';</script>
</body>

</html>