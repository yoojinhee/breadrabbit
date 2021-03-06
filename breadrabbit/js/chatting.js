
var chatManager = new function(){

	var idle 		= true;
	var interval	= 500;
	var xmlHttp		= new XMLHttpRequest();  //서버와 상호작용하기 위함
	var finalDate	= '';
	var chat_group_id          = -1;

	this.getId= function(id){
		chat_group_id=id;
		//alert(chat_group_id);
	}
	// Ajax Setting
	//서버 응답에 따른 로직 작성
	xmlHttp.onreadystatechange = function()
	{
		if (xmlHttp.readyState == XMLHttpRequest.DONE && xmlHttp.status == 200)
		{
			//debugger;
			// JSON 포맷으로 Parsing
			// 인자로 전달된 문자열을 자바스크립트의 데이터로 변환
			//console.log(xmlHttp.responseText); 
			//console.log(JSON.parse(xmlHttp.responseText));
			
			res = JSON.parse(xmlHttp.responseText);
			finalDate = res.date;
			
			// 채팅내용 보여주기
			chatManager.show(res.data);
			
			//console.log("date = " + res.date);
			//console.log("date" + res.data[i].name);
			//console.log("date" + res.data[i].msg);
			// 중복실행 방지 플래그 OFF
			idle = true;
		}
	}

	// 채팅내용 가져오기
	this.proc = function()
	{
		//alert(chat_group_id);
		// 중복실행 방지 플래그가 ON이면 실행하지 않음
		if(!idle)
		{
			return false;
		}

		// 중복실행 방지 플래그 ON
		idle = false;
		
		// Ajax 통신
		xmlHttp.open("GET", "chatting_proc.php?id="+chat_group_id+"&date=" + encodeURIComponent(finalDate), true);
		xmlHttp.send();
	}

	// 채팅내용 보여주기
	this.show = function(data)
	{
		console.log("Show 함수 들어옴");

		var o = document.getElementById('list');
		var dt, dd;

		// 채팅내용 추가
		for(var i=0; i<data.length; i++)
		{
			console.log("for문 들어옴");

			dt = document.createElement('dt');
			dt.appendChild(document.createTextNode(data[i].name));
			o.appendChild(dt);

			dd = document.createElement('dd');
			dd.appendChild(document.createTextNode(data[i].msg));
			o.appendChild(dd);

			console.log("date[].name : "+data[i].name);
			console.log("date[].msg : "+data[i].msg);

		}

		// 가장 아래로 스크롤
		o.scrollTop = o.scrollHeight;
	}

	// 채팅내용 작성하기
	this.write = function(frm)
	{
		var xmlHttpWrite	= new XMLHttpRequest();
		var name			= frm.name.value;
		var msg				= frm.msg.value;
		var chat_group_id	= frm.chat_group_id.value;
		var param			= [];
		
		// 이름이나 내용이 입력되지 않았다면 실행하지 않음
		if(name.length == 0 || msg.length == 0)
		{
			return false;
		}
		// POST Parameter 구축
		param.push("name=" + encodeURIComponent(name));
		param.push("msg=" + encodeURIComponent(msg));
		param.push("chat_group_id=" + encodeURIComponent(chat_group_id));
				
		// Ajax 통신
		xmlHttpWrite.open("POST", "chatting_write.php", true);
		xmlHttpWrite.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //body 인코딩이 해당 framework 혹은 library에서 자동으로 되는지 확인 후 안되면 해줘야한다.
		xmlHttpWrite.send(param.join('&'));
		
		// 내용 입력란 비우기
		frm.msg.value = '';
		
		// 채팅내용 갱신
		chatManager.proc();
	}

	// interval에서 지정한 시간 후에 실행
	setInterval(this.proc, interval);
}