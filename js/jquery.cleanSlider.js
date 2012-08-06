/*!
 * CleanSlider v1.0.0
 * http://slider.jqueryload.com/
 *
 * Copyright 2011, Lucas Forchino
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Date:  22 Nov 2011.
 */
(function($){
    $.fn.cleanSlider = function(config){
        var sliders=$(this);
        sliders.addClass('clean_slider_container');
        sliders.css('width',config.width);
        sliders.css('height',config.height + 20);


        var changeEffects = function (elementToHide,elementToShow){


            if (!$(elementToHide).size())
                {
                    elementToShow.addClass('clean_slider_image_shown');
                    elementToShow.fadeIn('fast');
                }else{

                    elementToHide.fadeOut('fast',function(){
                        elementToHide.addClass('clean_slider_image_shown');
                        elementToShow.fadeIn('slow');
                        elementToShow.addClass('clean_slider_image_shown');
                    });
                }
        }
        var showImage = function (slider,imageNumber){
            var prevImageNumber = $(slider).attr('data-image');
            var elementToHide   = $(slider).find('[data-id='+prevImageNumber+'] img');
            $(slider).attr('data-image',imageNumber);
            var elementToShow   = $(slider).find('[data-id='+imageNumber+'] img');
            changeEffects(elementToHide,elementToShow);

            $(slider).find('a').removeClass('active');
            $(slider).find('a[data-id='+imageNumber+']').addClass('active');                
        }

        var nextImage = function(){
            sliders.each(function(){

               if ($(this).attr('data-passNext') || $(this).attr('data-stop') ){
                   $(this).removeAttr('data-passNext');
               }else{
                   var imageNumber = 0;
                   if ($(this).attr('data-image')){
                    var imageNumber = parseInt($(this).attr('data-image'));    
                   }
                   imageNumber = imageNumber +1;
                   var elementsCount = parseInt($(this).attr('data-count'));
                   if (imageNumber>elementsCount){
                       imageNumber=1;
                   }
                   showImage(this,imageNumber);
               }
            })

        }
        sliders.each(function(index){
            var n=1;
            var slider  = $(this);
            $(slider).attr('data-id',index);
            var imgs    = $(this).find('li').find('img');
            imgs.css('width',config.width);
            imgs.css('height',config.height);
            var ul=slider.find('ul');    
            ul.addClass('clean_slider_img_list');
            ul.css('width',config.width);
            ul.css('height',config.height);
            var lis=ul.find('li');
            lis.each(function(){
                var li =$(this);
                li.attr('data-id',n);
                n ++;
            })// end slider each

            var elementsCount=lis.size();
            $(slider).attr('data-count',elementsCount);
            var ulMark=$('<ul>');
            for (var i=1;i<=elementsCount;i++)
                {
                    var li=$('<li>');
                    var a= $('<a>');
                    a.attr('href','#');
                    a.attr('data-id',i);
                    a.click(function(){
                        var imageNumber=$(this).attr('data-id');
                        slider=$(this).parent().parent().parent().parent();
                        slider.attr('data-passNext','true');
                        showImage(slider,imageNumber);
                     });
                    li.append(a)
                    ulMark.append(li);
                }
            var markContainer=$('<div>');
            var width =elementsCount *16; // 16 => bullet sizes
            markContainer.addClass('clean_slider_mark_container');
            markContainer.css('width',width);
            markContainer.append(ulMark);
            slider.append(markContainer);
            
            var over=function(){
                var caption =$('<div class="caption">');
                var currentSlider=$(this).parent().parent().parent();
                caption.css('width',currentSlider.width());
                caption.css('top',currentSlider.height()-100);
                $(this).append(caption);
                currentSlider.attr('data-stop','true');
                var link=$(this);
                var title=$(link).attr('title');
                if (title)
                {
                   $(link).attr('data-title',title) ;
                   $(link).attr('title','');
                   currentSlider.find('.caption').html('<label>'+title+'</label>');     
                   currentSlider.find('.caption').fadeIn();
                }
            }
            var out =function(){
                $(this).find('.caption').remove();
                var currentSlider=$(this).parent().parent().parent();
                var link=$(this);
                var title =$(link).attr('data-title') ;
                $(link).removeAttr('data-title');
                $(link).attr('title',title);
                currentSlider.removeAttr('data-stop');
                currentSlider.find('.caption').fadeOut();
            }
            
            ul.find('a').mouseenter(over).mouseleave(out);
            showImage(slider,1);
        });// end sliders each
        setInterval(nextImage, config.intervalTime);
    }; // end fn
})(jQuery);