<?php
/*
DEV: @iOm3y
CH : https://t.me/ZEPD8
$API_KEY"5220076610"
*/
ob_start();
$API_KEY = "5170653836:AAFQ3VnTueZghQPTCYCV2lcseqkgNnQZkoE";
define('API_KEY','5170653836:AAFQ3VnTueZghQPTCYCV2lcseqkgNnQZkoE');
define('API_KEY','5170653836:AAFQ3VnTueZghQPTCYCV2lcseqkgNnQZkoE');
echo "https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME'];
  
define('NO', '❌');
define('YES', '✅');
define("API_KEY", $API_KEY);
#                    iSONIC                       #
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
#                     iSONIC                       #
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$message_id = $message->message_id;
$reply = $message->reply_to_message;
$user = 'iOm3y'.$message->from->username;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$get = json_decode(file_get_contents('data.json'),true);
if($user == null){
	$user = $message->from->first_name;
}
$userid = $message->from->id;
$GLOBALS['id'] = $chat_id;
$get = file_get_contents("https://api.telegram.org/bot$API_KEY/getChatMember?chat_id=$chat_id&user_id=".$userid);
$info = json_decode($get, true);
$you = $info['result']['status'];
#                     iSONIC                       #
function lock($media,$type = 'del'){
    $id = $GLOBALS['id'];
    $get = json_decode(file_get_contents('data.json'),true);
    if ($type == 'del') {
        $get[$id][$media]['del'] = NO;
        $get[$id][$media]['ban'] = YES;
        $get[$id][$media]['warn'] = YES;
    }
    if ($type == 'ban') {
        $get[$id][$media]['del'] = YES;
        $get[$id][$media]['ban'] = NO;
        $get[$id][$media]['warn'] = YES;
    }
    if ($type == 'warn') {
        $get[$id][$media]['del'] = YES;
        $get[$id][$media]['ban'] = YES;
        $get[$id][$media]['warn'] = NO;
    }
    file_put_contents('data.json', json_encode($get));
}
function open($media){
    $id = $GLOBALS['id'];
    $get = json_decode(file_get_contents('data.json'),true);
    $get[$id][$media]['del'] = YES;
    $get[$id][$media]['ban'] = YES;
    $get[][$media]['warn'] = YES;
    file_put_contents('data.json', json_encode($get));
}
function check($media){
    $id = $GLOBALS['id'];
    $get = json_decode(file_get_contents('data.json'),true);
    foreach ($get[$id][$media] as $key => $value) {
        if ($get[$id][$media][$key] == NO) {
            return $key;
        }
    }
}
#                    iSONIC                      #

if($text == '/start') {
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"📩￤اهلا عزيزي :- $name  
▪️￤مرحبا بك في بوت الحماية
🔘￤قم باضافت البوت وارفعه ادمن وسيتم التفعيل :) 🤖
-↭",
'reply_to_message_id'=>$mid,
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [['text'=>"اضفني الى المجموعه 🇮🇶⚜️",'url'=>"t.me/?startgroup=new"]],
        [['text'=>"~ تابع 🇮🇶-⚜️", 'url'=>"t.me/https://t.me/ZEPD8"]]
    ]

  ])
  ]);
}
// بدايه القفل والفتح
if ($you == "creator" or $you == "administrator") {
    if($text == 'تفعيل الترحيب'){
    		
    	 bot('sendmessage',[
              'chat_id'=>$chat_id,                   'text'=>" • تم تفعيل الترحيب - ✅
- الترحيب الحالي : ".$get[$chat_id]['wel']
                    ]);
                    $get[$chat_id]['_wel'] = true; 	file_put_contents('data.json',json_encode($get));
    }
    if($text == 'تعطيل الترحيب'){
    		
    	 bot('sendmessage',[
              'chat_id'=>$chat_id,                   'text'=>" • تم تعطيل الترحيب - ".NO."
- الترحيب الحالي : ".$get[$chat_id]['wel']
                    ]);
                    $get[$chat_id]['_wel'] = false; 	file_put_contents('data.json',json_encode($get));
    }
    if($reply and $text == 'طرد' or $text == 'حظر'){
	bot('kickchatmember',[
		'chat_id'=>$chat_id,
		'user_id'=>$reply->from->id
	]);
	bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"
    العضو : 🇮🇶-⚜️  ⇚〈   @".$reply->from->username."  〉
 { < 🇮🇶 تم الحظر 🇮🇶 > } 

    ",
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		
		]
		])
	]);
}
  
    if($reply and $text == 'طرد' or $text == 'حظر'){
	bot('unbanchatmember',[
		'chat_id'=>$chat_id2,
		'user_id'=>$data
	]);
	bot('editmessagetext',[
		'chat_id'=>$chat_id2,
		'text'=>"
العضو : 🇮🇶-⚜️  ⇚〈   @".$reply->from->username."  〉
 { < 🇮🇶 تم الغاء حظر 🇮🇶 > } 

    ",
		'reply_markup'=>json_encode([
		'inline_keyboard'=>[
		
		]
		])
	]);
}
  
