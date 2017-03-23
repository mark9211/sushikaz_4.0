<?
# CSS files
echo $this->Html->css('assets/global/plugins/datatables/datatables.min.css');
echo $this->Html->css('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css');
echo $this->Html->css('assets/global/css/components.min.css');
# JS files
echo $this->Html->script('assets/global/scripts/datatable.js');
echo $this->Html->script('assets/global/plugins/datatables/datatables.min.js');
echo $this->Html->script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js');
# datepicker
echo $this->Html->script('jquery-ui-1.10.4.custom.js');
echo $this->Html->script('datepicker-ja.js');
# multiple-select
echo $this->Html->css('multiple-select.css');
echo $this->Html->script('multiple-select.js');

?>
<style type="text/css">
    .ui-state-active{background: #4DB2B6;}
    .ui-datepicker{width: 100%; font-family: 'Monda', sans-serif; text-align: center; background: #48C2C2; margin: 0 0 10px 0}
    .ui-datepicker a{color: #fff;}
    .ui-datepicker-calendar{width: 100%;}
    .ui-datepicker-group{margin: 0 0 10px 0;background: #48C2C2;}
    .ui-datepicker-header {color: #fff;padding: 15px;text-transform: uppercase;letter-spacing: 3px;}
    .ui-datepicker-calendar thead th{color: #fff; padding:10px;}
    .ui-datepicker-calendar th,.ui-datepicker-calendar td{font-size: 18px; color: #378F8F; text-align: center;}
    .ui-datepicker-calendar td span{display: block; padding:10px;}
    .ui-datepicker-calendar td a{color: #fff; display: block; padding:18px;}
    .ui-datepicker-title{clear: both;font-size: 18px;}
    .ui-datepicker-prev{float: left;font-size: 18px;}
    .ui-datepicker-next{float: right;font-size: 18px;}

    .page-content{padding-top:70px;}
    .page-content-inner{padding-top:10px;}
    .table-scrollable {overflow-y: scroll;}
</style>

<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="container">
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-pin font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">日付選択</span>
                                        <span class="caption-helper">予約を確認する日付をタップしてください</span>
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="<?if(isset($reserves)){echo 'expand';}else{echo 'collapse';}?>" data-original-title="" title="">
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body form" style="display: <?if(isset($reserves)){echo 'none';}else{echo 'block';}?>;">
                                    <!-- BEGIN FORM-->
                                    <form class="form-horizontal form-bordered" role="form" method="post" action="">
                                        <div class="form-body">
                                            <form action="" method="post">
                                                <div id="formBd"></div>
                                                <input id="dateData" type="hidden" name="date" value="" >
                                            </form>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN CHART PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-green-haze"></i>
                                        <span class="caption-subject bold uppercase font-green-haze"> 予約一覧</span>
                                        <span class="caption-helper">duration on value axis</span>
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="<?if(isset($reserves)){echo 'collapse';}else{echo 'expand';}?>"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body" style="display: <?if(isset($reserves)){echo 'block';}else{echo 'none';}?>;">
                                    <table class="table table-striped table-hover table-bordered" id="sample_1" style="border-bottom-color: #e7ecf1">
                                        <thead>
                                            <tr>
                                                <th> × </th>
                                                <th> 店舗 </th>
                                                <th> 日付 </th>
                                                <th> 時間 </th>
                                                <th> お名前 </th>
                                                <th> 電話番号 </th>
                                                <th> 人数 </th>
                                                <th> 卓番 </th>
                                                <th> コース </th>
                                                <th> 伝達事項 </th>
                                                <th> 備考 </th>
                                                <th> メモ </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?if(isset($reserves)&&$reserves!=null):?>
                                                <?foreach($reserves as $reserve):?>
                                                    <tr>
                                                        <td>
                                                            <?echo $this->Form->postLink('削除',array('action'=>'delete',$reserve['Reserve']['id']),array(),'このデータを削除してもいいですか');?>
                                                        </td>
                                                        <td>
                                                            <select id="associationBox">
                                                                <?$association_id=$reserve['Reserve']['association_id'];?>
                                                                <option value="" <?if($association_id==null){echo "selected";}?>>Select...</option>
                                                                <option value="3" <?if($association_id!=null&&$association_id==3){echo "selected";}?>>寿司</option>
                                                                <option value="4" <?if($association_id!=null&&$association_id==4){echo "selected";}?>>焼肉</option>
                                                            </select>
                                                            <script>
                                                                $(function() {
                                                                    $('#associationBox').change(function() {
                                                                        var association_id = $(this).val();
                                                                        var array = {"id":<?echo $reserve['Reserve']['id'];?>,"association_id":association_id};
                                                                        ajaxSend(array);
                                                                    });

                                                                    function ajaxSend(array){
                                                                        $.ajax({
                                                                            url: "<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'ajax4'));?>",
                                                                            type:'POST',
                                                                            data: array
                                                                        }).done(function(data, textStatus, jqXHR){
                                                                            console.log(data);
                                                                        }).fail(function(data, textStatus, errorThrown){
                                                                            alert(textStatus); //エラー情報を表示
                                                                            console.log(errorThrown.message); //例外情報を表示
                                                                        }).always(function(data, textStatus, returnedObject){ //以前のcompleteに相当。ajaxの通信に成功した場合はdone()と同じ、失敗した場合はfail()と同じ引数を返します。

                                                                        });
                                                                    }

                                                                });
                                                            </script>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['day'];?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['time'];?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['user_name'];?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['user_phone'];?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['c_num'];?>
                                                        </td>
                                                        <td>
                                                            <?if(isset($reserve['Reserve']['table'])):?>
                                                                <?echo $reserve['Reserve']['table'];?>
                                                            <?else:?>
                                                                <select id="ms" multiple="multiple">
                                                                    <?if(isset($table_numbers)):?>
                                                                    <?foreach($table_numbers as $table_number):?>
                                                                            <option value="<?echo $table_number['TableNumber']['id'];?>"><?echo $table_number['TableNumber']['number'];?>（<?echo $table_number['TableNumber']['max_person'];?>人）</option>
                                                                    <?endforeach;?>
                                                                    <?endif;?>
                                                                </select>
                                                                <script>
                                                                    $(function() {
                                                                        $('#ms').multipleSelect({
                                                                            width: 100,
                                                                            placeholder: "Select..."
                                                                        });
                                                                        $('#ms').change(function() {
                                                                            var table_id = $(this).val();table_id = table_id.join(',');
                                                                            var array = {"id":<?echo $reserve['Reserve']['id'];?>,"table_id":table_id};
                                                                            console.log(array);
                                                                            ajaxSend(array);
                                                                        });
                                                                        function ajaxSend(array){
                                                                            $.ajax({
                                                                                url: "<?echo $this->Html->url(array('controller'=>'reserves', 'action'=>'ajax4'));?>",
                                                                                type:'POST',
                                                                                data: array
                                                                            }).done(function(data, textStatus, jqXHR){
                                                                                console.log(data);
                                                                            }).fail(function(data, textStatus, errorThrown){
                                                                                alert(textStatus); //エラー情報を表示
                                                                                console.log(errorThrown.message); //例外情報を表示
                                                                            }).always(function(data, textStatus, returnedObject){ //以前のcompleteに相当。ajaxの通信に成功した場合はdone()と同じ、失敗した場合はfail()と同じ引数を返します。

                                                                            });
                                                                        }
                                                                    });
                                                                </script>
                                                            <?endif;?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['course_id'];?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['purpose_id'];?>
                                                        </td>
                                                        <td>
                                                            <?echo $reserve['Reserve']['others'];?>
                                                        </td>
                                                        <td>
                                                            <img src="data:image/png;base64,<?echo $reserve['Reserve']['memo'];?>">
                                                        </td>
                                                    </tr>
                                                <?endforeach;?>
                                            <?endif;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END CHART PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
    $(function() {
        //カレンダー
        $('#formBd').datepicker({
            dateFormat: "yy-mm-dd",
            onSelect: function(dateText, inst){
                var date  = dateText;
                window.location.href = '?date='+date;
            }
        });
        $('#formBd').datepicker("setDate", "<?echo $working_day;?>");
    });
</script>
<script>
    // TABLE
    var TableDatatablesButtons = function () {

        var initTable1 = function () {
            var table = $('#sample_1');

            var oTable = table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "_START_ ~ _END_ 件表示 (_TOTAL_ 件中)",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "_MENU_ 件",
                    "search": "検索:",
                    "zeroRecords": "No matching records found"
                },

                buttons: [
                    { extend: 'print', className: 'btn red btn-outline' },
                    //{ extend: 'copy', className: 'btn red btn-outline' },
                    //{ extend: 'pdf', className: 'btn green btn-outline' },
                    //{ extend: 'excel', className: 'btn yellow btn-outline ' },
                    //{ extend: 'csv', className: 'btn purple btn-outline '},
                    { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
                ],

                // setup responsive extension: http://datatables.net/extensions/responsive/
                responsive: true,

                "order": [
                    [0, 'asc']
                ],

                "lengthMenu": [
                    [10, 20, 40, 50, -1],
                    [10, 20, 40, 50, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": -1,

                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            });

        }
        var initTable2 = function () {
            var table = $('#sample_2');

            var oTable = table.dataTable({

                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "_START_ ~ _END_ 件表示 (_TOTAL_ 件中)",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "_MENU_ 件",
                    "search": "検索:",
                    "zeroRecords": "No matching records found"
                },

                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                buttons: [
                    { extend: 'print', className: 'btn default' },
                    { extend: 'copy', className: 'btn default' },
                    { extend: 'pdf', className: 'btn default' },
                    { extend: 'excel', className: 'btn default' },
                    { extend: 'csv', className: 'btn default' },
                    {
                        text: 'Reload',
                        className: 'btn default',
                        action: function ( e, dt, node, config ) {
                            //dt.ajax.reload();
                            alert('Custom Button');
                        }
                    }
                ],

                responsive: true,

                "order": [
                    [0, 'asc']
                ],

                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 20,

                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
                initTable2();
            }
        };

    }();

    jQuery(document).ready(function() {
        TableDatatablesButtons.init();

    });
</script>