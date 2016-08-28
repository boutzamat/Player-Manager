(function ($) {
    $(function () {
        $("a.icon-delete").live("click", function (e) {
            e.preventDefault();
            $('#record_id').text($(this).attr('rev'));
            $('#dialogDelete').dialog('open');
        });
        $("a.icon-delete-group").live("click", function (e) {
            e.preventDefault();
            $('#record_id').text($(this).attr('rev'));
            $('#dialogDeleteGroup').dialog('open');
        });
        
        $(".ajax_item_name").live("click", function (e){
            e.preventDefault();
            var $this = $(this);
            
            if($this.hasClass('group')){
                $.ajax({
                    type: "POST",
                    url: $this.attr('axis'),
                    success: function (res) {
                        $("#table_group_id").html(res);
                    }
                });    
            }else{
                $.ajax({
                    type: "POST",
                    url: $this.attr('axis'),
                    success: function (res) {
                        $("#content").html(res);
                        $("#tabs").tabs();
                    }
                });    
            }
            
        });
        
        $("a.ajax-update-team").live("click", function (e){
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                type: "POST",
                data: {
                    team_name: $('input[name="team_name"]').val(),
                    number_from: $('input[name="number_from"]').val(),
                    number_to: $('input[name="number_to"]').val()
                },
                url: $this.attr('href'),
                success: function (res) {
                    $("#content").html(res);
                    $("#tabs").tabs();
                }
            });
            return false;
        });
        
        $("a.ajax-update-group").live("click", function (e){
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                type: "POST",
                data: {
                    group_name: $('input[name="group_name"]').val()
                },
                url: $this.attr('href'),
                success: function (res) {
                    $("#table_group_id").html(res);
                }
            });
            return false;
        });
        
        $("a.icon-add-group").live("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {
                    group_name: $('input[name="group_name"]').val()
                },
                url: "index.php?controller=AdminSettings&action=addGroup",
                success: function (res) {
                    $("#table_group_id").html(res);
                    $("#tabs").tabs();
                }
            });
        });
        
        $("a.icon-add").live("click", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                data: {
                    team_name: $('input[name="team_name"]').val(),
                    number_from: $('input[name="number_from"]').val(),
                    number_to: $('input[name="number_to"]').val()
                },
                url: "index.php?controller=AdminSettings&action=addTeam",
                success: function (res) {
                    $("#table_team_id").html(res);
                    $("#tabs").tabs();
                }
            });
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
                                id: $('#record_id').text()
                            },
                            url: "index.php?controller=AdminSettings&action=deleteTeam",
                            success: function (res) {
                                $("#content").html(res);
                                $("#tabs").tabs();
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
        
        if ($("#tabs").length > 0) {
            $("#tabs").tabs({
                select: function(event, ui){
                    $("#message_box").html("");
                    switch(ui.index){
                        case 0:
                            $("#info_list_box").css("display", "block");
                            $("#info_add_box").css("display", "none");
                            break;
                        case 1:
                            $("#info_list_box").css("display", "none");
                            $("#info_add_box").css("display", "block");
                            break;
                    }
                }
            });
        }
        if ($("#dialogDeleteGroup").length > 0) {
            $("#dialogDeleteGroup").dialog({
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
                                id: $('#record_id').text()
                            },
                            url: "index.php?controller=AdminSettings&action=deleteGroup",
                            success: function (res) {
                                $("#content").html(res);        
                                $("#tabs").tabs({
                                    active: 1
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
    });
})(jQuery);
        