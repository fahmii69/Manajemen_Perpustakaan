
<script type="">
        $(document).ready(function () {
            $('#yajra-dataTable').DataTable({
    
        processing: true,
        serverSide: true,
        ajax: "{{route('siswa.list')}}",
        columns: [
            {   data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
            },
            {data: 'nisn', name: 'nisn'},
            {data: 'nama', name: 'nama'},
            {data: 'tgl_lahir', name: 'tgl_lahir'},
            {data: 'kelas', name: 'kelas'},

            {   data: 'aksi',
                name: 'aksi'
            },
    ]});

    // GLOBAL SETUP 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // 02_PROSES SIMPAN 
    $('body').on('click', '.tombol-tambah', function(e) {
        e.preventDefault();
        $('#exampleModal').modal('show');
        $('.tombol-simpan').click(function() {
            simpan();
        });
    });

    // 03_PROSES EDIT 
    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'employees/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#exampleModal').modal('show');
                $('#name').val(response.name);
                $('#address').val(response.address);
                $('#email').val(response.email);
                $('#no_tlp').val(response.no_tlp);
                $('#id_company').val(response.id_company);

                $('.tombol-simpan').click(function() {
                    simpan(id);
                });
            }
        });

    });
   
    // fungsi simpan dan update
    function simpan(id = '') {
        if (id == '') {
            var var_url = 'employees';
            var var_type = 'POST';
        } else {
            var var_url = 'employees/' + id;
            var var_type = 'PATCH';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                name: $('#name').val(),
                address:$('#address').val(),
                email: $('#email').val(),
                no_tlp: $('#no_tlp').val(),
                id_company: $('#id_company').val(),
            },
            success: function(response) {
                    if (response.success) {
                            swal.fire("Done!", response.message, "success");
                            location.reload();
                        } else {
                            swal.fire("Error!", 'Something went wrong.', "error");
                        }
            },
            error: function(response){
                    $('.alert-danger').removeClass('d-none');
                    $('.alert-danger').html("<ul>");
                    $.each(response.responseJSON.errors, function(key, value) {
                        $('.alert-danger').find('ul').append("<li>" + value +
                            "</li>");
                    });
                    $('.alert-danger').append("</ul>");
            },

        });
    }

    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#name').val('');
        $('#address').val('');
        $('#email').val('');
        $('#no_tlp').val('');
        $('#id_company').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });
});

function deleteConfirmation(id) {
    swal.fire({
        title: "Delete?",
        icon: 'question',
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (e) {

        if (e.value === true) {
            let token = $('meta[name="csrf-token"]').attr('content');
            let _url = `/employees/${id}`;

            $.ajax({
                type: 'delete',
                url: _url,
                data: {_token: token},
                success: function (resp) {
                    if (resp.success) {
                        swal.fire("Done!", resp.message, "success");
                        location.reload();
                    } else {
                        swal.fire("Error!", 'Something went wrong.', "error");
                    }
                },
                error: function (resp) {
                    swal.fire("Error!", 'Something went wrong.', "error");
                }
            });

        } else {
            e.dismiss;
        }

    }, function (dismiss) {
        return false;
    })
}
</script>