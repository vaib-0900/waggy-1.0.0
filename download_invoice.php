<?php
include "db_connection.php";




$order_id = mysqli_real_escape_string($conn, $_GET['id']);
$customer_id = ['customer_id'];

// Verify the order belongs to the customer
$order_query = "SELECT * FROM orders WHERE order_id = ? AND customer_id = ?";
$stmt = mysqli_prepare($conn, $order_query);
mysqli_stmt_bind_param($stmt, "si", $order_id, $customer_id);
mysqli_stmt_execute($stmt);
$order_result = mysqli_stmt_get_result($stmt);



$order = mysqli_fetch_assoc($order_result);

// Get order items
$items_query = "SELECT * FROM order_items WHERE order_id = ?";
$stmt = mysqli_prepare($conn, $items_query);
mysqli_stmt_bind_param($stmt, "s", $order_id);
mysqli_stmt_execute($stmt);
$items_result = mysqli_stmt_get_result($stmt);

// Include the TCPDF library

// Create new PDF document
$pdf = new TCPDF.(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Waggy Pet Shop');
$pdf->SetAuthor('Waggy Pet Shop');
$pdf->SetTitle('Invoice #' . $order_id);
$pdf->SetSubject('Order Invoice');
$pdf->SetKeywords('Invoice, Order, Waggy Pet Shop');

// Set default header data
$pdf->SetHeaderData('', 0, 'Waggy Pet Shop', '123 Pet Street, Baramati, 413102');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Invoice title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'INVOICE', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Order #' . $order_id, 0, 1, 'C');

// Status badge
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Status: ' . $order['status'], 0, 1, 'C');

// From and To sections
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'From:', 0, 1);
$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(90, 5, "Waggy Pet Shop\n123 Pet Street\nBaramati, Near Bus Stand 413102\nPhone: +91-8007450432\nEmail: support@waggyshop.com\nGSTIN: 07ABCDE1234F1Z5", 0, 'L');

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'To:', 0, 1);
$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(90, 5, htmlspecialchars($order['name']) . "\n" . 
                     htmlspecialchars($order['address']) . "\n" . 
                     htmlspecialchars($order['city']) . ", " . htmlspecialchars($order['state']) . " " . htmlspecialchars($order['zip_code']) . "\n" . 
                     "Phone: " . htmlspecialchars($order['phone']) . "\n" . 
                     "Email: " . htmlspecialchars($order['email']), 0, 'L');

// Invoice details
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(90, 10, 'Invoice Date: ' . date('F j, Y', strtotime($order['order_date'])), 0, 0);
$pdf->Cell(90, 10, 'Payment Method: ' . htmlspecialchars($order['payment_method']), 0, 1, 'R');

// Order items table
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(80, 10, 'Product', 1, 0);
$pdf->Cell(30, 10, 'Price', 1, 0, 'R');
$pdf->Cell(20, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total', 1, 1, 'R');

$pdf->SetFont('helvetica', '', 10);
while ($item = mysqli_fetch_assoc($items_result)) {
    $pdf->Cell(80, 10, htmlspecialchars($item['product_name']), 'LR', 0);
    $pdf->Cell(30, 10, 'Rs.' . number_format($item['price'], 2), 'LR', 0, 'R');
    $pdf->Cell(20, 10, $item['quantity'], 'LR', 0, 'C');
    $pdf->Cell(30, 10, 'Rs.' . number_format($item['price'] * $item['quantity'], 2), 'LR', 1, 'R');
}

// Closing line for the table
$pdf->Cell(130, 0, '', 'T');
$pdf->Cell(30, 0, '', 'T');

// Totals
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(130, 10, 'Subtotal:', 0, 0, 'R');
$pdf->Cell(30, 10, 'Rs.' . number_format($order['total_amount'], 2), 0, 1, 'R');

$pdf->Cell(130, 10, 'Shipping Fee:', 0, 0, 'R');
$pdf->Cell(30, 10, 'Free', 0, 1, 'R');

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(130, 10, 'Total Amount:', 0, 0, 'R');
$pdf->Cell(30, 10, 'Rs.' . number_format($order['total_amount'], 2), 0, 1, 'R');

// Thank you message
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 10, 'Thank you for your business!', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 10, 'Waggy Pet Shop - Where Every Pet is Family!', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 10, 'For any questions regarding this invoice, please contact our customer support.', 0, 1, 'C');

// Close and output PDF document
$pdf->Output('invoice_' . $order_id . '.pdf', 'D');

// Close database connection
mysqli_close($conn);
?>