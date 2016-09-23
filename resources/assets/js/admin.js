$(function () {

        var companies_table = $("#companies").DataTable();
        var company_clients_table = $("#company_clients").DataTable();
        var providers_table = $("#providers").DataTable();
        var provider_faxes_table = $("#provider_faxes").DataTable();
        var clients_table = $("#clients").DataTable();
        var client_faxes_table = $("#client_faxes").DataTable();
        var client_users_table = $("#client_users").DataTable();
        var faxes_table = $("#faxes").DataTable();
        var faxes_users_table = $("#fax_users").DataTable();
        var users_table = $("#users").DataTable();


        $('#companies tbody').on('click', 'tr', function (e) {
                if (e.target.name === 'delete_modal') return;
                var data = companies_table.row( this ).data();
                window.location.href = $(this).data('href');


        } );

        $('#providers tbody').on('click', 'tr', function () {
                if (e.target.name === 'delete_modal') return;
                var data = providers_table.row( this ).data();
                window.location.href = $(this).data('href');
        } );

        $('#clients tbody').on('click', 'tr', function () {
                if (e.target.name === 'delete_modal') return;
                var data = clients_table.row( this ).data();
                window.location.href = $(this).data('href');
        } );

        $('#faxes tbody').on('click', 'tr', function () {
                if (e.target.name === 'delete_modal') return;
                var data = faxes_table.row( this ).data();
                window.location.href = $(this).data('href');
        } );

        $('#users tbody').on('click', 'tr', function () {
                if (e.target.name === 'delete_modal') return;
                var data = users_table.row( this ).data();
                window.location.href = $(this).data('href');
        } );

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