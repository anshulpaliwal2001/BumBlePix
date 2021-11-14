<?php
    session_start();
    if(!$_SESSION["Userid"])
    {
        header("Location:../UserCredentials/UserLogin.php");
        exit();
    }
    require ('PDF_MC.php');
    include "../UserDashHead.php";
    $invoiceNo=$_GET['Invoiceno'];


    $server_name = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "digitalmarketing";

    $connection = mysqli_connect($server_name, $db_user, $db_password, $db_name);
    $dbconfig = mysqli_select_db($connection, $db_name);





    class project extends PDF_MC_Table
    {

        function getDate(): string
        {
            return date("d-m-Y");
        }
        function getTime(): string
        {
            return date("h:i:s a");
        }

        public function Header()
        {
            //Start


            $page=$this->PageNo();
            if($page==1) {
                $this->Image('BumblePixLogo.png', 7, 6, 25, 25);
                $this->SetFont('Courier', 'B', '25',);         //Font
                $this->Cell(22, '5', '', '0', '0');
                $this->Cell(75, '10', 'BumblePix', '0', '0', 'l');
                $this->SetFont('Courier', 'B', '25',);
                $this->Cell(95, '10', 'INVOICE', '0', '1', 'R');
                $this->SetFont('Courier', 'B', '12',);         //Font
                $this->Cell(22, '5', '', '0', '0');
                $this->SetTextColor(219,65,64);
                $this->SetFont('Courier', 'BI', '12',);
                $this->Cell(50, '5', '#DigitalExcellence', '0', '0', 'l');
                $this->SetTextColor(0,0,0);
                $this->SetFont('Courier', 'B', '10',);
                $this->SetTextColor(86,102,123);
                $this->Cell(75, '5', '', '0', '0');
                $this->Cell(44, '5', 'Client Copy', '0', '1','R');
                $this->Cell(22, '5', '', '0', '0');
                $this->Cell(75, '5', 'Designed By Anshul', '0', '1');
                $this->SetTextColor(65, 65, 65);
                $this->SetFont('Courier', 'B', '10',);
                $this->Cell(120, '5', '', '0', '0','L');
                $this->Cell(28, '5', 'Invoice NO', '0', '0','L');
                $this->Cell(35, '5', ": ".GetFormattedInvoice($_GET['Invoiceno']), '0', '1','L');

                $this->Cell(20, '5', 'To ', '0', '0','L');
                $this->Cell(100, '5', ': @'. GetUsername(), '0', '0','L');
                $this->Cell(28, '5', 'Invoice DATE', '0', '0','L');
                $this->Cell(35, '5', ': '.GetInvoiceDate($_GET['Invoiceno']), '0', '1','L');

                $this->Cell(20, '5', 'E-Mail', '0', '0','L');
                $this->Cell(100, '5', ': '.Getmail(), '0', '0','L');
                $this->Cell(28, '5', 'Invoice Time', '0', '0','L');
                $this->Cell(35, '5', ': '.GetInvoiceTime($_GET['Invoiceno']), '0', '1','L');

                $this->Cell(20, '5', 'Address', '0', '0','L');
                $this->Cell(100, '5', ': '.GetAdd(), '0', '1','L');

                $this->Ln(5);
            }






            // Table Head
            $this->SetTextColor(219,65,64);
            $this->SetFont('Courier','B','12');                        //Font
            $this->Cell(8,'5','Sr.','1','0','C');            //Sr. No.
            $this->Cell(47,'5','Item Name','1','0','C');          //Title

            $this->Cell(25,'5','HSN','1','0','C');
            $this->Cell(25,'5','Qty','1','0','C');
            $this->Cell(30,'5','Rate','1','0','C');
            $this->Cell(20,'5','IGST','1','0','C');
            $this->Cell(35,'5','Amount','1','1','C');
            $this->Ln(5);


        }
        function Footer()
        {

            $this->SetY(-15);
            $this->SetFont('Courier', 'B', '10',);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(63,5,'Time : '.$this->getTime(),0,0,'C');
            $this->Cell(64,5,'Date : '.$this->getDate(),0,0,'C');
            $this->Cell(63,5,'Page : '.$this->PageNo().' of {pages}',0,1,'R');





        }
    }

    //RBG rgb(219,65,64)



    $pdf= new project();
    $pdf->AliasNbPages('{pages}');
    $pdf->AddPage();
    $pdf->SetTitle('Invoice');
    $pdf->SetAuthor('Anshul Paliwal');
    $pdf->SetSubject('College_Project');








    $pdf->SetTextColor(0,0,0);











    $sr=0;

    $query="SELECT * FROM purchase_log WHERE Invoice_ID=$invoiceNo";
    $query_run=mysqli_query($connection,$query);
    $check_project= mysqli_num_rows($query_run)>0;

    if($check_project)
    {
        $pdf->Cell(190,'0','','1','1','C');
        $subtotal=0;
        while ($row = mysqli_fetch_array($query_run))
        {
            $sr++;

            $itemID=$row['Item_ID'];
            $Qty=$row['Purchase_Qty'];
            $rate=$row['Purchase_Rate'];
            $IGST=$row['purchase_taxrate'];

            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Courier','B','12');

            $pdf->Cell(8,'10',$sr,'1','0','C');

            $pdf->Cell(47,'5',GetItemName($itemID),'0','0','C');
            $pdf->SetFont('arial','','8');
            $pdf->Cell(25,'10',GetItemHSN($itemID),'1','0','C');
            $pdf->Cell(25,'10',$Qty,'1','0','C');
            $pdf->Cell(30,'10',"Rs. ".moneyFormatIndia($rate),'1','0','C');
            $subtotal=$subtotal+$rate;
            $pdf->Cell(20,'10',$IGST."%",'1','0','C');
            $pdf->SetFont('arial','B','10');
            $pdf->Cell(35,'10',"Rs. ".moneyFormatIndia(ceil($Qty*$rate)),'1','0','R');
            $pdf->Cell(0,'5','','0','1','C');
            $pdf->Cell(8,'5','','0','0','C');
            $pdf->SetTextColor(105,105,105);
            $pdf->SetFont('arial','','8');
            $pdf->Cell(47,'5',GetItemCat($itemID)." | ".GetItemPer($itemID),'0','1','C');
            $pdf->Cell(190,'0','','1','1','C');



        }
        $pdf->Ln(5);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Courier','B','12');

        $pdf->Cell(105,'8','','0','0','C');
        $pdf->SetFont('Courier','B','14');
        $pdf->Cell(50,'8','Sub Total :','1','0','R');
        $pdf->SetFont('arial','','12');
        $pdf->Cell(35,'8',"Rs. ".moneyFormatIndia(GetInvoiceSubTotal($invoiceNo)),'1','1','R');
        $pdf->SetFont('Courier','B','12');

        $pdf->SetFont('arial','B','10');
        $pdf->Cell(105,'8',"In Words :",'0','0','L');
        $pdf->SetFont('Courier','B','14');
        $pdf->Cell(50,'8','IGST Total :','1','0','R');
        $pdf->SetFont('arial','','12');
        $pdf->Cell(35,'8',"Rs. ".moneyFormatIndia(GetInvoiceTaxTotal($invoiceNo)),'1','1','R');

        $pdf->SetFont('arial','','8');
        $pdf->Cell(105,'8',convert_number_to_words(GetInvoiceTotal($invoiceNo),0),'0','0','L');
        $pdf->SetFont('Courier','B','16');
        $pdf->Cell(50,'8','Grand Total :','1','0','R');
        $pdf->SetFont('arial','B','14');
        $pdf->SetTextColor(40,181,181);
        $pdf->Cell(35,'8',"Rs. ".moneyFormatIndia(GetInvoiceTotal($invoiceNo)),'1','1','R');

        $pdf->Ln(5);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Courier','','8');
        $pdf->Cell(35,'5',"Status          :",'0','0','L');
        $pdf->SetFont('Courier','B','8');
        $pdf->SetTextColor(40,181,181);
        $pdf->Cell(105,'5',"  PAID",'0','1','L');
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Courier','','8');
        $pdf->Cell(35,'5',"Payment Method  :",'0','0','L');
        $pdf->SetFont('Courier','B','8');
        $pdf->Cell(105,'5'," PixCoins (".(moneyFormatIndia(GetInvoiceTotal($invoiceNo)/10))." Pix paid)",'0','1','L');

    }
    $filename=GetFormattedInvoice($_GET['Invoiceno']).".pdf";
    $pdf->Output('I',$filename);




?>