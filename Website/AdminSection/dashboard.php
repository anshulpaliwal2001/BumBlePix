<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BumblePix | Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="PictureAdminPage/BumblePixLogo.png" >
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/main.css" />
    <script src="js/uikit.js"></script>
</head>
<?php
    include "AdminHead.php";
    include "../AdminSection/Database/dbconfig.php";

    $connection=mysqli_connect($server_name,$db_user,$db_password,$db_name);
    $dbconfig=mysqli_select_db($connection,$db_name);
?>

<div class="uk-flex uk-flex-middle " data-uk-height-viewport="offset-top: true">
    <div class="uk-width-1-1">
        <div class="uk-section">
            <div class="uk-container">
                <div class="uk-grid-large" data-uk-grid>
                    <div class="uk-width-1-2@m"
                         data-uk-scrollspy="cls: uk-animation-slide-left-small; repeat: true; delay: 200">
                        <img src="PictureAdminPage/dashboard.svg" alt="Header" width="1000" height="1000">
                    </div>
                    <div class="uk-width-1-2@m uk-flex uk-flex-middle"
                         data-uk-scrollspy="cls: uk-animation-slide-right-small; repeat: true; delay: 1000">
                        <div>
                            <a class="uk-text-lead uk-width-4-5@m uk-margin-remove-bottom">
                                Hey   <?php echo $fname; ?>
                            </a>
                            <a class="uk-text-lead uk-width-4-5@m uk-margin-remove-bottom">! Here's your admin
                            </a>

                            <h1 class="uk-heading-medium  uk-margin-remove-top uk-letter-spacing-xl">Dashboard</h1>
                            <p class="uk-text-lead uk-width-4-5@m">
                                We’re a digital marketing agency that delivers transformational growth for our clients.
                                With services ranging from Search to Content to Social Media to Website Design to Mobile Advertising,
                                we consult, strategies and execute to deliver #DigitalExcellence!</p>
                            <div class="uk-margin-medium-top">
                                <a href="#tools" class="uk-button uk-button-large uk-button-primary"
                                   data-uk-scroll="offset: 80">Go to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div id="tools" class="uk-container uk-margin-large-top">
    <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>

        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-bottom-small">
                <?php
                    $result= mysqli_query($connection,"SELECT * FROM digitalmarketing.project");
                    $norows= mysqli_num_rows($result);
                    if($norows>0) {
                        echo " <div class='uk-card-badge uk-label uk-label-success uk-margin-remove'>";
                        echo "$norows", " Projects";
                    }
                    else
                    {
                        echo " <div class='uk-card-badge uk-label'>";
                        echo "No PROJECTS yet";
                    }
                    echo " </div>";

                ?>
                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/Prooject%20icon.svg" alt="" height="125" width="125">
                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Projects</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="ProjectSectionAdmin/AdminProject.php" >View</a>
                    <a class="uk-button uk-button-secondary" href="ProjectSectionAdmin/AdminProject.php">Add</a>
                    <button class="uk-button uk-button-primary" type="button">Export</button>
                    <div uk-dropdown="pos:top-center">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><b>Select Format</b></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="../AdminSection/ExportFPDF/ProjectListPDF.php" target="_blank">PDF</a></li>
                            <li><a href="#">SpreadSheet</a></li>
                            <li><a href="#">CSV</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-bottom-medium">
                <?php
                    $result= mysqli_query($connection,"SELECT * FROM digitalmarketing.services");
                    $norows= mysqli_num_rows($result);
                    if($norows>0) {
                        echo " <div class='uk-card-badge uk-label uk-label-success uk-margin-remove'>";
                        echo "$norows", " Services";
                    }
                    else
                    {
                        echo " <div class='uk-card-badge uk-label'>";
                        echo "No Services yet";
                    }
                    echo " </div>";

                ?>
                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/service.svg" alt="" height="125" width="125">
                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Services</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="ServicesSectionAdmin/AdminServices.php">View</a>
                    <a class="uk-button uk-button-secondary" href="ServicesSectionAdmin/AdminServices.php">Add</a>
                    <button class="uk-button uk-button-primary" type="button">Export</button>
                    <div uk-dropdown="pos:top-center">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><b>Select Format</b></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="../AdminSection/ExportFPDF/ServiceListPDF.php" target="_blank">PDF</a></li>
                            <li><a href="#">SpreadSheet</a></li>
                            <li><a href="#">CSV</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-bottom-small">
                <?php
                    $result= mysqli_query($connection,"SELECT * FROM digitalmarketing.clients");
                    $norows= mysqli_num_rows($result);
                    if($norows>0) {
                        echo " <div class='uk-card-badge uk-label uk-label-success uk-margin-remove'>";
                        echo "$norows", " Clients";
                    }
                    else
                    {
                        echo " <div class='uk-card-badge uk-label'>";
                        echo "No Clients yet";
                    }
                    echo " </div>";

                ?>
                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/client.svg" alt="" height="125" width="125">
                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Clients</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="AdminProjects.php">View</a>
                    <a class="uk-button uk-button-secondary" href="AddProject.php">Add</a>
                    <button class="uk-button uk-button-default" disabled>Export</button>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-left-small">

                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/stats.svg" alt="" height="125" width="125">

                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Statistics</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="StatisticsSectionAdmin/AdminStatistics.php">View</a>
                    <a class="uk-button uk-button-secondary" href="StatisticsSectionAdmin/AdminStatistics.php">Edit</a>
                    <button class="uk-button uk-button-default" disabled>Export</button>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-right-small">
                <?php
                    $result= mysqli_query($connection,"SELECT * FROM digitalmarketing.contacts WHERE contact_seen = 0");
                    $norows= mysqli_num_rows($result);
                    if($norows>0) {
                        echo " <div class='uk-card-badge uk-label  uk-margin-remove'>";
                        echo "$norows", " Unseen Messages";
                    }
                    else
                    {
                        echo " <div class='uk-card-badge uk-label-success uk-label'>";
                        echo "No New Message";
                    }
                    echo " </div>";


                ?>
                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/response.svg" alt="" height="125" width="125">

                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Responses</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="ResponseSectionAdmin/AdminResponses.php">View</a>
                    <button class="uk-button uk-button-default" disabled>Export</button>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-grid-match uk-child-width-expand@s uk-text-center" uk-grid>

        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-bottom-small">
                <?php
                    $result= mysqli_query($connection,"SELECT * FROM digitalmarketing.user_info");
                    $norows= mysqli_num_rows($result);
                    if($norows>0) {
                        echo " <div class='uk-card-badge uk-label uk-label-success uk-margin-remove'>";
                        echo "$norows", " Users";
                    }
                    else
                    {
                        echo " <div class='uk-card-badge uk-label'>";
                        echo "No users yet";
                    }
                    echo " </div>";

                ?>
                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/users.svg" alt="" height="125" width="125">
                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Users</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="UsersSectionAdmin/AdminUsersInfo.php" >View</a>

                    <button class="uk-button uk-button-secondary" type="button">Export</button>
                    <div uk-dropdown="pos:top-center">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><b>Select Format</b></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="../AdminSection/ExportFPDF/ProjectListPDF.php" target="_blank">PDF</a></li>
                            <li><a href="#">SpreadSheet</a></li>
                            <li><a href="#">CSV</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-bottom-medium">

                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/pie-chart.png" alt="" height="125" width="125">
                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Analytics</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="Analytics/AdminAnalytics.php">View</a>

                </div>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-animation-slide-bottom-small">
                <?php
                    $result= mysqli_query($connection,"SELECT * FROM digitalmarketing.clients");
                    $norows= mysqli_num_rows($result);
                    if($norows>0) {
                        echo " <div class='uk-card-badge uk-label uk-label-success uk-margin-remove'>";
                        echo "$norows", " Clients";
                    }
                    else
                    {
                        echo " <div class='uk-card-badge uk-label'>";
                        echo "No Clients yet";
                    }
                    echo " </div>";

                ?>
                <div class="uk-card-media-top uk-margin-large-top ">
                    <img src="PictureAdminPage/client.svg" alt="" height="125" width="125">
                </div>

                <div class="uk-card-body">
                    <h1 class="uk-card-title uk-text-center">Clients</h1>
                </div>
                <div class="uk-button-group uk-margin-auto uk-margin-bottom">
                    <a class="uk-button uk-button-primary" href="AdminProjects.php">View</a>
                    <a class="uk-button uk-button-secondary" href="AddProject.php">Add</a>
                    <button class="uk-button uk-button-default" disabled>Export</button>
                </div>
            </div>
        </div>
    </div>
</div>




















