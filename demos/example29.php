<!DOCTYPE html>
<html>
<head>
    <title>mSelect | Example29</title>
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
    <style>
        button.action_country, button.action_state, button.action_all{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row form-group">
            <div class="col-md-12">
                <h2><a href="index.php" title="Back"><i class="fa fa-arrow-circle-left"></i></a> Example 29: <span class="notice">(Open the Dev Console and check the Log)</span></h2>
            </div> 
            <div class="col-md-12 info">
                <div class="alert alert-info">
                    <p>This example show you how to:</p>
                    <ul>
                       <li>Load the plugin</li>
                       <li>Add multiple mSelect's on the same page</li>
                       <li>mSelect methods in action</li>
                    </ul>
                </div>
            </div> 
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <label>Country</label><br>
                <select id="country_id" class="mSelect" multiple="multiple"></select>
            </div>
            <div class="col-md-6">
                <label>State</label><br>
                <select id="state_id" class="mSelect" multiple="multiple"></select>
            </div>
        </div>    
               
        <div class="row form-group" style="margin-top:40px">
            <div class="col-md-6">
                <label>Methods for Country:</label><br>
                <button type="button" class="action_country" data-action="get_id">Get Selected Ids</button>&nbsp;
                <button type="button" class="action_country" data-action="labels">Get Selected Labels</button>&nbsp;
                <button type="button" class="action_country" data-action="unique-labels" style="margin-top:5px">Get Unique Selected Labels</button>&nbsp;
                <button type="button" class="action_country" data-action="set_color">Set Color</button>&nbsp;
                <button type="button" class="action_country" data-action="remove_color">Remove Color</button>&nbsp;
                <button type="button" class="action_country" data-action="enable">Enable</button>&nbsp;
                <button type="button" class="action_country" data-action="disable">Disable</button>&nbsp;
                <button type="button" class="action_country" data-action="show">Show</button>&nbsp;
                <button type="button" class="action_country" data-action="hide">Hide</button>&nbsp;
                <button type="button" class="action_country" data-action="set_id">Set Selected Ids</button>&nbsp;
                <button type="button" class="action_country" data-action="refresh">Refresh mSelect with new options</button>&nbsp;
                <button type="button" class="action_country" data-action="reset">Reset the mSelect</button>&nbsp;
            </div>
            <div class="col-md-6">
                <label>Methods for State:</label><br>
                <button type="button" class="action_state" data-action="get_id">Get Selected Ids</button>&nbsp;
                <button type="button" class="action_state" data-action="labels">Get Selected Labels</button>&nbsp;
                <button type="button" class="action_state" data-action="unique-labels" style="margin-top:5px">Get Unique Selected Labels</button>&nbsp;
                <button type="button" class="action_state" data-action="set_color">Set Color</button>&nbsp;
                <button type="button" class="action_state" data-action="remove_color">Remove Color</button>&nbsp;
                <button type="button" class="action_state" data-action="enable">Enable</button>&nbsp;
                <button type="button" class="action_state" data-action="disable">Disable</button>&nbsp;
                <button type="button" class="action_state" data-action="show">Show</button>&nbsp;
                <button type="button" class="action_state" data-action="hide">Hide</button>&nbsp;
                <button type="button" class="action_state" data-action="set_id">Set Selected Ids</button>&nbsp;
                <button type="button" class="action_state" data-action="refresh">Refresh mSelect with new options</button>&nbsp;
                <button type="button" class="action_state" data-action="reset">Reset the mSelect</button>&nbsp;
            </div>
        </div>
        
        <div class="row form-group" style="margin-top:20px">
            <div class="col-md-12">
                <label>Methods for Both:</label><br>
                <button type="button" class="action_all" data-action="get_id">Get Selected Ids</button>&nbsp;
                <button type="button" class="action_all" data-action="labels">Get Selected Labels</button>&nbsp;
                <button type="button" class="action_all" data-action="unique-labels" style="margin-top:5px">Get Unique Selected Labels</button>&nbsp;
                <button type="button" class="action_all" data-action="set_color">Set Color</button>&nbsp;
                <button type="button" class="action_all" data-action="remove_color">Remove Color</button>&nbsp;
                <button type="button" class="action_all" data-action="enable">Enable</button>&nbsp;
                <button type="button" class="action_all" data-action="disable">Disable</button>&nbsp;
                <button type="button" class="action_all" data-action="show">Show</button>&nbsp;
                <button type="button" class="action_all" data-action="hide">Hide</button>&nbsp;
                <button type="button" class="action_all" data-action="set_id">Set Selected Ids</button>&nbsp;
                <button type="button" class="action_all" data-action="refresh">Refresh mSelect with new options</button>&nbsp;
                <button type="button" class="action_all" data-action="reset">Reset the mSelect's</button>&nbsp;
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
            /**
             * load country mSelect
             */
            var country_id = $('#country_id').mSelect({
                url: 'ajax/example1.php',
                returnSelectedLabels: {     // Activate to return the selected labels
                    enable: true,
                    uniqueLabel: true 
                },
                onDropdownShow: function() {   
                    // do something here...
                },
                onDropdownHide: function(selectedIds, selectedLabels) {    
                    // do something here...
                },
                onChange: function(selectedIds, selectedLabels) {
                    // do something here...
                }
            });
            
            /**
             * load country mSelect
             */
            var state_id = $('#state_id').mSelect({
                url: 'ajax/example14.php',
                data: {'country_id': 231},
                returnSelectedLabels: {     // Activate to return the selected labels
                    enable: true,
                    uniqueLabel: true 
                },
                onDropdownShow: function() {   
                    // do something here...
                },
                onDropdownHide: function(selectedIds, selectedLabels) {    
                    // do something here...
                },
                onChange: function(selectedIds, selectedLabels) {
                    // do something here...
                }
            });
            
            /**
             * country methods
             */
            $(document).on("click", '.action_country', function(event) {
                var action = $(this).attr('data-action');
                if(action === 'get_id'){
                    console.log("----Country Selected Ids----");
                    var ids = country_id.getSelectedIds();
                    console.log(ids);
                }
                else if(action === 'labels'){
                    console.log("----Country Selected Labels----");
                    var labels = country_id.getSelectedLabels();
                    console.log(labels);
                }
                else if(action === 'unique-labels'){
                    console.log("----Country Unique Selected Labels----");
                    var labels = country_id.getUniqueSelectedLabels();
                    console.log(labels);    
                }
                else if(action === 'set_color'){
                    console.log("----set Color Country----");
                    country_id.setCSS('background:#ffeb54;border:1px solid #666;');
                }
                else if(action === 'remove_color'){
                    console.log("----set Color Country----");
                    country_id.setCSS(null);
                }
                else if(action === 'enable'){
                    console.log("----enable Country----");
                    country_id.mSelect('enable');  // enable the mSelect
                }
                else if(action === 'disable'){
                    console.log("----disable Country----");
                    country_id.mSelect('disable');  // disable the mSelect
                }
                else if(action === 'show'){
                    console.log("----show Country----");
                    country_id.mSelect('show');  // show the mSelect
                }
                else if(action === 'hide'){
                    console.log("----hide Country----");
                    country_id.mSelect('hide'); // hide the mSelect
                }
                else if(action === 'set_id'){
                    console.log("----set Country SelectedIds----");
                    console.log("auto select the ids 3,7,8");
                    country_id.setSelectedIds(["3", "7", "8"]); // auto select the ids 3,7,8 
                }
                else if(action === 'refresh'){
                    console.log("----refresh Country with new options----");
                    country_id.mSelect('refresh', {
                        disable: false,
                        selectedIds: ["8", "10"],
                        cssNotEmpty: 'background:#d6ffd1;color: red',
                        btnRefresh: true
                    });
                }
                else if(action === 'reset'){
                    console.log("----reset Country----");
                    country_id.mSelect('reset');  // reset the mSelect
                }
            }); 
            
            /**
             * state methods
             */
            $(document).on("click", '.action_state', function(event) {
                var action = $(this).attr('data-action');
                if(action === 'get_id'){
                    console.log("----State Selected Ids----");
                    var ids = state_id.getSelectedIds();
                    console.log(ids);
                }
                else if(action === 'labels'){
                    console.log("----State Selected Labels----");
                    var labels = state_id.getSelectedLabels();
                    console.log(labels);
                }
                else if(action === 'unique-labels'){
                    console.log("----State Unique Selected Labels----");
                    var labels = state_id.getUniqueSelectedLabels();
                    console.log(labels);    
                }
                else if(action === 'set_color'){
                    console.log("----set Color State----");
                    state_id.setCSS('background:yellow;border:1px solid blue;');
                }
                else if(action === 'remove_color'){
                    console.log("----set Color State----");
                    state_id.setCSS(null);
                }
                else if(action === 'enable'){
                    console.log("----enable State----");
                    state_id.mSelect('enable');  // enable the mSelect
                }
                else if(action === 'disable'){
                    console.log("----disable State----");
                    state_id.mSelect('disable');  // disable the mSelect
                }
                else if(action === 'show'){
                    console.log("----show State----");
                    state_id.mSelect('show');  // show the mSelect
                }
                else if(action === 'hide'){
                    console.log("----hide State----");
                    state_id.mSelect('hide'); // hide the mSelect
                }
                else if(action === 'set_id'){
                    console.log("----set Country SelectedIds----");
                    state_id.setSelectedIds(null); // equivalent to mSelect('reset')
                }
                else if(action === 'refresh'){
                    console.log("----refresh State with new options----");
                    state_id.mSelect('refresh', {
                        data: {'country_id': 231},
                        selectedIds: ["3920"],
                        lengthMenu: [5, 7, 30]
                    });
                }
                else if(action === 'reset'){
                    console.log("----reset State----");
                    state_id.mSelect('reset');  // reset the mSelect
                }
            }); 
            
            /**
             * country & state methods
             */
            $(document).on("click", '.action_all', function(event) {
                var action = $(this).attr('data-action');
                if(action === 'id'){
                    console.log("----Country Selected Ids----");
                    var ids = country_id.getSelectedIds();
                    console.log(ids);
                    console.log("----State Selected Ids----");
                    ids = state_id.getSelectedIds();
                    console.log(ids);
                }
                else if(action === 'labels'){
                    console.log("----Country Selected Labels----");
                    var labels = country_id.getSelectedLabels();
                    console.log(labels);
                    console.log("----State Selected Labels----");
                    labels = state_id.getSelectedLabels();
                    console.log(labels);
                }
                else if(action === 'unique-labels'){
                    console.log("----Country Unique Selected Labels----");
                    var labels = country_id.getUniqueSelectedLabels();
                    console.log(labels); 
                    console.log("----State Unique Selected Labels----");
                    labels = state_id.getUniqueSelectedLabels();
                    console.log(labels); 
                }
                else if(action === 'set_color'){
                    console.log("----set Color Country----");
                    country_id.setCSS('background:#ffeb54;border:1px solid #666;');
                    console.log("----set Color State----");
                    state_id.setCSS('background:yellow;border:1px solid blue;');
                }
                else if(action === 'remove_color'){
                    console.log("----set Color Country----");
                    country_id.setCSS(null);
                    console.log("----set Color State----");
                    state_id.setCSS(null);
                }
                else if(action === 'enable'){
                    console.log("----enable Country----");
                    country_id.mSelect('enable');  // enable the mSelect
                    console.log("----enable State----");
                    state_id.mSelect('enable');  // enable the mSelect
                }
                else if(action === 'disable'){
                    console.log("----disable Country----");
                    country_id.mSelect('disable');  // disable the mSelect
                    console.log("----disable State----");
                    state_id.mSelect('disable');  // disable the mSelect 
                }
                else if(action === 'show'){
                    console.log("----show Country----");
                    country_id.mSelect('show');  // show the mSelect
                    console.log("----show State----");
                    state_id.mSelect('show');  // show the mSelect
                }
                else if(action === 'hide'){
                    console.log("----hide Country----");
                    country_id.mSelect('hide'); // hide the mSelect
                    console.log("----hide State----");
                    state_id.mSelect('hide'); // hide the mSelect
                }
                else if(action === 'set_id'){
                    country_id.setSelectedIds(["8", "10"]); 
                    state_id.setSelectedIds(["3920"]); 
                }
                else if(action === 'refresh'){
                    country_id.mSelect('refresh', {
                        selectedIds: ["3920"],
                        lengthMenu: [5, 7, 30]
                    });
                    state_id.mSelect('refresh', {
                        data: {'country_id': 231},
                        selectedIds: ["3920"]
                    });
                }
                else if(action === 'reset'){
                    console.log("----reset Country----");
                    country_id.mSelect('reset');  // reset the mSelect
                    console.log("----reset State----");
                    state_id.mSelect('reset');  // reset the mSelect
                }
            }); 
            
        }); 
    </script> 
</body>
</html>  
