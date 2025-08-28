<?php
include 'db_connect.php';
if(isset($_POST['action'])){
    $output='';
    if($_POST['action'] == 'fetchData'){
        $query = "
             SELECT * FROM documents 
            JOIN status ON status.status_id = documents.status ORDER BY documents.id DESC 
            ";
        getData($query);
    }
    if($_POST['action']=='searchRecord'){
        $emp_name = $_POST['emp_name'];
        
        $query = "
             SELECT * FROM documents 
            JOIN status ON status.status_id = documents.status
            WHERE tag LIKE '%$emp_name%'
            ORDER BY documents.id DESC 
            ";
        getData($query);
        
        
    }

    if($_POST['action']=='searchByStatus'){
        $status_id = $_POST['status_id'];
         $query = "
             SELECT * FROM documents 
            JOIN status ON status.status_id = documents.status
            WHERE documents.status = '$status_id' 
            ORDER BY documents.id DESC 
            ";
        getData($query);
        
    } 
    if($_POST['action']=='searchByRecuiter'){
        $recuiter_id = $_POST['recuiter_id'];
         $query = "
             SELECT * FROM documents 
            JOIN status ON status.status_id = documents.status
            WHERE documents.recruiter = '$recuiter_id' 
            ORDER BY documents.id DESC 
            ";
        getData($query);
        
    }
    
}

function getData($query){
    include 'db_connect.php';
    $output ="";
    $x=1;
    $total_row = mysqli_query($conn, $query) or die ('error');
    if(mysqli_num_rows($total_row)>0){
        foreach($total_row as $row ){
            $output .='
                <tr>
                 <td>'.$x++.'</td>
                <td>'.$row['title'].' '.$row['last_name'].'</td>
                <td>'.$row['recruiter'].'</td>
                <td>'.$row['status'].'</td>
                 <td>'.$row['tag'].'</td>
                 <td>'.$row['date'].'</td>
                <td>
                <a  href="./index.php?page=view_documentz&id='.$row['id'].'" class="btn btn-info btn-flat">
                <i class="fas fa-eye"></i> VIEW
                </a>
                 </td>
                
                
                </tr>
            ';
            
        }
    }else{
        $output ="<h4>POST NOT FOUND!";
    }
    echo $output;
    
}

?>












