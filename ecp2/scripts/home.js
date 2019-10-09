var myIndex = 0;
var x = document.getElementsByClassName("mySlides");

function updateSlideShow() {
    var i;
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    x[myIndex-1].style.display = "block";
}

function carousel() {
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
	updateSlideShow();
    carouselTimer = setTimeout(carousel, 3000);
}

function changeSlide(n) {
	clearTimeout(carouselTimer);
	
	myIndex += n;
	if (myIndex > x.length)
		myIndex = 1;
	else if (myIndex < 1)
		myIndex = x.length;
	
	if (n > 0)
		x[myIndex-1].class = "mySlides w3-animate-right";
	else
		x[myIndex-1].class = "mySlides w3-animate-left";
	
	updateSlideShow();
    carouselTimer = setTimeout(carousel, 3000);
}

carousel();