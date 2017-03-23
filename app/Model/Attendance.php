<?php
/**
 * Created by PhpStorm.
 * User: satoudai
 * Date: 2015/06/08
 * Time: 0:11
 */
class Attendance extends AppModel {
	//table指定
	public $useTable="attendances";

	//アソシエーション
	public $belongsTo = array(
		'Type' => array(
			'className' => 'AttendanceType',
			'foreignKey' => 'type_id'
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id'
		)
	);

	#営業日判定（引数：ミリ秒）
	public function judge24Hour($now){
		#日付
		$working_day = date('Y-m-d', $now);
		#時刻
		$hour = date('G', $now);
		if ($hour < 8) {
			$working_day = date('Y-m-d', strtotime("$working_day -1 day"));
			return $working_day;
		} else{
			return $working_day;
		}
	}

	#出退勤判定（現在の状況）
	public function judgeJobState($working_day, $member_id, $location_id){
		/*出社しているかどうか*/
		$attendance = $this->find('first', array(
			'conditions' => array('member_id' => $member_id, 'Attendance.location_id' => $location_id, 'working_day' => $working_day),
			'order' => array('Attendance.created' => 'desc')
		));
		/*①出社していない*/
		if ($attendance==null) {
			$flag = 1;/*出社ボタンのみ選択可能*/
			return $flag;
		}elseif($attendance['Type']['name']=='出勤'){
			/*②出社のみしている  break_in と check_out が空*/
			$flag = 2;/*休憩開始ボタンと退社ボタンが選択可能*/
			return $flag;
		}elseif($attendance['Type']['name']=='休憩開始') {
			/*③休憩開始しているが、終了していない */
			$flag = 3;/*休憩終了ボタンのみ選択可能*/
			return $flag;
		}elseif($attendance['Type']['name']=='休憩終了') {
			/*④休憩終了しているが、退社していない */
			$flag = 4;/*退社ボタンと休憩開始ボタンが選択可能*/
			return $flag;
		}elseif($attendance['Type']['name']=='退勤'){
			/*⑤退社している*/
			$flag = 5;/*全てのボタン選択不可*/
			return $flag;
		}
	}

	#時間調整（15分毎）
	function timeOrganizer($state, $time){
		/*日付*/
		$date = date('Y-m-d', $time);
		/*時*/
		$hours = date('H', $time);
		/*分*/
		$minutes = date('i', $time);
		$minutes = preg_replace('/^0/','',$minutes);//頭の0を取る

		/*分数調整（15分刻み）*/
		if ($state == '出勤' || $state == '休憩開始') {
			if($minutes == 0){
				$time = $date.' '.$hours.':'.'00:00';
			}
			elseif($minutes >= 1 && $minutes <= 15) {
				$time = $date.' '.$hours.':'.'15:00';
			}
			elseif($minutes >= 16 && $minutes <= 30){
				$time = $date.' '.$hours.':'.'30:00';
			}
			elseif($minutes >= 31 && $minutes <= 45){
				$time = $date.' '.$hours.':'.'45:00';
			}
			elseif($minutes >= 46){
				if ($hours == 23) {
					$hous = '00';
					$date = date('Y-m-d', strtotime("$date +1 day"));
				}else{
					$hours += 1;
				}
				$time = $date.' '.$hours.':'.'00:00';
			}
		}
		elseif($state == '休憩終了' || $state == '退勤'){
			if($minutes >= 0 && $minutes < 15) {
				$time = $date.' '.$hours.':'.'00:00';
			}
			elseif($minutes >= 15 && $minutes < 30){
				$time = $date.' '.$hours.':'.'15:00';
			}
			elseif($minutes >= 30 && $minutes < 45){
				$time = $date.' '.$hours.':'.'30:00';
			}
			elseif($minutes >= 45){
				$time = $date.' '.$hours.':'.'45:00';
			}
		}
		return $time;
	}

	#時間差分計算（引数：yyyy-mm-dd hh:ii:ss ２つ）
	public function twoDiffCalculator($working_day, $check_in_time, $check_out_time){
		#出勤と休憩開始と22時
		$start_time = strtotime("$check_in_time");
		$end_time = strtotime("$check_out_time");
		$ten_hours = strtotime("$working_day 22:00:00");
		#深夜時間判定
		if($start_time > $ten_hours){
			$late_hours = ($end_time - $start_time) / (60 * 60);
			$hours = array(
				'normal_hours' => 0,
				'late_hours' => $late_hours
			);
		}elseif($end_time > $ten_hours){
			$normal_hours = ($ten_hours - $start_time) / (60 * 60);
			$late_hours = ($end_time - $ten_hours) / (60 * 60);
			$hours = array(
				'normal_hours' => $normal_hours,
				'late_hours' => $late_hours
			);
		}else{
			$normal_hours = ($end_time - $start_time) / (60 * 60);
			$hours = array(
				'normal_hours' => $normal_hours,
				'late_hours' => 0
			);
		}
		#マイナス値エラー
		if($hours['normal_hours']<0||$hours['late_hours']<0){
			debug("時間が正しくありません。もう一度やり直してください。");
			exit;
		}
		return $hours;
	}

	#時間差分計算（引数：00:004つ）
	public function fourDiffCalculator($working_day,$check_in_time,$break_in_time,$break_out_time,$check_out_time){
		#出勤と休憩開始
		$start_time = strtotime($check_in_time);
		$break_start_time = strtotime($break_in_time);
		#休憩終了と退勤
		$break_end_time = strtotime($break_out_time);
		$end_time = strtotime($check_out_time);
		$ten_hours = strtotime("$working_day 22:00:00");
		#深夜時間判定
		if($start_time > $ten_hours){
			$hours_one = ($break_start_time - $start_time) / (60 * 60);
			$hours_two = ($end_time - $break_end_time) / (60 * 60);
			$late_hours = $hours_one + $hours_two;
			$hours = array(
				'normal_hours' => 0,
				'late_hours' => $late_hours
			);
		}elseif($break_start_time > $ten_hours){
			$normal_hours = ($ten_hours - $start_time) / (60 * 60);
			$hours_one = ($break_start_time - $ten_hours) / (60 * 60);
			$hours_two = ($end_time - $break_end_time) / (60 * 60);
			$late_hours = $hours_one + $hours_two;
			$hours = array(
				'normal_hours' => $normal_hours,
				'late_hours' => $late_hours
			);
		}elseif($break_end_time > $ten_hours){
			$normal_hours = ($break_start_time - $start_time) / (60 * 60);
			$late_hours = ($end_time - $break_end_time) / (60 * 60);
			$hours = array(
				'normal_hours' => $normal_hours,
				'late_hours' => $late_hours
			);
		}elseif($end_time > $ten_hours){
			$hours_one = ($break_start_time - $start_time) / (60 * 60);
			$hours_two = ($ten_hours - $break_end_time) / (60 * 60);
			$normal_hours = $hours_one + $hours_two;
			$late_hours = ($end_time - $ten_hours) / (60 * 60);
			$hours = array(
				'normal_hours' => $normal_hours,
				'late_hours' => $late_hours
			);
		}else{
			$hours_one = ($break_start_time - $start_time) / (60 * 60);
			$hours_two = ($end_time - $break_end_time) / (60 * 60);
			$normal_hours = $hours_one + $hours_two;
			$hours = array(
				'normal_hours' => $normal_hours,
				'late_hours' => 0
			);
		}
		#マイナス値エラー
		if($hours['normal_hours']<0||$hours['late_hours']<0){
			debug("時間が正しくありません。もう一度やり直してください。");
			exit;
		}
		return $hours;
	}

}
