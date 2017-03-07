var YTGALLERY = (function () {
    
    //private
    function init() {        
        jQuery('.meta_image_url').on('focusout', function(){
            var url = jQuery(this).val();
            var $img = jQuery(this).parent().siblings('.ytgallery-thmb-col').find('img');
            if(url == ''){
                jQuery(this).parent().siblings('.ytgallery-thmb-col').empty();
            }else{
                if($img.length){
                    $img.attr('src',url);
                }else{
                    jQuery(this).parent().siblings('.ytgallery-thmb-col').append('<img src="' + url + '" />');
                }
            }
            
        });
    }

    function addImage(obj) {
        tb_show('', 'media-upload.php?TB_iframe=true');

        window.send_to_editor = function(html) {
            var url = jQuery(html).find('img').attr('src');
            jQuery(obj).siblings('.meta_image_url').val(url);
            jQuery(obj).parent().siblings('.ytgallery-thmb-col').append('<img src="' + url + '" />');
            tb_remove();
        };

        return false;  
    }
    
    //public
    return {
        Init: function () {
            init();
        },
        AddImage: function (obj) {
            addImage(obj);
        }
    };
})();

jQuery(document).ready(function() {
    YTGALLERY.Init();
});