
function view3_submit(f) {
	(function($) {
		for(var i=0; i<f.length; i++) {
			if(f[i].required) {
				var valid = true;
				if(f[i].type === 'text' || f[i].type === 'password' || f[i].type === 'select-one' || f[i].type === 'textarea') {
	                if($.trim(f[i].value) === '') valid = false;
	            } else if(f[i].type === 'checkbox') {
	                if(f[i].checked === false) valid = false;
	            } else if(f[i].type === 'radio') {
	                if(f[i].form[f[i].name].value === '') valid = false;
	            }
				if(valid === false) {
					f[i].focus();
					alert('�꾩닔�낅젰��ぉ�� 鍮좎쭚 �놁씠 �낅젰�댁＜�몄슂.');
					return false;
				}
			}
		}
		var editor_file_len = $('[name="editor_data"]').length;
		if(editor_file_len>0){
			var add_com='';
			var ext_val='';
			$.each(CKEDITOR.instances, function(index, intance) {
			var intance_id = intance.name;
				$(CKEDITOR.instances[intance_id].getData()).find('img[src^="'+root+'/upload/editor/"]').each(function(){
					ext_val += add_com+$(this).attr('src').replace(root+'/upload/editor/','');
					add_com = '||';
				});
			});
			$('[name="editor_data"]').val(ext_val);
		}

		if($(f).data('ajax') == true ) {
			$.ajax({
				url : $(f).attr('action'),
				data : $(f).serialize(),
				type : $(f).attr('method').toLowerCase()=='post'?'post':'get',
				error : function(){
					ui_alert('�ㅻ쪟');
				},
				success : function(){
					ui_alert('�꾨즺');
				}
			});
		} else {
			f.submit();
		}
	}(jQuery));
}
function ui_alert(msg){
	$('.ui_msg').remove();
	$('body').append('<div class="ui_msg" style="display:none;position:fixed;z-index:20000;padding:20px;30px;cursor:pointer;top:50%;left:50%;background:#9FCE38;border-radius:7px;">'+msg+'</div>');
	$('.ui_msg').fadeIn(300,function(){
		$('.ui_msg').delay(750).fadeOut(350,function(){
			$('.ui_msg').remove();
		});
	});
/*
	$('.ui_msg').fadeIn(300);
	$('.ui_msg').click(function(){
		$('.ui_msg').fadeOut(350,function(){
			$('.ui_msg').remove();
		});
	});
*/
}
function inquiry(f, callReturn) {
	if(typeof event.preventDefault !== 'undefined') event.preventDefault();
	else event.returnValue = false;

	if(f.privacy_agree.checked === false) {
		f.privacy_agree.focus();
		alert('媛쒖씤�뺣낫痍④툒諛⑹묠�� �숈쓽�댁＜�몄슂.');
		return false;
	}

	for(var i=0; i<f.length; i++) {
		if(f[i].required) {
			var valid = true;
			if(f[i].type === 'text' || f[i].type === 'password' || f[i].type === 'select-one' || f[i].type === 'textarea') {
                if($.trim(f[i].value) === '') valid = false;
            } else if(f[i].type === 'checkbox') {
                if(f[i].checked === false) valid = false;
            } else if(f[i].type === 'radio') {
                if(f[i].form[f[i].name].value === '') valid = false;
            }
			if(valid === false) {
				f[i].focus();
				alert('�꾩닔�낅젰��ぉ�� 鍮좎쭚 �놁씠 �낅젰�댁＜�몄슂.');
				return false;
			}
		}
		if(f[i].name === 'hp' && f[i].value.match(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?[0-9]{3,4}-?[0-9]{4}$/) === null) {
			f[i].value = '';
			f[i].focus();
			alert('�뺥솗�� �꾪솕踰덊샇瑜� �낅젰�댁＜�몄슂.');
			return false;
		}
	}
	if(typeof callReturn === 'function')if(callReturn(f)==false)return;
	f.submit();
}

