document.addEventListener('DOMContentLoaded', function () {
  /*window.addEventListener('load', function () {
   if (Math.round(window.pageYOffset) > 0) {
   setTimeout(function () {
   window.scrollTo(0, 0);
   }, 500);
   }
   });*/

  let scrollWidth;

  function funScrollWidth() {
    let _divCreate = document.createElement('div');
    _divCreate.style.overflowY = 'scroll';
    _divCreate.style.width = '50px';
    _divCreate.style.height = '50px';
    _divCreate.style.visibility = 'hidden';
    document.body.appendChild(_divCreate);
    scrollWidth = _divCreate.offsetWidth - _divCreate.clientWidth;
    document.body.removeChild(_divCreate);
  }

  funScrollWidth();
  window.addEventListener('resize', funScrollWidth);

  /*document.addEventListener('DOMContentLoaded', function () {
   animateStart();
   });*/

  function preloader() {

    document.body.style.paddingRight = scrollWidth + 'px';
    let header = document.querySelector('.header');
    header.style.paddingRight = scrollWidth + 'px';

    let preloader = document.querySelector('.preloader');
    preloader.classList.add('preloader_show');

    let preloaderObj = {
      container        : document.querySelector('.preloader__b'),
      renderer         : 'canvas',
      loop             : false,
      autoplay         : true,
      path             : el.dir + 'others/preloader1.json',
      rendererSettings : {
        clearCanvas       : true,
        progressiveLoad   : true,
        hideOnTransparent : false,
        className         : 'preloader__svg',
      }
    };
    let preloaderAn = lottie.loadAnimation(preloaderObj);
    // let scriptPreload = document.querySelector('#scriptPreload');
    // let scriptPreloadAn = document.querySelector('#scriptPreloadAn');

    preloaderAn.onEnterFrame = function () {
      if (this.currentFrame > 160) {

        document.body.removeAttribute('style');
        header.removeAttribute('style');
        preloader.style.right = -scrollWidth + 'px';
        preloader.classList.add('_complete');

        animateStart();

        // setTimeout(function () {
        //   scriptPreload.remove();
        //   scriptPreloadAn.remove();
        // }, 600);

        setTimeout(function () {
          preloader.remove();
        }, 1000);
      }
    };
  }

  ajaxCacheScript(el.dir + "js/animate.js", function () {
    preloader();
  });
});


//common uses selectors
let el = {
  header      : $('header'),
  preloader   : $('.preloader'),
  preloaderCl : "preloader_hide",
  nav         : $('.nav'),
  navToggle   : $('[data-toggleNav]'),
  dir         : $('input.dir_url'),
  cursor      : $('.cursor'),
  cursorDrag  : $('.cursorDrag'),
  body        : $('body'),
  window      : $(window),
  document    : $(document),
};
let skrollAn;

const cursorDrag = el.cursorDrag[0];

// sizes window
function sizeWindow() {
  el.windowW = window.innerWidth;
  el.windowtH = window.innerHeight;
  el.documentH = Math.max(
    document.body.scrollHeight, document.documentElement.scrollHeight,
    document.body.offsetHeight, document.documentElement.offsetHeight,
    document.body.clientHeight, document.documentElement.clientHeight
  );
  el.pageScroll = Math.round(pageYOffset);
}

sizeWindow();
window.addEventListener('resize', sizeWindow);
window.addEventListener('load', sizeWindow);
document.addEventListener('DOMContentLoaded', sizeWindow);

// sizes window
function sizeWindow() {
  el.windowW = window.innerWidth;
  el.windowtH = window.innerHeight;
  el.documentH = Math.max(
    document.body.scrollHeight, document.documentElement.scrollHeight,
    document.body.offsetHeight, document.documentElement.offsetHeight,
    document.body.clientHeight, document.documentElement.clientHeight
  );
  el.pageScroll = Math.round(pageYOffset);
}

sizeWindow();
window.addEventListener('resize', function () {
  setTimeout(function () {
    sizeWindow();
  }, 1000);
});
window.addEventListener('load', sizeWindow);

//detect main directory
function funDirUrl() {
  el.dir = el.dir.val();
  if (el.dir) return el.dir = el.dir.replace(/\s+/g, "");
  if (!el.dir || el.dir === "") el.dir = '/';
}

funDirUrl();

// ajax script cache
function ajaxCacheScript(a, b) {
  $.get(a).done(function () {
    $.ajax({
      url      : a,
      type     : "GET",
      dataType : "script",
      cache    : true,
      success  : b,
    });
  }).fail(function () {
    console.log('file not exists on link ' + a);
  });
}

// coords
function getCoords(elem) {
  let box = elem.getBoundingClientRect();
  return {
    top      : box.top,
    left     : box.left,
    height   : box.height,
    topPage  : box.top + pageYOffset,
    leftPage : box.left + pageXOffset
  };
}

function getCoordsJq(elem) {
  let box = elem[0].getBoundingClientRect();
  return {
    top      : box.top,
    left     : box.left,
    height   : box.height,
    topPage  : box.top + pageYOffset,
    leftPage : box.left + pageXOffset
  };
}

//scroll animate
let $ease = 'swing';
ajaxCacheScript(el.dir + "js/easing.min.js", function () {
  $ease = 'easeOutCubic';
});

function funScroll(par1) {
  $('html, body').stop().animate({
    'scrollTop' : par1
  }, 1500, $ease);
}

function funPadding(a) {
  a.css('padding-right', +scrollWidth + 'px');
}

function funPaddingDef(a) {
  a.css('padding-right', 0);
}

