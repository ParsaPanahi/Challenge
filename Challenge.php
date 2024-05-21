<?php
# سورس چالش بین ممبرا این سورس دو نوع داره یکیش Like و یکی دیگش Prasmostr 
# نویسنده این سورس @mrkral میباشد
# اولین بار در کانال @MeshkiTm و @irkral اوپن شده - اسکی با منیع.
ob_start();
define('API_KEY','توکن'); # توکن ربات خود را در جای گفته شده بزارید 
$admin = array("5445718915","5445718915"); # ایدی ادمین هارو در جای خواسته شده جایگزین کنید
   function del($namei){
   array_map('unlink', glob("namei"));
   }
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

function step($cid,$value){
file_put_contents("bots/$cid/index.php","bay");
}


  
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$callback = $update->callback_query;    
$data = $update->callback_query->data;  
$callfrid = $update->callback_query->from->id; 
$cid2 = $update->callback_query->message->chat->id;  
$mesid = $update->callback_query->message->message_id;
$tx = $message->text;
mkdir("like");
mkdir("ozvv");
mkdir("data");
mkdir("data/$cid");
$emojiha = ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❣','💕','💞','💓','💗','💖','💘','💝'];
$_emoj = array_rand($emojiha,1);
$emolar = $emojiha[$_emoj];
$kanal1 = file_get_contents("kanal.txt");
$dasturr = file_get_contents("data/$cid/dasturr.txt");
$step = file_get_contents("ozvv/$cid.step");
$sherkat = file_get_contents("ozvv/sherkat.dat");
$name = $message->from->first_name;
$user = $message->from->username;
$super = file_get_contents("konkur.txt");
$reply = $message->reply_to_message->text;
$rpl = json_encode([
           'resize_keyboard'=>false,
            'force_reply' => true,
            'selective' => true
        ]);
        $key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"در مسابقه شرکت کنید 🏅"]],
[['text'=>"🏆 جایزه"],['text'=>"🔰 قوانین"]],
]
]);

$adminkey = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔧قوانین را تغییر دهید"]],
[['text'=>"📣اضافه کردن کانال"],['text'=>"🔰 انتخاب مسابقه"]],
[['text'=>"📝 شرکت کنندگان مسابقه"]],
[['text'=>"📌آمار"],['text'=>"📨ارسال پیام"]],
[['text'=>"♻️پاک کردن سابقه شرکت در مسابقه"]],
[['text'=>"/start"]],
]
]);

$konk = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"$super"]],
[['text'=>"🔙بازگشت"]],
]
]);

$pras = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"موافقم"]],
[['text'=>"🔙بازگشت"]],
]
]);

$from_id = $message->from->id;
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$kanal1&user_id=".$from_id);

if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$cid,
    'text'=>"متاسفم دوست عزیز 

برای استفاده از ربات، باید در کانال ما عضو شوید

📡┗کانال ما
@$kanal1

🖲┗لغو اشتراک روی فرمان { /start } کلیک کنید" ,
]);return false;}

if($tx=="در مسابقه شرکت کنید 🏅"){ 
$mykon=file_get_contents("ozvv/sherkat.dat"); 
if(mb_stripos($mykon,"$cid")!==false){ 
      bot('sendmessage',[ 
        'chat_id'=>$cid,
        'text'=>"با عرض پوزش، شما قبلا در مسابقه شرکت کرده اید!", 
        'reply_markup'=>$key,
    ]); 
}else{ 
     bot('sendmessage',[ 
        'chat_id'=>$cid, 
        'text'=>"فقط یکبار می توانید در مسابقه شرکت کنید
پس هوشیار باشید


ما شما را به مسابقه فعلی هدایت می کنیم", 
        'reply_markup'=>$konk,
    ]);  
  }
}

