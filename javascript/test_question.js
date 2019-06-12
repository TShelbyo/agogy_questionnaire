
//affichage choix question simple

$("ul li").click(function (){

valeur = new String($(this).text());
console.log(valeur);
if(valeur==' Jeter de la vodka') {

	$("#un").css('color','white');
	$("#un").css('background-color','black');
	$("#un").css('border', '2px ridge black');
	$("#un").css('padding','3px');
	$("#un").css('border-radius','3px');

	$("#deux").css('color','black');
	$("#deux").css('background-color','');
	$("#deux").css('border','');
	$("#deux").css('padding','3px');
	$("#deux").css('border-radius','3px');

	$("#trois").css('color','black');
	$("#trois").css('background-color','');
	$("#trois").css('border','');
	$("#trois").css('padding','3px');
	$("#trois").css('border-radius','3px');
}

else if(valeur==' Souffler') {

	$("#un").css('color','black');
	$("#un").css('background-color','');
	$("#un").css('border','');
	$("#un").css('padding','3px');
	$("#un").css('border-radius','3px');

	$("#deux").css('color','white');
	$("#deux").css('background-color','black');
	$("#deux").css('border', '2px ridge black');
	$("#deux").css('padding','3px');
	$("#deux").css('border-radius','3px');

	$("#trois").css('color','black');
	$("#trois").css('background-color','');
	$("#trois").css('border','');
	$("#trois").css('padding','3px');
	$("#trois").css('border-radius','3px');
}
else {

	$("#un").css('color','black');
	$("#un").css('background-color','');
	$("#un").css('border','');
	$("#un").css('padding','3px');
	$("#un").css('border-radius','3px');

	$("#deux").css('color','black');
	$("#deux").css('background-color','');
	$("#deux").css('border','');
	$("#deux").css('padding','3px');
	$("#deux").css('border-radius','3px');

	$("#trois").css('color','white');
	$("#trois").css('background-color','black');
	$("#trois").css('border', '2px ridge black');
	$("#trois").css('padding','3px');
	$("#trois").css('border-radius','3px');
}

});