// detection Browser
function funBrowser() {
  $.browser = {};
  $.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());
  $.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
  $.browser.safari = /safari/.test(navigator.userAgent.toLowerCase());
  $.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
  $.browser.ie = /msie/.test(navigator.userAgent.toLowerCase()) || /rv/.test(navigator.userAgent.toLowerCase());
  switch (true) {
    case $.browser.mozilla:
      return 'firefox';
    case $.browser.chrome:
      return 'chrome';
    case $.browser.safari:
      return 'safari';
    case $.browser.opera:
      return 'opera';
    case $.browser.ie:
      return 'ie';
  }
}

el.body.addClass(funBrowser);

/*
 * Replace all SVG images with inline SVG
 */
function svgInline() {
  $('img[src*="svg"]').not('.preloader__img,.sPartner__itemImg, .bProgram__dragIc').each(function () {
    let $img = $(this),
      imgID = $img.attr('id'),
      imgClass = $img.attr('class'),
      imgURL = $img.attr('src');

    $.get(imgURL, function (data) {
      // Get the SVG tag, ignore the rest
      let $svg = $(data).find('svg');
      if ($svg) {
        $svg.find('path').removeAttr('style');
        // Remove any invalid XML tags as per http://validator.w3.org
        $svg.removeAttr('id x y version xmlns xml:space xmlns:a');
        $svg.find("style").detach();
        // Add replaced image ID to the new SVG
        if (imgID !== undefined) $svg.attr('id', imgID);
        // Add replaced image classes to the new SVG
        if (imgClass !== undefined) $svg.attr('class', 'replaced__svg ' + imgClass);
        else $svg.attr('class', 'replaced__svg');
        // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
        /*if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
         $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
         }*/
        // Replace image with new SVG
        $img.replaceWith($svg);
      }
    }, 'xml');
  });
}

svgInline();

//elements show
function animateEl(elements) {
  let scroll = window.pageYOffset ? window.pageYOffset : 0;
  elements.each(function () {
    let _this = $(this);
    if (_this.hasClass('showEl')) return;
    let cord = getCoordsJq(_this);
    if (cord.top < el.windowtH || cord.top + cord.height < 1) {

      el.elAnimateScroll = el.elAnimateScroll.not(_this);

      if (_this.is("[data-videoAutoplay]")) _this[0].play();
      if (_this.is("[data-del]")) _this.css('animation-delay', _this.data('del') + "s");
      if (_this.is("[data-dur]")) {

        _this.css('animation-duration', _this.data('dur') + "s");

        setTimeout(function () {
          _this.addClass("_pointer");
        }, _this.data("dur") * 1000 + 100);

      }
      else {

        setTimeout(function () {
          _this.addClass("_pointer");
        }, 1600);

      }
      _this.addClass("_animated " + _this.data('an'));

      function numCount(el) {
        let sec = 2,
          stepSec = 40,
          frames = 1000 / stepSec,
          i = 0,
          num = parseInt(el.data('num').toString().replace(' ', '')),
          step = parseFloat(num / sec / frames);
        let int = setInterval(function () {
          i += step;
          if (i <= num) _this.html(parseInt(i).toLocaleString('ru'));
          else {
            _this.html(num.toLocaleString('ru'));
            clearInterval(int);
          }
        }, stepSec);

      }

      function numCount1(el) {
        let i = 0,
          multiplier = 1,
          num = parseInt(el.data('num').toString().replace(' ', ''));

        if (num <= 100 && num > 10) {
          multiplier = num / 10;
        }
        else if (num > 100) {
          multiplier = num / 100;
        }

        let int = setInterval(function () {
          i += multiplier;

          if (i <= num) {
            el.html(parseInt(i).toLocaleString('ru'));
          }
          else {
            el.html(num.toLocaleString('ru'));
            clearInterval(int);
          }
        }, 20);
      }


      if (_this.is("[data-an='_num']")) numCount1(_this);

      /*setTimeout(function () {
       _this.removeClass("_showEl _animated _pointer");
       }, 10000);*/
    }
  });
}

function animateStart() {
  requestAnimationFrame(function () {
    el.elAnimateScroll = $('[data-an]');
    if (el.elAnimateScroll.length) {
      animateEl(el.elAnimateScroll);
      el.window.scroll(function animateElScroll() {
        if (!el.elAnimateScroll.length) el.window.unbind("scroll", animateElScroll);
        animateEl(el.elAnimateScroll);
      });
    }
  });
}

// animate on scroll
ajaxCacheScript(el.dir + "js/skrollr.min.js", function () {
  // animate
  skrollAn = skrollr.init({
    forceHeight     : false,
    edgeStrategy    : 'set',
    smoothScrolling : true,
    // smoothScrollingDuration: 200,
    easing          : {
      WTF      : Math.random,
      inverted : function (p) {
        return 1 - p;
      }
    },
    /*easeOutElasticBig: function(p) {
     return 56*(p*p*p*p*p) - 175*(p*p*p*p) + 200*(p*p*p) - 100*(p*p) + 20*p;
     }*/
  });
  window.addEventListener('resize', function () {
    skrollAn.refresh();
  });
});