if($tx == "📨ارسال پیام" && (in_array($cid,$admin))){
	file_put_contents("data/$cid/dasturr.txt","karbar");
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"پیام خود را بفرست",
        'reply_markup'=>$rpl,
    ]);
}
if($dasturr=="karbar"){
$idss=file_get_contents("users.db");
      $idszs=explode("\n",$idss);
      foreach($idszs as $idlat){
      $hamma=bot('sendMessage',[
      'chat_id'=>$idlat,
      'parse_mode'=>'markdown',
      'text'=>$tx,
      ]);
      }
    }
if($hamma){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"♻ به همه فرستاده شده است",
]);
file_put_contents("data/$cid/dasturr.txt","");
}
if($tx == "♻️پاک کردن سابقه شرکت در مسابقه" && (in_array($cid,$admin))){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"سابقه شرکت در مسابقه پاک شد
همه اعضا اکنون می توانند دوباره در مسابقه شرکت کنند",
        'reply_markup'=>$adminkey,
    ]);
    file_put_contents("ozvv/sherkat.dat","");
}
$lichka = file_get_contents("users.db");
$lich = substr_count($lichka,"\n");
if($tx == "📌آمار" && (in_array($cid,$admin))){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"🔷<b> آمار ربات:</b>

👤اعضای ربات: <i>$lich</i>

👨🏻‍💻Admin //admin نام کاربری نوشته شده است
",
        'reply_markup'=>$adminkey,
    ]);
}
$lichkam = file_get_contents("ozvv/sherkat.dat");
$lichim = substr_count($lichkam,"\n");
if($tx == "📝 شرکت کنندگان مسابقه" && (in_array($cid,$admin))){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"🔷 لیست شرکت کنندگان:

👤تعداد شرکت کنندگان: $lichim

🆔 تعداد افراد شرکت کننده

$lichkam",
        'reply_markup'=>$adminkey,
    ]);
}

$matnqav = "قوانین مسابقه را وارد کنید";
$qavanin = file_get_contents("qavanin.txt");
if($tx == "🔧قوانین را تغییر دهید" && (in_array($cid,$admin))){
	file_put_contents("data/$cid/dasturr.txt","qavanin");
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"$matnqav",
        'reply_markup'=>$rpl,
    ]);
}

if($dasturr=="qavanin"){
bot('Sendmessage',[
'chat_id'=>$cid,
'text'=>"قوانین مسابقه تغییر کرده است.",
'parse_mode'=>"markdown",
'reply_markup'=>$adminkey,
]);
file_put_contents("qavanin.txt","$tx");
file_put_contents("data/$cid/dasturr.txt","");
}
$kons = "انتخاب نوع مسابقه لایک برای مسابقه ارسال به عنوان ❤️Like  برای مسابقه پراسموستر 👁️ارسال به صورت Prasmostr";
if($tx == "🔰 انتخاب مسابقه" && (in_array($cid,$admin))){
	file_put_contents("data/$cid/dasturr.txt","konk");
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"$kons",
        'reply_markup'=>$rpl,
    ]);
}
if($dasturr=="konk"){
bot('Sendmessage',[
'chat_id'=>$cid,
'text'=>"مسابقه انتخاب شده است",
'parse_mode'=>"markdown",
'reply_markup'=>$adminkey,
]);
file_put_contents("konkur.txt","$tx");
file_put_contents("data/$cid/dasturr.txt","");
}
$yubori = "کاربر کانال مسابقه را ارسال کنید مثال: irkral";
$kanal1 = file_get_contents("kanal.txt");
if($tx == "📣اضافه کردن کانال" && (in_array($cid,$admin))){
	file_put_contents("data/$cid/dasturr.txt","kanal");
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"$yubori",
        'reply_markup'=>$rpl,
    ]);
}
if($dasturr=="kanal"){
bot('Sendmessage',[
'chat_id'=>$cid,
'text'=>"کانال اضافه شد.",
'parse_mode'=>"markdown",
'reply_markup'=>$adminkey,
]);
file_put_contents("kanal.txt","$tx");
file_put_contents("data/$cid/dasturr.txt","");
}
if($tx=="/panel" && (in_array($cid,$admin))){
file_put_contents("data/$cid/dasturr.txt","");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"به پنل خوش آمدید",
'reply_markup'=>$adminkey,
]);
}
if($tx=="/start" or $tx=="🔙بازگشت"){
file_put_contents("data/$cid/dasturr.txt","");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"بخش مورد نیاز را انتخاب کنید ♻️",
'reply_markup'=>$key,
]);
}

