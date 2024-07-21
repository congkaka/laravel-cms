<div class="">
    <div class="row">
        <div class="mb-2 col-10">
            <h2>Menu top</h2>
        </div>
        <div class="mb-2 col-2">
            <button type="button" data-block="{{$block}}" class="btn btn-primary btn_add_image">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>
    <div id="{{$block}}">
    </div>
</div>
@push('custom-scripts')
    <script>
        $(document).on('click','.btn_add_image',  function (){
           let id = $(this).data('block');

            let max = 0;
            $(`#${id} .item`).each(function(){
                max = max > parseInt($(this).attr('id')) ? max : parseInt($(this).attr('id'));
            });

            let index = max + 1;
            $(`#${id}`).append(`
            <div class="row mb-5 item" id="${index}">
                <div class="col-2">
                    <x-single-img-upload inputName="{{$block}}[${index}][image][]" fillValue=""/>
                </div>
                <div class="col-9">
                    <input type="text" placeholder="Link liên kết" name="{{$block}}[${index}][link][]" class="form-control mb-10" />
                    <input type="text" placeholder="Nội dung" name="{{$block}}[${index}][content][]" class="form-control" />
                </div>
                <div class="mb-1 fv-row col-1 d-flex align-items-center">
                    <span class="btn_remove_item">
                        <i class="bi bi-x-lg text-danger"></i>
                    </span>
                </div>
            </div>
            `);
        })
    </script>
@endpush
