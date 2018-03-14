require.config({
    paths:{
        jquery:'jquery-1.12.4'
    }
});
define(["jquery"],function($){
    function Carousel(settings) {
        this.$container = $('<div class="carousel-container"></div>');
        this.$nav = $('<ul class="carousel-nav"></ul>');
        this.$imgs = $('<div class="carousel-imgs"></div>');
        this.$arrows = $('<div class="carousel-arrows"></div>');
        this.$prev = $('<span class="arrows-prev">&lt;</span>');
        this.$next = $('<span class="arrows-next">&gt;</span>');
        this.defaultSettings = {
            selector : document.body,
            imgArr : [],
            speed : 1000,
            btnStyle : "square",
            arrowPos : "bottom"
        };
        $.extend(this.defaultSettings, settings);

        // console.log(settings);

    }
    Carousel.prototype.init = function () {
        $(this.defaultSettings.selector).append(this.$container);
        this.$container.append(this.$nav).append(this.$imgs).append(this.$arrows);
        this.$arrows.append(this.$next).append(this.$prev);
        for(var i=0 ; i < this.defaultSettings.imgArr.length; i++){
            var $li = $("<li></li>").html(i + 1);
            this.$nav.append($li);

            var $img = $("<img />").attr("src",this.defaultSettings.imgArr[i]);
            this.$imgs.append($img);
        }
        if(this.defaultSettings.btnStyle == "circle"){
            $("li", this.$nav).html("").css({
                borderRadius : "50%"
            });
        }
        this.$prev.addClass(this.defaultSettings.arrowPos);
        this.$next.addClass(this.defaultSettings.arrowPos);

        $("img", this.$imgs).eq(0).addClass("selected");
        $("li", this.$nav).eq(0).addClass("selected");


        var nowIndex = 0;
        $("li",this.$nav).on("mouseover",function (e) {
            nowIndex = $(e.target).index();
            changeImg.call(this);
        }.bind(this));
        this.$prev.on("click",function () {
           nowIndex--;
           if(nowIndex == -1){
               nowIndex = this.defaultSettings.imgArr.length - 1 ;
           }
           changeImg.call(this);
        }.bind(this));
        this.$next.on("click",function () {
           nowIndex++;
           if(nowIndex == this.defaultSettings.imgArr.length){
               nowIndex = 0;
           }
           changeImg.call(this);
        }.bind(this));
        var time;
        this.$container.hover(function () {
            clearInterval(timer);
        },function () {
            play.call(this);
        }.bind(this));
        play.call(this);


        function changeImg() {
            $("li",this.$nav).eq(nowIndex).addClass("selected").siblings().removeClass("selected");
            $("img",this.$imgs).eq(nowIndex).addClass("selected").siblings().removeClass("selected");
        }
        function play() {
            timer = setInterval(function () {
                this.$next.trigger("click");
            }.bind(this),this.defaultSettings.speed);
        }
    };
    return Carousel;
});