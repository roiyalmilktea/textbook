//スムーススクロール
$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('[href^=#]').click(function() {
      // スクロールの速度
      var speed = 1000;// ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#top" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
	  var sclpos = 30;
	  var scldurat = 1200;
      $('body,html').animate({scrollTop: position}, {duration: scldurat, easing: "easeOutExpo"});
	  
      return false;
   });
});
$(function(){
    $("#acrbtn").click(function () {
      $("#commentDescription").toggle("normal");
    });
});

//選択肢トグル　※選択肢によって表示要素を変更
$(function() {
    $('input[name="data[term]"]:radio').change(function() {
												  
        if ($('input[name="data[term]"]:checked').val() == "1") {
            $('#termYmdList').fadeIn();
        }else{
            $('#termYmdList').fadeOut();
		}
		
    }).trigger('change');
});
