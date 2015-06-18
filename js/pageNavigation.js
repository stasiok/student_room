function generatePage(data){//функция отвечает за генерацию страницы
	$(document).scrollTop(0);
	if(USER!=null && data.user==null){
		window.location=url;
		return false
	}
	if(SITE_VERSION!=data.SITE_VERSION){
		window.location=url;
		return false
	}
	if(data.leftMenu==null){
		$('body').addClass("fullWidth");
	}else{
		$('#leftMenu').html(data.leftMenu);
		$('body').removeClass("fullWidth");
	}
	$('#content').html(data.content);
	document.title = data.title;
	$('#mainMenu a.active, #rightMenu .active').removeClass('active');
	if(data.mainMenu>=0){
		$('#mainMenu a').eq(data.mainMenu).addClass('active');
		$('header').css({'border-color':'#CE5C09'});
	}else{
		$('header').css({'border-color':'#454545'});
	}
	setTimeout(data.js, 0);
	$('#content a, #leftMenu a').click(function(){
		if($(this).attr('data-nop')!="NOP"){
			goToPage($(this).attr('href'));
			return false
		}
	});
}
function pageAction(param){//функция отвечает за события на странице
	console.log(param);
}
function goToPage(url){//функция обработчик переходов по ссылкам
	
	var thisPathname=window.location.pathname+'';//текущий адрес
	var thisSearch=window.location.search+'';//текущие параметры
	
	var parseUrl=url.split('?');
	
	var urlPathname=parseUrl[0];//будующий адрес
	var urlSearch=parseUrl[1];//будующие параметры
	
	if(typeof(urlSearch)=="undefined"){urlSearch='';}else{urlSearch='?'+urlSearch;}
	// if(!(urlPathname==thisPathname)){
		$.ajax({
			url:"/ajax.php",
			data:{uri:url},
			dataType: "json",
			cache:false,
			async:false,
			success:function(result){
				generatePage(result);
				history.pushState({uri:url,data:result}, null, url);
			},
			error:function(){
				error('При выполнении ajax-запроса произошла ошибка.');
			}
		});
	// }
	// if(urlSearch!=thisSearch){
		pageAction(parseGetParams());
		// history.pushState({uri:url,data:history.state.data}, null, url);
	// }
}
$(document).ready(function(){
	var pageUrl=window.location.pathname+window.location.search;
	$(window).bind('load',function(event){
		$.ajax({
			url:"/ajax.php",
			data:{uri:pageUrl},
			dataType: "json",
			cache:false,
			success:function(result){
				generatePage(result);
				pageAction(parseGetParams());
				history.replaceState({uri:pageUrl,data:result}, null, pageUrl);
			},
			error:function(){
				error('При выполнении ajax-запроса произошла ошибка.');
			}
		});
		setTimeout(function(){
			$(window).bind('popstate',function(event){
				generatePage(history.state.data);
				pageAction(parseGetParams());
			});
		},0);
	});
	$('a').click(function(){//вешаем обработчик на клик по ссылкам
		if($(this).attr('data-nop')!="NOP"){
			goToPage($(this).attr('href'));
			return false
		}
    });
});
