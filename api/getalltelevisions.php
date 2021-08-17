<?php
   ini_set("date.timezone", "Asia/Kuala_Lumpur");
   require_once('db.php');

   class Televisions {
      var $televid;
      var $company;
      var $size;
      var $price;
      var $type; 
   }

   function time_elapsed_string($datetime, $full = false) {

      if ($datetime == '0000-00-00 00:00:00')
         return "none";

      if ($datetime == '0000-00-00')
         return "none";

      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
         'y' => 'year',
         'm' => 'month',
         'w' => 'week',
         'd' => 'day',
         'h' => 'hour',
         'i' => 'minute',
         's' => 'second',
      );
      
      foreach ($string as $k => &$v) {
         if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
         } else {
            unset($string[$k]);
         }
      }

      if (!$full) $string = array_slice($string, 0, 1);
         return $string ? implode(', ', $string) . ' ago' : 'just now';
   }

 

   try
   {
      $selectAlltelevisionstmt->execute();

      $row_count = $selectAlltelevisionstmt->rowCount(); 
         
      if ($row_count) 
      {
         $data = array();
             
         while($row = $selectAlltelevisionstmt->fetch(PDO::FETCH_ASSOC)) 
         {           
            $televisions = new Televisions();
            $televisions->televid = $row['televid'];
            $televisions->type = $row['type'];
            $televisions->size = $row['size'];
            $televisions->company = $row['company'];
            $televisions->price = $row['price'];
            array_push($data, $televisions);
         }
             
         echo json_encode($data);
         exit;
      } 
      else 
      {
         $data = array();
         echo json_encode($data);
         exit;
      }
   }
   catch(PDOException $e) 
   {
       die('ERROR: ' . $e->getMessage());
   } 