<?php
date_default_timezone_set('Asia/Tokyo');
if($_POST['param_comp']){
	// メール処理
	make_mail_client($_POST);
	make_mail_customer($_POST);
	header("Location: ./comp.php");
	exit();
}else{
	header("Location: ./form.php");
	exit();
}

function make_mail_client($dat){
	// メール作成
	$body = "";
	$subject = "お問い合わせがありました。";

	$to = 'to.test@test.co.jp';
	$header = 'From:from.test@test.co.jp'."\r\n";
	$header =$header.'Bcc: bcc.test@test.co.jp' . "\r\n";
	$header =$header.'MIME-version: 1.0' . "\r\n";
	$header =$header."Content-Type: text/plain; charset=ISO-2022-JP\n";
	$header =$header."Content-Transfer-Encoding: 7bit\n";

	$body = $body. "ホームページよりお問い合わせを受け付けました。\n";
	$body = $body. "詳細は以下です。\n\n";
	$body = $body. "（名前）".$dat["user_name"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（電話番号）".$dat["user_tel"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（メールアドレス）".$dat["user_mail"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（住所）".$dat["user_zip"]."\n";
	$body = $body.$dat["user_address"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（質問内容）\n";
	$body = $body.$dat["question1"]."\n\n";
	$body = $body. "（お問い合わせ内容）\n";
	$body = $body.$dat["message"]."\n\n";
	$body = $body. "（署名）\n";
	$body = $body. "（署名）\n";
	$body = $body. "（署名）\n\n";
	$body = $body. "（日時）".date("Y/m/d H:i")."\n\n";

	$subject = mb_convert_encoding($subject,"JIS","UTF8");
	$subject = "=?iso-2022-jp?B?". base64_encode($subject). "?=";

	$body = mb_convert_encoding($body,"JIS","UTF8");

	mail($to,$subject,$body,$header);
/*
// TODO テスト中はメール機能はコメントアウト
	// ファイルの書き出し
	$file = "001_test_mail_client.txt";
	$tmp_mail_text = $body."\n\nTo:".$to."\n\nSubject:".$subject;
	file_put_contents($file,$tmp_mail_text);
*/
}

function make_mail_customer($dat){
	// メール作成
	$body = "";
	$subject = "お問い合わせありがとうございます。";

	$to = $dat["user_mail"];
	$header = 'From:from.test@test.co.jp'."\r\n";
	$header =$header.'Bcc: bcc.test@test.co.jp' . "\r\n";
	$header =$header.'MIME-version: 1.0' . "\r\n";
	$header =$header."Content-Type: text/plain; charset=ISO-2022-JP\n";
	$header =$header."Content-Transfer-Encoding: 7bit\n";

	$body = $body. $dat["user_name"]."様\n";
	$body = $body. "この度はお問い合わせ頂き、誠にありがとうございます。\n";
	$body = $body. "担当者より折り返しご連絡させて頂きます。\n\n";
	$body = $body. "（お名前）".$dat["user_name"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（電話番号）".$dat["user_tel"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（メールアドレス）".$dat["user_mail"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（住所）".$dat["user_zip"]."\n";
	$body = $body.$dat["user_address"]."\n";
	$body = $body. "────────────────────────────\n";
	$body = $body. "（質問内容）\n";
	$body = $body.$dat["question1"]."\n";
	$body = $body. "（お問い合わせ内容）\n";
	$body = $body.$dat["message"]."\n\n";
	$body = $body. "（日時）".date("Y/m/d H:i")."\n\n";

	$subject = mb_convert_encoding($subject,"JIS","UTF8");
	$subject = "=?iso-2022-jp?B?". base64_encode($subject). "?=";

	$body = mb_convert_encoding($body,"JIS","UTF8");

	mail($to,$subject,$body,$header);
/*
// TODO テスト中はメール機能はコメントアウト
	// ファイルの書き出し
	$file = "001_test_mail_customer.txt";
	$tmp_mail_text = $body."\n\nTo:".$to."\n\nSubject:".$subject;
	file_put_contents($file,$tmp_mail_text);
*/
}
?>
