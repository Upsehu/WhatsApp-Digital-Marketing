"use strict";
function WaziperJs(){
    var self= this;
    var tmp_chat = [];
    var INSTANCE_ID = undefined;
    var ACCESS_TOKEN = undefined;
    var realtime = [];
    var change_battery = [];
    var change_state = [];
    var update_chat = [];

    this.init= function(){
        self.fix();
        self.sidebar();
        self.scroll();
        self.date();
        self.inbox();
        self.auto_responder();
        self.bulk_schedule();
        self.actionItem();
        self.actionMultiItem();
        self.actionForm();
        self.file_manager();
        self.check_all();
        self.search();
    },

    this.check_all = function(){
        /*Check all*/
        jQuery(document).on("change", ".waziper .check-all", function(){
            var that = jQuery(this);
            if(jQuery('input:checkbox').hasClass("check-item")){
                if(!that.hasClass("checked")){
                    jQuery('input.check-item:checkbox').prop('checked',true);
                    that.addClass('checked');
                }else{
                    jQuery('input.check-item:checkbox').prop('checked',false);
                    that.removeClass('checked');        
                }
            }
            return false;
        });
    },

    this.file_manager = function(){
        jQuery(document).on("click", ".waziper_media_remove", function(e){
            jQuery('.waziper-box-image').html('');
            jQuery('.waziper-input-image').val('');
        });

        jQuery(document).on("click", ".waziper_media_manager", function(e){
            e.preventDefault();
            var image_frame;
            if(image_frame){
                image_frame.open();
            }
             // Define image_frame as wp.media object
            image_frame = wp.media({
               title: 'Select Media',
               multiple : false,
               library : {
                }
            });

            image_frame.on('close', function(e) {});
            image_frame.on( 'select', function() {
                var attachment = image_frame.state().get('selection').first().toJSON();
                self.file_preview(attachment.url);
            });

            image_frame.on('open',function() {});
            image_frame.open();
        });
    },

    this.file_preview = function(file){
        var filename = file.substring(file.lastIndexOf('/')+1);
        var mime = file.substring(file.lastIndexOf('.')+1);
        jQuery('.waziper-input-image').val( file );
        if(file != ""){
            if( 
                mime == "png" || 
                mime == "jpeg" || 
                mime == "jpg" || 
                mime == "gif"

            ){
                jQuery('.waziper-box-image').html('<img class="waziper-preview-image" src="'+file+'">');
            }else if(
                mime == "mp4" || 
                mime == "3gpp" || 
                mime == "ogg"
            ){
                jQuery('.waziper-box-image').html(`
                    <div class="waziper-empty border w-auto wz-p-20">
                        <div><i class="ri-video-chat-fill text-success wz-fs-100"></i></div>
                        `+filename+`
                    </div>
                `);
            }else if(
                mime == "mp3"
            ){
                jQuery('.waziper-box-image').html(`
                    <div class="waziper-empty border w-auto wz-p-20">
                        <div><i class="ri-file-music-fill text-success wz-fs-100"></i></div>
                        `+filename+`
                    </div>
                `);
            }else{
                jQuery('.waziper-box-image').html(`
                    <div class="waziper-empty border w-auto wz-p-20">
                        <div><i class="ri-file-text-fill text-success wz-fs-100"></i></div>
                        `+filename+`
                    </div>
                `);  
            }
        }
    },

    this.date = function(){

        if( jQuery('.waziper .date').length > 0 || jQuery('.waziper .datetime').length > 0 ){
            jQuery('.waziper .date').datepicker({
                dateFormat: 'dd/mm/yy',
                beforeShow: function(s, a){
                    jQuery('.ui-datepicker-wrap').addClass('active');
                },
                onClose: function(){
                    jQuery('.ui-datepicker-wrap').removeClass('active');
                }
            });

            if( jQuery('.waziper .date').val() == "" ){
                jQuery('.waziper .date').datepicker('setDate', 'today');
            }

            jQuery('.waziper .datetime').datetimepicker({
                dateFormat: 'dd/mm/yy',
                controlType: 'select',
                oneLine: true,
                 beforeShow: function(s, a){
                    jQuery('.ui-datepicker-wrap').addClass('active');
                },
                onClose: function(){
                    jQuery('.ui-datepicker-wrap').removeClass('active');
                }
            });

            if( jQuery('.waziper .datetime').val() == "" ){
                jQuery('.waziper .datetime').datetimepicker( 'setDate', new Date() );
            }

            jQuery('[id^="ui-datepicker-div"]').wrapAll('<div class="ui-datepicker-wrap"></div>'); 
        }
    };

    this.search = function(el){
        if(el == undefined){
            el = 'search-list';
        }

        jQuery(document).on('keyup', '.waziper .search-input', function() {

            var search_element = jQuery(this).data("search");
            if( search_element != undefined ){
                el = search_element;
            }else{
                el = 'search-list';
            }

            var value = jQuery(this).val().toLowerCase();
            jQuery( '.' + el ).filter(function() {
              jQuery(this).toggle(jQuery(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    };

    this.check_login = function( action ){
        jQuery.ajax({
            url: action,
            type: 'GET',
            dataType: "json",
            success: function(result){
                console.log(result);
                if(result.status == "success"){
                    location.reload();
                }else{
                    setTimeout( function(){
                        self.check_login( action );
                    } , 2000);
                }
            },
            error: function(result){
                console.log(result);
            }
        });
    };

    this.scroll = function(){
        jQuery(".waziper .wa-scroll").niceScroll({cursorcolor:"#1d2327", cursorborder: "none", cursoropacitymax: 0.1});

        jQuery(document).on("click", ".waziper .wa-reset-scroll", function(){
            jQuery(".waziper .wa-scroll").getNiceScroll().resize();
        });  
    }

    this.emojioneArea = function(){
        //Emoji texterea
        if(jQuery('.waziper .post-message').length > 0){
            jQuery(".waziper .post-message").emojioneArea({
                hideSource: true,
                useSprite: false,
                pickerPosition    : "bottom",
                filtersPosition   : "top",
            });

            setTimeout(function(){
                jQuery(".waziper .emojionearea-editor").niceScroll({cursorcolor:"#ddd"});
            }, 1000);
        }
    };

    this.editor = function(){
        if(jQuery('.waziper .input-message').length > 0){
            if( jQuery(".waziper .wa-editor .emojionearea").length == 0 ){
                var el = jQuery(".waziper .input-message").emojioneArea({
                    hideSource: true,
                    useSprite: false,
                    pickerPosition    : "top",
                    filtersPosition   : "top",
                });

                setTimeout(function(){
                    jQuery(".waziper .emojionearea-editor").niceScroll({cursorcolor:"#ddd"});
                }, 1000);

                jQuery(".waziper .input-message").data("emojioneArea").on("keyup", function(editor, event) {
                    if (event.keyCode == 13) {
                        if(event.shiftKey){
                            event.stopPropagation();
                        } else {
                            self.send_message();
                        }
                    }
                });
            }
        }
    }

    this.sidebar = function(){

        var window_width = jQuery(window).width();
        if(window_width < 992){
            var wa_w_window = jQuery(window).width();
            var wa_w_actions = jQuery(".waziper .wa-actions").width();
            var wa_w_settings = jQuery(".waziper .wa-settings").width();
            jQuery(".waziper .wa-account-wrapper").width(wa_w_window - wa_w_settings - wa_w_actions);
        }else{
            jQuery(".waziper .wa-account-wrapper").attr("style", "");
        }

        jQuery(window).resize(function(){
            if(window_width < 992){
                var wa_w_window = jQuery(window).width();
                var wa_w_actions = jQuery(".waziper .wa-actions").width();
                var wa_w_settings = jQuery(".waziper .wa-settings").width();

                jQuery(".waziper .wa-account-wrapper").width(wa_w_window - wa_w_settings - wa_w_actions);
            }else{
                jQuery(".waziper .wa-account-wrapper").attr("style", "");
            }
        });

    }

    this.tagsinput = function(el){
        jQuery("."+el).tagsinput("items", {
          trimValue: true
        });
    }

    this.fix = function(){
        var wa_w_window = jQuery(window).width();
        var wa_w_menu = jQuery("#adminmenuback").width();
        var wa_w_submenu = jQuery(".waziper .wa-menu").width();
        var wa_w_wp_menu = jQuery(".waziper .wa-submenu").width();
        var wa_full = wa_w_menu + wa_w_submenu + wa_w_wp_menu;

        if(wa_w_window > 782){
            jQuery(".wa-content").css({"max-width": wa_w_window - wa_full});
        }else{
            jQuery(".wa-content").css({"max-width": "auto"});
        }

        jQuery(window).resize(function(){
            var wa_w_window = jQuery(window).width();
            var wa_w_menu = jQuery("#adminmenuback").width();
            var wa_w_submenu = jQuery(".waziper .wa-menu").width();
            var wa_w_wp_menu = jQuery(".waziper .wa-submenu").width();
            var wa_full = wa_w_menu + wa_w_submenu + wa_w_wp_menu;

            if(wa_w_window > 782){
                jQuery(".wa-content").css({"max-width": wa_w_window - wa_full});
            }else{
                jQuery(".wa-content").css({"max-width": "100%"});
            }
        });


        jQuery(".waziper #wa-accounts").getNiceScroll().resize();
        jQuery(".waziper #wa-pages").getNiceScroll().resize();

        jQuery(window).resize(function(){
            var wa_w_window = jQuery(window).width();
            var wa_w_actions = jQuery(".waziper .wa-actions").width();
            var wa_w_settings = jQuery(".waziper .wa-settings").width();

            jQuery(".waziper .wa-account-wrapper").width(wa_w_window - wa_w_settings - wa_w_actions);
        });
    }

    this.update_scroll = function(){
        setTimeout(function(){
            jQuery(".waziper .wa-scroll").getNiceScroll().resize();
        }, 300);

        setInterval(function(){
            jQuery(".waziper .wa-scroll").getNiceScroll().resize();
        }, 3000);
    }

    this.inbox = function(){

        /*
        * RUN INSTANCE
        */
        jQuery(document).on("click", ".waziper .wa-accounts .nav-item a", function(){
            var that = jQuery(this);
            var action = that.attr("href");
            var instance_id = that.data("instance-id");
            var access_token = that.data("access-token");

            INSTANCE_ID = instance_id;
            ACCESS_TOKEN = access_token;

            self.overplay();
            jQuery.get( action + "&instance_id="+INSTANCE_ID+"&access_token="+ACCESS_TOKEN, function( data ) {
                var data = jQuery.parseJSON(data);
                if(data.status == "success"){
                    jQuery(".wa-info .avatar").attr( "src", data.data.avatar );
                    jQuery(".wa-info .name").html( data.data.name +" | "+ data.data.id );
                    jQuery(".wa-info").removeClass("d-none");
                    jQuery(".whatsapp .subheader-main").hide();

                    jQuery(".wa-pages").html(data.content);
                    jQuery(".wa-account-wrapper").addClass("active");
                    jQuery(".wa-settings .wa-back-account").addClass("active");
                    jQuery('[data-toggle="tooltip"]').tooltip();
                    self.update_scroll();
                }else{
                    if(data.relogin != undefined && data.relogin){
                        jQuery(".wa-accounts a[data-instance-id='"+INSTANCE_ID+"']").parents(".nav-item").remove();
                    }
                    self.notify(data.message, "error");
                }
                self.overplay("hide");
            }).done(function() {})
            .fail(function() {})
            .always(function() {});

            return false;
        });
        /*
        * END RUN INSTANCE
        */

        jQuery(document).on("click", ".waziper .wa-action-item", function(){
            var that = jQuery(this);
            var page = jQuery(this).attr("href");
            var redirect = jQuery(this).data("redirect");
            var el_submenu = jQuery(this).data("result-submenu");
            var el_content = jQuery(this).data("result-content");
            var call_after = jQuery(this).data("call-after");
            var remove = jQuery(this).data("remove");
            var confirm = jQuery(this).data("confirm");

            if(confirm != undefined){
                if(!window.confirm(confirm)) return false;
            }

            if(page != "#" && page !="javascript:void(0);"){
                self.overplay();
                if(page.search("\\?") == -1){
                    var enpoint = page+"?instance_id="+INSTANCE_ID+"&access_token="+ACCESS_TOKEN;
                }else{
                    var enpoint = page+"&instance_id="+INSTANCE_ID+"&access_token="+ACCESS_TOKEN;
                }

                if(redirect != undefined){
                    self.overplay("hide");
                    window.location.assign(enpoint);
                    return false;
                }

                jQuery.get( enpoint, function( data ) {
                    var data = jQuery.parseJSON(data);

                    jQuery(".wa-action-item").parents("li.wa-submenu-item").removeClass("active");
                    that.parents("li.wa-submenu-item").addClass("active");

                    if( that.parents(".wa-settings").length > 0 ){
                        jQuery(".wa-account-wrapper").removeClass("active");
                        that.parents(".wa-menu").find(".wa-action-item").removeClass("active");
                        that.addClass("active");
                    }else{
                        jQuery(".wa-settings").find(".wa-action-item").removeClass("active");
                    }

                    if( that.parents(".wa-actions").length > 0 ){
                        that.parents(".wa-menu").find(".wa-action-item").removeClass("active");
                        that.addClass("active");
                    }else{
                        jQuery(".wa-actions").find(".wa-action-item").removeClass("active");
                    }
                    
                    if(data != "" && data){
                        if(data.status == "success"){
                            jQuery("."+el_submenu).html(data.submenu);
                            jQuery("."+el_content).html(data.content);
    
                            if( that.hasClass("wa-open-content") ){
                                jQuery(".wa-content").addClass("active");
                            }else{
                                jQuery(".wa-content").removeClass("active");
                            }
    
                            if( jQuery(".wa-body").length > 0 ){
                                self.call_load_more_messages();
                                jQuery('.wa-body.wa-scroll').scrollTop( jQuery('.wa-body.wa-scroll').get(0).scrollHeight, -1 );
                            }
    
                            if( data.logout != undefined ){
                                jQuery(".wa-accounts .nav-link[data-instance-id='"+INSTANCE_ID+"']").parents(".nav-item").remove();
                            }
    
                            //Call After
                            if(call_after != undefined){
                                eval(call_after);
                            }

                            //Remove Element
                            if(remove != undefined){
                                that.parents('.'+remove).remove();
                            }
    
                            self.scroll();
                            self.editor();
                            self.emojioneArea();
                            self.date();
                            self.tagsinput("tagsinput");
                            jQuery('[data-toggle="tooltip"]').tooltip();
                            self.caption();
                        }else{
                            if(data.relogin != undefined && data.relogin){
                                window.location.reload();
                            }
                            self.notify(data.message, "error");
                        }
                    }
                    self.overplay("hide");
                });
            }
            return false;
        });

        jQuery(document).on("click", ".waziper .wa-back-submenu", function(){
            jQuery(".wa-content").removeClass("active");
        });

        jQuery(document).on("click", ".waziper .wa-btn-open-content", function(){
            jQuery(".wa-content").addClass("active");
        });

        jQuery(document).on("click", ".waziper .wa-btn-open-content", function(){
            jQuery(".wa-content").addClass("active");
        });

        jQuery(document).on("click", ".waziper .wa-back-account", function(){
            jQuery(".wa-account-wrapper").removeClass("active");
            jQuery(".wa-back-account").removeClass("active");
            self.update_scroll();
            jQuery(".wa-info").addClass("d-none");
            jQuery(".whatsapp .subheader-main").show();
        }); 

        jQuery(document).on("change", ".waziper input[name='chatbot_status']", function(){
            var action = jQuery(this).attr("data-action");
            var data = jQuery.param({instance_id: INSTANCE_ID, access_token: ACCESS_TOKEN });
            self.overplay();
            jQuery.post( action , data, function(result){
                self.overplay("hide");
            });
        }); 
    }

    this.search_contact = function(except){
            var ms = jQuery('.waziper #ms1').magicSuggest({
                placeholder: "Select contact",
                allowFreeEntries: true,
                selectionPosition: 'bottom',
                selectionStacked: true,
                name: 'except',
            });
            ms.setValue(except);
    }

    this.auto_responder = function(){
        var old_text = "";
        var old_media = "";
        setInterval(function(){ 
            if( jQuery(".waziper .autoresponder").length > 0 ){
                var d_none = true;
                var media = jQuery(".autoresponder .waziper-file-manager input").val();
                console.log(media)
                if( (media != undefined && media != old_media) || (media != undefined && jQuery(".autoresponder_preview .item-autoresponder-preview .img").html() == "")){
                    old_media = media;
                    var filename = media.substring(media.lastIndexOf('/')+1);
                    var mime = media.substring(media.lastIndexOf('.')+1);
                    if(media != ""){
                        if( 
                            mime == "png" || 
                            mime == "jpeg" || 
                            mime == "jpg" || 
                            mime == "gif"

                        ){
                            jQuery('.autoresponder_preview .item-autoresponder-preview .img').html("<img src='"+media+"'>");
                        }else if(
                            mime == "mp4" || 
                            mime == "3gpp" || 
                            mime == "ogg"
                        ){
                            jQuery('.autoresponder_preview .item-autoresponder-preview .img').html(`
                                <div class="waziper-empty border w-auto wz-p-20 wz-fs-10">
                                    <div><i class="ri-video-chat-fill text-success wz-fs-30"></i></div>
                                    `+filename+`
                                </div>
                            `);
                        }else if(
                            mime == "mp3"
                        ){
                            jQuery('.autoresponder_preview .item-autoresponder-preview .img').html(`
                                <div class="waziper-empty border w-auto wz-p-20 wz-fs-10">
                                    <div><i class="ri-file-music-fill text-success wz-fs-30"></i></div>
                                    `+filename+`
                                </div>
                            `);
                        }else{
                            jQuery('.autoresponder_preview .item-autoresponder-preview .img').html(`
                                <div class="waziper-empty border w-auto wz-p-20 wz-fs-10">
                                    <div><i class="ri-file-text-fill text-success wz-fs-30"></i></div>
                                    `+filename+`
                                </div>
                            `);  
                        }
                    }

                    var d_none = false;
                }

                var el = jQuery("textarea[name=caption]").emojioneArea();

                setTimeout(function(){
                    var text = el[0].emojioneArea.getText();
                    text = self.nl2br(text); 
                    if( (text != old_text) || jQuery(".autoresponder_preview .item-autoresponder-preview .text").html() == ""){
                        old_text = text; 
                        jQuery(".autoresponder_preview .item-autoresponder-preview .text").html(text);
                        var d_none = false;
                    }
                }, 1000);

                if(d_none){
                    jQuery(".item-autoresponder-preview").removeClass("d-none");
                }else{
                    jQuery(".item-autoresponder-preview").addClass("d-none");
                }
            }
            jQuery(".conversation-wrap.wa-scroll").getNiceScroll().resize();
        }, 3000);
    }

    this.bulk_schedule = function(){
        jQuery(document).on("click", ".waziper .action-contact-group-import", function(){
            var that = jQuery(this);
            var action = that.attr("href");

            jQuery(".wa-contact-group-import-modal").remove();

            self.ajax_post(that, action, {}, function(result){
                jQuery("body").append(result.content);
                jQuery('#wa-contact-group-import-modal').modal('show');
                self.ajax_load_start();
                setTimeout(function(){
                    self.scroll();
                }, 500);
            });

            return false;
        });

        jQuery(document).on("click", ".waziper .wa-bulk-schedules .item .options a", function(){
            event.preventDefault();    
            var that           = jQuery(this);
            var action         = that.attr("href");
            var id             = undefined;
            var data           = jQuery.param({id: id});

            self.ajax_post(that, action, data, function(result){
                if(result.status == "success"){
                    that.parents(".options").html(result.content);
                }
            });
            return false;
        });
    }

    this.reload_contact_group = function(){
        jQuery(".waziper .wa-contact-group-menu").trigger("click");
    }

    this.reload_bulk_create = function(){
        jQuery(".waziper .wa-contact-group-create a").trigger("click");
    }

    this.reload_bulk_schedules = function(result){
        if(result.status == "success"){
            jQuery(".waziper .wa-contact-group-shedule a").trigger("click");
        }
    }

    this.reload_chatbot = function(result){
        if(result.status == "success"){
            jQuery(".waziper .menu-item-chatbot").trigger("click");
        }
    }
    
    this.ajax_load_start = function(){
        self.call_load_more();
        self.ajax_load(0);
    };

    this.call_load_more = function(){
        var that = jQuery('.waziper .ajax-load-log[data-load-type="scroll"]');
        var scrollDiv = that.data('scroll');
        if ( that.length > 0 )
        {
            jQuery(scrollDiv).bind('scroll',function(){
                var _scrollPadding = 80;
                var _scrollTop = jQuery(scrollDiv).scrollTop();
                var _divHeight = jQuery(scrollDiv).height();
                var _scrollHeight = jQuery(scrollDiv).get(0).scrollHeight;

                jQuery(window).trigger('resize'); 
                if( _scrollTop + _divHeight + _scrollPadding >= _scrollHeight) {
                    self.ajax_load();
                }

            });
        }
    };

    this.ajax_load = function(page){
        var that = jQuery('.waziper .ajax-load-log');
        var url = that.attr('data-url');
        var ids = that.data('id');

        if(page != undefined){
            that.attr('data-page', 0);
            that.attr('data-loading', 0);
        }

        if ( that.length > 0 )
        {
            var action = url;
            var page = parseInt(that.attr('data-page'));
            var loading = that.attr('data-loading');
            var data = { page: page };
            var scrollDiv = that.data('scroll');

            if ( loading == undefined || loading == 0 )
            {
                that.attr('data-loading', 1);
                jQuery.ajax({
                    url: action,
                    type: 'POST',
                    dataType: 'html',
                    data: data
                }).done(function(result) {
                    if ( page == 0 )
                    {
                        that.html( result );
                    }
                    else
                    {
                        that.append( result );
                    }

                    if(result != ''){
                        that.attr('data-loading', 0);
                    } 

                    that.attr( 'data-page', page + 1);
                    self.scroll();
                    jQuery(".nicescroll").getNiceScroll().resize();
                });
            }
        }
    };

    this.caption = function(){
        //Review content
        if(jQuery(".waziper .post-message").length > 0){
            jQuery(".waziper .post-message").data("emojioneArea").on("keyup", function(editor) {
                var data = editor.html();
                editor.parents(".waziper-caption").find('.count-word span').html( data.length );
                if(data != ""){
                    jQuery(".post-preview .waziper-caption").html(data);
                }else{
                    jQuery(".post-preview .waziper-caption").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

            jQuery(".waziper .post-message").data("emojioneArea").on("change", function(editor) {
                var data = editor.html();
                editor.parents(".waziper-caption").find('.count-word span').html( data.length );
                if(data != ""){
                    jQuery(".post-preview .waziper-caption").html(data);
                }else{
                    jQuery(".post-preview .waziper-caption").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });

            jQuery(".waziper .post-message").data("emojioneArea").on("emojibtn.click", function(editor) {
                var data = jQuery(".emojionearea-editor").html();
                editor.parents(".waziper-caption").find('.count-word span').html( data.length );
                if(data != ""){
                    jQuery(".post-preview .waziper-caption").html(data);
                }else{
                    jQuery(".post-preview .waziper-caption").html('<div class="line-no-text"></div><div class="line-no-text"></div><div class="line-no-text w50"></div>');
                }
            });
        }
    }

    this.nl2br = function(str, is_xhtml) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    this.overplay = function(status){
        if(status == undefined){
            jQuery(".waziper-loading-overplay").show();
            if(jQuery(".waziper-modal").hasClass("in")){
                jQuery(".waziper-loading-overplay").addClass("top");
            }else{
                jQuery(".waziper-loading-overplay").removeClass("top");
            }
        }else{
            jQuery(".waziper-loading-overplay").hide();
        }
    };

    this.actionItem= function(){
        jQuery(document).on('click', ".Waziper_actionItem", function(event) {
            event.preventDefault();    
            var that           = jQuery(this);
            var action         = that.attr("href");
            var id             = that.data("id");
            var data           = jQuery.param({id: id});

            self.ajax_post(that, action, data, null);
            return false;
        });
    };

    this.actionMultiItem= function(){
        jQuery(document).on('click', ".Waziper_actionMultiItem", function(event) {
            event.preventDefault();    
            var that           = jQuery(this);
            var form           = that.closest("form");
            var action         = that.attr("href");
            var params         = that.data("params");
            var data           = form.serialize();
            var data           = data + "&" + params;
            self.ajax_post(that, action, data, null);
            return false;
        });
    };

    this.actionForm= function(){
        jQuery(document).on('submit', ".Waziper_actionForm", function(event) {
            event.preventDefault();    
            var that           = jQuery(this);
            var action         = that.attr("action");
            var data           = that.serialize();
            var data           = data
            
            self.ajax_post(that, action, data, null);
        });
    };

    this.ajax_post = function(that, action, data, _function){
        var confirm        = that.data("confirm");
        var transfer       = that.data("transfer");
        var type_message   = that.data("type-message");
        var rediect        = that.data("redirect");
        var content        = that.data("content");
        var append_content = that.data("append-content");
        var callback       = that.data("callback");
        var history_url    = that.data("history");
        var hide_overplay  = that.data("hide-overplay");
        var call_after     = that.data("call-after");
        var remove         = that.data("remove");
        var type           = that.data("result");
        var object         = false;

        if(type == undefined){
            type = 'json';
        }

        if(confirm != undefined){
            if(!window.confirm(confirm)) return false;
        }

        if(history_url != undefined){
            history.pushState(null, '', history_url);
        }

        if(!that.hasClass("disabled")){
            if(hide_overplay == undefined || hide_overplay == 1){
                self.overplay();
            }
            that.addClass("disabled");
            jQuery.post(action, data, function(result){
                
                //Check is object
                if(typeof result != 'object'){
                    try {
                        result = jQuery.parseJSON(result);
                        object = true;
                    } catch (e) {
                        object = false;
                    }
                }else{
                    object = true;
                }

                //Run function
                if(_function != null){
                    _function.apply(this, [result]);
                }

                //Callback function
                if(result.callback != undefined){
                    jQuery("body").append(result.callback);
                }

                //Callback
                if(callback != undefined){
                    var fn = window[callback];
                    if (typeof fn === "function") fn(result);
                }

                //Using for update
                if(transfer != undefined){
                    that.removeClass("tag-success tag-danger").addClass(result.tag).text(result.text);
                }

                //Add content
                if(content != undefined && object == false){
                    if(append_content != undefined){
                        jQuery("."+content).append(result);
                    }else{
                        jQuery("."+content).html(result);
                    }
                }

                //Call After
                if(call_after != undefined){
                    eval(call_after);
                }

                //Remove Element
                if(remove != undefined){
                    that.parents('.'+remove).remove();
                }

                //Hide Loading
                self.overplay(true);
                that.removeClass("disabled");

                //Redirect
                self.redirect(rediect, result.status);

                //Message
                if(result.status != undefined){
                    switch(type_message){
                        case "text":
                            self.notify(result.message, result.status);
                            break;

                        default:
                            self.notify(result.message, result.status);
                            break;
                    }
                }

            }, type).fail(function() {
                that.removeClass("disabled");
            });
        }

        return false;
    };

    this.callbacks = function(_function){
        jQuery("body").append(_function);
    };

    this.redirect = function(_rediect, _status){
        if(_rediect != undefined && _status == "success"){
            setTimeout(function(){
                window.location.assign(_rediect);
            }, 1500);
        }
    };

    this.notify = function(_message, _type){
        if(_message != undefined && _message != ""){
            switch(_type){
                case "success":
                    var backgroundColor = "#25d366";
                    break;

                case "error":
                    var backgroundColor = "#ff0081";
                    break;

                default:
                    var backgroundColor = "#25d366";
                    break;
            }

            iziToast.show({
                theme: 'dark',
                icon: 'far fa-bell',
                title: '',
                position: 'bottomCenter',
                message: _message,
                backgroundColor: backgroundColor,
                progressBarColor: 'rgb(255, 255, 255, 0.5)',
            });
        }
    };
}

WaziperJs= new WaziperJs();
jQuery(function(){
    WaziperJs.init();
});