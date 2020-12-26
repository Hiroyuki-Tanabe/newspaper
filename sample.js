console.log('ガンバれ');

console.log(num_victory);
console.log(num_lost);


//「月別データ」
var mydata = {
    labels: ["勝ち", "負け", "あいこ"],
    datasets: [
      {
        label: '数量',
        hoverBackgroundColor: "rgba(255,99,132,0.3)",
        data: [num_victory, num_lost, num_tie],
      }
    ]
  };
  
  //「オプション設定」
  var options = {
    title: {    
      display: true,
      text: '戦歴'
    }
  };
  
  var canvas = document.getElementById('stage');
  var chart = new Chart(canvas, {
  
    type: 'bar',  //グラフの種類
    data: mydata,  //表示するデータ
    options: options  //オプション設定
  
  });

  // $('#button').on('click', function() {
  //   alert("クリックされました");
  // });

  // $('#button').on('click', function(){
  //   // $('#result').text('通信中...');
  //   // Ajax通信を開始
  //   $.ajax({
  //     url: 'nikkei2.py',
  //     type: 'GET',
  //     // dataType: 'json',
  //   })
  //   .done(function(data) {
  //       // 通信成功時の処理を記述
  //       response = data;
  //       console.log("成功");
  //       console.log(response);
  //   })
  //   .fail(function() {
  //       // 通信失敗時の処理を記述
  //       console.log("失敗");
  //   });
  // })

    $('#button').on('click', function(){
    // $('#result').text('通信中...');
    // Ajax通信を開始
    $(function(){
      $.ajax({
          url: 'nikkei2.py',
          type: 'get',
          context: document.body,
          dataType: "text",
          data: {data:'テスト'}
      }).done(function(data){
          console.log(data);
      }).fail(function(){
          console.log('failed');
      });
  });

  })