window.onload = function () {

    const wW = window.outerWidth;
        
    const wH = window.outerHeight;

    var hoverBoys = $('[data-hover]');
    var hoverBoysTwo = $('[data-hoverTwo]');

    hoverBoys.each(function(){

        $(this).addClass('hoverMe');

        var myClass = $(this).attr('data-hover');
        
        var btnPosition = $(this).offset().top;

        var theXPosition = btnPosition - ( wH - ( $(this).outerHeight() * 2 ));

        var _this = $(this);

        $(document).on('scroll', function(){

            let sTop = window.pageYOffset;
            
            if (sTop > theXPosition && _this.hasClass('hoverMe') && wW < 976) {
                
                _this.removeClass('hoverMe');
                
                _this.addClass(myClass);

                setTimeout(() => {
                
                    _this.removeClass(myClass);
                    
                }, 300);

            }
            
            if (sTop < theXPosition && !_this.hasClass('hoverMe') && wW < 976) {
                
                _this.addClass('hoverMe');

            }

        })

    })

    hoverBoysTwo.each(function(){

        $(this).addClass('hoverMe');

        var myClass = $(this).attr('data-hoverTwo');
        
        var btnPosition = $(this).offset().top;

        var theXPosition = btnPosition - ( wH - ( $(this).outerHeight() * 2 ));

        var _this = $(this);

        $(document).on('scroll', function(){

            let sTop = window.pageYOffset;
            
            if (sTop > theXPosition && _this.hasClass('hoverMe') && wW < 976) {
                
                _this.removeClass('hoverMe');
                
                _this.addClass(myClass);

            }
            
            if (sTop < theXPosition && !_this.hasClass('hoverMe') && wW < 976) {
                
                _this.addClass('hoverMe');

                setTimeout(() => {
                
                    _this.removeClass(myClass);
                    
                }, 300);

            }

        })

    })

}