if($reply and $text == 'تثبيت'){
	bot('pinchatmessage',[
		'chat_id'=>$chat_id,
		'message_id'=>$reply->message_id
	]);
}
if($reply and $text == 'الغاء التثبيت'){
	bot('unpinchatmessage',[
		'chat_id'=>$chat_id,
		'message_id'=>$reply->message_id
	]);
}
if(preg_match('/ضع اسم .*/',$text)){
	$text = str_replace('ضع اسم ','',$text);
	bot('setchattitle',[
		'chat_id'=>$chat_id,
		'title'=>$text
	]);
}



    if (preg_match('/(قفل)(.*)(.*)/', $text)) {
        $text = trim(str_replace('قفل', '', $text));
        $text = explode(' ', $text);
        if (isset($text[0])) {
            if ($text[0] == 'الصور' or $text[0] == 'الفيديو' or $text[0] == 'البصمات' or $text[0] == 'الصوت' or $text[0] == 'المتحركه' or $text[0] == 'الروابط' or $text[0] == 'الجهات' or $text[0] == 'الملفات' or $text[0] == 'الماركدون' or $text[0] == 'التوجيه' or $text[0] == 'البوتات' or $text[0] == 'الملصقات' or $text[0] == 'المعرف' or $text[0] == 'البوتات' and $text[1] == 'بالحذف' or $text[1] == 'بالطرد' or $text[1] == 'بالتحذير'){
                switch ($text[0]) {
                    case 'الصور':$m = 'photo';break;
                    case 'الفيديو':$m = 'video';break;
                    case 'البصمات':$m = 'voice';break;
                    case 'الصوت':$m = 'audio';break;
                    case 'المتحركه':$m = 'gif';break;
                    case 'الروابط':$m = 'link';break;
                    case 'الجهات':$m = 'contact';break;
                    case 'الملفات':$m = 'doc';break;
                    case 'الماركدون':$m = 'mark';break;
                    case 'التوجيه':$m = 'fwd';break;
                    case 'الملصقات':$m = 'sticker';break;
                    case 'المعرف':$m = 'user';break;
                    case 'البوتات':$m='bots';break;
                           if($text[1] == null){
              	$text[1] = 'بالحذف';
              }
                }
                switch ($text[1]) {
                    case 'بالحذف':$t='del';break;
                    case 'بالطرد':$t='ban';break;
                    case 'بالتحذير':$t='warn';break;
                    default:
                        $t='del';
                        break;
                }
      
                lock($m,$t);
                bot('sendmessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"
                    ـ تــم قــفل 🔐 ⇚〈 $text[0]  〉
 { < 🇮🇶 خاصية : $text[1] 🇮🇶 > } 
                    "
                ]);
            }
        }
    }
    #                     ISONIC                       #
    if (preg_match('/(فتح)(.*)(.*)/', $text)) {
        $text = trim(str_replace('فتح', '', $text));
        $text = explode(' ', $text);
        if (isset($text[0])) {
            if ($text[0] == 'الصور' or $text[0] == 'الفيديو' or $text[0] == 'البصمات' or $text[0] == 'الصوت' or $text[0] == 'المتحركه' or $text[0] == 'الروابط' or $text[0] == 'الجهات' or $text[0] == 'الملفات' or $text[0] == 'الماركدون' or $text[0] == 'التوجيه' or $text[0] == 'الملصقات' or $text[0] == 'المعرف' or $text[0] == 'البوتات'){
                switch ($text[0]) {
                    case 'الصور':$m = 'photo';break;
                    case 'الفيديو':$m = 'video';break;
                    case 'البصمات':$m = 'voice';break;
                    case 'الصوت':$m = 'audio';break;
                    case 'المتحركه':$m = 'gif';break;
                    case 'الروابط':$m = 'link';break;
                    case 'الجهات':$m = 'contact';break;
                    case 'الملفات':$m = 'doc';break;
                    case 'الماركدون':$m = 'mark';break;
                    case 'التوجيه':$m = 'fwd';break;
                    case 'الملصقات':$m = 'sticker';break;
                    case 'المعرف':$m = 'user';break;
                    case 'البوتات':$m='bots';break;
                }
                open($m);
               switch(check($m)){
               	case 'del':$t='بالحذف';
               	case 'warn':$t='بالتحذير';
               	case 'ban':$t='بالطرد';
               	default:$t='بالحذف';
               } bot('sendmessage',[
                    'chat_id'=>$chat_id,
                    'text'=>"
                    تم فتح 🇮🇶-⚜️  ⇚〈 $text[0]  〉
 { < 🇮🇶 خاصية : $t 🇮🇶 > } 
                    "
                ]);
            }
        }
    }
    
}
// نهايه القفل والفتح
if ($you != "creator" and $you != "administrator") {
    if($message->photo){    #                     ISONIC                       #
        if (check('photo') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('photo') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"• ممنوع ارسال الصور #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('photo') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->video){
        if (check('video') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('video') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال فيديو #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('video') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->contact){
        if (check('contact') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('contact') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الجهات #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('contact') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->sticker){
        if (check('sticker') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('sticker') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الملصقات #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('sticker') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->forward_from or $message->forward_from_chat){
        if (check('fwd') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('fwd') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال التوجيه #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('fwd') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->document){
        if (check('doc') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('doc') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الملفات #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('doc') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if(preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me|(.*)telesco.me|telesco.me(.*)/i',$text)){
        if (check('link') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('link') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الروابط #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('link') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->new_chat_member->is_bot == true){
        if (check('bots') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$ $message->new_chat_member->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('bots') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع اضافه البوتات #:  ".$user." - ".NO
            ]);
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$ $message->new_chat_member->id
                ]);
        }
        if (check('bots') == 'del') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$ $message->new_chat_member->id
                ]);
        }
    }
    if($message->entities){
        if (check('mark') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('mark') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الماركدوان #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('mark') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if(preg_match('/^(.*) | (.*)|(.*) (.*)|(.*)#(.*)|#(.*)|(.*)#/',$text)){
        if (check('user') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('user') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال المعرفات #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('user') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->voice){
        if (check('voice') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
        }
            bot('deleteMessage',[
                'cthat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('voice') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال البصمات #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('voice') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
    }
    if($message->audio){
        if (check('audio') == 'ban') {
            bot('kickChatMember',[
                'chat_id'=>$chat_id,
                'user_id'=>$message->from->id
            ]);
        
        }
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('audio') == 'warn') {
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "• ممنوع ارسال الصوتيات #:  ".$user." - ".NO
            ]);
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);
        }
        if (check('audio') == 'del') {
            bot('deleteMessage',[
                'chat_id'=>$chat_id,
                'message_id'=>$message->message_id
            ]);

}


if (preg_match("/\/bc .*/", $text) and $chat_id == 175279237) {
            $f = explode("\n", file_get_contents("users.txt"));
            $text = str_replace("/bc ", "", $text);
            for ($i=0; $i < count($f); $i++) { 
                bot("sendMessage",[
                    "chat_id"=>$f[$i],
                    "text"=>$text
                ]);
            }
        }
        $f = explode("\n", file_get_contents("users.txt"));
        if ($update and !in_array($chat_id, $f)) {
            file_put_contents("users.txt", $chat_id."\n",FILE_APPEND);
        } 
        if ($text == "المجموعات" or $text == "/us" and $chat_id == 462603768) {
            bot("sendMessage",[
                "chat_id"=>$chat_id,
                "text"=>count($f)
            ]);
        }

    $info = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@m_k236&user_id=".$chat_id));
$per = $info->result->status;
if ($per == 'left') {
  bot('sendMessage',[
    'chat_id'=>$chat_id,
    "@iOm3y"
  ]);
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id =$message->chat->id;
$time = time() + (979 * 11 + 1 + 30);
$ex = explode('كول',$text);
$sudo = 175279237;
$id_sudo = 175279237;
$id = $message->from->id; 
$getid = file_get_contents('ied.txt');
$exid = explode("\n", $getid);
$count = count($exid);
$sudo = 175279237;
$bc = explode("/bc", $text);
$user = $update->message->from->username;
$name = $update->message->from->first_name;
$last_name = $update->message->from->last_name;
$from_id = $update->message->from->id;
$message_id = $update->message->message_id;
$user_id = $update->message->from->user_id;
$sudo = 175279237;
$user_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;

$sudo = 175279237;
$get = explode("\n", file_get_contents('memberbot.txt'));

$sudo == 175279237;
if($text == "رفع مطي مميز" and $id == $sudo){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"العضو تم رفعه مطي مميز بنجاح😹✅",
'reply_to_message_id'=>$message_id
]);
}
if($text == "رفع مطي مميز" and $id != $sudo){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انت ليس مطور⚙️
🔖اسمك:- $name
💳ايديك:- $from_id",
'reply_to_message_id'=>$message_id
]);
}

