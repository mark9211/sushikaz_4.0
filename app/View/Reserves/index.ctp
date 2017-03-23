<?
# <!-- BEGIN PAGE LEVEL PLUGINS -->
echo $this->Html->css('assets/global/plugins/morris/morris.css');
echo $this->Html->css('assets/global/plugins/mapplic/mapplic/mapplic.css');

# <!-- BEGIN PAGE LEVEL PLUGINS -->
echo $this->Html->script('assets/global/plugins/morris/morris.min.js');
echo $this->Html->script('assets/global/plugins/morris/raphael-min.js');
echo $this->Html->script('assets/global/plugins/mapplic/js/hammer.min.js');
echo $this->Html->script('assets/global/plugins/mapplic/js/jquery.easing.js');
echo $this->Html->script('assets/global/plugins/mapplic/js/jquery.mousewheel.js');
echo $this->Html->script('assets/global/plugins/mapplic/mapplic/mapplic.js');
echo $this->Html->script('assets/global/plugins/counterup/jquery.waypoints.min.js');
echo $this->Html->script('assets/global/plugins/counterup/jquery.counterup.min.js');
echo $this->Html->script('assets/global/plugins/jquery.sparkline.min.js');
echo $this->Html->script('assets/pages/scripts/dashboard.min.js');
# Buttons
echo $this->Html->script('assets/pages/scripts/ui-buttons.min.js');
# SideBar
echo $this->Html->script('jquery.sidebar.min.js');
# datepicker
echo $this->Html->script('jquery-ui-1.10.4.custom.js');
echo $this->Html->script('datepicker-ja.js');
# Jcanvas
echo $this->Html->script('jcanvas.min.js');
# JqueryKeypad
echo $this->Html->css('jquery.keypad.css');
echo $this->Html->script('jquery.plugin.js');
echo $this->Html->script('jquery.keypad.js');

$this->assign('reserveNum', $reserves);