function hero_key(obj,temp_key){
	str = new String(obj.value);
	if(temp_key==""){
	}else if(temp_key=="1"){//�レ옄留�
		obj.style.imeMode = "disabled";
		obj.value = str.replace(/[^0-9]/g,'');
	}else if(temp_key=="2"){//�곸뼱留�
		obj.style.imeMode = "disabled";
		obj.value = str.replace(/[^a-zA-Z]/g,'');
	}else if(temp_key=="3"){//�レ옄+�곸뼱留�+怨듬갚
		obj.style.imeMode = "disabled";
//        obj.value = str.replace(/[^0-9a-zA-Z]/g,'');
		obj.value = str.replace(/[��-��|��-��|媛�-��]/g,'');
	}else if(temp_key=="4"){//�レ옄+�곸뼱留�
		obj.style.imeMode = "disabled";
		obj.value = str.replace(/[��-��|��-��|媛�-��\s*]/g,'');
	}
}
function view3_hidden(inputID,outputID){
	var hidden_ID = document.getElementById(inputID);
    if(hidden_ID.checked == true){
		 $(outputID).show();
	}else{
		 $(outputID).hide()
	}
}
function textarea_minus(id, row){
	if(document.getElementById(id).rows - row > 9)
	document.getElementById(id).rows -= row;
}
function textarea_first(id, row){
	document.getElementById(id).rows = row;
}
function textarea_plus(id, row){
	document.getElementById(id).rows += row;
}
function view3_hp(temp_form,temp_id){
	var view3_form = temp_form.form;
//	view3_form.elements[temp_id].value = view3_number_zero(view3_form.elements[temp_id+"_01"].value,3) + view3_number_zero(view3_form.elements[temp_id+"_02"].value,4) + view3_number_zero(view3_form.elements[temp_id+"_03"].value,4);
	view3_form.elements[temp_id].value = view3_form.elements[temp_id+"_01"].value + view3_form.elements[temp_id+"_02"].value + view3_form.elements[temp_id+"_03"].value;
}
function view3_tel(temp_form,temp_id,temp_comma){
	var view3_form = temp_form.form;
	view3_form.elements[temp_id].value = view3_form.elements[temp_id+"_01"].value + temp_comma + view3_form.elements[temp_id+"_02"].value + temp_comma + view3_form.elements[temp_id+"_03"].value;
}
function view3_email(temp_form,temp_value){
	var view3_form = temp_form.form;
	view3_form.email_02.value = temp_value;
	view3_form.email.value = view3_form.email_01.value + "@" + temp_value;
}
function view3_email_value(temp_form){
	var view3_form = temp_form.form;
	view3_form.email.value = view3_form.email_01.value + "@" + view3_form.email_02.value;
}
function view3_notice_check(outputID, inputID, inputVALUE) {
//怨듭��ы빆 泥댄겕諛뺤뒪 媛� 蹂�寃�
var f = document.getElementById(inputID);
	if(f.checked == true){
		document.getElementById(outputID).value=inputVALUE;
	}else{
		document.getElementById(outputID).value="99";
	}
}
function view3_drop(temp_name,temp_drop) {
	var drop_data = "";
	$(temp_name).each(function(i){
		drop_data+=$(this).val() + '||';
	});
	temp_length = drop_data.length-2;
	if(temp_drop == null){
		var drop = "#drop";
	}else{
		var drop = temp_drop;
	}
	$(drop).val(drop_data.substr(0,temp_length));
	$(temp_name).prop("checked",true);
}
function hero_write(outputID, temp_count){
	total_value = "";
	for(hero_write_i="0";hero_write_i<=temp_count;hero_write_i++){
		total_value = total_value + document.getElementById(outputID + "_" + hero_write_i).value+"||";
	}
	document.getElementById(outputID).value = total_value.substring(0,total_value.length-2);
}
var screen_width = screen.width;
var screen_height = screen_height;
function view3_screen(temp_id,temp_width,temp_height){
	var temp_left = (screen_width-temp_width)/2;
	document.getElementById(temp_id).style.left = temp_left+"px";
//	if(typeof temp_height == "undefined"){
	if(temp_height != undefined && temp_height != null){
		var temp_top = (screen_height-temp_height)/3;
		document.getElementById(temp_id).style.top = temp_top+"px";
	}
}
function hero_img(img){
/*
	var hero_width, hero_height;
	if(img.naturalWidth){
		hero_width = img.naturalWidth;
		hero_height = img.naturalHeight;
	}else{
		var hero_new_img = new Image();
		hero_new_img.src = img.src;
		hero_width = hero_new_img.width;
		hero_height = hero_new_img.height;
	}
//    var hero_top = (document.body.clientHeight / 2) - hero_height / 2 + document.body.scrollTop;
//    var hero_left = (document.body.clientWidth / 2) - hero_width / 2 + document.body.scrollLeft;
	var hero_top = (screen_height-hero_height)/3;
	var hero_left = (screen_width-hero_width)/2;
	var hero_Handle = window.open("","","toolbar=no,scrollbars=no,resizable=no,width=" + hero_width + ",height=" + hero_height + ",top="+hero_top+",left="+hero_left);
	if(hero_Handle != null){
	var hero_html = "<html><head><title></title></head><body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bgcolor=#dddddd style='text-align:center;width:100%;height:100%;'><a href=javascript:window.close();><img src=" + img.src + " border='0' alt='�リ린' style='vertical-align:middle;'></a></body></html>";
		hero_Handle.document.open();
		hero_Handle.document.write(hero_html);
		hero_Handle.document.close();
	}
*/
}

