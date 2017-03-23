<?
class ReservesController extends AppController {

    # フォームヘルパー
    public $helpers = array('Html', 'Form');
    #Cookieの使用
    var $components = array('Cookie');

    # 共通スクリプト
    public function beforeFilter() {
        # ページタイトル設定
        parent::beforeFilter();
        $this->set('title_for_layout', '予約情報入力');
        # 使用モデル
        $this->loadModel("Association");
        $this->loadModel("TableNumber");
        $this->loadModel("PartyType");
        $this->loadModel("Member");
        $this->loadModel("Reserve");
        $this->loadModel("Mail");
    }

    # Top
    public function index(){
        if($this->request->is('post')){
            //debug($this->request->data);exit;
            # 営業日
            if(!isset($this->request->data['dateList'])){
                $this->Session->setFlash('営業日が選択されていません。','flash_error');
                $this->redirect(array('action'=>'index'));
            }else{
                $working_day=implode(",", $this->request->data['dateList']);
            }
            # 時間
            if(!isset($this->request->data['timeList'])){
                $this->Session->setFlash('時間が選択されていません。','flash_error');
                $this->redirect(array('action'=>'index'));
            }else{
                $time=implode(",", $this->request->data['timeList']);
            }
            # 客数
            if(!isset($this->request->data['listCusNum'])){
                $this->Session->setFlash('客数が選択されていません。','flash_error');
                $this->redirect(array('action'=>'index'));
            }else{
                $c_num=implode(",", $this->request->data['listCusNum']);
            }
            # 卓番
            if(!isset($this->request->data['tableList'])){
                $this->Session->setFlash('卓番が選択されていません。','flash_error');
                $this->redirect(array('action'=>'index'));
            }else{
                $table_id=implode(",", $this->request->data['tableList']);
            }
            # 従業員
            if(!isset($this->request->data['memberList'])){
                $this->Session->setFlash('従業員が選択されていません。','flash_error');
                $this->redirect(array('action'=>'index'));
            }else{
                $member_id=implode(",", $this->request->data['memberList']);
            }
            # 寿司/焼肉
            if(!isset($this->request->data['type'])){
                $association_id=4;
            }else{
                $association_id=3;
            }
            # 氏名
            if(isset($this->request->data['user_name'])){
                $user_name=$this->request->data['user_name'];
            }else{
                $user_name="";
            }
            # 電話番号
            if(isset($this->request->data['user_phone'])){
                $user_phone=$this->request->data['user_phone'];
            }else{
                $user_phone="";
            }
            # コース
            if(isset($this->request->data['courseList'])){
                $course_id=implode(",", $this->request->data['courseList']);
            }else{
                $course_id="";
            }
            # 利用目的
            if(isset($this->request->data['purposeList'])){
                $purpose_id=implode(",", $this->request->data['purposeList']);
            }else{
                $purpose_id="";
            }
            # メモ
            if(isset($this->request->data['memo'])){
                $memo = $this->request->data['memo'];
            }else{
                $memo = "";
            }
            # 備考
            if(isset($this->request->data['others'])){
                $others = $this->request->data['others'];
            }else{
                $others = "";
            }
            $data = array('Reserve' => array(
                'association_id' => $association_id,
                'day' => $working_day,
                'time' => $time,
                'c_num' => $c_num,
                'table_id' => $table_id,
                'course_id' => $course_id,
                'purpose_id' => $purpose_id,
                'member_id' => $member_id,
                'user_name' => $user_name,
                'user_phone' => $user_phone,
                'memo' => $memo,
                'others' => $others
            ));
            if($this->Reserve->save($data)){
                $this->Session->setFlash('予約が確定しました！','flash_success');
                $this->redirect(array('action'=>'index'));
            }
        }
        else{
            # 日付
            if(isset($this->params['url']['date'])){
                $working_day=$this->params['url']['date'];
            }
            else{
                $working_day = date('Y-m-d');
            }
            $this->set('working_day', $working_day);
            $weekday = array("日", "月", "火", "水", "木", "金", "土");
            $this->set('weekday', $weekday);
            # 本日から一週間分取得
            $date_arr = array();
            $date_arr[] = $working_day;
            for($i=1;$i<=7;$i++){
                $date_arr[] = date('Y-m-d', strtotime("$working_day +$i day"));
            };
            $this->set('date_arr', $date_arr);

            # 時間
            $hours = date('H');$hours = 10;
            $minutes = date('i');$minutes = (int)preg_replace('/^0/','',$minutes);//頭の0を取る
            if($minutes == 0){
                $minutes = 0;
            }
            elseif($minutes >= 1 && $minutes <= 30) {
                $minutes = 30;
            }
            elseif($minutes >= 31){
                $minutes = 0;
                $hours += 1;
            }
            for($i=1;$i<=23;$i++){
                if($hours<10){
                    $hours+=1;
                }
                elseif($hours<23){
                    $minutes += 30;
                    if($minutes==30){
                        $min = '30';
                    }elseif($minutes==60){
                        $hours += 1;
                        $min = '00';
                        $minutes = 0;
                    }
                    $time_arr[] = $hours.':'.$min;
                }
            };
            $this->set('time_arr', $time_arr);

            # 店舗ID
            $association_id = array(3,4);//$association_id = 3;
            $t = array();$c = array();
            foreach($association_id as $id){
                # 卓番
                $table_numbers = $this->TableNumber->find('all', array(
                    'conditions' => array('TableNumber.association_id LIKE' => '%'.$id.'%'),
                    'order' => array('TableNumber.number' => 'asc')
                ));
                $t[] = $table_numbers;
                # コース
                $party_types = $this->PartyType->find('all', array(
                    'conditions' => array('PartyType.association_id' => $id)
                ));
                $c[] = $party_types;
            }
            $this->set('table_numbers', $t);$this->set('party_types', $c);

            # 担当者
            $association = $this->Association->findById(3);
            $members = $this->Member->find('all', array(
                'conditions' => array('Member.location_id' => $association['Association']['location_id'], 'Member.status' => 'active')
            ));
            $this->set('members', $members);

            # 予約情報
            $new_reserves=array();
            $reserves = $this->Reserve->find('all', array(
                'conditions' => array('Reserve.day' => $working_day),
                'order' => array('Reserve.modified' => 'desc'),
                'limit' => 5,
            ));
            foreach($reserves as $reserve){
                $reserve['fuzzy_time'] = $this->convert_to_fuzzy_time($reserve['Reserve']['modified']);
                $table_id = explode(",", $reserve['Reserve']['table_id']);
                foreach($table_id as $id){
                    $table = $this->TableNumber->find('first', array('conditions' => array('TableNumber.id' => $id) ));
                    if($table!=null){
                        $reserve['table'][] = $table['TableNumber'];
                    }
                }
                $new_reserves[] = $reserve;
            }
            $this->set('reserves', serialize($new_reserves));

        }
    }

