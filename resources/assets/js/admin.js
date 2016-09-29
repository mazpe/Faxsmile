$(function () {

        // DataTables
        var companies_table = $("#companies").DataTable();
        var company_clients_table = $("#company_clients").DataTable();
        var company_users_table = $("#company_users").DataTable();
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