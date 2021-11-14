<?php
    require ('PDF_MC.php');

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
                $this->Image('BumblePixLogo.png', 30, 5, 22, 22);
                $this->SetFont('Courier', 'B', '30',);         //Font

                $this->Cell(190, '10', 'Project List', '0', '1', 'C');
                $this->SetFont('Courier', 'I', '10',);
                $this->Cell(68, '5', '', '0', '0');          //Empty Space
                $this->Cell(25, '5', 'Designed By', '0', '0');
                $this->SetFont('Courier', 'IB', '10',);
                $this->SetTextColor(219, 65, 64);
                $this->Cell(50, '5', 'Anshul Paliwal', '0', '0');
                $this->SetFont('Courier', 'B', '10',);
                $this->SetTextColor(0, 0, 0);
                $this->Cell(25, '5', 'Total Page(s): ' . "{pages}", '0', '1');
                $this->Ln(5);
            }






            // Table Head
            $this->SetTextColor(219,65,64);
            $this->SetFont('Courier','B','12');                        //Font
            $this->Cell(8,'5','Sr.','1','0','C');            //Sr. No.
            $this->Cell(8,'5','ID','1','0','C');             //ID
            $this->Cell(25,'5','Title','1','0','C');          //Title
            $this->Cell(79,'5','Description','1','0','C');    //Description
            $this->Cell(30,'5','Image','1','0','C');          //Image
            $this->Cell(40,'5','Link','1','1','C');           //Link
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
    $pdf->SetTitle('Project_List');
    $pdf->SetAuthor('Anshul Paliwal');
    $pdf->SetSubject('College_Project');








    $pdf->SetTextColor(0,0,0);









    // Table Data
    $pdf->SetWidths(Array(8,8,25,79,30,40));
    $pdf->SetLineHeight('5');
    $pdf->SetFont('Arial','','10',);


    $sr=0;

    $query="SELECT * FROM project ORDER BY project.id";
    $query_run=mysqli_query($connection,$query);
    $check_project= mysqli_num_rows($query_run)>0;

    if($check_project)
    {
        while ($row = mysqli_fetch_array($query_run))
        {
            $sr++;
            $id=$row['id'];
            $title=$row['Title'];

            $desc = iconv('UTF-8', 'windows-1252', $row['Description']);

            $image=$row['Image'];
            $link=$row['Site'];


            $pdf->Row(Array(
                $sr,
                $id,
                $title,
                $desc,
                $image,
                $link,

            ));



        }

    }
    $filename="ProjectList_".date("h-i-s")."_".date("d-m-Y")."_BumblePix";
    $pdf->Output('I',$filename);




?>