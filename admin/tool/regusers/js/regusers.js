function random_seq(ct, chars) {
	var chars = chars.split('');

	var str = '';
	for (var i = 0; i < ct; i++) {
		str += chars[Math.floor(Math.random() * chars.length)];
	}
	return str;
}

function random_str(ct){
	return random_seq(ct, 'abcdefghiklmnopqrstuvwxyz')
}

function random_int(ct){
	return random_seq(ct, '0123456789')
}

function random_sign(ct){
	return random_seq(ct, '@#$%&')
}

var ru2en = {
	ru_str : "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя",
	en_str : ['A','B','V','G','D','E','JO','ZH','Z','I','J','K','L','M','N','O','P','R','S','T',
			'U','F','H','C','CH','SH','SHH',String.fromCharCode(35),'I',String.fromCharCode(39),'JE','JU',
			'JA','a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f',
			'h','c','ch','sh','shh',String.fromCharCode(35),'i',String.fromCharCode(39),'je','ju','ja'],
	translit : function(org_str) {
		var tmp_str = "";
		for(var i = 0, l = org_str.length; i < l; i++) {
			var s = org_str.charAt(i), n = ru2en.ru_str.indexOf(s);
			if(n >= 0) { tmp_str += ru2en.en_str[n]; }
			else { tmp_str += s; }
		}
		return tmp_str;
	}
}


$(function(){
	$('#check').on('click', function(){
		var fios = $('#fios').val();
		var ru = _.map(fios.split(/[\n\r]+/gi), $.trim);
		var en = _.map(ru, ru2en.translit);
		var output = "";
		var city = $('#city').val();
		var cohort1 = $('#cohort1').val();
		for (var i in ru)
		{
			iru = _.map(ru[i].split(/[ ]+/), $.trim);
			ien = _.map(en[i].split(/[ ]+/), $.trim);
			uname = ($.trim(ien[0])+$.trim(ien[1]).substr(0,1)+$.trim(ien[2]).substr(0,1)).toLowerCase()
			pwd = random_str(2).toUpperCase()+random_str(5)+random_int(2)+random_sign(2)
			output +="\n"+
			[
				uname,
				pwd,
				iru[0],
				iru[1],
				uname+'@<?php echo $_SERVER['HTTP_HOST']; ?>.ru',
				city,
				'RU',
				cohort1
			].join(",");
		}
		$('#csv').html($('#csv').html()+output);
		$('#form').submit();
	})
});
