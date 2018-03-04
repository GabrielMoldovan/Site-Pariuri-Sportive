jQuery.noConflict();
function mycarousel_initCallback(carousel) {
    carousel.buttonNext.bind('click', function () {
        carousel.startAuto(0);
    });
    carousel.buttonPrev.bind('click', function () {
        carousel.startAuto(0);
    });
    carousel.clip.hover(function () {
        carousel.stopAuto();
    }, function () {
        carousel.startAuto();
    });
};
decorateTable('upsell-product-table')
jQuery(document).ready(function () {
    jQuery('#slider').nivoSlider();
    jQuery('#mycarousel_right').jcarousel({
        vertical: true,
		scroll: 1,
        auto: 1,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
	jQuery(".show_box").click(function () {
    jQuery(".header_login").slideDown(200);
    });
  
jQuery(".login_close").click(function () {
  jQuery(".header_login").slideUp(200);
});
 
    jQuery("#addClass").click(function () {
 
	  jQuery('#para1').addClass('active');
 
    });
 
    jQuery("#removeClass").click(function () {
 
	  jQuery('#para1').removeClass('active');
 
    });
	 jQuery('#mycarouselleft').jcarousel({
		scroll: 1,
        auto: 1,
        wrap: 'circular',
        initCallback: mycarousel_initCallback
    });
    jQuery('.mycarousel_related').jcarousel({
		scroll: 1,
        wrap: 'circular'
    });
    jQuery(".tab_content").hide();
    jQuery("ul.tabs li:first").addClass("active").show();
    jQuery(".tab_content:first").show();
    jQuery("ul.tabs li").click(function () {
        jQuery("ul.tabs li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".tab_content").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        jQuery(activeTab).fadeIn();
        return false;
    });
});
$$('.related-checkbox').each(function (elem) {
    Event.observe(elem, 'click', addRelatedToProduct)
});
var relatedProductsCheckFlag = false;

function selectAllRelated(txt) {
    if (relatedProductsCheckFlag == false) {
        $$('.related-checkbox').each(function (elem) {
            elem.checked = true;
        });
        relatedProductsCheckFlag = true;
        txt.innerHTML = "<?php echo $this->__('unselect all') ?>";
    } else {
        $$('.related-checkbox').each(function (elem) {
            elem.checked = false;
        });
        relatedProductsCheckFlag = false;
        txt.innerHTML = "<?php echo $this->__('select all') ?>";
    }
    addRelatedToProduct();
}

function addRelatedToProduct() {
    var checkboxes = $$('.related-checkbox');
    var values = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) values.push(checkboxes[i].value);
    }
    if ($('related-products-field')) {
        $('related-products-field').value = values.join(',');
    }
}





jQuery.noConflict();

function mycarousel_initCallback(carousel) {
    carousel.buttonNext.bind('click', function () {
        carousel.startAuto(0);
    });
    carousel.buttonPrev.bind('click', function () {
        carousel.startAuto(0);
    });
    carousel.clip.hover(function () {
        carousel.stopAuto();
    }, function () {
        carousel.startAuto();
    });
};
decorateTable('upsell-product-table')
jQuery(document).ready(function () {
    jQuery('#slider').nivoSlider();
    jQuery('#mycarousel').jcarousel({
        vertical: true,
        auto: 1,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
	jQuery('ul.tabs li').click(

        function (e) {

            jQuery('html, body').animate({scrollTop: '0px'}, 800);

        }

    );
    jQuery('.mycarousel').jcarousel({
		scroll: 1,
        wrap: 'circular'
    });
    jQuery(".tab_content").hide();
    jQuery("ul.tabs li:first").addClass("active").show();
    jQuery(".tab_content:first").show();
    jQuery.fn.scrollView = function () {
        return this.each(function () {
            jQuery('html, body').animate({
                scrollTop: jQuery(this).offset().top
            }, 1000);
        });
    }
    jQuery("ul.tabs li").click(function () {
        jQuery('.form-subscribe').scrollView();
        jQuery("ul.tabs li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".tab_content").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        jQuery(activeTab).fadeIn();
        return false;
    });
});
$$('.related-checkbox').each(function (elem) {
    Event.observe(elem, 'click', addRelatedToProduct)
});
var relatedProductsCheckFlag = false;

function selectAllRelated(txt) {
    if (relatedProductsCheckFlag == false) {
        $$('.related-checkbox').each(function (elem) {
            elem.checked = true;
        });
        relatedProductsCheckFlag = true;
        txt.innerHTML = "<?php echo $this->__('unselect all') ?>";
    } else {
        $$('.related-checkbox').each(function (elem) {
            elem.checked = false;
        });
        relatedProductsCheckFlag = false;
        txt.innerHTML = "<?php echo $this->__('select all') ?>";
    }
    addRelatedToProduct();
}