if($text == '/start' and !in_array($chat_id, $get)){
file_put_contents('users.txt',"\n" . $chat_id, FILE_APPEND);
}

if($text == '/start' and !in_array($chat_id, $get)){
file_put_contents('memberbot.txt',"\n" . $chat_id, FILE_APPEND);
}

if($text == 'بوتي' and $id == $sudo){
bot('sendmessage',[
chat_id=>$chat_id,
'text'=>"هَــْـِْـْْـِلاّ مــْـِْـْْـِطــْـِْـْْـِوري"
]);
}

if($text == 'تفعيل' ){
bot('sendmessage',[
chat_id=>$chat_id,
'text'=>"🇮🇶-⚜️ تم تفعيل البوت بنجاح 

🔖اسمك:- $name 
💳ايديك:- $from_id"
]);
}

  $rep = $message->reply_to_message;
if(preg_match('/^(تاك)(.*)/',$text)){
 $text = str_replace('تاك للمطي  ','',$text);
 bot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"[$text](tg://user?id=".$rep->from->id.")",
 'parse_mode'=>'markdown'
 ]);
}


if($text == 'بووتي' and !$id == $sudo){
bot('sendmessage',[
chat_id=>$chat_id,
'text'=>"مو مطوري حسبالك ما عرفك"
]);
}

