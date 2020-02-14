//Clone the hidden element and shows it
$('.add-one').click(function(){
    var form = $('.dynamic-element').first().clone().appendTo('.dynamic-stuff');

    // si settano determinati campi come required
    form.find("#name,#author,#audioFile,#videoFile,#videoMiniatureFile,#subtitle").prop('required', true);

    form.show();
    attach_delete();
  });
  
  
  //Attach functionality to delete buttons
  function attach_delete(){
    $('.delete').off();
    $('.delete').click(function(){
      console.log("click");
      $(this).closest('.form-group').remove();
    });
  }