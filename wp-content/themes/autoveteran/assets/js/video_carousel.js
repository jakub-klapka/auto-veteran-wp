!function(i){var t={init:function(i){this.wrap=i,this.main_video=this.wrap.find("[data-video-carousel-main_video]"),this.items=this.wrap.find("[data-video-carousel-item]"),this.video_template=this.wrap.find("[data-video-carousel-template]").html(),this.current_item=this.items.eq(0),this.bindEvents()},bindEvents:function(){var t=this;this.items.on("click",function(e){e.preventDefault(),t.itemClicked(i(this))})},itemClicked:function(i){i.is(this.current_item)||this.changeVideo(i)},changeVideo:function(i){this.current_item=i;var t=i.data("yt-id");this.items.removeClass("is-active"),i.addClass("is-active");var e=this.video_template.replace("[[YT_ID]]",t);this.main_video.html(e)}};i(function(){i("[data-video-carousel]").each(function(){Object.create(t).init(i(this))}),i(window).load(function(){var t=i(".home_recent_videos__video_strip__button__desc");t.css("max-height","100%"),t.trunk8({lines:2}),t.css("max-height","")})})}(jQuery);