function hero_img_pop(img){
	var hero_width, hero_height;
	if(img.naturalWidth){
		hero_width = img.naturalWidth;
		hero_height = img.naturalHeight;
	}else{
		var hero_new_img = new Image();
		hero_new_img.src = img.src;
		hero_width = hero_new_img.width;
		hero_height = hero_new_img.height;
	}
//    var hero_top = (document.body.clientHeight / 2) - hero_height / 2 + document.body.scrollTop;
//    var hero_left = (document.body.clientWidth / 2) - hero_width / 2 + document.body.scrollLeft;
	var hero_top = (screen_height-hero_height)/3;
	var hero_left = (screen_width-hero_width)/2;
	var hero_Handle = window.open("","","toolbar=no,scrollbars=no,resizable=no,width=" + hero_width + ",height=" + hero_height + ",top="+hero_top+",left="+hero_left);
	if(hero_Handle != null){
	var hero_html = "<html><head><title></title></head><body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bgcolor=#dddddd style='text-align:center;width:100%;height:100%;'><a href=javascript:window.close();><img src=" + img.src + " border='0' alt='�リ린' style='vertical-align:middle;'></a></body></html>";
		hero_Handle.document.open();
		hero_Handle.document.write(hero_html);
		hero_Handle.document.close();
	}
}
function hero_img2(temp_img,temp_width,temp_height){
	var hero_width, hero_height;
	var img = new Image();
	img.src = temp_img;
	hero_width = img.width;
		hero_width = temp_width;
		hero_height = temp_height;
	var hero_top = (screen_height-hero_height)/3;
	var hero_left = (screen_width-hero_width)/2;
	var hero_Handle = window.open("","","toolbar=no,scrollbars=yes,resizable=no,width=" + hero_width + ",height=" + hero_height + ",top="+hero_top+",left="+hero_left);
	if(hero_Handle != null){
	var hero_html = "<html><head><title></title></head><body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bgcolor=#dddddd style='text-align:center;width:100%;height:100%;'><a href=javascript:window.close();><img src=" + img.src + " border='0' alt='�リ린' style='vertical-align:middle;'></a></body></html>";
		hero_Handle.document.open();
		hero_Handle.document.write(hero_html);
		hero_Handle.document.close();
	}
}
function view3_notice(outputID, inputID, inputVALUE, check_count) {
if(typeof check_count !== 'undefined'){
	var total_check = $('[class="'+outputID+'"]:checked').length;//$("[class="'+frm+'"]:checkbox").filter(':checked').length
	var temp_count = Number(check_count)+1
	if(total_check===temp_count){
		alert(check_count+"媛쒓퉴吏�留� �좏깮 媛��ν빀�덈떎.");
		document.getElementById(inputID).checked = false;
		return false;
	}
}

var f = document.getElementById(inputID);
var temp_user = document.getElementById(outputID).value;

	if(f.checked == true){
		if(temp_user=='all'){
			document.getElementById(outputID).value=inputVALUE;
		}else if(temp_user==''){
			document.getElementById(outputID).value=inputVALUE;
		}else{
			document.getElementById(outputID).value=temp_user+'||'+inputVALUE;
		}
	}else{
		var delete_temp = document.getElementById(outputID).value.split("||");
		var del_len = delete_temp.length;
		for(var i=0; i<=del_len; i++){
			if(delete_temp[i] == inputVALUE){
				var deldel = i;
			}
		}
		var delete_end = delete_temp.splice(deldel, 1);
		document.getElementById(outputID).value=delete_temp.join('||');
	}
}
function view3_select(outputID, inputVALUE) {
	document.getElementById(outputID).value=inputVALUE;
}
function view3_select_href(inputVALUE) {
	location.href = inputVALUE;
}
//肄ㅻ쭏李띻린
function comma(str) {
	str = String(str);
	return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}
