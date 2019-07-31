/* 
 * mSelect 2.0.0 for Bootstrap v3 - https://github.com/halimus/mSelect
 * Created on: Apr 13, 2019, 3:41:05 PM
 * Author: Halim Lardjane
 * 
 */
(function($){
    "use strict";
    
    var url_plugin = 'https://github.com/halimus/mSelect';
    
    var lang = {
        en: {none_selected: "None selected", selected: "selected", show_selected: "Show selected", show_all: "Show all", refresh: "Refresh"},
        fr: {none_selected: "Aucune sélection", selected: "sélectionnées", show_selected: "Voir sélectionnées", show_all: "Voir tout", refresh: "Rafraîchir"},
        es: {none_selected: "Ninguna seleccionada", selected: "seleccionadas", show_selected: "Mostrar seleccionado", show_all: "Mostrar todo", refresh: "Refrescar"},
        pt: {none_selected: "Nenhum selecionado", selected: "selecionadas", show_selected: "Mostrar selecionado", show_all: "Mostre tudo", refresh: "Atualizar"},
        ru: {none_selected: "Не выбрано", selected: "выбран", show_selected: "Показать выбранное", show_all: "Показать все", refresh: "обновление"},
        zh: {none_selected: "未选择", selected: "选中", show_selected: "显示已选中", show_all: "显示所有", refresh: "刷新"},
        ja: {none_selected: "何も選択されていません", selected: "つ選択", show_selected: "選択を表示", show_all: "すべて表示する", refresh: "更新する"},
    };

    var btnSelected = {
        icon1: 'fa fa-eye',
        icon2: 'fa fa-eye-slash',
        color_icon1: '#666',
        color_icon2: '#666'
    };
    
    var returnSelectedLabels = {
        indexLabel: 1,
        uniqueLabel: false
    };
    
    $.fn.mSelect = function(options) {
        var defaults = {
            plugin_id: uniqueNumber(),
            table_id: null,                 // The id for the datatabale (optional) null by default, an unique id will be generated automaticaly
            columns: ['Name'],              // The label of the columns, (optional: if you have only a Name column)
            url: null,                      // The ajax url
            data: {},                       // The data to pass via ajax
            ajax_var_name: 'ids',           // The name of the variable that we pass via ajax url for the selected rows
            selectedIds: [],                // The selected ids to select / return
            returnSelectedLabels:{          // You may need to return the selected labels as well
                enable: false,
                indexLabel: 1,              // The index of the label to return, usually the Name (column 1)
                uniqueLabel: false          // If true the uniqueSelectedLabels will be returned
            },
            fullSelectedLabels: [],         // The selected labels to return
            uniqueSelectedLabels: [],       // The unique selected labels to return
            loadWhenOpen: false,            // If true: the mSelect will be populated only when we open it
            disableIfEmpty: false,          // Disable the mSelect if no data
            disable: false,                 // Disable the mSelect
            minWidth: 350,                  // The min Width for mSelect dropdown container
            buttonWidth: null,              // The buttonWidth for the multislect (possible values: null, 100%)
            cssNotEmpty: null,              // Apply a style for the mSelect Button when there is selected data
            nonSelectedText: null,          // The label for the dropdown, by default is: "None selected" if "en" is selected 
            selectType: 'multi',            // Multi select or Single Select (possible values: multi, single)
            btnRefresh: false,              // Show or not the Refresh button  
            btnSelected:{                   // Show or not the Selected button
                enable: false,            
                icon1: 'fa fa-eye',         // The icon class for show selected button
                icon2: 'fa fa-eye-slash',   // The icon class for show all button  
                color_icon1: '#666',        // The color for show selected button
                color_icon2: '#666'         // The color for show selected button
            },
            lengthMenu: [10, 20, 50],       // Datatable lenght page
            order: [[1, 'asc']],            // Datatable order column
            lang: 'en',                     // Language of the plugin: en, fr, es, pt, ru, zh, ja   
            onDropdownShow: function (uid) {},
            onDropdownHide: function (selectedIds, selectedLabels, uniqueSelectedLabels, uid) {},
            onChange: function (selectedIds, selectedLabels, uniqueSelectedLabels, uid) {} 
        };
        
        var settings = $.extend({}, defaults, options);
        
        // Global Private Variables
        var plugin = this;
        var current_lang =  lang[settings.lang];
        settings.table_id = settings.table_id === null ? 'dt_'+settings.plugin_id : settings.table_id;
        var datatable;
        var showSelected = false;
        var datatableLoaded = false;
        
        /**---------------------------------------------------------------------
           Check the requirement for the plugin
        ----------------------------------------------------------------------*/ 
        
        plugin.check_requirements = function(){
            if(typeof($.fn.modal) === 'undefined'){
                alert('Bootstrap must be loaded before mSelect.\nCheck the mSelect requirements\n'+url_plugin);
                return false;
            }
            if(!$.fn.DataTable) {
                alert('DataTable must be loaded before mSelect.\nCheck the mSelect requirements\n'+url_plugin);
                return false;
            }
            if(!$.fn.DataTable.Checkboxes) {
                alert('DataTable Checkboxes must be loaded before mSelect.\nCheck the mSelect requirements\n'+url_plugin);
                return false;
            }
            if(!$.fn.multiselect) {
                alert('Bootstrap multiselect must be loaded before mSelect.\nCheck the mSelect requirements\n'+url_plugin);
                return false;
            }
            return true;
        };
        
        /**---------------------------------------------------------------------
         Initialize the plugin
        ----------------------------------------------------------------------*/ 
        
        plugin.initialize = function(){
            
            if(settings.selectType == 'single'){ // remove all element from selectedIds except the first one
                if(settings.selectedIds.length > 1){
                    settings.selectedIds.splice(1);
                }
            }
            
            if(settings.nonSelectedText == null){    
                settings.nonSelectedText = current_lang.none_selected;
            }
            
            plugin.multiselect({
                nonSelectedText: settings.selectedIds.length == 0 ? settings.nonSelectedText : settings.selectedIds.length+' '+current_lang.selected,
                buttonWidth: settings.buttonWidth
            });
            
            if(settings.btnSelected.enable === true){
                settings.btnSelected.icon1 = typeof settings.btnSelected.icon1 === 'undefined' ? btnSelected.icon1 : settings.btnSelected.icon1;
                settings.btnSelected.icon2 = typeof settings.btnSelected.icon2 === 'undefined' ? btnSelected.icon2 : settings.btnSelected.icon2;
                settings.btnSelected.color_icon1 = typeof settings.btnSelected.color_icon1 === 'undefined' ? btnSelected.color_icon1 : settings.btnSelected.color_icon1;
                settings.btnSelected.color_icon2 = typeof settings.btnSelected.color_icon2 === 'undefined' ? btnSelected.color_icon2 : settings.btnSelected.color_icon2;
            }
            
            if(settings.returnSelectedLabels.enable === true){
                settings.returnSelectedLabels.indexLabel  = typeof settings.returnSelectedLabels.indexLabel  === 'undefined' ? returnSelectedLabels.indexLabel : settings.returnSelectedLabels.indexLabel;
                settings.returnSelectedLabels.uniqueLabel = typeof settings.returnSelectedLabels.uniqueLabel === 'undefined' ? returnSelectedLabels.uniqueLabel : settings.returnSelectedLabels.uniqueLabel;
                settings.returnSelectedLabels.witoutIndex = typeof settings.returnSelectedLabels.witoutIndex === 'undefined' ? returnSelectedLabels.witoutIndex : settings.returnSelectedLabels.witoutIndex;
                if(settings.returnSelectedLabels.indexLabel > settings.columns.length){
                    alert('mSelect: The indexLabel '+settings.returnSelectedLabels.indexLabel+' must be inside the columns.\n');
                    return false;
                }
            }

            // convert value of selectedIds to string if they are not
            settings.selectedIds = convert_ids_toString(settings.selectedIds);
            
            if(settings.selectedIds.length > 0){
                settings.loadWhenOpen = false;
            }
            
            var html = '';
            html+='<div class="mSelect-content" id="mSelect-content_'+settings.plugin_id+'" data-id="'+settings.plugin_id+'" style="min-width:'+settings.minWidth+'px">';
            html+='<table id="'+settings.table_id+'" class="table table-bordered display" width="100%"><thead><tr>';
            html+='<th><input name="select_all" value="1" type="checkbox"></th>';
            $.each(settings.columns, function(key, value){
                html+='<th>'+value+'</th>';
            });
            html+= '</tr></thead>';
            html+='</table></div>';  
            $(html).insertAfter(plugin.closest('span'));
            
            // setup some id for the mSelect dom 
            $(this).closest('span').attr('id', 'mSelect_'+settings.plugin_id); //add an id to the parent span
            $(this).attr('data-id', settings.plugin_id);                       //add data-id to mSelect
            var button = $(this).next('div:first').children('button');
            $(button).attr('id', 'btn_'+settings.plugin_id);                   //add an id to the multiselect button 
            
            // check if we need to force disable the mSelect
            if(settings.disable == true){
                plugin.multiselect('disable');
            }
            
            return true;
        };
        
        if(!plugin.check_requirements()){
            return false;
        }
        
        plugin.initialize();
        
        /**---------------------------------------------------------------------
          Open / Close the mSelect Dropdown
        ----------------------------------------------------------------------*/ 

        $(document).on("click", '#mSelect_'+settings.plugin_id+' div.btn-group button.multiselect', function(e) {     
            var target_id = settings.plugin_id;
            var open_id = $(".mSelect-content").not(":hidden").attr("data-id");
            if ((open_id != undefined && open_id != null) && (open_id != target_id)) {
                $(document).trigger("click");
                $('#mSelect_'+target_id+' div.btn-group button.multiselect').trigger("click");
                return false;
            }
            $('.mSelect-content').hide();
            var mSelect = $(this).closest('span').next('div:first');
            var expanded = $(this).attr('aria-expanded');
            expanded = expanded == null ? false : JSON.parse(expanded);          
            if(expanded === false){
                mSelect.hide();
                getUniqueSelectedLabels();
                settings.onDropdownHide.call(this, settings.selectedIds, settings.fullSelectedLabels, settings.uniqueSelectedLabels, settings.plugin_id);
            }
            else{
                if(settings.loadWhenOpen === true && datatableLoaded === false){
                    load_datatable();
                    datatableLoaded = true;
                }
                mSelect.show();
                settings.onDropdownShow.call(this, settings.plugin_id);
            }
        });
        
        /**---------------------------------------------------------------------
         Keep the mSelect Panel open if we are inside / othserwise close it 
        ----------------------------------------------------------------------*/

        $(document).click(function(e) {
            var elem = $(e.target);
            if(elem.parents('.mSelect-content').length > 0 || elem.attr('class') === 'mSelect-content') {    
                var mSelect = elem;
                if(elem.parents('.mSelect-content').length > 0){
                    mSelect = elem.parents('.mSelect-content');
                }
                var span = mSelect.prev('span').first();
                var btn_group = span.find('div');
                var btn = span.find('button');
                $(btn).attr('aria-expanded', 'true'); 
                $(btn_group).attr('class', 'btn-group open');
            }
            else{
                var id = $(".mSelect-content").not(":hidden").attr("data-id");
                if(settings.plugin_id == id){
                    $(".mSelect-content").not(":hidden").hide();
                    getUniqueSelectedLabels();
                    settings.onDropdownHide.call(this, settings.selectedIds, settings.fullSelectedLabels, settings.uniqueSelectedLabels, settings.plugin_id);
                }
            }
        });
        
        /**---------------------------------------------------------------------
         Single row click 
        ----------------------------------------------------------------------*/

        $(document).on("click", '#mSelect-content_'+settings.plugin_id+' tbody tr', function(e) {  
            var data = $('#'+settings.table_id).DataTable().row(this).data();
            var id = data[0];
            var label = data[settings.returnSelectedLabels.indexLabel];
            if($(this).hasClass('selected')){
                if($.inArray(id, settings.selectedIds) === -1){
                    if(settings.selectType == 'single'){ // if single select we need to empty the selectedIds
                        settings.selectedIds = [];
                        settings.fullSelectedLabels = []; 
                        settings.uniqueSelectedLabels = [];
                    }
                    settings.selectedIds.push(id); 
                    // push the label if needed
                    if(settings.returnSelectedLabels.enable === true){
                        //settings.selectedLabels.push({[id] : label}); // not work on IE 11
                        settings.fullSelectedLabels.push({id : id, label: label});
                    }
                }
            }
            else{
                var index = $.inArray(id, settings.selectedIds);
                if(index !== -1){
                    settings.selectedIds.splice(index, 1);
                    // remove the label if needed
                    if(settings.returnSelectedLabels.enable === true){
                        settings.fullSelectedLabels.splice(index, 1);
                    }
                }
            }
            update_mselect_count(e);
        }); 
        
        /**---------------------------------------------------------------------
         Select all
        ----------------------------------------------------------------------*/
        
        $(document).on("change", '#mSelect-content_'+settings.plugin_id+' th:first-child input[type="checkbox"]', function(e) {  
            if(settings.selectType == 'single'){ // if single select => do nothing
                $(this).prop('checked', !$(this).prop('checked'));
                return false;
            }
            var currentIds = [];
            var currentLabels = [];
            var rows = $('#'+settings.table_id).DataTable().rows().data();
            rows.each(function(value, index) {
                currentIds.push(value[0]);
                // push the label if needed
                if(settings.returnSelectedLabels.enable === true){
                    currentLabels.push(value[settings.returnSelectedLabels.indexLabel]);
                }
            });
            if($(this).is(':checked')){
                $.each(currentIds , function(key, id) { 
                    var index = $.inArray(id, settings.selectedIds);
                    if(index === -1){
                        settings.selectedIds.push(id);
                        if(settings.returnSelectedLabels.enable === true){
                            var label = currentLabels[key];
                            settings.fullSelectedLabels.push({id : id, label: label});
                        }
                    }
                });
            }
            else{
                $.each(currentIds , function(key, value) { 
                    var index = $.inArray(value, settings.selectedIds);
                    if(index !== -1){
                        settings.selectedIds.splice(index, 1);
                        if(settings.returnSelectedLabels.enable === true){
                            settings.fullSelectedLabels.splice(index, 1);
                        }
                    }
                });
            }
            update_mselect_count(e);
        }); 
        
        /**---------------------------------------------------------------------
         Update the Label count for the Dropdown
        ----------------------------------------------------------------------*/
        /**
         * 
         */
        function update_mselect_count(e){
            var mSelect_content = $(e.target).parents('.mSelect-content');
            update_mselect_button(mSelect_content);
            // callback function
            if($.isFunction(settings.onChange)) {
                getUniqueSelectedLabels();
                settings.onChange.call(this, settings.selectedIds, settings.fullSelectedLabels, settings.uniqueSelectedLabels, settings.plugin_id);
            }
        }
        
        /**
         * 
         */
        function update_mselect_button(mSelect_content){
            var span = mSelect_content.prev('span').first();
            var button = span.find('button');
            var span = span.find('span.multiselect-selected-text');
            var count = settings.selectedIds.length;
            if(count > 0){
                button.attr('title', count+' '+current_lang.selected);
                span.html(count+' '+current_lang.selected);
                style_mselect_button();
            }
            else{
                button.attr('title', current_lang.none_selected);
                span.html(current_lang.none_selected);
                $(button).removeAttr('style');
                if(settings.buttonWidth != null){
                    $(button).attr('style',  'width:'+settings.buttonWidth);
                }
            }
        }
        
        /**
         * 
         * @returns {Boolean}
         */
        function style_mselect_button(){
            var style = '';
            if(settings.cssNotEmpty != null){
                style = settings.cssNotEmpty+';';
            }
            if(settings.buttonWidth != null){
                style+= 'width:'+settings.buttonWidth;
            }
            if(style !=''){
                $('#btn_'+settings.plugin_id).attr('style', style);
            }
            return true;
        }
        
        /**---------------------------------------------------------------------
          Datatable
        ----------------------------------------------------------------------*/ 
        
        if(settings.loadWhenOpen === false){
            load_datatable();
            datatableLoaded = true;
        }

        function load_datatable(){
            datatable = $('#'+settings.table_id).DataTable({
                "pageLength": settings.lengthMenu[0],
                "lengthMenu": settings.lengthMenu,
                "pagingType": "full",
                "rowCallback": function (row, data, index) {
                    var rowId = data[0];
                    var styled = false;
                    if($.inArray(rowId, settings.selectedIds) !== -1){
                        $('#'+settings.table_id).DataTable().rows(index).select();
                        if(settings.cssNotEmpty != null && styled === false){
                            styled = style_mselect_button();
                        }
                    }
                },
                "language": datatable_language(),
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "searchHighlight": true,
                "autoWidth": false,
                "paging": true,
                "order": settings.order,
                "ajax": {
                    type: 'GET',
                    url: settings.url, 
                    dataType: 'JSON',
                    data: settings.data
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "searchable": false,
                        "orderable": false,
                        "width": "20px",
                        "className": "dt-center",
                        "checkboxes": {
                            "selectRow": true
                        },
                    }
                ],
                "select": {
                    "style": settings.selectType,
                    "blurable": false
                },
                //"dom": '<"top"lBf>rt<"bottom"ip><"clear">',
                "dom": 'lBfrtip',
                "buttons": [],
                "drawCallback": function(oSettings) {
                    var count = this.fnSettings().fnRecordsTotal();
                    if(settings.disableIfEmpty === true && count == 0){
                        plugin.multiselect('disable');
                    }
                }
            });
            
            datatableLoaded = true;
            $('#mSelect-content_'+settings.plugin_id+' .dataTables_wrapper').addClass('mSelect_wrapper');
            
            /**-----------------------------------------------------------------
            Datatables options
            ------------------------------------------------------------------*/ 
            if(settings.selectType === 'single'){
                $('#mSelect-content_'+settings.plugin_id+' .dt-checkboxes-cell').html('');
            }

            var pos = 0;
            
            if(settings.btnRefresh === true){ 
                $('#'+settings.table_id).DataTable().button().add(pos, {
                    text: '<i class="fa fa-refresh"></i>', titleAttr: current_lang.refresh, enabled: true, className: 'btnx',
                    action: function(e, dt, node, config){
                        datatable.ajax.reload();
                    }
               });
               pos++;
            }
        
            if(settings.btnSelected.enable === true){ 
                datatable.button().add(pos, {
                    text: '<i class="'+settings.btnSelected.icon1+'" style="color:'+settings.btnSelected.color_icon1+'"></i>', titleAttr: current_lang.show_selected, enabled: true, className: 'btn-default btnx btn-selected', 
                    action: function(e, dt, node, config){
                        if(showSelected === true){
                            showSelected = false;
                            $('.btn-selected i').attr('class', settings.btnSelected.icon1);
                            $('.btn-selected').attr('title', current_lang.show_selected);
                            $('.btn-selected i').attr('style', 'color:'+settings.btnSelected.color_icon1);
                            datatable.ajax.url(settings.url).load();
                        }
                        else{
                            showSelected = true;
                            $('.btn-selected i').attr('class', settings.btnSelected.icon2);
                            $('.btn-selected').attr('title', current_lang.show_all);
                            $('.btn-selected i').attr('style', 'color:'+settings.btnSelected.color_icon2);
                            var ids = settings.ajax_var_name;
                            var url = (settings.url.indexOf('?') > -1) ? settings.url+"&"+ids+"="+settings.selectedIds : settings.url+"?"+ids+"="+settings.selectedIds;
                            datatable.ajax.url(url).load();
                        }
                    }
                });
            }
        }
        
        /**---------------------------------------------------------------------
          Private methods
        ----------------------------------------------------------------------*/ 
        /**
         * Generate Unique Number
         * @returns {Number}
         */
        function uniqueNumber() {
            var date = Date.now();
            if (date <= uniqueNumber.previous) {
                date = ++uniqueNumber.previous;
            } 
            else {
                uniqueNumber.previous = date;
            }
            return date;
        }
        
        /**
         * convert value of ids of arrays to string
         */
        function convert_ids_toString(ids) {
            var arr = [];
            if(ids != null && ids !=''){
                ids.forEach(function(value){
                    arr.push(value.toString());
                });
            }
            return arr;
        }

        /**
         *
         */
        function getUniqueSelectedLabels() {
            var arr = [];
            if(settings.returnSelectedLabels.uniqueLabel === true){
                $.each(settings.fullSelectedLabels , function(key, value) { 
                    var index = $.inArray(value.label, arr);
                    if(index === -1){
                        arr.push(value.label);
                    }
                });
            }
            settings.uniqueSelectedLabels = arr;
        }
        
        /**
         * 
         */
        function reload_mSelect() {
            if(settings.selectType == 'single'){ // remove all element from selectedIds except the first one
                if(settings.selectedIds.length > 1){
                    settings.selectedIds.splice(1);
                }
            }
            load_datatable();
            var mSelect_content = $('#mSelect-content_'+settings.plugin_id);
            update_mselect_button(mSelect_content);
            if(settings.disable == false){
                plugin.multiselect('enable');
            }
            else{
                plugin.multiselect('disable');
            }
        }
        
        /**
         * 
         */
        function reset_mSelect() {
            settings.selectedIds = [];
            settings.fullSelectedLabels = [];
            settings.uniqueSelectedLabels = [];
            plugin.multiselect('refresh');
            if(datatableLoaded === true){
                datatable.rows().deselect();
            }
            var mSelect_content = $('#mSelect-content_'+settings.plugin_id);
            update_mselect_button(mSelect_content);
        }
        
        /**
         * 
         */
        function datatable_language() {
            var en = {
                "search": "",
                "searchPlaceholder": "Search",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_START_ to _END_ of _TOTAL_ records",
                "zeroRecords": "No matching records found",
                "infoEmpty": "No records available",
                "infoFiltered": "(from _MAX_ records)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="First"></i>',
                    "previous": '<i class="fa fa-angle-left" title="Previous"></i>',
                    "next": '<i class="fa fa-angle-right" title="Next"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="Last"></i>'
                }
            };

            var fr = {
                "search": "",
                "searchPlaceholder": "Rechercher",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_START_ à _END_ sur _TOTAL_ éléments",
                "zeroRecords": "Aucun élément à afficher",
                "infoEmpty": "Aucun enregistrement disponible",
                "infoFiltered": "(à partir de _MAX_ éléments)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="Premier"></i>',
                    "previous": '<i class="fa fa-angle-left" title="Précédent"></i>',
                    "next": '<i class="fa fa-angle-right" title="Suivant"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="Dernier"></i>'
                }
            };
            
            var es = {
                "search": "",
                "searchPlaceholder": "Buscar",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_START_ a _END_ de _TOTAL_ registros",
                "zeroRecords": "No se encontraron resultados",
                "infoEmpty": "Ningún dato disponible en esta tabla",
                "infoFiltered": "(de _MAX_ registros)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="Primero"></i>',
                    "previous": '<i class="fa fa-angle-left" title="Anterior"></i>',
                    "next": '<i class="fa fa-angle-right" title="Siguiente"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="Último"></i>'
                }
            };
            
            var pt = {
                "search": "",
                "searchPlaceholder": "Primeiro",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_START_ a _END_ de _TOTAL_ registros",
                "zeroRecords": "Não foram encontrados resultados",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(de _MAX_ registros)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="Primeiro"></i>',
                    "previous": '<i class="fa fa-angle-left" title="Anterior"></i>',
                    "next": '<i class="fa fa-angle-right" title="Seguinte"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="Último"></i>'
                }
            };
            
            var ru = {
                "search": "",
                "searchPlaceholder": "Поиск",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_START_ до _END_ из _TOTAL_ записей",
                "zeroRecords": "Записи отсутствуют",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(из _MAX_ записей)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="Первая"></i>',
                    "previous": '<i class="fa fa-angle-left" title="Предыдущая"></i>',
                    "next": '<i class="fa fa-angle-right" title="Следующая"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="Последняя"></i>'
                }
            };
            
            var zh = {
                "search": "",
                "searchPlaceholder": "搜索",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "zeroRecords": "没有匹配结果",
                "infoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "infoFiltered": "(来自 _MAX_ 条记录)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="首页"></i>',
                    "previous": '<i class="fa fa-angle-left" title="上页"></i>',
                    "next": '<i class="fa fa-angle-right" title="下页"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="末页"></i>'
                }
            };
            
            var ja = {
                "search": "",
                "searchPlaceholder": "検索",
                "processing": '<i class="fa fa-spinner fa-spin fa-2x loader"></i>',
                "lengthMenu": "_MENU_",
                "info": "_TOTAL_ 件中 _START_ から _END_ まで表示",
                "zeroRecords": "一致するレコードがありません",
                "infoEmpty": "0 件中 0 から 0 まで表示",
                "infoFiltered": "(_MAX_ レコードから)",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left" title="先頭"></i>',
                    "previous": '<i class="fa fa-angle-left" title="前"></i>',
                    "next": '<i class="fa fa-angle-right" title="次"></i>',
                    "last": '<i class="fa fa-angle-double-right" title="最終"></i>'
                }
            };            
            
            switch(settings.lang) {
                case 'en': return en; break;
                case 'fr': return fr; break;
                case 'es': return es; break;
                case 'pt': return pt; break;
                case 'ru': return ru; break;
                case 'zh': return zh; break;
                case 'ja': return ja; break;
            }
        }
        
        /**---------------------------------------------------------------------
          Public methods
        ----------------------------------------------------------------------*/ 
        /**
         * 
         */
        this.getPluginId = function() {
            return settings.plugin_id;
        };
        
        /**
         * 
         */
        this.getTableId = function() {
            return settings.table_id;
        };
        
        /**
         * 
         */
        this.getSelectedIds = function() {
            var ids = settings.selectedIds;
            return ids;
        };

        /**
         * 
         */
        this.getSelectedLabels = function() {
            var labels = settings.fullSelectedLabels;
            return labels;
        };
        
        /**
         * 
         */
        this.getUniqueSelectedLabels = function() {
            var labels = settings.uniqueSelectedLabels;
            return labels;
        };
        
        /**
         * 
         */
        this.getSelectInfos = function() {
            var infos = {
                plugin_id: settings.uniqueSelectedLabels,
                table_id: settings.uniqueSelectedLabels,
                selectedIds: settings.selectedIds,
                selectedLabels: settings.fullSelectedLabels,
                uniqueSelectedLabels: settings.uniqueSelectedLabels
            };
            return infos;
        };
        
        /**
         * 
         * @param string style
         * @returns {undefined}
         */
        this.setCSS = function(style) {
            $('#btn_'+settings.plugin_id).removeAttr('style');
            var new_style = style == null ? '' : style;
            var current_style = (settings.buttonWidth != null) ? 'width:'+settings.buttonWidth+';' : '';
            $('#btn_'+settings.plugin_id).attr('style', current_style + new_style);
        };
        
        /**
         * 
         * @param string lg
         * @returns {undefined}
         */
        this.setLanguage = function(lg) {
            if(lang[lg] !== undefined && lang[lg] !== null) {
                settings.lang = lg;
                current_lang = lang[settings.lang];
                reload_mSelect();
            }
        };
        
        /**
         * 
         */
        this.setSelectedIds = function(selectedIds) {
            selectedIds = convert_ids_toString(selectedIds);
            if(selectedIds.length > 0){
                settings.selectedIds = selectedIds; 
                reload_mSelect();
            }
            else{
                mSelect('reset');
            }
        };
        
        /**
         * 
         * @param string action
         * @returns {undefined}
         */
        this.mSelect = function(action, newOptions) {
            switch(action) {
                case 'reset':
                    reset_mSelect();
                break;
                
                case 'refresh':
                    if(newOptions!==''){
                        if(typeof newOptions.selectedIds !== 'undefined') {
                            newOptions.selectedIds = convert_ids_toString(newOptions.selectedIds);
                        }
                        settings = $.extend({}, settings, newOptions);
                        reload_mSelect(); 
                    }
                break;
                
                case 'enable':
                    plugin.multiselect('enable');
                break;
                
                case 'disable':
                    plugin.multiselect('disable');
                break;
                
                case 'resable': //reset and disable the mSelect
                    reset_mSelect();
                    plugin.multiselect('disable');
                break;
                
                case 'show':
                    plugin.closest('span').show();
                break;

                case 'hide':
                    plugin.closest('span').hide();
                break;
            }
        };
        
        return plugin;
        
    };//end plugin
    
}(jQuery));
