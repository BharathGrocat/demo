<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:../logout');
} else {

    $userid = $_SESSION['id'];
    $query = mysqli_query($con, "select * from users where emp_id='$userid'");
    $result = mysqli_fetch_array($query);
    $allowedUsers = ['9481', '4092 ']; 

    if (!$result['adm']) {
        header('location:../home');
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Panel | JAL Safety</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../login.css" rel="stylesheet" />
    <link href="../css/floatingW.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="../includes/html2pdf.bundle.min.js"></script>

    <script src="https://unpkg.com/image-compressor.js@1.1.2"></script>
    <script type="text/javascript" src="upload.js"></script>
    <script type="text/javascript" src="Form.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

    <body class="sb-nav-fixed">


        <?php include_once('../includes/navbar.php'); ?>
        <div id="layoutSidenav">
            <?php include_once('../includes/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <!-- Main Content Section: Buttons /////////////////////////////////////////////////////////////////////////////////////////////-->
                <main>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <div class="container-fluid px-4">

                        <h1 class="mt-4"><i class="fas fa-user-shield"></i> Admin Panel <?php if(in_array($userid, $allowedUsers)) { ?>
                        <a href="DB" class="btn btn-warning">Edit User DB</a>
                    <?php } ?></h1>

                        <div class="accordion" id="AdminPanel">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa-solid fa-table"></i> &nbsp;&nbsp;Main Tables
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#AdminPanel">
                                    <div class="accordion-body">

                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" onclick="toggleDiv('collapsePTable', 'collapseCTable')" checked>
                                            <label class="btn btn-outline-primary" for="btnradio1"><i class="fas fa-users"></i> Suraksha Samvaad</label>

                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" onclick="toggleDiv('collapseCTable' , 'collapsePTable')">
                                            <label class="btn btn-outline-success" for="btnradio2"><i class="fas fa-binoculars"></i> Leaders Safety Observation</label>

                                            <!--<input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio3">Empty</label> -->
                                        </div>

                                        <div class="btn-group" id="ExcelSSBtn">
                                            <button class="btn btn-outline-primary" onclick="downloadExcel('sam', <?php echo $userid; ?>)">
                                                <i class="fas fa-file-excel"></i> Excel <i class="fas fa-download"></i>
                                            </button>
                                        </div>

                                        <div class="btn-group" id="ExcelLO" style="display: none;">
                                            <button class="btn btn-outline-success" onclick="downloadExcel('LO', <?php echo $userid; ?>)">
                                                <i class="fas fa-file-excel"></i> Excel <i class="fas fa-download"></i>
                                            </button>
                                        </div>

                                        <div class="btn-group" id="SearchToggleBtn">
                                            <button class="btn btn-outline-info m-1" value="0" onclick="hideSrRow(this)">
                                                <i class="fa-solid fa-magnifying-glass"></i>▴
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <h5 style="color:red">This is a last month data</h5>
                                        </div>
                                        <!--
                                <div class="collapse" id="SearchBar">

                                    <input class='form m-1' type="text" name="SrTL" id="SrTL" placeholder='Enter TL Name' onkeyup="filterColumn()" >
                                    <input class='form m-1' type="text" name="SrTL" id="SrDep" placeholder='Enter Department' onkeyup="filterColumn()" >
                                </div>-->

                                        <!--<div class="row">
                                        <div class="col-md-2 p-1">
                                            <button class="btn btn-primary" style="width: 100%;" name="Pending" onclick="toggleDiv('collapsePTable', 'collapseCTable')"><i class="fas fa-users"></i> Suraksha Samvaad</button>
                                        </div>
                                        <div class="col-md-2 p-1">
                                            <button class="btn btn-success" style="width: 100%;" name="Completed" onclick="toggleDiv('collapseCTable' , 'collapsePTable')"><i class="fas fa-binoculars"></i> Leaders Safety Observation</button>
                                        </div>
                                    </div>-->
                                        <!--   SS Table ----------------------------------------------------------------------------------------->

                                        <!-- Your HTML code -->
                                        <div class="row collapse show" id="collapsePTable">
                                            <div class="col-md" id="FormStat" style="display: none;">
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    <svg class="bi flex-shrink-0 me-1" width="24" height="24" role="img" aria-label="Info:">
                                                        <use xlink:href="#info-fill" />
                                                    </svg>
                                                    <div>
                                                        Form Submit Successfull.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-responsive-sticky-Cus" id='PTableCont'>
                                                <table id="dataTable" class="table table-striped table-bordered rounded-2">
                                                    <thead class="text-white ">
                                                        <!-- Table headers will be dynamically added here -->
                                                    </thead>
                                                    <tbody>
                                                        <!-- Table rows will be dynamically added here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- JavaScript code -->
                                        <script>
    var currentDataHash = "";
    var fstTime = false;

    function updateTable(sort = '') {
        $.ajax({
            url: 'Tdb.php?uid=<?php echo $userid; ?>&sort=' + encodeURIComponent(sort),
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var newDataHash = generateHash(data);

                if (newDataHash !== currentDataHash) {
                    currentDataHash = newDataHash;

                    $('#dataTable thead').empty();
                    $('#dataTable tbody').empty();

                    if (data && Object.keys(data).length > 0) {
                        var headers = '<tr>';
                        var arrow, sortTy, thColor;

                        for (var key in data[0]) {
                            arrow = (key !== sort) ? '&dtrif;' : '&utrif;';
                            sortTy = (key === sort) ? ' DESC' : '';
                            thColor = sort.includes(key) ? 'class="text-warning"' : '';
                            headers += '<th ' + thColor + ' onclick="updateTable(\'' + key + sortTy + '\')">' + key + arrow + '</th>';
                        }

                        headers += '<th>Edit</th>';
                        headers += '</tr><tr id="SrRow">';

                        var ColInd = 0;
                        for (var key in data[0]) {
                            headers += '<th class="bg-light"><input id="Sr' + ColInd + '" class="SrIns" style="width: 100%;" type="text" placeholder="' + key + '" onkeyup="filterColumn()"></th>';
                            ColInd++;
                        }

                        headers += '<th class="bg-light"></th>';
                        headers += '</tr>';

                        $('#dataTable thead').append(headers);

                        $.each(data, function (index, row) {
                            var rowHtml = '<tr class="SrTr">';
                            var SSID1 = 0;

                            $.each(row, function (key, value) {
                                if (key === 'Before_Photos') {
                                    var photoCountBefore = (value !== null && value !== '') ? value.split(',').length : 0;
                                    rowHtml += '<td>' + (photoCountBefore ? '<a href="#" onclick="viewPhotos(\'' + value + '\', \'Before\'); return false;">View ' + photoCountBefore + ' Photos</a>' : 'No Photos') + '</td>';
                                } else if (key === 'After_Photos') {
                                    var photoCountAfter = (value !== null && value !== '') ? value.split(',').length : 0;
                                    rowHtml += '<td>' + (photoCountAfter ? '<a href="#" onclick="viewPhotos(\'' + value + '\', \'After\'); return false;">View ' + photoCountAfter + ' Photos</a>' : 'No Photos') + '</td>';
                                } else if (key === 'SSID') {
                                    SSID1 = value;
                                    rowHtml += '<td><a href="#" onclick="subtable(\'' + SSID1 + '\'); return false;">' + value + '</a></td>';
                                } else {
                                    rowHtml += '<td>' + (value !== null ? value : '') + '</td>';
                                }
                            });

                            var pencilSVG = '<svg class="svg-inline--fa fa-pencil" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path></svg>';
                            var deleteSVG = '<svg class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path></svg>';

                            rowHtml += '<td><div class="btn-group">';
                            rowHtml += '<button class="btn btn-primary btn-sm m-1" style="width: 100%;" onclick="EditSS(' + SSID1 + ')">' + pencilSVG + '</button>';
                            rowHtml += '<button class="btn btn-danger btn-sm m-1" style="width: 100%;" onclick="DelSS(' + SSID1 + ', this)">' + deleteSVG + '</button>';
                            rowHtml += '</div></td>';
                            rowHtml += '</tr>';

                            rowHtml += '<tr class="SrTr">';
                            rowHtml += '<td class="text-center align-middle" colspan="16">';
                            rowHtml += '<div id="subtable_' + SSID1 + '" class="d-flex align-items-center justify-content-center"></div>';
                            rowHtml += '</td>';
                            rowHtml += '</tr>';

                            $('#dataTable tbody').append(rowHtml);
                        });
                    } else {
                        $('#PTableCont').html('<div class="alert alert-warning" role="alert">No data found.</div>');
                    }

                    if (fstTime) {
                        showToast('<i class="fas fa-check fa-bounce"></i> Suraksha Samvaad table updated', 'primary');
                    }
                    fstTime = true;
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
                showToast('<i class="fas fa-exclamation-circle fa-bounce"></i> Error Loading : Suraksha Samvaad table', 'danger');
            }
        });
    }

    function generateHash(data) {
        return JSON.stringify(data);
    }

    updateTable('');
    setInterval(function () {
        updateTable('');
    }, 5000);
</script>

                                        <!-- Modal to display photos -->
                                        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                <!-- Add the 'modal-lg' class to increase the width -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="photoModalLabel">View Photos</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="photoModalBody">
                                                        <!-- Photos will be displayed here -->
                                                        <!-- Sample long content to test scrolling -->
                                                        <div class="sample-long-content">
                                                            <!-- Add your long content here -->
                                                            <!-- This content will scroll, and the header and footer will remain fixed -->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--   LO Table ----------------------------------------------------------------------------------------->

                                        <!-- Your HTML code -->
                                        <div class="row collapse" id="collapseCTable">

                                            <div class="col-md" id="FormStatC" style="display: none;">
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    <svg class="bi flex-shrink-0 me-1" width="24" height="24" role="img" aria-label="Info:">
                                                        <use xlink:href="#info-fill" />
                                                    </svg>
                                                    <div>
                                                        Form Submit Successfull.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-responsive-sticky-Cus" id='CTableCont'>
                                                <table id="dataTableC" class="table table-striped table-bordered rounded-2">
                                                    <thead class="text-white ">
                                                        <!-- Table headers will be dynamically added here -->
                                                    </thead>
                                                    <tbody>
                                                        <!-- Table rows will be dynamically added here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- JavaScript code -->
                                        <script>
    var currentDataHashC = "";
    var fstTimeC = false;

    function updateTableC(sort = '') {
        $.ajax({
            url: 'Tdb.php?Cuid=<?php echo $userid; ?>&sort=' + encodeURIComponent(sort),
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (Array.isArray(data)) {
                    data.sort(function (a, b) {
                        return new Date(b.Reported_on) - new Date(a.Reported_on);
                    });
                }

                var newDataHashC = generateHash(data);

                if (newDataHashC !== currentDataHashC) {
                    currentDataHashC = newDataHashC;

                    $('#dataTableC thead').empty();
                    $('#dataTableC tbody').empty();

                    if (data && Object.keys(data).length > 0) {
                        var headers = '<tr>';
                        var arrow, sortTy, thColor;

                        for (var key in data[0]) {
                            arrow = (key !== sort) ? '&dtrif;' : '&utrif;';
                            sortTy = (key === sort) ? ' DESC' : '';
                            thColor = sort.includes(key) ? 'class="text-warning"' : '';
                            headers += '<th ' + thColor + ' onclick="updateTableC(\'' + key + sortTy + '\')">' + key + arrow + '</th>';
                        }

                        headers += '</tr><tr id="SrRow">';

                        var ColInd = 0;
                        for (var key in data[0]) {
                            headers += '<th class="bg-light"><input id="SrLSO' + ColInd + '" class="SrInsLSO" style="width: 100%;" type="text" placeholder="' + key + '" onkeyup="filterColumnForLSO()"></th>';
                            ColInd++;
                        }

                        headers += '</tr>';
                        $('#dataTableC thead').append(headers);

                        $.each(data, function (index, row) {
                            var rowHtml = '<tr class="SrTrLSO">';
                            var SSID2 = 0;

                            $.each(row, function (key, value) {
                                if (key === 'Before_Photos') {
                                    var photoCountBefore = (value !== null && value !== '') ? value.split(',').length : 0;
                                    rowHtml += '<td>' + (photoCountBefore ? '<a href="#" onclick="viewPhotos(\'' + value + '\', \'Before\'); return false;">View ' + photoCountBefore + ' Photos</a>' : 'No Photos') + '</td>';
                                } else if (key === 'Group_Photos') {
                                    var photoCountGroup = (value !== null && value !== '') ? value.split(',').length : 0;
                                    rowHtml += '<td>' + (photoCountGroup ? '<a href="#" onclick="viewPhotos(\'' + value + '\', \'Group\'); return false;">View ' + photoCountGroup + ' Photos</a>' : 'No Photos') + '</td>';
                                } else if (key === 'LSOID') {
                                    SSID2 = value;
                                    rowHtml += '<td><a href="#" onclick="subtable2(\'' + SSID2 + '\'); return false;">' + value + '</a></td>';
                                } else {
                                    rowHtml += '<td>' + (value !== null ? value : '') + '</td>';
                                }
                            });

                            rowHtml += '</tr>';
                            rowHtml += '<tr class="SrTrLSO">';
                            rowHtml += '<td class="text-center align-middle" colspan="16">';
                            rowHtml += '<div id="subtable2_' + SSID2 + '" class="d-flex align-items-center justify-content-center"></div>';
                            rowHtml += '</td>';
                            rowHtml += '</tr>';

                            $('#dataTableC tbody').append(rowHtml);
                        });
                    } else {
                        $('#CTableCont').html('<div class="alert alert-warning" role="alert">No data found.</div>');
                    }

                    if (fstTimeC) {
                        showToast('<i class="fas fa-check fa-bounce"></i> Leaders Safety Observation table Updated', 'success');
                    }
                    fstTimeC = true;
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
                showToast('<i class="fas fa-exclamation-circle fa-bounce"></i> Error Loading : Leaders Safety Observation table', 'danger');
            }
        });
    }

    updateTableC('');
    setInterval(function () {
        updateTableC('');
    }, 5000);
</script>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // Fetch department options from the 'dept' table
                            $query = mysqli_query($con, "SELECT * FROM users Where Name = '" . $result['Name'] . "'");
                            $qDept = mysqli_query($con, "SELECT Department FROM users group by Department Order by Department ASC");
                            $qPlant = mysqli_query($con, "SELECT Plant FROM users group by Plant");
                            $qName = mysqli_query($con, "SELECT Name, Department, Emp_ID, Plant FROM users group by Name");

                            // Check if the query was successful
                            if ($query) {
                                // Fetch all rows as an associative array
                                $result2 = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                $rDept =  mysqli_fetch_all($qDept, MYSQLI_ASSOC);
                                $rPlant =  mysqli_fetch_all($qPlant, MYSQLI_ASSOC);
                                $rName =  mysqli_fetch_all($qName, MYSQLI_ASSOC);
                            }
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="ScheduleC">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseScheduleC" aria-expanded="false" aria-controls="collapseScheduleC">
                                        <i class="fa-solid fa-file-invoice"></i> &ensp; Reports
                                    </button>
                                </h2>
                                <div id="collapseScheduleC" class="accordion-collapse collapse <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo 'show'; ?>" aria-labelledby="ScheduleC" data-bs-parent="#AdminPanel">
                                    <div class="accordion-body table-Freeze_header">
                                        <form method="post" action="">
                                            <label for="from_month">From Month:</label>
                                            <input type="month" id="from_month" name="from_month" value="<?php if (isset($_POST["from_month"])) echo $_POST["from_month"]; ?>" max="<?= date('Y-m'); ?>" min="2023-01" required>
                                            &emsp;
                                            <label for="to_month"> To Month:</label>
                                            <input type="month" id="to_month" name="to_month" value="<?php if (isset($_POST["to_month"])) echo $_POST["to_month"];
                                                                                                        else echo date('Y-m'); ?>" max="<?= date('Y-m'); ?>" min="2023-01">
                                            &emsp;
                                            <label for="Rtype"> Report Type</label>
                                            <select name="Rtype" id="Rtype">
                                                <option value="F" <?php if (isset($_POST["Rtype"])) {
                                                                        if ($_POST["Rtype"] == 'F') echo 'Selected';
                                                                    } else echo 'Selected' ?>>All Names</option>
                                                <option value="C" <?php if (isset($_POST["Rtype"]) && $_POST["Rtype"] == 'C') echo 'selected'; ?>>Only Completed</option>
                                                <option value="P" <?php if (isset($_POST["Rtype"]) && $_POST["Rtype"] == 'P') echo 'selected'; ?>>Only Pending</option>
                                            </select>

                                            <button type="submit" class='btn btn-primary m-1' name="submit">Fetch Data</button>
                                            <button type='button' class="btn btn-outline-primary" onclick="downloadExcel2('sam', this)"> <i class="fas fa-file-excel"></i> Excel <i class="fas fa-download"></i></button>
                                        </form>
                                        <b style="color: red;">*Note:</b> [ <b style="color: green;">'✓'</b>: Samvaad done | <b style="color: red;">'✗'</b> : Samvaad not done | <b style="color: blue;">'⊘'</b> : Samvaad Not Scheduled ]
                                        <table class="table table-striped table-bordered">
                                            <?php
                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                $from_m = $_POST["from_month"];
                                                $to_m = $_POST["to_month"];

                                                $jType = ($_POST["Rtype"] == 'C') ? 'INNER' : 'Left';

                                                $nullRec = ($_POST["Rtype"] == 'P') ? "WHERE sam.Emp_id IS NULL" : "";

                                                $samCheckpoint = $nullRec == "" ? "WHERE users.Samw = 1" : "and users.Samw = 1";

                                                /*if( 0 && $_POST["Rtype"] == 'P'){
                                                    $sqlQuery = "SELECT 
                                                        users.Plant, 
                                                        Users.Department, 
                                                        users.Designation, 
                                                        users.Name, 
                                                        users.Emp_ID 
                                                    FROM 
                                                        users 
                                                    LEFT JOIN 
                                                        sam ON users.Emp_id = sam.Emp_id 
                                                            AND sam.Reported_on BETWEEN '$from_m-01 00:00:00' AND '$to_m-31 23:59:59'
                                                    WHERE 
                                                        sam.Emp_id IS NULL
                                                    GROUP BY 
                                                        users.name";
                                                }
                                                else*/ {
                                                    $sqlQuery = "
                                                    SET @sql = NULL;
                                                    SELECT GROUP_CONCAT(
                                                        DISTINCT
                                                        CONCAT(
                                                            'CASE WHEN users.SS_Group != ''EX'' THEN (case when COUNT(CASE WHEN DATE_FORMAT(sam.Reported_on, ''%b-%y'') = ''',DATE_FORMAT(sam.Reported_on, '%b-%y'),''' AND (sam.Status = ''OPEN'' OR sam.Status = ''CLOSED'') THEN 1 END) > 0 then ''C'' else ''P'' END) ELSE ''NA'' END AS `',DATE_FORMAT(sam.Reported_on, '%b-%y'),'`'
                                                            )
                                                            ORDER BY sam.Reported_on
                                                        )INTO @sql
                                                            FROM sam
                                                            WHERE sam.Reported_on BETWEEN '$from_m-01 00:00:00' AND '$to_m-30 23:59:59';
                                                                                                
                                                            SET @sql = CONCAT(
                                                                'SELECT 
                                                                users.Plant, Users.Department, users.Designation, users.Name, users.Emp_ID,
                                                            ', @sql, ',
                                                            COUNT(DATE_FORMAT(sam.Reported_on, ''%b-%y'')) AS `Total`
                                                        FROM users
                                                        $jType JOIN sam ON users.Emp_id = sam.Emp_id AND sam.Reported_on BETWEEN ''$from_m-01 00:00:00'' AND ''$to_m-31 23:59:59'' 
                                                        $nullRec 
                                                        $samCheckpoint
                                                        GROUP BY users.name
                                                        ORDER BY Total DESC'
                                                    );
                                            
                                                    PREPARE stmt FROM @sql;
                                                    EXECUTE stmt;
                                                    DEALLOCATE PREPARE stmt;";
                                                }
                                                //echo "<pre>$sqlQuery</pre>";

                                                // Execute the query
                                                if (!$con->multi_query($sqlQuery)) {
                                                    echo "Error executing query: " . $con->error;
                                                    $con->close();
                                                    exit;
                                                }

                                                // Fetch and display results
                                                do {
                                                    if ($result = $con->store_result()) {
                                                        // Outputting table headers
                                                        echo "<thead class='sticky-header bg-primary text-light text-center'>";
                                                        // Dynamically adding headers for months
                                                        while ($row = $result->fetch_assoc()) {
                                                            foreach ($row as $key => $value) {
                                                                echo "<th>" . $key . "</th>";
                                                            }
                                                            break; // Only need to loop through one row to get all column names
                                                        }
                                                        echo "</thead>";


                                                        $values = array_values($row);

                                                        // Access the 6th value (index 5)
                                                        $sixthValue = $values[5];
                                                        if ($sixthValue != "NA") {
                                                            echo "<tr>";
                                                            foreach ($row as $key => $value) {
                                                                // print_r($value);
                                                                if ($key != 'Name' && $key != 'Plant' && $key != 'Emp_ID' && $key != 'Department' && $key != 'Total' && $key != 'Designation') $value = ($value == "C") ? '✓' : (($value == "P") ? '✗' : '⊘');
                                                                echo "<td style='" . (($value == '✓') ? 'text-align: center;  color: green;' : (($value == '✗') ? 'text-align: center;  color: red;' : (($value == '⊘') ? 'text-align: center;  color: blue;' : ''))) . "'>" . $value . "</td>";
                                                            }
                                                            echo "</tr>";
                                                        }
                                                        // Outputting table data
                                                        while ($row = $result->fetch_assoc()) {
                                                            $checkValues = array_values($row);

                                                            // Access the 6th value (index 5)
                                                            $FifthValue = $checkValues[5];
                                                            if ($FifthValue != "NA") {
                                                                echo "<tr>";
                                                                foreach ($row as $key => $value) {
                                                                    if ($key != 'Name' && $key != 'Plant' && $key != 'Emp_ID' && $key != 'Department' && $key != 'Total' && $key != 'Designation') $value = ($value == "C") ? '✓' : (($value == "P") ? '✗' : '⊘');
                                                                    echo "<td style='" . (($value == '✓') ? 'text-align: center;  color: green;' : (($value == '✗') ? 'text-align: center;  color: red;' : (($value == '⊘') ? 'text-align: center;  color: blue; font-size: 20px' : ''))) . "'>" . $value . "</td>";
                                                                }
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        echo "";

                                                        $result->free();
                                                    }
                                                } while ($con->next_result());

                                                // Close connection
                                                $con->close();
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <form action="../WebSett" method="">
                                <button class="accordion-button collapsed border" type="submit"> <i class="fa-solid fa-screwdriver-wrench"></i> &nbsp;&nbsp;Website Settings</button>
                            </form>
                            <form action="../acc" method="">
                                <button class="accordion-button collapsed border" type="submit"> <i class="fa-solid fa-person-circle-plus"></i> &nbsp;&nbsp;Access Control</button>
                            </form>
                            <!--
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="WebsiteS">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa-solid fa-screwdriver-wrench"></i> &nbsp;&nbsp;Website Settings 
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="WebsiteS" data-bs-parent="#AdminPanel">
                                    <div class="accordion-body">
                                        Change Login page Background and change form options ect.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="AccessC">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccessC" aria-expanded="false" aria-controls="collapseAccessC">
                                        <i class="fa-solid fa-person-circle-plus"></i> &nbsp;&nbsp;Access Controll
                                    </button>
                                </h2>
                                <div id="collapseAccessC" class="accordion-collapse collapse" aria-labelledby="AccessC" data-bs-parent="#AdminPanel">
                                    <div class="accordion-body">
                                        Controll usert access.
                                    </div>
                                </div>
                            </div> -->

                        </div>

                    </div>
                </main>
                <!-- End of Main Content Section: Buttons ///////////////////////////////////////////////////////////////////////////////////////-->
                <?php include('../includes/footer.php'); ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>





        <!-- Pending table Edit Form Modal //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="UpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content" id="UploadModalPDF">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateModalLabel">Update Suraksha Samvaad &nbsp; </h5> &nbsp; <small class='text-dark' id='TLinfo'></small>
                        <!--&emsp;<a class="btn btn-danger me-3" id="PDFDownBtn" onclick="ssPdfRepo(1)">PDF</a> -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- The Form start -->
                        <form id="SamwEd" action="" method="get" enctype="multipart/form-data" onsubmit="Upload('<?php echo $result['Emp_ID']; ?>', this); return false;">
                            <input type="hidden" name="Team_Leader" value="<?php echo $result['Name']; ?>">
                            <input type="hidden" name="ED_SSID" id='Ed_SSID' value="">
                            <input type="hidden" name="Team_Leader_ID" value="<?php echo $result['Emp_ID']; ?>">
                            <!-- Topic -->
                            <div class="row">
                                <div class="col-md-8 m-1">
                                    <label for="topic" class="form-label">Topic</label>
                                    <input type="text" class="form-control" id="topicE" placeholder="Enter Suraksha Samvaad Topic" name="Topic" required>
                                </div>
                                <div class="col-md-3 border rounded m-1">
                                    <input type="radio" name="SSType" id="UA" value="UA" required>
                                    <label for="UA">
                                        <svg version="1.0" width="40pt" height="40pt" viewBox="0 0 220.000000 405.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
                                            <defs />
                                            <g transform="translate(0.000000,405.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                                <path d="M860 3839 l0 -141 -44 -50 c-85 -94 -109 -202 -78 -353 11 -55 26&#10;-133 32 -172 l12 -73 39 0 c37 0 39 -2 50 -42 13 -50 46 -118 57 -118 4 1 24&#10;16 46 34 38 33 38 33 22 64 -31 59 -27 62 88 62 62 0 107 -4 111 -10 11 -18&#10;-30 -84 -64 -105 -17 -11 -57 -39 -87 -62 l-56 -42 31 -15 c62 -32 159 -9 215&#10;50 31 34 66 103 75 148 5 24 13 32 36 36 29 5 29 6 54 140 15 77 25 174 26&#10;225 0 79 -3 97 -29 148 -15 32 -46 77 -67 99 l-39 41 0 139 0 138 -50 0 -50 0&#10;0 -114 0 -115 -32 10 c-18 5 -55 9 -83 9 -28 0 -65 -4 -83 -9 l-32 -10 0 115&#10;0 114 -50 0 -50 0 0 -141z" />
                                                <path d="M140 2340 l0 -109 98 -3 97 -3 3 -127 3 -128 -101 0 -100 0 0 -110 0&#10;-110 143 0 142 0 1 350 2 350 -144 0 -144 0 0 -110z" />
                                                <path d="M520 2100 l0 -350 549 0 549 0 33 31 c17 16 40 34 51 40 16 9 18 5&#10;18 -31 l0 -40 170 0 170 0 0 110 0 109 -97 3 -98 3 0 125 0 125 98 3 97 3 0&#10;109 0 110 -170 0 -170 0 0 -258 0 -259 -45 -32 -45 -32 0 290 0 291 -555 0&#10;-555 0 0 -350z m1163 -267 c-15 -13 -31 -23 -35 -23 -18 0 1 45 28 67 l29 23&#10;3 -22 c3 -15 -5 -30 -25 -45z" />
                                                <path d="M1045 1595 c-16 -9 -38 -24 -49 -33 -41 -37 -74 -152 -43 -152 7 0&#10;13 -14 14 -34 4 -80 63 -136 143 -136 80 0 139 56 143 136 1 20 7 34 15 34 18&#10;0 14 49 -7 96 -38 84 -144 128 -216 89z" />
                                                <path d="M1009 1185 c-60 -19 -111 -67 -152 -140 -26 -48 -44 -66 -87 -91&#10;-101 -58 -124 -100 -80 -144 29 -29 64 -25 134 14 66 37 102 67 127 106 16 24&#10;17 23 24 -60 6 -71 0 -139 -35 -405 -24 -176 -43 -333 -43 -349 -1 -50 56 -81&#10;103 -56 27 14 34 49 70 340 18 140 35 263 39 273 3 10 23 -115 44 -279 21&#10;-163 42 -305 48 -315 22 -41 101 -32 118 13 5 15 -6 128 -31 323 -33 250 -56&#10;525 -44 525 2 0 19 -33 39 -72 48 -98 113 -168 155 -168 33 0 72 38 72 71 0&#10;10 -18 39 -40 64 -48 55 -62 81 -96 177 -39 108 -57 132 -117 158 -66 29 -182&#10;36 -248 15z" />
                                            </g>
                                            <text x="108" y="84" font-size="40" text-anchor="middle" fill="white" font-family="Arial" font-weight="bold">UA</text>
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(153, 153, 153); stroke-linecap: round; stroke-width: 11px;" d="M 108.412 109.187 L 48.786 157.199" />
                                            <path style="fill: rgb(216, 216, 216); stroke-width: 10px; stroke: rgb(153, 153, 153); stroke-linecap: round;" d="M 48.011 158.973 L 47.237 230.216" />
                                            <path style="fill: rgb(216, 216, 216); stroke-width: 10px; stroke: rgb(153, 153, 153); stroke-linecap: round;" d="M 168.427 157.811 L 167.653 229.054" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(153, 153, 153); stroke-width: 10px;" d="M 168.815 157.199 L 122.352 120.029" />
                                            <path style="fill: rgb(216, 216, 216); stroke-width: 2px; stroke: rgb(0, 0, 0);" d="M 156.424 215.277 L 175.784 206.759" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(0, 0, 0); stroke-width: 2px;" d="M 158.748 220.698 L 178.881 212.18" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(0, 0, 0); stroke-width: 2px;" d="M 178.881 218.375 L 157.199 226.119" />
                                        </svg> Unsafe Act (UA)
                                    </label>
                                    <hr id="hrLine">
                                    <input type="radio" name="SSType" id="UC" value="UC" required>
                                    <label for="UC">
                                        <svg version="1.0" width="40pt" height="40pt" viewBox="0 0 279.000000 315.000000" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:bx="https://boxy-svg.com">
                                            <defs>
                                                <path id="path-0" d="M 62.639 261.998 C 120.53 286.629 167.423 299.34 207.792 299.34 C 207.792 293.916 210.201 289.815 210.201 285.488 C 218.468 261.89 220.531 244.668 208.394 226.463 C 198.136 210.775 188.091 208.788 174.063 204.78 C 149.105 202.542 128.036 204.178 107.811 204.178 C 87.932 204.178 72.614 203.282 59.025 200.564 C 40.273 200.564 40.076 235.544 45.172 245.736 C 55.733 256.297 64.224 268.064 73.48 278.862 C 88.347 289.228 100.502 296.931 113.834 296.931 L 114.436 296.931 L 114.436 296.329" style="fill: none;" />
                                            </defs>
                                            <g transform="translate(0.000000,315.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                                <path d="M1150 2904 l0 -137 -41 -44 c-22 -25 -53 -70 -67 -101 -23 -49 -27&#10;-70 -27 -147 0 -51 11 -150 25 -227 l24 -138 38 0 c22 0 40 -5 42 -12 14 -50&#10;40 -111 54 -128 l17 -21 39 34 40 33 -17 41 c-9 22 -13 43 -10 47 4 3 53 6&#10;110 6 111 0 117 -4 92 -53 -16 -31 -61 -77 -75 -77 -13 0 -114 -80 -114 -91 0&#10;-14 73 -31 114 -27 88 10 159 81 193 193 15 50 20 55 45 55 15 0 28 3 28 8 0&#10;15 31 200 45 270 26 126 -10 254 -96 338 l-39 38 0 138 0 138 -45 0 -44 0 -3&#10;-112 c-3 -107 -4 -113 -23 -108 -26 6 -153 6 -185 0 l-25 -5 -3 113 -3 112&#10;-44 0 -45 0 0 -136z" />
                                                <path d="M430 1400 l0 -110 95 0 95 0 0 -130 0 -130 -95 0 -95 0 0 -110 0&#10;-110 140 0 140 0 0 350 0 350 -140 0 -140 0 0 -110z" />
                                                <path d="M807 1503 c-4 -3 -7 -161 -7 -350 l0 -343 352 -2 353 -3 7 -55 c34&#10;-272 299 -453 563 -385 224 59 373 283 336 508 -22 133 -106 258 -216 323 -39&#10;23 -45 30 -45 60 l0 34 95 0 95 0 0 110 0 110 -165 0 -165 0 0 -125 0 -125&#10;-45 0 -44 0 -3 123 -3 122 -551 3 c-303 1 -554 -1 -557 -5z m1189 -323 c11 0&#10;14 -19 14 -89 l0 -89 -45 -36 -45 -37 0 125 c0 110 2 125 18 129 9 3 23 3 30&#10;1 8 -2 20 -4 28 -4z m227 -100 l52 -50 -62 0 -63 0 0 50 c0 29 5 50 11 50 6 0&#10;34 -22 62 -50z m-260 -189 l-28 -24 -3 23 c-3 16 5 30 25 46 l28 22 3 -21 c3&#10;-14 -6 -30 -25 -46z m47 -41 l0 -40 166 0 166 0 -4 -52 c-9 -112 -96 -239&#10;-200 -291 -215 -108 -469 -2 -540 225 -10 33 -18 73 -18 89 l0 29 170 0 c129&#10;0 170 3 170 13 1 12 67 66 83 67 4 0 7 -18 7 -40z" />
                                            </g>
                                            <text x="137" y="84" font-size="40" text-anchor="middle" fill="white" font-family="Arial" font-weight="bold">UC</text>
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(152, 152, 152); paint-order: fill; stroke-linecap: round; stroke-miterlimit: 30; stroke-width: 10px;" d="M 137.324 112.629 L 74.685 159.006" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(152, 152, 152); stroke-linecap: round; stroke-width: 10px;" d="M 74.889 159.608 L 74.889 234.895" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(152, 152, 152); stroke-linecap: round; stroke-width: 10px;" d="M 196.348 158.404 L 196.348 233.691" />
                                            <path style="fill: rgb(216, 216, 216); stroke-width: 10px; stroke: rgb(152, 152, 152);" d="M 149.971 122.265 L 195.746 158.403" />
                                            <path d="M 196.143 234.593 m -45.173 0 a 45.173 45.472 0 1 0 90.346 0 a 45.173 45.472 0 1 0 -90.346 0 Z M 196.143 234.593 m -37.944 0 a 37.944 38.198 0 0 1 75.888 0 a 37.944 38.198 0 0 1 -75.888 0 Z" style="stroke: rgb(0, 0, 0); fill-rule: nonzero; fill: rgb(242, 8, 8); stroke-linecap: round; paint-order: markers stroke; stroke-miterlimit: 1; stroke-dasharray: 1, 4; stroke-dashoffset: 50px; stroke-width: 0px; vector-effect: non-scaling-stroke;" bx:shape="ring 196.143 234.593 37.944 38.198 45.173 45.472 1@8f6da6aa" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(0, 0, 0); stroke-width: 2px;" d="M 203.576 215.621 L 187.916 223.451" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(0, 0, 0); stroke-width: 2px;" d="M 205.382 224.656 L 188.518 231.281" />
                                            <path style="fill: rgb(216, 216, 216); stroke: rgb(0, 0, 0); stroke-width: 2px;" d="M 208.996 219.235 L 185.507 228.27" />
                                        </svg> Unsafe Condition (UC)
                                    </label>

                                </div>
                            </div>
                            <div class="row">
                                <!-- Select Plant -->
                                <div class="col-md-2 mb-3">
                                    <label for="selectPlantE" class="form-label">Select Plant</label>
                                    <select class="form-select" id="selectPlantE" aria-label="Select Plant" name="Plant">
                                        <option disabled>Select Plant</option>
                                        <!-- Add plant options here -->
                                        <?php
                                        $UPlant = '';
                                        $UDept = '';
                                        foreach ($result2 as $row2) {
                                            $UPlant = $row2['Plant'];
                                            $UDept = $row2['Department'];
                                        }
                                        // Check if there are any departments
                                        if (!empty($rPlant)) {
                                            // Output the department options


                                            foreach ($rPlant as $row) {
                                                if ($row['Plant'] === $UPlant)
                                                    echo '<option selected value="' . $row['Plant'] . '">' . $row['Plant'] . '</option>';

                                                else
                                                    echo '<option value="' . $row['Plant'] . '">' . $row['Plant'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="" disabled>No Plant found</option>';
                                        }
                                        ?>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <!-- Select Department -->
                                <div class="col-md-5 mb-3">
                                    <label for="selectDepartment" class="form-label">Select Department</label>
                                    <select class="form-select" id="selectDepartmentE" aria-label="Select Department" name="Department">
                                        <option disabled>Select Department</option>
                                        <?php
                                        // Check if there are any departments
                                        if (!empty($rDept)) {
                                            // Output the department options
                                            foreach ($rDept as $row) {
                                                if ($row['Department'] === $UDept)
                                                    echo '<option selected value="' . $row['Department'] . '">' . $row['Department'] . '</option>';

                                                else
                                                    echo '<option  value="' . $row['Department'] . '">' . $row['Department'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="" disabled>No departments found</option>';
                                        }
                                        //} 
                                        ?>

                                    </select>
                                </div>

                                <!-- Area with suggestion -->
                                <div class="col-md-5 mb-3">
                                    <label for="area" class="form-label">Area</label>
                                    <input type="text" class="form-control" id="areaE" placeholder="Enter Area" name="Area" required>
                                </div>

                            </div>

                            <!-- Team Member -->
                            <div class="row">
                                <!-- Input and button wrapper -->
                                <div class="col-md-6" id="SelTMEd">
                                    Select Team Member
                                    <div class="input-group">
                                        <!-- Input element -->

                                        <input list="teamMembersE" class="form-control" id="teamMemberE" placeholder="Type to search">

                                        <!-- Add-on button -->
                                        <button type="button" class="btn btn-primary" onclick="addMember('E')"><i class="fas fa-plus-circle"></i> Add Member</button>
                                    </div>

                                    <!-- Datalist -->
                                    <datalist id="teamMembersE">
                                        <?php
                                        // Fetch team members from the 'Members' table
                                        if (!empty($rName)) {
                                            foreach ($rName as $row) {
                                                echo '<option value="' . $row['Name'] . ' [' . $row['Department'] . '] (' . $row['Emp_ID'] . ')"></option>' . "\n";
                                            }
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="col-md-6">
                                    <label for="categoryE" class="form-label">Category</label>
                                    <input list="categoryEs" class="form-control" id="categoryE" name="category" type="text" required placeholder="Type to search or enter" data-listener-added_61ff9f74="true">

                                    <!-- Datalist -->
                                    <datalist id="categoryEs">
                                        <option value="PPE">PPE</option>
                                        <option value="People Reaction">People Reaction</option>
                                        <option value="People Position">People Position</option>
                                        <option value="House Keeping">House Keeping</option>
                                        <option value="Equipment">Equipment</option>
                                        <option value="Procedure">Procedure</option>
                                        <option value=" ">Other</option>
                                    </datalist>
                                </div>

                            </div>
                            <div class="row border border-primary rounded rounded-3 p-3 m-1">
                                <!-- Team Member -->
                                <label for="selectedMembers" class="form-label text-primary">Team Members <i class="text-danger" style="font-size: 12px;">(Double tap on Team Member to add suggestion)</i></label>
                                <div class="container " id="selectedMembersE" data-bs-toggle="tooltip" title="Double tap on Team Member to add suggesions">
                                    <span class="button-like-text m-1 p-1" ondblclick="addToTable('<?php echo $result['Name'] . ' [' . $result['Department'] . '] (' . $result['Emp_ID'] . ')'; ?>', this)"><?php echo $result['Name']; ?>

                                        <!-- <div class="col-1 border m-1 border-primary selected-member" ondblclick="addToTable('<?php echo $result['Name']; ?>', this)"><?php echo $result['Name']; ?></div> -->

                                </div>



                                <!-- Hidden input field to store selected team members -->
                                <input type="hidden" id="teamMembersArrayE" name="TeamMembers">
                            </div>

                            <!--</div> -->
                            <div class="table-responsive table-responsive-sticky">
                                <table class="table table-striped table-bordered border-primary">
                                    <thead>
                                        <th scope="col" style="text-align: center;">#</th>
                                        <th scope="col">Suggestions</th>
                                        <th scope="col">Responsibility</th>
                                        <th scope="col">Employe ID</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Target Date</th>
                                        <th scope="col">Remove</th>
                                    </thead>
                                    <tbody id="suggestionsTableBodyE">

                                    </tbody>
                                </table>
                            </div>

                            <!-- Before Photo -->
                            <div class="row border border-danger rounded rounded-3 p-3 m-1">
                                <div class="col-md-3">
                                    <label for="photoInputE" class="form-label">Before Photos <i class="fas fa-cloud-upload-alt"></i></label>
                                    <input type="file" id="photoInputE" class="form-control" accept="image/*" name="BPhoto[]" onchange="loadFilesE(event, 'E')" multiple>
                                </div>
                                <div class="col-9 border ">
                                    <div class="row" id="imagePreviewContainerE"></div>
                                </div>
                            </div>
                            <!-- After Photo -->
                            <div class="row border border-success rounded rounded-3 p-3 m-1">
                                <div class="col-md-3">
                                    <label for="photoInputA" class="form-label">After Photos <i class="fas fa-cloud-upload-alt"></i></label>
                                    <input type="file" id="photoInputA" class="form-control" accept="image/*" name="APhoto[]" onchange="loadFilesE(event, 'A')" multiple required>
                                </div>
                                <div class="col-9 border">
                                    <div class="row" id="imagePreviewContainerA"></div>
                                </div>
                            </div>


                            <?php $isMobile = preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $_SERVER['HTTP_USER_AGENT']); ?>
                            <script>
                                //selectedFilesE = []; // Array to store selected files

                                var loadFilesE = function(event, Typ) {
                                    var files = event.target.files;
                                    var previewContainer = document.getElementById('imagePreviewContainer' + Typ);
                                    if (files.length > 4) {
                                        alert('Warning: Only the first 4 files will be uploaded, remove and keep only 4 photos');
                                    }

                                    for (var i = 0; i < files.length; i++) {
                                        var iDiv = document.createElement('div');
                                        iDiv.className = 'col-md-1 border border-warning d-flex align-items-center p-1 m-1';

                                        var output = document.createElement('img');
                                        output.src = URL.createObjectURL(files[i]);
                                        output.onload = function(file) {
                                            return function() {
                                                URL.revokeObjectURL(file.src); // free memory
                                            };
                                        }(files[i]);

                                        var deleteButton = document.createElement('button');
                                        deleteButton.className = 'btn btn-danger rounded-circle';
                                        deleteButton.id = 'deleteBu';
                                        deleteButton.innerHTML = '<i class="fas fa-times"></i>';
                                        deleteButton.setAttribute('style', '<?php if (!($isMobile)) echo 'font-size: 9px;'; ?> position: relative; top: -30%; right: 12%; transform: translate(-50%, -50%);');
                                        deleteButton.onclick = function(file, div, Typ) {
                                            return function() {
                                                // Remove the corresponding image preview when the delete button is clicked
                                                div.remove();

                                                // Remove the corresponding file from the selectedFiles array
                                                var index = (Typ == 'E') ? selectedFilesE.indexOf(file) : selectedFilesA.indexOf(file);
                                                if (index !== -1) {
                                                    //console.log("selectedFilesE_Array:"+selectedFilesE[index].name+"| Index:"+index);
                                                    if (Typ == 'E') {
                                                        selectedFilesE.splice(index, 1);
                                                    } else {
                                                        selectedFilesA.splice(index, 1);
                                                    }
                                                    // Update the input file element with the new selected files
                                                    const filesOnly = (Typ === 'E') ? selectedFilesE.filter(item => item instanceof File) : selectedFilesA.filter(item => item instanceof File);
                                                    var photoInputEle = document.getElementById('photoInput' + Typ);
                                                    console.log('filesOnly:');
                                                    console.log(filesOnly);
                                                    console.log('Files in ' + photoInputEle.id);
                                                    console.log(photoInputEle.files);
                                                    console.log('Filtered from Array:');
                                                    console.log(FileListFromArray(filesOnly));

                                                    document.getElementById('photoInput' + Typ).files = new FileListFromArray(filesOnly);
                                                }

                                                console.log("selectedFilesE:" + selectedFilesE);
                                                console.log("selectedFilesA:" + selectedFilesA);
                                            };
                                        }(files[i], iDiv, Typ);


                                        // Append the image element and delete button to the preview container
                                        iDiv.appendChild(output);
                                        iDiv.appendChild(deleteButton);
                                        previewContainer.appendChild(iDiv);

                                        // Add the file to the selectedFiles array if it's not already present
                                        if ((Typ == 'E') && (!selectedFilesE.includes(files[i]))) {
                                            selectedFilesE.push(files[i]);
                                        } else if ((Typ == 'A') && (!selectedFilesA.includes(files[i]))) {
                                            selectedFilesA.push(files[i]);
                                        }
                                    }

                                    // Update the input file element with the new selected files
                                    // Assuming selectedFilesE is an array containing strings and files

                                    // Filter out strings from the array to keep only files
                                    const filesOnly = (Typ == 'E') ? selectedFilesE.filter(item => item instanceof File) : selectedFilesA.filter(item => item instanceof File);

                                    // Create a FileList from the array of files
                                    const filesList = new FileListFromArray(filesOnly);

                                    console.log(filesList);
                                    console.log((Typ == 'E') ? selectedFilesE : selectedFilesA);

                                    // Update the input file element with the new selected files
                                    document.getElementById('photoInput' + Typ).files = filesList;

                                    //document.getElementById('photoInputE').files = new FileListFromArray(selectedFilesE);
                                };

                                // Helper function to create a FileList from an array of files
                                function FileListFromArray(array) {
                                    var fileList = new DataTransfer();
                                    for (var i = 0; i < array.length; i++) {
                                        fileList.items.add(array[i]);
                                    }
                                    return fileList.files;
                                }
                            </script>

                            <div class="row p-2" id='formBottom'>
                                <div class="col-md-4 text-primary border rounded rounded-3 m-1 p-1 border-warning">
                                    <lo class='text-danger'> Nominate this for Best Suraksha Samvaad? </lo> <br>
                                    <input class="form-check-input" type="radio" name="Nominate" id="NominateEy" value='Yes'>
                                    <label for="NominateEy" class='text-success'>Yes</label>
                                    <input class="form-check-input" type="radio" name="Nominate" id="NominateEn" value='No'>
                                    <label for="NominateEn">Not this time</label>
                                </div>
                                <!-- Close button for the modal -->
                                <div class="col-md-1 mb-3">
                                    <button type="button" id="closeButtonE" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 100%;">Close</button>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <!-- Submit button for the form -->
                                    <button type="submit" id="submitButtonE" class="btn btn-primary" style="width: 100%;">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="../includes/jspdf.umd.min.js"></script>
        <script src="../includes/jspdf.plugin.autotable.js"></script>
        <script>
            function downloadPDF() {
                const doc = new jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a2',
                });

                doc.autoTable({
                    html: '#dataTable',
                    //theme: "grid",
                    startY: 25,
                    // split overflowing columns into pages
                    horizontalPageBreak: true,
                    // repeat this column in split pages
                    horizontalPageBreakRepeat: 0,
                    /*headStyles: StyleDef,   */
                    styles: {
                        halign: "center",
                        cellPadding: 1
                    },
                    columnStyles: {
                        0: {
                            halign: "left",
                            cellWidth: 10
                        },
                        2: {
                            halign: "left",
                            cellWidth: 10
                        },
                    },
                    margin: {
                        top: 10,
                        bottom: 10,
                        left: 10,
                        right: 10
                    }, // Adjusted startY to make space for the logo
                });

                doc.save("SSFull_Table.pdf");
            }

            // Add DataTables Buttons for exporting
            $('#downloadPDF').on('click', function() {
                window.jsPDF = window.jspdf.jsPDF
                // Use A4 landscape page size
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a2',
                });

                // Add logo at the top-left corner
                const logoWidth = 42; // Set the width of your logo
                const logoHeight = 30; // Set the height of your logo
                pdf.addImage('../JALj.jpg', 'JPEG', 10, 5, logoWidth, logoHeight);

                pdf.setFontSize(32);
                const title = 'Suraksha Samvaad list';
                const titleWidth = pdf.getStringUnitWidth(title) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                const titleX = (pdf.internal.pageSize.width - titleWidth) / 2;
                pdf.text(title, titleX, 15);

                // Get current date and time
                pdf.setFontSize(12);
                const currentDate = new Date();
                const formattedDate = currentDate.toLocaleDateString();
                const formattedTime = currentDate.toLocaleTimeString();
                const dateTimeString = `Generated on: ${formattedDate} ${formattedTime}`;

                // Add date and time
                pdf.text(dateTimeString, titleX * 2, 20);
                // Export all pages to PDF
                pdf.autoTable({
                    html: '#dataTable',
                    theme: "grid",
                    start: 0,
                    margin: {
                        top: 40
                    },
                    useCss: true,
                });

                const generatedByText = 'Generated by: JAL Safety Portal';
                const generatedByTextWidth = pdf.getStringUnitWidth(generatedByText) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                const generatedByTextX = (pdf.internal.pageSize.width - generatedByTextWidth) / 2;
                pdf.text(generatedByText, generatedByTextX, pdf.autoTable.previous.finalY + 10); // Adjust the y-coordinate as needed

                // Download the PDF
                var dt = new Date();
                pdf.save('MITS ' + `${formattedDate} ${formattedTime}` + '.pdf');
            });

            /*function ssPdfRepo(ssid){
                window.jsPDF = window.jspdf.jsPDF
                            // Use A4 landscape page size
                            const pdf = new jsPDF({
                            orientation: 'landscape',
                            unit: 'mm',
                            format: 'a2',
                            });

                            // Add logo at the top-left corner
                            const logoWidth = 42; // Set the width of your logo
                            const logoHeight = 30; // Set the height of your logo
                            pdf.addImage('../JALj.jpg', 'JPEG', 10, 5, logoWidth, logoHeight);

                            pdf.setFontSize(32);
                            const title = 'Suraksha Samvaad Report for SSID:'+ssid;
                            const titleWidth = pdf.getStringUnitWidth(title) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                            const titleX = (pdf.internal.pageSize.width - titleWidth) / 2;
                            pdf.text(title, titleX, 15);
                            
                            // Get current date and time
                            pdf.setFontSize(12);
                            const currentDate = new Date();
                            const formattedDate = currentDate.toLocaleDateString();
                            const formattedTime = currentDate.toLocaleTimeString();
                            const dateTimeString = `Generated on: ${formattedDate} ${formattedTime}`;

                            // Add date and time
                            pdf.text(dateTimeString, titleX * 2, 20);
                            // Export all pages to PDF
                            pdf.autoTable({
                            html: '#SamwEd',
                            theme: "grid",
                            start: 0,
                            margin: { top: 40 },
                            useCss: true,
                            });

                            const generatedByText = 'Generated by: JAL Safety Portal';
                            const generatedByTextWidth = pdf.getStringUnitWidth(generatedByText) * pdf.internal.getFontSize() / pdf.internal.scaleFactor;
                            const generatedByTextX = (pdf.internal.pageSize.width - generatedByTextWidth) / 2;
                            pdf.text(generatedByText, generatedByTextX, pdf.autoTable.previous.finalY + 10); // Adjust the y-coordinate as needed

                            // Download the PDF
                            var dt = new Date();
                            pdf.save('SS_Report_'+ssid+' '+`${formattedDate} ${formattedTime}`+'.pdf');
            }*/

            /*function ssPdfRepo(ssid){
        // Choose the element that your content will be rendered to.
		const element = document.getElementById('SamwEd');
        
        const currentDate = new Date();
		// Choose the element and save the PDF for your user.
        const formattedDate = currentDate.toLocaleDateString();
        const formattedTime = currentDate.toLocaleTimeString();
		html2pdf().from(element).save('SS_Report_'+ssid+' '+`${formattedDate} ${formattedTime}`+'.pdf');  
    }*/
            //Working PDF Function
            function ssPdfRepo(ssid, type) {
                // Choose the element that your content will be rendered to.
                //const element = document.getElementById('SamwEd');
                //const element = document.getElementsByClassName('modal-content');
                const element = document.getElementById('UploadModalPDF');

                const currentDate = new Date();
                const formattedDate = currentDate.toLocaleDateString();
                const formattedTime = currentDate.toLocaleTimeString();

                // Define options for pdf generation, including page size.
                const options = {
                    filename: 'SS_Report_' + ssid + ' ' + `${formattedDate} ${formattedTime}` + '.pdf',
                    html2canvas: {},
                    jsPDF: {
                        format: 'a3', // Set a default format
                        //orientation: 'landscape', // Set orientation to landscape
                        unit: 'mm', // Set measurement unit to millimeters
                        // Set custom width to fit content (adjust as needed)
                        // You may need to experiment with this value to fit your content properly
                        // For landscape orientation, width becomes height
                        // You can calculate width in mm by multiplying the number of pixels by 0.264583
                        // For example, if you want to fit the content within a 1200px width screen,
                        // you can set width as 1200 * 0.264583 = 317mm
                        //width: 1017 ,
                        // Set custom margins to make space for the header
                        margin: {
                            top: 30,
                            right: 20,
                            bottom: 10,
                            left: 20
                        }
                    }
                };

                var closebtns = document.getElementsByClassName('rounded-circle');
                var afterPhotos = document.getElementsByClassName('d-flex align-items-center p-1 m-1');
                //var beforePhotos = document.getElementsByClassName('d-flex align-items-center p-1 m-1'); 
                // Change class for afterPhotos
                for (var i = 0; i < afterPhotos.length; i++) {
                    afterPhotos[i].classList.remove('col-md-1');
                    afterPhotos[i].classList.add('col-md-9');
                }

                for (let i = 0; i < closebtns.length; i++) {
                    closebtns[i].style.display = 'none';
                }

                // Select the table element
                const table = document.querySelector('.table.table-striped.table-bordered.border-primary');

                // Hide the last column and its header
                const lastColumnCells = table.querySelectorAll('tr td:last-child');
                const lastColumnHeader = table.querySelector('th:last-child');
                lastColumnCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                lastColumnHeader.style.display = 'none';


                // Get the selected radio button
                const selectedRadioButton = document.querySelector('input[name="SSType"]:checked');

                const radioButtons = document.querySelectorAll('input[name="SSType"]');
                radioButtons.forEach(radioBtn => {
                    radioBtn.style.display = 'none';
                });

                // Hide all labels initially
                const allLabels = document.querySelectorAll('label[for="UA"], label[for="UC"]');
                allLabels.forEach(label => {
                    label.style.display = 'none';
                });

                // Show the label of the selected radio button
                const selectedLabel = document.querySelector(`label[for="${selectedRadioButton.id}"]`);
                if (selectedLabel) {
                    selectedLabel.style.display = 'inline';
                }

                // Header
                var headerH5 = document.getElementById('UpdateModalLabel');
                var back_headerH5 = headerH5.innerHTML; // corrected from innerHtml to innerHTML
                headerH5.innerHTML = "Suraksha Samvaad Report for SSID: " + ssid; // corrected from innerHtml to innerHTML

                // Get the selected radio button of Nomination
                const nominated = document.querySelector('input[name="Nominate"]:checked'); //NominateEy

                // Show the Star if nominated
                if (nominated.value == "Yes") headerH5.innerHTML += " &ensp; <b class='text-primary fs-3'>★</> &ensp; ";
                //else if (nominated.value == "No") headerH5.innerHTML += " &ensp; ☆ &ensp; "; 

                var PDFDownBTN = document.getElementById('PDFDownBtn');
                var SelTMEd = document.getElementById('SelTMEd');
                var photoInputE2 = document.getElementById('photoInputE');
                var photoInputA2 = document.getElementById('photoInputA');
                var hrLine = document.getElementById('hrLine');
                /*var formBottom = document.getElementById('formBottom'); 
                formBottom.style.display = 'none'; */
                hrLine.style.display = 'none';
                photoInputA2.style.display = 'none';
                photoInputE2.style.display = 'none';
                SelTMEd.style.display = 'none';
                PDFDownBTN.style.display = 'none';

                // Generate PDF with specified options.
                //html2pdf().from(element).set(options).save();
                // submitBTN.style.display = '';
                if (type == 'img') {
                    html2canvas(document.querySelector('#UploadModalPDF')).then(canvas => {
                        // Create a link element
                        let link = document.createElement('a');
                        // Set the download attribute with a file name
                        link.download = 'SS_Report_' + ssid + ' ' + `${formattedDate} ${formattedTime}` + '.png';
                        // Convert canvas to data URL and set as link href
                        link.href = canvas.toDataURL();
                        // Trigger the download by simulating a click
                        link.click();
                        setTimeout(resetForm, 1);
                    });
                } else if (type == 'pdf') {
                    html2pdf().from(element).set(options).save().then(() => {
                        resetForm();
                    });
                }

                function resetForm() {

                    // After saving the PDF, show the submit button again
                    PDFDownBTN.style.display = '';
                    SelTMEd.style.display = '';
                    photoInputE2.style.display = '';
                    photoInputA2.style.display = '';
                    hrLine.style.display = '';
                    formBottom.style.display = '';

                    for (let i = 0; i < closebtns.length; i++) {
                        closebtns[i].style.display = '';
                    }

                    // Unhide the last column and its header of the table
                    lastColumnCells.forEach(cell => {
                        cell.style.display = '';
                    });
                    lastColumnHeader.style.display = '';

                    // Restore the visibility of the labels
                    allLabels.forEach(label => {
                        label.style.display = 'inline';
                    });

                    radioButtons.forEach(radioBtn => {
                        radioBtn.style.display = '';
                    });

                    for (var i = 0; i < afterPhotos.length; i++) {
                        afterPhotos[i].classList.remove('col-md-9');
                        afterPhotos[i].classList.add('col-md-1');
                    }

                    headerH5.innerHTML = back_headerH5;
                }
            }

            function ssImgRepo() {
                // Get the modal content element
                /*var modalContent = document.getElementById('UploadModalPDF');

                // Use html2canvas to capture the content as a canvas
                html2canvas(modalContent).then(function(canvas) {
                    // Convert canvas to blob
                    canvas.toBlob(function(blob) {
                        // Save the blob as an image file using FileSaver.js
                        saveAs(blob, 'modal_content.png');
                    });
                });*/

            }

            /**/

            //function generatePDF(ssid) {
            /*function ssPdfRepo(ssid){
                    const formHTML = document.getElementById('UploadModalPDF').innerHTML;
                    const cssData = ''; // If you want to include any custom CSS
                    var bootstrapCSSPath = 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css';
                    // Fetch Bootstrap CSS file
                    fetch(bootstrapCSSPath)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Failed to fetch Bootstrap CSS');
                            }
                            return response.text();
                        })
                        .then(bootstrapCSS => {
                            // Send HTML and CSS data to PHP API
                            fetch('pdf.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ html: formHTML, css: bootstrapCSS + ' ' + cssData })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Failed to generate PDF');
                                }
                                return response.blob();
                            })
                            .then(blob => {
                                const url = window.URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.href = url;
                                a.download = 'form.pdf';
                                document.body.appendChild(a);
                                a.click();
                                window.URL.revokeObjectURL(url);
                            })
                            .catch(error => {
                                console.error(error);
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }/**/
        </script>


        <!-- ///////////////////////////          Uploaded Image Modal                   ///////////////////////////////////////////////-->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-body center">
                        <div class="col-md-12 d-flex align-items-center p-1 m-1">
                            <img id="modalImage" alt="Uploaded Image">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modalCloseButton" style="width: 100%;">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="UpStat" style="display:none">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Launch static backdrop modal
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="99999" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-primary" id="staticBackdropLabel">Form upload status</h3>
                    </div>
                    <div class="modal-body">
                        <div id="VinFormStat">
                            <h2 class='text-danger text-center'>
                                <i class="fas fa-exclamation-triangle fa-fade"></i> Uploading Wait...
                            </h2>
                        </div>
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%; display:none">
                                0%
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="display: none;">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toastContainer" class="toast-container toast-container-sm"></div>
        </div>
        <?php if (!$isMobile) echo "
<script>
        document.body.classList.toggle('sb-sidenav-toggled');
</script>";
        ?>

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </body>

    </html>
<?php } ?>