BX.ready(function(){
	//Объект с параметрами
	if (typeof bfg_happynewyear !== 'object') {
		return;
	}
	
	function supportCSS(prop) {
		var yes = false; // по умолчанию ставим ложь
		if('Moz'+prop in document.body.style) {
			yes = true; // если FF поддерживает, то правда
		}
		if('webkit'+prop in document.body.style) {
			yes = true; // если Webkit поддерживает, то правда
		}
		if('ms'+prop in document.body.style) {
			yes = true; // если IE поддерживает, то правда
		}
		if(prop in document.body.style) {
			yes = true; // если поддерживает по умолчанию, то правда
		}
		return yes; // возращаем ответ
	}
	
	function getCookie(name) {
		var matches = document.cookie.match(new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
				));
		return matches ? decodeURIComponent(matches[1]) : undefined;
	}

	function setCookie(name, value, options) {
		options = options || {
			expires: 360000000,
			path: '/'
		};

		var expires = options.expires;

		if (typeof expires == "number" && expires) {
			var d = new Date();
			d.setTime(d.getTime() + expires * 1000);
			expires = options.expires = d;
		}
		if (expires && expires.toUTCString) {
			options.expires = expires.toUTCString();
		}

		value = encodeURIComponent(value);

		var updatedCookie = name + "=" + value;

		for (var propName in options) {
			updatedCookie += "; " + propName;
			var propValue = options[propName];
			if (propValue !== true) {
				updatedCookie += "=" + propValue;
			}
		}
		document.cookie = updatedCookie;
	}

	
	function init() {
		
		if (
				bfg_happynewyear.snow.active && 
				( (!isAdminArea) || bfg_happynewyear.snow.adminShow ) &&
				( (!bfg_happynewyear.snow.showMainPageOnly) || isMainPage)
			) {
			initSnow();
		}
		if (bfg_happynewyear.background.active && (!isAdminArea) ) {
			initBackground();
		}
		if (bfg_happynewyear.postcard.active  && (!isAdminArea) ) {
			initPostcard();
		}
	}
	
	function initSnow() {
		if (typeof particlesJS !== 'function') {
			return;
		}
		var isPossible = supportCSS('pointerEvents') && supportCSS('flex') && (typeof requestAnimationFrame === 'function'); //flex - чтобы отрубить ie < 11
		if (isPossible) {
			var id = 'bfg_happynewyear_particles-js';
			jQuery('body').prepend('<div id="'+id+'"></div>');
			particlesJS(id,bfg_happynewyear.snow.particlesParams);
			if (bfg_happynewyear.snow.snowCheckFps) {
				requestAnimationFrame(snowCheckFps);
			}
		}
	}
	
	function initBackground() {
		if (bfg_happynewyear.background.type === 'color') {
			jQuery('body').css('background-color',bfg_happynewyear.background.color);
		} else if (bfg_happynewyear.background.type === 'img') {
			jQuery('body').css('background-image','url("'+bfg_happynewyear.background.img.src+'")');
			jQuery('body').css('background-position',bfg_happynewyear.background.imgPosition);
			jQuery('body').css('background-repeat',bfg_happynewyear.background.imgRepeat);
		}
	}
	
	function initPostcard() {
		if (supportCSS('flex')) {
			//Показываем 1 раз
			var img = bfg_happynewyear.postcard.img.src;
			if (getCookie('bfg_happynewyear_Postcard') === img) {
				return;
			}
			setCookie('bfg_happynewyear_Postcard',img);
			
			var imgClose = '/bitrix/images/'+bfg_happynewyear.dirName+'/close.png';
			if (bfg_happynewyear.postcard.imgClose) {
				imgClose = bfg_happynewyear.postcard.imgClose.src;
			}
			jQuery('body').append(
				'<div class="bfg_happynewyear_Postcard">'+
					'<div style="background-color:'+bfg_happynewyear.postcard.background+'; opacity: 0.9;"></div>'+
					'<div><div>'+
						'<img src="'+img+'">'+
						'<a href="#">'+
							'<img src="'+imgClose+'">'+
						'</a>'+
					'</div></div>'+
				'</div>'
			);
			jQuery('.bfg_happynewyear_Postcard a').on('click',function(e){
				e.preventDefault();
				jQuery('.bfg_happynewyear_Postcard').remove();
			});
			jQuery('.bfg_happynewyear_Postcard').on('click',function(){
				jQuery('.bfg_happynewyear_Postcard').remove();
			});
		}
	}
	
	//Параметры
	var isAdminArea = ((document.location.href+'').search(/\/\/[\w\.\-]+\/bitrix/) != -1);
	var isMainPage = ((document.location.href+'').search(/\/\/[\w\.\-]+\/?((\?.*)|$)/) != -1);
	
	//Проверим jQuery
	if(typeof jQuery=='undefined') {
		var headTag = document.getElementsByTagName("head")[0];
		var jqTag = document.createElement('script');
		jqTag.type = 'text/javascript';
		jqTag.src = '/bitrix/js/'+bfg_happynewyear.dirName+'/jquery.js';
		jqTag.onload = init;
		headTag.appendChild(jqTag);
	} else {
		init();
	}
	
	var frames = 0;
	var countBadFps = 0;
	var prevTimeCheck = Date.now();
	
	function snowCheckFps() {
		var time = Date.now();
		frames ++;
		if ( time > prevTimeCheck + 100 ) {
			var fps = Math.round( ( frames * 1000 ) / ( time - prevTimeCheck ) );
			if (fps < 20) {
				countBadFps++;
				if (countBadFps >= 5) {
					var pJS = window.pJSDom[0].pJS;
					cancelRequestAnimFrame(pJS.fn.checkAnimFrame);
					cancelRequestAnimFrame(pJS.fn.drawAnimFrame);
					pJS.tmp.source_svg = undefined;
					pJS.tmp.img_obj = undefined;
					pJS.tmp.count_svg = 0;
					pJS.fn.particlesEmpty();
					pJS.fn.canvasClear();
					$('#bfg_happynewyear_particles-js').remove();
				}
			} else {
				countBadFps = 0;
			}
			prevTimeCheck = time;
			frames = 0;
		}
		requestAnimationFrame(snowCheckFps);
	}
});