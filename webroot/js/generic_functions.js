/**
 * Tatoeba Project, free collaborative creation of multilingual corpuses project
 * Copyright (C) 2010 Allan SIMON <allan.simon@supinfo.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *
 */
function get_language_interface_from_url() {
    pathArray = window.location.pathname.split('/');
    return pathArray[1];
}

function get_tatoeba_root_url() {
    var host = self.location.host;
    var interfaceLang = get_language_interface_from_url();

    return "//" + host + "/"+ interfaceLang;
}

/**
 * Returns string without the new lines and stuff.
 */
function normalized_sentence(sentenceText) {
    var reg = new RegExp("[\\t\\n\\r ]+", "gi");
    sentenceText = sentenceText.replace(reg, " ");
    return sentenceText;
}

/**
 * Change the language of the interface.
 */
function changeInterfaceLang(newLang) {
    // Saving the cookie
    var date = new Date();
    date.setMonth(date.getMonth()+1);
    document.cookie = 'CakeCookie[interfaceLanguage]=' + newLang
        + '; path=/'
        + '; expires=' + date.toGMTString();
    location.reload();
}

/**
 * Traverses through paginated pages on Ctrl + Left/Right arrow
 * Only activated when focus is not on a textbox.
 */

function key_navigation() {
    $(document).bind("keydown", function(event) {
        // handle right page turn. 39 = char code for right arrow.
        if(event.ctrlKey && event.which == 39 && document.activeElement.type != "text" && document.activeElement.type != "textarea") {
            $("div.paging span.current").next().children("a")[0].click();
        }
        //handle left page turn. 37 = left arrow
        if(event.ctrlKey && event.which == 37 && document.activeElement.type != "text" && document.activeElement.type != "textarea") {
            $("div.paging span.current").prev().children("a")[0].click();
        }
    });
}

$(document).ready(function() {
    //shortcuts only show up if pagination is present
    if ($("div.paging").length > 0) {
        key_navigation();
    }
});

$(document).ready(function() {
    $(document).watch("addrule", function() {
        $('.sentenceContent .text').each(function() {
            var sentence = $(this);
            if (sentence.data('text') === undefined) {
                sentence.data('text', sentence.text());
            }
        });
    });
});

/**
 * Polyfills
 */
// https://tc39.github.io/ecma262/#sec-array.prototype.find
if (!Array.prototype.find) {
    Object.defineProperty(Array.prototype, 'find', {
      value: function(predicate) {
       // 1. Let O be ? ToObject(this value).
        if (this == null) {
          throw new TypeError('"this" is null or not defined');
        }
  
        var o = Object(this);
  
        // 2. Let len be ? ToLength(? Get(O, "length")).
        var len = o.length >>> 0;
  
        // 3. If IsCallable(predicate) is false, throw a TypeError exception.
        if (typeof predicate !== 'function') {
          throw new TypeError('predicate must be a function');
        }
  
        // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
        var thisArg = arguments[1];
  
        // 5. Let k be 0.
        var k = 0;
  
        // 6. Repeat, while k < len
        while (k < len) {
          // a. Let Pk be ! ToString(k).
          // b. Let kValue be ? Get(O, Pk).
          // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
          // d. If testResult is true, return kValue.
          var kValue = o[k];
          if (predicate.call(thisArg, kValue, k, o)) {
            return kValue;
          }
          // e. Increase k by 1.
          k++;
        }
  
        // 7. Return undefined.
        return undefined;
      },
      configurable: true,
      writable: true
    });
  }