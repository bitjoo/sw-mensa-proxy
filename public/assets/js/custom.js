//Accordion
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}

var bitjo = {
  ajax: function(url, method, cb) {
      url = url || '';
      method = method || 'GET';
      var newXHR = new XMLHttpRequest();
      newXHR.addEventListener( 'load', cb );
      newXHR.open( 'GET', url );
      newXHR.send();
  }
};



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

function loadSpeiseplanWochentag(date, week, day) {
    var selectedMensaId = document.getElementById('listboxEinrichtungen').value;
    bitjo.ajax(
        document.origin + '/mensa/' + selectedMensaId + '/date/' + date + '/week/' + week,
        'GET',
        function() {
            document.getElementById('speiseplan').innerHTML = this.response;
            if (week) {
                loadTagesReiter(day)
            }
        });
}

function loadTagesReiter(day) {

}

function xhrLoad() {
    //TODO: Mensa-Dropdown/Switch
    noSupport();
}

function noSupport() {
    console.info("This feature is currently not supported by proxy.bitjo.de");
    alert("This feature is currently not supported by proxy.bitjo.de");
}
