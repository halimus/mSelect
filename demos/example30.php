<!DOCTYPE html>
<html>
<head>
    <title>mSelect | Example30</title>
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
                <h2><a href="index.php" title="Back"><i class="fa fa-arrow-circle-left"></i></a> Example 30: <span class="notice">(Open the Dev Console and check the Log)</span></h2>
            </div>
            <div class="col-md-12 info">
                <div class="alert alert-info">
                    <p>This example show you how to:</p>
                    <ul>
                        <li>Load the plugin</li>
                        <li>Form with linked mSelect's</li>
                    </ul>
                </div>
            </div> 
        </div>
        
        <div class="row form-group">
            <div class="col-md-12">
                <h3>Test Form</h3>
            </div>
        </div>
        
        <form method="post" action="ajax/example30.php?q=submit">
            <div class="row form-group">
                <div class="col-md-4">
                    <label>First Name</label>
                    <input name="first_name" id="first_name" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label>Regular Select</label>
                    <select name="regular_select" id="regular_select" class="form-control">
                        <option value=""></option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <label>Country</label><br>
                    <select id="country_id" class="mSelect" multiple="multiple"></select>
                </div>
                <div class="col-md-4">
                    <label>State</label><br>
                    <select id="state_id" class="mSelect" multiple="multiple"></select>
                </div>
                <div class="col-md-4">
                    <label>City</label><br>
                    <select id="city_id" class="mSelect" multiple="multiple"></select>
                </div>
            </div>

            <div class="row form-group" style="margin-top:50px">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
                    <button type="reset" id="reset_form" class="btn btn-danger">Reset</button>&nbsp;&nbsp; 
                    <button type="button" id="get_id" class="btn btn-default">getSelectedIds</button> 
                </div>
            </div>
        </form>
        
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
            
            var country_id, state_id, city_id; 
            
            $('#first_name').focus();
            
            //load the contry mSelect
            country_id = $('#country_id').mSelect({
                url: 'ajax/example30.php?q=countries',
                buttonWidth: '100%',
                selectType: 'single',
                onDropdownShow: function() {
                },
                onDropdownHide: function(selectedIds) {      
                },
                onChange : function(selectedIds) {
                    console.log('---country ids selected----');
                    console.log(selectedIds);
                    if(selectedIds.length > 0){
                        state_id.mSelect('refresh', {
                            data: {'country_id': selectedIds[0]},
                            disable: false
                        });
                    }
                    else{
                        state_id.mSelect('resable');
                        city_id.mSelect('resable');
                    }
                }
            });
            
            //load the states mSelect
            state_id = $('#state_id').mSelect({
                url: 'ajax/example30.php?q=states',
                buttonWidth: '100%',
                disable: true, 
                loadWhenOpen: true,
                onDropdownShow: function() {
                },
                onDropdownHide: function(selectedIds) {
                    console.log('---state ids selected----');
                    console.log(selectedIds);
                    if(selectedIds.length > 0){
                        city_id.mSelect('refresh', {
                            data: {'state_ids': selectedIds},
                            disable: false
                        });
                    }
                    else{
                        city_id.mSelect('disable');
                    }
                },
                onChange : function(selectedIds) {
                    console.log(selectedIds);
                }
            });
                   
            //load the cities mSelect
            city_id = $('#city_id').mSelect({
                url: 'ajax/example30.php?q=cities',
                buttonWidth: '100%',
                disable: true,
                loadWhenOpen: true,
                onDropdownShow: function() {
                },
                onDropdownHide: function(selectedIds) {
                    console.log('---city ids selected----');
                    console.log(selectedIds);
                },
                onChange : function(selectedIds) {
                }
            });
            
            /**
             * 
             */
            $(document).on("click", '#get_id', function(event) {
                console.log('------------selectedIds----------------');
                console.log('---- Country ids ----');
                console.log(country_id.getSelectedIds());
                console.log('---- State ids ----');
                console.log(state_id.getSelectedIds());
                console.log('---- City ids ----');
                console.log(city_id.getSelectedIds());
            });
            
            /**
             * 
             */
            $(document).on("click", '#reset_form', function(event) {
                country_id.mSelect('reset');
                state_id.mSelect('resable');
                city_id.mSelect('resable');
                $('#first_name').focus();
                alert('The form has been reset');
            });
            
            /**
             * submit the form
             */
            $(document).on("submit", 'form', function(event) {
                event.preventDefault();
                var ctr_id  = country_id.getSelectedIds();
                var sta_ids = state_id.getSelectedIds();
                var cty_ids = city_id.getSelectedIds();
                var form = $(this);
                $.ajax({
                    type: 'post',
                    url: form.attr("action"),
                    data: form.serialize() + '&'+ $.param({'country_id': ctr_id, 'state_ids': sta_ids, 'city_ids': cty_ids}),
                    dataType: 'JSON',
                    beforeSend: function () {
                    }
                })
                .done(function(response) {
                    
                })
                .always(function() {
                    
                });
            });

        });
    </script> 
</body>
</html>  


