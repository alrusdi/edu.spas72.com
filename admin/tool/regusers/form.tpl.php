<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.3.3/underscore-min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="<?php echo $CFG->wwwroot; ?>/admin/tool/regusers/js/regusers.js"></script>
<form method="post" id="form" class="mform" action="./">
	<fieldset class="clearfix">
		<legend>Настройки</legend>
		<div class="fcontainer clearfix">
			<div class="fitem fitem_fselect" id="fitem_id_delimiter_city">
				<div class="fitemtitle">
					<label for="city">Город </label>
				</div>
				<div class="felement fselect">
					<input type="text" id="city" value="<?php if (! empty($_POST['city'])) echo $_POST['city']; ?>" />
				</div>
			</div>
			<div class="fitem fitem_fselect" id="fitem_id_delimiter_cohort1">
				<div class="fitemtitle">
					<label for="cohort1">Глобальная группа </label>
				</div>
				<div class="felement fselect">
					<select id="cohort1">
						<?php $cohorts = cohort_get_cohorts(1, 0, $perpage = 10000); ?>
						<?php foreach ($cohorts['cohorts'] as $cohort): ?>
						<option value="<?php echo $cohort->id; ?>"><?php echo $cohort->name; ?></option>
						<?php endforeach; ?>
					</select> 
					<a href="/cohort/">Я хочу добавить новую глобальную группу</a>
				</div>
			</div>
			<div class="fitem fitem_fselect" id="fitem_id_delimiter_fios">
				<div class="fitemtitle">
					<label for="fios">Список ФИО </label>
				</div>
				<div class="felement fselect">
					<textarea style="width:95%; height: 300px;" id="fios"><?php if (! empty($_POST['fios'])) echo $_POST['fios']; ?></textarea>
					<textarea style="display:none;" id="csv" name="raw_csv_content">username,password,lastname,firstname,email,city,country,cohort1</textarea>
				</div>
			</div>
			<center><input type="button" id="check" style="margin-top:10px;" value="Дальше >>" /></center>
		</div>
	</fieldset>
</form>
