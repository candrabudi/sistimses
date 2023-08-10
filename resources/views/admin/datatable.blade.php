<script>
     $(function() {
        var table = $('#get-population').DataTable({
            suppressWarnings: false,
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatable') !!}',
            columns: [
                { data: 'no'},
                { data: 'nik'},
                { data: 'name'},
                { data: 'phone_number'},
                { data: 'district'},
                { data: 'sub_district'},
                { 
                    data: 'id',
                    orderable: false,
                    render: function(id) {
                        return '<button class="my-1 btn btn-warning btn-xs edit-population-data" data-bs-toggle="offcanvas" data-bs-target="#edit-population-data" aria-controls="edit-population-data" style="display: inline-block;" data-id="' + id + '"><i class="ti ti-edit me-1"></i> Edit</button> @if($role == "Admin")<button class="my-1 btn btn-danger btn-xs delete-population-data" style="display: inline-block;" data-id="' + id + '"><i class="ti ti-trash me-1"></i> Hapus</button>@endif';
                    },
                },
            ],
            responsive: true
        });

    });

</script>