jQuery(function($){
	$('#title, #prefix').blur(function(){
		$('#prefix').val(replaceSpecialChars($(this).val()))
	});
});

function replaceSpecialChars(text) {
    text = text.replace(new RegExp('[ÁÀÂÃÄ]','gi'), 'A');
    text = text.replace(new RegExp('[ÉÈÊË]','gi'), 'E');
    text = text.replace(new RegExp('[ÍÌÎÏ]','gi'), 'I');
    text = text.replace(new RegExp('[ÓÒÔÕÖ]','gi'), 'O');
    text = text.replace(new RegExp('[ÚÙÛÜ]','gi'), 'U');
    text = text.replace(new RegExp('[Ç]','gi'), 'C');
    text = text.replace(new RegExp('[~^´`{(]','gi'), '');
    text = text.toLowerCase();
    text = text.replace(/ /g, "");
    return text;
}