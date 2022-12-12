<?php
    $servername = "localhost";
    $username = "p518662_crm";
    $password = "Bonaqua12345#$";
    $dbname = "p518662_crm";

    $topic = "Задачи на день";                    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;";
    $headers .= "From: crm@nedicom.ru";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT * FROM users";
        
        $result = $conn->query($sql);
            
                while($row = mysqli_fetch_assoc($result)){
                    $allusersarr[$row['id']]['id'] = $row['id'];
                    $allusersarr[$row['id']]['email'] = $row['email'];
                    $allusersarr[$row['id']]['name'] = $row['name'];
                };
           
                foreach($allusersarr as $key => $val){
                    $to  = $val['email'];
                    $query = "SELECT * FROM tasks WHERE lawyer = $key AND (status = 'в работе' OR status = 'просрочена') ORDER BY status";
                    $resulttask = $conn->query($query);
                        $msg = "<p style='font-size:20pt; font-style:bold; color:#006699;'>Привет, ". $val['name']."</p><ul>Сегодня у тебя:";
                        
                         while($task = mysqli_fetch_assoc($resulttask)){
                            $task_array[$task['id']]['id'] = $task['id'];
                            $task_array[$task['id']]['name'] = $task['name'];
                        }
                            foreach($task_array as $name){
                              $msg2 = "<li>".$name['name']." - <a href = 'https://crm.nedicom.ru/tasks/".$name['id']."'>посмотреть</a></li>";
                            }

                        $msg3 = "</ul>";
                        $message = $msg.$msg2.$msg3;
                        $topic = "Задачи на день";                    
                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html;";
                        $headers .= "From: crm@nedicom.ru";
                        mail("m6132@yandex.ru",$topic,$message,$headers); 
                        
                        echo($msg);

                };
                    




                


         
    

