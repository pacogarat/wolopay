function Slider(toSlideId, containerId, rows, sidesPadding) {
    var that = this;
    this.rows = rows;
    this.sidesPadding = sidesPadding;

    var reCalculateObjects = function()
    {
        that.elementToSlide = $(toSlideId);
        that.container = $(containerId);
        that.items = that.elementToSlide.find(".item");

        that.outerWrap = that.elementToSlide.find(".outer-wrapper");
        that.innerWrap = that.elementToSlide.find(".inner-wrapper");
        that.arrow_left = that.elementToSlide.find(".arrow-left");
        that.arrow_right = that.elementToSlide.find(".arrow-right");
//        console.log(that.items.length);

        if (that.items.length > 0)
        {
            that.itemsWidth = that.items[0].offsetWidth;
        }else{
            that.itemsWidth = 155;
        }
        that.totalItems = that.items.length;
        that.totalItems = that.items.length;
        var wrapperWidth = that.container.width();

//        that.arrowSize = wrapperWidth > 768 ? 60 : 0;
        that.arrowSize = 0;

        that.wrapperInnerWidth = that.outerWrap[0].offsetWidth;

        var itemsPerScreen = Math.floor(that.wrapperInnerWidth / that.itemsWidth);
        that.itemsPerScreen = itemsPerScreen;

        that.marginPerItem = ((that.wrapperInnerWidth - (that.itemsWidth * itemsPerScreen)) / itemsPerScreen) / 2;

        that.totalWidth = (that.itemsWidth + (that.marginPerItem * 2)) * that.totalItems;
        that.maxImages = Math.ceil((that.totalItems/ that.rows) / itemsPerScreen);

//        console.log("wrapper width", that.wrapperInnerWidth, "Items per screen", itemsPerScreen, "item width", that.itemsWidth);
    };

    this.setArrowEnabled = function (arrowObject)
    {
        arrowObject.addClass('enabled');
    };
    this.setArrowDisabled = function (arrowObject)
    {
        arrowObject.removeClass('enabled');
    };

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
    };

    this.goToNumImage = function (numImage)
    {
        var page = numImage/ this.rows /that.itemsPerScreen;

        for(var i=1; i<page; i++)
        {
            this.nextImage();
        }

    };

    this.nextImage = function () {
        that.currentImg = Math.min(that.currentImg + 1, that.maxImages - 1);
        that.scrollImages(that.wrapperInnerWidth * that.currentImg, that.speed);
    };

    this.scrollImages = function (distance, duration) {

        if (distance > 10 && this.rows > 1)
        {
            distance-=280;
        }

        var value = (distance < 0 ? "" : "-") + Math.abs(distance).toString();

        TweenMax.to(that.innerWrap, (duration / 1000).toFixed(1), {left: value});

        setTimeout(function(){ that.arrowsVisibleDetect(); }, 200);

    };

    this.arrowsVisibleDetect = function ()
    {
        reCalculateObjects();

        if (that.currentImg <= 0) {
            TweenMax.to(that.arrow_left, .3);
            that.setArrowDisabled(that.arrow_left);
//            console.log('arrow left disabled');
        } else {
            TweenMax.to(that.arrow_left, .3);
            that.setArrowEnabled(that.arrow_left);
//            console.log('arrow left enabled');
        }

        if (that.currentImg >= that.maxImages - 1) {
            TweenMax.to(that.arrow_right, .3);
            that.setArrowDisabled(that.arrow_right);
//            console.log('arrow right disabled');
        } else {
            TweenMax.to(that.arrow_right, .3);
            that.setArrowEnabled(that.arrow_right);
//            console.log('arrow right enabled');
        }
    };

    this.arrow_left.click(function () {
        that.previousImage();
    });


    this.arrow_right.click(function () {
        that.nextImage();
    });


    this.resize = function () {
        reCalculateObjects();
        that.currentImg = 0;

        if (that.sidesPadding || that.itemsPerScreen <= 3)
        {
            var marginPerItemSide = Math.round((that.marginPerItem*that.itemsPerScreen*0.85)*100) / 100,
                marginPerItemMid = ((that.itemsPerScreen * that.marginPerItem) - marginPerItemSide) / that.itemsPerScreen;

            for (var i=0; i<= that.rows; i++)
            {
                $.each(that.elementToSlide.find(".separator_"+i+" .item"), function( index, value ){
                    index = index +1;
                    if (index==0 || index % that.itemsPerScreen == 1)
                    {
                        $(value).css("margin-right", marginPerItemMid + "px");
                        $(value).css("margin-left", marginPerItemSide + "px");

                    }else if (index % that.itemsPerScreen == 0){
                        $(value).css("margin-right", marginPerItemSide + "px");
                        $(value).css("margin-left", marginPerItemMid + "px");
                    }else{
                        $(value).css("margin-right", marginPerItemMid + "px");
                        $(value).css("margin-left", marginPerItemMid + "px");
                    }
                });
            }

        }else{
            that.items.css("margin", "0 " + that.marginPerItem + "px 0 " + that.marginPerItem + "px");
        }

//        if (that.totalWidth < that.wrapperInnerWidth)
//            that.outerWrap.width(that.wrapperInnerWidth);
//        else
//            that.outerWrap.width(that.totalWidth);



        that.arrowsVisibleDetect();

        setTimeout(function(){
            that.innerWrap.css("width", that.totalWidth + 100);
        }, 800);

        that.innerWrap.swipe("disable");
        that.innerWrap.swipe("enable");
    };

    this.restartPosition = function () {
        that.scrollImages(0 , 0);
        that.currentImg = 0;
    };

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
    this.restartPosition();


    that.innerWrap.swipe({
        triggerOnTouchEnd: true,
        fingers: 1,
        swipeStatus: that.swipeEventStatus,
        threshold: 75,
        allowPageScroll: "vertical",
        triggerOnTouchLeave: function(e){}
    });

    this.dispose = function () {

        that.arrow_right.unbind();
        that.arrow_left.unbind();

        that.setArrowDisabled(that.arrow_right);
        that.setArrowDisabled(that.arrow_left);

        that.innerWrap.swipe("destroy");
    };

}