if($text == "م3"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"⚙️- اهلا بيك عزيزي $name في قائمة المدير🔹 
➖➖➖➖➖➖➖➖➖➖➖
📌معلوماتي ↭ لعرض معلوماتك الشخصيه

📌- ايدي لكروب ↭ لعرض ايدي لكروب

📌- كول+الكلمه

📌اضف+كلمة ↭ لاضافة رد عام
جواب الرد

📌- اسمي ↭ لعرض اسمك
➖➖➖➖➖➖➖➖➖➖➖

",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($rep && $text == "ايدي"){
bot('sendmessage', [
'chat_id' => $chat_id,
'text' => "id = $re_id
name = $re_name
user = $re_user",
]);
}

include 'rd.php';
if (preg_match('/^(اضف)(.*)/', $text) ) {
  $rd = str_replace('اضف ', $rd, $text);
  $ex = explode("\n", $rd);

    $put = "\n".'
    if ($text == "'.$ex[0].'") {
      bot(\'sendMessage\',[
        \'chat_id\'=>$chat_id,
        \'text\'=>"'.$ex[1].'"
      ]);
    }';
    file_put_contents('rd.php', $put,FILE_APPEND);
    bot('sendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"تــم اضــافــة الـرد بـنـجـاح✅
بـواسـطـه $name",
'reply_to_message_id'=> $message_id,
                ]);
  
}

