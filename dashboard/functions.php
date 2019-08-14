<?php 

//dashboard functions
include("db.php");
$name = $_SESSION['name'];
$query = "SELECT * FROM users WHERE username = '".$name."' LIMIT 1";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);
if ($rows == 1){
    $credit = $data['credit'];
    $email = $data['email'];
    $role = $data['role'];
    $pending = $data['pending'];
}
else {
    echo mysqli_error($con);
}

//getting all users
$query2 = "SELECT * FROM users";
$result2 = mysqli_query($con,$query2);
$data2 = mysqli_fetch_assoc($result2);
$total_users = mysqli_num_rows($result2);


//geting all patient
$query3 = "SELECT * FROM patient";
$result3 = mysqli_query($con,$query3);
$data3 = mysqli_fetch_assoc($result3);
$total_patients = mysqli_num_rows($result3);

//geting all symptoms
$query4 = "SELECT * FROM symptoms";
$result4 = mysqli_query($con,$query4);
$data4 = mysqli_fetch_assoc($result4);
$total_symptoms = mysqli_num_rows($result4);

//geting all medicines
$query5 = "SELECT * FROM medicines";
$result5 = mysqli_query($con,$query5);
$total_medicines = mysqli_num_rows($result5);
$medrow = mysqli_fetch_assoc($result5);

//showing all medicine to table
function showmedicine($con){
    $query6 = "SELECT * FROM medicines ORDER BY id ASC limit 10";
    $result6 = mysqli_query($con,$query6);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result6)){

        echo '<tr> 
                  <td>'.$medrow["id"].'</td> 
                  <td>'.$medrow["name"].'</td> 
                  <td>'.$medrow["shortform"].'</td> 
                  <td>'.$medrow["chapter"].'</td> 
                  <td>'.$medrow["subchapter"].'</td> 
                  <td>'.$medrow["source"].'</td>
                  <td>'.$medrow["prover"].'</td>
                  <td>'.$medrow["type"].'</td>
                  <td>'.$medrow["addedby"].'</td>
                  <td>
                    <center>
                        <div class="btn-icon-list">
                        <a href="" data-toggle="modal" data-target="#modaldemo1'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                            
                            <button class="btn btn-danger btn-icon"><i
                                    class="la la-times-circle"></i></button>
                        </div>

                    </center>
                    <center>
                    <div id="modaldemo1'.$i.'" class="modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Edit Medicine</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                            
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" value="'.$medrow["name"].'">
                                </div><!-- form-group -->

                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Medicine Short Form" value="'.$medrow["shortform"].'">
                                </div><!-- form-group -->

                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Chapter" value="'.$medrow["chapter"].'">
                                </div><!-- form-group -->

                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Sub Chapter" value="'.$medrow["subchapter"].'">
                                </div><!-- form-group -->

                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Source" value="'.$medrow["source"].'">
                                </div><!-- form-group -->

                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Prover" value="'.$medrow["prover"].'">
                                </div><!-- form-group --> 

                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Type" value="'.$medrow["type"].'">
                                </div><!-- form-group -->
                            
                                <button class="btn btn-az-primary pd-x-20">Update</button>
                            </div>
                            </div>
                            </div>
                        </div><!-- modal-dialog -->
                        </div><!-- modal -->
                    </center>
                </td>
              </tr>';
        $i++;
    }
}