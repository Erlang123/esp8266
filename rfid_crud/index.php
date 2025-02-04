<?php
// include('includes/header.php');
include('db_connect.php');
include('UIDContainer.php'); // Including UIDContainer.php to retrieve $UIDresult

// Retrieve UID from POST request or fallback to UIDContainer
// $UIDresult = $_POST['UID'] ?? $UIDresult ?? '';
?>

<!DOCTYPE html>
<html lang="en">


    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
    
            body {
                background-color: lavenderblush;
            }
    
            .main-custom-1 {
                background-color: white;
                border-color: gray;
                border-style: solid;
                border-width: 1px;
                box-shadow: 0 0 24px 0px gray;
                padding: 2rem;
            }
    
            html {
                font-family: Arial, sans-serif;
                text-align: center;
            }
            td.lf {
                padding: 12px 15px;
            }
            
        </style>
    </head>


    <body>
        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-12 main-custom-1">
    
                    <h1 class="text-center">RFID CRUD Management</h1>
            
                    <p class="text-center">
                        UID: <span class="updateable_uid"></span>
                    </p>
    
                    <div class="d-flex justify-content-center mb-3">
                        <a href="index.php" class="btn btn-primary me-2">Home</a>
                        <a href="create.php" class="btn btn-primary me-2">Add New Entry</a>
                        <a href="view_all.php" class="btn btn-primary me-2">All User Data</a>
                    </div>
    
                    <div id="show_user_data">
                        <table width="652" border="1" bordercolor="#10a0c5" align="center" cellpadding="0" cellspacing="1" bgcolor="#000" style="padding: 2px">
                            <tr>
                                <td height="40" align="center" bgcolor="#10a0c5">
                                    <font color="#FFFFFF"><b>Scanned RFID Data</b></font>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f9f9f9">
                                    <table width="652" border="0" align="center" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td class="lf">Card UID</td>
                                            <td><b>:</b></td>
                                            <td class="updateable_uid"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
    
                </div>            
            </div>
        </div>
    </body>



    <script type="text/javascript">
        let url = 'UIDContainer.php?req_code=0';
        setInterval(updateDD, 1000);
        async function updateDD(){
            let http_req = await fetch(url);
            let req_res = await http_req.text();
            
            // console.log(req_res);
            const element = document.getElementsByClassName('updateable_uid');
            element[0].innerHTML = req_res;
            element[1].innerHTML = req_res;
        }
    </script>



</html>
