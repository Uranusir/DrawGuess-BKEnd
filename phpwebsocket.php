<?php  
// Run from command prompt > php -q chatbot.demo.php
include "websocket.class.php";
// Extended basic WebSocket as ChatBot
class DrawGuessBKEnd extends WebSocket{
  function process($user,$msg){
    $this->say("< ".$msg);
    switch($msg){
      case "hello" : $this->send($user->socket,"hello human");                       break;
      case "hi"    : $this->send($user->socket,"zup human");                         break;
      case "name"  : $this->send($user->socket,"my name is Multivac, silly I know"); break;
      case "age"   : $this->send($user->socket,"I am older than time itself");       break;
      case "date"  : $this->send($user->socket,"today is ".date("Y.m.d"));           break;
      case "time"  : $this->send($user->socket,"server time is ".date("H:i:s"));     break;
      case "thanks": $this->send($user->socket,"you're welcome");                    break;
      case "bye"   : $this->send($user->socket,"bye");                               break;
      default      : $this->send($user->socket,$msg." not understood");              break;
    }
  }
}

/*创建房间
    选择词库，题目数
*/
function CreateRoom(){
    return "Create";
}

/*开始一个回合
    两个词选一个，然后开始60秒计时
*/
function TurnBegin(){
    return "begin";
}

/*随着画画实时更新数据库中的图像信息
*/
function UpdatePicture(){
    return "update";
}

/**
 * 接收答案和时间，对比答案是否正确，如果正确且计时器大于20秒则倒计时20秒结束。
 */
function Answer(){
    return "Answer";
}

/*一幅图片结束后
    结算分数写入数据库，清空画板，
    分数：
*/
function ThisTurnOver(){
    return "Over";
}
/*整句游戏结束后
    结算得分 输出排名 
    清空数据库中的部分数据
*/
function GameOver(){
    return "GameOver";
}

$master = new DrawGuessBKEnd("localhost",8888);