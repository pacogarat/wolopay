function Slider(toSlide, container) {
    var that = this;

    var reCalculateObjects = function()
    {
        that.items = that.elementToSlide.find(".item");
        that.outerWrap = that.elementToSlide.find(".outer-wrapper");
        that.innerWrap = that.elementToSlide.find(".inner-wrapper");
        that.arrow_left = that.elementToSlide.find(".arrow-left");
        that.arrow_right = that.elementToSlide.find(".arrow-right");
        if (that.items.length > 0)
        {
            that.itemsWidth = that.items[0].offsetWidth;
        }else{
            that.itemsWidth = 155;
        }
        that.totalItems = that.items.length;
    }

    this.elementToSlide = toSlide;
    this.container = container;
    this.speed = 500;
    reCalculateObjects();
    this.currentImg = 0;
    this.wrapperWidth;
    this.wrapperInnerWidth;
    this.itemsPerScreen;
    this.marginPerItem;
    this.arrowSize;
    this.maxImages;




    this.previousImage = function () {

        that.currentImg = Math.max(that.currentImg - 1, 0);
        that.scrollImages(that.wrapperInnerWidth * that.currentImg, that.speed);
    },

    this.nextImage = function () {

        that.currentImg = Math.min(that.currentImg + 1, that.maxImages - 1);
        that.scrollImages(that.wrapperInnerWidth * that.currentImg, that.speed);
    },

    this.scrollImages = function (distance, duration) {

        var value = (distance < 0 ? "" : "-") + Math.abs(distance).toString();

        TweenMax.to(that.innerWrap, (duration / 1000).toFixed(1), {left: value});

        that.arrowsVisibleDetect();
    },

    this.arrowsVisibleDetect = function ()
    {
        reCalculateObjects();

        if (that.currentImg <= 0) {
            TweenMax.to(that.arrow_left, .3, {alpha: .3});
        } else {
            TweenMax.to(that.arrow_left, .3, {alpha: 1});
        }

        if (that.currentImg >= that.maxImages - 1 || that.totalItems <= that.itemsPerScreen) {
            TweenMax.to(that.arrow_right, .3, {alpha: .3});
        } else {
            TweenMax.to(that.arrow_right, .3, {alpha: 1});
        }
    },


    this.arrow_left.click(function () {
        that.previousImage();
    });


    this.arrow_right.click(function () {
        that.nextImage();
    });


    this.resize = function () {
        reCalculateObjects();

        that.totalItems = that.items.length;
        var wrapperWidth = that.container.width();
        that.arrowSize = wrapperWidth > 700 ? 60 : 0;

        that.wrapperInnerWidth = wrapperWidth - (that.arrowSize * 2);
        var itemsPerScreen = Math.floor(that.wrapperInnerWidth / that.itemsWidth);

        var marginPerItem = ((that.wrapperInnerWidth - (that.itemsWidth * itemsPerScreen)) / itemsPerScreen) / 2;
        var totalWidth = (that.itemsWidth + (marginPerItem * 2)) * that.totalItems;
        that.maxImages = Math.ceil(that.totalItems / itemsPerScreen);

        if (itemsPerScreen == 2)
        {
            var par= null,
                marginPerItemMid=Math.round((marginPerItem*0.07)*100) / 100,
                marginPerItemSide=((marginPerItem*2)-marginPerItemMid);

            $.each( that.items, function( index, value ){
                if (par)
                {
                    $(value).css("margin-right", marginPerItemSide + "px");
                    $(value).css("margin-left", marginPerItemMid + "px");
                    par=null;
                }else{
                    $(value).css("margin-right", marginPerItemMid + "px");
                    $(value).css("margin-left", marginPerItemSide + "px");
                    par=true;
                }
            });

        }else{
            that.items.css("margin-left", "0px " + marginPerItem + "px");
            that.items.css("margin-right", "0px " + marginPerItem + "px");

        }


        that.innerWrap.width(totalWidth+100);
        that.outerWrap.width(that.wrapperInnerWidth);
//        that.previousImage();
        that.arrowsVisibleDetect();

        that.innerWrap.swipe("disable");
        that.innerWrap.swipe("enable");
    },
    this.restartPosition = function () {
        that.scrollImages(0 , 0);
        that.previousImage();
        that.previousImage();
        that.previousImage();
        that.previousImage();
    },

    this.swipeEventStatus = function (event, phase, direction, distance, fingers) {


        if (phase == "move" && (direction == "left" || direction == "right")) {

            if (direction == "left") {
                that.scrollImages((that.wrapperInnerWidth * that.currentImg) + distance, 0);
            }

            else if (direction == "right") {
                that.scrollImages((that.wrapperInnerWidth * that.currentImg) - distance, 0);
            }

        }

        else if (phase == "cancel") {
            that.scrollImages(that.wrapperInnerWidth * that.currentImg, that.speed);

        }


        else if (phase == "end") {
            if (direction == "right") {

                that.previousImage();
            }

            else if (direction == "left") {
                that.nextImage();
            }

        }
    };


    this.resize();

    that.innerWrap.swipe({
        triggerOnTouchEnd: true,
        fingers: 1,
        swipeStatus: that.swipeEventStatus,
        threshold: 75,
        allowPageScroll: "vertical"
    });

    this.dispose = function () {

        that.arrow_right.unbind();
        that.arrow_left.unbind();
        that.arrow_right.css({"opacity": 0.3});
        that.arrow_left.css({"opacity": 0.3})
        that.innerWrap.swipe("destroy");
    }

};