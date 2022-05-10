        //I added event handler for the file upload control to access the files properties.
        document.addEventListener("DOMContentLoaded", init, false);

        //To save an array of attachments 
        var AttachmentArray = [];

        //counter for attachment array
        var arrCounter = 0;

        //to make sure the error message for number of files will be shown only one time.
        var filesCounterAlertStatus = false;

        //un ordered list to keep attachments thumbnails
        var ul = document.createElement('ul');
        ul.className = ("thumb-Images");
        ul.id = "imgList";

        function init() {
            //add javascript handlers for the file upload event
            var el = document.querySelector('#files');
            if(el){
                el.addEventListener('change', handleFileSelect, false);
            }
        }

        //the handler for file upload event
        function handleFileSelect(e) {
            //to make sure the user select file/files
            if (!e.target.files) return;

            //To obtaine a File reference
            var files = e.target.files;

            // Loop through the FileList and then to render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                //instantiate a FileReader object to read its contents into memory
                var fileReader = new FileReader();

                // Closure to capture the file information and apply validation.
                fileReader.onload = (function (readerEvt) {
                    return function (e) {
                        
                        //Apply the validation rules for attachments upload
                        ApplyFileValidationRules(readerEvt)

                        //Render attachments thumbnails.
                        RenderThumbnail(e, readerEvt);

                        //Fill the array of attachment
                        FillAttachmentArray(e, readerEvt)
                    };
                })(f);

                // Read in the image file as a data URL.
                // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
                // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
                fileReader.readAsDataURL(f);
            }
            document.getElementById('files').addEventListener('change', handleFileSelect, false);
        }

        //To remove attachment once user click on x button
        jQuery(function ($) {
            $('div').on('click', '.img-wrap .close', function () {
                var id = $(this).closest('.img-wrap').find('img').data('id');

                //to remove the deleted item from array
                var elementPos = AttachmentArray.map(function (x) { return x.FileName; }).indexOf(id);
                if (elementPos !== -1) {
                    AttachmentArray.splice(elementPos, 1);
                }

                //to remove image tag
                $(this).parent().find('img').not().remove();

                //to remove div tag that contain the image
                $(this).parent().find('div').not().remove();

                //to remove div tag that contain caption name
                $(this).parent().parent().find('div').not().remove();

                //to remove li tag
                var lis = document.querySelectorAll('#imgList li');
                for (var i = 0; li = lis[i]; i++) {
                    if (li.innerHTML == "") {
                        li.parentNode.removeChild(li);
                    }
                }

            });
        }
        )

        //Apply the validation rules for attachments upload
        function ApplyFileValidationRules(readerEvt)
        {
            //To check file type according to upload conditions
            if (CheckFileType(readerEvt.type) == false) {
                alert("The file (" + readerEvt.name + ") does not match the upload conditions, You can only upload jpg/png/gif files");
                e.preventDefault();
                return;
            }

            //To check file Size according to upload conditions
            if (CheckFileSize(readerEvt.size) == false) {
                alert("The file (" + readerEvt.name + ") does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB");
                e.preventDefault();
                return;
            }

            //To check files count according to upload conditions
            if (CheckFilesCount(AttachmentArray) == false) {
                if (!filesCounterAlertStatus) {
                    filesCounterAlertStatus = true;
                    alert("You have added more than 10 files. According to upload conditions you can upload 10 files maximum");
                }
                e.preventDefault();
                return;
            }
        }

        //To check file type according to upload conditions
        function CheckFileType(fileType) {
            if (fileType == "image/jpeg") {
                return true;
            }
            else if (fileType == "image/png") {
                return true;
            }
            else if (fileType == "image/gif") {
                return true;
            }
            else {
                return false;
            }
            return true;
        }

        //To check file Size according to upload conditions
        function CheckFileSize(fileSize) {
            if (fileSize < 300000) {
                return true;
            }
            else {
                return false;
            }
            return true;
        }

        //To check files count according to upload conditions
        function CheckFilesCount(AttachmentArray) {
            //Since AttachmentArray.length return the next available index in the array, 
            //I have used the loop to get the real length
            var len = 0;
            for (var i = 0; i < AttachmentArray.length; i++) {
                if (AttachmentArray[i] !== undefined) {
                    len++;
                }
            }
            //To check the length does not exceed 10 files maximum
            if (len > 9) {
                return false;
            }
            else
            {
                return true;
            }
        }

        //Render attachments thumbnails.
        function RenderThumbnail(e, readerEvt)
        {
            var li = document.createElement('li');
            ul.appendChild(li);
            li.innerHTML = ['<div class="img-wrap"> <span class="close">&times;</span>' +
                '<img class="thumb" style="width:100px;" src="', e.target.result, '" title="', escape(readerEvt.name), '" data-id="',
                readerEvt.name, '"/>' + '</div>'].join('');

            var div = document.createElement('div');
            div.className = "FileNameCaptionStyle";
            li.appendChild(div);
            div.innerHTML = [readerEvt.name].join('');
            document.getElementById('Filelist').insertBefore(ul, null);
        }

        //Fill the array of attachment
        function FillAttachmentArray(e, readerEvt)
        {
            AttachmentArray[arrCounter] =
            {
                AttachmentType: 1,
                ObjectType: 1,
                FileName: readerEvt.name,
                FileDescription: "Attachment",
                NoteText: "",
                MimeType: readerEvt.type,
                Content: e.target.result.split("base64,")[1],
                FileSizeInBytes: readerEvt.size,
            };
            arrCounter = arrCounter + 1;
        }
























   function ajax_userstatus(id,status){


      $.ajax({
            type: "POST",
            url: "/admin/user_status_handle",
            async: true,
            headers: {
      			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            data: {
                id: id  ,
                status: status  
            },
            success: function (msg) {
                // alert(msg);
            }
        });
   }



function get_ticket_type(sel)
{
   var ticket_type = sel.value;

   $.ajax({
            type: "POST",
            url: "/admin/ticket_type_handle",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                ticket: '1'  ,
                ticket_type: ticket_type  
            },
            success: function (data) {
                $('.ticket_form').html(data);
            }
        });
}




