// Banner Rotativo Adaptado por Jose Ailton B. S.


/* INICIO Script de Efeito Fade */
function fadeOut(id, time, callback, args) {
    fade(id, time, 100, 0, callback, args);
}
function fadeIn(id, time, callback, args) {
    fade(id, time, 0, 100, callback, args);
}
function fade(id, time, ini, fin, callback, args) {
    var target = document.getElementById(id);
    var alpha = ini;
    var inc;
    if (fin >= ini) { 
        inc = 2; 
    } else {
        inc = -2;
    }
    timer = (time * 1000) / 50;
    var i = setInterval(
        function() {
            if ((inc > 0 && alpha >= fin) || (inc < 0 && alpha <= fin)) {
                clearInterval(i);
				setTimeout(callback, args);
            }
            setAlpha(target, alpha);
            alpha += inc;
        }, timer);
}
function setAlpha(target, alpha) {
	target.style.filter = "alpha(opacity="+ alpha +")";
	target.style.opacity = alpha/100;
}
/* FIM Script de Efeito Fade */
/* INICIO Script de Efeito Fade by Ailton*/
banner = new Array(4);
for(x=0;x<4;x++){
	banner[x] = new Image();
	banner[x].src = "banners/" + (x+1) + ".jpg";
}
ban1 = 1;
ban2 = 0; //
function mudaImg(){
	document.getElementById("banner1").style.backgroundImage = "url("+ banner[ban1].src +")";
document.getElementById("banner2").style.backgroundImage = "url("+ banner[ban2].src +")";
}
contador = 0;
function rotator(){
	switch (contador) {
		case 0:
			ban1=1;
			ban2=0;
			mudaImg();
			fadeOut("banner2",2,rotator,5000);
			break;
		case 1:
			ban1=1;
			ban2=2;
			mudaImg();
			fadeIn("banner2",2,rotator,5000);
			break;
		case 2:
			ban1=3;
			ban2=2;
			mudaImg();
			fadeOut("banner2",2,rotator,5000);
			break;
		case 3:
			ban1=3;
			ban2=0;
			mudaImg();
			fadeIn("banner2",2,rotator,5000);
	}
	contador++;
	if(contador==4) contador = 0;
	
}
rotator();
/* FIM Script de Efeito Fade by Ailton*/