<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
    <head>
        <title>get form</title>
    </head>
    <body>
        <?php
            $name = $_POST["name"];         //氏名を取得
            $gender = $_POST["gender"];     //性別を取得
            $major = $_POST["prefectures"]; //出身地を取得
            //チェックボックスからデータを取得する
            $num_of_check = count( $_POST['used_os'] ); //チェックされた数を取得
            for( $get_cbox = 0; $get_cbox < $num_of_check; $get_cbox++ ) {
                //チェックボックするのデータは$_post['os'][]という形で格納されている
                $os[$get_cbox] = $_POST['used_os'][$get_cbox];
            }
            $opinion = $_POST["opinion"]; //意見を取得
            //各データ出力
            printf("氏名 = %s<br>",$name);
            printf("性別 = %s<br>",$gender);
            printf("出身地 = %s<br>",$major);
            printf("隠しパラメータ = %s<br>",$_POST["hoge"]);
            foreach ($os as $value) {
                printf("使用経験OS = %s<br>",$value);
            }
            printf("意見 = %s<br>",$opinion);
        ?>
    </body>
</html>
