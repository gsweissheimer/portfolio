/**
 * cesis_custom.js
 *
 **/

var jc = jQuery;

jc.noConflict();


'use strict';




jc(document).ready(function() {


function owl_adjustment(){
  jc('.cesis_content_slider_ctn').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
  jc('.cesis_content_slider_ctn').find('.cloned').remove();
  jc('.cesis_content_slider_ctn').find('.owl-prev').remove();
  jc('.cesis_content_slider_ctn').find('.owl-next').remove();
  jc('.cesis_content_slider_ctn').find('.owl-controls').remove();
  jc('.cesis_content_slider_ctn').find('.owl-stage').unwrap();
  jc('.cesis_content_slider_ctn').find('.owl-item').unwrap();
  jc('.cesis_content_slider_ctn').find('.owl-item > .vc_element').unwrap();
  jc('.cesis_content_slider_ctn').find('.owl-stage-outer > .vc_element').unwrap();
}

function forced_row_update() {


    if (jc('#vc_ui-panel-edit-element[data-vc-shortcode="vc_row"]').length > 0) {
    // div exists           --> yes
    vc.frame_window.jc('.vc_row').each(function() {
      var el = jc(this);
      var top_shape = el.find('.tt-shape-top');
      var bottom_shape = el.find('.tt-shape-bottom');
      var ts = jc(top_shape).prop('outerHTML');
      var bs = jc(bottom_shape).prop('outerHTML');

      top_shape.remove();
      bottom_shape.remove();
      setTimeout(function() {
        el.append(ts);
        el.append(bs);
      }, 1500);

    });
    vc.frame_window.jc('.vc_row:not(.cesis_row_has_parallax)').each(function() {
      var el = jc(this);
      setTimeout(function() {
        el.find('.cesis_row_parallax').remove();
      }, 2000);
      setTimeout(function() {
        el.find('.cesis_row_parallax').remove();
      }, 4000);
      setTimeout(function() {
        el.find('.cesis_row_parallax').remove();
      }, 6000);
    }
  );
  setTimeout(function() {
  vc.frame_window.cesis_row();
  vc.frame_window.cesis_initVideoBackgrounds();
  }, 2500);
  }
}


function parallax_update() {
  jc('.vc_ui-button[data-vc-ui-element="button-save"]').on('click', function(){
    setTimeout(function() {
        forced_row_update();
    }, 1500);
  });
}

forced_row_update();
parallax_update();

setTimeout(function() {
  vc.frame_window.cesis_row();
  vc.frame_window.cesis_initVideoBackgrounds();
}, 6000);

jc('#vc_tta_section').on('click', function() {

setTimeout(function() {
  vc.frame_window.owl_adjustment();
}, 2500);
setTimeout(function() {
  vc.frame_window.cesis_owl_carousel();
}, 3500);




});





  window.InlineShortcodeView_cesis_blog = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_blog.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })


  window.InlineShortcodeView_cesis_portfolio = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_portfolio.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })


  window.InlineShortcodeView_cesis_staff = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_staff.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })


  window.InlineShortcodeView_cesis_partners = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_partners.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })


  window.InlineShortcodeView_cesis_career = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_career.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })

  window.InlineShortcodeView_cesis_testimonials = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_testimonials.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })


  window.InlineShortcodeView_cesis_woocommerce = window.InlineShortcodeView.extend({
      render: function() {
          return window.InlineShortcodeView_cesis_woocommerce.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

          }), this
      }
  })

    window.InlineShortcodeView_cesis_gallery = window.InlineShortcodeView.extend({
        render: function() {
            return window.InlineShortcodeView_cesis_gallery.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.cesis_isotope();
            vc.frame_window.cesis_owl_carousel();

            }), this
        }
    })

    window.InlineShortcodeView_cesis_content_slider = window.InlineShortcodeViewContainer.extend({
        render: function() {
            return window.InlineShortcodeView_cesis_content_slider.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
            vc.frame_window.owl_adjustment();
            vc.frame_window.cesis_owl_carousel();
            }), this
          }
      })

    window.InlineShortcodeView_cesis_count_to = window.InlineShortcodeView.extend({
        render: function() {
            return window.InlineShortcodeView_cesis_count_to.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
              vc.frame_window.cesis_animated_number();

            }), this
        }
    })


    window.InlineShortcodeView_cesis_circular_progress_bar = window.InlineShortcodeView.extend({
        render: function() {
            return window.InlineShortcodeView_cesis_circular_progress_bar.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
              vc.frame_window.cesis_circular_progress_bar();
            }), this
        }
    })


    window.InlineShortcodeView_cesis_progress_bar = window.InlineShortcodeView.extend({
        render: function() {
            return window.InlineShortcodeView_cesis_progress_bar.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
              vc.frame_window.vc_progress_bar();
            }), this
        }
    })


    window.InlineShortcodeView_cesis_gmaps = window.InlineShortcodeView.extend({
        render: function() {
            return window.InlineShortcodeView_cesis_gmaps.__super__.render.call(this), vc.frame_window.vc_iframe.addActivity(function() {
              vc.frame_window.cesis_gmaps();
            }), this
        }
    })


})