//肄ㅻ쭏��湲�
function uncomma(str) {
	str = String(str);
	return str.replace(/[^\d]+/g, '');
}
//�명뭼諛뺤뒪�� 而대쭏李띻린
function inputNumberFormat(obj) {
	obj.value = comma(uncomma(obj.value));
}
//<input type="text" onkeyup="inputNumberFormat(this)" />

// �대�吏� ��吏곸씠湲�
function moveDrag(e){
	 var e_obj = window.event? window.event : e;
	 var dmvx = parseInt(e_obj.clientX + img_L);
	 var dmvy = parseInt(e_obj.clientY + img_T);
	 targetObj.style.marginLeft = dmvx +"px";
	 targetObj.style.top = dmvy +"px";
	 return false;
}

// �쒕옒洹� �쒖옉
function startDrag(e, obj){
	 targetObj = obj;
	 var e_obj = window.event? window.event : e;
	 img_L = getLeft(obj) - e_obj.clientX;
	 img_T = getTop(obj) - e_obj.clientY;

	 document.onmousemove = moveDrag;
	 document.onmouseup = stopDrag;
	 if(e_obj.preventDefault)e_obj.preventDefault();
}

// �쒕옒洹� 硫덉텛湲�
function stopDrag(){
	 document.onmousemove = null;
	 document.onmouseup = null;
}

// 荑좏궎 媛��몄삤湲�
function getCookie(str) {
	var cookie = document.cookie;
	if(cookie.indexOf(str) !== -1) return true;
	else return false;
}
// 荑좏궎 援쎄린
function setCookie(name, value, expiredays) {
	var todayDate = new Date();
	todayDate.setDate(todayDate.getDate() + expiredays);
	document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toUTCString() + ";"
}

function setCookie_time(name,temp_time){
	var todayDate = new Date();
	var val = todayDate.getTime();
	temp_time_now = 60000 * temp_time;
	todayDate.setTime(todayDate.getTime() + temp_time_now);
	document.cookie = name + "=" + escape(val) + "; path=/;expires=" + todayDate.toGMTString() + ";"
}
function newImg(temp_img) {
	var i = new Image;
	i.src = url;
	return i;
}




function view3_sytle_checkbox(temp_link,temp_value){
	if(temp_value == true){
		$("#"+temp_link+"_01").attr("disabled","true");
	}else{
		$("#"+temp_link+"_01").removeAttr("disabled");
	}
}
function view3_sytle_select(temp_link,temp_value){
	if(temp_value == "board"){
		$("#"+temp_link+"_01").attr("type","hidden");
		$("#"+temp_link+"_01").attr("disabled","true");
		$("#"+temp_link+"_02").show();
		$("#"+temp_link+"_02").removeAttr("disabled");
	}else{
		$("#"+temp_link+"_02").hide();
		$("#"+temp_link+"_02").attr("disabled","true");
		$("#"+temp_link+"_01").attr("type","text");
		$("#"+temp_link+"_01").removeAttr("disabled");
	}
}
function del_submit(temp_name,temp_link){
	var f = document.forms[temp_name];

	f.elements.idx.value=temp_link;
	if( $('[onclick*="del_submit(\''+temp_name+'\',\''+temp_link+'\')"]').length > 0 ){
		$.ajax({
			url : $(f).attr('action'),
			data : $(f).serialize(),
			type : $(f).attr('method').toLowerCase()=='post'?'post':'get',
			error : function(){
				ui_alert('�ㅻ쪟');
			},
			success : function(){
				$('[onclick*="del_submit(\''+temp_name+'\',\''+temp_link+'\')"]').parents('thead').first().remove();
				ui_alert('�꾨즺');
			}
		});
	}else{
		f.submit();
	}
	return true;
}
function view3_ajax_select(temp_form,temp_url,temp_value,temp_out){
		var stringData = $(temp_form).serialize();
		$.ajax({
		type: 'post',
		url: temp_url,
		data: stringData + "&view3_select_value="+temp_value,
		dataType: 'text',
		success:function(msg){
			$(temp_out).html(msg);
		}
	});
}

