function sao(){
	window.href="http://sao315.com/w/api/saoyisao"
}
function san_ok(){
	mdui.dialog({
	  title: '~\\(≧▽≦)/~还伞成功！',
	  content: "谢谢您对爱心伞的呵护，欢迎您下次再来，俺们爱心伞罩您！",
	  buttons: [{ text: '✧( ु•⌄• )◞◟( •⌄• ू )✧ ❤我记住啦！' }]
	});
}
function san_no(){
	mdui.dialog({
	  title: '借伞bu成功！',
	  content: "大王，不小心出故障了，要重新操作借伞！",
	  buttons: [{ text: '朕知道了' }]
	});
}
// 清空内容
function clear_content() {
	document.getElementById("san_id_qr").innerHTML = "";
}
// 获得填写信息
function san_getinfo(){
	var san_objectId = document.getElementById("san_objectId").innerHTML;
	var san_order = document.getElementById("san_id_qr").innerHTML;
	var san_place = $("#san_place option:selected").text();
	res = '{"san_objectId":"'+san_objectId+'","san_order":"'+san_order+'","san_place":"'+san_place+'"}'
	var obj = eval('('+res+')');
	return obj
};
// 填写内容两种情况判断
function san_ok_check(argument) {
	san = san_getinfo()
	if(san.san_order!=""&san.san_place!="2.请选择还伞地址："){
		san_confirm()
	}else{
		san_fill()
	}
}
function san_confirm() {
	var san_confirm_dialog = new mdui.Dialog('#san_confirm');
	var san_id_qr=document.getElementById('san_id_qr').innerHTML;//div没有value，要用innerHTML
	document.getElementById('san_ok_content').innerHTML="请确认爱心伞伞号为【"+san_id_qr+"】，并且<b>没有损坏</b>哦！";
	san_confirm_dialog.open();
}
function san_fill() {
	var san_confirm_dialog = new mdui.Dialog('#san_fill');
	san_confirm_dialog.open();
}

function san_order_state_change(objectId) {
	Bmob.initialize("826cd8537061508f02fdd28d8739bc38","17e587def0429c2653ca3418ad1068f6");
	order_table = "san_order"
	const state = Bmob.Query(order_table);
	state.get(objectId).then(res => {
	  console.log(res)
	  res.set('san_state','0')
	  res.save()
	}).catch(err => {
	  console.log(err)
	})

}

function san_ok_up() {
	san = san_getinfo()
	san_order_state_change(san.san_objectId)
	
	Bmob.initialize("826cd8537061508f02fdd28d8739bc38","17e587def0429c2653ca3418ad1068f6");
	history_table = "san_history"
	const query = Bmob.Query(history_table);
	query.set("san_order",san.san_order)
	query.set("san_place",san.san_place)
	query.set("method","归还")
	query.save().then(res => {
		// alert("上传数据成功")
		san_ok()
		okkk = "爱心伞【"+san.san_order+"】已被归还";
		document.getElementById('first1').innerHTML=okkk;
		document.getElementById('first2').innerHTML=okkk;
		// document.getElementById('second').innerHTML=okkk;
		document.getElementById('five1').innerHTML=okkk;
		document.getElementById('five2').innerHTML=okkk;
	}).catch(err => {
	// alert("上传数据失败")
	  san_no()
	})
}








