require.config({
    paths:{
        jquery:'jquery-1.12.4'
    }
});
require(["jquery","./carousel"],function ($, Carousel){
    var settings1 = {
        selector : "#container1",
        imgArr : ["img/1.jpg","img/2.jpg","img/3.jpg","img/4.jpg"],
        speed : 1000,
        btnStyle : "square",
        arrowPos : "bottom"
    };
    var carousel1 = new Carousel(settings1);
    carousel1.init();

    var settings2 = {
        selector : "#container2",
        imgArr : ["img/1.jpg","img/2.jpg","img/4.jpg"],
        speed : 1500,
        btnStyle : "circle",
        arrowPos : "center"
    };
    var carousel2 = new Carousel(settings2);
    carousel2.init();
});