    # AJAX
    public function ajax(){
        $this->autoRender = FALSE;
        if($this->request->is('ajax')){
            $working_day = $this->request->data[0];
            # 本日から一週間分取得
            $date_arr=array();$date_arr[]=$working_day;
            for($i=1;$i<=7;$i++){
                $date_arr[] = date('Y-m-d', strtotime("$working_day +$i day"));
            };
            echo json_encode($date_arr);
            exit;
        }
    }

    public function ajax1(){
        $this->autoRender = FALSE;
        if($this->request->is('ajax')){
            $association_id = $this->request->data[0];
            $table_numbers = $this->TableNumber->find('all', array(
                'conditions' => array('TableNumber.association_id' => $association_id)
            ));
            echo json_encode($table_numbers);
            exit;
        }
    }

    public function ajax2(){
        $this->autoRender = FALSE;
        if($this->request->is('ajax')){
            $array = $this->request->data;
            $day = $array[0];unset($array[0]);
            $reserves = $this->Reserve->find('all', array( 'conditions' => array('Reserve.day' => $day) ));
            if($reserves==null){
                return 0;
            }
            else{
                $res = array();
                foreach($reserves as $reserve){
                    $time = $reserve['Reserve']['time'];$table_id = $reserve['Reserve']['table_id'];
                    $time = explode(",", $time);$table_id = explode(",", $table_id);
                    foreach($time as $t){
                        if(in_array($t, $array)){ $res = $table_id; }
                    }
                }
                if($res!=null){ return json_encode($res); } else { return 0; }
            }
        }
    }

