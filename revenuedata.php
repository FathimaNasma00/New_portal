 <?php 
                        include('db_connect.php');
                        $result = mysqli_query($conn, "SELECT month as monthname, 
                        SUM(amount) as amount 
                        FROM sale_target
                        GROUP BY month
                        order by id asc");
                        $data = array();
                        while ($row = mysqli_fetch_object($result))
                        {
                            array_push($data, $row);
                        }
                        
                        echo json_encode($data);
                        exit();
                      ?>