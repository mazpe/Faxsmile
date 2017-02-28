$(function () {

    // DataTables
    var companies_table = $("#companies").DataTable();
    var company_clients_table = $("#company_clients").DataTable();
    var company_users_table = $("#company_users").DataTable();
    var company_faxes_table = $("#company_faxes").DataTable();
    $('#companies tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = companies_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#company_clients tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = company_clients_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#company_users tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = company_users_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#company_faxes tbody').on('click', 'tr', function (e) {
        if (e.target.name === 'delete_modal') return;
        var data = company_faxes_table.row( this ).data();
        window.location.href = $(this).data('href');
    } );

    var providers_table = $("#providers").DataTable();
    var provider_faxes_table = $("#provider_faxes").DataTable();
    var provider_users_table = $("#provider_users").DataTable();
    $('#providers tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = providers_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#provider_faxes tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = provider_faxes_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#provider_users tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = provider_users_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );

    var clients_table = $("#clients").DataTable();
    var client_faxes_table = $("#client_faxes").DataTable();
    var client_users_table = $("#client_users").DataTable();
    $('#clients tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = clients_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#client_faxes tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = client_faxes_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#client_users tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = client_users_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );

    var faxes_table = $("#faxes").DataTable();
    var fax_users_table = $("#fax_users").DataTable();
    $('#faxes tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = faxes_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );
    $('#fax_users tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = fax_users_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );

    var users_table = $("#users").DataTable();
    $('#users tbody').on('click', 'tr', function (e) {
            if (e.target.name === 'delete_modal') return;
            var data = users_table.row( this ).data();
            window.location.href = $(this).data('href');
    } );

    var fax_senders = $("#fax_senders").DataTable();
    var fax_recipients = $("#fax_recipients").DataTable();

});

$(function () {
    // Delete modal
    $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
        e.preventDefault();
        // e.stopPropagation();
        var $form=$(this);
        $('#confirm').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $form.submit();
            });
    });
});

$(function () {
    var client_id

    // fax client/users list update
    if ($("#fax-client").val() !== "") {
        client_id = $( "#fax-client" ).val();
        getClientUsers(client_id, function(results) {
            updateUsersList(results,'fax-sender');
        });
    }


    $('#fax-client').on('change', function(e){
        client_id = e.target.value;
        getClientUsers(client_id, function(results) {
            updateUsersList(results,'fax-sender');
        });
    });

    // users client/fax list update
    if ($("#user-clients").val() !== "") {
        client_id = $( "#user-clients" ).val();
        getClientFaxes(client_id, function(results) {
            updateFaxesList(results,'user-faxes');
        });
    }

    $('#user-clients').on('change', function(e){
        client_id = e.target.value;
        getClientFaxes(client_id, function(results) {
            updateFaxesList(results,'user-faxes');
        });
    });

    function updateUsersList(data,user_field_id) {
        this.preSelectedValue = "";

        var self = this;

        if ($('#fax-sender').val() !== "") {
            self.preSelectedValue = $('#fax-sender').val();
        }

        $('#'+user_field_id).empty();
        $('#'+user_field_id).append('' +
            '<option value="">Select one...</option>'
        );

        $.each(data, function(index,sender){
            var selected;

            if (sender.id == self.preSelectedValue) {
                selected = "selected";
            }

            $('#'+user_field_id).append('' +
                '<option value=' + sender.id + ' ' + selected +' >' + sender.first_name + ' ' + sender.last_name + '</option>'
            );
        });
    }

    function updateFaxesList(data,field_id) {
        this.preSelectedValue = "";

        var self = this;

        if ($('#'+field_id).val() !== "") {
            self.preSelectedValue = $('#'+field_id).val();
        }

        $('#'+field_id).empty();
        $('#'+field_id).append('' +
            '<option value="">Select one...</option>'
        );

        $.each(data, function(index,fax){
            var selected;

            if (fax.id == self.preSelectedValue) {
                selected = "selected";
            }

            $('#'+field_id).append('' +
                '<option value=' + fax.id + ' ' + selected +' >' + fax.number + '</option>'
            );
        });
    }

    function getClientUsers(client_id,callback) {
        $.get("/api/client/" + client_id + "/users", function(results, status) {
            if (status === "success") {
                callback(results);
            }
        });
    }

    function getClientFaxes(client_id,callback) {
        $.get("/api/client/" + client_id + "/faxes", function(results, status) {
            if (status === "success") {
                callback(results);
            }
        });
    }

});