var Calendar = {};
var Calendar2 = {};
(function($) {
////////////////////////////////////////////////////////////////////////////////////////////////////
	Calendar.updateCalendar = function(y, m) {
		$.post(root+'/freebest/calendar.php', {m_year: y, m_month: m}, function(response) {
			var html = $(response).filter('#calendarWrap');
			$('#attachCalendarDiv').html(html);
		});
	};
	Calendar.open = function(id) {
		Calendar.id = id;
		var d = new Date(),
			y = d.getFullYear(),
			m = d.getMonth() + 1;
//			if(m < 10) m = '0' + m;
		Calendar.updateCalendar(y, m);
	};
	Calendar.add = function(val) {
		$('#attachCalendarDiv').empty();
		$('#'+Calendar.id).val(val);
	};
////////////////////////////////////////////////////////////////////////////////////////////////////
	Calendar2.updateCalendar = function(y, m) {
		$.post(root+'/freebest/calendar2.php', {m_year: y, m_month: m}, function(response) {
			var html = $(response).filter('#calendarWrap2');
			$('#attachCalendarDiv2').html(html);
		});
	};
	Calendar2.open = function(id) {
		Calendar2.id = id;
		var d = new Date(),
			y = d.getFullYear(),
			m = d.getMonth() + 1;
//			if(m < 10) m = '0' + m;
		Calendar2.updateCalendar(y, m);
	};
	Calendar2.add = function(val) {
		$('#attachCalendarDiv2').empty();
		$('#'+Calendar2.id).val(val);
	};
////////////////////////////////////////////////////////////////////////////////////////////////////
	$('li[class^=lge_select] > a').click(function(e) {
		if(!$(this).parent('li').is('.on')) {
			var index = $(this).parent('li').index();
			$('li[class^=lge_select].on').removeClass('on');
			$(this).parent('li').addClass('on');
			$('.cusCons:visible').hide();
			$('.cusCons').eq(index).show();
		}
		e.preventDefault();
	});
////////////////////////////////////////////////////////////////////////////////////////////////////
	$('li[class^=hero_tab] > a').click(function(e) {
		if(!$(this).parent('li').is('.on')) {
			var index = $(this).parent('li').index();
			var new_index = $(this).parent('li').attr('id');
			$('li[class^=hero_tab_'+new_index+'].on').removeClass('on');
			$(this).parent('li').addClass('on');
			$('.hero_tab_sub_'+new_index+':visible').hide();
			$('.hero_tab_sub_'+new_index).eq(index).show();
		}
		e.preventDefault();
	});
////////////////////////////////////////////////////////////////////////////////////////////////////
/*
function imageAutoResize(){//�대�吏� �ш린 �먮룞 蹂�寃�
	var body = $('body'),
		win = $(window);
	var auto_img_class = ".auto_imageresize, .viewCon, .basic_view dd";//媛먯떥怨� �덈뒗寃껋씠 div �볦씠 媛� 湲곗�
	body.click(function(){
		$(auto_img_class).find('img').each(function(){
			$(this).css({'width':'','height':''});
			$(this).removeAttr('height width');
			$(this).data('back_width',$(this).width());
			$(this).data('back_height',$(this).height());
		});
		win.trigger('resize');
	});
	win.resize(function(){
		$(auto_img_class).each(function(idx){
			var _idx = idx;
			$(this).find('img:visible').addClass('autoImageResized').hide();
			var wrap_width = $(this).width();
			$(this).find('.autoImageResized').show();
			$(this).find('img').each(function(idx){
				var this_img_width = $(this).data('back_width');
				if(wrap_width<this_img_width){
					$(this).attr('width','100%');
					$(this).css('width','100%');
					$(this).removeAttr('height');
				}else{
					$(this).attr('width', $(this).data('back_width'));
					$(this).css('width', $(this).data('back_width'));
					$(this).attr('height', $(this).data('back_height'));
					$(this).css('width', $(this).data('back_width'));

				}
			});
		});
	});
	body.trigger('click');
	win.trigger('resize');
}
$(window).load(function(){
	imageAutoResize();
});
*/
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
/*
	function imageAutoResize(){//�대�吏� �ш린 �먮룞 蹂�寃�
		var body = $('body'),
			win = $(window);
		var auto_img_class = ".auto_imageresize, .viewCon, .basic_view dd";//媛먯떥怨� �덈뒗寃껋씠 div �볦씠 媛� 湲곗�
		body.click(function(){
			$(auto_img_class).find('img').each(function(){
				if( $(this).parent().hasClass('autoImageResizedWrap') == false){
					$(this).wrapAll('<div class="autoImageResizedWrap" />');
				}
				$(this).parent('.autoImageResizedWrap').height($(this).height());
				$(this).css({'width':'','height':''});
				$(this).removeAttr('height width');
				$(this).data('back_width',$(this).width());
				$(this).data('back_height',$(this).height());
			});
			win.trigger('resize');
		});
		win.resize(function(){
			$(auto_img_class).each(function(idx){
				var _idx = idx;
				$(this).find('img:visible').addClass('autoImageResized').hide();
				var wrap_width = $(this).width();
				$(this).find('.autoImageResized').show();
				$(this).find('img').each(function(idx){
					$(this).parent('.autoImageResizedWrap').height($(this).height());
					var this_img_width = $(this).data('back_width');
					if(wrap_width<this_img_width){
						$(this).attr('width','100%');
						$(this).css('width','100%');
						$(this).removeAttr('height');
					}else{
						$(this).attr('width', $(this).data('back_width'));
						$(this).css('width', $(this).data('back_width'));
						$(this).attr('height', $(this).data('back_height'));
						$(this).css('height', $(this).data('back_height'));
					}
					$(this).parent('.autoImageResizedWrap').height($(this).height());
				});
			});
		});
		body.trigger('click');
	}
	$(window).load(function(){
		imageAutoResize();
	});
*/
////////////////////////////////////////////////////////////////////////////////////////////////////
}(jQuery));


