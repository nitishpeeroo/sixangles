document.gambitIsIE=function(){var t=navigator.userAgent.toLowerCase();return-1!==t.indexOf("msie")?parseInt(t.split("msie")[1],10):!1},document.gambitFindElementParentRow=function(t){var e=t.parentNode;if(e.classList)for(;!e.classList.contains("vc_row")&&!e.classList.contains("wpb_row");){if("HTML"===e.tagName){e=!1;break}e=e.parentNode}if(e!==!1)return e;e=t.parentNode;for(var a=!1;!a;){if(Array.prototype.forEach.call(e.classList,function(t){return a?void 0:t.match(/row/g)?void(a=!0):void 0}),a)return e;if("HTML"===e.tagName)break;e=e.parentNode}return t.parentNode};var loadRowSeparators=function(){if(!document.querySelector("body").classList.contains("vc_editor")){var t=document.querySelectorAll(".gambit_separator");Array.prototype.forEach.call(t,function(t){if(document.gambitIsIE()&&document.gambitIsIE()<10)return void t.parentNode.removeChild(t);var e=document.gambitFindElementParentRow(t),a=-1!==t.getAttribute("class").indexOf("gambit_sep_top");e.appendChild(t),e.classList.add("gambit_sep_parent"),e.classList.add(a?"gambit_sep_parent_top":"gambit_sep_parent_bottom"),e.style[a?"marginTop":"marginBottom"]=0;var r=t.querySelectorAll(".gambit_sep_main");Array.prototype.forEach.call(r,function(t){var a=getComputedStyle(e).backgroundColor;if("rgba(0, 0, 0, 0)"===a||"transparent"===a)a="#fff";else{var r=a.match(/rgba\(\s?\d+\s?,\s?\d+\s?,\s?\d+\s?,\s?(\d+)\s?\)/);r&&(r=parseFloat(r[1]),0===r&&(a="#fff"))}t.style.fill=a});var s,o=a?e.previousElementSibling:e.nextElementSibling,i=a?"padding-bottom":"padding-top",n=parseInt(t.getAttribute("data-height"),10)||200;o&&o.classList&&o.classList.contains("vc_row-full-width")&&(o=a?o.previousElementSibling:o.nextElementSibling),o&&(s=parseInt(getComputedStyle(o)[i],10)||0,o.style.cssText=i+": calc("+n+" / 1600 * 100vw + "+s+"px) !important;"+o.style.cssText,o.style[a?"marginBottom":"marginTop"]=0),t.setAttribute("class",t.getAttribute("class")+" gambit_sep_loaded"),t.style.display="block";var l=t.getAttribute("style");l=l.replace(/(display:\s?block)(\s*!\s?important)?(\s*[;"']?)/g,"$1 !important$3"),t.setAttribute("style",l)}),t=document.querySelectorAll(".gambit_sep_parent_bottom");var e=t.length+3;Array.prototype.forEach.call(t,function(t,a){t.style.cssText="z-index: "+(e-a)+" !important;"+t.style.cssText})}};loadRowSeparators();