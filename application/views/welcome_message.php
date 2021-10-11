<?php
$tranpose = [];
foreach ($data as $key => $value) {
	foreach ($value as $k => $v) {
		$tranpose[$k][$key] = $v;
	}
}
$sqrt   = [];
foreach ($tranpose as $key => $value) {
	$sum = 0;
	foreach ($value as $k => $v) {
		$sum += pow($v, 2);
	}
	$sqrt[$key] = sqrt($sum);
}

$normalisasi = [];
foreach ($data as $key => $value) {
	foreach ($value as $k => $v) {
		$normalisasi[$key][$k] = $v / $sqrt[$k];
	}
}

$kriteria = [];
foreach ($this->db->get('kriteria')->result() as $key => $value) {
	$kriteria[$value->id] = $value;
}

$tabel_yi = [];
foreach ($normalisasi as $key => $value) {
	foreach ($value as $k => $v) {
		$tabel_yi[$key][$k] = $v * $kriteria[$k]->bobot;
	}
}

$text_result = [];
$result = [];
foreach ($tabel_yi as $key => $value) {
	$text_res = "";
	$res = 0;
	foreach ($value as $k => $v) {
		if ($kriteria[$k]->is_benefit) {
			$res += $v;
			$text_res .= "+".$v;
		} else {
			$res -= $v;
			$text_res .= "-".$v;
		}
	}
	$result[$key] = $res;
	$text_result[$key] = $text_res;	
}

$rankings = array_unique($result);
rsort($rankings);

$text_rank = [];
foreach ($result as $key => $value) {
	$rank = array_search($value, $rankings) + 1;
	$text_rank[$key] = $rank;
	$data_keputusan[$key]->rank = $rank;
}

function compareOrder($a, $b)
{
	return ($a->rank > $b->rank ? true : false);
}
usort($data_keputusan, 'compareOrder');
?>