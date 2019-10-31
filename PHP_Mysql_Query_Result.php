<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
      require("connectMysql2.php");
	  //使用來自connectMysql2.php中的函式create_connection()
      $db_link = create_connection();
	  //設定SQL指令
      $sql = "select * from employee order by num";
	  //使用來自connectMysql2.php中的函式execute_sql()，帶入$db_link、"mydb"、$sql這3項參數
      $result = execute_sql($db_link, "mydb", $sql);
	  //使用mysqli_num_fields()取得欄位的數目
	  $len = mysqli_num_fields($result);	
	  //html table tag開始，進行table相關設定(寬800、表格框線寬1、置中對齊)
      echo "<table width='800' border='1' align='center'><tr align='center'>";
      for($n=0; $n<$len; $n++)   // 顯示欄位名稱
        echo "<th>" . mysqli_fetch_field_direct($result, $n)->name. "</th>";//因為是標題，所以使用<th></th>tag
      echo "</tr>";
	
      while($row = mysqli_fetch_row($result))//取得SQL回傳的資料
      {
        echo "<tr>";			
        for($n = 0; $n < $len; $n++){
          echo "<td>$row[$n]</td>";	//因為是內容，所以使用<td></td>tag
		}			
        echo "</tr>";				
      }
	  //html table tag結束
      echo "</table>" ;
	  //釋出回傳結果物件-$result的記憶體空間
      mysqli_free_result($result);
	  //中斷與SQL的連線
      mysqli_close($db_link);
    ?> 
  </body>
</html>