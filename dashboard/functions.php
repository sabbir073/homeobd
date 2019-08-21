<?php 

//dashboard functions
include("db.php");
$name = $_SESSION['name'];
$query = "SELECT * FROM users WHERE username = '".$name."' LIMIT 1";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);
if ($rows == 1){
    $myname =$data['username'];
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
$query5 = "SELECT * FROM medicines WHERE pending = 'Approved'";
$result5 = mysqli_query($con,$query5);
$total_medicines = mysqli_num_rows($result5);
$medrow = mysqli_fetch_assoc($result5);

//showing all medicine to table
function showmedicine($con,$role){
    $query6 = "SELECT * FROM medicines WHERE pending <> 'Pending' ORDER BY id DESC";
    $result6 = mysqli_query($con,$query6);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result6)){
        
        $medid = $medrow["id"];

        echo '<tr> 
                  <td>'.$medid.'</td> 
                  <td>'.$medrow["name"].'</td> 
                  <td>'.$medrow["shortform"].'</td> 
                  <td>'.$medrow["chapter"].'</td> 
                  <td>'.$medrow["source"].'</td>
                  <td>'.$medrow["type"].'</td>
                  <td>'.$medrow["addedby"].'</td>
                  
                  <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemoview'.$i.'"><button class="btn btn-indigo btn-icon"><i class="la la-eye"></i></button></a>
                          <center>
                      <div id="modaldemoview'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Details - '.$medrow["name"].'</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
                                <tbody>
                                    <tr>
                                    <th scope="row"><b>Name</b></th>
                                    <td>'.$medrow["name"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Short Form</b></th>
                                    <td>'.$medrow["shortform"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Chapter</b></th>
                                    <td>'.$medrow["chapter"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Sub Chapter</b></th>
                                    <td>'.$medrow["subchapter"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Source</b></th>
                                    <td>'.$medrow["source"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Prover</b></th>
                                    <td>'.$medrow["prover"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Type</b></th>
                                    <td>'.$medrow["type"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Added by</b></th>
                                    <td>'.$medrow["addedby"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Status</b></th>
                                    <td>'.$medrow["pending"].'</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div></br>
                            
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>';
                          if($role == "Admin"){
                          echo '<a href="" data-toggle="modal" data-target="#modaldemoedit'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemodel'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>

                      

                      <center>
                      <div id="modaldemoedit'.$i.'" class="modal">
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
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Name" name="medname'.$medid.'" value="'.$medrow["name"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medshort'.$medid.'" placeholder="Medicine Short Form" value="'.$medrow["shortform"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medchap'.$medid.'" placeholder="Chapter" value="'.$medrow["chapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsubchap'.$medid.'" placeholder="Sub Chapter" value="'.$medrow["subchapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsource'.$medid.'" placeholder="Source" value="'.$medrow["source"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medprov'.$medid.'" placeholder="Prover" value="'.$medrow["prover"].'">
                                  </div><!-- form-group --> 
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medtype'.$medid.'" placeholder="Type" value="'.$medrow["type"].'">
                                  </div><!-- form-group -->

                                  <div class="form-group">
                                  <select class="form-control" name="status'.$medid.'" id="sel11">';
                                    if($medrow["pending"] == "Approved"){
                                        echo '<option value="Approved" selected>Approved</option>
                                        <option value="Pending">Pending</option>';
                                    }
                                    elseif($medrow["pending"] == "Pending"){
                                        echo '<option value="Approved">Approved</option>
                                        <option value="Pending" selected>Pending</option>';
                                    }
                                    else{
                                        echo '<option value="">Choose Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>';
                                    }
                                  echo  '</select>
                                  </div><!-- form-group -->
                              
                                  <button value="'.$medid.'" name="subupdate" class="btn btn-az-primary pd-x-20">Update</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemodel'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete Medicine</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$medrow["name"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$medid.'" name="subdelete" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>';
                  }
                  
                  
                  
              echo '</tr>';
              
        $i++;
        
    }

    //medicine edit
    
    if(isset($_POST["subupdate"])){
        
        $id = $_POST["subupdate"];
        
        $medname = stripslashes($_REQUEST['medname'.$id.'']);
        $medname = mysqli_real_escape_string($con,$medname);

        $medshort = stripslashes($_REQUEST['medshort'.$id.'']);
        $medshort = mysqli_real_escape_string($con,$medshort);

        $medchap = stripslashes($_REQUEST['medchap'.$id.'']);
        $medchap = mysqli_real_escape_string($con,$medchap);

        $medsubchap = stripslashes($_REQUEST['medsubchap'.$id.'']);
        $medsubchap = mysqli_real_escape_string($con,$medsubchap);

        $medsource = stripslashes($_REQUEST['medsource'.$id.'']);
        $medsource = mysqli_real_escape_string($con,$medsource);

        $medprov = stripslashes($_REQUEST['medprov'.$id.'']);
        $medprov = mysqli_real_escape_string($con,$medprov);

        $medtype = stripslashes($_REQUEST['medtype'.$id.'']);
        $medtype = mysqli_real_escape_string($con,$medtype);

        $medstatus = stripslashes($_REQUEST['status'.$id.'']);
        $medstatus = mysqli_real_escape_string($con,$medstatus);


        $medquery = "UPDATE medicines SET name = '$medname', shortform = '$medshort', chapter = '$medchap', subchapter = '$medsubchap', source = '$medsource', prover = '$medprov', type = '$medtype', pending='$medstatus' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully edited medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> Medicine is not edited. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    //medicine Delete
    
    if(isset($_POST["subdelete"])){
        
        $delid = $_POST["subdelete"];

        $meddelquery = "DELETE FROM medicines WHERE id = $delid LIMIT 1";
        $mddelresult = mysqli_query($con,$meddelquery);

        if($mddelresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> Medicine is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    //add new medicine

    echo '<center>
    <div id="modaldemoadd" class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Medicine</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name"
                                    name="medname" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medshort"
                                    placeholder="Medicine Short Form" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medchap"
                                    placeholder="Chapter" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medsubchap"
                                    placeholder="Sub Chapter">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medsource"
                                    placeholder="Source" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medprov"
                                    placeholder="Prover">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medtype"
                                    placeholder="Type" required>
                            </div><!-- form-group -->

                            <button name="addmed" class="btn btn-az-primary pd-x-20">Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</center>';

//medine add to database

if(isset($_POST["addmed"])){
    
    $medname = stripslashes($_REQUEST['medname']);
    $medname = mysqli_real_escape_string($con,$medname);

    $medshort = stripslashes($_REQUEST['medshort']);
    $medshort = mysqli_real_escape_string($con,$medshort);

    $medchap = stripslashes($_REQUEST['medchap']);
    $medchap = mysqli_real_escape_string($con,$medchap);

    $medsubchap = stripslashes($_REQUEST['medsubchap']);
    $medsubchap = mysqli_real_escape_string($con,$medsubchap);

    $medsource = stripslashes($_REQUEST['medsource']);
    $medsource = mysqli_real_escape_string($con,$medsource);

    $medprov = stripslashes($_REQUEST['medprov']);
    $medprov = mysqli_real_escape_string($con,$medprov);

    $medtype = stripslashes($_REQUEST['medtype']);
    $medtype = mysqli_real_escape_string($con,$medtype);

    $addedby = $_SESSION['name'];


    $medaddquery = "INSERT into `medicines` (name, shortform, chapter, subchapter, source, prover, type, addedby)
            VALUES ('$medname', '$medshort', '$medchap', '$medsubchap', '$medsource', '$medprov', '$medtype','$addedby')";
    $mdaddresult = mysqli_query($con,$medaddquery);

    if($mdaddresult){
        echo '<div class="alert alert-success" role="alert">
                 <strong>Well done!</strong> You successfully added Medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
           
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
                 <strong>Something Wrong!</strong> Medicine is not added. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
    }
    
}
}

//pending medicine page functions

function pendingmedicine($con){
    $query7 = "SELECT * FROM medicines WHERE pending <> 'Approved' ORDER BY id DESC";
    $result7 = mysqli_query($con,$query7);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result7)){
        
        $medid = $medrow["id"];

        echo '<tr> 
                  <td>'.$medid.'</td> 
                  <td>'.$medrow["name"].'</td> 
                  <td>'.$medrow["shortform"].'</td> 
                  <td>'.$medrow["chapter"].'</td> 
                  <td>'.$medrow["subchapter"].'</td> 
                  <td>'.$medrow["source"].'</td>
                  <td>'.$medrow["type"].'</td>
                  <td>'.$medrow["addedby"].'</td>
                    
                   <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemo3'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-check-circle"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemo4'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>
                      <center>
                      <div id="modaldemo3'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Edit Medicine Before Approve</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Name" name="medname'.$medid.'" value="'.$medrow["name"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medshort'.$medid.'" placeholder="Medicine Short Form" value="'.$medrow["shortform"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medchap'.$medid.'" placeholder="Chapter" value="'.$medrow["chapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsubchap'.$medid.'" placeholder="Sub Chapter" value="'.$medrow["subchapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsource'.$medid.'" placeholder="Source" value="'.$medrow["source"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medprov'.$medid.'" placeholder="Prover" value="'.$medrow["prover"].'">
                                  </div><!-- form-group --> 
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medtype'.$medid.'" placeholder="Type" value="'.$medrow["type"].'">
                                  </div><!-- form-group -->
                              
                                  <button value="'.$medid.'" name="approvemed" class="btn btn-az-primary pd-x-20">Approve</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemo4'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete Medicine</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$medrow["name"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$medid.'" name="unapprove" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>

               </tr>';
              
        $i++;
        
    }

    //approve medicine
    
    if(isset($_POST["approvemed"])){
        
        $id = $_POST["approvemed"];
        
        $medname = stripslashes($_REQUEST['medname'.$id.'']);
        $medname = mysqli_real_escape_string($con,$medname);

        $medshort = stripslashes($_REQUEST['medshort'.$id.'']);
        $medshort = mysqli_real_escape_string($con,$medshort);

        $medchap = stripslashes($_REQUEST['medchap'.$id.'']);
        $medchap = mysqli_real_escape_string($con,$medchap);

        $medsubchap = stripslashes($_REQUEST['medsubchap'.$id.'']);
        $medsubchap = mysqli_real_escape_string($con,$medsubchap);

        $medsource = stripslashes($_REQUEST['medsource'.$id.'']);
        $medsource = mysqli_real_escape_string($con,$medsource);

        $medprov = stripslashes($_REQUEST['medprov'.$id.'']);
        $medprov = mysqli_real_escape_string($con,$medprov);

        $medtype = stripslashes($_REQUEST['medtype'.$id.'']);
        $medtype = mysqli_real_escape_string($con,$medtype);


        $medquery = "UPDATE medicines SET name = '$medname', shortform = '$medshort', chapter = '$medchap', subchapter = '$medsubchap', source = '$medsource', prover = '$medprov', type = '$medtype', pending = 'Approved' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> Medicine Approved. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> Medicine is not Approved. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    //medicine Delete
    
    if(isset($_POST["unapprove"])){
        
        $delid = $_POST["unapprove"];

        $meddelquery = "DELETE FROM medicines WHERE id = $delid LIMIT 1";
        $mddelresult = mysqli_query($con,$meddelquery);

        if($mddelresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> Medicine is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

}





//function to show menu admin and user basis

function adminmenu($role){
    if($role == "Admin"){
        echo '<div class="az-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item active show">
                <a href="index.php" style="position: relative;" class="nav-link"><i
                        class="typcn typcn-clipboard"></i>Dashboard</a>

            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-user"></i>Users</a>
                <nav class="nav-sub">
                    <a href="allusers.php" class="nav-sub-link">All Users</a>
                    <a href="pendinguser.php" class="nav-sub-link">Pending Users</a>
                    <a href="bannedusers.php" class="nav-sub-link">Banned Users</a>
                </nav>
            </li><!-- nav-item -->

            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-stethoscope" aria-hidden="true"></i>Symptoms</a>
                <nav class="nav-sub">
                    <a href="allsymptoms.php" class="nav-sub-link">All Symtoms</a>
                    <a href="pending-symptoms.html" class="nav-sub-link">Pending Symptoms</a>
                </nav>
            </li><!-- nav-item -->

            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-medkit" aria-hidden="true"></i>Medicines</a>
                <nav class="nav-sub">
                    <a href="allmedicines.php" class="nav-sub-link">All Medicines</a>
                    <a href="pendingmed.php" class="nav-sub-link">Pending Medicines</a>
                </nav>
            </li><!-- nav-item -->

            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-users" aria-hidden="true"></i>Patients</a>
                <nav class="nav-sub">
                    <a href="all-patients.html" class="nav-sub-link">All Patients</a>
                </nav>
            </li><!-- nav-item -->
            <li class="nav-item">
                <a href="" style="position: relative;" class="nav-link"><i class="fa fa-cog"
                        aria-hidden="true"></i>Settings</a>

            </li><!-- nav-item -->
        </ul><!-- nav -->
    </div><!-- az-sidebar-body -->';
    }
    else{
        echo '<div class="az-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item active show">
                <a href="index.php" style="position: relative;" class="nav-link"><i
                        class="typcn typcn-clipboard"></i>Dashboard</a>

            </li><!-- nav-item -->
           
            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-stethoscope" aria-hidden="true"></i>Symptoms</a>
                <nav class="nav-sub">
                    <a href="allsymptoms.php" class="nav-sub-link">All Symtoms</a>
                    <a href="all-symptoms.html" class="nav-sub-link">My Symtoms</a>

                </nav>
            </li><!-- nav-item -->

            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-medkit" aria-hidden="true"></i>Medicines</a>
                <nav class="nav-sub">
                    <a href="allmedicines.php" class="nav-sub-link">All Medicines</a>  
                    <a href="mymedicines.php" class="nav-sub-link">My Medicines</a>                   
                </nav>
            </li><!-- nav-item -->

            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-users" aria-hidden="true"></i>Patients</a>
                <nav class="nav-sub">
                    <a href="all-patients.html" class="nav-sub-link">My Patient</a>
                </nav>
            </li><!-- nav-item -->
        </ul><!-- nav -->
    </div><!-- az-sidebar-body -->';
    }
}


// My medicine page functions

function mymedicines($con,$myname){
    $query8 = "SELECT * FROM medicines WHERE addedby = '$myname' ORDER BY id DESC";
    $result8 = mysqli_query($con,$query8);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result8)){
        
        $medid = $medrow["id"];

        echo '<tr> 
                  <td>'.$medid.'</td> 
                  <td>'.$medrow["name"].'</td> 
                  <td>'.$medrow["shortform"].'</td> 
                  <td>'.$medrow["chapter"].'</td>
                  <td>'.$medrow["source"].'</td>
                  <td>'.$medrow["type"].'</td>
                  <td>'.$medrow["pending"].'</td>
                    
                  <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemoview'.$i.'"><button class="btn btn-indigo btn-icon"><i class="la la-eye"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemoedit'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemodel'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>
                      <center>
                      <div id="modaldemoview'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Details - '.$medrow["name"].'</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
                                <tbody>
                                    <tr>
                                    <th scope="row"><b>Name</b></th>
                                    <td>'.$medrow["name"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Short Form</b></th>
                                    <td>'.$medrow["shortform"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Chapter</b></th>
                                    <td>'.$medrow["chapter"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Sub Chapter</b></th>
                                    <td>'.$medrow["subchapter"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Source</b></th>
                                    <td>'.$medrow["source"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Prover</b></th>
                                    <td>'.$medrow["prover"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Type</b></th>
                                    <td>'.$medrow["type"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Added by</b></th>
                                    <td>'.$medrow["addedby"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Status</b></th>
                                    <td>'.$medrow["pending"].'</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div></br>
                            
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
                      <center>
                      <div id="modaldemoedit'.$i.'" class="modal">
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
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Name" name="medname'.$medid.'" value="'.$medrow["name"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medshort'.$medid.'" placeholder="Medicine Short Form" value="'.$medrow["shortform"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medchap'.$medid.'" placeholder="Chapter" value="'.$medrow["chapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsubchap'.$medid.'" placeholder="Sub Chapter" value="'.$medrow["subchapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsource'.$medid.'" placeholder="Source" value="'.$medrow["source"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medprov'.$medid.'" placeholder="Prover" value="'.$medrow["prover"].'">
                                  </div><!-- form-group --> 
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medtype'.$medid.'" placeholder="Type" value="'.$medrow["type"].'">
                                  </div><!-- form-group -->
                              
                                  <button value="'.$medid.'" name="myupdate" class="btn btn-az-primary pd-x-20">Update</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemodel'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete Medicine</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$medrow["name"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$medid.'" name="mydelete" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>
                  </tr>';
              
        $i++;
        
    }

    //add new medicine in my medicine page

    echo '<center>
    <div id="modaldemo13" class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add New Medicine</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name"
                                    name="medname">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medshort"
                                    placeholder="Medicine Short Form">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medchap"
                                    placeholder="Chapter">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medsubchap"
                                    placeholder="Sub Chapter">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medsource"
                                    placeholder="Source">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medprov"
                                    placeholder="Prover">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="medtype"
                                    placeholder="Type">
                            </div><!-- form-group -->

                            <button name="myaddmed" class="btn btn-az-primary pd-x-20">Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</center>';

//my medicine add
if(isset($_POST["myaddmed"])){
    
    $medname = stripslashes($_REQUEST['medname']);
    $medname = mysqli_real_escape_string($con,$medname);

    $medshort = stripslashes($_REQUEST['medshort']);
    $medshort = mysqli_real_escape_string($con,$medshort);

    $medchap = stripslashes($_REQUEST['medchap']);
    $medchap = mysqli_real_escape_string($con,$medchap);

    $medsubchap = stripslashes($_REQUEST['medsubchap']);
    $medsubchap = mysqli_real_escape_string($con,$medsubchap);

    $medsource = stripslashes($_REQUEST['medsource']);
    $medsource = mysqli_real_escape_string($con,$medsource);

    $medprov = stripslashes($_REQUEST['medprov']);
    $medprov = mysqli_real_escape_string($con,$medprov);

    $medtype = stripslashes($_REQUEST['medtype']);
    $medtype = mysqli_real_escape_string($con,$medtype);

    $addedby = $_SESSION['name'];


    $medaddquery = "INSERT into `medicines` (name, shortform, chapter, subchapter, source, prover, type, addedby)
            VALUES ('$medname', '$medshort', '$medchap', '$medsubchap', '$medsource', '$medprov', '$medtype','$addedby')";
    $mdaddresult = mysqli_query($con,$medaddquery);

    if($mdaddresult){
        echo '<div class="alert alert-success" role="alert">
                 <strong>Well done!</strong> You successfully added Medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
           
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
                 <strong>Something Wrong!</strong> Medicine is not added. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
    }
    
}


    //my medicine edit
    
    if(isset($_POST["myupdate"])){
        
        $id = $_POST["myupdate"];
        
        $medname = stripslashes($_REQUEST['medname'.$id.'']);
        $medname = mysqli_real_escape_string($con,$medname);

        $medshort = stripslashes($_REQUEST['medshort'.$id.'']);
        $medshort = mysqli_real_escape_string($con,$medshort);

        $medchap = stripslashes($_REQUEST['medchap'.$id.'']);
        $medchap = mysqli_real_escape_string($con,$medchap);

        $medsubchap = stripslashes($_REQUEST['medsubchap'.$id.'']);
        $medsubchap = mysqli_real_escape_string($con,$medsubchap);

        $medsource = stripslashes($_REQUEST['medsource'.$id.'']);
        $medsource = mysqli_real_escape_string($con,$medsource);

        $medprov = stripslashes($_REQUEST['medprov'.$id.'']);
        $medprov = mysqli_real_escape_string($con,$medprov);

        $medtype = stripslashes($_REQUEST['medtype'.$id.'']);
        $medtype = mysqli_real_escape_string($con,$medtype);


        $medquery = "UPDATE medicines SET name = '$medname', shortform = '$medshort', chapter = '$medchap', subchapter = '$medsubchap', source = '$medsource', prover = '$medprov', type = '$medtype', pending = 'Pending' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully edited medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> Medicine is not edited. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    //My medicine Delete
    
    if(isset($_POST["mydelete"])){
        
        $delid = $_POST["mydelete"];

        $meddelquery = "DELETE FROM medicines WHERE id = $delid LIMIT 1";
        $mddelresult = mysqli_query($con,$meddelquery);

        if($mddelresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted medicine. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> Medicine is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }
}


// All user functionality Protected to admin

//showing all User to table

function allusersshow($con){
    $query6 = "SELECT * FROM users ORDER BY id DESC";
    $result6 = mysqli_query($con,$query6);
    $i = 1;
    while($userrow = mysqli_fetch_assoc($result6)){
        
        $userid = $userrow["id"];

        echo '<tr> 
                  <td>'.$userid.'</td> 
                  <td>'.$userrow["username"].'</td> 
                  
                  <td>'.$userrow["phone"].'</td>
                  <td>'.$userrow["role"].'</td> 
                  <td>'.$userrow["credit"].'</td> 
                  <td>'.$userrow["pending"].'</td>
                  <td>'.$userrow["refferid"].'</td>
                  
                  <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemoview'.$i.'"><button class="btn btn-indigo btn-icon"><i class="la la-eye"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemoedit'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemodel'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>

                      <center>
                      <div id="modaldemoview'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Details - '.$userrow["username"].'</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
                                <tbody>
                                    <tr>
                                    <th scope="row"><b>Name</b></th>
                                    <td>'.$userrow["username"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Email</b></th>
                                    <td>'.$userrow["email"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Phone No</b></th>
                                    <td>'.$userrow["phone"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Role</b></th>
                                    <td>'.$userrow["role"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Total Credit</b></th>
                                    <td>'.$userrow["credit"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Status</b></th>
                                    <td>'.$userrow["pending"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Rffered by</b></th>
                                    <td>'.$userrow["refferid"].'</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div></br>
                            <button value="'.$userid.'" name="useractivity" class="btn btn-az-primary pd-x-20">View Activity</button>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>


                      <center>
                      <div id="modaldemoedit'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Edit User</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="User Name" name="username'.$userid.'" value="'.$userrow["username"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="useremail'.$userid.'" placeholder="User Email" value="'.$userrow["email"].'">
                                  </div><!-- form-group -->

                                  <div class="form-group">
                                  <input type="text" class="form-control" name="userphone'.$userid.'" placeholder="Phone Number" value="'.$userrow["phone"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <select class="form-control" name="role'.$userid.'" id="sel11">';
                                    if($userrow["role"] == "Admin"){
                                        echo '<option value="Admin" selected>Admin</option>
                                        <option value="Doctor">Doctor</option>';
                                    }
                                    elseif($userrow["role"] == "Doctor"){
                                        echo '<option value="Admin">Admin</option>
                                        <option value="Doctor" selected>Doctor</option>';
                                    }
                                    else{
                                        echo '<option value="">Choose One</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Doctor">Doctor</option>';
                                    }
                                  echo  '</select>
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="credit'.$userid.'" placeholder="Total Credit" value="'.$userrow["credit"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <select class="form-control" name="userstatus'.$userid.'" id="sel1">';
                                    if($userrow["pending"] == "Approved"){
                                        echo '<option value="Approved" selected>Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Banned">Banned</option>';
                                    }
                                    elseif($userrow["pending"] == "Pending"){
                                        echo '<option value="Approved">Approved</option>
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Banned">Banned</option>';
                                    }
                                    elseif($userrow["pending"] == "Banned"){
                                        echo '<option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Banned" selected>Banned</option>';
                                    }
                                    else{
                                        echo '<option value="">Choose One</option><option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Banned">Banned</option>';
                                    }
                                  echo  '</select>
                                  </div><!-- form-group -->
                              
                                  <button value="'.$userid.'" name="userupdate" class="btn btn-az-primary pd-x-20">Update</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemodel'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete User</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$userrow["username"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$userid.'" name="userdelete" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>
                  </tr>';
              
        $i++;
        
    }

    //user edit
    
    if(isset($_POST["userupdate"])){
        
        $id = $_POST["userupdate"];
        
        $usernam = stripslashes($_REQUEST['username'.$id.'']);
        $usernam = mysqli_real_escape_string($con,$usernam);

        $usermail = stripslashes($_REQUEST['useremail'.$id.'']);
        $usermail = mysqli_real_escape_string($con,$usermail);

        $userphone = stripslashes($_REQUEST['userphone'.$id.'']);
        $userphone = mysqli_real_escape_string($con,$userphone);

        $userrole = stripslashes($_REQUEST['role'.$id.'']);
        $userrole = mysqli_real_escape_string($con,$userrole);

        $usercredit = stripslashes($_REQUEST['credit'.$id.'']);
        $usercredit = mysqli_real_escape_string($con,$usercredit);

        $userstatus = stripslashes($_REQUEST['userstatus'.$id.'']);
        $userstatus = mysqli_real_escape_string($con,$userstatus);


        $medquery = "UPDATE users SET username = '$usernam', email = '$usermail', phone= '$userphone', role = '$userrole', credit = '$usercredit', pending = '$userstatus' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully edited a User. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> User is not edited. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
              echo  mysqli_error($con);
        }
        
    }

    //User Delete
    
    if(isset($_POST["userdelete"])){
        
        $delid = $_POST["userdelete"];

        $userdelq = "DELETE FROM users WHERE id = $delid LIMIT 1";
        $userdelq = mysqli_query($con,$userdelq);

        if($userdelq){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted User. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> User is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    //add new User

    echo '<center>
    <div id="modaldemoadd" class="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Add New User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name"
                                    name="useraddname" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="useraddemail"
                                    placeholder="Email" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="useraddphone"
                                    placeholder="Phone No" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="useraddpass"
                                    placeholder="Password" required>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <select class="form-control" name="useraddrole">
                                    <option selected>Choose One</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Doctor">Doctor</option>
                                </select>
                            </div><!-- form-group -->

                            <div class="form-group">
                                <input type="text" class="form-control" name="useraddcredit"
                                    placeholder="Credit Amount" required>
                            </div><!-- form-group -->
                            <button name="addusernew" class="btn btn-az-primary pd-x-20">Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</center>';

//User add to database

if(isset($_POST["addusernew"])){
    
    $adduname = stripslashes($_REQUEST['useraddname']);
    $adduname = mysqli_real_escape_string($con,$adduname);

    $adduemail = stripslashes($_REQUEST['useraddemail']);
    $adduemail = mysqli_real_escape_string($con,$adduemail);

    $adduphone = stripslashes($_REQUEST['useraddphone']);
    $adduphone = mysqli_real_escape_string($con,$adduphone);

    $addupass = stripslashes($_REQUEST['useraddpass']);
    $addupass = mysqli_real_escape_string($con,$addupass);

    $addurole = stripslashes($_REQUEST['useraddrole']);
    $addurole = mysqli_real_escape_string($con,$addurole);

    $adducredit = stripslashes($_REQUEST['useraddcredit']);
    $adducredit = mysqli_real_escape_string($con,$adducredit);

    $ferrefid = $_SESSION['name'];


    $adduserq = "INSERT into `users` (username, email, phone, password, role, credit, refferid)
            VALUES ('$adduname', '$adduemail', '$adduphone', '".md5($addupass)."', '$addurole', '$adducredit', '$ferrefid') LIMIT 1";
    $adduserr = mysqli_query($con,$adduserq);

    if($adduserr){
        echo '<div class="alert alert-success" role="alert">
                 <strong>Well done!</strong> You successfully added a User. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
           
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
                 <strong>Something Wrong!</strong> User is not added. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
    }
    
}
}


//pending users

function pendingusers($con){
    $query7 = "SELECT * FROM users WHERE pending <> 'Approved' ORDER BY id DESC";
    $result7 = mysqli_query($con,$query7);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result7)){
        
        $medid = $medrow["id"];

        echo '<tr> 
                  <td>'.$medid.'</td> 
                  <td>'.$medrow["username"].'</td> 
                  <td>'.$medrow["email"].'</td> 
                  <td>'.$medrow["phone"].'</td> 
                  <td>'.$medrow["role"].'</td> 
                  <td>'.$medrow["credit"].'</td>
                  <td>'.$medrow["pending"].'</td>
                  <td>'.$medrow["refferid"].'</td>
                    
                   <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemopuser'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-check-circle"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemoduser'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>
                      <center>
                      <div id="modaldemopuser'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Edit User Before Approve</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Name" name="pusername'.$medid.'" value="'.$medrow["username"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="puseremail'.$medid.'" placeholder="Email address" value="'.$medrow["email"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="puserphone'.$medid.'" placeholder="Phone" value="'.$medrow["phone"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <select class="form-control" name="puserrole'.$medid.'" id="sel111">';
                                    if($medrow["role"] == "Admin"){
                                        echo '<option value="Admin" selected>Admin</option>
                                        <option value="Doctor">Doctor</option>';
                                    }
                                    elseif($medrow["role"] == "Doctor"){
                                        echo '<option value="Admin">Admin</option>
                                        <option value="Doctor" selected>Doctor</option>';
                                    }
                                    else{
                                        echo '<option value="">Choose One</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Doctor">Doctor</option>';
                                    }
                                  echo  '</select>
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="pusercredit'.$medid.'" placeholder="Total Credit" value="'.$medrow["credit"].'">
                                  </div><!-- form-group -->
                              
                                  <button value="'.$medid.'" name="approveuser" class="btn btn-az-primary pd-x-20">Approve</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemoduser'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete User</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$medrow["username"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$medid.'" name="deluser" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>

               </tr>';
              
        $i++;
        
    }

    //approve User
    
    if(isset($_POST["approveuser"])){
        
        $id = $_POST["approveuser"];
        
        $medname = stripslashes($_REQUEST['pusername'.$id.'']);
        $medname = mysqli_real_escape_string($con,$medname);

        $medshort = stripslashes($_REQUEST['puseremail'.$id.'']);
        $medshort = mysqli_real_escape_string($con,$medshort);

        $medchap = stripslashes($_REQUEST['puserphone'.$id.'']);
        $medchap = mysqli_real_escape_string($con,$medchap);

        $medsubchap = stripslashes($_REQUEST['puserrole'.$id.'']);
        $medsubchap = mysqli_real_escape_string($con,$medsubchap);

        $medsource = stripslashes($_REQUEST['pusercredit'.$id.'']);
        $medsource = mysqli_real_escape_string($con,$medsource);


        $medquery = "UPDATE users SET username = '$medname', email = '$medshort', phone = '$medchap', role = '$medsubchap', credit = '$medsource', pending = '$medprov', pending = 'Approved' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> Medicine Approved. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> Medicine is not Approved. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    // Delete User
    
    if(isset($_POST["deluser"])){
        
        $delid = $_POST["deluser"];

        $meddelquery = "DELETE FROM users WHERE id = $delid LIMIT 1";
        $mddelresult = mysqli_query($con,$meddelquery);

        if($mddelresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted User. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> User is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

}


//Banned User Page
function bannedusers($con){
    $query7 = "SELECT * FROM users WHERE pending = 'Banned' ORDER BY id DESC";
    $result7 = mysqli_query($con,$query7);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result7)){
        
        $medid = $medrow["id"];

        echo '<tr> 
                  <td>'.$medid.'</td> 
                  <td>'.$medrow["username"].'</td> 
                  <td>'.$medrow["email"].'</td> 
                  <td>'.$medrow["phone"].'</td> 
                  <td>'.$medrow["role"].'</td> 
                  <td>'.$medrow["credit"].'</td>
                  <td>'.$medrow["pending"].'</td>
                  <td>'.$medrow["refferid"].'</td>
                    
                   <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemobuser'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-check-circle"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemodbuser'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>
                      <center>
                      <div id="modaldemobuser'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Edit User Before Unbanned</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Name" name="pusername'.$medid.'" value="'.$medrow["username"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="puseremail'.$medid.'" placeholder="Email address" value="'.$medrow["email"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="puserphone'.$medid.'" placeholder="Phone" value="'.$medrow["phone"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <select class="form-control" name="puserrole'.$medid.'" id="sel111">';
                                    if($medrow["role"] == "Admin"){
                                        echo '<option value="Admin" selected>Admin</option>
                                        <option value="Doctor">Doctor</option>';
                                    }
                                    elseif($medrow["role"] == "Doctor"){
                                        echo '<option value="Admin">Admin</option>
                                        <option value="Doctor" selected>Doctor</option>';
                                    }
                                    else{
                                        echo '<option value="">Choose One</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Doctor">Doctor</option>';
                                    }
                                  echo  '</select>
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="pusercredit'.$medid.'" placeholder="Total Credit" value="'.$medrow["credit"].'">
                                  </div><!-- form-group -->
                              
                                  <button value="'.$medid.'" name="approveuser" class="btn btn-az-primary pd-x-20">Unbanned</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemodbuser'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete User</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$medrow["username"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$medid.'" name="deluser" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>

               </tr>';
              
        $i++;
        
    }

    //approve User
    
    if(isset($_POST["approveuser"])){
        
        $id = $_POST["approveuser"];
        
        $medname = stripslashes($_REQUEST['pusername'.$id.'']);
        $medname = mysqli_real_escape_string($con,$medname);

        $medshort = stripslashes($_REQUEST['puseremail'.$id.'']);
        $medshort = mysqli_real_escape_string($con,$medshort);

        $medchap = stripslashes($_REQUEST['puserphone'.$id.'']);
        $medchap = mysqli_real_escape_string($con,$medchap);

        $medsubchap = stripslashes($_REQUEST['puserrole'.$id.'']);
        $medsubchap = mysqli_real_escape_string($con,$medsubchap);

        $medsource = stripslashes($_REQUEST['pusercredit'.$id.'']);
        $medsource = mysqli_real_escape_string($con,$medsource);


        $medquery = "UPDATE users SET username = '$medname', email = '$medshort', phone = '$medchap', role = '$medsubchap', credit = '$medsource', pending = '$medprov', pending = 'Pending' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> Medicine Approved. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> Medicine is not Approved. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    // Delete User
    
    if(isset($_POST["deluser"])){
        
        $delid = $_POST["deluser"];

        $meddelquery = "DELETE FROM users WHERE id = $delid LIMIT 1";
        $mddelresult = mysqli_query($con,$meddelquery);

        if($mddelresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted User. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> User is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

}



// all symptoms functionalities

//showing all symptoms to table
function showsymptoms($con,$role){
    $query6 = "SELECT * FROM symptoms WHERE pending <> 'Pending' ORDER BY id DESC";
    $result6 = mysqli_query($con,$query6);
    $i = 1;
    while($medrow = mysqli_fetch_assoc($result6)){
        
        $medid = $medrow["id"];

        echo '<tr> 
                  <td>'.$medid.'</td> 
                  <td>'.$medrow["name"].'</td> 
                  <td>'.$medrow["chapter"].'</td> 
                  <td>'.$medrow["shortform"].'</td> 
                  <td>'.$medrow["relatedmedicine"].'</td>
                  <td>'.$medrow["addedby"].'</td>
                  
                  <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemoview'.$i.'"><button class="btn btn-indigo btn-icon"><i class="la la-eye"></i></button></a>
                          <center>
                      <div id="modaldemoview'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Details - '.$medrow["name"].'</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <div class="table-responsive">
                                <table class="table table-bordered mg-b-0">
                                <tbody>
                                    <tr>
                                    <th scope="row"><b>Name</b></th>
                                    <td>'.$medrow["name"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Chapter</b></th>
                                    <td>'.$medrow["chapter"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Sub Chapter</b></th>
                                    <td>'.$medrow["subchapter"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Short Form</b></th>
                                    <td>'.$medrow["shortform"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Related Medicines</b></th>
                                    <td>'.$medrow["relatedmedicine"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Status</b></th>
                                    <td>'.$medrow["pending"].'</td>
                                    </tr>
                                    <tr>
                                    <th scope="row"><b>Added by</b></th>
                                    <td>'.$medrow["addedby"].'</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div></br>
                            
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>';
                          if($role == "Admin"){
                          echo '<a href="" data-toggle="modal" data-target="#modaldemoedit'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemodel'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>

                      

                      <center>
                      <div id="modaldemoedit'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Edit Symptom</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="d-flex flex-column wd-md-400 pd-30 pd-sm-40 bg-gray-200">
                              <form method="post" action="">
                                  <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Name" name="medname'.$medid.'" value="'.$medrow["name"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medshort'.$medid.'" placeholder="Chapter" value="'.$medrow["chapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medchap'.$medid.'" placeholder="Sub Chapter" value="'.$medrow["subchapter"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsubchap'.$medid.'" placeholder="Short Form" value="'.$medrow["shortform"].'">
                                  </div><!-- form-group -->
  
                                  <div class="form-group">
                                  <input type="text" class="form-control" name="medsource'.$medid.'" placeholder="Related Medicine" value="'.$medrow["relatedmedicine"].'">
                                  </div><!-- form-group -->

                                  <div class="form-group">
                                  <select class="form-control" name="status'.$medid.'" id="sel11">';
                                    if($medrow["pending"] == "Approved"){
                                        echo '<option value="Approved" selected>Approved</option>
                                        <option value="Pending">Pending</option>';
                                    }
                                    elseif($medrow["pending"] == "Pending"){
                                        echo '<option value="Approved">Approved</option>
                                        <option value="Pending" selected>Pending</option>';
                                    }
                                    else{
                                        echo '<option value="">Choose Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>';
                                    }
                                  echo  '</select>
                                  </div><!-- form-group -->
                              
                                  <button value="'.$medid.'" name="subupdate" class="btn btn-az-primary pd-x-20">Update</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemodel'.$i.'" class="modal">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content modal-content-demo">
                              <div class="modal-header">
                                  <h6 class="modal-title">Delete Symptom</h6>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                              <div class="alert alert-danger mg-b-0" role="alert">
                                  Are you sure want to delete '.$medrow["name"].'?
                              </div>
                              <div class="mg-lg-b-30"></div>
                              <form method="post" action="">
                                  
                                  <button value="'.$medid.'" name="subdelete" class="btn btn-az-primary pd-x-20">Delete</button>
                              </form>
                              
                                
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
  
  
                  </td>';
                  }
                  
                  
              echo '</tr>';
              
        $i++;
        
    }

    //symptoms edit
    
    if(isset($_POST["subupdate"])){
        
        $id = $_POST["subupdate"];
        
        $medname = stripslashes($_REQUEST['medname'.$id.'']);
        $medname = mysqli_real_escape_string($con,$medname);

        $medshort = stripslashes($_REQUEST['medshort'.$id.'']);
        $medshort = mysqli_real_escape_string($con,$medshort);

        $medchap = stripslashes($_REQUEST['medchap'.$id.'']);
        $medchap = mysqli_real_escape_string($con,$medchap);

        $medsubchap = stripslashes($_REQUEST['medsubchap'.$id.'']);
        $medsubchap = mysqli_real_escape_string($con,$medsubchap);

        $medsource = stripslashes($_REQUEST['medsource'.$id.'']);
        $medsource = mysqli_real_escape_string($con,$medsource);

        $medstatus = stripslashes($_REQUEST['status'.$id.'']);
        $medstatus = mysqli_real_escape_string($con,$medstatus);


        $medquery = "UPDATE symptoms SET name = '$medname', chapter = '$medshort', subchapter = '$medchap', shortform = '$medsubchap', relatedmedicine = '$medsource', pending='$medstatus' WHERE id = $id LIMIT 1";
        $mdresult = mysqli_query($con,$medquery);

        if($mdresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully edited Symptom. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
               
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                     <strong>Something Wrong!</strong> Symptom is not edited. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

    //symtoms Delete
    
    if(isset($_POST["subdelete"])){
        
        $delid = $_POST["subdelete"];

        $meddelquery = "DELETE FROM symptoms WHERE id = $delid LIMIT 1";
        $mddelresult = mysqli_query($con,$meddelquery);

        if($mddelresult){
            echo '<div class="alert alert-success" role="alert">
                     <strong>Well done!</strong> You successfully Deleted Symptom. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
                
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Something Wrong!</strong> Symptom is not Deleted. <a href="" onClick="window.location.reload();">Refresh the page</a>
                </div>';
        }
        
    }

  

    //add new symtoms


//symptom add to database

if(isset($_POST["addmed"])){
    
    $medname = stripslashes($_REQUEST['medname']);
    $medname = mysqli_real_escape_string($con,$medname);

    $medchap = stripslashes($_REQUEST['medchap']);
    $medchap = mysqli_real_escape_string($con,$medchap);

    $medsubchap = stripslashes($_REQUEST['medsubchap']);
    $medsubchap = mysqli_real_escape_string($con,$medsubchap);

    $medsource = stripslashes($_REQUEST['medsource']);
    $medsource = mysqli_real_escape_string($con,$medsource);

    $medprov = stripslashes($_REQUEST['medprov']);
    $medprov = mysqli_real_escape_string($con,$medprov);

    $addedby = $_SESSION['name'];


    $medaddquery = "INSERT into `symptoms` (name, chapter, subchapter, shortform, relatedmedicine, addedby)
            VALUES ('$medname', '$medchap', '$medsubchap', '$medsource', '$medprov','$addedby')";
    $mdaddresult = mysqli_query($con,$medaddquery);

    if($mdaddresult){
        echo '<div class="alert alert-success" role="alert">
                 <strong>Well done!</strong> You successfully added a Symptoms. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
           
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
                 <strong>Something Wrong!</strong> Symptom is not added. <a href="" onClick="window.location.reload();">Refresh the page</a>
            </div>';
    }
    
}
}

  //selectbox value getting for database

    
  function getrelated($con){
        
    echo '<option value="">Select one</option>';
    $related_query = "SELECT * FROM medicines WHERE pending = 'Approved' ORDER BY id DESC";
    $related_execute = mysqli_query($con,$related_query);
    while ($row = mysqli_fetch_assoc($related_execute)){
        
            
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        
    }
}