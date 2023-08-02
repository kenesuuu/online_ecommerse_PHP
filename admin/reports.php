<?php
ob_start(); // Start output buffering

include('partial/menu.php');

require('../fpdf.php');

$sql = "SELECT * FROM tbl_order";
$res = mysqli_query($conn, $sql);

if (!$res) {
    die('Error: ' . mysqli_error($conn));
}

$count = mysqli_num_rows($res);

$pdf = new FPDF('L', 'mm', array(203.2, 355.6)); 

$pdf->AddPage();
$pdf->Image('../img/logo.png', 10, 10, 30); 

$pdf->SetFont('Arial', 'B', 20); 
$pdf->Cell(0, 30, 'Amari', 0, 1, 'C'); 

$pdf->SetFont('Arial', 'B', 20); 
$pdf->Cell(0, 30, 'Order Reports', 0, 1, 'C'); 

$pdf->SetFont('Arial', 'B', 12); 

$pdf->Cell(20, 10, 'Order ID', 1, 0, 'C'); 
$pdf->Cell(50, 10, 'Date', 1, 0, 'C');
$pdf->Cell(40, 10, 'Contact', 1, 0, 'C');
$pdf->Cell(75, 10, 'Email', 1, 0, 'C');
$pdf->Cell(40, 10, 'Payment Method', 1, 0, 'C');
$pdf->Cell(25, 10, 'Price', 1, 0, 'C');
$pdf->Cell(25, 10, 'Status', 1, 0, 'C');

while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $food = $row['food'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $total = $row['total'];
    $order_date = $row['order_date'];
    $status = $row['status'];
    $customer_name = $row['customer_name'];
    $phone_no = $row['phone_no'];
    $customer_email = $row['customer_email'];
    $payment_method = $row['payment_method'];

    $pdf->Ln(); // Move to the next line
    $pdf->Cell(20, 10, $id, 1, 0, 'C');
    $pdf->Cell(60, 10, $customer_name, 1, 0, 'C');
    $pdf->Cell(50, 10, $order_date, 1, 0, 'C');
    $pdf->Cell(40, 10, $phone_no, 1, 0, 'C');
    $pdf->Cell(75, 10, $customer_email, 1, 0, 'C');
    $pdf->Cell(40, 10, $payment_method, 1, 0, 'C');
    $pdf->Cell(25, 10, $price, 1, 0, 'C');
    $pdf->Cell(25, 10, $status, 1, 0, 'C');
}

ob_end_clean(); // Clean the output buffer

$pdf->Output();

include('partial/footer.php');
?>
