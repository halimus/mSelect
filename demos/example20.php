<!DOCTYPE html>
<html>
<head>
    <title>mSelect | Example20</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="https://cdn.datatables.net/v/bs/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/plug-ins/1.10.12/features/searchHighlight/dataTables.searchHighlight.css" rel="stylesheet">
    <link href="public/plugins/datatables/checkboxes/1.2.11/dataTables.checkboxes.css" rel="stylesheet">
    <!-- mSelect -->
    <link href="../dist/2.0.0/jquery.mSelect.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row form-group">
            <div class="col-md-12">
                <h2><a href="index.php" title="Back"><i class="fa fa-arrow-circle-left"></i></a> Example 20:</h2>
            </div> 
            <div class="col-md-12 info">
                <div class="alert alert-info">
                    <p>This example show you how to:</p>
                    <ul>
                       <li>Load the plugin</li>
                       <li>Do something when you onChange the mSelect: onChange</li>
                    </ul>
                </div>
            </div> 
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <label>Country</label><br>
                <select id="country_id" class="mSelect" multiple="multiple"></select>
            </div>
        </div>
        
    </div>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/v/bs/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/features/searchHighlight/dataTables.searchHighlight.min.js"></script>
    <script src="public/plugins/datatables/checkboxes/1.2.11/dataTables.checkboxes.min.js"></script>
    <!-- mSelect -->
    <script src="../dist/2.0.0/jquery.mSelect.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(function () {
            $('#country_id').mSelect({
                url: 'ajax/example1.php',
                onDropdownShow: function(uid) { 
                    console.log('uid='+uid);
                },
                onChange: function(selectedIds, selectedLabels, uniqueSelectedLabels, uid) {
                    console.log("onChange mSelect");  
                    alert("onChange mSelect");   
                    console.log('uid='+uid);
                }
            });
        }); 
    </script> 
</body>
</html>  