if($text== 'الاوامر'){
bot('sendMessage',[
"chat_id"=>$chat_id,
'text'=>'اهلا بك عزيزي في قائمة الاوامر

〰〰〰〰〰〰〰〰
⚙️اوامر بوت الحمايه
 
🔘اوامر الحمايه🔹  م1

🔘 اوامر المنشئ &الادمن🔹 م 2

🔘اوامر اضافيه🔹  م3

‏‎🔘اوامر الاغاني🔹 م4
➖➖➖➖➖➖
  
]);
}

if($text=="اسمي"){
bot("sendmessage',[
'chat_id' => $chat_id,
'text'=>$name


if($text == "م1"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"🔐 اليك اوامر حماية المجموعه 
〰〰〰〰〰〰〰〰〰〰〰
🔹 استخدم امر ( قفل ) للقفل 🔒•
🔹 استخدم امر ( فتح ) للفتح 🔓•

🔘اليك الاوامر الحمايه المتوفره -
➖➖➖➖➖➖➖➖➖➖➖
📌- الصور • 📷

📌- الفيديو • 📹

📌- الملصقات • 🎆

📌- الروابط • 🔗
️
📌- التوجيه • 🔀

📌- الجهات • 👥

📌- المعرف • #⃣

📌-  المتحركه • 🎞

📌- الملفات  • 🗂

📌- البوتات 🤖👾

📌- الصوت • 🎶
️
📌- البصمات 🔉 ؛ 

⚙️- كل الاوامر تعمل مع ( بالحذف ، بالطرد ، بالتحذير ) ؛ 🔱
مثل : قفل الروابط بالطرد 
➖➖➖➖➖➖➖➖➖➖➖ 
"مطور البوت @iOm3y"
",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "م2"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"☑️• اليك الاوامر الاضافيه ✨ 
➖➖➖➖➖➖➖➖➖➖➖
🔘- هذه الاوامر متاحه للادمن والمنشئ 🔹

📍- طرد ( بالرد ) • ⚠️
📍- تثبيت ( بالرد ) • 🔰
📍- الغاء التثبيت • ❗️
📍- ضع اسم + الاسم • 📜
📍- ضع وصف + الوصف • 🗒
📍- ضع ترحيب + الترحيب • ?
📍- (تفعيل ، تعطيل) الترحيب • 📝
📍- الرابط • 
〰〰〰〰〰〰〰〰〰〰〰
كروب البوت@ZEPD8
",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text =="الوقت"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🇮🇶 البلد : 🔥العراق \n" . "✨🔥  السنه  : " . date("Y") . "\n" . "🌟  الشهر🔥 : " . date("n") . "\n" . "💫  اليوم🔥 :" . date("j") . "\n" . "💏 الساعه🔥 :" . date('g', $time) . "\n" . "💋 الدقيقه🔥 :" . date('i', $time) . "\n" . " 😍",
'reply_to_message_id'=>$message->message_id
]);
}

if($text == "غني"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/ANGAM_iq/4336",
 reply_to_message_id =>$message->message_id, 
]);
}

if($text == "هيلاو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"دولي خمطتهه م̷ـــِْن خالتك",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "كول والله"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"والله",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "1$"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"غـِْاليّے كلش",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "اريد بوت"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ضيفني وصعني ادمن انه اتفاعل",
'reply_to_message_id'=>$message->message_id, 
]);
}


if($text== "ايدي لكروب"){
bot('sendMessage',[
"chat_id"=>$chat_id,
'text'=> 'هاذ ايدي لكروب ' .$chat_id,
]);
}