?>
<style>
    .interdit {
        background: #ccc;
        pointer-events : none;
    }
    .btn {
        width:200px;
        font-size: 19px;
    }
    .largeBtn {
        width: 250px;height: 60px;
    }
    .portlet{
        margin-bottom: 10px;
    }
    .portlet-body {
        overflow: scroll;
        max-height: 450px;
    }
    .widget-comments {
        min-height: 100px;
    }
    .col-sm-2 {
        padding-left: 5px;
        padding-right: 5px;
    }
    .col-sm-3 {
        padding-left: 5px;
        padding-right: 5px;
    }
    .listDate{
        text-align: center;
        font-size: 32px;
        padding-left: 0;
        padding-right: 0;
    }
    .listDay{
        font-size: 16px;
        margin-top: 16px;
    }
    .clearfix {
        text-align: center;
    }
    .modal-body {
        padding: 0;
    }
    .ui-datepicker{
        margin: 0 !important;
    }
    .list-group-item {
        min-height: 60px;
        font-weight: 100;
    }

    .sidebar{
        position: fixed;
        color: #fff; /* 好みに応じて調節してください */
    }

    .sidebar.left {
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 100;
        width: 450px;
        height: 670px;
        opacity: 0.9;
        background: #fff;
    }

    .sidebar.right {
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 100;
        width: 450px;
        height: 670px;
        opacity: 0.9;
        background: #fff;
    }

    .sidebar.top {
        left: 0;
        right: 0;
        top: 0;
        height: 250px;
        background: orange;
    }

    .sidebar.bottom {
        left: 0;
        right: 0;
        bottom: 0;
        height: 250px;
        opacity: 0.9;
        background: #fff;
    }

    .rightToggle {
        left: 0;
        top : 88%;
        padding: 0;
        z-index: 99;
        border: none;
        outline: 0;
        position: fixed;
        margin-top: -30px;
        background: #dddd00;
        color: #fff;
        width: 70px;
        height: 60px;
        box-shadow: 0 0 2px rgba(0,0,0,.15);
    }

    .leftToggle{
        right: 0;
        top : 88%;
        padding: 0;
        z-index: 99;
        border: none;
        outline: 0;
        position: fixed;
        margin-top: -30px;
        background: #dddd00;
        color: #fff;
        width: 70px;
        height: 60px;
        box-shadow: 0 0 2px rgba(0,0,0,.15);
    }


    .ui-state-active{background: #4DB2B6;}
    .ui-datepicker{width: 100%; font-family: 'Monda', sans-serif; text-align: center; background: #48C2C2; margin: 0 0 10px 0}
    .ui-datepicker a{color: #fff;}
    .ui-datepicker-calendar{width: 100%;}
    .ui-datepicker-group{margin: 0 0 10px 0;background: #48C2C2;}
    .ui-datepicker-header {color: #fff;padding: 15px;text-transform: uppercase;letter-spacing: 5px;font-size: 18px;}
    .ui-datepicker-calendar thead th{color: #fff; padding:10px;}
    .ui-datepicker-calendar th,.ui-datepicker-calendar td{font-size: 20px; color: #378F8F; text-align: center;}
    .ui-datepicker-calendar td span{display: block; padding:10px;}
    .ui-datepicker-calendar td a{color: #fff; display: block; padding:20px;}
    .ui-datepicker-title{clear: both;}
    .ui-datepicker-prev{float: left;}
    .ui-datepicker-next{float: right;}
</style>
<?php echo $this->Form->create(false, array('type' => 'post', 'action' => '.', 'class' => 'form-horizontal')); ?>
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container page-content-inner page-container-bg-solid">
    <!-- BEGIN CONTENT -->
    <div class="container-fluid container-lf-space">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row widget-row margin-top-20">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="portlet light tasks-widget widget-comments" style="margin-bottom: 0;">
                    <div class="portlet-title">
                        <div class="caption caption-md font-red-sunglo">
                            <span class="caption-subject theme-font bold uppercase"> 日付</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="list-group" id="dateList">
                            <?foreach($date_arr as $date):?>
                                <a href="javascript:;" class="list-group-item">
                                    <div class="col-md-10 col-sm-10 col-xs-10 listDate">
                                        <p class="list-group-item-heading"><?echo date('m/d', strtotime($date));?></p>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 listDay">
                                        <p class="list-group-item-text"><?echo $weekday[date('w', strtotime($date))];?></p>
                                        <p class="pNone" style="display:none;"><?echo date('Y-m-d', strtotime($date));?></p>
                                    </div>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="portlet light tasks-widget widget-comments">
                    <div class="portlet-title">
                        <div class="caption caption-md font-blue">
                            <span class="caption-subject theme-font bold uppercase"> 時間</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="list-group" id="timeList">
                            <?foreach($time_arr as $key => $time):?>
                                <a href="javascript:;" class="list-group-item setChoose">
                                    <div class="col-md-12 col-sm-12 col-xs-12 listDate">
                                        <p class="list-group-item-heading"><?echo $time;?></p>
                                        <p class="pNone" style="display:none;"><?echo $time;?></p>
                                    </div>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="portlet light tasks-widget widget-comments">
                    <div class="portlet-title">
                        <div class="caption caption-md font-green">
                            <span class="caption-subject theme-font bold uppercase"> 人数</span>
                            <input id="defaultKeypad" type="text" style="width: 50px;">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="list-group" id="listCusNum">
                            <?for($i=1;$i<=30;$i++):?>
                                <a href="javascript:;" class="list-group-item">
                                    <div class="col-md-10 col-sm-10 col-xs-10 listDate">
                                        <p class="list-group-item-heading"><?echo $i;?></p>
                                        <p class="pNone" style="display:none;"><?echo $i;?></p>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 listDay">
                                        <p class="list-group-item-text">人</p>
                                    </div>
                                </a>
                            <?endfor;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="portlet light tasks-widget widget-comments margin-bottom-10">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <span class="caption-subject theme-font bold uppercase"> 寿司/焼肉</span>
                        </div>
                    </div>
                    <div class="portlet-body" style="max-height: 100px;">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="checkbox" class="make-switch" checked data-on-text="寿司" data-off-text="焼肉" data-off-color="primary" id="switchStore" name="type">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet light tasks-widget widget-comments">
                    <div class="portlet-title">
                        <div class="caption caption-md font-purple">
                            <span class="caption-subject theme-font bold uppercase"> 卓番</span>
                        </div>
                    </div>
                    <div class="portlet-body" style="max-height: 300px;">
                        <div class="list-group" id="tableList">
                            <?foreach($table_numbers[0] as $key => $table_number):?>
                                <a href="javascript:;" class="list-group-item multiChoose on <?echo "dS".$table_number['TableNumber']['id'];?>">
                                    <div class="col-md-6 col-sm-6 col-xs-6 listDate">
                                        <p class="list-group-item-heading"><?echo $table_number['TableNumber']['number'];?></p>
                                        <p class="pNone" style="display:none;"><?echo $table_number['TableNumber']['id'];?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 listDay" style="padding: 0;">
                                        <p class="list-group-item-text">(<?echo $table_number['TableNumber']['max_person'];?>名)</p>
                                    </div>
                                </a>
                            <?endforeach;?>
                            <?foreach($table_numbers[1] as $key => $table_number):?>
                                <a href="javascript:;" class="list-group-item multiChoose off <?echo "dS".$table_number['TableNumber']['id'];?>" style="display: none;">
                                    <div class="col-md-6 col-sm-6 col-xs-6 listDate">
                                        <p class="list-group-item-heading"><?echo $table_number['TableNumber']['number'];?></p>
                                        <p class="pNone" style="display:none;"><?echo $table_number['TableNumber']['id'];?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 listDay" style="padding: 0;">
                                        <p class="list-group-item-text">(<?echo $table_number['TableNumber']['max_person'];?>名)</p>
                                    </div>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="portlet light tasks-widget widget-comments margin-bottom-10">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <span class="caption-subject theme-font bold uppercase"> 伝達事項</span>
                        </div>
                    </div>
                    <div class="portlet-body" style="max-height: 138px;">
                        <div class="list-group" id="purposeList">
                            <a href="javascript:;" class="list-group-item">
                                <p class="list-group-item-heading">事前確認</p>
                                <p class="pNone" style="display:none;">事前確認</p>
                            </a>
                            <a href="javascript:;" class="list-group-item">
                                <p class="list-group-item-heading">仮予約</p>
                                <p class="pNone" style="display:none;">仮予約</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet light tasks-widget widget-comments margin-bottom-10">
                    <div class="portlet-title">
                        <div class="caption caption-md font-yellow">
                            <span class="caption-subject theme-font bold uppercase"> コース</span>
                        </div>
                    </div>
                    <div class="portlet-body" style="max-height: 220px;">
                        <div class="list-group" id="courseList">
                            <?foreach($party_types[0] as $key => $party_type):?>
                                <a href="javascript:;" class="list-group-item on">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <p class="list-group-item-heading"><?echo $party_type['PartyType']['name'];?></p>
                                        <p class="pNone" style="display:none;"><?echo $party_type['PartyType']['id'];?></p>
                                    </div>
                                </a>
                            <?endforeach;?>
                            <?foreach($party_types[1] as $key => $party_type):?>
                                <a href="javascript:;" class="list-group-item off" style="display:none;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <p class="list-group-item-heading"><?echo $party_type['PartyType']['name'];?></p>
                                        <p class="pNone" style="display:none;"><?echo $party_type['PartyType']['id'];?></p>
                                    </div>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row widget-row">
            <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
                <p style="margin: 0;">
                    <a href="#form_modal2" class="btn dropdown-toggle" data-toggle="modal" style="width: 33%;">
                        <button type="button" class="btn blue largeBtn">カレンダー</button>
                    </a>
                    <a href="#form_modal5" class="btn dropdown-toggle" data-toggle="modal" style="width: 33%;">
                        <button type="button" class="btn green largeBtn">メモ</button>
                    </a>
                    <a href="#form_modal3" class="btn dropdown-toggle" data-toggle="modal" style="width: 33%;">
                        <button type="button" class="btn red largeBtn">次へ</button>
                    </a>
                </p>
            </div>
        </div>

        <div id="form_modal2" class="modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="formBd"></div>
                        <script>
                            $(function() {
                                //カレンダー
                                $('#formBd').datepicker({
                                    dateFormat: "yy-mm-dd",
                                    minDate: new Date(),
                                    onSelect: function(dateText, inst){
                                        //var array = {0:dateText};ajaxSend(array);
                                        var date  = dateText;
                                        window.location.href = '?date='+date;
                                    }
                                });
                                $('#formBd').datepicker("setDate", "<?echo $working_day;?>");

                                function ajaxSend(array){
                                    $.ajax({
                                        url: "<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'ajax'));?>",
                                        type:'POST',
                                        data: array
                                    }).done(function(data, textStatus, jqXHR){
                                        var obj = jQuery.parseJSON(data);
                                        $("#dateList").empty();
                                        if(obj.length!=0){
                                            $.each(obj, function(i, value) {
                                                var newDate = new Date(value);
                                                var month = add0(newDate.getMonth()+1);var date = add0(newDate.getDate());var weekDayJP = ["日","月","火","水","木","金","土"] ;var day = weekDayJP[newDate.getDay()] ;
                                                if(i==0){
                                                    $("#dateList").append('<a href="javascript:;" class="list-group-item active"><div class="col-md-10 col-sm-10 col-xs-10 listDate"> <p class="list-group-item-heading">'+month+'/'+date+'</p> </div> <div class="col-md-2 col-sm-2 col-xs-2 listDay"> <p class="list-group-item-text">'+day+'</p> <p class="pNone" style="display:none;">'+value+'</p></div> </a>');
                                                }else{
                                                    $("#dateList").append('<a href="javascript:;" class="list-group-item"><div class="col-md-10 col-sm-10 col-xs-10 listDate"> <p class="list-group-item-heading">'+month+'/'+date+'</p> </div> <div class="col-md-2 col-sm-2 col-xs-2 listDay"> <p class="list-group-item-text">'+day+'</p> <p class="pNone" style="display:none;">'+value+'</p></div> </a>');
                                                }
                                            });
                                            // 時間・人数・卓番・コース・利用目的リセット
                                            $("#timeList").find(".active").removeClass("active");$("#listCusNum").find(".active").removeClass("active");
                                            $("#tableList").find(".active").removeClass("active");$("#courseList").find(".active").removeClass("active");$("#purposeList").find(".active").removeClass("active");
                                            // カレンダー閉じる
                                            $("#calenderClose").click();
                                        }
                                    }).fail(function(data, textStatus, errorThrown){
                                        alert(textStatus); //エラー情報を表示
                                        console.log(errorThrown.message); //例外情報を表示
                                    }).always(function(data, textStatus, returnedObject){ //以前のcompleteに相当。ajaxの通信に成功した場合はdone()と同じ、失敗した場合はfail()と同じ引数を返します。
                                        // alert(textStatus);
                                    });
                                }

                                function add0(str){
                                    return ( "0" + str ).substr( -2 );
                                }

                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-12 col-sm-12" style="text-align: center;">
                                <button type="button" class="btn grey-mint" class="close" data-dismiss="modal" aria-hidden="true" id="calenderClose">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="form_modal3" class="modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">顧客情報</h4>
                    </div>
                    <div class="modal-body" style="padding: 30px;">

                            <div class="form-group">
                                <label class="col-md-2 control-label">お名前</label>
                                <div class="col-md-6">
                                    <div class="input-icon right">
                                        <i class="fa fa-user"></i>
                                        <input type="text" class="form-control" placeholder="例）サトウ マアク" value="" name="user_name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">電話番号</label>
                                <div class="col-md-6">
                                    <div class="input-icon right">
                                        <i class="fa fa-phone"></i>
                                        <input type="tel" class="form-control" placeholder="例）08010838348" value="" name="user_phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">備考</label>
                                <div class="col-md-6">
                                    <textarea class="form-control autosizeme" rows="8" name="others"></textarea>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-6" style="text-align: center;">
                                <button type="button" class="btn grey-mint" class="close" data-dismiss="modal" aria-hidden="true" id="clientModalClose">閉じる</button>
                            </div>
                            <div class="col-md-6 col-sm-6" style="text-align: center;">
                                <a href="#form_modal4" class="btn dropdown-toggle" data-toggle="modal">
                                    <button type="button" class="btn red" id="goSelectMember">次へ</button>
                                </a>
                            </div>
                            <script>
                                $(function() {
                                    $("#goSelectMember").click(function () {
                                        // ModalHide
                                        $("#clientModalClose").click();
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="form_modal4" class="modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">担当者設定</h4>
                    </div>
                    <div class="modal-body">
                        <div class="portlet light tasks-widget widget-comments">
                            <div class="portlet-title" style="border-bottom: 0;margin-bottom: 0;">
                                <div class="caption caption-md font-grey-cascade">
                                    <span class="caption-subject theme-font bold uppercase"> 予約担当者を選択してください</span>
                                </div>
                            </div>
                            <div class="portlet-body" style="max-height: 250px;">
                                <div class="list-group" id="memberList">
                                    <?foreach($members as $key => $member):?>
                                        <?if($member['Type']['name']=='アルバイト'):?>
                                        <a href="javascript:;" class="list-group-item <?if($key==0){echo "active";}?>">
                                            <h4 class="list-group-item-heading"><?echo $member['Member']['name'];?></h4>
                                            <p class="pNone" style="display:none;"><?echo $member['Member']['id'];?></p>
                                        </a>
                                        <?endif;?>
                                    <?endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-6" style="text-align: center;">
                                <button type="button" class="btn grey-mint" class="close" data-dismiss="modal" aria-hidden="true">戻る</button>
                            </div>
                            <div class="col-md-6 col-sm-6" style="text-align: center;">
                                <button type="submit" class="btn red">確定</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="form_modal5" class="modal" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="background: #fff;">
                <div class="modal-header">
                    <button id="memoClose" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">メモ書き</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet light tasks-widget widget-comments">
                        <div class="portlet-body" style="max-height: 500px;">
                            <canvas id="note" width="550" height="400" style="cursor: auto;border: 1px #000 solid;"></canvas>
                            <input type="hidden" name="memo" value="" id="memo">
                            <div id="item" style="">
                                <div id="item1">
                                    <p>線の太さ<input type="range" min="0" max="100" value="5" id="lineWidth"><span id="lineNum">5</span></p>
                                    <p>透 明 度<input type="range" min="0" max="100" value="100" id="alpha"><span id="alphaNum">100</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4 col-sm-4" style="text-align: center;">
                            <button style="max-width: 150px;" type="button" class="btn grey-mint" id="undo">１つ戻る</button>
                        </div>
                        <div class="col-md-4 col-sm-4" style="text-align: center;">
                            <button style="max-width: 150px;" type="button" class="btn blue" id="clear">消去</button>
                        </div>
                        <div class="col-md-4 col-sm-4" style="text-align: center;">
                            <button style="max-width: 150px;" type="button" class="btn red" onclick="save()">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php echo $this->Form->end(); ?>
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler">
    <i class="icon-login"></i>
</a>
<div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
    <div class="page-quick-sidebar">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                    <span class="badge badge-danger">2</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alerts
                    <span class="badge badge-success">7</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-bell"></i> Alerts </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-info"></i> Notifications </a>
                    </li>
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-speech"></i> Activities </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                            <i class="icon-settings"></i> Settings </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                    <h3 class="list-heading">Staff</h3>
                    <ul class="media-list list-items">
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-success">8</span>
                            </div>
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Bob Nilson</h4>
                                <div class="media-heading-sub"> Project Manager </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Nick Larson</h4>
                                <div class="media-heading-sub"> Art Director </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-danger">3</span>
                            </div>
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Deon Hubert</h4>
                                <div class="media-heading-sub"> CTO </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Ella Wong</h4>
                                <div class="media-heading-sub"> CEO </div>
                            </div>
                        </li>
                    </ul>
                    <h3 class="list-heading">Customers</h3>
                    <ul class="media-list list-items">
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-warning">2</span>
                            </div>
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Lara Kunis</h4>
                                <div class="media-heading-sub"> CEO, Loop Inc </div>
                                <div class="media-heading-small"> Last seen 03:10 AM </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="label label-sm label-success">new</span>
                            </div>
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Ernie Kyllonen</h4>
                                <div class="media-heading-sub"> Project Manager,
                                    <br> SmartBizz PTL </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Lisa Stone</h4>
                                <div class="media-heading-sub"> CTO, Keort Inc </div>
                                <div class="media-heading-small"> Last seen 13:10 PM </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-success">7</span>
                            </div>
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Deon Portalatin</h4>
                                <div class="media-heading-sub"> CFO, H&D LTD </div>
                            </div>
                        </li>
                        <li class="media">
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Irina Savikova</h4>
                                <div class="media-heading-sub"> CEO, Tizda Motors Inc </div>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-status">
                                <span class="badge badge-danger">4</span>
                            </div>
                            <img class="media-object" src="" alt="...">
                            <div class="media-body">
                                <h4 class="media-heading">Maria Gomez</h4>
                                <div class="media-heading-sub"> Manager, Infomatic Inc </div>
                                <div class="media-heading-small"> Last seen 03:10 AM </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="page-quick-sidebar-item">
                    <div class="page-quick-sidebar-chat-user">
                        <div class="page-quick-sidebar-nav">
                            <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                <i class="icon-arrow-left"></i>Back</a>
                        </div>
                        <div class="page-quick-sidebar-chat-user-messages">
                            <div class="post out">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> When could you send me the report ? </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> Its almost done. I will be sending it shortly </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:15</span>
                                    <span class="body"> Alright. Thanks! :) </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:16</span>
                                    <span class="body"> You are most welcome. Sorry for the delay. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:17</span>
                                    <span class="body"> No probs. Just take your time :) </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:40</span>
                                    <span class="body"> Alright. I just emailed it to you. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:17</span>
                                    <span class="body"> Great! Thanks. Will check it right away. </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Ella Wong</a>
                                    <span class="datetime">20:40</span>
                                    <span class="body"> Please let me know if you have any comment. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="" />
                                <div class="message">
                                    <span class="arrow"></span>
                                    <a href="javascript:;" class="name">Bob Nilson</a>
                                    <span class="datetime">20:17</span>
                                    <span class="body"> Sure. I will check and buzz you if anything needs to be corrected. </span>
                                </div>
                            </div>
                        </div>
                        <div class="page-quick-sidebar-chat-user-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type a message here...">
                                <div class="input-group-btn">
                                    <button type="button" class="btn green">
                                        <i class="icon-paper-clip"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                <div class="page-quick-sidebar-alerts-list">
                    <h3 class="list-heading">General</h3>
                    <ul class="feeds list-items">
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 4 pending tasks.
                                                    <span class="label label-sm label-warning "> Take action
                                                        <i class="fa fa-share"></i>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> Just now </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> Finance Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-danger">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> New order received with
                                            <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 30 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-success">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> Web server hardware needs to be upgraded.
                                            <span class="label label-sm label-warning"> Overdue </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 2 hours </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-default">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> IPO Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <h3 class="list-heading">System</h3>
                    <ul class="feeds list-items">
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 4 pending tasks.
                                                    <span class="label label-sm label-warning "> Take action
                                                        <i class="fa fa-share"></i>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> Just now </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-danger">
                                                <i class="fa fa-bar-chart-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> Finance Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> New order received with
                                            <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 30 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-success">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> You have 5 pending membership that requires a quick review. </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 24 mins </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-warning">
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> Web server hardware needs to be upgraded.
                                            <span class="label label-sm label-default "> Overdue </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 2 hours </div>
                            </div>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> IPO Report for year 2013 has been released. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date"> 20 mins </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                <div class="page-quick-sidebar-settings-list">
                    <h3 class="list-heading">General Settings</h3>
                    <ul class="list-items borderless">
                        <li> Enable Notifications
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Allow Tracking
                            <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Log Errors
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Auto Sumbit Issues
                            <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Enable SMS Alerts
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                    </ul>
                    <h3 class="list-heading">System Settings</h3>
                    <ul class="list-items borderless">
                        <li> Security Level
                            <select class="form-control input-inline input-sm input-small">
                                <option value="1">Normal</option>
                                <option value="2" selected>Medium</option>
                                <option value="e">High</option>
                            </select>
                        </li>
                        <li> Failed Email Attempts
                            <input class="form-control input-inline input-sm input-small" value="5" /> </li>
                        <li> Secondary SMTP Port
                            <input class="form-control input-inline input-sm input-small" value="3560" /> </li>
                        <li> Notify On System Error
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                        <li> Notify On SMTP Error
                            <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>
                    </ul>
                    <div class="inner-content">
                        <button class="btn btn-success">
                            <i class="icon-settings"></i> Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END QUICK SIDEBAR -->
<!-- BEGIN QUICK SIDEBAR TOGGLER -->
<!--
<button type="button" class="quick-sidebar-toggler" data-toggle="collapse">
    <span class="sr-only">Toggle Quick Sidebar</span>
    <i class="icon-logout"></i>
    <div class="quick-sidebar-notification">
        <span class="badge badge-danger">7</span>
    </div>
</button>
-->
<!-- END QUICK SIDEBAR TOGGLER -->
<div class="sidebar right">
    <canvas id="seat" width="448" height="600" style="cursor: auto;border: 1px #000 solid;margin-top: 70px;"></canvas>
</div>
<a href="#" class="btn" data-action="toggle" data-side="right">
    <button type="button" class="rightToggle">
        【寿司】
    </button>
</a>

<div class="sidebar left">
    左サイドバー
</div>
<a href="#" class="btn" data-action="toggle" data-side="left">
    <button type="button" class="leftToggle">
        【焼肉】
    </button>
</a>

<!--
<div class="sidebar top">上</div>
<div class="sidebar bottom">下</div>
-->
<!--
<a href="#" class="btn" data-action="toggle" data-side="bottom">
    <button type="button" class="bottomToggle">
        <i class="icon-logout"></i>
    </button>
</a>
-->
<script>
    // SideBar
    $(document).ready(function () {
        // 向き
        var sides = ["left", "top", "right", "bottom"];

        // サイドバーの初期化
        for (var i = 0; i < sides.length; ++i) {
            var cSide = sides[i];
            $(".sidebar." + cSide).sidebar({side: cSide});
        }

        // ボタンのクリックにより...
        $(".btn[data-action]").on("click", function () {
            var $this = $(this);
            var action = $this.attr("data-action");
            var side = $this.attr("data-side");
            $(".sidebar." + side).trigger("sidebar:" + action);
            return false;
        });
    });

    // ListClickFunc
    listClickFunc();

    function listClickFunc(){
        $(".list-group-item").click(function(){
            var id = $(this).parent().attr("id");
            if(!$(this).hasClass("active")){
                /*複数選択以外*/
                if(!$(this).hasClass("multiChoose")){
                    $(this).parent().find(".active").removeClass("active");
                    /*セットの場合*/
                    if($(this).hasClass("setChoose")){
                        $(this).next().addClass("active");
                        $(this).next().next().addClass("active");
                        $(this).next().next().next().addClass("active");
                        //$(this).next().next().next().next().addClass("active");
                    }
                    /*日付の場合*/
                    if(id=="dateList"){
                        // 時間・人数・卓番・コース・利用目的リセット
                        $("#timeList").find(".active").removeClass("active");$("#listCusNum").find(".active").removeClass("active");
                        $("#tableList").find(".active").removeClass("active");$("#courseList").find(".active").removeClass("active");$("#purposeList").find(".active").removeClass("active");
                        // 卓番制御リセット
                        $("#tableList").find(".interdit").removeClass("interdit");
                    }
                }
                $(this).addClass("active");
                /*卓番制御*/
                if(id=="timeList"){
                    var date = $("#dateList").find(".active").find("input").val();
                    var time = $("#timeList").find(".active");
                    var array = { 0:date };var c = 1;
                    $.each(time, function(i, value) {
                        var r = $(value).find(".list-group-item-heading").html();
                        array[c] = r;
                        c++;
                    });
                    //console.log(array);
                    $.ajax({
                        url: "<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'ajax2'));?>",
                        type:'POST',
                        data: array
                    }).done(function(data, textStatus, jqXHR){
                        // リセット
                        $("#tableList").find(".interdit").removeClass("interdit");
                        if(data!=0){
                            var obj = jQuery.parseJSON(data);//console.log(obj);
                            $.each(obj, function(i, value) {
                                $("#tableList").find(".dS"+value).addClass("interdit");
                            });
                        }
                    }).fail(function(data, textStatus, errorThrown){
                        alert(textStatus); //エラー情報を表示
                        // console.log(errorThrown.message); //例外情報を表示
                    }).always(function(data, textStatus, returnedObject){ //以前のcompleteに相当。ajaxの通信に成功した場合はdone()と同じ、失敗した場合はfail()と同じ引数を返します。
                        //alert(textStatus);
                    });
                }
            }else{
                /*時間以外*/
                if(!$(this).hasClass("setChoose")){
                    $(this).removeClass("active");
                }else{
                    $("#timeList").find(".active").removeClass("active");
                }
            }
        });
    }

    inputSetValue();

    function inputSetValue(){
        $(".list-group-item").click(function(){
            // inputリセット
            var input = $(this).parent().find("input");
            if(input.length!=0){
                input.each(function(){
                    $(this).remove();
                });
            }
            var id = $(this).parent().attr("id");
            var active = $(this).parent().find(".active");
            if(active.length!=0){
                active.each(function(){
                    var value = $(this).find(".pNone").html();
                    $(this).append('<input type="hidden" name="'+id+'[]" value="'+value+'">');
                });
            }

        });
    }

    //JqueryKeypad
    jqueryKeypadFunc();

    function jqueryKeypadFunc(){
        $('#defaultKeypad').keypad();
    }

    //Keypad変更時
    $('#defaultKeypad').change(function(){
        var value = $(this).val();
        $("#listCusNum").find(".list-group-item-heading").each(function(){
            var html = $(this).html();
            if(html==value){
                var a = $(this).parent().parent();
                if(!a.hasClass("active")){
                    a.parent().find(".active").removeClass("active");
                    a.addClass("active");
                }
            }
        });
    });

    //寿司/焼肉切り替え
    $("#switchStore").on('switchChange.bootstrapSwitch', function (event, state) {
        // activeリセット
        $("#tableList").find('.active').removeClass('active');
        $("#courseList").find('.active').removeClass('active');
        if(state==true){
            // tableList
            var input = $("#tableList").find('.off > input');
            if(input.length!=0){
                input.each(function(){
                    $(this).remove();
                });
            }
            $("#tableList").find('.off').css('display', 'none');$("#tableList").find('.on').css('display', 'block');
            // courseList
            var input = $("#courseList").find('.off > input');
            if(input.length!=0){
                input.each(function(){
                    $(this).remove();
                });
            }
            $("#courseList").find('.off').css('display', 'none');$("#courseList").find('.on').css('display', 'block');
        }else{
            // tableList
            var input = $("#tableList").find('.on > input');
            if(input.length!=0){
                input.each(function(){
                    $(this).remove();
                });
            }
            $("#tableList").find('.on').css('display', 'none');$("#tableList").find('.off').css('display', 'block');
            // courseList
            var input = $("#courseList").find('.on > input');
            if(input.length!=0){
                input.each(function(){
                    $(this).remove();
                });
            }
            $("#courseList").find('.on').css('display', 'none');$("#courseList").find('.off').css('display', 'block');
        }

    });

    // Jcanvas
    /*
    var num = 25;
    for(var i=50;i<=290;i+=80){
        $("#seat").drawRect({
            layer: true,
            fillStyle:"rgb( 255,255,255 )",
            strokeStyle: '#000',
            strokeWidth: 2,
            x: i, y: 560,
            width: 60,
            height: 60,
            click: function(layer) {
                console.log(layer);
                if(layer.fillStyle=='rgb( 255,255,255 )'){
                    $(this).animateLayer(layer, {
                        fillStyle: '#337ab7'
                    }, 500);
                }else{
                    $(this).animateLayer(layer, {
                        fillStyle: '#fff'
                    }, 500);
                }
            }
        }).drawText({
            layer: true,
            fillStyle: '#000',
            strokeStyle: '#000',
            strokeWidth: 1,
            x: i, y: 560,
            fontSize: 26,
            fontFamily: 'Verdana, sans-serif',
            text: num
        });
        num+=1;
    }

    num = 29;
    $("#seat").drawRect({
        layer: true,
        fillStyle:"rgb( 255,255,255 )",
        strokeStyle: '#000',
        strokeWidth: 2,
        x: 410, y: 430,
        width: 60,
        height: 90,
        click: function(layer) {
            console.log(layer);
            if(layer.fillStyle=='rgb( 255,255,255 )'){
                $(this).animateLayer(layer, {
                    fillStyle: '#337ab7'
                }, 500);
            }else{
                $(this).animateLayer(layer, {
                    fillStyle: '#fff'
                }, 500);
            }
        }
    }).drawText({
        layer: true,
        fillStyle: '#000',
        strokeStyle: '#000',
        strokeWidth: 1,
        x: 410, y: 430,
        fontSize: 24,
        fontFamily: 'Verdana, sans-serif',
        text: num
    });

    num = 31;
    for(var i=200;i<=300;i+=100) {
        $("#seat").drawRect({
            layer: true,
            fillStyle:"rgb( 255,255,255 )",
            strokeStyle: '#000',
            strokeWidth: 2,
            x: 410, y: i,
            width: 60,
            height: 60,
            click: function(layer) {
                console.log(layer);
                if(layer.fillStyle=='rgb( 255,255,255 )'){
                    $(this).animateLayer(layer, {
                        fillStyle: '#337ab7'
                    }, 500);
                }else{
                    $(this).animateLayer(layer, {
                        fillStyle: '#fff'
                    }, 500);
                }
            }
        }).drawText({
            layer: true,
            fillStyle: '#000',
            strokeStyle: '#000',
            strokeWidth: 1,
            x: 410, y: i,
            fontSize: 24,
            fontFamily: 'Verdana, sans-serif',
            text: num
        });
        num--;
    }

    num = 4;
    for(var i=50;i<=410;i+=60) {
        $("#seat").drawRect({
            layer: true,
            fillStyle:"rgb( 255,255,255 )",
            strokeStyle: '#000',
            strokeWidth: 2,
            x: 325, y: i,
            width: 50,
            height: 50,
            cornerRadius: 10,
            click: function(layer) {
                console.log(layer);
                if(layer.fillStyle=='rgb( 255,255,255 )'){
                    $(this).animateLayer(layer, {
                        fillStyle: '#337ab7'
                    }, 500);
                }else{
                    $(this).animateLayer(layer, {
                        fillStyle: '#fff'
                    }, 500);
                }
            }
        }).drawText({
            layer: true,
            fillStyle: '#000',
            strokeStyle: '#000',
            strokeWidth: 1,
            x: 325, y: i,
            fontSize: 24,
            fontFamily: 'Verdana, sans-serif',
            text: num
        });
        num++;
    }

    num = 15
    for(var i=75;i<=315;i+=60) {
        $("#seat").drawRect({
            layer: true,
            fillStyle:"rgb( 255,255,255 )",
            strokeStyle: '#000',
            strokeWidth: 2,
            x: i, y: 475,
            width: 50,
            height: 50,
            cornerRadius: 10,
            click: function(layer) {
                console.log(layer);
                if(layer.fillStyle=='rgb( 255,255,255 )'){
                    $(this).animateLayer(layer, {
                        fillStyle: '#337ab7'
                    }, 500);
                }else{
                    $(this).animateLayer(layer, {
                        fillStyle: '#fff'
                    }, 500);
                }
            }
        }).drawText({
            layer: true,
            fillStyle: '#000',
            strokeStyle: '#000',
            strokeWidth: 1,
            x: i, y: 475,
            fontSize: 24,
            fontFamily: 'Verdana, sans-serif',
            text: num
        });
        num--;
    }

    num = 21;
    for(var i=110;i<=410;i+=60) {
        $("#seat").drawRect({
            layer: true,
            fillStyle:"rgb( 255,255,255 )",
            strokeStyle: '#000',
            strokeWidth: 2,
            x: 50, y: i,
            width: 50,
            height: 50,
            cornerRadius: 10,
            click: function(layer) {
                console.log(layer);
                if(layer.fillStyle=='rgb( 255,255,255 )'){
                    $(this).animateLayer(layer, {
                        fillStyle: '#337ab7'
                    }, 500);
                }else{
                    $(this).animateLayer(layer, {
                        fillStyle: '#fff'
                    }, 500);
                }
            }
        }).drawText({
            layer: true,
            fillStyle: '#000',
            strokeStyle: '#000',
            strokeWidth: 1,
            x: 50, y: i,
            fontSize: 24,
            fontFamily: 'Verdana, sans-serif',
            text: num
        });
        num--;
    }
    */

    //Jnote
    var canvas = document.getElementById("note");
    var ctx = canvas.getContext("2d");
    var mouse = {x:0,y:0,x1:0,y1:0,color:"black"};
    var draw = false;

    canvas.addEventListener("mousemove",function(e) {
        var rect = e.target.getBoundingClientRect();
        ctx.lineWidth = document.getElementById("lineWidth").value;
        ctx.globalAlpha = document.getElementById("alpha").value/100;

        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;
        //クリック状態なら描画をする
        if(draw === true) {
            ctx.beginPath();
            ctx.moveTo(mouseX1,mouseY1);
            ctx.lineTo(mouseX,mouseY);
            ctx.lineCap = "round";
            ctx.stroke();
            mouseX1 = mouseX;
            mouseY1 = mouseY;
        }
    });

    //クリックしたら描画をOKの状態にする
    canvas.addEventListener("mousedown",function(e) {
        draw = true;
        mouseX1 = mouseX;
        mouseY1 = mouseY;
        undoImage = ctx.getImageData(0, 0,canvas.width,canvas.height);
    });

    //クリックを離したら、描画を終了する
    canvas.addEventListener("mouseup", function(e){
        draw = false;
    });

    //線の太さの値を変える
    lineWidth.addEventListener("mousemove",function(){
        var lineNum = document.getElementById("lineWidth").value;
        document.getElementById("lineNum").innerHTML = lineNum;
    });

    //透明度の値を変える
    alpha.addEventListener("mousemove",function(){
        var alphaNum = document.getElementById("alpha").value;
        document.getElementById("alphaNum").innerHTML = alphaNum;
    });

    //色を選択
    $('li').click(function() {
        ctx.strokeStyle = $(this).css('background-color');
    });

    //消去ボタンを起動する
    $('#clear').click(function(e) {
        if(!confirm('本当に消去しますか？')) return;
        e.preventDefault();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    //戻るボタンを配置
    $('#undo').click(function(e) {
        ctx.putImageData(undoImage,0,0);
    });


    //保存する
    function save(){
        var can = canvas.toDataURL("image/png");
        can = can.replace("image/png", "image/octet-stream");
        //window.open(can,"save");
        //不要な情報を取り除く
        can = can.replace("data:image/octet-stream;base64,", "");//console.log(can);
        $("#memo").val(can);
        $("#memoClose").click();
    }


</script>