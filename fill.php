
<form action="fill.php" method="post">
   
    <input type="text" name="tag">
    <input type="text" name="pos">
    <input type="date" name="frm_date">
    <input type="date" name="to_date">
    <input type="submit" name="submit" value="search jobs" />
    </form>


<?php
    include "db_connect.php";
    if(isset($_POST['submit']))
    {
        $tags = $_POST["tag"];
        $pos=$_POST['pos'];
        $frm_date=$_POST['frm_date'];
        $fdate=strtotime($frm_date);
        $fdate=date("Y/m/d",$fdate);
        
        $to_date=$_POST['to_date'];
        $tdate=strtotime($to_date);
        $tdate=date("Y/m/d",$tdate);
        
        if($tags != "" || $pos != "" || $fdate != "" || $tdate != "")
        {
           $query="SELECT * FROM documents WHERE tag REGEXP '$tags' OR industry='$pos' OR date >= '$fdate' AND date <= '$tdate' ";
            
            $data = mysqli_query($conn, $query) or die ('error');
            if(mysqli_num_rows($data) > 0){
                while($row = mysqli_fetch_assoc($data)){
                    echo $row['title'];
                    echo $row['tag'];
                    echo $row['industry'];
                    echo $row['recuiter'];
                }
                
            }
            else{
                echo "ERROR";
            }
        }
        
    }
    
    ?>

    