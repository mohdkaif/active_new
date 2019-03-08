<?php
//include database configuration file
include_once 'Config.php';
//get records from database
$query = $mysqli->query("SELECT * FROM enquiry ORDER BY enquiry_id DESC");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "Enquiry_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Date', 'Name', 'Email', 'Mobile','Message');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['date'], $row['name'], $row['email'], $row['mobile'], $row['message']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>