el.document.ready(function () {
  "use strict";

  let fonImg = $('[data-lozy-bgimg]');
  let srcImg = $('[data-src]');

  function lozyBgImg() {
    fonImg.each(function () {
      let _this = $(this);
      let box = _this[0].getBoundingClientRect();
      let top = box.top;
      if (top < el.windowtH + 200) {
        let scr = _this.data('lozy-bgimg');
        fonImg = fonImg.not(_this);
        _this.css('background-image', 'url(' + scr + ')');
      }
    });
  }

  function lozySrcImg() {
    srcImg.each(function () {
      let _this = $(this);
      let box = _this[0].getBoundingClientRect();
      let top = box.top;
      if (top < el.windowtH + 200) {
        let scr = _this.data('src');
        srcImg = srcImg.not(_this);
        _this.attr('src', scr);

        if (scr.includes('.svg') && !_this.hasClass('preloader__img') && !_this.hasClass('sPartner__itemImg') && !_this.hasClass('bProgram__dragIc')) {
          
          let $img = _this,
            imgID = $img.attr('id'),
            imgClass = $img.attr('class');

          $.get(scr, function (data) {
            // Get the SVG tag, ignore the rest
            let $svg = $(data).find('svg');
            if ($svg) {
              $svg.find('path').removeAttr('style');
              // Remove any invalid XML tags as per http://validator.w3.org
              $svg.removeAttr('id x y version xmlns xml:space xmlns:a');
              $svg.find("style").detach();
              // Add replaced image ID to the new SVG
              if (imgID !== undefined) $svg.attr('id', imgID);
              // Add replaced image classes to the new SVG
              if (imgClass !== undefined) $svg.attr('class', 'replaced__svg ' + imgClass);
              else $svg.attr('class', 'replaced__svg');
              // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
              /*if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
               $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
               }*/
              // Replace image with new SVG
              _this.replaceWith($svg);
            }
          }, 'xml');
        }

      }
    });
  }

  setTimeout(function () {
    lozyBgImg();
    lozySrcImg();
    window.addEventListener('scroll', function () {
      lozyBgImg();
      lozySrcImg();
    });
  }, 2000);

  //cursor
  function cursorMore(element, classCss) {
    $(element).hover(function () {
      el.cursor.addClass(classCss);
    }, function () {
      el.cursor.removeClass(classCss);
    });
  }

  let cursorEl = document.querySelector('.cursor');
  if (cursorEl) {
    document.addEventListener('mousemove', mousemove);

    let mouse_x = 0,
      mouse_y = 0;

    function mousemove(event) {
      mouse_x = event.clientX;
      mouse_y = event.clientY;

      cursorEl.style.left = mouse_x + 'px';
      cursorEl.style.top = mouse_y + 'px';
    }

    $('a').hover(function () {
      if ($(this).hasClass('active')) return;
      el.cursor.addClass('cursorMore');
    }, function () {
      el.cursor.removeClass('cursorMore');
    });

    cursorMore('.sProgram', '_drag');
    cursorMore('.mainTopNav__item', '_hide');
    cursorMore('.sPartner, .sImplement__container, .sTheme__container', '_dragBlack');
  }

  function cursorSlider(slider, container) {


    function funMouseOver(par) {
      cursorDrag.classList.add(par);
    }

    function funMouseOut(par) {
      cursorDrag.classList.remove(par);
    }

    slider.on('reachBeginning', function () {
      funMouseOut('hovSliderEnd');
      funMouseOut('hovSliderCnt');
    });
    slider.on('reachEnd', function () {
      funMouseOver('hovSliderEnd');
      funMouseOut('hovSliderCnt');
    });
    slider.on('fromEdge', function () {
      funMouseOver('hovSliderCnt');
      funMouseOut('hovSliderEnd');
    });
    container[0].addEventListener('mouseover', function () {
      if (slider.isBeginning) {
        funMouseOut('hovSliderEnd');
        funMouseOut('hovSliderCnt');
      }
      else if (slider.isEnd) {
        funMouseOver('hovSliderEnd');
        funMouseOut('hovSliderCnt');
      }
      else {
        funMouseOver('hovSliderCnt');
        funMouseOut('hovSliderEnd');
      }
    });
    container[0].addEventListener('mouseout', function () {
      funMouseOut('hovSliderEnd');
      funMouseOut('hovSliderCnt');
    });
  }

  //anchors
  $("a[href^='#'], [data-anchor]").click(function (e) {
    e.preventDefault();

    let _this = $(this), elDta;

    if (_this.is('[data-anchor]')) elDta = $("#" + _this.data('anchor'));
    else if (_this.is('[href]') && _this.attr('href').length > 1) {
      let _href = _this.attr('href');
      elDta = $(_href);

      if (_href === '#bCont') {
        setTimeout(function () {
          $(_href + ' .form__input').first().focus();
        }, 1000);
      }
    }
    else return;

    if (elDta.length) {
      let nav = el.header, top, navHeight;

      top = elDta.offset().top;

      if (nav.length && nav.css('position') === 'fixed' || 'absolute' && el.documentH > el.windowtH) {
        navHeight = el.header.outerHeight();
        if (nav.offset().top !== 0) top -= navHeight;
        // else top -= 80;
      }
      funScroll(top);
    }
  });

  el.navToggle.click(function () {
    el.navToggle.toggleClass('active');
    el.nav.toggleClass('active');
    el.header.toggleClass('active');
    if (el.nav.hasClass('active') && el.documentH > el.windowtH) {
      el.body.toggleClass('dropdown');
      funPadding(el.header);
      funPadding(el.nav);
      funPadding(el.body);
    }
    else {
      setTimeout(function () {
        el.body.toggleClass('dropdown');
        funPaddingDef(el.header);
        funPaddingDef(el.nav);
        funPaddingDef(el.body);
      }, 400);
    }
  });

  function menuFix() {
    if (pageYOffset > 0) el.header.addClass('_down');
    else el.header.removeClass('_down');
  }

  // window.addEventListener('scroll', menuFix);
  // menuFix();

  function hasSubFon(el) {
    let fonPar = el.parent();
    el.css({
      'min-height' : fonPar.outerHeight(),
    });
    window.addEventListener('resize', function () {
      el.css({
        'min-height' : fonPar.outerHeight(),
      });
    });
  }

  $("[data-hasSub]").hover(function () {
    let _this = $(this);
    _this.addClass('_active');
    el.header.addClass('_subNavShow');
    $("[data-hasSub]").not(_this).removeClass('_active');

    let fon = _this.find('.bSub__fon');
    hasSubFon(fon);

    el.window.scroll(function hasSubClose(e) {
      _this.removeClass('_active');
      el.header.removeClass('_subNavShow');
      $("[data-hasSub]").removeClass('_active');
      el.window.unbind('click', hasSubClose);
    });


  }, function () {
    let _this = $(this);
    _this.removeClass('_active');
    el.header.removeClass('_subNavShow');
    $("[data-hasSub]").not(_this).removeClass('_active');

  });

  $("[data-hasSub]").click(function () {
    let _this = $(this);
    if (_this.hasClass('_active')) {
      _this.removeClass('_active');
      el.header.removeClass('_subNavShow');
      $("[data-hasSub]").not(_this).removeClass('_active');
    }
    else {
      _this.addClass('_active');
      el.header.addClass('_subNavShow');
      $("[data-hasSub]").not(_this).removeClass('_active');

      let fon = _this.find('.bSub__fon');
      hasSubFon(fon);

      el.window.click(function hasSubClose(e) {
        if (!_this.is(e.target) && _this.has(e.target).length === 0) {
          _this.removeClass('_active');
          el.header.removeClass('_subNavShow');
          $("[data-hasSub]").removeClass('_active');
          el.window.unbind('click', hasSubClose);
        }
      });

      el.window.scroll(function hasSubClose(e) {
        _this.removeClass('_active');
        el.header.removeClass('_subNavShow');
        $("[data-hasSub]").removeClass('_active');
        el.window.unbind('click', hasSubClose);
      });
    }
  });

  $(".nav__subToggle").click(function () {
    let _this = $(this), par = _this.parent(), next = par.next();
    _this.toggleClass('_active');
    next.slideToggle();
  });
  //form object
  let elForm = {
    fields        : $("input").not("[type='hidden']").add("textarea"),
    pl            : '.form__placeholder',
    plCl          : '_active',
    sucCl         : '_success',
    erAnCl        : '_bounce',
    erCl          : '_error',
    error         : false,
    //regular expressions pattern
    telJqValidate : "+38(999)-999-99-99",
    regEmail      : /^[a-z0-9._%+-]+@[a-z0-9.-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i,
    regTel        : /\+38\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}$/,
    regName       : /^[??-????-??????????????????????a-zA-Z*\s]{3,}$/i,
  };

  //mask
  ajaxCacheScript(el.dir + "js/inputmask/jquery.inputmask.min.js", function () {
    $("input[type='tel']").inputmask(elForm.telJqValidate, {
      showMaskOnHover : false,
      autoUnmask      : false
    });  //tel
  });

  // checkbox && radio remove error class
  $('.b-checkbox, .b-select, .b-file').click(function () {
    var _this = $(this);
    _this.removeClass(elForm.erCl + ' ' + elForm.erAnCl);
    _this.find('.form__error').remove();
  });

  $('.form__input,.form__textarea,.subscribe__input').focus(function () {
    $(this).removeClass(elForm.erCl + ' ' + elForm.erAnCl).parent().find('.form__error').remove();
  });

  $(".subscribe__input").focus(function () {
    let _this = $(this), _form = _this.closest('form');
    _form.addClass('_focus');
    _this.blur(function () {
      _form.removeClass('_focus');
    });
  });

  //function field validation
  function funValidate(el, reg) {
    let par = el.parent();
    par.find('.form__error').remove();
    if (el.val().search(reg) === 0) {
      el.removeClass(elForm.erCl);
    }
    else {
      el.addClass(elForm.erCl);

      if (el.val() === "") {
        messageEmpty(el);
      }
      else {
        el.after("<p class='form__error'>" + messageFormat + "</p>");
      }
      elForm.error = true;
    }
  }

  function messageEmpty(el) {
    el.after("<p class='form__error'>" + messageRequire + "</p>");
  }

  //send form via AJAX
  $("form").not('.formSearch, .sp-element-container').submit(function () {
    elForm.error = false;
    let $form = $(this),
      $formFields = $form.find("input, textarea"),
      $formButton = $form.find('button[type="submit"]');

    $formFields.each(function () {
      let _this = $(this);
      _this.parent().find('.form__error').remove();

      if (_this.get(0).hasAttribute('required')) {

        if (_this.is("[name='name']")) funValidate(_this, elForm.regName);
        else if (_this.is("[type='email']")) funValidate(_this, elForm.regEmail);
        else if (_this.is("[type='tel']")) funValidate(_this, elForm.regTel);

        else if (_this.is(".b-select__input")) {

          if (_this.val() === "") {
            let bl = _this.next();
            bl.removeClass(elForm.erAnCl).addClass(elForm.erCl);
            elForm.error = true;
            setTimeout(function () {
              bl.addClass(elForm.erAnCl);
            }, 10);
            messageEmpty(bl);
          }

        }
        else {
          if (_this.is("[type='checkbox']") && !_this.prop('checked')) {
            _this.parent().removeClass(elForm.erAnCl).addClass(elForm.erCl);
            elForm.error = true;
            setTimeout(function () {
              _this.parent().addClass(elForm.erAnCl);
            }, 10);
            messageEmpty(_this);

          }
          else if (_this.is("[type='radio']")) {

            let _radioBl = _this.parent().parent();
            if (!_radioBl.find('input:checked').length) {
              _radioBl.removeClass(elForm.erAnCl).addClass(elForm.erCl);
              elForm.error = true;
              setTimeout(function () {
                _radioBl.addClass(elForm.erAnCl);
              }, 10);
              messageEmpty(_this);
            }

          }
          else if (_this.is("[type='file']") && _this.val() === "") {
            let _fileBl = _this.closest('.b-file');
            _fileBl.removeClass(elForm.erAnCl).addClass(elForm.erCl);
            elForm.error = true;
            setTimeout(function () {
              _fileBl.addClass(elForm.erAnCl);
            }, 10);
            messageEmpty(_this);

          }
          else if (_this.val() === "") {

            _this.removeClass(elForm.erAnCl).addClass(elForm.erCl);
            elForm.error = true;
            setTimeout(function () {
              _this.addClass(elForm.erAnCl);
            }, 10);
            messageEmpty(_this);
          }
        }
      }
      else {
        if (_this.is("[name='name']") && _this.val() !== '') funValidate(_this, elForm.regName);
        else if (_this.is("[type='email']") && _this.val() !== '') funValidate(_this, elForm.regEmail);
        else if (_this.is("[type='tel']") && _this.val() !== '') funValidate(_this, elForm.regTel);
      }

    });

    if (!elForm.error) {

      //let $data = $form.serialize() + '&location_url=' + window.location.href;
      let $form_data = new FormData($form.get(0));// data
      $form_data.append('location_url', window.location.href);

      $.ajax({
        type        : 'POST',
        url         : $form.attr('action'),
        dataType    : 'json',
        data        : $form_data,
        // parameters on enctype="multipart/form-data"
        cache       : false, // not cache
        processData : false, // disable string conversion
        contentType : false, // disable data formatting
        beforeSend  : function () {

          $form.find('.form__error').remove();
          $formButton.addClass('loading').attr('disabled', 'disabled');

        },
        success     : function ($data) {

          let res = $data.error;
          if (res) alert(res);

          else {
            $form.trigger("reset");//reset form .get(0).reset() or .trigger("reset");
            $formButton.removeAttr('disabled');
            $form.find(elForm.erCl + ", " + elForm.erAnCl + ", " + elForm.sucCl + ", " + elForm.plCl).removeClass(elForm.erCl + " " + elForm.erAnCl + " " + elForm.sucCl + " " + elForm.plCl);
            $form.find(elForm.pl).removeClass(elForm.plCl);

            $formFields.filter(".b-select__input").each(function () {
              let selBl = $(this), title = selBl.next();
              selBl.val('');
              title.text(title.data('default'));
              selBl.parent().find('.b-select__item').removeClass('active');
            });

            let fileTitle = $form.find('.b-file__txt');
            if (fileTitle.length) {
              fileTitle.text(fileTitle.data('txt-default'));
            }

            $.fancybox.close();
            setTimeout(function () {
              if ($form.is("[ data-form-share]")) funPopup('[data-popup="popupAlertSubscribe"]');
              else funPopup('[data-popup="popupAlert"]');
            }, 1000);
            //setTimeout(function () {$.fancybox.close();}, 4000);

            if ($form.is('#registerForm')) {
              fbq('track', 'Lead');
            }
          }

        },
        error       : function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        },
        complete    : function () {
          $formButton.removeClass('loading').prop('disabled', false);
        }
      });
    }
    return false; // turn off standard support of the form
  });

  // select
  let selectEl = $(".b-select__wr");
  selectEl.each(function (indx) {
    $(this).attr('tabindex', indx);
  });
  $('body').click(function (e) {
    if (!selectEl.is(e.target) && selectEl.has(e.target).length === 0) {
      selectEl.removeClass("active");
    }
  });
  selectEl.click(function () {//open
    let _this = $(this);
    _this.toggleClass("active");
    _this.mouseleave(function (e) {//close
      $(this).removeClass("active");
    });
    selectEl.not(_this).removeClass("active");
  });
  $(".b-select__item").click(function (e) {
    e.preventDefault();
    let _this = $(this), txtItem = _this.text(), txtValue = _this.data('value'), parent = _this.closest(".b-select"),
      inputEl = parent.find(".b-select__input"), titleEl = parent.find(".b-select__title");
    if (_this.hasClass("active")) return;
    _this.addClass("active").siblings().removeClass("active");
    inputEl.val(txtValue);
    titleEl.text(txtItem);
    parent.addClass('_selected');
  });
  $(".b-select__input").each(function () { // refresh data select
    let _this = $(this), $val = _this.val(), parent = _this.closest(".b-select"), titleEl = parent.find(".b-select__title");
    if ($val !== '') {
      titleEl.text($val);
      parent.addClass('_selected');
      parent.find(".b-select__item[data-value='" + $val + "']").addClass("active");
    }
  });
  $('.b-select').click(function () {
    $(this).find('.b-select__title').removeClass(elForm.erCl + ' ' + elForm.erAnCl);
  });

  //upload file
  el.file = $('.b-file__input');

  el.file.on('dragover dragenter', function () {
    $(this).parent().addClass('dragover');
  });

  el.file.on('dragleave dragend drop', function (e) {
    $(this).parent().removeClass('dragover');
  });
  if (el.file.length) {
    el.file.change(function fileChange() {
      var _this = $(this), par = _this.parent(), txtEl = par.find('.b-file__txt'), count, remove = par.find('.b-file__remove');
      var filesExt = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'odt', 'ttf', 'pdf', 'xlsx'];
      count = _this[0].files.length;
      if (!count) return;
      par.removeClass('error');
      par.parent().find('.form__error').remove();

      var parts = _this.val().split('.');
      if (filesExt.join().search(parts[parts.length - 1]) === -1) {
        par.removeClass('selectedFile');
        _this.val('');
        txtEl.text(txtEl.data('txt-default'));

        if (par.prev().hasClass('form__label')) {
          par.prev().append("<p class='form__error'>" + messageFormat + "</p>");
        }
        else {
          par.before("<p class='form__error'>" + messageFormat + "</p>");
        }
        return;
      }
      if (count > 1) {
        txtEl.text(txtEl.data('txt') + ' ' + count);
      }
      else {
        txtEl.text(_this[0].files[0].name);
      }
      par.addClass('selectedFile');
      remove.click(function (e) {
        e.preventDefault();
        par.removeClass('selectedFile');
        _this.val('');
        txtEl.text(txtEl.data('txt-default'));
      });

    }).change();
  }

  //popup inline content function
  function funPopup(par1) {
    $.fancybox.open({
      src  : par1,
      type : 'inline',
      opts : {
        animationEffect : "fade",
        touch           : false,
        baseTpl         :
          '<div class="fancybox-container" role="dialog" tabindex="-1">' +
          '<div class="fancybox-bg"></div>' +
          '<div class="fancybox-inner">' +
          '<div class="fancybox-stage"></div>' +
          "</div>" +
          "</div>",
        btnTpl          : {
          smallBtn :
            '<a href="#" data-fancybox-close class="popup__close">' +
            '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#closeClip0)"><path d="M3.80762 22.1924L22.1924 3.80761M22.1924 22.1924L3.80762 3.80761" stroke="black"/></g><defs><clipPath id="closeClip0"><rect width="26" height="26" fill="white"/></clipPath></defs></svg>' +
            '</a>',
        },
        beforeShow      : function () {
          if (el.header.css('position') === 'fixed' && el.documentH > el.windowtH)
            funPadding(el.header);
        },
        afterClose      : function () {
          if (el.header.css('position') === 'fixed' && !el.body.hasClass('dropdown'))
            funPaddingDef(el.header);
        }
      }
    });
  }

  ajaxCacheScript(el.dir + "js/fancybox3/jquery.fancybox.min.js", function () {
    $('[data-modal]').click(function (e) {
      e.preventDefault();
      let _this = $(this),
        $data = _this.data('modal');
      funPopup('[data-popup="' + $data + '"]');
      if (_this.is('[data-form-name]')) {
        let modal = $('[data-popup="' + $data + '"]'),
          name = modal.find('input[name="form_name"]'),
          btnName = _this.data('form-name');
        if (btnName.length) name.val(btnName);
      }
    });
  });

  //slider
  ajaxCacheScript(el.dir + "js/swiper/swiper.js", function () {

    function sliderRefresh(slider, obj, container) {
      window.addEventListener('resize', function () {
        setTimeout(function () {
          slider.destroy();
          slider = new Swiper(container, obj);
        }, 500);
      });
    }

    $(".swiper-js").each(function () {
      let _this = $(this), container = _this.find(".swiper-container");

      //slider
      let sProgramFon = $('.sProgram__itemFon');
      sProgramFon.css({
        "transition-duration" : "2000ms",
      });

      if (_this.hasClass('sProgram')) {
        let sProgramObj = {
          // grabCursor: true,
          longSwipesRatio : 0.03,
          loop            : false,
          slidesPerView   : 'auto',
          spaceBetween    : 20,
          arrow           : false,
          observer        : true,
          observeParents  : true,
          speed           : 2000,
          parallax        : true,
          // preventClicks: true,
          // preventClicksPropagation: true,
          // slideToClickedSlide: true,

          navigation  : {
            nextEl : _this.find('[data-next]'),
            prevEl : _this.find('[data-prev]'),
          },
          pagination  : {
            el   : _this.find('[data-pagination]'),
            type : "progressbar",
          },
          keyboard    : {
            enabled        : true,
            onlyInViewport : false,
          },
          breakpoints : {
            // when window width is >=  ...
            320  : {
              spaceBetween : 12,
            },
            768  : {
              spaceBetween : 16,
            },
            1024 : {
              spaceBetween : 20,
            },
          },
          on          : {
            progress   : function (progress) {
              progress = progress > 1.7 ? 1.7 : progress;
              sProgramFon.css({
                "transform" : "translate3d(" + progress * 100 + "px, 0px, 0px)",
              });
            },
            sliderMove : function () {
              sProgramFon.css({
                "transition-duration" : "0ms",
              });
            },
            touchEnd   : function () {
              sProgramFon.css({
                "transition-duration" : "2000ms",
              });
            },
          },
        };

        let sProgram = new Swiper(container, sProgramObj);

        //sliderRefresh(sProgram, sProgramObj, container);
      }

      //slider
      if (_this.hasClass('sPartner')) {
        let sPartnerObj = {
          // grabCursor: true,
          longSwipesRatio : 0.03,
          slidesPerView   : 'auto',
          loop            : false,
          spaceBetween    : 24,
          arrow           : false,
          observer        : true,
          observeParents  : true,
          speed           : 600,
          // slideToClickedSlide: true,
          navigation      : {
            nextEl : _this.find('[data-next]'),
            prevEl : _this.find('[data-prev]'),
          },
          pagination      : {
            el   : _this.find('[data-pagination]'),
            type : "progressbar",
          },
          keyboard        : {
            enabled        : true,
            onlyInViewport : false,
          },
          breakpoints     : {
            // when window width is >=  ...
            320  : {
              spaceBetween    : 15,
              slidesPerView   : 2,
              slidesPerColumn : 3,
            },
            768  : {
              spaceBetween : 20,
            },
            1024 : {
              spaceBetween : 24,
            },
          }
        };

        let sPartner = new Swiper(container, sPartnerObj);

        sliderRefresh(sPartner, sPartnerObj, container);
      }

      //slider
      if (_this.hasClass('sImplement')) {
        let sPartnerObj = {
          // grabCursor: true,
          longSwipesRatio : 0.03,
          slidesPerView   : 'auto',
          loop            : false,
          spaceBetween    : 72,
          arrow           : false,
          observer        : true,
          observeParents  : true,
          speed           : 600,
          // slideToClickedSlide: true,
          navigation      : {
            nextEl : _this.find('[data-next]'),
            prevEl : _this.find('[data-prev]'),
          },
          keyboard        : {
            enabled        : true,
            onlyInViewport : false,
          },
          breakpoints     : {
            // when window width is >=  ...
            320  : {
              spaceBetween : 12,
            },
            768  : {
              spaceBetween : 16,
            },
            1024 : {
              spaceBetween : 20,
            },
            1280 : {
              spaceBetween : 72,
            },
          }
        };

        let sPartner = new Swiper(container, sPartnerObj);

        sliderRefresh(sPartner, sPartnerObj, container);
      }

      //slider
      if (_this.hasClass('sTheme')) {
        let sPartnerObj = {
          // grabCursor: true,
          longSwipesRatio : 0.03,
          slidesPerView   : 'auto',
          loop            : false,
          spaceBetween    : 72,
          arrow           : false,
          observer        : true,
          observeParents  : true,
          speed           : 600,
          // slideToClickedSlide: true,
          navigation      : {
            nextEl : _this.find('[data-next]'),
            prevEl : _this.find('[data-prev]'),
          },
          keyboard        : {
            enabled        : true,
            onlyInViewport : false,
          },
          breakpoints     : {
            // when window width is >=  ...
            320  : {
              spaceBetween : 12,
            },
            768  : {
              spaceBetween : 16,
            },
            1024 : {
              spaceBetween : 20,
            },
            1280 : {
              spaceBetween : 72,
            },
          }
        };

        let sPartner = new Swiper(container, sPartnerObj);

        sliderRefresh(sPartner, sPartnerObj, container);
      }
    });
  });
  // titers duration
  let titers = $('[data-titers]');
  if (titers.length) {
    titers.each(titersSpeed);
    window.addEventListener('resize', function () {
      titers.each(titersSpeed);
    });
  }

  function titersSpeed() {
    let _this = $(this);
    let list = _this.find(".titers__list");
    let speed = _this.is('[data-speed]') ? +_this.data('speed') : 25;
    let res = parseInt(list.width() / speed);
    list.css('animation-duration', res + 's');
  }


  //video
  let videoEl = $("[data-video-click]");

  function togglePlayVideo(element) {
    element.muted ? element.removeAttribute('muted') : '';
    element.paused ? element.play() : element.pause();
  }

  /*videoEl.click(function () {
   togglePlayVideo($(this)[0]);
   });*/

  videoEl.click(function () {
    let _this = $(this), video = _this.find('[data-video]')[0];
    _this.toggleClass('_play');
    togglePlayVideo(video);
  });

  //tabs
  let tabItem = $('[data-tabIt]');
  $('[data-tabLink]').on('click', funTab);
  if (tabItem.length) tabItem.not('._active').hide(0);

  function funTab(e) {
    e.preventDefault();
    let _this = $(this),
      fadeSpeed = 400,
      href = _this.attr('data-tabLink'),
      parNav = _this.closest('[data-tabNav]'),
      parNavAtr = parNav.attr('data-tabNav'),
      item = $('[data-tabIt="' + href + '"]'),
      cont = $('[data-tabContent="' + parNavAtr + '"]'),
      contItem = cont.children("[data-tabIt]");
    parNav.find('[data-tabLink]').not(_this).removeClass('_active');
    _this.addClass('_active');
    contItem.stop().removeClass("_active");
    item.stop().addClass("_active");
    contItem.not(item).slideUp(fadeSpeed);
    item.slideDown(fadeSpeed);
  }

  //acc
  var $accCont = $('[ data-acc-cont]');
  $('[data-acc-click]').on('click', funAcc);
  if ($accCont.length) $accCont.not('._active').hide(0);//acc on document ready

  function funAcc(e) {
    e.preventDefault();
    var _this = $(this),
      $fadeSpeed = 400,
      $par = _this.closest('[data-acc-item]'),
      $cont = $par.find('[data-acc-cont]'),
      $mainPar = _this.closest('[data-acc]');

    if (_this.hasClass('_active')) {
      /*$mainPar.find("[data-acc-cont]").not($cont).slideUp($fadeSpeed);
       $mainPar.find('[data-acc-click]').not(_this).removeClass("_active");*/

      $cont.removeClass("_active").slideToggle($fadeSpeed);
      _this.removeClass("_active");

      if ($par.siblings().find('._active[data-acc-click]').length) return;

      let contNext = $par.next();

      if (contNext.length) {
        contNext.find('[data-acc-click]').addClass("_active");
        contNext.find('[data-acc-cont]').addClass("_active").slideDown($fadeSpeed);
      }
      else {
        let first = $mainPar.find('[data-acc-item]').eq(0);
        first.find('[data-acc-click]').addClass("_active");
        first.find('[data-acc-cont]').addClass("_active").slideDown($fadeSpeed);
      }


    }
    else {
      $cont.addClass("_active").slideToggle($fadeSpeed);
      _this.addClass("_active");
    }
  }

  // cookie
  $(".pupup-cookie__close").click(function (e) {
    e.preventDefault();
    var cookieBl = $(this).closest('.pupup-cookie').fadeOut();
    setTimeout(function () {
      cookieBl.remove();
    }, 1000);
  });
  $(".pupup-cookie__btn").click(function (e) {
    e.preventDefault();

    var cookieBl = $(this).closest('.pupup-cookie').fadeOut();
    setTimeout(function () {
      cookieBl.remove();
    }, 1000);

    var data = {
      'action' : 'setCookie',
    };
    $.ajax({
      url      : ajaxurl.url,
      data     : data,
      type     : 'POST',
      dataType : 'html',
      success  : function (data) {
      }
    });
  });


  // nav anchor scroll
  let anchorScroll = $('[data-anchorScroll]');
  let anchorScrollIt = $('[data-anchorScrollIt]');
  if (anchorScroll.length && anchorScrollIt.length) {

    // active
    function anchorBl(navElements, blockItems) {

      blockItems.each(function () {
        let _this = $(this), _href = _this.attr('data-anchorScrollIt');
        let cord = getCoordsJq(_this);

        if (cord.top < el.windowtH / 4 || cord.top + cord.height < 1) {
          navElements.removeClass('_active').filter('[href="#' + _href + '"]').addClass('_active');
        }

      });

    }

    //progress
    let variantFirstStep = true;
    let variantLastStep = true;

    function anchorProgress() {

      let progressBar = $('[data-progressBar]');
      let progressDetect = $('[data-progressDetect]');
      let circleProgress = $('.circleProgress');

      let cord = getCoordsJq(progressDetect);
      let minus = el.windowtH / 2;

      if (cord.top > minus && variantFirstStep) {
        variantFirstStep = false;
        variantLastStep = true;
        progressBar.css('height', "0%");
        circleProgress.css('stroke-dasharray', "0 471");
      }
      else if (cord.top < minus && cord.top + cord.height - minus > 1) {
        variantFirstStep = true;
        variantLastStep = true;

        let height = cord.height - minus;
        let step = height / 100;
        let top = cord.top;

        let progress = (
          top * -1 / step
        );
        progress = progress > 100 ? 100 : progress;
        progressBar.css('height', progress + "%");

        let progressCircle = 4.71 * progress;
        let progressCircle1 = 471 - progressCircle;
        circleProgress.css('stroke-dasharray', "" + progressCircle + " " + progressCircle1);

      }
      else if (cord.top + cord.height - minus < 1 && variantLastStep) {
        variantFirstStep = true;
        variantLastStep = false;

        progressBar.css('height', "100%");
        circleProgress.css('stroke-dasharray', "471 0");
      }

    }

    anchorBl(anchorScroll, anchorScrollIt);
    el.window.scroll(function () {
      anchorBl(anchorScroll, anchorScrollIt);
      anchorProgress();
    });
  }

  // svg path length
  let svgPathLength = $(".jsSvgPathLength");
  if (svgPathLength.length) {
    svgPathLength.each(function () {
      let _this = $(this), path = _this.find('path');

      path.each(function () {
        let _thisPath = $(this)[0];
        let pathDimensions = _thisPath.getTotalLength();
        _thisPath.style.strokeDasharray = pathDimensions;
        _thisPath.style.strokeDashoffset = pathDimensions;
      });

    });
  }

  let mainTop__wr = $(".mainTop__wr");
  if (mainTop__wr.length) {

    let curActiveDef = $(".mainTop__item._active");
    mainTop__wr.height(curActiveDef.outerHeight());
    curActiveDef.fadeIn();

    setTimeout(function () {
      curActiveDef = $(".mainTop__item._active");
      mainTop__wr.height(curActiveDef.outerHeight());
      curActiveDef.fadeIn();
    }, 1000);

    window.addEventListener('resize', function () {
      curActiveDef = $(".mainTop__item._active");
      mainTop__wr.height(curActiveDef.outerHeight());
      curActiveDef.fadeIn();
    });

    $(".mainTopNav__item").click(function (e) {
      e.preventDefault();
      let _this = $(this),
        par = _this.closest('.mainTop'),
        href = _this.data('slide'),
        all = par.find('[data-slide]'),
        cur = par.find('[data-slide="' + href + '"]'),
        infoAll = par.find('[data-slide-info]'),
        infoCur = par.find('[data-slide-info="' + href + '"]');
      let cord = getCoordsJq(_this);
      let img = par.find('[data-slide-img="' + href + '"]');
      let imgLast = img.siblings('[data-slide-img]');

      if (_this.hasClass('_active')) return;


      par.addClass('_slidePlay');
      img.css({
        'left' : cord.leftPage,
        'top'  : cord.topPage,
      });

      setTimeout(function () {
        img.removeClass('_hover').addClass('_active').css({
          'left'    : 0,
          'top'     : 0,
          'z-index' : -1,
        });
        imgLast.css({
          'z-index' : -3,
        });
      }, 50);

      setTimeout(function () {
        all.not(cur).removeClass('_active');
        cur.addClass('_active');
        infoAll.not(infoCur).fadeOut(function () {
          mainTop__wr.height(infoCur.outerHeight());
          infoCur.fadeIn().addClass('_active');
        }).removeClass('_active');
      }, 500);

      setTimeout(function () {
        imgLast.removeClass('_hover _active').attr('style', '');
        img.attr('style', '');
        par.removeClass('_slidePlay');
      }, 1050);

    });


    $('.mainTopNav__item').hover(function () {
      let _this = $(this);
      if (_this.hasClass('_active')) return;
      let cord = getCoordsJq(_this);
      let cur = _this.data('slide');
      let par = _this.closest('.mainTop');
      let img = par.find('[data-slide-img="' + cur + '"]');

      img.addClass('_hover');
      img.css({
        'left' : cord.leftPage,
        'top'  : cord.topPage,
      });

    }, function () {
      let _this = $(this);
      let cur = _this.data('slide');
      let par = _this.closest('.mainTop');
      let img = par.find('[data-slide-img="' + cur + '"]');
      img.removeClass('_hover');
    });
  }


  let scrollEvent = new UIEvent('scroll');
  window.dispatchEvent(scrollEvent);
});