if($text== "ايديي"){
bot('sendMessage',[
"chat_id"=>$chat_id,
'text'=>'الايدي الخاص بك : ' .$chat_id,
]);
}
if($text == "شسمج"or $text== "شسمك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"⁽ لـٰٖـٖيـٰٖش ⁉️ تريد تزحف 🔷",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "لا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ووجعا 😂",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "م4"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اهلا بك عزيزي في قائمة الاغاني🔘
➖➖➖➖➖➖➖➖➖➖➖
📍الاغاني المتوفره م̷ـــِْن 1الى10 اغنيه🔹 
📌اكتب اغنيه+الرقم
مثال🔻
اغنيه1
او 
اغنيه7
وسوف ارسل ڵـڱ الاغنيه

〰〰〰〰〰〰〰〰

",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "اغنيه1"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2663",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه2"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 Group=>"https://t.me/ZEPD8",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == ""){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2657",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه3"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2656",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه4"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2652",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه5"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2643",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "دي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"لاخطيه",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "اغنيه6"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2643",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه7"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2638",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه8"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2638",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه9"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2631",
 reply_to_message_id =>$message->message_id, 
]);
}

if($text == "اغنيه10"){
bot( sendaudio ,[
 chat_id =>$chat_id, 
 audio =>"https://t.me/mmss190/2626",
 reply_to_message_id =>$message->message_id, 
]);
}
if($text == "اغنيه11"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"كافي لطشت",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "😂"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"فطير ماصيرلك جارة",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "😍"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"كبر يل غرم",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "استحي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اكو حيوان يستحي م̷ـــِْن نفسه ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "😐"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"عليمن ماد حلكلك جنه بسطال",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "وين الربط"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شوف المدير والادمونيه",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "كول 1"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ما اكول لْـۆ تنطيني شسمه",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "🙂"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"عود ثكيل",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "🙄"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"نزل عـــ⌣̴͡͡د̲⌣̴͡͡ ــيونگ يول",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "منو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"خالتك ام سحوره",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "تحبني"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ماحب زبايل",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "تكرهني"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اكثر من ما تتوقع",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "نعال"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"بحلكك وبخشمك",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "رفع نعال مميز"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"العضو تم رفعه نعال مميز😂😒",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "رفع عضو مميز"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"مارفعه لْـۆ تموت 😍😂",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "هه" or $text =="ههه" or $text == "هههه" or $text =="ههههه" or $text=="هههههه"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"⌣{دِْۈۈۈۈ/يّارٌبْ_مـْو_يـّوّمٌ/ۈۈۈۈمْ}⌣",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "هلوو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هلوات حبي",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "اريد يوزر"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اصيرلك يوزر",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "السلام عليكم"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>" وعليكم السلام",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "سونيك" or $text ==" عمـوري "){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شـتـريـد مـنـه هـذه مـطـوري",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "المطور"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"@iOm3y",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "هلا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"؟هلوات حمبي",
'reply_to_message_id'=>$message->message_id, 
]);
}
$MATHEO = explode('كول',$text);
if($MATHEO){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$MATHEO[1],
]);
}

$mid = $message->message_id;
$memb = $update->message->message_id;
$id = $message->from->id;
$us = $update->message->from->username;
if($text == "ايدي" and  $you == "creator"){
$get_progile = file_get_contents("https://api.telegram.org/bot$API_KEY/getUserProfilePhotos?user_id=$id&limit=1");
$json = json_decode($get_progile);
$user_photo = $json->result->photos[0][0]->file_id;

bot('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$user_photo,
'caption'=>"
🔸 • ايديك : $id
🔸 • معرفك : @$us
🔸 • موقعك ← منشئ ثكيل 🙊💥
🔸 • رسائل المجموعه ← $memb ",
'reply_to_message_id'=>$mid,
]);
}
if($text == "ايدي" and  $you == "administrator"){
$get_progile = file_get_contents("https://api.telegram.org/bot$API_KEY/getUserProfilePhotos?user_id=$id&limit=1");
$json = json_decode($get_progile);
$user_photo = $json->result->photos[0][0]->file_id;

bot('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$user_photo,
'caption'=>"
🔸 • ايديك : $id
🔸 • معرفك : @$us
🔸 • موقعك ← ادمن طاش 😀🍂
🔸 • رسائل المجموعه ← $memb ",
'reply_to_message_id'=>$mid,
]);
}
if($text == "ايدي" and  $you == "member"){
$get_progile = file_get_contents("https://api.telegram.org/bot$API_KEY/getUserProfilePhotos?user_id=$id&limit=1");
$json = json_decode($get_progile);
$user_photo = $json->result->photos[0][0]->file_id;

bot('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$user_photo,
'caption'=>"
🔸 • ايديك : $id
🔸 • معرفك : @$us
🔸 • موقعك ← عضو مهتلف 😹❕
🔸 • رسائل المجموعه ← $memb ",
'reply_to_message_id'=>$mid,
]);
}


