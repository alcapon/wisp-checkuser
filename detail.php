<?php
include("/var/www/wisp/includes/loader.php");

if ($_REQUEST['cmd'] == "discon" && $_REQUEST['id'] != "") {
    $q = "UPDATE radacct SET AcctStopTime = '" . now() . "' WHERE RadAcctId = " . $_REQUEST['id'];
    echo $q ;
    $db->Execute($q);
}
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
                <a href="index.php" data-icon="delete">Back</a>
                <h1><?php echo $_REQUEST['username']; ?></h1>
            </div>

            <div data-role="content">                
                <ul data-role="listview" data-inset="true">
                    <?php
                    if ($_REQUEST['username'] != '') {
                        $q = "SELECT RadAcctId,UserName,AcctStartTime,AcctStopTime FROM radacct WHERE UserName = '" . $_REQUEST['username'] . "' ORDER BY RadAcctId DESC LIMIT 0,50";
                        $rec = $db->Execute($q);
                        while (!$rec->EOF) {
                            if ($rec->fields['AcctStopTime'] != "0000-00-00 00:00:00") {
                                echo "<li>" . $rec->fields['AcctStartTime'] . " - " . $rec->fields['AcctStopTime'] . "</li>";
                            } else {
                                echo "<li><a href='" . $_SERVER['PHP_SELF'] . "?cmd=discon&username=" . $_REQUEST['username'] . "&id=" . $rec->fields['RadAcctId'] . "'>" . $rec->fields['AcctStartTime'] . " - " . $rec->fields['AcctStopTime'] . "</a></li>";
                            }
                            $rec->MoveNext();
                        }
                    } else {
                        echo "<li> -- No data -- </li>";
                    }
                    ?>
                </ul>
                <p align="center">Last : <?php echo $rec->RecordCount(); ?> Rec.</p>
            </div>

        </div>
    </body>
</html>
<?php $db->Close(); ?>