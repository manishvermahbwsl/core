/**
 * All Types Meta Box Class JS
 *
 * JS used for the custom metaboxes and other form items.
 *
 * Copyright 2011 - 2013 Ohad Raz (admin@bainternet.info)
 * @since 1.0
 */
 function update_repeater_fields() {
     _metabox_fields.init()
 }
 var $ = jQuery.noConflict();
 var e_d_count = 0;
 var Ed_array = new Array();
 jQuery(document).ready(function(e) {
     e(window).resize(function() {
         e.each(Ed_array, function() {
             var t = this;
             e(t.getScrollerElement()).width(100);
             width = e(t.getScrollerElement()).parent().width();
             e(t.getScrollerElement()).width(width);
             t.refresh()
         })
     })
 });
 var _metabox_fields = {
     oncefancySelect: false,
     init: function() {
         if (!this.oncefancySelect) {
             this.fancySelect();
             this.oncefancySelect = true
         }
         this.load_conditinal();
         this.load_time_picker();
         this.load_date_picker();
         this.load_color_picker();
         $(".at-repater-block").on("click", ".at-re-toggle", function() {
             $(this).parent().find(".repeater-table").toggle("slow")
         });
         $(".repeater-sortable").sortable({
             opacity: .6,
             revert: true,
             cursor: "move",
             handle: ".at_re_sort_handle",
             placeholder: "at_re_sort_highlight"
         })
     },
     fancySelect: function() {
         if ($().select2) {
             $(".at-select, .at-posts-select, .at-tax-select").each(function() {
                 if (!$(this).hasClass("no-fancy")) {
                     $(this).select2()
                 }
             })
         }
     },
     get_query_var: function(e) {
         var t = RegExp("[?&]" + e + "=([^&#]*)").exec(location.href);
         return t && decodeURIComponent(t[1].replace(/\+/g, " "))
     },
     load_conditinal: function() {
         $(".conditinal_control").click(function() {
             if ($(this).is(":checked")) {
                 $(this).next().show("fast")
             } else {
                 $(this).next().hide("fast")
             }
         })
     },
     load_time_picker: function() {
         $(".at-time").each(function() {
             var e = $(this)
               , t = e.attr("rel")
               , n = e.attr("data-ampm");
             if ("true" == n) {
                 n = true
             } else {
                 n = false
             }
             e.timepicker({
                 showSecond: true,
                 timeFormat: t,
                 ampm: n
             })
         })
     },
     load_date_picker: function() {
         $(".at-date").each(function() {
             var e = $(this)
               , t = e.attr("rel");
             e.datepicker({
                 showButtonPanel: true,
                 dateFormat: t
             })
         })
     },
     load_color_picker: function() {
         if ($(".at-color-iris").length > 0) {
             $(".at-color-iris").wpColorPicker()
         }
     }
 };
 window.setTimeout("_metabox_fields.init();", 2e3);
 var simplePanelmedia;
 jQuery(document).ready(function(e) {
     var t = function() {
         function s() {
             return {
                 image_frame: new Array,
                 file_frame: new Array,
                 hooks: function() {
                     e(document).on("click", ".simplePanelimageUpload,.simplePanelfileUpload", function(n) {
                         n.preventDefault();
                         if (e(this).hasClass("simplePanelfileUpload")) {
                             t.upload(e(this), "file")
                         } else {
                             t.upload(e(this), "image")
                         }
                     });
                     e("li").on("click",".simplePanelimageUploadclear,.simplePanelfileUploadclear", function(n) {
                         n.preventDefault();
                         t.set_fields(e(this));
                         e(t.file_url).val("");
                         e(t.file_id).val("");
                         if (e(this).hasClass("simplePanelimageUploadclear")) {
                             t.set_preview("image", false);
                             t.replaceImageUploadClass(e(this))
                         } else {
                             t.set_preview("file", false);
                             t.replaceFileUploadClass(e(this))
                         }
                     })
                 },
                 set_fields: function(n) {
                     t.file_url = e(n).prev();
                     t.file_id = e(t.file_url).prev()
                 },
                 upload: function(n, r) {
                     t.set_fields(n);
                     if (r == "image") {
                         t.upload_Image(e(n))
                     } else {
                         t.upload_File(e(n))
                     }
                 },
                 upload_File: function(n) {
                     var r = e(n).attr("data-mime_type") || "";
                     var i = e(n).attr("data-ext") || false;
                     var s = e(n).attr("id");
                     var o = e(n).hasClass("multiFile") ? true : false;
                     if (typeof t.file_frame[s] !== "undefined") {
                         if (i) {
                             t.file_frame[s].uploader.uploader.param("uploadeType", i);
                             t.file_frame[s].uploader.uploader.param("uploadeTypecaller", "my_meta_box")
                         }
                         t.file_frame[s].open();
                         return
                     }
                     t.file_frame[s] = wp.media({
                         library: {
                             type: r
                         },
                         title: jQuery(this).data("uploader_title"),
                         button: {
                             text: jQuery(this).data("uploader_button_text")
                         },
                         multiple: o
                     });
                     t.file_frame[s].on("select", function() {
                         attachment = t.file_frame[s].state().get("selection").first().toJSON();
                         e(t.file_id).val(attachment.id);
                         e(t.file_url).val(attachment.url);
                         t.replaceFileUploadClass(n);
                         t.set_preview("file", true)
                     });
                     t.file_frame[s].open();
                     if (i) {
                         t.file_frame[s].uploader.uploader.param("uploadeType", i);
                         t.file_frame[s].uploader.uploader.param("uploadeTypecaller", "my_meta_box")
                     }
                 },
                 upload_Image: function(n) {
                     var r = e(n).attr("id");
                     var i = e(n).hasClass("multiFile") ? true : false;
                     if (typeof t.image_frame[r] !== "undefined") {
                         t.image_frame[r].open();
                         return
                     }
                     t.image_frame[r] = wp.media({
                         library: {
                             type: "image"
                         },
                         title: jQuery(this).data("uploader_title"),
                         button: {
                             text: jQuery(this).data("uploader_button_text")
                         },
                         multiple: i
                     });
                     t.image_frame[r].on("select", function() {
                         attachment = t.image_frame[r].state().get("selection").first().toJSON();
                         e(t.file_id).val(attachment.id);
                         e(t.file_url).val(attachment.url);
                         t.replaceImageUploadClass(n);
                         t.set_preview("image", true)
                     });
                     t.image_frame[r].open()
                 },
                 replaceImageUploadClass: function(t) {
                     if (e(t).hasClass("simplePanelimageUpload")) {
                         e(t).removeClass("simplePanelimageUpload").addClass("simplePanelimageUploadclear").val("Remove Image")
                     } else {
                         e(t).removeClass("simplePanelimageUploadclear").addClass("simplePanelimageUpload").val("Upload Image")
                     }
                 },
                 replaceFileUploadClass: function(t) {
                     if (e(t).hasClass("simplePanelfileUpload")) {
                         e(t).removeClass("simplePanelfileUpload").addClass("simplePanelfileUploadclear").val("Remove File")
                     } else {
                         e(t).removeClass("simplePanelfileUploadclear").addClass("simplePanelfileUpload").val("Upload File")
                     }
                 },
                 set_preview: function(n, r) {
                     r = r || false;
                     var i = e(t.file_url).val();
                     if (n == "image") {
                         if (r) {
                             e(t.file_id).prev().find("img").attr("src", i).show()
                         } else {
                             e(t.file_id).prev().find("img").attr("src", "").hide()
                         }
                     } else {
                         if (r) {
                             e(t.file_id).prev().find("ul").append('<li><a href="' + i + '" target="_blank">' + i + "</a></li>")
                         } else {
                             e(t.file_id).prev().find("ul").children().remove()
                         }
                     }
                 }
             }
         }
         var t;
         var n;
         var r;
         var i;
         return {
             getInstance: function() {
                 if (!t) {
                     t = s()
                 }
                 return t
             }
         }
     }();
     simplePanelmedia = t.getInstance();
     simplePanelmedia.hooks()
 });
 jQuery(document).ready(function(e) {
     e(".colorSelector").each(function() {
         var t = this;
         var n = e(t).prev("input").attr("value");
         e(this).ColorPicker({
             color: n,
             onShow: function(t) {
                 e(t).fadeIn(500);
                 return false
             },
             onHide: function(t) {
                 e(t).fadeOut(500);
                 return false
             },
             onChange: function(n, r, i) {
                 e(t).children("div").css("backgroundColor", "#" + r);
                 e(t).prev("input").attr("value", "#" + r)
             }
         })
     })
 })