if($text == "بوتي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هاا لك والله كاعد منايم كلي تريد شي ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "انت"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شبيه ماعاجبك ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "هاا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ووجعاا",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "جبك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"دي لتزحف",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "زاحف"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"وينه خل يجي يزحف عليه",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "احبج"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شدتحس",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "صدك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"والله شبيك",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "والله"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"لتحلف",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "بوس لكروب"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اممممموووحححه خدهم مالح وحلو",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "اتفل"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"حححوك تففففف",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "اتفل على هذا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ووين سويله رد وكلي اتفل عليه",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "ها تفل عليه"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"تففففف عليه وعل كصته ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "تفليش"or $text=="فلش"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"خاببب دييي",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "نلعب"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"دنجب انجب",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "مطي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"مطي ابن المطي",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "اكلك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"كول ",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "يب"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اثـكـل\ي",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "صدام"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"تاج راسك وراسي",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "حبي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"صارت قديمه هسه الجديد كله حبق ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "شسمك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"SONIC",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "سونيك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هاا شتريد",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "اضحك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هههههه",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "ابجي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ما ابجي حبق",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "ابجي مدري اضحك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شويه اضحك وشويه ابجي",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "لاا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"والرب",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "5"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"احطه بيك واطمسه",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "1"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"حطه الك عبد الواحد",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "تدرس"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شيدرس هوه هذا فاهي",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "صدوك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"عدل حجيك تره بل شسمه",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "تروح"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"اي ليش لا",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "من وين"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"من العراق",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "حياك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"كملهه كول حياك الله",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "اخوي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"والنعم",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "فرخ"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"💔🙁انت الفرخ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "التلي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شبي خوش برنامج اني استعمله",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "مقابل"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"كلشي صاار بمقابل",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "صح"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ي وداعتك صحح",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "خطا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"ليش",
'reply_to_message_id'=>$message->message_id, 
]);
}


if($text == "تبادل"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"@iOm3y",
'reply_to_message_id'=>$message->message_id, 
]);
}



if($text == "البنات"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شبيهن",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "زاحفه"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"حل فضحوهه",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "منو حبيبك"or $text=="منو حبيبج"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"محد قابل مثلك/ج",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "جاو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هااا شبيك ضجت",
'reply_to_message_id'=>$message->message_id, 
]);
}


if($text == "يله جاوو"or $text== "جاوو"or $text=="يله جااوو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"شبيك ضجت لوو وين رايح",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "عود"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"مال شخاط",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "فاشل"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"مثلك",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "تهي بهي"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هاا شبيك",
'reply_to_message_id'=>$message->message_id, 
]);
}


if($text == "رايح"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"الله ويااك",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "مغادر"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"دي الله وياك",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "شعليك"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"انجب",
'reply_to_message_id'=>$message->message_id, 
]);
}


if($text == "ابرار"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"هاي ان عيون خظر ورده من الله",
'reply_to_message_id'=>$message->message_id, 
]);
}

if($text == "حلو"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"انت الاحلا",
'reply_to_message_id'=>$message->message_id, 
]);
}if($text == "ليبيا"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"احب خالتك ",
'reply_to_message_id'=>$message->message_id, 
]);
}
if($text == "رفع خروف"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"تم رفع خروف بنجاح ✅",
'reply_to_message_id'=>$message->message_id, 
]);
}