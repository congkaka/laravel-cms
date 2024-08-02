<script>
    let AppConstant = {
        'imageUploadUrl' : "{{route('storage.upload')}}",
        'ckImageUploadUrl' : "{{route('storage.ck_upload')}}"
    }
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('admin/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<script src="{{asset('admin/plugins/custom/toastr/toastr.min.js')}}"></script>
<!--ckeditor-->
<script src="{{asset('admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
<script>
    @if(session('error'))
    toastr.error("{{ session('error') }}");
    @endif
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif
    $('.delete_btn').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href')
        if (confirm("Bạn xác nhận xoá dữ liệu này?") == true) {
            $.ajax({
                type: 'DELETE',
                dataType: 'json',
                data: {
                    _method: 'DELETE',
                    "_token": "{{ csrf_token() }}"
                },
                url,
                success: function(data) {
                    window.location.reload();
                },error: function(xhr, status, error) {
                    window.location.reload();
                }
            });
        }
    })
</script>