$type = $message->chat->type;
$lichka = file_get_contents("users.db");
if($type == "private"){
    if(strpos($lichka,"$cid") !==false){
    }else{
        file_put_contents("users.db","$lichka\n$cid");
    }
}
$qavanin = file_get_contents("qavanin.txt");
if($tx=="🏆 جایزه" or $tx=="🔰 قوانین"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"$qavanin",
'reply_markup'=>$key,
]);
}

if($dasturr=="tan"){ 
$mykon=file_get_contents("ozvv/sherkat.dat"); 
if(mb_stripos($mykon,"$cid")!==false){ 
      bot('sendmessage',[ 
        'chat_id'=>$cid,
        'text'=>" عرض پوزش، شما قبلا در مسابقه شرکت کرده اید! اگر دوباره این اتفاق بیفتد، از مسابقه اخراج می شوید و از ربات مسدود می شوید", 
        'reply_markup'=>$key,
    ]); 
}else{ 
    $file_id = $message->photo[0]->file_id;
	$caption = $message->caption;
	$tokenn=uniqid("true");
	$kanal1 = file_get_contents("kanal.txt");
$gamer=file_get_contents("ozvv/sherkat.dat"); 
	file_put_contents("ozvv/sherkat.dat", "$gamer\n$cid");
			bot('sendPhoto',[
			'chat_id'=>"@$kanal1",
			"photo"=>$file_id,
			"caption"=>" [$name](tg://user?id=$cid) یک لایک برای اینکه دوستمون برنده بشه

 [$name](tg://user?id=$cid) ❤️ شروع به جمع آوری لایک کنید
 
 🤝 برای شما آرزوی موفقیت داریم. حتما برنده میشید 🏆

[📣 کانال ما️](t.me/$kanal1)",
'parse_mode'=>"markdown",
'inline_query_id'=>$qid, 
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"$emolar", 'callback_data'=>"$tokenn=❤️"]],
       [['text'=>"شرکت در مسابقه 🏁", "url"=>"https://telegram.me/KralLikeBot"]], 
       ] 
       ]) 
       ]);
sleep(1);
file_put_contents("data/$cid/dasturr.txt","");
bot('Sendmessage',[
'chat_id'=>$cid,
'text'=>"*👌اکنون شما یک شرکت کننده در مسابقه هستید \n می توانید @$kanal1 را وارد کنید \nشروع به جمع آوری لایک کنید موفق باشید *",
'parse_mode'=>"markdown",
'reply_markup'=>$key,
    ]);  
  }
}

if(mb_stripos($data,"=")!==false){ 
$ex=explode("=",$data); 
$calltok=$ex[0]; 
$emoj=$ex[1]; 
$mylike=file_get_contents("like/$calltok.$cid.dat"); 
if(mb_stripos($mylike,"$callfrid")!==false){ 
      bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"متاسفم، شما قبلا رای داده اید!", 
        'show_alert'=>false, 
    ]); 
}else{ 
file_put_contents("like/$calltok.$cid.dat","$mylike\n$callfrid=$emoj"); 
$value=file_get_contents("like/$calltok.$cid.dat"); 
$lik=substr_count($value,"❤️"); 
$des=substr_count($value,"👎"); 
     bot('editMessageReplyMarkup',[ 
        'chat_id'=>$cid2, 
        'message_id'=>$mesid,
        'inline_query_id'=>$qid,
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"$emolar $lik", 'callback_data'=>"$calltok=❤️"]], 
       [['text'=>"شرکت در مسابقه 🏁", "url"=>"https://telegram.me/KralLikeBot"]], #ایدی ربات خود 
       ] 
       ]) 
       ]);
       bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"رای شما پذیرفته شد!", 
        'show_alert'=>false, 
    ]);  
  }
}

