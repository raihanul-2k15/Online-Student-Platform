function updateForm() {
	var x = document.getElementsByTagName('form');
	x = x[0];
	var department = x[0].value;
	var semester = x[1].value;
	window.location.replace(window.location.pathname + "?department=" + department + "&semester=" + semester);
}
var modal = null;
var modalContent = null;
var openedRefTile = null;

$(document).ready(function () {
	modal = document.getElementsByClassName('modal')[0];
	modalContent = document.getElementById("ref_detailDialog");

	$('.ref-tile .img-container img').click(function(){
		/*
		var detailImgSrc = $(this).attr("src");
		detailDialog.children('img').attr("src", detailImgSrc);
		detailDialog.children('p').html(detailText);
		detailDialog.children('a').attr("href", detailLInkHref);
		detailDialog.children('a').text("Link: " + detailLInkHref);
		detailDialog.dialog('open');
		*/
		openModal(this.parentNode.parentNode);
	});

	window.onclick = function(event) {
	    if (event.target == modal) {
	    	closeModal();
	    }
	};

	window.onkeydown = function (event) {
	    if (event.keyCode == 27 && openedRefTile != null) {
	    	closeModal();
	    }
	};
});

function openModal(rt) {
	openedRefTile = rt;

	var x = $(openedRefTile).children('div').eq(1).children('p').children('span');
	$(modalContent).children('p').html(
		'TItle: ' + x.eq(0).html() + '<br>' +
		'Author: ' + x.eq(1).html() + '<br>' +
		'Edition: ' + x.eq(2).html() + '<br>' +
		'Added by: ' + x.eq(3).html() + '<br>' +
		'Adden on: ' + x.eq(4).html() 
	);

	modal.style.backgroundColor = '#76767699';
	modal.style.opacity = "1";
	modal.style.visibility = 'visible';
	modal.style.transition = 'opacity 0.5s, background-color 0.5s, visibility 0s ease 0s';
	modalContent.style.transform = 'rotate(360deg)';
	modalContent.style.width = "800px";
	modalContent.style.height = "auto";

	if ($(openedRefTile).children('div').eq(1).children('p').children('span').eq(6).html() != 'yes') {
		$(modalContent).children('button').attr('disabled',true);
	} else {
		$(modalContent).children('button').attr('disabled',false);
	}
}

function closeModal() {
	openedRefTile = null;

	modal.style.backgroundColor = '#76767600';
	modal.style.opacity = "0";
	modal.style.visibility = 'hidden';
	modal.style.transition = 'opacity 0.5s, background-color 0.5s, visibility 0s ease 0.5s';
	modalContent.style.transform = 'rotate(-360deg)';
	modalContent.style.width = "20px";
	modalContent.style.height = "20px";

	closeEditForm();
}

function openEditForm() {
	var x = $(openedRefTile).children('div').eq(1).children('p').children('span');
	var formFields = $(modalContent).children('form').children('input');
	formFields[0].value = x.eq(0).html();
	formFields[1].value = x.eq(1).html();
	formFields[2].value = Number(x.eq(2).text());
	formFields[3].value = $(openedRefTile).children('div').eq(1).children('a').attr('href');

	$(modalContent).children('p').css('display', 'none');
	$(modalContent).children('form').css('display', 'block');
	$(modalContent).children('button').css('display', 'none');
}

function closeEditForm() {
	$(modalContent).children('p').css('display', 'block');
	$(modalContent).children('form').css('display', 'none');
	$(modalContent).children('button').css('display', 'inline-block');
}

function upd_del(rqType) {
	if (rqType == 'del') {
		$.ajax({
	        url: '_upd_del.php',
	        type: 'POST',
	        data: {
	            rq: 'd',
	            id: $(openedRefTile).children('div').eq(1).children('p').children('span').eq(5).html()
	        },
	        success: function(msg) {
	            if (msg == 'success') {
	            	document.getElementsByClassName('main-content')[0].removeChild(openedRefTile);
	            	closeModal();
	            } else {
	            	window.alert("Error: The book or reference does not exist");
	            }
	        }               
	    });
	} else if (rqType == 'upd') {
		var formFields = $(modalContent).children('form').children('input');
		$.ajax({
	        url: '_upd_del.php',
	        type: 'POST',
	        data: {
	            rq: 'u',
	            id: $(openedRefTile).children('div').eq(1).children('p').children('span').eq(5).html(),
	            title: formFields[0].value,
	            author: formFields[1].value,
	            edition: formFields[2].value,
	            link: formFields[3].value
	        },
	        success: function(msg) {
	            if (msg == 'success') {
					var x = $(openedRefTile).children('div').eq(1).children('p').children('span');
					var formFields = $(modalContent).children('form').children('input');
					x.eq(0).html(formFields[0].value);
					x.eq(1).html(formFields[1].value);
					x.eq(2).text(formFields[2].value);
					$(openedRefTile).children('div').eq(1).children('a').attr('href', formFields[3].value);
					$(modalContent).children('p').html(
						'TItle: ' + x.eq(0).html() + '<br>' +
						'Author: ' + x.eq(1).html() + '<br>' +
						'Edition: ' + x.eq(2).html() + '<br>' +
						'Added by: ' + x.eq(3).html() + '<br>' +
						'Adden on: ' + x.eq(4).html() 
					);
	            } else {
	            	window.alert("An error has occured. Please contact website owner via Feedback page.");
	            }
	            closeEditForm();
	        }               
	    });
	}
}