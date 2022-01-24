<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
    <head>
        <title>get form</title>
    </head>
    <body>
        <?php
            $name = $_GET["name"];         //氏名を取得
            $sex  = $_GET["sex"];          //性別を取得
            $major = $_GET["prefectures"]; //出身地を取得
            //チェックボックスからデータを取得する       
            for( $get_cbox = 0; $get_cbox < count( $_GET['used_os'] ); $get_cbox++ ) {
                //チェックボックするのデータは$_GET['os'][]という形で格納されている
                $os[$get_cbox] = $_GET['used_os'][$get_cbox];
            }
            $opinion = $_GET["opinion"]; //意見を取得
            //各データ出力
            printf("氏名 = %s<br>",$name);
            printf("性別 = %s<br>",$sex);
            printf("出身地 = %s<br>",$major);
            foreach ($os as $value) {
                printf("使用経験OS = %s<br>",$value);
            }
            printf("意見 = %s<br>",$opinion);
        ?>
    </body>
</html>
