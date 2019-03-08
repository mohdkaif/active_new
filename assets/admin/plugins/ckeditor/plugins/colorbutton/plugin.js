﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.plugins.add("colorbutton",{requires:"panelbutton,floatpanel",lang:"af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",icons:"bgcolor,textcolor",hidpi:!0,init:function(f){function t(a,e,g,h,m){var n=new CKEDITOR.style(l["colorButton_"+e+"Style"]),q=CKEDITOR.tools.getNextId()+"_colorBox",p;m=m||{};f.ui.add(a,
CKEDITOR.UI_PANELBUTTON,{label:g,title:g,modes:{wysiwyg:1},editorFocus:0,toolbar:"colors,"+h,allowedContent:n,requiredContent:n,contentTransformations:m.contentTransformations,panel:{css:CKEDITOR.skin.getPath("editor"),attributes:{role:"listbox","aria-label":k.panelTitle}},onBlock:function(a,b){p=b;b.autoSize=!0;b.element.addClass("cke_colorblock");b.element.setHtml(y(a,e,q));b.element.getDocument().getBody().setStyle("overflow","hidden");CKEDITOR.ui.fire("ready",this);var c=b.keys,d="rtl"==f.lang.dir;
c[d?37:39]="next";c[40]="next";c[9]="next";c[d?39:37]="prev";c[38]="prev";c[CKEDITOR.SHIFT+9]="prev";c[32]="click"},refresh:function(){f.activeFilter.check(n)||this.setState(CKEDITOR.TRISTATE_DISABLED)},onOpen:function(){var a=f.getSelection(),b=a&&a.getStartElement(),c=f.elementPath(b);if(c){b=c.block||c.blockLimit||f.document.getBody();do c=b&&b.getComputedStyle("back"==e?"background-color":"color")||"transparent";while("back"==e&&"transparent"==c&&b&&(b=b.getParent()));c&&"transparent"!=c||(c=
"#ffffff");!1!==l.colorButton_enableAutomatic&&this._.panel._.iframe.getFrameDocument().getById(q).setStyle("background-color",c);if(b=a&&a.getRanges()[0]){for(var a=new CKEDITOR.dom.walker(b),d=b.collapsed?b.startContainer:a.next(),b="";d;){d.type===CKEDITOR.NODE_TEXT&&(d=d.getParent());d=u(d.getComputedStyle("back"==e?"background-color":"color"));b=b||d;if(b!==d){b="";break}d=a.next()}a=b;b=p._.getItems();for(d=0;d<b.count();d++){var g=b.getItem(d);g.removeAttribute("aria-selected");a&&a==u(g.getAttribute("data-value"))&&
g.setAttribute("aria-selected",!0)}}return c}}})}function y(a,e,g){var h=[],m=l.colorButton_colors.split(","),n=l.colorButton_colorsPerRow||6,q=f.plugins.colordialog&&!1!==l.colorButton_enableMore,p=m.length+(q?2:1),r=CKEDITOR.tools.addFunction(function z(b,c){function d(a){this.removeListener("ok",d);this.removeListener("cancel",d);"ok"==a.name&&z(this.getContentElement("picker","selectedColor").getValue(),c)}if("?"==b)f.openDialog("colordialog",function(){this.on("ok",d);this.on("cancel",d)});else{f.focus();
a.hide();f.fire("saveSnapshot");f.removeStyle(new CKEDITOR.style(l["colorButton_"+c+"Style"],{color:"inherit"}));if(b){var e=l["colorButton_"+c+"Style"];e.childRule="back"==c?function(a){return v(a)}:function(a){return!(a.is("a")||a.getElementsByTag("a").count())||v(a)};f.applyStyle(new CKEDITOR.style(e,{color:b}))}f.fire("saveSnapshot")}});!1!==l.colorButton_enableAutomatic&&h.push('\x3ca class\x3d"cke_colorauto" _cke_focus\x3d1 hidefocus\x3dtrue title\x3d"',k.auto,'" onclick\x3d"CKEDITOR.tools.callFunction(',
r,",null,'",e,"');return false;\" href\x3d\"javascript:void('",k.auto,'\')" role\x3d"option" aria-posinset\x3d"1" aria-setsize\x3d"',p,'"\x3e\x3ctable role\x3d"presentation" cellspacing\x3d0 cellpadding\x3d0 width\x3d"100%"\x3e\x3ctr\x3e\x3ctd colspan\x3d"'+n+'" align\x3d"center"\x3e\x3cspan class\x3d"cke_colorbox" id\x3d"',g,'"\x3e\x3c/span\x3e',k.auto,"\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e\x3c/a\x3e");h.push('\x3ctable role\x3d"presentation" cellspacing\x3d0 cellpadding\x3d0 width\x3d"100%"\x3e');
for(g=0;g<m.length;g++){0===g%n&&h.push("\x3c/tr\x3e\x3ctr\x3e");var b=m[g].split("/"),c=b[0],d=b[1]||c;b[1]||(c="#"+c.replace(/^(.)(.)(.)$/,"$1$1$2$2$3$3"));b=f.lang.colorbutton.colors[d]||d;h.push('\x3ctd\x3e\x3ca class\x3d"cke_colorbox" _cke_focus\x3d1 hidefocus\x3dtrue title\x3d"',b,'" onclick\x3d"CKEDITOR.tools.callFunction(',r,",'",c,"','",e,"'); return false;\" href\x3d\"javascript:void('",b,'\')" data-value\x3d"'+d+'" role\x3d"option" aria-posinset\x3d"',g+2,'" aria-setsize\x3d"',p,'"\x3e\x3cspan class\x3d"cke_colorbox" style\x3d"background-color:#',
d,'"\x3e\x3c/span\x3e\x3c/a\x3e\x3c/td\x3e')}q&&h.push('\x3c/tr\x3e\x3ctr\x3e\x3ctd colspan\x3d"'+n+'" align\x3d"center"\x3e\x3ca class\x3d"cke_colormore" _cke_focus\x3d1 hidefocus\x3dtrue title\x3d"',k.more,'" onclick\x3d"CKEDITOR.tools.callFunction(',r,",'?','",e,"');return false;\" href\x3d\"javascript:void('",k.more,"')\"",' role\x3d"option" aria-posinset\x3d"',p,'" aria-setsize\x3d"',p,'"\x3e',k.more,"\x3c/a\x3e\x3c/td\x3e");h.push("\x3c/tr\x3e\x3c/table\x3e");return h.join("")}function v(a){return"false"==
a.getAttribute("contentEditable")||a.getAttribute("data-nostyle")}function u(a){return CKEDITOR.tools.convertRgbToHex(a||"").replace(/#/,"").toLowerCase()}var l=f.config,k=f.lang.colorbutton;if(!CKEDITOR.env.hc){t("TextColor","fore",k.textColorTitle,10,{contentTransformations:[[{element:"font",check:"span{color}",left:function(a){return!!a.attributes.color},right:function(a){a.name="span";a.attributes.color&&(a.styles.color=a.attributes.color);delete a.attributes.color}}]]});var w={},x=f.config.colorButton_normalizeBackground;
if(void 0===x||x)w.contentTransformations=[[{element:"span",left:function(a){var e=CKEDITOR.tools;if("span"!=a.name||!a.styles||!a.styles.background)return!1;a=e.style.parse.background(a.styles.background);return a.color&&1===e.objectKeys(a).length},right:function(a){var e=(new CKEDITOR.style(f.config.colorButton_backStyle,{color:a.styles.background})).getDefinition();a.name=e.element;a.styles=e.styles;a.attributes=e.attributes||{};return a}}]];t("BGColor","back",k.bgColorTitle,20,w)}}});
CKEDITOR.config.colorButton_colors="1ABC9C,2ECC71,3498DB,9B59B6,4E5F70,F1C40F,16A085,27AE60,2980B9,8E44AD,2C3E50,F39C12,E67E22,E74C3C,ECF0F1,95A5A6,DDD,FFF,D35400,C0392B,BDC3C7,7F8C8D,999,000";CKEDITOR.config.colorButton_foreStyle={element:"span",styles:{color:"#(color)"},overrides:[{element:"font",attributes:{color:null}}]};CKEDITOR.config.colorButton_backStyle={element:"span",styles:{"background-color":"#(color)"}};