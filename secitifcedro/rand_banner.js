/**
Script de banner Rotativo Randomico
Autor: José Ailton
*/
//init_banner(id da div, maximo de image, largura, altura)
function init_banner(id_div,max_img,larg, altu)
{
	maximo_imagem = max_img;
	largura = larg;
	altura = altu;
	bannerBanner = document.getElementById(id_div);
	for(x=1;x<=maximo_imagem;x++)
	{
		bannerBanner.innerHTML += "<img id=\"" + id_div + x +"\" src=\"banner_patr/" + x + ".png\" width=\""+ largura +"\" height=\""+ altura +"\" style=\"display:none;\" />";
	}
}
function randShow(id_div,max_img){
	numRand = Math.floor(Math.random()*max_img)+1;
	for(x=1;x<=max_img;x++)
	{
		document.getElementById(id_div + x).style.display = "none";
	}
	document.getElementById(id_div + numRand).style.display = "block";
}
function rand_banner(id_div,max_img,largura,altura,tempo)
{
	init_banner(id_div,max_img,largura,altura);
	randShow(id_div,max_img);
    setInterval("randShow('"+ id_div +"',"+ max_img +")",tempo*1000);
}