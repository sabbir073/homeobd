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
$query5 = "SELECT * FROM medicines";
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
                  <td>'.$medrow["subchapter"].'</td> 
                  <td>'.$medrow["source"].'</td>
                  <td>'.$medrow["prover"].'</td>
                  <td>'.$medrow["type"].'</td>
                  <td>'.$medrow["addedby"].'</td>';
                    
                  if($role == "Admin"){
                      echo '<td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemo1'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemo2'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
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
                              
                                  <button value="'.$medid.'" name="subupdate" class="btn btn-az-primary pd-x-20">Update</button>
                              </form>
                              
                                  </div>
                              </div>
                              </div>
                          </div><!-- modal-dialog -->
                          </div><!-- modal -->
                      </center>
  
                      <center>
                      <div id="modaldemo2'.$i.'" class="modal">
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


        $medquery = "UPDATE medicines SET name = '$medname', shortform = '$medshort', chapter = '$medchap', subchapter = '$medsubchap', source = '$medsource', prover = '$medprov', type = '$medtype' WHERE id = $id LIMIT 1";
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
                  <td>'.$medrow["prover"].'</td>
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
                    <a href="all-users.html" class="nav-sub-link">All Users</a>
                    <a href="pending-users.html" class="nav-sub-link">Pending Users</a>
                </nav>
            </li><!-- nav-item -->

            <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="fa fa-stethoscope" aria-hidden="true"></i>Symptoms</a>
                <nav class="nav-sub">
                    <a href="all-symptoms.html" class="nav-sub-link">All Symtoms</a>
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
                    <a href="all-symptoms.html" class="nav-sub-link">All Symtoms</a>
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
                  <td>'.$medrow["subchapter"].'</td> 
                  <td>'.$medrow["source"].'</td>
                  <td>'.$medrow["prover"].'</td>
                  <td>'.$medrow["type"].'</td>
                  <td>'.$medrow["addedby"].'</td>
                  <td>'.$medrow["pending"].'</td>
                    
                  <td>
                      <center>
                          <div class="btn-icon-list">
                          <a href="" data-toggle="modal" data-target="#modaldemo7'.$i.'"><button class="btn btn-info btn-icon"><i class="la la-edit"></i></button></a>
                          <a href="" data-toggle="modal" data-target="#modaldemo8'.$i.'"><button class="btn btn-danger btn-icon"><i class="la la-times-circle"></i></button></a>
                              
                          </div>
  
                      </center>
                      <center>
                      <div id="modaldemo7'.$i.'" class="modal">
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
                      <div id="modaldemo8'.$i.'" class="modal">
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


        $medquery = "UPDATE medicines SET name = '$medname', shortform = '$medshort', chapter = '$medchap', subchapter = '$medsubchap', source = '$medsource', prover = '$medprov', type = '$medtype' WHERE id = $id LIMIT 1";
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

