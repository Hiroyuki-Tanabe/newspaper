<?php

$command="/Users/tianbianhongzhi/.pyenv/shims/python exec_from_php.py 2>&1";
exec($command,$output);

$command="/Users/tianbianhongzhi/.pyenv/shims/python nikkei.py 2>&1";
exec($command,$output2);

$command="/Users/tianbianhongzhi/.pyenv/shims/python newspicks.py 2>&1";
exec($command,$output3);

// ここから処理を記述
// じゃんけんの手を配列に代入
$hands = ['グー', 'チョキ', 'パー'];

// プレイヤーの手がPOSTされたら
if (isset($_POST['playerHand'])) {
    // プレイヤーの手を代入
    $playerHand = $_POST['playerHand'];

    // PCの手をランダムで選択
    $key = array_rand($hands);
    $pcHand = $hands[$key];

    // 勝敗を判定
    if ($playerHand == $pcHand) {
        $result ='あいこ';
    } elseif ($playerHand == 'グー' && $pcHand == 'チョキ') {
        $result = '勝ち';
    } elseif ($playerHand == 'チョキ' && $pcHand == 'パー') {
        $result = '勝ち';
    } elseif ($playerHand == 'パー' && $pcHand == 'グー') {
        $result = '勝ち';
    } else {
        $result = '負け';
    }
}

// ファイルに書き込み
$time = date('Y-m-d H:i:s');

$file = fopen('./data/data.txt', 'a');
fwrite($file, $time .' '. $result .  "\n");


// ファイルを読み込み
$openfile = fopen('./data/data.txt', 'r');

// ファイル内容を1行ずつ読み込んで出力= fgets
// whileは()の中身がfalseになると、処理を終了
$history =[];
$num_victory = 0;
$num_lost = 0;
$num_tie = 0;

while($line = fgets($openfile)) {
    array_push($history, $line);
    if(strpos($line,'勝ち') !== false){
        //'abcd'のなかに'bc'が含まれている場合
        $num_victory = $num_victory + 1;

      }else if(strpos($line,'負け') !== false){
        $num_lost = $num_lost + 1;

      }else {
        $num_tie = $num_tie + 1;
      }
}

// 勝ち、負け、あいこの数を数える
// var_dump($num_victory);
// echo "おはよう";

fclose($file);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>じゃんけん</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
</head>

<body>
    <!-- left side -->
    <div id="left">

        <div id="upper_left">
            <nav class="navbar navbar-light bg-light title">
            <a class="navbar-brand" href="#">
            <img src="img/entertainment.jpg" width="30" height="30" alt="">
            エンタメ
            </a>
            </nav>

            <div class="form-box">
                <form action="" method="post">
                    <label>
                        <input type="radio" title="playerHand" name="playerHand" value="グー" checked>グー
                    </label>
                    <label>
                        <input type="radio" title="playerHand" name="playerHand" value="チョキ">チョキ
                    </label>
                    <label>
                        <input type="radio" title="playerHand" name="playerHand" value="パー">パー
                    </label>
                    <button type="submit" class="battle-button">勝負する！</button>
                </form>
            </div>
            <h1>結果は・・・</h1>
            <div class="result-box">
                <p class="result-word"><?= $result ?>！</p>

                あなた：<?= $playerHand ?><br>
                コンピューター：<?= $pcHand ?><br>

            </div>

            <div id="result">
                <table>
                    <tr align="left">
                    <th>勝利数：</th>
                    <td id="victory"><?php echo $num_victory; ?></td>
                    </tr>
                    <tr align="left">
                    <th>敗北数：</th>
                    <td id="lost"><?php echo $num_lost ; ?></td>
                    </tr>
                    <tr align="left">
                    <th>引き分け数：</th>
                    <td id="tie"><?php echo $num_tie ; ?></td>
                    </tr>
                </table>
            </div>
            
        </div>

        <div id="bottom_left">
            <canvas id="stage"></canvas>
        </div>


    </div>
    <!-- right side -->
    <div id="right">
        <nav class="navbar navbar-light bg-light title">
                        <a class="navbar-brand" href="#">
                        <img src="img/economy.png" width="30" height="30" alt="">
                        政治経済
                        </a>
        </nav> 

        <div id="economy">
            <div id="elem1">
                <nav class="navbar navbar-light bg-light title">
                            <a class="navbar-brand" href="#">
                            <img src="img/nikkei.png" width="30" height="30" alt="">
                            日経
                            </a>
                </nav> 
                
           
                <?php foreach($output2 as $value){
                    echo $value;
                    // echo nl2br("/n");
                    echo '<br>';
                    } ?>

                <div id="more"></div>

                <button id="button">>>もっと見る</button>

            </div>
            <div id="elem2">

                <nav class="navbar navbar-light bg-light title">
                                <a class="navbar-brand" href="#">
                                <img src="img/newspicks.jpg" width="30" height="30" alt="">
                                Newspicks
                                </a>
                </nav>

                <?php foreach($output3 as $value){
                        echo $value;
                        // echo nl2br("/n");
                        echo '<br>';
                        } ?>

                <div id="more2"></div>

                <button id="button2">>>もっと見る</button>

            </div>

            

        </div>



        <div id="chat">
        <nav class="navbar navbar-light bg-light title">
                <a class="navbar-brand" href="#">
                <img src="img/slack.png" width="30" height="30" alt="">
                slackトーク履歴
                </a>
            </nav> 
            <?php foreach($output as $value){
                echo $value;
                // echo nl2br("/n");
                echo '<br>';
                } ?>
        </div>
        
    </div>


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>

<script>
    var num_victory='<?php echo $num_victory; ?>';
    var num_lost='<?php echo $num_lost; ?>';
    var num_tie='<?php echo $num_tie; ?>';
</script>
<script src="sample.js"></script>