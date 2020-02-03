// 모든 문서가 로딩되면 자동으로 실행되는 함수
$(function () {
    var slideshow = $('.slideshow'),
        slideshowSlides = slideshow.find('.slideshow_slides'),
        slides = slideshowSlides.find('a'),
        currentIndex = 0,
        slidesCount = slides.length,
        nav = slideshow.find('.slideshow_nav'),
        prev = nav.find('.prev'),
        next = nav.find('.next'),
        indicator = slideshow.find('.slideshow_indicator').find('a'),
        auto_timer = null;

    // 슬라이드 이미지를 가로로 배치
    slides.each(function (i) { 
        var newLeft = i * 100 + '%';
        $(this).css({left : newLeft});
    });

    // 클릭 시 위치 변경
    prev.click(function (e) { 
        e.preventDefault();
        if(currentIndex !== 0){
            currentIndex -= 1;
        }
        check_index_and_slide();
    });

    next.click(function (e) { 
        e.preventDefault();
        if(currentIndex !== (slidesCount - 1)){
            currentIndex += 1;
        }
        check_index_and_slide();
    });

    indicator.click(function (e) { 
        e.preventDefault();
        currentIndex = $(this).index();
        check_index_and_slide();
    });

    slideshow.mouseenter(function () { 
        clearInterval(auto_timer);
    });
    
    slideshow.mouseleave(function () {
        auto_slide();
    });

    function auto_slide(){
        auto_timer = setInterval(function (){
            if (currentIndex === (slidesCount - 1)){
                currentIndex = 0
            } else {
                currentIndex += 1;
            }
            check_index_and_slide();
        }, 2000);
    }

    function change_indicator(){
        indicator.removeClass('active')
        indicator.eq(currentIndex).addClass('active');
    }

    function check_index_and_slide(){
        if(currentIndex === 0){
            prev.addClass('hidden');
            next.removeClass('hidden');
        }else if(currentIndex === (slidesCount - 1)){
            next.addClass('hidden');
        }else{
            prev.removeClass('hidden');
            next.removeClass('hidden');
        }
        slideshowSlides.animate({left: (-100 * currentIndex) + '%'}, 1000 );
        change_indicator();
    }

    function init(){
        check_index_and_slide();
        auto_slide();
    }

    init();

});
