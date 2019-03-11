<?php
session_start();
include_once("includes/db.php");
require("fpdf.php");

//echo '<pre>';
//print_r($_POST);

if($_POST['gst']<>'')
{
	$gst=$_POST['gst'];
}
else
{
	$gst='0';
}

$date= $_POST['date'];
$name = $_POST['name'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$phone = $_POST['phone'];

$payment_for = $_POST['payment_for'];
$currency = $_POST['currency'];
//$rnd = rand(1000,9999);

$check=$con->query("SELECT * FROM `invoice` ORDER BY `invoice_id` DESC LIMIT 1");
$check_res=$check->fetch_assoc();
$rnd=$check_res['invoice_number']+1;

$pdf=new FPDF('p','mm','A4');
$pdf->AddPage();

$pdf->Image('header.png',1,0);
$pdf->Cell(135,30,'',0,1);
//$pdf->Cell(135,10,'',0,1);


$pdf->SetFont('Arial','B',14);
$pdf->Cell(130,10,'Aafilogic InfoTech Pvt Ltd',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(135,5,'Regd Off:- CS-20, First Floor, Ansal Plaza,',0,1);
$pdf->Cell(135,5,'Vaishali, Ghaziabad - 201010. India',0,1);
$pdf->Cell(135,5,'Web: www.aafilogicinfotech.com',0,1);
if($gst=='1')
{
$pdf->Cell(135,5,'GST No: 07AAQCA3771K1Z7',0,1);
}

 // 20mm from each edge
$pdf->SetFont('Arial','B',14);
$pdf->Cell(200,30,'INVOICE',0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(135,5,'Bill To,',0,0);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(135,5,$date,0,1);
$pdf->SetFont('Arial','',10);


$pdf->Cell(135,5,$name,0,1);
$pdf->Cell(135,5,$address1,0,0);

$pdf->Cell(135,5,'No:2018/AAFI/'.$rnd,0,1);


$pdf->Cell(135,5,$address2,0,1);
$pdf->Cell(135,5,'Phone: '.$phone,0,1);
$pdf->Cell(135,10,'',0,1);

$pdf->Cell(135,5,'Payment For: '.$payment_for,0,1);
$pdf->Cell(135,10,'',0,1);


$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,5,'S.No',1,0,'C');
$pdf->Cell(70,5,'Product Description ',1,0,'C');
$pdf->Cell(50,5,'Payment Mode ',1,0,'C');
$pdf->Cell(50,5,'total',1,1,'C');

$pdf->SetFont('Arial','',10);
$desc = $_POST['desc'];
$mode = $_POST['mode'];
$amount = $_POST['amount'];

$desc1 = implode(",",$desc);
$mode1 = implode(",",$mode);
$amount1 = implode(",",$amount);

$x=0;
$y=1;
$tot=0;
for($i=0;$i<count($desc);$i++)
{

$pdf->Cell(20,5,$y,1,0,'C');
$pdf->Cell(70,5,$desc[$i],1,0);
$pdf->Cell(50,5,$mode[$i],1,0,'C');
$pdf->Cell(50,5,$currency." ".$amount[$i],1,1,'C');

$y++;
$tot=$tot+$amount[$i];

}


/*$pdf->Cell(20,5,'2',1,0,'C');
$pdf->Cell(70,5,'Facebook,LinkedIn,twitter Maintenance',1,0);
$pdf->Cell(50,5,'Per month ',1,0,'C');
$pdf->Cell(50,5,'5000 ',1,1,'C'); */
if($gst=='1')
{
$gstamount=($tot*18)/100;
$tot=$gstamount+$tot;

$pdf->Cell(20,5,'',1,0);
$pdf->Cell(70,5,'GST 18% ',1,0);
$pdf->Cell(50,5,'',1,0,'C');
$pdf->Cell(50,5,$gstamount,1,1,'C');
}
$pdf->Cell(20,5,'',1,0);
$pdf->Cell(70,5,'Total Payable ',1,0);
$pdf->Cell(50,5,'',1,0,'C');
$pdf->Cell(50,5,$currency." ".$tot,1,1,'C');



$number = $tot;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);



$pdf->Cell(135,5,'',0,1); 


$pdf->SetFont('Arial','',12);
$pdf->Cell(135,5,'In words - '.$result." ".$currency,0,1);
$pdf->Cell(135,5,'',0,1);

$pdf->SetFont('Arial','B',14);
$pdf->SetFont('Arial','U');
$pdf->Cell(135,7,'Bank Details:',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(70,5,'Bank Name- ICICI Bank',0,0);
$pdf->Cell(235,5,'Bank Name- Indusind Bank',0,1);

$pdf->Cell(70,5,'Aafilogic InfoTech Pvt Ltd.',0,0);
$pdf->Cell(135,5,'Aafilogic InfoTech Pvt Ltd.',0,1);

$pdf->Cell(70,5,'Account number:-072105001238',0,0);
$pdf->Cell(135,5,'Account number:-250004051988',0,1);

$pdf->Cell(70,5,'IFSC - ICIC0000721',0,0);
$pdf->Cell(135,5,'IFSC - INDB0000544',0,1);

$pdf->Cell(70,5,'SWIFT CODE - ICICINBBCTS',0,0);
$pdf->Cell(135,5,'SWIFT CODE - INDBINBBFIG',0,1);

$pdf->Cell(70,5,'Account - Current',0,0);
$pdf->Cell(135,5,'Account: Current',0,1);

$pdf->Cell(70,5,'Branch - IP Extension',0,0); 
$pdf->Cell(135,5,'Branch: IP Extension',0,1); 

$pdf->Cell(135,5,'',0,1);

$pdf->Image('footer1.png',0,262);

//======================= query =====================
if($date<>'')
{
	$con->query("insert into invoice(user_id,invoice_number,invoice_date,invoice_name,address1,address2,invoice_phone,payment_for,invoice_desc,invoice_mode,invoice_amount,total_amount,gst,currency) values('{$_SESSION['admin_id']}','$rnd','$date','$name','$address1','$address2','$phone',$payment_for,'$desc1','$mode1','$amount1','$tot','$gstamount','$currency')");
}

//======================= query =====================

$pdf->Output();
?>