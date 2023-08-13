<script>
     $(function() {
        var table = $('#get-person-responsible').DataTable({
            suppressWarnings: false,
            processing: true,
            serverSide: true,
            ajax: '{!! route('person-responsible.datatable') !!}',
            columns: [
                { data: 'no'},
                { data: 'name'},
                { data: 'phone_number'},
                { data: 'district'},
                { data: 'sub_district'},
                { data: 'address'},
                { 
                    data: 'id',
                    orderable: false,
                    render: function(id) {
                        return '<button class="my-1 btn btn-warning btn-xs edit-person-responsible" data-bs-toggle="offcanvas" data-bs-target="#edit-person-responsible" aria-controls="edit-person-responsible" style="display: inline-block;" data-id="' + id + '"><i class="ti ti-edit me-1"></i></button> @if($role == "Admin")<button class="my-1 btn btn-danger btn-xs delete-person-responsible" style="display: inline-block;" data-id="' + id + '"><i class="ti ti-trash me-1"></i></button>@endif';
                    },
                },
            ],
            responsive: true
        });

    });

</script>