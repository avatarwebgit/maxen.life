@extends('admin.layouts.admin')

@section('title')
    create Ticket
@endsection

@section('style')
   <style>
       #percentageParent,#max_percentage_amount_parent{
           display: none;
       }
       #users {
           border: 1px solid #eeeeee;
           height: auto;
           max-height: 120px;
           overflow: auto;
           display: none;
       }
       .user{
           padding: 15px;
           margin: 0 !important;
       }
       .user:hover{
           background-color: #4e73df;
           color: white;
           cursor: pointer;
       }
   </style>
@endsection

@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            language: 'fa',
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        //remove style in text copied to editor
        CKEDITOR.on('instanceReady', function (ev) {
            ev.editor.on('paste', function (evt) {
                if (evt.data.type == 'html') {
                    evt.data.dataValue = evt.data.dataValue.replace(/ style=".*?"/g, '');
                }
            }, null, null, 9);
        });
    </script>
    <script>
         $('#expireDate').MdPersianDateTimePicker({
            targetTextSelector: '#expireInput',
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

         $('#type').change(function (){
             let type=$(this).val();
             if (type=='percentage'){
                 $('#percentage').parent().show();
                 $('#max_percentage_amount').parent().show();
                 $('#amount').parent().hide();
             }else {
                 $('#percentage').parent().hide();
                 $('#max_percentage_amount').parent().hide();
                 $('#amount').parent().show();
             }

         })

         $('#selectUserInput').on('keyup', function () {
             $('#users').html(' ');
             let input = $(this).val();
             $.ajax({
                 url: "{{ route('admin.user.searchUser') }}",
                 dataType: "json",
                 type: "POST",
                 data: {
                     _token: "{{ csrf_token() }}",
                     name: input,
                 },
                 success: function (rows) {
                     if (rows) {
                         if (rows.length > 0) {
                             $('#users').html('');
                             let rowsList = '';
                             $.each(rows, function (key, row) {
                                 rowsList += appendUserRow(row);
                             });
                             $('#users').append(rowsList);
                         } else {
                             $('#users').html(`<p class="alert alert-danger text-center">کاربر مورد نظر یافت نشد</p>`);
                         }
                         $('#users').slideDown();
                     }
                 },
                 fail: function (fail) {
                     console.log(fail);
                 }
             })
         });
         function appendUserRow(row) {
             return `<p onclick="appToInput('${row.id}','${row.first_name} ${row.last_name}')" class="user" data-id='${row.id}'>${row.first_name+' '+row.last_name}</p>`;
         }
         function appToInput(id, name) {
             $('#selectUserInput').val(name);
             $('#userId').val(id);
             $('#users').slideUp();
             $('#users').html('');
         }

    </script>
@endsection
@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد تیکت</h5>
            </div>
            <hr>

            @include('admin.sections.errors')

            <form action="{{ route('admin.ticket.send') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="form-row">
              <div class="form-group col-md-12">
                        <label for="description">عنوان </label>
                      <input type="text" name="title" class="form-control" id="title">
                          
                    
                     
                    </div>
                     <div class="form-group col-md-12">
                        <label for="file">فایل </label>
                      <input type="file" name="file" class="form-control" id="file">
                          
                    
                     
                    </div>
               
               <div class="form-group col-md-12">
                        <label for="description">پیام </label>
                      <textarea name="description" class="form-control" id="description">
                          
                      </textarea>
                     
                    </div>
               
                 
                  
                   

                    <div class="form-group col-md-12">
                        <label for="description"> کاربر </label>
                        <input class="form-control" id="selectUserInput"  type="text">
                        <input class="form-control" id="userId" name="user_id" value="" type="hidden">
                        <div id="users">

                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('admin.ticket.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
