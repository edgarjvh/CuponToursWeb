<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] === '' ? 'hidden' : '' : 'hidden';

if ($user_logged == 'hidden'){
    header('location:../');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member - CUPONTOURS.com</title>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dash-member.css">
    <link rel="stylesheet" href="../css/dash-esignature.css">

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/accounting.js"></script>
    <script src="../js/dash-esignature.js"></script>
    <script src="../js/dash-header.js"></script>
    <script src="../js/dash-sidebar.js"></script>

</head>
<body>
<?php include_once 'dash-header.php' ?>

<div class="main-container">
    <?php include_once 'dash-sidebar.php' ?>

    <div class="main-content" id="main-content">
        <div class="pdf-viewer">
            <div class="title">
                <span>Close</span>
            </div>
            <iframe src="" frameborder="0"></iframe>
        </div>

        <section class="dash-content">
            <div class="signature">

                <div class="signature-menu">
                    <ul>
                        <li class="menu-item active" id="documents">
                            <i class="fa fa-file-text-o"></i>
                            My Documents
                            <span class="document-count">0</span>
                        </li>

                        <li class="menu-item " id="customers">
                            <i class="fa fa-users"></i>
                            My Customers
                            <span class="customer-count">0</span>
                        </li>
                    </ul>
                </div>

                <div class="signature-content">
                    <span class="btn-new-document"><i class="fa fa-file"></i>New Document</span>

                    <div class="signature-description">
                        <div class="tbl">
                            <div class="tbl-head">
                                <div class="tbl-row">
                                    <div class="tbl-cell doc-id hidden">Doc Id</div>
                                    <div class="tbl-cell show-pdf"></div>
                                    <div class="tbl-cell customer">Customer</div>
                                    <div class="tbl-cell doc-number">Number</div>
                                    <div class="tbl-cell doc-date">Date</div>
                                    <div class="tbl-cell doc-total">Total</div>
                                    <div class="tbl-cell doc-status">Status</div>
                                    <div class="tbl-cell doc-sent">Sent</div>
                                    <div class="tbl-cell doc-signed">Signed</div>
                                </div>
                            </div>
                            <div class="tbl-body">
                                <div class="docs-message">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once 'dash-new-doc.php'; ?>
                <div id="errors"></div>
                <div id="dark-pop-up"></div>
            </div>
        </section>
    </div>
</div>
</body>
</html>
