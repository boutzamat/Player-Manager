(function ($) {
    $(function () {
        $('input.checkboxClass').prettyCheckable({
            color: 'green'
        });  
        
        $("a.icon-delete").live("click", function (e) {
            e.preventDefault();
            $('#record_id').text($(this).attr('rev'));
            $('#dialogDelete').dialog('open');
        });
        
        $('#content').on('change', '.team-selected', function (){
            var $this = $(this);
            $.ajax({
                type: "POST",
                data: {
                    
                    team_id: $this.val()
                },
                url: 'index.php?controller=AdminRiders&action=getTeamNr',
                success: function (res) {
                    $(".nr_team").html(res);
                 /*   $('input.checkboxClass').prettyCheckable({
                        color: 'green'
                    });   */
                }
            });   
        });
        
        $("a.icon-add").live("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {
                    search_str: $('input[name="search_str"]').val(),
                    sort: $('select[name="sort"]').val(),
                    filter: $('select[name="filter"]').val(),
                    team_id: $('select[name="team_id"]').val(),
                    number: $('select[name="number"]').val(),
                    group_id: $('select[name="group_id"]').val(),
                    rider_name: $('input[name="rider_name"]').val(),
                    q_1: ($('input[name="q_1"]').attr('checked') == 'checked')?'1':'0',
                    q_2: ($('input[name="q_2"]').attr('checked') == 'checked')?'1':'0',
                    q_3: ($('input[name="q_3"]').attr('checked') == 'checked')?'1':'0',
                    f_sm: ($('input[name="f_sm"]').attr('checked') == 'checked')?'1':'0',
                    f_dm: ($('input[name="f_dm"]').attr('checked') == 'checked')?'1':'0'
                },
                url: "index.php?controller=AdminRiders&action=addRider",
                success: function (res) {
                    $("#content").html(res);
                    $('input.checkboxClass').prettyCheckable({
                        color: 'green'
                    });   
                }
            });
            return false;
        });
        
        if ($("#dialogDelete").length > 0) {
            $("#dialogDelete").dialog({
                autoOpen: false,
                resizable: false,
                draggable: false,
                height:220,
                modal: true,
                close: function(){
                    $('#record_id').text('');
                },
                buttons: {
                    'Delete': function() {
                        $.ajax({
                            type: "POST",
                            data: {
                                search_str: $('input[name="search_str"]').val(),
                                sort: $('select[name="sort"]').val(),
                                filter: $('select[name="filter"]').val(),
                                id: $('#record_id').text()
                            },
                            url: "index.php?controller=AdminRiders&action=delete",
                            success: function (res) {
                                $("#content").html(res);
                                $("#tabs").tabs();
                                $('input.checkboxClass').prettyCheckable({
                                    color: 'green'
                                });   
                            }
                        });
                        $(this).dialog('close');			
                    },
                    'Cancel': function() {
                        $(this).dialog('close');
                    }
                }
            });
        }
        
        $(".ajax_item_name").live("click", function (e){
            e.preventDefault();
            var $this = $(this);
            
            $.ajax({
                type: "POST",
                data:{
                    search_str: $('input[name="search_str"]').val(),
                    sort: $('select[name="sort"]').val(),
                    filter: $('select[name="filter"]').val()
                },
                url: $this.attr('axis'),
                success: function (res) {
                    $("#content").html(res);
                    $('input.checkboxClass').prettyCheckable({
                        color: 'green'
                    });   
                }
            });     
        });
        
        $("a.ajax-update").live("click", function (e){
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                type: "GET",
                data: {
                    search_str: $('input[name="search_str"]').val(),
                    sort: $('select[name="sort"]').val(),
                    filter: $('select[name="filter"]').val(),
                    team_id: $('select[name="team_id"]').val(),
                    number: $('select[name="number"]').val(),
                    group_id: $('select[name="group_id"]').val(),
                    rider_name: $('input[name="rider_name"]').val(),
                    q_1: ($('input[name="q_1"]').attr('checked') == 'checked')?'1':'0',
                    q_2: ($('input[name="q_2"]').attr('checked') == 'checked')?'1':'0',
                    q_3: ($('input[name="q_3"]').attr('checked') == 'checked')?'1':'0',
                    f_sm: ($('input[name="f_sm"]').attr('checked') == 'checked')?'1':'0',
                    f_dm: ($('input[name="f_dm"]').attr('checked') == 'checked')?'1':'0'
                },
                url: $this.attr('href'),
                success: function (res) {
                    $("#content").html(res);
                    $('input.checkboxClass').prettyCheckable({
                        color: 'green'
                    });   
                }
            });
            return false;
        });
        
        $(".select-margin").live('change', function() {
            var frm = $("#frmSearch").serialize();
            $.ajax({
                type: "POST",
                data: frm,
                url: "index.php?controller=AdminRiders&action="+$("input[name='action']").val(),
                success: function (res) {
                    $("#content").html(res);
                    $('input.checkboxClass').prettyCheckable({
                        color: 'green'
                    });   
                }
            });
        });
        
        $("#serach_btn_id").live('click', function(e) {
            e.preventDefault();
            var frm = $("#frmSearch").serialize();
            $.ajax({
                type: "POST",
                data: frm,
                url: "index.php?controller=AdminRiders&action="+$("input[name='action']").val(),
                success: function (res) {
                    $("#content").html(res);
                    $('input.checkboxClass').prettyCheckable({
                        color: 'green'
                    });   
                }
            });
            return false;
        });
  
    })
})(jQuery);