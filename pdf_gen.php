<?php
session_start();
function fetch_data($mail)
{
    
    $output = '';
    $con = mysqli_connect("localhost", "root", "", "lotti");
    $sql = "SELECT * FROM user WHERE email='$mail' ORDER BY id ASC";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<tr>  
                          <td>' . $row["id"] . '</td>  
                          <td>' . $row["username"] . '</td>  
                          <td>' . $row["email"] . '</td>  
                          <td>' . $row["address"] . '</td>  
                          <td>' . $row["phone"] . '</td>  

                          </tr>  
                          ';
                          $name=$row['username'];
    }
    return $output;
}
if (isset($_POST["generate_pdf"])) {
    require_once('tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle(" Registration Record");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 11);
    $obj_pdf->AddPage();
    $content = '';
    $content .= '  
      <h4 align="center"></h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%">Id</th>  
                <th width="20%">Name</th>  
                <th width="15%">Email</th>  
                <th width="30%">Address</th>  
                <th width="20%">Phone No</th>  

                </tr>  
      ';
    $content .= fetch_data($_SESSION['email']);
    $content .= '</table>';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('file.pdf', 'I');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Registration Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <br />
    <div class="container">
        <h4 align="center"> <?php echo $_SESSION['username'];?> Registration Record</h4><br />
        <div class="table-responsive">
            <div class="col-md-12" align="right">
                <form method="post">
                    <input type="submit" name="generate_pdf" class="btn btn-success" value="Print" />
                </form>
            </div>
            <br />
            <br />
            <table class="table table-bordered">
                <tr>
                    <th width="5%">Id</th>
                    <th width="20%">Name</th>
                    <th width="15%">Email</th>
                    <th width="30%">Address</th>
                    <th width="20%">Phone No</th>
                </tr>
                <?php
                echo fetch_data($_SESSION['email']);
                ?>
            </table>
        </div>
    </div>
</body>

</html>