<?php
include("/var/www/wisp/includes/loader.php");
?>

<html>
    <head>
        <title>Check Username Mobile Edition</title>
        <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>

    <body>

        <div data-role="page">

            <div data-role="header">
                <h1>Check Username</h1>
            </div>

            <div data-role="content">                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="f" id="f">
                    <label for="search-1">Username:</label>
                    <input type="search" name="keyword" id="keyword" value="<?php echo $_POST['keyword'];?>">
                    <input type="submit" value="Search" data-icon="search" data-iconpos="right" data-theme="e">
                </form>

                <ul data-role="listview" data-inset="true">
                    <?php
                    if ($_POST['keyword'] != '') {
                        $q = "SELECT UserName FROM radcheck WHERE UserName LIKE '%" . $_POST['keyword'] . "%' LIMIT 0,10";
                        $rec = $db->Execute($q);
                        while (!$rec->EOF) {
                            echo "<li><a href='detail.php?username=" . $rec->fields['UserName'] . "'>" . $rec->fields['UserName'] . "</a></li>";
                            $rec->MoveNext();
                        }
                    } else {
                        echo "<li> -- No data -- </li>";
                    }
                    ?>
                </ul>
                <p align="center">Found : <?php echo $rec->RecordCount() ;?> Rec.</p>
            </div>

        </div>
    </body>
</html>
<?php $db->Close(); ?>