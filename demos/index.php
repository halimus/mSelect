<!DOCTYPE html>
<html>
<head>
    <title>mSelect | Demos</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet"> 
    <link href="public/css/style.css" rel="stylesheet">
    <style>
        body {
            background:url("public/images/bggreen.jpg") repeat-x scroll 0 0 transparent;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 welcome">
                <a href="https://mselect.info"><img src="public/images/large-logo.png" title="mSelect Logo"></a>
                <h1>Welcome to mSelect Plugin Demos</h1>
                <h2>The Most Advanced Dropdown ever made that Support Big Datasets</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12" id="examples">
                <h3>Examples:</h3>
                <div id="examples-content">   
                    <h4 style="color: green">Configuration:</h4>
                    <ol class="list-examples">
                        <li><a href="example01.php">Example 01: Load the Plugin</a></li>
                        <li><a href="example02.php">Example 02: Custom the Name of the columns</a></li>
                        <li><a href="example03.php">Example 03: Add a Refresh button</a></li>
                        <li><a href="example04.php">Example 04: Add a Button that show you the selected rows</a></li>
                        <li><a href="example05.php">Example 05: Custom the Selected button in the Example 4</a></li>
                        <li><a href="example06.php">Example 06: Custom the ajax variable name for Examples 4 & 5</a></li>
                        <li><a href="example07.php">Example 07: Select some rows by default when page load</a></li>
                        <li><a href="example08.php">Example 08: Custom the color for the mSelect if already has a selected rows</a></li>
                        <li><a href="example09.php">Example 09: Custom the mSelect Button width and the "Non Selected Text" Label</a></li>
                        <li><a href="example10.php">Example 10: Allow only Single select for the rows</a></li>
                        <li><a href="example11.php">Example 11: More than 1 columns for the mSelect</a></li>
                        <li><a href="example12.php">Example 12: Multiple mSelect's on the same page</a></li>
                        <li><a href="example13.php">Example 13: Load the mSelect data only when open it</a></li>
                        <li><a href="example14.php">Example 14: Pass some extra data to the server side</a></li>
                        <li><a href="example15.php">Example 15: Custom the lengthMenu and the column order for the mSelect</a></li>
                        <li><a href="example16.php">Example 16: Disable the mSelect if empty data</a></li>
                        <li><a href="example17.php">Example 17: Load mSelect using an other supported Language</a></li>
                    </ol>

                    <h4 style="color: magenta">Events:</h4>
                    <ol class="list-examples" start="18">
                        <li><a href="example18.php">Example 18: Do something when you open the mSelect</a></li>
                        <li><a href="example19.php">Example 19: Do something when you close the mSelect</a></li>
                        <li><a href="example20.php">Example 20: Do something when you onChange the mSelect</a></li>
                        
                        <li><a href="example21.php">Example 21: Return the Selected ids when close the mSelect</a></li>
                        <li><a href="example22.php">Example 22: Return the Selected ids when onChange the mSelect</a></li>
                        <li><a href="example23.php">Example 23: Return the Selected ids and the Selected labels when close the mSelect</a></li>
                        <li><a href="example24.php">Example 24: Return the Selected ids and the Selected labels and the Unique labels when close the mSelect</a></li>
                        <li><a href="example25.php">Example 25: Return the Selected ids / labels / unique labels when close & onChange the mSelect</a></li>
                        <li><a href="example26.php">Example 26: Return the Selected ids / labels for multiple mSelect's on the same page</a></li>
                    </ol>
                    
                    <h4 style="color: purple">Methods:</h4>
                    <ol class="list-examples" start="27">
                        <li><a href="example27.php">Example 27: mSelect methods in action</a></li>
                        <li><a href="example28.php">Example 28: mSelect methods in action 2</a></li>
                        <li><a href="example29.php">Example 29: Form with linked mSelect's</a></li>
                    </ol>
   
                </div>
            </div>
        </div>
        <div class="row" id="footer">
            <div class="col-md-12">
                <hr>
                <p>&copy;<?php echo date('Y');?> <a href="https://halimlardjane.com">Halim Lardjane</a>. All rights reserved</p>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>    
</body>
</html>  


