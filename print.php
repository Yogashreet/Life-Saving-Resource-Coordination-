<?php
require("db.php");

$result =mysqli_query($con,"SELECT bloodonor.fname,bloodonor.lname,bloodonor.id_num,bloodonor.email,bloodonor.gender,bloodonor.age,bloodonor.weight,bloodonor.county,bloodonor.phone,submit_details.dtype FROM bloodonor,submit_details WHERE bloodonor.id=submit_details.b_id ORDER BY bloodonor.id");
$header =mysqli_query($con,"SELECT * 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='project_db' 
    AND `TABLE_NAME`='bloodonor'");

require('fpdf/fpdf.php');
$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(10);
$pdf->Cell(28,6,'First Name',0,0,'C',1);
$pdf->Cell(28,6,'Last Name',0,0,'C',1);
$pdf->Cell(28,6,'ID No.',0,0,'C',1);
$pdf->Cell(28,6,'Email',0,0,'C',1);
$pdf->Cell(28,6,'Gender',0,0,'C',1);
$pdf->Cell(28,6,'Age',0,0,'C',1);
$pdf->Cell(28,6,'Weight',0,0,'C',1);
$pdf->Cell(28,6,'County',0,0,'C',1);
$pdf->Cell(28,6,'Phone',0,0,'C',1);
$pdf->Cell(29,6,'Donation Type',0,0,'C',1);

foreach($result as $row) {

	$pdf->SetFont('Arial','',9);	
	$pdf->Ln();
	foreach($row as $column){
		$pdf->Cell(28,20,$column,0,0, "C");
    }
}
$pdf->Output();
?>


<?php

?>