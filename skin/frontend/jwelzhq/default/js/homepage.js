! function(i) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], i) : "undefined" != typeof exports ? module.exports = i(require("jquery")) : i(jQuery)
}(function(i) {
    "use strict";
    var e = window.Slick || {};
    e = function() {
            function e(e, o) {
                var s, n, l, r = this;
                if (r.defaults = {
                        accessibility: !0,
                        adaptiveHeight: !1,
                        appendArrows: i(e),
                        appendDots: i(e),
                        arrows: !0,
                        asNavFor: null,
                        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="previous">Previous</button>',
                        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="next">Next</button>',
                        autoplay: !1,
                        autoplaySpeed: 3e3,
                        centerMode: !1,
                        centerPadding: "50px",
                        cssEase: "ease",
                        customPaging: function(i, e) {
                            return '<button type="button" data-role="none">' + (e + 1) + "</button>"
                        },
                        dots: !1,
                        dotsClass: "slick-dots",
                        draggable: !0,
                        easing: "linear",
                        edgeFriction: .35,
                        fade: !1,
                        focusOnSelect: !1,
                        infinite: !0,
                        initialSlide: 0,
                        lazyLoad: "ondemand",
                        mobileFirst: !1,
                        pauseOnHover: !0,
                        pauseOnDotsHover: !1,
                        respondTo: "window",
                        responsive: null,
                        rows: 1,
                        rtl: !1,
                        slide: "",
                        slidesPerRow: 1,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        speed: 500,
                        swipe: !0,
                        swipeToSlide: !1,
                        touchMove: !0,
                        touchThreshold: 5,
                        useCSS: !0,
                        variableWidth: !1,
                        vertical: !1,
                        verticalSwiping: !1,
                        waitForAnimate: !0
                    }, r.initials = {
                        animating: !1,
                        dragging: !1,
                        autoPlayTimer: null,
                        currentDirection: 0,
                        currentLeft: null,
                        currentSlide: 0,
                        direction: 1,
                        $dots: null,
                        listWidth: null,
                        listHeight: null,
                        loadIndex: 0,
                        $nextArrow: null,
                        $prevArrow: null,
                        slideCount: null,
                        slideWidth: null,
                        $slideTrack: null,
                        $slides: null,
                        sliding: !1,
                        slideOffset: 0,
                        swipeLeft: null,
                        $list: null,
                        touchObject: {},
                        transformsEnabled: !1,
                        unslicked: !1
                    }, i.extend(r, r.initials), r.activeBreakpoint = null, r.animType = null, r.animProp = null, r.breakpoints = [], r.breakpointSettings = [], r.cssTransitions = !1, r.hidden = "hidden", r.paused = !1, r.positionProp = null, r.respondTo = null, r.rowCount = 1, r.shouldClick = !0, r.$slider = i(e), r.$slidesCache = null, r.transformType = null, r.transitionType = null, r.visibilityChange = "visibilitychange", r.windowWidth = 0, r.windowTimer = null, s = i(e).data("slick") || {}, r.options = i.extend({}, r.defaults, s, o), r.currentSlide = r.options.initialSlide, r.originalSettings = r.options, (n = r.options.responsive || null) && n.length > -1) {
                    r.respondTo = r.options.respondTo || "window";
                    for (l in n) n.hasOwnProperty(l) && (r.breakpoints.push(n[l].breakpoint), r.breakpointSettings[n[l].breakpoint] = n[l].settings);
                    r.breakpoints.sort(function(i, e) {
                        return !0 === r.options.mobileFirst ? i - e : e - i
                    })
                }
                "undefined" != typeof document.mozHidden ? (r.hidden = "mozHidden", r.visibilityChange = "mozvisibilitychange") : "undefined" != typeof document.webkitHidden && (r.hidden = "webkitHidden", r.visibilityChange = "webkitvisibilitychange"), r.autoPlay = i.proxy(r.autoPlay, r), r.autoPlayClear = i.proxy(r.autoPlayClear, r), r.changeSlide = i.proxy(r.changeSlide, r), r.clickHandler = i.proxy(r.clickHandler, r), r.selectHandler = i.proxy(r.selectHandler, r), r.setPosition = i.proxy(r.setPosition, r), r.swipeHandler = i.proxy(r.swipeHandler, r), r.dragHandler = i.proxy(r.dragHandler, r), r.keyHandler = i.proxy(r.keyHandler, r), r.autoPlayIterator = i.proxy(r.autoPlayIterator, r), r.instanceUid = t++, r.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, r.init(!0), r.checkResponsive(!0)
            }
            var t = 0;
            return e
        }(), e.prototype.addSlide = e.prototype.slickAdd = function(e, t, o) {
            var s = this;
            if ("boolean" == typeof t) o = t, t = null;
            else if (0 > t || t >= s.slideCount) return !1;
            s.unload(), "number" == typeof t ? 0 === t && 0 === s.$slides.length ? i(e).appendTo(s.$slideTrack) : o ? i(e).insertBefore(s.$slides.eq(t)) : i(e).insertAfter(s.$slides.eq(t)) : !0 === o ? i(e).prependTo(s.$slideTrack) : i(e).appendTo(s.$slideTrack), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slides.each(function(e, t) {
                i(t).attr("data-slick-index", e)
            }), s.$slidesCache = s.$slides, s.reinit()
        }, e.prototype.animateHeight = function() {
            var i = this;
            if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
                var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
                i.$list.animate({
                    height: e
                }, i.options.speed)
            }
        }, e.prototype.animateSlide = function(e, t) {
            var o = {},
                s = this;
            s.animateHeight(), !0 === s.options.rtl && !1 === s.options.vertical && (e = -e), !1 === s.transformsEnabled ? !1 === s.options.vertical ? s.$slideTrack.animate({
                left: e
            }, s.options.speed, s.options.easing, t) : s.$slideTrack.animate({
                top: e
            }, s.options.speed, s.options.easing, t) : !1 === s.cssTransitions ? (!0 === s.options.rtl && (s.currentLeft = -s.currentLeft), i({
                animStart: s.currentLeft
            }).animate({
                animStart: e
            }, {
                duration: s.options.speed,
                easing: s.options.easing,
                step: function(i) {
                    i = Math.ceil(i), !1 === s.options.vertical ? (o[s.animType] = "translate(" + i + "px, 0px)", s.$slideTrack.css(o)) : (o[s.animType] = "translate(0px," + i + "px)", s.$slideTrack.css(o))
                },
                complete: function() {
                    t && t.call()
                }
            })) : (s.applyTransition(), e = Math.ceil(e), o[s.animType] = !1 === s.options.vertical ? "translate3d(" + e + "px, 0px, 0px)" : "translate3d(0px," + e + "px, 0px)", s.$slideTrack.css(o), t && setTimeout(function() {
                s.disableTransition(), t.call()
            }, s.options.speed))
        }, e.prototype.asNavFor = function(e) {
            var t = this,
                o = t.options.asNavFor;
            o && null !== o && (o = i(o).not(t.$slider)), null !== o && "object" == typeof o && o.each(function() {
                var t = i(this).slick("getSlick");
                t.unslicked || t.slideHandler(e, !0)
            })
        }, e.prototype.applyTransition = function(i) {
            var e = this,
                t = {};
            t[e.transitionType] = !1 === e.options.fade ? e.transformType + " " + e.options.speed + "ms " + e.options.cssEase : "opacity " + e.options.speed + "ms " + e.options.cssEase, !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
        }, e.prototype.autoPlay = function() {
            var i = this;
            i.autoPlayTimer && clearInterval(i.autoPlayTimer), i.slideCount > i.options.slidesToShow && !0 !== i.paused && (i.autoPlayTimer = setInterval(i.autoPlayIterator, i.options.autoplaySpeed))
        }, e.prototype.autoPlayClear = function() {
            var i = this;
            i.autoPlayTimer && clearInterval(i.autoPlayTimer)
        }, e.prototype.autoPlayIterator = function() {
            var i = this;
            !1 === i.options.infinite ? 1 === i.direction ? (i.currentSlide + 1 === i.slideCount - 1 && (i.direction = 0), i.slideHandler(i.currentSlide + i.options.slidesToScroll)) : (0 == i.currentSlide - 1 && (i.direction = 1), i.slideHandler(i.currentSlide - i.options.slidesToScroll)) : i.slideHandler(i.currentSlide + i.options.slidesToScroll)
        }, e.prototype.buildArrows = function() {
            var e = this;
            !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow = i(e.options.prevArrow), e.$nextArrow = i(e.options.nextArrow), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.appendTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled"))
        }, e.prototype.buildDots = function() {
            var e, t, o = this;
            if (!0 === o.options.dots && o.slideCount > o.options.slidesToShow) {
                for (t = '<ul class="' + o.options.dotsClass + '">', e = 0; e <= o.getDotCount(); e += 1) t += "<li>" + o.options.customPaging.call(this, o, e) + "</li>";
                t += "</ul>", o.$dots = i(t).appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active").attr("aria-hidden", "false")
            }
        }, e.prototype.buildOut = function() {
            var e = this;
            e.$slides = e.$slider.children(":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function(e, t) {
                i(t).attr("data-slick-index", e).data("originalStyling", i(t).attr("style") || "")
            }), e.$slidesCache = e.$slides, e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? i('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), (!0 === e.options.centerMode || !0 === e.options.swipeToSlide) && (e.options.slidesToScroll = 1), i("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), !0 === e.options.accessibility && e.$list.prop("tabIndex", 0), e.setSlideClasses("number" == typeof this.currentSlide ? this.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
        }, e.prototype.buildRows = function() {
            var i, e, t, o, s, n, l, r = this;
            if (o = document.createDocumentFragment(), n = r.$slider.children(), r.options.rows > 1) {
                for (l = r.options.slidesPerRow * r.options.rows, s = Math.ceil(n.length / l), i = 0; s > i; i++) {
                    var d = document.createElement("div");
                    for (e = 0; e < r.options.rows; e++) {
                        var a = document.createElement("div");
                        for (t = 0; t < r.options.slidesPerRow; t++) {
                            var c = i * l + (e * r.options.slidesPerRow + t);
                            n.get(c) && a.appendChild(n.get(c))
                        }
                        d.appendChild(a)
                    }
                    o.appendChild(d)
                }
                r.$slider.html(o), r.$slider.children().children().children().css({
                    width: 100 / r.options.slidesPerRow + "%",
                    display: "inline-block"
                })
            }
        }, e.prototype.checkResponsive = function(e) {
            var t, o, s, n = this,
                l = !1,
                r = n.$slider.width(),
                d = window.innerWidth || i(window).width();
            if ("window" === n.respondTo ? s = d : "slider" === n.respondTo ? s = r : "min" === n.respondTo && (s = Math.min(d, r)), n.originalSettings.responsive && n.originalSettings.responsive.length > -1 && null !== n.originalSettings.responsive) {
                o = null;
                for (t in n.breakpoints) n.breakpoints.hasOwnProperty(t) && (!1 === n.originalSettings.mobileFirst ? s < n.breakpoints[t] && (o = n.breakpoints[t]) : s > n.breakpoints[t] && (o = n.breakpoints[t]));
                null !== o ? null !== n.activeBreakpoint ? o !== n.activeBreakpoint && (n.activeBreakpoint = o, "unslick" === n.breakpointSettings[o] ? n.unslick(o) : (n.options = i.extend({}, n.originalSettings, n.breakpointSettings[o]), !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e)), l = o) : (n.activeBreakpoint = o, "unslick" === n.breakpointSettings[o] ? n.unslick(o) : (n.options = i.extend({}, n.originalSettings, n.breakpointSettings[o]), !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e)), l = o) : null !== n.activeBreakpoint && (n.activeBreakpoint = null, n.options = n.originalSettings, !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e), l = o), e || !1 === l || n.$slider.trigger("breakpoint", [n, l])
            }
        }, e.prototype.changeSlide = function(e, t) {
            var o, s, n, l = this,
                r = i(e.target);
            switch (r.is("a") && e.preventDefault(), r.is("li") || (r = r.closest("li")), n = 0 != l.slideCount % l.options.slidesToScroll, o = n ? 0 : (l.slideCount - l.currentSlide) % l.options.slidesToScroll, e.data.message) {
                case "previous":
                    s = 0 === o ? l.options.slidesToScroll : l.options.slidesToShow - o, l.slideCount > l.options.slidesToShow && l.slideHandler(l.currentSlide - s, !1, t);
                    break;
                case "next":
                    s = 0 === o ? l.options.slidesToScroll : o, l.slideCount > l.options.slidesToShow && l.slideHandler(l.currentSlide + s, !1, t);
                    break;
                case "index":
                    var d = 0 === e.data.index ? 0 : e.data.index || r.index() * l.options.slidesToScroll;
                    l.slideHandler(l.checkNavigable(d), !1, t), r.children().trigger("focus");
                    break;
                default:
                    return
            }
        }, e.prototype.checkNavigable = function(i) {
            var e, t;
            if (e = this.getNavigableIndexes(), t = 0, i > e[e.length - 1]) i = e[e.length - 1];
            else
                for (var o in e) {
                    if (i < e[o]) {
                        i = t;
                        break
                    }
                    t = e[o]
                }
            return i
        }, e.prototype.cleanUpEvents = function() {
            var e = this;
            e.options.dots && null !== e.$dots && (i("li", e.$dots).off("click.slick", e.changeSlide), !0 === e.options.pauseOnDotsHover && !0 === e.options.autoplay && i("li", e.$dots).off("mouseenter.slick", i.proxy(e.setPaused, e, !0)).off("mouseleave.slick", i.proxy(e.setPaused, e, !1))), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide)), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), i(document).off(e.visibilityChange, e.visibility), e.$list.off("mouseenter.slick", i.proxy(e.setPaused, e, !0)), e.$list.off("mouseleave.slick", i.proxy(e.setPaused, e, !1)), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().off("click.slick", e.selectHandler), i(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), i(window).off("resize.slick.slick-" + e.instanceUid, e.resize), i("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), i(window).off("load.slick.slick-" + e.instanceUid, e.setPosition), i(document).off("ready.slick.slick-" + e.instanceUid, e.setPosition)
        }, e.prototype.cleanUpRows = function() {
            var i, e = this;
            e.options.rows > 1 && (i = e.$slides.children().children(), i.removeAttr("style"), e.$slider.html(i))
        }, e.prototype.clickHandler = function(i) {
            !1 === this.shouldClick && (i.stopImmediatePropagation(), i.stopPropagation(), i.preventDefault())
        }, e.prototype.destroy = function(e) {
            var t = this;
            t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), i(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && "object" != typeof t.options.prevArrow && t.$prevArrow.remove(), t.$nextArrow && "object" != typeof t.options.nextArrow && t.$nextArrow.remove(), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function() {
                i(this).attr("style", i(this).data("originalStyling"))
            }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t])
        }, e.prototype.disableTransition = function(i) {
            var e = this,
                t = {};
            t[e.transitionType] = "", !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
        }, e.prototype.fadeSlide = function(i, e) {
            var t = this;
            !1 === t.cssTransitions ? (t.$slides.eq(i).css({
                zIndex: 1e3
            }), t.$slides.eq(i).animate({
                opacity: 1
            }, t.options.speed, t.options.easing, e)) : (t.applyTransition(i), t.$slides.eq(i).css({
                opacity: 1,
                zIndex: 1e3
            }), e && setTimeout(function() {
                t.disableTransition(i), e.call()
            }, t.options.speed))
        }, e.prototype.filterSlides = e.prototype.slickFilter = function(i) {
            var e = this;
            null !== i && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.filter(i).appendTo(e.$slideTrack), e.reinit())
        }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function() {
            return this.currentSlide
        }, e.prototype.getDotCount = function() {
            var i = this,
                e = 0,
                t = 0,
                o = 0;
            if (!0 === i.options.infinite)
                for (; e < i.slideCount;) ++o, e = t + i.options.slidesToShow, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow;
            else if (!0 === i.options.centerMode) o = i.slideCount;
            else
                for (; e < i.slideCount;) ++o, e = t + i.options.slidesToShow, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow;
            return o - 1
        }, e.prototype.getLeft = function(i) {
            var e, t, o, s = this,
                n = 0;
            return s.slideOffset = 0, t = s.$slides.first().outerHeight(), !0 === s.options.infinite ? (s.slideCount > s.options.slidesToShow && (s.slideOffset = -1 * s.slideWidth * s.options.slidesToShow, n = -1 * t * s.options.slidesToShow), 0 != s.slideCount % s.options.slidesToScroll && i + s.options.slidesToScroll > s.slideCount && s.slideCount > s.options.slidesToShow && (i > s.slideCount ? (s.slideOffset = -1 * (s.options.slidesToShow - (i - s.slideCount)) * s.slideWidth, n = -1 * (s.options.slidesToShow - (i - s.slideCount)) * t) : (s.slideOffset = -1 * s.slideCount % s.options.slidesToScroll * s.slideWidth, n = -1 * s.slideCount % s.options.slidesToScroll * t))) : i + s.options.slidesToShow > s.slideCount && (s.slideOffset = (i + s.options.slidesToShow - s.slideCount) * s.slideWidth, n = (i + s.options.slidesToShow - s.slideCount) * t), s.slideCount <= s.options.slidesToShow && (s.slideOffset = 0, n = 0), !0 === s.options.centerMode && !0 === s.options.infinite ? s.slideOffset += s.slideWidth * Math.floor(s.options.slidesToShow / 2) - s.slideWidth : !0 === s.options.centerMode && (s.slideOffset = 0, s.slideOffset += s.slideWidth * Math.floor(s.options.slidesToShow / 2)), e = !1 === s.options.vertical ? -1 * i * s.slideWidth + s.slideOffset : -1 * i * t + n, !0 === s.options.variableWidth && (o = s.slideCount <= s.options.slidesToShow || !1 === s.options.infinite ? s.$slideTrack.children(".slick-slide").eq(i) : s.$slideTrack.children(".slick-slide").eq(i + s.options.slidesToShow), e = o[0] ? -1 * o[0].offsetLeft : 0, !0 === s.options.centerMode && (o = !1 === s.options.infinite ? s.$slideTrack.children(".slick-slide").eq(i) : s.$slideTrack.children(".slick-slide").eq(i + s.options.slidesToShow + 1), e = o[0] ? -1 * o[0].offsetLeft : 0, e += (s.$list.width() - o.outerWidth()) / 2)), e
        }, e.prototype.getOption = e.prototype.slickGetOption = function(i) {
            return this.options[i]
        }, e.prototype.getNavigableIndexes = function() {
            var i, e = this,
                t = 0,
                o = 0,
                s = [];
            for (!1 === e.options.infinite ? i = e.slideCount : (t = -1 * e.options.slidesToScroll, o = -1 * e.options.slidesToScroll, i = 2 * e.slideCount); i > t;) s.push(t), t = o + e.options.slidesToScroll, o += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
            return s
        }, e.prototype.getSlick = function() {
            return this
        }, e.prototype.getSlideCount = function() {
            var e, t, o = this;
            return t = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function(s, n) {
                return n.offsetLeft - t + i(n).outerWidth() / 2 > -1 * o.swipeLeft ? (e = n, !1) : void 0
            }), Math.abs(i(e).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
        }, e.prototype.goTo = e.prototype.slickGoTo = function(i, e) {
            this.changeSlide({
                data: {
                    message: "index",
                    index: parseInt(i)
                }
            }, e)
        }, e.prototype.init = function(e) {
            var t = this;
            i(t.$slider).hasClass("slick-initialized") || (i(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots()), e && t.$slider.trigger("init", [t])
        }, e.prototype.initArrowEvents = function() {
            var i = this;
            !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.on("click.slick", {
                message: "previous"
            }, i.changeSlide), i.$nextArrow.on("click.slick", {
                message: "next"
            }, i.changeSlide))
        }, e.prototype.initDotEvents = function() {
            var e = this;
            !0 === e.options.dots && e.slideCount > e.options.slidesToShow && i("li", e.$dots).on("click.slick", {
                message: "index"
            }, e.changeSlide), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && !0 === e.options.autoplay && i("li", e.$dots).on("mouseenter.slick", i.proxy(e.setPaused, e, !0)).on("mouseleave.slick", i.proxy(e.setPaused, e, !1))
        }, e.prototype.initializeEvents = function() {
            var e = this;
            e.initArrowEvents(), e.initDotEvents(), e.$list.on("touchstart.slick mousedown.slick", {
                action: "start"
            }, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {
                action: "move"
            }, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {
                action: "end"
            }, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {
                action: "end"
            }, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), i(document).on(e.visibilityChange, i.proxy(e.visibility, e)), e.$list.on("mouseenter.slick", i.proxy(e.setPaused, e, !0)), e.$list.on("mouseleave.slick", i.proxy(e.setPaused, e, !1)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), i(window).on("orientationchange.slick.slick-" + e.instanceUid, i.proxy(e.orientationChange, e)), i(window).on("resize.slick.slick-" + e.instanceUid, i.proxy(e.resize, e)), i("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), i(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), i(document).on("ready.slick.slick-" + e.instanceUid, e.setPosition)
        }, e.prototype.initUI = function() {
            var i = this;
            !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.show(), i.$nextArrow.show()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.show(), !0 === i.options.autoplay && i.autoPlay()
        }, e.prototype.keyHandler = function(i) {
            var e = this;
            37 === i.keyCode && !0 === e.options.accessibility ? e.changeSlide({
                data: {
                    message: "previous"
                }
            }) : 39 === i.keyCode && !0 === e.options.accessibility && e.changeSlide({
                data: {
                    message: "next"
                }
            })
        }, e.prototype.lazyLoad = function() {
            function e(e) {
                i("img[data-lazy]", e).each(function() {
                    var e = i(this),
                        t = i(this).attr("data-lazy"),
                        o = document.createElement("img");
                    o.onload = function() {
                        e.animate({
                            opacity: 1
                        }, 200)
                    }, o.src = t, e.css({
                        opacity: 0
                    }).attr("src", t).removeAttr("data-lazy").removeClass("slick-loading")
                })
            }
            var t, o, s, n, l = this;
            !0 === l.options.centerMode ? !0 === l.options.infinite ? (s = l.currentSlide + (l.options.slidesToShow / 2 + 1), n = s + l.options.slidesToShow + 2) : (s = Math.max(0, l.currentSlide - (l.options.slidesToShow / 2 + 1)), n = l.options.slidesToShow / 2 + 1 + 2 + l.currentSlide) : (s = l.options.infinite ? l.options.slidesToShow + l.currentSlide : l.currentSlide, n = s + l.options.slidesToShow, !0 === l.options.fade && (s > 0 && s--, n <= l.slideCount && n++)), t = l.$slider.find(".slick-slide").slice(s, n), e(t), l.slideCount <= l.options.slidesToShow ? (o = l.$slider.find(".slick-slide"), e(o)) : l.currentSlide >= l.slideCount - l.options.slidesToShow ? (o = l.$slider.find(".slick-cloned").slice(0, l.options.slidesToShow), e(o)) : 0 === l.currentSlide && (o = l.$slider.find(".slick-cloned").slice(-1 * l.options.slidesToShow), e(o))
        }, e.prototype.loadSlider = function() {
            var i = this;
            i.setPosition(), i.$slideTrack.css({
                opacity: 1
            }), i.$slider.removeClass("slick-loading"), i.initUI(), "progressive" === i.options.lazyLoad && i.progressiveLazyLoad()
        }, e.prototype.next = e.prototype.slickNext = function() {
            this.changeSlide({
                data: {
                    message: "next"
                }
            })
        }, e.prototype.orientationChange = function() {
            var i = this;
            i.checkResponsive(), i.setPosition()
        }, e.prototype.pause = e.prototype.slickPause = function() {
            var i = this;
            i.autoPlayClear(), i.paused = !0
        }, e.prototype.play = e.prototype.slickPlay = function() {
            var i = this;
            i.paused = !1, i.autoPlay()
        }, e.prototype.postSlide = function(i) {
            var e = this;
            e.$slider.trigger("afterChange", [e, i]), e.animating = !1, e.setPosition(), e.swipeLeft = null, !0 === e.options.autoplay && !1 === e.paused && e.autoPlay()
        }, e.prototype.prev = e.prototype.slickPrev = function() {
            this.changeSlide({
                data: {
                    message: "previous"
                }
            })
        }, e.prototype.preventDefault = function(i) {
            i.preventDefault()
        }, e.prototype.progressiveLazyLoad = function() {
            var e, t = this;
            i("img[data-lazy]", t.$slider).length > 0 && (e = i("img[data-lazy]", t.$slider).first(), e.attr("src", e.attr("data-lazy")).removeClass("slick-loading").load(function() {
                e.removeAttr("data-lazy"), t.progressiveLazyLoad(), !0 === t.options.adaptiveHeight && t.setPosition()
            }).error(function() {
                e.removeAttr("data-lazy"), t.progressiveLazyLoad()
            }))
        }, e.prototype.refresh = function(e) {
            var t = this,
                o = t.currentSlide;
            t.destroy(!0), i.extend(t, t.initials), t.init(), e || t.changeSlide({
                data: {
                    message: "index",
                    index: o
                }
            }, !1)
        }, e.prototype.reinit = function() {
            var e = this;
            e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses(0), e.setPosition(), e.$slider.trigger("reInit", [e])
        }, e.prototype.resize = function() {
            var e = this;
            i(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function() {
                e.windowWidth = i(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
            }, 50))
        }, e.prototype.removeSlide = e.prototype.slickRemove = function(i, e, t) {
            var o = this;
            return "boolean" == typeof i ? (e = i, i = !0 === e ? 0 : o.slideCount - 1) : i = !0 === e ? --i : i, !(o.slideCount < 1 || 0 > i || i > o.slideCount - 1) && (o.unload(), !0 === t ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(i).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, void o.reinit())
        }, e.prototype.setCSS = function(i) {
            var e, t, o = this,
                s = {};
            !0 === o.options.rtl && (i = -i), e = "left" == o.positionProp ? Math.ceil(i) + "px" : "0px", t = "top" == o.positionProp ? Math.ceil(i) + "px" : "0px", s[o.positionProp] = i, !1 === o.transformsEnabled ? o.$slideTrack.css(s) : (s = {}, !1 === o.cssTransitions ? (s[o.animType] = "translate(" + e + ", " + t + ")", o.$slideTrack.css(s)) : (s[o.animType] = "translate3d(" + e + ", " + t + ", 0px)", o.$slideTrack.css(s)))
        }, e.prototype.setDimensions = function() {
            var i = this;
            !1 === i.options.vertical ? !0 === i.options.centerMode && i.$list.css({
                padding: "0px " + i.options.centerPadding
            }) : (i.$list.height(i.$slides.first().outerHeight(!0) * i.options.slidesToShow), !0 === i.options.centerMode && i.$list.css({
                padding: i.options.centerPadding + " 0px"
            })), i.listWidth = i.$list.width(), i.listHeight = i.$list.height(), !1 === i.options.vertical && !1 === i.options.variableWidth ? (i.slideWidth = Math.ceil(i.listWidth / i.options.slidesToShow), i.$slideTrack.width(Math.ceil(i.slideWidth * i.$slideTrack.children(".slick-slide").length))) : !0 === i.options.variableWidth ? i.$slideTrack.width(5e3 * i.slideCount) : (i.slideWidth = Math.ceil(i.listWidth), i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0) * i.$slideTrack.children(".slick-slide").length)));
            var e = i.$slides.first().outerWidth(!0) - i.$slides.first().width();
            !1 === i.options.variableWidth && i.$slideTrack.children(".slick-slide").width(i.slideWidth - e)
        }, e.prototype.setFade = function() {
            var e, t = this;
            t.$slides.each(function(o, s) {
                e = -1 * t.slideWidth * o, !0 === t.options.rtl ? i(s).css({
                    position: "relative",
                    right: e,
                    top: 0,
                    zIndex: 800,
                    opacity: 0
                }) : i(s).css({
                    position: "relative",
                    left: e,
                    top: 0,
                    zIndex: 800,
                    opacity: 0
                })
            }), t.$slides.eq(t.currentSlide).css({
                zIndex: 900,
                opacity: 1
            })
        }, e.prototype.setHeight = function() {
            var i = this;
            if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
                var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
                i.$list.css("height", e)
            }
        }, e.prototype.setOption = e.prototype.slickSetOption = function(i, e, t) {
            var o = this;
            o.options[i] = e, !0 === t && (o.unload(), o.reinit())
        }, e.prototype.setPosition = function() {
            var i = this;
            i.setDimensions(), i.setHeight(), !1 === i.options.fade ? i.setCSS(i.getLeft(i.currentSlide)) : i.setFade(), i.$slider.trigger("setPosition", [i])
        }, e.prototype.setProps = function() {
            var i = this,
                e = document.body.style;
            i.positionProp = !0 === i.options.vertical ? "top" : "left", "top" === i.positionProp ? i.$slider.addClass("slick-vertical") : i.$slider.removeClass("slick-vertical"), (void 0 !== e.WebkitTransition || void 0 !== e.MozTransition || void 0 !== e.msTransition) && !0 === i.options.useCSS && (i.cssTransitions = !0), void 0 !== e.OTransform && (i.animType = "OTransform", i.transformType = "-o-transform", i.transitionType = "OTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.MozTransform && (i.animType = "MozTransform", i.transformType = "-moz-transform", i.transitionType = "MozTransition", void 0 === e.perspectiveProperty && void 0 === e.MozPerspective && (i.animType = !1)), void 0 !== e.webkitTransform && (i.animType = "webkitTransform", i.transformType = "-webkit-transform", i.transitionType = "webkitTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.msTransform && (i.animType = "msTransform", i.transformType = "-ms-transform", i.transitionType = "msTransition", void 0 === e.msTransform && (i.animType = !1)), void 0 !== e.transform && !1 !== i.animType && (i.animType = "transform", i.transformType = "transform", i.transitionType = "transition"), i.transformsEnabled = null !== i.animType && !1 !== i.animType
        }, e.prototype.setSlideClasses = function(i) {
            var e, t, o, s, n = this;
            n.$slider.find(".slick-slide").removeClass("slick-active").attr("aria-hidden", "true").removeClass("slick-center"), t = n.$slider.find(".slick-slide"), !0 === n.options.centerMode ? (e = Math.floor(n.options.slidesToShow / 2), !0 === n.options.infinite && (i >= e && i <= n.slideCount - 1 - e ? n.$slides.slice(i - e, i + e + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = n.options.slidesToShow + i, t.slice(o - e + 1, o + e + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === i ? t.eq(t.length - 1 - n.options.slidesToShow).addClass("slick-center") : i === n.slideCount - 1 && t.eq(n.options.slidesToShow).addClass("slick-center")), n.$slides.eq(i).addClass("slick-center")) : i >= 0 && i <= n.slideCount - n.options.slidesToShow ? n.$slides.slice(i, i + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : t.length <= n.options.slidesToShow ? t.addClass("slick-active").attr("aria-hidden", "false") : (s = n.slideCount % n.options.slidesToShow, o = !0 === n.options.infinite ? n.options.slidesToShow + i : i, n.options.slidesToShow == n.options.slidesToScroll && n.slideCount - i < n.options.slidesToShow ? t.slice(o - (n.options.slidesToShow - s), o + s).addClass("slick-active").attr("aria-hidden", "false") : t.slice(o, o + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false")), "ondemand" === n.options.lazyLoad && n.lazyLoad()
        }, e.prototype.setupInfinite = function() {
            var e, t, o, s = this;
            if (!0 === s.options.fade && (s.options.centerMode = !1), !0 === s.options.infinite && !1 === s.options.fade && (t = null, s.slideCount > s.options.slidesToShow)) {
                for (o = !0 === s.options.centerMode ? s.options.slidesToShow + 1 : s.options.slidesToShow, e = s.slideCount; e > s.slideCount - o; e -= 1) t = e - 1, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t - s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");
                for (e = 0; o > e; e += 1) t = e, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t + s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");
                s.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
                    i(this).attr("id", "")
                })
            }
        }, e.prototype.setPaused = function(i) {
            var e = this;
            !0 === e.options.autoplay && !0 === e.options.pauseOnHover && (e.paused = i, i ? e.autoPlayClear() : e.autoPlay())
        }, e.prototype.selectHandler = function(e) {
            var t = this,
                o = i(e.target).is(".slick-slide") ? i(e.target) : i(e.target).parents(".slick-slide"),
                s = parseInt(o.attr("data-slick-index"));
            return s || (s = 0), t.slideCount <= t.options.slidesToShow ? (t.$slider.find(".slick-slide").removeClass("slick-active").attr("aria-hidden", "true"), t.$slides.eq(s).addClass("slick-active").attr("aria-hidden", "false"), !0 === t.options.centerMode && (t.$slider.find(".slick-slide").removeClass("slick-center"), t.$slides.eq(s).addClass("slick-center")), void t.asNavFor(s)) : void t.slideHandler(s)
        }, e.prototype.slideHandler = function(i, e, t) {
            var o, s, n, l = null,
                r = this;
            return e = e || !1, !0 === r.animating && !0 === r.options.waitForAnimate || !0 === r.options.fade && r.currentSlide === i || r.slideCount <= r.options.slidesToShow ? void 0 : (!1 === e && r.asNavFor(i), o = i, l = r.getLeft(o), n = r.getLeft(r.currentSlide), r.currentLeft = null === r.swipeLeft ? n : r.swipeLeft, !1 === r.options.infinite && !1 === r.options.centerMode && (0 > i || i > r.getDotCount() * r.options.slidesToScroll) ? void(!1 === r.options.fade && (o = r.currentSlide, !0 !== t ? r.animateSlide(n, function() {
                r.postSlide(o)
            }) : r.postSlide(o))) : !1 === r.options.infinite && !0 === r.options.centerMode && (0 > i || i > r.slideCount - r.options.slidesToScroll) ? void(!1 === r.options.fade && (o = r.currentSlide, !0 !== t ? r.animateSlide(n, function() {
                r.postSlide(o)
            }) : r.postSlide(o))) : (!0 === r.options.autoplay && clearInterval(r.autoPlayTimer), s = 0 > o ? 0 != r.slideCount % r.options.slidesToScroll ? r.slideCount - r.slideCount % r.options.slidesToScroll : r.slideCount + o : o >= r.slideCount ? 0 != r.slideCount % r.options.slidesToScroll ? 0 : o - r.slideCount : o, r.animating = !0, r.$slider.trigger("beforeChange", [r, r.currentSlide, s]), r.currentSlide, r.currentSlide = s, r.setSlideClasses(r.currentSlide), r.updateDots(), r.updateArrows(), !0 === r.options.fade ? (!0 !== t ? r.fadeSlide(s, function() {
                r.postSlide(s)
            }) : r.postSlide(s), void r.animateHeight()) : void(!0 !== t ? r.animateSlide(l, function() {
                r.postSlide(s)
            }) : r.postSlide(s))))
        }, e.prototype.startLoad = function() {
            var i = this;
            !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.hide(), i.$nextArrow.hide()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.hide(), i.$slider.addClass("slick-loading")
        }, e.prototype.swipeDirection = function() {
            var i, e, t, o, s = this;
            return i = s.touchObject.startX - s.touchObject.curX, e = s.touchObject.startY - s.touchObject.curY, t = Math.atan2(e, i), o = Math.round(180 * t / Math.PI), 0 > o && (o = 360 - Math.abs(o)), 45 >= o && o >= 0 ? !1 === s.options.rtl ? "left" : "right" : 360 >= o && o >= 315 ? !1 === s.options.rtl ? "left" : "right" : o >= 135 && 225 >= o ? !1 === s.options.rtl ? "right" : "left" : !0 === s.options.verticalSwiping ? o >= 35 && 135 >= o ? "left" : "right" : "vertical"
        }, e.prototype.swipeEnd = function() {
            var i, e = this;
            if (e.dragging = !1, e.shouldClick = !(e.touchObject.swipeLength > 10), void 0 === e.touchObject.curX) return !1;
            if (!0 === e.touchObject.edgeHit && e.$slider.trigger("edge", [e, e.swipeDirection()]), e.touchObject.swipeLength >= e.touchObject.minSwipe) switch (e.swipeDirection()) {
                case "left":
                    i = e.options.swipeToSlide ? e.checkNavigable(e.currentSlide + e.getSlideCount()) : e.currentSlide + e.getSlideCount(), e.slideHandler(i), e.currentDirection = 0, e.touchObject = {}, e.$slider.trigger("swipe", [e, "left"]);
                    break;
                case "right":
                    i = e.options.swipeToSlide ? e.checkNavigable(e.currentSlide - e.getSlideCount()) : e.currentSlide - e.getSlideCount(), e.slideHandler(i), e.currentDirection = 1, e.touchObject = {}, e.$slider.trigger("swipe", [e, "right"])
            } else e.touchObject.startX !== e.touchObject.curX && (e.slideHandler(e.currentSlide), e.touchObject = {})
        }, e.prototype.swipeHandler = function(i) {
            var e = this;
            if (!(!1 === e.options.swipe || "ontouchend" in document && !1 === e.options.swipe || !1 === e.options.draggable && -1 !== i.type.indexOf("mouse"))) switch (e.touchObject.fingerCount = i.originalEvent && void 0 !== i.originalEvent.touches ? i.originalEvent.touches.length : 1, e.touchObject.minSwipe = e.listWidth / e.options.touchThreshold, !0 === e.options.verticalSwiping && (e.touchObject.minSwipe = e.listHeight / e.options.touchThreshold), i.data.action) {
                case "start":
                    e.swipeStart(i);
                    break;
                case "move":
                    e.swipeMove(i);
                    break;
                case "end":
                    e.swipeEnd(i)
            }
        },
        e.prototype.swipeMove = function(i) {
            var e, t, o, s, n, l = this;
            return n = void 0 !== i.originalEvent ? i.originalEvent.touches : null, !(!l.dragging || n && 1 !== n.length) && (e = l.getLeft(l.currentSlide), l.touchObject.curX = void 0 !== n ? n[0].pageX : i.clientX, l.touchObject.curY = void 0 !== n ? n[0].pageY : i.clientY, l.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(l.touchObject.curX - l.touchObject.startX, 2))), !0 === l.options.verticalSwiping && (l.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(l.touchObject.curY - l.touchObject.startY, 2)))), t = l.swipeDirection(), "vertical" !== t ? (void 0 !== i.originalEvent && l.touchObject.swipeLength > 4 && i.preventDefault(), s = (!1 === l.options.rtl ? 1 : -1) * (l.touchObject.curX > l.touchObject.startX ? 1 : -1), !0 === l.options.verticalSwiping && (s = l.touchObject.curY > l.touchObject.startY ? 1 : -1), o = l.touchObject.swipeLength, l.touchObject.edgeHit = !1, !1 === l.options.infinite && (0 === l.currentSlide && "right" === t || l.currentSlide >= l.getDotCount() && "left" === t) && (o = l.touchObject.swipeLength * l.options.edgeFriction, l.touchObject.edgeHit = !0), l.swipeLeft = !1 === l.options.vertical ? e + o * s : e + o * (l.$list.height() / l.listWidth) * s, !0 === l.options.verticalSwiping && (l.swipeLeft = e + o * s), !0 !== l.options.fade && !1 !== l.options.touchMove && (!0 === l.animating ? (l.swipeLeft = null, !1) : void l.setCSS(l.swipeLeft))) : void 0)
        }, e.prototype.swipeStart = function(i) {
            var e, t = this;
            return 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow ? (t.touchObject = {}, !1) : (void 0 !== i.originalEvent && void 0 !== i.originalEvent.touches && (e = i.originalEvent.touches[0]), t.touchObject.startX = t.touchObject.curX = void 0 !== e ? e.pageX : i.clientX, t.touchObject.startY = t.touchObject.curY = void 0 !== e ? e.pageY : i.clientY, void(t.dragging = !0))
        }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function() {
            var i = this;
            null !== i.$slidesCache && (i.unload(), i.$slideTrack.children(this.options.slide).detach(), i.$slidesCache.appendTo(i.$slideTrack), i.reinit())
        }, e.prototype.unload = function() {
            var e = this;
            i(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && "object" != typeof e.options.prevArrow && e.$prevArrow.remove(), e.$nextArrow && "object" != typeof e.options.nextArrow && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible").attr("aria-hidden", "true").css("width", "")
        }, e.prototype.unslick = function(i) {
            var e = this;
            e.$slider.trigger("unslick", [e, i]), e.destroy()
        }, e.prototype.updateArrows = function() {
            var i = this;
            Math.floor(i.options.slidesToShow / 2), !0 === i.options.arrows && !0 !== i.options.infinite && i.slideCount > i.options.slidesToShow && (i.$prevArrow.removeClass("slick-disabled"), i.$nextArrow.removeClass("slick-disabled"), 0 === i.currentSlide ? (i.$prevArrow.addClass("slick-disabled"), i.$nextArrow.removeClass("slick-disabled")) : i.currentSlide >= i.slideCount - i.options.slidesToShow && !1 === i.options.centerMode ? (i.$nextArrow.addClass("slick-disabled"), i.$prevArrow.removeClass("slick-disabled")) : i.currentSlide >= i.slideCount - 1 && !0 === i.options.centerMode && (i.$nextArrow.addClass("slick-disabled"), i.$prevArrow.removeClass("slick-disabled")))
        }, e.prototype.updateDots = function() {
            var i = this;
            null !== i.$dots && (i.$dots.find("li").removeClass("slick-active").attr("aria-hidden", "true"), i.$dots.find("li").eq(Math.floor(i.currentSlide / i.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden", "false"))
        }, e.prototype.visibility = function() {
            var i = this;
            document[i.hidden] ? (i.paused = !0, i.autoPlayClear()) : !0 === i.options.autoplay && (i.paused = !1, i.autoPlay())
        }, i.fn.slick = function() {
            var i, t = this,
                o = arguments[0],
                s = Array.prototype.slice.call(arguments, 1),
                n = t.length,
                l = 0;
            for (l; n > l; l++)
                if ("object" == typeof o || void 0 === o ? t[l].slick = new e(t[l], o) : i = t[l].slick[o].apply(t[l].slick, s), void 0 !== i) return i;
            return t
        }
}), $(function() {
    $(".js-slide-left").on("click", function() {
        $(".js-slider").animate({
            scrollLeft: $(".js-slider").scrollLeft() - 251
        })
    }), $(".js-slide-right").on("click", function() {
        $(".js-slider").animate({
            scrollLeft: $(".js-slider").scrollLeft() + 251
        })
    }), submit_ga_event_click("Page", "Viewed Homepage")
}),$(function() {
    $(".js-slide-left2").on("click", function() {
        $(".js-slider2").animate({
            scrollLeft: $(".js-slider2").scrollLeft() - 251
        })
    }), $(".js-slide-right2").on("click", function() {
        $(".js-slider2").animate({
            scrollLeft: $(".js-slider2").scrollLeft() + 251
        })
    }), submit_ga_event_click("Page", "Viewed Homepage")
});