if($tx=="❤️Like" or $tx=="❤️ Like"){ 
$mykon=file_get_contents("ozvv/sherkat.dat"); 
if(mb_stripos($mykon,"$cid")!==false){ 
      bot('sendmessage',[ 
        'chat_id'=>$cid,
        'text'=>"با عرض پوزش، شما قبلا در مسابقه شرکت کرده اید!", 
        'reply_markup'=>$key,
    ]); 
}else{ 
	file_put_contents("data/$cid/dasturr.txt","tan");
     bot('sendmessage',[ 
        'chat_id'=>$cid, 
        'text'=>"برای شرکت در مسابقه عکس ارسال کنید (هر عکسی => 18+ یا نباید تبلیغاتی باشد)♻️", 
        'reply_markup'=>$reply,
       ]);
  }
}
if($tx=="موافقم" && $dasturr=="pras"){ 
$mykon=file_get_contents("ozvv/sherkat.dat"); 
if(mb_stripos($mykon,"$cid")!==false){ 
      bot('sendmessage',[ 
        'chat_id'=>$cid,
        'text'=>"با عرض پوزش، شما قبلا در مسابقه شرکت کرده اید!", 
        'reply_markup'=>$key,
    ]); 
}else{ 
	$kanal1 = file_get_contents("kanal.txt");
	$gamer=file_get_contents("ozvv/sherkat.dat"); 
	file_put_contents("ozvv/sherkat.dat", "$gamer\n$cid");
			bot('sendmessage',[
			'chat_id'=>"@$kanal1",
			"text"=>"[$name](tg://user?id=$cid) 👁️Prasmostr شروع به جمع آوری کنید
 
 🤝 برای شما آرزوی موفقیت داریم. قطعا برنده باش🏆
 
 👑 آیا شما هم می خواهید در مسابقه شرکت کنید؟
 
 🌀 در آن صورت در مسابقه شرکت کنید
 
 🔘 با زدن دکمه از مسابقه مطلع شوید

[📣 کانال ما️](t.me/$kanal1)",
'parse_mode'=>"markdown",
'inline_query_id'=>$qid, 
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"شرکت در مسابقه 🏁", "url"=>"https://telegram.me/KralLikeBot"]],  // یوزرنیم ربات خود را جایگزین کنید 
       ] 
       ]) 
       ]);
sleep(1);
file_put_contents("data/$cid/dasturr.txt","");
bot('Sendmessage',[
'chat_id'=>$cid,
'text'=>"*👌اکنون شما یکی از شرکت‌کنندگان مسابقه هستید \n می‌توانید @$kanal1 را وارد کنید \nشروع به جمع‌آوری Prasmostr کنید موفق باشید برای شما *",
'parse_mode'=>"markdown",
'reply_markup'=>$key,
    ]);  
  }
}

if($tx=="👁️Prasmostr"){ 
$mykon=file_get_contents("ozvv/sherkat.dat"); 
if(mb_stripos($mykon,"$cid")!==false){ 
      bot('sendmessage',[ 
        'chat_id'=>$cid,
        'text'=>"با عرض پوزش، شما قبلا در مسابقه شرکت کرده اید!", 
        'reply_markup'=>$key,
    ]); 
}else{ 
     bot('sendmessage',[ 
        'chat_id'=>$cid, 
        'text'=>"شما Prasmostr را برای شرکت در مسابقه انتخاب کردید
 شما نیازی به نوشتن نام خود ندارید.
ما به طور خودکار نام شما را می نویسیم
ما آن را می گیریم و به مسابقه اضافه می کنیم
شما در کانال @$kanal1 باشید و
جایگاه خود را پیدا کنید", 
        'reply_markup'=>$pras,
    ]);  
  }
}
# سورس چالش بین ممبرا این سورس دو نوع داره یکیش Like و یکی دیگش Prasmostr 
# نویسنده این سورس @mrkral میباشد
# اولین بار در کانال @MeshkiTm و @irkral اوپن شده - اسکی با منیع.