    public function ajax3(){
        $this->autoRender = FALSE;
        if($this->request->is('ajax')){

        }
    }

    public function ajax4(){
        $this->autoRender = FALSE;
        if($this->request->is('ajax')){
            $array = $this->request->data;
            $keys = array_keys($array);
            $data = array('Reserve' => array(
                'id' => $array['id'],
                $keys[1] => $array[$keys[1]]
            ));
            if($this->Reserve->save($data)){
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }

    public function convert_to_fuzzy_time($time_db){
        $unix   = strtotime($time_db);
        $now    = time();
        $diff_sec   = $now - $unix;
        if($diff_sec < 60){
            $time   = $diff_sec;
            $unit   = "秒前";
        }
        elseif($diff_sec < 3600){
            $time   = $diff_sec/60;
            $unit   = "分前";
        }
        elseif($diff_sec < 86400){
            $time   = $diff_sec/3600;
            $unit   = "時間前";
        }
        elseif($diff_sec < 2764800){
            $time   = $diff_sec/86400;
            $unit   = "日前";
        }
        else{
            if(date("Y") != date("Y", $unix)){
                $time   = date("Y年n月j日", $unix);
            }
            else{
                $time   = date("n月j日", $unix);
            }
            return $time;
        }
        return (int)$time .$unit;
    }

    public function view(){
        if($this->request->is('get')){
            # パラメータ存在判定
            if(!isset($this->params['url']['date'])){
                # 日付
                $working_day = date('Y-m-d');
                $this->set('working_day', $working_day);
            }
            else{
                # 日付
                $working_day = $this->params['url']['date'];
                $this->set('working_day', $working_day);
                $reserves = $this->Reserve->find('all', array(
                    'conditions' => array('Reserve.day' => $working_day)
                ));
                $r = array();
                foreach($reserves as $reserve){
                    # 時間
                    $time = explode(",", $reserve['Reserve']['time']);
                    $t_string = $time[0]."~".end($time);
                    $reserve['Reserve']['time'] = $t_string;
                    # 卓番
                    if($reserve['Reserve']['table_id']!=null){
                        $table_id = explode(",", $reserve['Reserve']['table_id']);
                        $s = array();
                        foreach($table_id as $t){
                            $table = $this->TableNumber->findById($t);
                            $s[] = $table['TableNumber']['number'];
                        }
                        $reserve['Reserve']['table'] = implode(",", $s);
                    }
                    else{
                        $table_numbers = $this->TableNumber->find('all', array(
                            'conditions' => array('TableNumber.status' => 'active'),
                            'order' => array('TableNumber.number' => 'asc')
                        ));
                        $this->set('table_numbers', $table_numbers);
                    }
                    # コース
                    if($reserve['Reserve']['course_id']!=null&&is_numeric($reserve['Reserve']['course_id'])){
                        $course_id = $reserve['Reserve']['course_id'];
                        $party_type = $this->PartyType->findById($course_id);
                        $reserve['Reserve']['course_id'] = $party_type['PartyType']['name'];
                    }
                    $r[] = $reserve;
                }
                $this->set('reserves', $r);

            }
        }
    }

    public function cooperation(){
        $mail = $this->Mail->find('first', array(
            'order' => array('Mail.created DESC')
        ));
        $mail_from = $mail['Mail']['mail_from'];
        $subject = $mail['Mail']['subject'];
        $body = $mail['Mail']['body'];
        # 食べログ
        if($mail_from=="noreply@tabelog.com"){
            $arr = array("新規予約"=>0, "予約変更"=>1, "予約キャンセル"=>2);
            $arr2 = array("お名前"=>"user_name", "日付 "=>"day", "来店時刻 "=>"time", "人数 "=>"c_num", "プラン "=>"course_id", "https://ssl.tabelog.com/owner_yoyaku/bookings/detail/?id="=>"original_id");
            $data = array();
            foreach($arr as $key => $a){
                if (strstr($subject, $key)) {
                    $body_arr = explode("\n", $body); // とりあえず行に分割
                    $body_arr = array_map('trim', $body_arr); // 各行にtrim()をかける
                    $body_arr = array_filter($body_arr, 'strlen'); // 文字数が0の行を取り除く
                    $body_arr = array_values($body_arr); // これはキーを連番に振りなおしてるだけ
                    foreach($body_arr as $body){
                        foreach($arr2 as $key2 => $a2){
                            if(strstr($body, $key2)){
                                if($a2=="original_id"){
                                    $value = strstr($body,"=");
                                    $value = str_replace('=', '', $value);
                                }
                                else{
                                    $value = strstr($body,"：");
                                    if($a2=="c_num"){
                                        $value = preg_replace('/[^0-9]/', '', $value);
                                    }
                                    else{
                                        $value = str_replace('：', '', $value);
                                        if($a2=="day"){
                                            $value = date("Y").'/'.$value;
                                            $value = date("Y-m-d", strtotime($value));
                                        }
                                        elseif($a2=="time"){
                                            $m_arr = array();$m_arr[] = $value;
                                            $v = date("Y-m-d")." ".$value.":"."00";
                                            $i=0;
                                            while($i<3){
                                                $v = date("Y-m-d H:i:s",strtotime($v."+30 minute"));
                                                $m_arr[] = date("H:i", strtotime($v));
                                                $i++;
                                            }
                                            $value = implode(",", $m_arr);
                                        }
                                    }
                                }
                                if(!isset($data["Reserve"][$a2])){
                                    $data["Reserve"][$a2] = $value;
                                }
                            }
                        }
                    }
                    # DB処理
                    if($a==0){
                        $this->Reserve->create(false);
                        $this->Reserve->save($data);
                    }
                    else{
                        if(isset($data["Reserve"]["original_id"])){
                            $r = $this->Reserve->find('first', array(
                                'conditions' => array("Reserve.original_id" => $data["Reserve"]["original_id"])
                            ));
                            if($r!=null){
                                if($a==1){
                                    $data["Reserve"]['id'] = $r["Reserve"]["id"];
                                    $this->Reserve->create(false);
                                    $this->Reserve->save($data);
                                }
                                elseif($a==2){
                                    $this->Reserve->create(false);
                                    $this->Reserve->delete($r["Reserve"]["id"]);
                                }
                            }
                            else{
                                echo "Error:not found Reserve's record by original_id";
                                exit;
                            }
                        }
                        else{
                            echo "Error:not found original_id";
                            exit;
                        }
                    }

                }
                else{
                    echo "Error:Subject is not correct";
                    exit;
                }
            }
        }
    }

    public function delete($id=null){
        //POST送信の場合
        if($this->request->is('post')){
            //データの削除
            $this->Reserve->delete($id);
            $this->redirect($this->referer());
        }
    }

    public function complement(){
        if(isset($this->params['url']['id'])){
            $id = $this->params['url']['id'];
            $reserve = $this->Reserve->findById($id);
            debug($reserve);
        }
        else{
            echo "ERROR: ID is not correct!!";
            exit;
        }
    }

}
