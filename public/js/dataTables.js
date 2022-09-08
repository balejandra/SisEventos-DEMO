$(document).ready(function() {
    $('#generic-table').DataTable({
        responsive: true,
        autoWidth: true,
        language: {
            "url": "../public/assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('button[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );


    $('table.display').DataTable({
        responsive: true,
        fixedHeader: true,
        "order": [[ 1, "desc" ]],
        columnDefs: [
            {
                targets: 1,
                render: $.fn.dataTable.render.moment( 'YYYY-MM-DD H:mm:ss', 'DD-MM-YYYY' )
            },
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 },

        ],
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    $('table.display2').DataTable({
        responsive: true,
        fixedHeader: true,
        "order": [[ 1, "desc" ]],
        columnDefs: [
            {
                targets: 1,
                render: $.fn.dataTable.render.moment( 'YYYY-MM-DD H:mm:ss', 'DD-MM-YYYY' )
            },
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        language: {
            "url": "../public/assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });


    $('#table-nooptions').DataTable({
        responsive: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    $('table.nooptionsearch').DataTable({
        responsive: true,
        searching: false,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    $('#table-nooptions-equipo').DataTable({
        fixedHeader: true,
        scrollX: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        "paging":   false,
        "info":     false
    });


    $('#table-scroll').DataTable({
        "scrollX": true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        "paging":   false,
        "ordering": false,
        "info":     false,
        columnDefs: [ {
            targets: 4,
            render: $.fn.dataTable.render.moment('YYYY-MM-DD','DD-MM-YYYY' )
        } ],
    });

    $('#table-paginate').DataTable({
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        "ordering": false,
        "info":     false
    });

    $('#example1').DataTable({
        responsive: true,
        autoWidth: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    $('#generic-table2').DataTable({
        responsive: true,
        autoWidth: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#generic-table3').DataTable({
        responsive: true,
        autoWidth: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#generic-table4').DataTable({
        responsive: true,
        autoWidth: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#generic-table5').DataTable({
        responsive: true,
        autoWidth: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

} );

