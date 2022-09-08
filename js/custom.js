jQuery(document).ready(function() {

    // Mobile menu
    // Grab HTML Elements
	const btnWrap = document.querySelector(".mobile-menu-wrapper");
	const btn = document.querySelector("button.mobile-menu-button");
	const menu = document.querySelector(".mobile-menu");
    const overlay = document.querySelector(".overlay");

	// Add Event Listeners
	btn.addEventListener("click", () => {
	    btnWrap.classList.toggle("menu-open");
	    menu.classList.toggle("slide-close");
	    overlay.classList.toggle("hidden");
	});
	overlay.addEventListener("click", () => {
        btnWrap.classList.toggle("menu-open");
	    menu.classList.toggle("slide-close");
	    overlay.classList.toggle("hidden");
	});

    // redirect
    jQuery(".animate-redirect a[href^='#']").click(function(e) {
        e.preventDefault();

        var position = jQuery(jQuery(this).attr("href")).offset().top;

        jQuery("body, html").animate({
            scrollTop: position
        }, 1000);
    });

    // ScrollReveal
	jQuery(document).ready(function() {
		ScrollReveal().reveal('.border-grid');
	});

	jQuery('.accreditations-carousel').slick({
		slidesToShow: 6,
		slidesToScroll: 3,
		dots: false,
		arrows: false,
		autoplay: true,
		infinite: true,
		responsive: [
			{
				breakpoint: 1280,
				settings: {
				  	slidesToShow: 6,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
				  	slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 0,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
		]
	});

});

jQuery(document).ready(function() {
	
	const submitIcon = jQuery(".search-form .search-submit");
	const inputBox = jQuery(".search-form .search-input");
	const searchBox = jQuery(".search-form");
	let isOpen = false;
	
	submitIcon.click(function(e) {
		if (!isOpen) {
			e.preventDefault();
			inputBox.focus();
			jQuery('.search-form:focus-within .search-input').removeClass("-z-10");
			isOpen = true;
		} else {
			inputBox.focusout();
			jQuery('.search-form .search-input').addClass("-z-10");
			isOpen = false;
		}
	});

	submitIcon.mouseup(function() {
		return false;
	});
	searchBox.mouseup(function() {
		return false;
	});
	jQuery(document).mouseup(function() {
		if (isOpen) {
			inputBox.focusout();
			jQuery('.search-form .search-input').addClass("-z-10");
			isOpen = false;
		}
	});
	
});