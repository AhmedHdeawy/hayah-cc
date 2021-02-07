$(document).ready(function() {

  // Add Responsive class to table in Small Devices
  if ($(window).width() < 767) {

    $('.card-block .table').addClass('table-responsive');
  } else {
    $('.card-block .table').removeClass('table-responsive');
  }

  var select2 = $('.select2');
    select2.select2({
      placeholder: select2.attr('placeholder'),
      // allowClear: true
    });

  $('.selectClear').select2({
    // allowClear: true
  })


  /**
  * Custom Alert to show Delete Message
  */

  $('.delete-form').click(function(e) {
    e.preventDefault() // Don't post the form, unless confirmed

      alertify.dialog('confirm')
        .set('title', '')
        .set({transition:'zoom',message: 'هل انت متأكد من الحذف ؟'})
        .set('onok', function(closeEvent){
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        })
        .set('oncancel', function(closeEvent){

        })
        .show();
  });



  $('.imageUpload').change(function(event){

      let input = event.target.files[0];
      const inputName = $(this).data('id');

      if (input) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#'+ inputName).attr('src', e.target.result);
          }
          reader.readAsDataURL(input);
      }

  })


  $('.reset-form').click(function(event) {

    $(':input').val('')

  });

    // CKEDITOR.replace('editor1', {
    //     removePlugins: ['MediaEmbed', 'ImageUpload'],
    //       language: 'ar',
    //       height: '300px'
    // });

  // TextEditor
  ClassicEditor
      .create(document.querySelector('.ar_ckEditor'), {

        toolbar: ["heading", "|", "bold", "italic", "Strikethrough", "Code", "fontFamily", "fontColor", "fontBackgroundColor", "alignment",
              "link", "bulletedList", "numberedList", "|", "indent", "outdent", "|", "blockQuote", "insertTable", "undo", "redo"
          ],
          removePlugins: ['MediaEmbed', 'ImageUpload'],
          language: 'ar',
          height: '300px'
      })
      .then(editor => {})
      .catch(error => {});

      ClassicEditor
      .create(document.querySelector('.en_ckEditor'), {

        toolbar: ["heading", "|", "bold", "italic", "Strikethrough", "Code", "fontFamily", "fontColor", "fontBackgroundColor", "alignment",
              "link", "bulletedList", "numberedList", "|", "indent", "outdent", "|", "blockQuote", "insertTable", "undo", "redo"
          ],
          removePlugins: ['MediaEmbed', 'ImageUpload'],
          language: 'en',
          height: '300px'
      })
      .then(editor => {})
      .catch(error => {});
});
