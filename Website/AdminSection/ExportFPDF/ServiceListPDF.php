<?php
    require ('PDF_MC.php');

    $server_name = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "digitalmarketing";

    $connection = mysqli_connect($server_name, $db_user, $db_password, $db_name);
    $dbconfig = mysqli_select_db($connection, $db_name);

    date_default_timezone_set('Asia/Kolkata');
    $currentdate = date("d-m-Y");
    $currenttime= date("h:i:s a");

    $page=8;


    //RBG rgb(219,65,64)



    $pdf= new PDF_MC_Table( );
    $pdf->AddPage();
    $pdf->SetTitle('Service_List');
    $pdf->SetAuthor('Anshul Paliwal');
    $pdf->SetSubject('College_Project');

    $page=$pdf->PageNo();
    $tot=$pdf->AliasNbPages();




    //Start
    $pdf->Cell(70,'5','','0','1');          //Empty Lines
    $pdf->SetFont('Courier','B','20',);
    $pdf->SetTextColor(219,65,64);                      //Primary Color
    $pdf->Cell(135,'5','BumblePixCo','0','0');
    $pdf->SetTextColor(0,0,0);                             //Black Color
    $pdf->SetFont('Courier','','14',);
    $pdf->Cell(20,'5','Time : ','0','0');
    $pdf->Cell(20,'5',$currenttime,'0','1');
    $pdf->Cell(135,'5','','0','0');         //Empty Space
    $pdf->Cell(20,'5','Date : ','0','0');
    $pdf->Cell(20,'5',$currentdate,'0','1');
    $pdf->Cell(70,'5','','0','1');          //Empty Lines
    $pdf->SetFont('Courier','B','30',);         //Font
    $pdf->Cell(55,'5','','0','0');          //Empty Space
    $pdf->Cell(30,'5','Service List','0','0','','','');
    $pdf->SetFont('Courier','I','10',);
    $pdf->Cell(25,'20','Designed By','0','0');
    $pdf->SetFont('Courier','IB','10',);
    $pdf->SetTextColor(219,65,64);
    $pdf->Cell(70,'20','Anshul Paliwal','0','1');//Empty Lines




    // Table Head
    $pdf->SetFont('Courier','B','12',);
    $pdf->Cell(8,'5','Sr.','1','0','C');
    $pdf->Cell(8,'5','ID','1','0','C');
    $pdf->Cell(25,'5','Title','1','0','C');
    $pdf->Cell(30,'5','Image','1','0','C');
    $pdf->Cell(119,'5','Details','1','1','C');

    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(55,'5','','0','1');







    // Table Data
    $pdf->SetWidths(Array(8,8,25,30,119));
    $pdf->SetLineHeight('5');
    $pdf->SetFont('Arial','','10',);


    $sr=0;

    $query="SELECT * FROM services ORDER BY services.service_id";
    $query_run=mysqli_query($connection,$query);
    $check_project= mysqli_num_rows($query_run)>0;

    if($check_project)
    {
        while ($row = mysqli_fetch_array($query_run))
        {
            $sr++;
            $id=$row['service_id'];
            $title=$row['service_title'];

            $desc=$row['service_details'];

            $image=$row['service_image'];



            $pdf->Row(Array(
                $sr,
                $id,
                $title,
                $image,
                $desc


            ));



        }

    }
    $filename="ProjectList_".date("h-i-s")."_".date("d-m-Y")."_BumblePix";
    $pdf->Output('I',$filename);




?>