function add_another_ticket()
{
   var add_another = 'online_ticket';

   $.ajax({
            type: "POST",
            url: "/admin/add_another_ticket",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                ticket: 'sel' ,
                add_another: add_another  
            },
            success: function (data) {
                $('.add_another_ticket').append(data);
            }
        });
}




function get_stall_type(sel)
{
   var stall_type = sel.value;

   $.ajax({
            type: "POST",
            url: "/admin/stall_type_handle",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                stall: '1'  ,
                stall_type: stall_type  
            },
            success: function (data) {
                $('.stall_form').html(data);
            }
        });
}








function add_another_stall_type()
{
   var add_another = 'online_stall';

   $.ajax({
            type: "POST",
            url: "/admin/add_another_stall",
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                stall: 'sel' ,
                add_another: add_another  
            },
            success: function (data) {
                $('.add_another_stall').append(data);
            }
        });
}



$(document).ready(function() {
    $("#bulkDelete").on('click',function() { // bulk checked
        var status = this.checked;
        $(".deleteRow").each( function() {
            $(this).prop("checked",status);
        });
    });


    $('#deleteTriger').on("click", function(event){ // triggering delete one by one

        if (!confirm('Are you sure?')) return false;
        if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
            var ids = [];
            $('.deleteRow').each(function(){
                if($(this).is(':checked')) { 
                    ids.push($(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion 
            $.ajax({
                type: "POST",
                url: "/admin/cat_dlt",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data_ids:ids_string},
                success: function(result) {
                    location.reload();
                },
                async:false
            });
        }
    }); 





    $('#deleteExhibitor').on("click", function(event){ // triggering delete one by one

        if (!confirm('Are you sure?')) return false;
        if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
            var ids = [];
            $('.deleteRow').each(function(){
                if($(this).is(':checked')) { 
                    ids.push($(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion 
            $.ajax({
                type: "POST",
                url: "/admin/exhibitor_dlt",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data_ids:ids_string},
                success: function(result) {
                    location.reload();
                },
                async:false
            });
        }
    });



        $('#deleteOrganizer').on("click", function(event){ // triggering delete one by one

        if (!confirm('Are you sure?')) return false;
        if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
            var ids = [];
            $('.deleteRow').each(function(){
                if($(this).is(':checked')) { 
                    ids.push($(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion 
            $.ajax({
                type: "POST",
                url: "/admin/organizer_dlt",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data_ids:ids_string},
                success: function(result) {
                    location.reload();
                },
                async:false
            });
        }
    }); 


});



// $(document).ready(function() {
//     $("#logo").on("contextmenu",function(e){
//        return false;
//     }); 
// }); 
// 

$(document).ready(function() {
   $("#bulkDeleteEvent").on('click',function() { // bulk checked
       var status = this.checked;
       $(".deleteRowEvent").each( function() {
           $(this).prop("checked",status);
       });
   });




$(".replyBtn").on('click',function() { // bulk checked
        var id = $(this).attr('id');
		var email = $(this).attr('email');
		var reply_subject = $(this).attr('reply_subject');
		var reply_message = $(this).attr('reply_message');
       
		$('#reply_id').val(id);
		$('#reply_email').val(email);
		$('#reply_email1').text(email);
		$('#reply_subject').val(reply_subject);
		$('#reply_message').val(reply_message);
   });


     $(".subscriberStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "subscriberStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });


     $(".tourStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/tourStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

     $(".blogStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/blogStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });     

//Review Approve
    $(".reviewStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/reviewStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

    $(".questionStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/questionStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });


    $(".productReviewStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/productReviewStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });


    $(".tourReviewStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/tourReviewStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });


     $(".couponStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/couponStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

     $(".categoryStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/categoryStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });


     $(".tourCategoryStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/tourCategoryStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

    $(".activityStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/activityStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

     $(".productStock").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/productStock",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

     $(".productFeatured").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/productFeatured",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

     $(".testimonialStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/testimonialStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {

            }
        });
   });

     $(".productBestseller").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/productBestseller",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

     $(".productStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/productStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });

    $(".sliderStatus").on('click',function() { 
       var id = $(this).attr('id');

       $.ajax({
            type: "POST",
            url: "/admin/sliderStatus",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });
});







 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //  $('#new_status').editable({
    //     container: 'body',
    //     selector: 'td.events',
    //     mode:'inline',
    //     url: "update_event_status",
    //     title: 'Status',
    //     type: "POST",   
    //     source: [{value: "0", text: "Under Verification"}, {value: "1", text: "Publish"}, {value: "2", text: "Reject"}],
    //     validate: function(value){
    //      if($.trim(value) == '')
    //      {
    //       return 'This field is required';
    //      }
    //     }
    // });

var closeBtns = document.querySelectorAll('.img-wrap .close')

for (var i = 0, l = closeBtns.length; i < l; i++) {
  closeBtns[i].addEventListener('click', function() {
    var imgWrap = this.parentElement;
    imgWrap.parentElement.removeChild(imgWrap);
  });
}

