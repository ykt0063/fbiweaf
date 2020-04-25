var ptlock = new PatternLock("#patternContainer");
var ptlockKey;
ptlock.option('matrix',[5,5]);
ptlock.option('margin',10);
ptlock.option('radius',50);



$("a.Signin").click(function(){
  ptlockKey=ptlock.getPattern();
  $.trim($('#patternPassword').val(ptlockKey));
  ptlock.reset();
  cLogin();
//  $("#result").html("input key is"+ptlockKey.toString());
//  
});
$("button#check").click(function(){
  var tmpKey = ptlock.getPattern();
  ptlock.reset();
  if (ptlockKey.toString()==tmpKey.toString()){
    alert("ok");
  }
  else{
    alert("not ok");
  }
  // lock.checkForPattern(lockKey.toString(),function(){
  //   alert("ok");
  // },function(){
  //   alert("not ok");
  // })
})
