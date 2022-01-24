enchant();

var BG01_IMAGE = "avatarBg1.png";
var BG02_IMAGE = "avatarBg2.png";
var BG03_IMAGE = "avatarBg3.png";

var score = 0;

//弾数
var tamares = 1;

//キル数
var kill = 0;

//フェーズ数
var pha = 1;

//スポンスピード
var spawn = 50;

//スクロールスピード
var scspeed = 1;

//アニメーションスピード
var anspeed = 9;

window.onload = function() {
    game = new Game(320, 320);
    game.preload('chara1.png','icon0.png',BG01_IMAGE, BG02_IMAGE, BG03_IMAGE);
    
    //キーバインド
    game.keybind('A'.charCodeAt(0), 'a');
    game.keybind('W'.charCodeAt(0), 'w');
    game.keybind('S'.charCodeAt(0), 's');
    game.keybind('D'.charCodeAt(0), 'd');
    game.keybind(' '.charCodeAt(0), 'q');
    
    game.onload = function() {
    	// 背景色を変更
        game.rootScene.backgroundColor = "black";
    	
        // 背景を生成, 表示
        bg = new AvatarBG(4);
        bg.y = 50;
        game.rootScene.addChild(bg);
        
        //残弾数のラベル
        bullet = new Label("弾数 : 1");
        bullet.moveTo(10, 230);
        bullet.color = "white";
        game.rootScene.addChild(bullet);
        
        // スコアを生成, 表示
        scoreLabel = new ScoreLabel(50, 25);
        scoreLabel.moveTo(70, 20);
        scoreLabel.score = 0;
        game.rootScene.addChild(scoreLabel);
        
        
        // ライフラベルを生成, 表示
        lifeLabel = new LifeLabel(180, 230, 3);
        lifeLabel.life=3;
        game.rootScene.addChild(lifeLabel);
        
        //プレイヤー生成
        player = new Player();
        
        game.rootScene.onenterframe= function(){
	        //プレイヤーの移動
	        var input = game.input;
	        
	        if (input.a === true) {  player.x -= 5; }
	        if (input.w === true) {  player.y -= 5; }
	        if (input.s === true) {  player.y += 5; }
	        if (input.d === true) {  player.x += 5; }
	        
	        if ( player.x <= -10){  player.x = -10;}
	        if ( player.x >= 295){  player.x = 295;}
	        
	        if ( player.y <= 115){  player.y = 115;}
	        if ( player.y >= 195){  player.y = 195;}
	        
	        // フレームアニメーション
            if(game.frame % anspeed == 0) {
	            if(game.frame % 2 == 0){
	            	player.frame = 1;
	            }else{
	            	player.frame = 2;
	            }
	        }
	        
	        //ライフが0になる
	        if (lifeLabel.life <= 0) {
	        	
	        	player.frame = 3;
	        	
	        	$.ajax({
					type: "POST",
					url: "scoreupdate.php",
					async: true, 
					data:{"score":score}
				});
	        	
	        	//ゲームオーバー
                game.end();
            }
            
            //弾数のラベル更新
            bullet.text = "弾数 : "+tamares;
	        
	        // 背景スクロール
            bg.scroll(game.frame*scspeed);
	        
	        //敵出現
            if(game.frame%spawn==0){
                game.rootScene.addChild(new Enemy(32, 32));
            }
            
            //クリック
	        game.rootScene.ontouchstart = function() {
	        	//弾数が0以上の時,発射可能
	        	if(tamares > 0){
		        	//弾発射
		    		tama=new Tama(player.x,player.y);
		    	}
	    		
	    		//弾数を1減らす
	    		tamares--;
	    		
	    		//0以下の時,0にする
	    		if(tamares <= 0){
	    			tamares = 0;
	    		}
	        }
	     }
    }
    game.start();
}

//プレイヤークラス
var Player = enchant.Class.create(Sprite, {
    initialize: function(){
        Sprite.call(this, 32, 32);
        this.x = 50;
        this.y = 150;
        this.image = game.assets['chara1.png'];
        game.rootScene.addChild(this);
    },
	
    ontouchstart: function(){
        this.frame = 2;
    },
});

//弾クラス
Tama = enchant.Class.create(Sprite, {
    initialize: function(x,y) {
        Sprite.call(this, 16, 16);
        this.image = game.assets['icon0.png'];
        this.frame = 15;
        
        this.x = x+20;
		this.y = y+5;
		
        game.rootScene.addChild(this);
    },
    
    onenterframe: function() {
        this.x += 10;
        
        //弾と敵の当たり判定
        Tama.intersect(Enemy).forEach(function(p) {
            game.rootScene.removeChild(p[1]);
            game.rootScene.removeChild(p[0]);
            
            //スコア加算   フェーズが上がるごとに増える
            scoreLabel.score += 10*pha;
            score += 10*pha;
            
            //キル数加算
            kill++;
            
            //キルをすると弾数が1増加
            tamares = tamares + 1;
            
            
            //10キルすると
            if(kill>=10){
            	//キル数初期化
            	kill=0;
            	
            	//フェーズ1段上昇
            	pha++;
            	
            	//スクロールスピード増加
            	scspeed++;
            	
            	//スポンスピード増加
            	spawn = spawn / 2;
            	
            	if(spawn <= 10){
            		spawn = 10;
            	}
            	
            	//アニメーションスピード増加
            	anspeed = anspeed -2;
            	
            	if(anspeed <= 1){
            		anspeed = 1;
            	}
            }
        });
        
        //指定範囲外になったら消す
        if(this.x > 300){
        	game.rootScene.removeChild(this);
        }
    }
});


//敵クラス
Enemy = enchant.Class.create(Sprite, {
    initialize: function(width, height) {
        enchant.Sprite.call(this, width, height);
        
        this.image = game.assets['chara1.png'];
        
        this.frame = 5;   
        this.scaleX = -1; 
        
        this.x = 320;
        this.y = Math.random() * (195+ 1 - 115) + 115;
         
    },
    
    onenterframe: function() {
    	//フェーズが上がる毎に歩行速度上昇
        this.x += -pha;
        
        //敵とプレイヤーの当たり判定
        if (this.intersect(player)) {
        	//自身を消す
        	game.rootScene.removeChild(this);
        	
        	//ライフを1減らす
        	lifeLabel.life -= 1;
        	
        	//ライフが減ると弾数3増加
            tamares = tamares + 3;
        }
        
        //指定範囲外になったらゲームオーバー
        if(this.x < -20){
        	player.frame = 3;
        	
        	$.ajax({
				type: "POST",
				url: "scoreupdate.php",
				async: true, 
				data:{"score":score}
			});
			
        	game.end();
        }
        
        
        //フレームアニメーション
        if(game.frame % anspeed == 0) {
	        if(game.frame % 2 == 0){
	        	this.frame = 6;
	        }else{
	         	this.frame = 7;
	        }
        }
    }
});
