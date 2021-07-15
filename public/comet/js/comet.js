(function($){
  $(document).ready(function(){

    // Post reply 
    $('a.post-reply-btn').click(function(e){
      e.preventDefault();
      let cid = $(this).attr('c_id');
      
      $('.reply-box-'+ cid).toggle();
      
    });

  });
})(jQuery)
