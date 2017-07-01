//Accordion
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('.kennz.toolt').each(function (idx, itm) {
        $(itm).popover({
            trigger: 'hover',
            container: 'body',
            placement: 'bottom',
            html: true,
            content: $(itm).find('.tooltip_content').get(0)
        });
    })

	$('button.accordion').click(function(e){
		$(this).next('.panel').find('.lazyload').each(function(i,image){
			$(image).attr('src',$(image).attr('data-src'));
		})
	})
});

function filterArtikel() {
    //TODO: Zusatzstoffe / Allergenefilter
    noSupport();
}

function loadSpeiseplanWochentag() {
    //TODO: Nächste Woche / Wochentage
    noSupport();
}

function xhrLoad() {
    //TODO: Mensa-Dropdown/Switch
    noSupport();
}

function noSupport() {
    console.info("This feature is currently not supported by proxy.bitjo.de");
    alert("This feature is currently not supported by proxy.bitjo.de");
}
