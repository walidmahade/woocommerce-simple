let mwSliderMw = new Swiper('#cpsmw-container', {
    slidesPerView: 7,
    spaceBetween: 2,
    breakpoints: {
        1024: {
            slidesPerView: 7,
            spaceBetween: 2,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 2,
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 2,
        }
    },
    loop: true,
    centeredSlides: true,
    autoplay: false,
    slideToClickedSlide: true,
    on: {
        slideChange: function () {
            console.log(mwSliderMw);
            let allContentDiv = document.querySelectorAll(".cpsmw-slide-content");
            let activeSlide = mwSliderMw.length ? mwSliderMw[mwSliderMw.length - 1].realIndex : mwSliderMw.realIndex;
			
            console.log(activeSlide);
            
			let getCorrenpondingContent = document.getElementById("content-" + activeSlide);

            allContentDiv.forEach(function (contentDiv) {
                contentDiv.classList.remove("active");
            });

            getCorrenpondingContent.classList.add("active");
        }
    }
});