/*
var file_div_selector = '#attachFileDiv div';
var first_file_length = $('#attachFileDiv div').not('div.notfile').length;
function file_add(){
	var file_len = $('#attachFileDiv div').not('div.notfile').length;
	if((file_len<max_file) || (max_file == 0) ){
		var file_html = '<div style="margin-top: 3px;"><input type="file" name="' + view3_save_file_name + '[]"></div>';
		$(file_div_selector).last().after(file_html);
	}else{
		alert('理쒕� '+max_file+'媛� 源뚯� �낅줈�� �� �� �덉뒿�덈떎');
	}
	$('input[type=file]').css({'border':'none'});
}
$(file_div_selector).each(function(){
	var add_file_row = default_file-first_file_length;
	if((max_file!=null)&&(add_file_row>0)){
			var file_len = $('#attachFileDiv div').not('div.notfile').length;
			var file_html = '<div style="margin-top: 3px;"><input type="file" name="' + view3_save_file_name + '[]"></div>';
			$(file_div_selector).last().after(file_html);
		for(i=1;i<add_file_row;i++)file_add();
	}
	$('input[type=file]').css({'border':'none'});
});
function file_delete(){
	var file_idx = $('#attachFileDiv div').not('div.notfile').length;
	if(file_idx==1){
		alert("�섎굹�� �뚯씪�� 議댁옱�댁빞 �⑸땲��.");
	}else{
		var last_obj = $('#attachFileDiv div').not('div.notfile').last();
		var count = last_obj.find('a').length;
		if(count>0){
			alert("�깅줉�� �뚯씪�� �덉뒿�덈떎.");
		}else{
			last_obj.remove();
		}
	}
}
*/
var file_div_selector1 = '#attachFileDiv';
var file_div_selector2 = '#attachFileDiv div';
var first_file_length = $('#attachFileDiv div').not('div.notfile').length;
function file_add(){
	var file_len = $('#attachFileDiv div').not('div.notfile').length;
	if((file_len<max_file) || (max_file == 0) ){
		var file_html = '<div style="margin-top: 3px;"><input type="file" name="' + view3_save_file_name + '[]"></div>';
		$(file_div_selector2).last().after(file_html);
	}else{
		alert('理쒕� '+max_file+'媛� 源뚯� �낅줈�� �� �� �덉뒿�덈떎');
	}
	$('input[type=file]').css({'border':'none'});
}
$(file_div_selector1).each(function(){
	var add_file_row = default_file-first_file_length;
//	alert(default_file+" = "+first_file_length);
	if((max_file!=null)&&(add_file_row>0)){
			var file_len = $('#attachFileDiv div').not('div.notfile').length;
			var file_html = '<div style="margin-top: 3px;"><input type="file" name="' + view3_save_file_name + '[]"></div>';
			$(file_div_selector2).last().after(file_html);
		for(i=1;i<add_file_row;i++)file_add();
	}
	$('input[type=file]').css({'border':'none'});
});
function file_delete(){
	var file_idx = $('#attachFileDiv div').not('div.notfile').length;
	if(file_idx==1){
		alert("�섎굹�� �뚯씪�� 議댁옱�댁빞 �⑸땲��.");
	}else{
		var last_obj = $('#attachFileDiv div').not('div.notfile').last();
		var count = last_obj.find('a').length;
		if(count>0){
			alert("�깅줉�� �뚯씪�� �덉뒿�덈떎.");
		}else{
			last_obj.remove();
		}
	}
}
function radio_selector(input_name, etc_class){
	$('input[name="'+input_name+'"]').each(function(){
		var name_val = $(this).attr('name');
		$(this).attr('name_back', name_val);
	});
	$('.'+etc_class+'[type="text"]').removeAttr('name');
	$(this).parent().find('.'+etc_class).removeAttr('name');
	var input_radio_all = $('input[name_back="'+input_name+'"][type="radio"]');
	var input_etc_radio = $('.'+etc_class+'[type="radio"][name_back="'+input_name+'"]');
	var input_etc_text = $('.'+etc_class+'[type="text"][name_back="'+input_name+'"]');
	//
	input_radio_all.not('.'+etc_class).change(function(){
		input_etc_text.css({'text-decoration':'line-through'});
		input_etc_text.removeAttr('name');
		input_etc_text.removeAttr('required');
		input_radio_all.attr('name',$(this).attr('name_back'));
		$(this).prop('checked',true);
	});
	input_etc_radio.change(function(){//湲고� radio媛� 諛붾�붽꼍��
		if($(this).prop('checked')){//湲고� radio媛� �좏깮�섏뿀�꾨븣
			input_etc_text.focus();//湲고� text濡� �대룞
		}
	});
	$('input[name_back="'+input_name+'"][class*="'+etc_class+'"][type="text"]').focus(function(){
		$(this).attr('required','required');
		var name_back = $(this).attr('name_back');
		input_radio_all.each(function(){
			$(this).prop('checked',false);
			$(this).removeAttr('name');
		});
		input_etc_text.css({'text-decoration':'none'});
		input_etc_text.attr('name',name_back);
		if(input_etc_radio.prop('checked')){
//			if(typeof console !== 'undefined')// console.log('�대� �좏깮��');
		}else{
			input_etc_radio.prop('checked', true);
		}
	});
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function view3_layer(temp_layer_main,temp_layer_sub, width, height){
	var show_div_main = document.getElementById(temp_layer_main);
	var show_div_sub = document.getElementById(temp_layer_sub);
	show_div_sub.style.width=width+"px";
	show_div_sub.style.height=height+"px";
	show_div_sub.style.left = "50%";
	show_div_sub.style.marginLeft = -(width/2)+"px";

	show_div_sub.style.top = "50%";
	show_div_sub.style.marginTop = -(height/2)+"px";
	if(typeof temp_layer_main !== 'undefined' && temp_layer_main !== ""){
		$('#'+temp_layer_main).show();
	}
	$('#'+temp_layer_sub).show();
}
function view3_layer_drop(temp_layer_main,temp_layer_sub){
	if(typeof temp_layer_main !== 'undefined' && temp_layer_main !== ""){
		$('#'+temp_layer_main).hide();
	}
	$('#'+temp_layer_sub).hide();
}
////////////////////////////////////////////////////////////////////////////////////////////////////

//					Vimeo Auto Resize('/plug_in/video_info/vimeo_info.ajax.php' Used)
//					Write By LeeYoonWoo

////////////////////////////////////////////////////////////////////////////////////////////////////
/*
$(document).ready(function(){
	var window_width = $(window).width();
	$('.basic_view dd iframe[src*="player.vimeo.com"]').each(function(idx){
		$(this).width('100%');
		var this_obj = $(this);
		var obj_width = $(this).width();
		var obj_src = $(this).attr('src');
		$.ajax({
			'url' : '/plug_in/video_info/vimeo_info.ajax.php',
			'data' : {'src':obj_src},
			'dataType' : 'text',
			'type' : 'POST',
			'success' : function (request){
				var json_data = eval("("+request+")");
				this_obj.attr('j_width',json_data.width);
				this_obj.attr('j_height',json_data.height);
				$(window).resize(function(){
					var obj_width = this_obj.width();
					var now_window_width = $(window).width();
					var ratio = obj_width / this_obj.attr('j_width');
					this_obj.height( (this_obj.attr('j_height')) * ratio );
				});
				$(window).trigger('resize');
			}
		});
	});
});
*/
////////////////////////////////////////////////////////////////////////////////////////////////////

//					Youtube Auto Replace & Resize('/plug_in/video_info/youtube_info.ajax.php' Used)
//					Write By LeeYoonWoo

////////////////////////////////////////////////////////////////////////////////////////////////////
/*
$(document).ready(function(){
	var window_width = $(window).width();
	var vimeo_after = false;
	$('.basic_view dd embed[src*="www.youtube.com/"]').each(function(){
		var check_src = $(this).attr('src');
		var check_src_q_array = check_src.split('?');
		var check_src_q = check_src_q_array[0];
		var check_src_s_array =  check_src_q.split('/');
		var check_src_s =  check_src_s_array.pop();
		$(this).replaceWith('<iframe width="100%" height="315" src="//www.youtube.com/embed/'+check_src_s+'" frameborder="0" allowfullscreen></iframe>');
	});
	$('.basic_view dd iframe[src*="www.youtube.com"]').each(function(idx){
		$(this).width('100%');
		var this_obj = $(this);
		var obj_width = this_obj.width();
		var check_src = this_obj.attr('src');
		var check_src_q_array = check_src.split('?');
		var check_src_q = check_src_q_array[0];
		var check_src_s_array =  check_src_q.split('/');
		var check_src_s =  check_src_s_array.pop();
		$.ajax({
			'url' : '/plug_in/video_info/youtube_info.ajax.php',
			'data' : {'code':check_src_s},
			'dataType' : 'text',
			'type' : 'POST',
			'success' : function (request){
				var json_data = eval("("+request+")");
				this_obj.attr('j_width',json_data.width);
				this_obj.attr('j_height',json_data.height);
				$(window).resize(function(){
					var obj_width = this_obj.width();
					var now_window_width = $(window).width();
					var ratio = obj_width / this_obj.attr('j_width');
					this_obj.height( (this_obj.attr('j_height')) * ratio );
				});
				$(window).trigger('resize');
			}
		});
	});
});
*/
////////////////////////////////////////////////////////////////////////////////////////////////////
/*
function imageAutoResize(){//�대�吏� �ш린 �먮룞 蹂�寃�
	var body = $('body'),
		win = $(window);
	var auto_img_class = ".auto_imageresize, .viewCon";//媛먯떥怨� �덈뒗寃껋씠 div �볦씠 媛� 湲곗�
	body.click(function(){
		$(auto_img_class).find('img').each(function(){
			$(this).css({'width':'','height':''});
			$(this).removeAttr('height width');
			$(this).data('back_width',$(this).width());
			$(this).data('back_height',$(this).height());
		});
		win.trigger('resize');
	});
	win.resize(function(){
		$(auto_img_class).each(function(idx){
			var _idx = idx;
			$(this).find('img:not(:visible)').addClass('autoImageResized').hide();
			var wrap_width = $(this).width();
			$(this).find('.autoImageResized').show();
			$(this).find('img').each(function(idx){
				var this_img_width = $(this).data('back_width');
				if(wrap_width<this_img_width){
					$(this).attr('width','100%');
					$(this).css('width','100%');
					$(this).removeAttr('height');
				}else{
					$(this).attr('width', $(this).data('back_width'));
					$(this).css('width', $(this).data('back_width'));
					$(this).attr('height', $(this).data('back_height'));
					$(this).css('width', $(this).data('back_width'));

				}
			});
		});
	});
	body.trigger('click');
	win.trigger('resize');
}
$(window).load(function(){
	imageAutoResize();
});

*/