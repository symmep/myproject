require.config({
    paths:{
        jquery:'jquery-1.12.4'
    }
});
require(["jquery","./carousel"],function ($, Carousel){
    var settings1 = {
        selector : "#container1",
        imgArr : ["img/1.webp","img/2.webp","img/3.webp","img/4.webp"],
        speed : 1000,
        btnStyle : "square",
        arrowPos : "bottom"
    };
    var carousel1 = new Carousel(settings1);
    carousel1.init();

    var settings2 = {
        selector : "#container2",
        imgArr : ["img/1.webp","img/2.webp","img/4.webp"],
        speed : 1500,
        btnStyle : "circle",
        arrowPos : "center"
    };
    var carousel2 = new Carousel(settings2);
    carousel2.init();
});