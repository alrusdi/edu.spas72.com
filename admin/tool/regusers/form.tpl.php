<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.3.3/underscore-min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript">
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
</script>
<form method="post" id="form" action="./">
	Город: <input type="text" id="city" value="<?php if (! empty($_POST['city'])) echo $_POST['city']; ?>" />
	<br clear="all" />
	Глобальная группа:
	<select id="cohort1">
	<?php $cohorts = cohort_get_cohorts(1, 0, $perpage = 10000); ?>
	<?php foreach ($cohorts['cohorts'] as $cohort): ?>
	<option value="<?php echo $cohort->id; ?>"><?php echo $cohort->name; ?></option>
	<?php endforeach; ?>
	</select> <a href="/cohort/">Я хочу добавить новую глобальную группу</a>
	<br clear="all" /><br clear="all" />
	Список ФИО:
	<br clear="all" />
	<div style="display:inline-block; width:45%;vertical-align:top;">
		<textarea style="width:95%; height: 300px;" id="fios"><?php if (! empty($_POST['fios'])) echo $_POST['fios']; ?></textarea>
		<center><input type="button" id="check" value="Дальше >>" /></center>
	</div>
	<textarea style="width:95%; height: 600px;display:none;" id="csv" name="raw_csv_content">username,password,lastname,firstname,email,city,country,cohort1</textarea>
</form>
