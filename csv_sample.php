/* CSVファイル作成＋ダウンロード
 * 連想配列のエンコード処理
 * 
 * 
 */
function make_csv_assoc(){

	$data_list = [];
	$res = DBから取得
	while ($data_list[] = mysqli_fetch_array($res,MYSQLI_ASSOC));

	$csv_list = [];

//	項目行をセット
	$csv_list[0] = array('id'=>"会員ID",（中略）,,);
    mb_convert_variables( "SJIS-win", "UTF-8", $csv_list[0]);
	$ccnt = 1;

	// csv出力用のデータに加工
	foreach($data_list as $ddat){
		if(empty($ddat['id'])){
			break;
		}
		// 各項目にセット
		$csv_list[$ccnt]['id'] = $ddat['id'];
		（中略）
		$csv_list[$ccnt]['status'] = $ddat['status'];

	    mb_convert_variables( "SJIS-win", "UTF-8", $csv_list[$ccnt]);
		$ccnt++;
	}

	// CSVファイル作成
    $filename = "makefile.csv";

	$file = fopen($filename, "w");
	if($file){
		foreach($csv_list as $dat){
			fputcsv($file, $dat);
		}
	}
	fclose($file);

	header('Content-Disposition: attachment; filename=Download_name.csv'); 
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($filename));
	readfile($filename);

}
