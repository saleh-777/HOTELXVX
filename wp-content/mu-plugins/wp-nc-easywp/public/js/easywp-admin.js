!function(n){"use strict";var t,o;function e(e){0!==n("#hack-guardian-toast").length&&(t=e.clientX,o=n("#hack-guardian-toast").offset().left,n(window).width()<800?n("#hack-guardian-toast").css({right:20}):n(document).mousemove(function(e){e=e.clientX-t,e=o+e<n(window).width()-n("#hack-guardian-toast").width()-60?o+e:n(window).width()-n("#hack-guardian-toast").width()-60;e<=20||n("#hack-guardian-toast").css({left:e})}))}n(window).on("resize",e),n("#hack-guardian-toast").on("mousedown",e),n(document).mouseup(function(){n(document).off("mousemove")}),n(document).ready(function(){n("#wp-admin-bar-hack-guardian").on("click",function(){n("#hack-guardian-toast").toggleClass("open")}),n(".hackguardian-tooltip-trigger").hover(function(){n(this).append('<span class="tooltip">Enabling HackGuardian protects your website. However, disable the tool when accessing SFTP, installing plugins and themes, and updating WordPress. Enabling/disabling may result in 10 seconds of downtime (in rare cases up to 60 seconds).<br/><span class="flex-link"><a href="https://www.easywp.com/blog/wordpress-site-protector-hackguardian/" target="_blank">Learn more</a><span class="external-icon"></span></span></span>')},function(){n(this).find(".tooltip").remove()})}),n("#hack-guardian-toast-toggle").on("change",function(){var e;n.post(ajaxurl,{action:"hack_guardian",nonce:easyWP.nonce,enabled:this.checked},function(e){}),n("#hack-guardian-checkbox").prop("checked",this.checked),e=this.checked,n("#hack-guardian-toast").find(".content > p").replaceWith(easyWP.description[e?"enabled":"disabled"]),n("#hack-guardian-toast").find(".status .info > p").replaceWith(e?"<p>Enabled</p>":"<p>Disabled</p>"),n("#hack-guardian-toast").find("input[type='checkbox']").prop("checked",e),n("#hack-guardian-toast").find(".content").css({height:"144px"})}),n("#hack-guardian-checkbox").on("change",function(){n.post(ajaxurl,{action:"hack_guardian",nonce:easyWP.nonce,enabled:this.checked},function(e){})}),n("#hack-guardian-accordion-button").on("click",function(){n(this).parent().toggleClass("close")}),"enabled"===easyWP.hackGuardian&&n(document).ready(function(){n("body.plugins-php").find(".page-title-action").remove(),n("body.plugins-php").find(".update-link").replaceWith("<strong>Disable HackGuardian</strong>"),n("body.plugins-php").find(".toggle-auto-update").remove(),n("body.plugins-php").find(".delete").remove(),n("body.plugins-php").find("select[name='action']").find("option[value='update-selected']").remove(),n("body.plugins-php").find("select[name='action']").find("option[value='delete-selected']").remove(),n("body.plugins-php").find("select[name='action2']").find("option[value='update-selected']").remove(),n("body.plugins-php").find("select[name='action2']").find("option[value='delete-selected']").remove(),n("body.plugin-install-php").find(".page-title-action").remove(),n("body.plugin-install-php").find("#doaction").attr("disabled","disabled"),n("body.plugin-install-php").find("select[name='action'").attr("disabled","disabled"),n("body.plugin-install-php").find("#doaction2").attr("disabled","disabled"),n("body.plugin-install-php").find("select[name='action2'").attr("disabled","disabled"),n("body.plugin-install-php").find(".install-now.button").remove(),n("body.plugin-install-php").find(".update-now.button").remove(),n("body.plugin-editor-php").find('form[action="plugin-editor.php"]').remove(),n("body.update-core-php").find('form[action="update-core.php?action=do-core-upgrade"]').remove(),n("body.update-core-php").find('form[action="update-core.php?action=do-plugin-upgrade"]').remove(),n("body.update-core-php").find('form[action="update-core.php?action=do-theme-upgrade"]').remove(),n("body.update-core-php").find('form[action="update-core.php?action=do-translation-upgrade"]').remove(),n("body.themes-php").find(".page-title-action").remove(),n("body.themes-php").find(".button-link").remove(),n("body.themes-php").find("#update-theme").remove(),n("body.themes-php").find(".delete-theme").remove(),n("body.theme-install-php").find(".page-title-action").remove(),n(document).on("DOMSubtreeModified",function(){n("body.theme-install-php").find(".theme-install").remove(),n("body.themes-php").find("#update-theme").remove(),n("body.themes-php").find(".delete-theme").remove()}),n("body.theme-editor-php").find("#templateside").remove(),n("body.theme-editor-php").find('form[action="theme-editor.php"]').remove(),n("body.import-php").find(".install-now").remove(),n("body.import-php").find(".importer-item:last").find(".importer-action").remove()})}(jQuery);