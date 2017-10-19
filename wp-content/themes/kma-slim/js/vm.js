function vm_open(e) {
    if (void 0 === openthis && (openthis = "vm"), void 0 === width && (width = 580), "426" == client || window.location.href.search("filesusr.com") > -1 || window.location.href.search("usrfiles.com") > -1) "6173" == client ? (vm_ref = "http://blossomridge.net/", vm_loc = "http://blossomridge.net/") : (vm_ref = "http://swarminteractive.com/", vm_loc = "http://swarminteractive.com/");
    else if ("490" == client) vm_ref = "http://libertymutual.com/", vm_loc = "http://libertymutual.com/";
    else if ("6298" == client) vm_ref = "http://swarminteractive.com/", vm_loc = "http://swarminteractive.com/";
    else try {
        vm_ref = window.location.href, vm_loc = top.location.href
    } catch (t) {
    }
    try {
        if (vm_loc.match(/#vm_(?:[A-Z*])_/i)) {
            var i = vm_loc.match(/#vm_(?:[A-Z*])_(?:[-a-zA-Z0-9]*)/i)[0];
            i = i.substring(4), document.getElementById(openthis).id = i, openthis = i, vm_ref = vm_ref.replace(/#vm_(?:[A-Z*])_(?:[-a-zA-Z0-9]*)/i, "")
        }
    } catch (t) {
    }
    vm_reference = vm_ref, vm_ref = vm_ref.split("#"), vm_ref = vm_ref[0], function (e, t, i, s, o, n) {
        var r = new Object, a = null, l = null;
        _vm_unique++;
        for (var d = 0; d < vm_overrides.length; d++) void 0 !== window[vm_overrides[d]] && (r[vm_overrides[d]] = window[vm_overrides[d]]);
        if (void 0 !== n) {
            e = n.client || e, o = n.target_div || o, i = n.openthis || i, l = n.apikey || null, a = n.callback || null;
            for (var d = 0; d < vm_overrides.length; d++) void 0 !== n[vm_overrides[d]] && (r[vm_overrides[d]] = n[vm_overrides[d]])
        }
        return void 0 == e || 0 == e ? (_vm_show_error("0", t, i, {response: "3100"}, embedded_params), !1) : (window["_vm_" + _vm_unique] = new VM_PLAYER.Player({
            unique: _vm_unique,
            id: i,
            client: e,
            apikey: l,
            ref: t,
            embed: r,
            target: o,
            callback: a
        }), window["_vm_" + _vm_unique].load(), window._vm_players.push(window["_vm_" + _vm_unique]), void(1 == window._vm_players.length && (window._vm = window["_vm_" + _vm_unique])))
    }(client, vm_ref, openthis, embedded_params, target_div, e)
}

function _vm_show_error(e, t, i, s, o) {
    var n = _vm_get_size("tablet", o.width);
    this.viewmedica = document.createElement("iframe"), this.viewmedica.setAttribute("height", n), this.viewmedica.setAttribute("width", o.width), this.viewmedica.setAttribute("frameborder", 0), this.viewmedica.setAttribute("webkitallowfullscreen", "always"), this.viewmedica.setAttribute("mozallowfullscreen", "always"), this.viewmedica.setAttribute("allowfullscreen", "always"), this.viewmedica.setAttribute("title", "ViewMedica Error"), this.viewmedica.style.border = "1px solid #ccc", this.viewmedica.style.overflow = "hidden", this.viewmedica.style["max-width"] = "100%", this.viewmedica.setAttribute("src", "https://swarminteractive.com/vm/viewmedica/error/?client=" + e + "&errno=" + encodeURIComponent(s.response)), lite ? this.viewmedica.setAttribute("id", "viewmedica") : this.viewmedica.setAttribute("id", "viewmedica_" + i), document.getElementById(i).style["max-width"] = "100%", document.getElementById(i).appendChild(this.viewmedica)
}

function _vm_toggle_fs(e, t, i) {
    var s = t.substr(1);
    s = document.getElementById(s), vm_is_full_screen ? (window.onclick = null, window.removeEventListener("resize", _vm_handler), s.removeAttribute("style"), document.getElementById("viewmedica_" + i).removeAttribute("style"), document.getElementById("viewmedica_" + i).setAttribute("style", "border: 1px solid #ccc;max-width: 100%;box-sizing: border-box;"), document.getElementById("viewmedica_" + i).style.border = "1px solid #ccc", document.getElementById("viewmedica_" + i).style["max-width"] = "100%", document.getElementById("viewmedica_" + i).style["box-sizing"] = "border-box", (_vm_prefix_fs(document, "FullScreen") || _vm_prefix_fs(document, "IsFullScreen")) && _vm_prefix_fs(document, "CancelFullScreen")) : (_vm_fullscreen_resize(t, i), window.addEventListener("resize", _vm_handler = function (e) {
        _vm_fullscreen_resize(t, i)
    })), vm_is_full_screen = !vm_is_full_screen
}

function _vm_prefix_fs(e, t) {
    for (var i, s, o = ["webkit", "moz", "ms", "o", ""], n = 0; n < o.length && !e[i];) {
        if (i = t, "" == o[n] && (i = i.substr(0, 1).toLowerCase() + i.substr(1)), i = o[n] + i, s = typeof e[i], "undefined" != s) return o = [o[n]], "function" == s ? e[i]() : e[i];
        n++
    }
}

function _vm_fullscreen_resize(e, t) {
    var i = e.substr(1);
    i = document.getElementById(i);
    var s = window.innerWidth, o = window.innerHeight, n = document.getElementById("viewmedica_" + t),
        r = n.clientWidth, a = n.clientHeight, l = s / o, d = r / a;
    if (i.setAttribute("style", "width: " + s + "px;height: " + o + "px;background: #000000;position: fixed;top: 0;left: 0;z-index: 2147483647;margin-left: 0;margin-right: 0;margin-top: 0;margin-bottom: 0;border: 1px solid #ccc;"), i.style.width = s + "px", i.style.height = o + "px", i.style.background = "#000000", i.style.position = "fixed", i.style.top = "0px", i.style.left = "0px", i.style["z-index"] = "2147483647", i.style["margin-left"] = "0px", i.style["margin-right"] = "0px", i.style["margin-bottom"] = "0px", i.style["margin-top"] = "0px", i.style.border = "1px solid #ccc", l > d) {
        var c = o / (a + 2);
        n.setAttribute("style", "-moz-transform:scale(" + c + ");-moz-transform-origin: 0 0;-webkit-transform:scale(" + c + ");-webkit-transform-origin: 0 0;-o-transform:scale(" + c + ");-o-transform-origin: 0 0;-ms-transform:scale(" + c + ");-ms-transform-origin: 0 0;transform:scale(" + c + ");trasform-transform-origin: 0 0;position: absolute;top: 0;left: " + (s - r * c) / 2 + "px"), n.style["-moz-transform"] = "scale(" + c + ")", n.style["-webkit-transform"] = "scale(" + c + ")", n.style["-o-transform"] = "scale(" + c + ")", n.style["-ms-transform"] = "scale(" + c + ")", n.style.transform = "scale(" + c + ")", n.style["-moz-transform-origin"] = "0 0", n.style["-webkit-transform-origin"] = "0 0", n.style["-o-transform-origin"] = "0 0", n.style["-ms-transform-origin"] = "0 0", n.style["transform-origin"] = "0 0", n.style.position = "absolute", n.style.top = "0", n.style.margin = "0", n.style.left = (s - r * c) / 2 + "px"
    } else {
        var c = s / (r + 2);
        n.setAttribute("style", "-moz-transform:scale(" + c + ");-moz-transform-origin: 0 0;-webkit-transform:scale(" + c + ");-webkit-transform-origin: 0 0;-o-transform:scale(" + c + ");-o-transform-origin: 0 0;-ms-transform:scale(" + c + ");-ms-transform-origin: 0 0;transform:scale(" + c + ");trasform-transform-origin: 0 0;position: absolute;left: 0;top: " + (o - a * c) / 2 + "px"), n.style["-moz-transform"] = "scale(" + c + ")", n.style["-webkit-transform"] = "scale(" + c + ")", n.style["-o-transform"] = "scale(" + c + ")", n.style["-ms-transform"] = "scale(" + c + ")", n.style.transform = "scale(" + c + ")", n.style["-moz-transform-origin"] = "0 0", n.style["-webkit-transform-origin"] = "0 0", n.style["-o-transform-origin"] = "0 0", n.style["-ms-transform-origin"] = "0 0", n.style["transform-origin"] = "0 0", n.style.position = "absolute", n.style.left = "0", n.style.margin = "0", n.style.top = (o - a * c) / 2 + "px"
    }
}

function _vm_parse_status(e) {
    try {
        var t = e.split("|"), i = window["_vm_" + t[0]], s = t[1], o = t[2];
        if ("function" == typeof i) return i(o, "#" + s, s), !0;
        var i = _vm[t[0]];
        if ("function" == typeof i) {
            var n = t[1], r = JSON.parse(n);
            return i.call(_vm, r), !0
        }
    } catch (a) {
    }
}

function _vm_ga(e) {
    try {
        if (window.pageTracker) pageTracker._trackPageview(e); else if (void 0 !== window._gaq) _gaq.push(["_trackPageview", e]); else if (void 0 !== window.ga) {
            try {
                var t = ga.getAll()[0].get("name");
                ga(t + ".send", "event", "ViewMedica Videos", "play", e)
            } catch (i) {
                console.log("ViewMedica could not fetch  tracker name.")
            }
            ga("send", "pageview", e)
        } else console.log("ViewMedica error sending vm to Google Analytics. No analytics method present.")
    } catch (i) {
        console.log("ViewMedica error sending vm to Google Analytics\n" + i)
    }
}

function _vm_lang(e, t) {
    t = t.substring(1), document.getElementById(t).attr("id", e), document.getElementById("viewmedica_" + t).setAttribute("id", "viewmedica_" + e)
}

function _vm_get_size(e, t) {
    return "tablet" == e ? Math.ceil(326 * t / 580) + 60 : "raw" == e ? Math.ceil(326 * t / 580) : "flash" == e || "phone" == e ? Math.ceil(373 * t / 580) : void 0
}

try {
    new window.CustomEvent("?")
} catch (o_O) {
    window.CustomEvent = function (e, t) {
        function i(i, o) {
            var n = document.createEvent(e);
            if ("string" != typeof i) throw new Error("An event name must be provided");
            return "Event" == e && (n.initCustomEvent = s), null == o && (o = t), n.initCustomEvent(i, o.bubbles, o.cancelable, o.detail), n
        }

        function s(e, t, i, s) {
            this.initEvent(e, t, i), this.detail = s
        }

        return i
    }(window.CustomEvent ? "CustomEvent" : "Event", {bubbles: !1, cancelable: !1, detail: null})
}
void 0 === window.vm_modernizr && !function (e, t, i) {
    function s(e, t) {
        return typeof e === t
    }

    function o() {
        var e, t, i, o, n, r, a;
        for (var l in g) if (g.hasOwnProperty(l)) {
            if (e = [], t = g[l], t.name && (e.push(t.name.toLowerCase()), t.options && t.options.aliases && t.options.aliases.length)) for (i = 0; i < t.options.aliases.length; i++) e.push(t.options.aliases[i].toLowerCase());
            for (o = s(t.fn, "function") ? t.fn() : t.fn, n = 0; n < e.length; n++) r = e[n], a = r.split("."), 1 === a.length ? _[a[0]] = o : (!_[a[0]] || _[a[0]] instanceof Boolean || (_[a[0]] = new Boolean(_[a[0]])), _[a[0]][a[1]] = o), b.push((o ? "" : "no-") + a.join("-"))
        }
    }

    function n() {
        return "function" != typeof t.createElement ? t.createElement(arguments[0]) : k ? t.createElementNS.call(t, "http://www.w3.org/2000/svg", arguments[0]) : t.createElement.apply(t, arguments)
    }

    function r() {
        var e = t.body;
        return e || (e = n(k ? "svg" : "body"), e.fake = !0), e
    }

    function a(e, i, s, o) {
        var a, l, d, c, m = "modernizr", h = n("div"), p = r();
        if (parseInt(s, 10)) for (; s--;) d = n("div"), d.id = o ? o[s] : m + (s + 1), h.appendChild(d);
        return a = n("style"), a.type = "text/css", a.id = "s" + m, (p.fake ? p : h).appendChild(a), p.appendChild(h), a.styleSheet ? a.styleSheet.cssText = e : a.appendChild(t.createTextNode(e)), h.id = m, p.fake && (p.style.background = "", p.style.overflow = "hidden", c = x.style.overflow, x.style.overflow = "hidden", x.appendChild(p)), l = i(h, e), p.fake ? (p.parentNode.removeChild(p), x.style.overflow = c, x.offsetHeight) : h.parentNode.removeChild(h), !!l
    }

    function l(e, t) {
        return !!~("" + e).indexOf(t)
    }

    function d(e) {
        return e.replace(/([a-z])-([a-z])/g, function (e, t, i) {
            return t + i.toUpperCase()
        }).replace(/^-/, "")
    }

    function c(e, t) {
        return function () {
            return e.apply(t, arguments)
        }
    }

    function m(e, t, i) {
        var o;
        for (var n in e) if (e[n] in t) return i === !1 ? e[n] : (o = t[e[n]], s(o, "function") ? c(o, i || t) : o);
        return !1
    }

    function h(e) {
        return e.replace(/([A-Z])/g, function (e, t) {
            return "-" + t.toLowerCase()
        }).replace(/^ms-/, "-ms-")
    }

    function p(t, s) {
        var o = t.length;
        if ("CSS" in e && "supports" in e.CSS) {
            for (; o--;) if (e.CSS.supports(h(t[o]), s)) return !0;
            return !1
        }
        if ("CSSSupportsRule" in e) {
            for (var n = []; o--;) n.push("(" + h(t[o]) + ":" + s + ")");
            return n = n.join(" or "), a("@supports (" + n + ") { #modernizr { position: absolute; } }", function (e) {
                return "absolute" == getComputedStyle(e, null).position
            })
        }
        return i
    }

    function u(e, t, o, r) {
        function a() {
            m && (delete P.style, delete P.modElem)
        }

        if (r = s(r, "undefined") ? !1 : r, !s(o, "undefined")) {
            var c = p(e, o);
            if (!s(c, "undefined")) return c
        }
        for (var m, h, u, v, f, w = ["modernizr", "tspan", "samp"]; !P.style && w.length;) m = !0, P.modElem = n(w.shift()), P.style = P.modElem.style;
        for (u = e.length, h = 0; u > h; h++) if (v = e[h], f = P.style[v], l(v, "-") && (v = d(v)), P.style[v] !== i) {
            if (r || s(o, "undefined")) return a(), "pfx" == t ? v : !0;
            try {
                P.style[v] = o
            } catch (g) {
            }
            if (P.style[v] != f) return a(), "pfx" == t ? v : !0
        }
        return a(), !1
    }

    function v(e, t, i, o, n) {
        var r = e.charAt(0).toUpperCase() + e.slice(1), a = (e + " " + C.join(r + " ") + r).split(" ");
        return s(t, "string") || s(t, "undefined") ? u(a, t, o, n) : (a = (e + " " + M.join(r + " ") + r).split(" "), m(a, t, i))
    }

    function f(e, t, s) {
        return v(e, i, i, t, s)
    }

    function w(e, t) {
        return e - 1 === t || e === t || e + 1 === t
    }

    var g = [], y = {
        _version: "3.3.1",
        _config: {classPrefix: "", enableClasses: !0, enableJSClass: !0, usePrefixes: !0},
        _q: [],
        on: function (e, t) {
            var i = this;
            setTimeout(function () {
                t(i[e])
            }, 0)
        },
        addTest: function (e, t, i) {
            g.push({name: e, fn: t, options: i})
        },
        addAsyncTest: function (e) {
            g.push({name: null, fn: e})
        }
    }, _ = function () {
    };
    _.prototype = y, _ = new _;
    var b = [], x = t.documentElement;
    _.addTest("contextmenu", "contextMenu" in x && "HTMLMenuItemElement" in e);
    var z = y._config.usePrefixes ? " -webkit- -moz- -o- -ms- ".split(" ") : ["", ""];
    y._prefixes = z;
    var k = "svg" === x.nodeName.toLowerCase();
    _.addTest("canvas", function () {
        var e = n("canvas");
        return !(!e.getContext || !e.getContext("2d"))
    }), _.addTest("video", function () {
        var e = n("video"), t = !1;
        try {
            (t = !!e.canPlayType) && (t = new Boolean(t), t.ogg = e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/, ""), t.h264 = e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/, ""), t.webm = e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/, ""), t.vp9 = e.canPlayType('video/webm; codecs="vp9"').replace(/^no$/, ""), t.hls = e.canPlayType('application/x-mpegURL; codecs="avc1.42E01E"').replace(/^no$/, ""))
        } catch (i) {
        }
        return t
    }), _.addTest("csscalc", function () {
        var e = "width:", t = "calc(10px);", i = n("a");
        return i.style.cssText = e + z.join(t + e), !!i.style.length
    }), _.addTest("cssgradients", function () {
        for (var e, t = "background-image:", i = "gradient(linear,left top,right bottom,from(#9f9),to(white));", s = "", o = 0, r = z.length - 1; r > o; o++) e = 0 === o ? "to " : "", s += t + z[o] + "linear-gradient(" + e + "left top, #9f9, white);";
        _._config.usePrefixes && (s += t + "-webkit-" + i);
        var a = n("a"), l = a.style;
        return l.cssText = s, ("" + l.backgroundImage).indexOf("gradient") > -1
    }), _.addTest("opacity", function () {
        var e = n("a").style;
        return e.cssText = z.join("opacity:.55;"), /^0.55$/.test(e.opacity)
    }), _.addTest("rgba", function () {
        var e = n("a").style;
        return e.cssText = "background-color:rgba(150,255,150,.5)", ("" + e.backgroundColor).indexOf("rgba") > -1
    }), _.addTest("inlinesvg", function () {
        var e = n("div");
        return e.innerHTML = "<svg/>", "http://www.w3.org/2000/svg" == ("undefined" != typeof SVGRect && e.firstChild && e.firstChild.namespaceURI)
    });
    var E = y.testStyles = a, A = function () {
        var e = navigator.userAgent, t = e.match(/applewebkit\/([0-9]+)/gi) && parseFloat(RegExp.$1),
            i = e.match(/w(eb)?osbrowser/gi),
            s = e.match(/windows phone/gi) && e.match(/iemobile\/([0-9])+/gi) && parseFloat(RegExp.$1) >= 9,
            o = 533 > t && e.match(/android/gi);
        return i || o || s
    }();
    A ? _.addTest("fontface", !1) : E('@font-face {font-family:"font";src:url("https://")}', function (e, i) {
        var s = t.getElementById("smodernizr"), o = s.sheet || s.styleSheet,
            n = o ? o.cssRules && o.cssRules[0] ? o.cssRules[0].cssText : o.cssText || "" : "",
            r = /src/i.test(n) && 0 === n.indexOf(i.split(" ")[0]);
        _.addTest("fontface", r)
    });
    var T = "Moz O ms Webkit", C = y._config.usePrefixes ? T.split(" ") : [];
    y._cssomPrefixes = C;
    var M = y._config.usePrefixes ? T.toLowerCase().split(" ") : [];
    y._domPrefixes = M;
    var V = {elem: n("modernizr")};
    _._q.push(function () {
        delete V.elem
    });
    var P = {style: V.elem.style};
    _._q.unshift(function () {
        delete P.style
    });
    var I = y.testProp = function (e, t, s) {
        return u([e], i, t, s)
    };
    _.addTest("textshadow", I("textShadow", "1px 1px")), y.testAllProps = v, y.testAllProps = f, _.addTest("cssanimations", f("animationName", "a", !0)), _.addTest("bgpositionxy", function () {
        return f("backgroundPositionX", "3px", !0) && f("backgroundPositionY", "5px", !0)
    }), _.addTest("bgrepeatround", f("backgroundRepeat", "round")), _.addTest("bgrepeatspace", f("backgroundRepeat", "space")), _.addTest("backgroundsize", f("backgroundSize", "100%", !0)), _.addTest("bgsizecover", f("backgroundSize", "cover")), _.addTest("borderradius", f("borderRadius", "0px", !0)), _.addTest("boxshadow", f("boxShadow", "1px 1px", !0)), _.addTest("boxsizing", f("boxSizing", "border-box", !0) && (t.documentMode === i || t.documentMode > 7)), _.addTest("ellipsis", f("textOverflow", "ellipsis")), _.addTest("flexbox", f("flexBasis", "1px", !0)), _.addTest("flexboxlegacy", f("boxDirection", "reverse", !0)), _.addTest("flexboxtweener", f("flexAlign", "end", !0)), _.addTest("overflowscrolling", f("overflowScrolling", "touch", !0)), E("#modernizr1{width: 50vm;width:50vmin}#modernizr2{width:50px;height:50px;overflow:scroll}#modernizr3{position:fixed;top:0;left:0;bottom:0;right:0}", function (t) {
        var i = t.childNodes[2], s = t.childNodes[1], o = t.childNodes[0],
            n = parseInt((s.offsetWidth - s.clientWidth) / 2, 10), r = o.clientWidth / 100, a = o.clientHeight / 100,
            l = parseInt(50 * Math.min(r, a), 10),
            d = parseInt((e.getComputedStyle ? getComputedStyle(i, null) : i.currentStyle).width, 10);
        _.addTest("cssvminunit", w(l, d) || w(l, d - n))
    }, 3), o(), delete y.addTest, delete y.addAsyncTest;
    for (var S = 0; S < _._q.length; S++) _._q[S]();
    e.vm_modernizr = _
}(window, document), window.console || (window.console = {
    log: function () {
    }, info: function () {
    }, warn: function () {
    }, error: function () {
    }, fatal: function () {
    }
});
var client = "undefined" == typeof client ? void 0 : client, lang = void 0, audio = void 0, defaultmode = void 0,
    disclaimer = void 0, target_div = void 0, openthis = void 0, menuaccess = void 0, captions = void 0,
    subtitles = void 0, markup = void 0, search = void 0, favorites = void 0, sections = void 0, height = void 0,
    width = void 0, brochures = void 0, brochure = void 0, fullscreen = void 0, ignoreaudio = void 0, autoplay = void 0,
    showhiddenplaylists = void 0, resizetype = "scale", vm_version = void 0, dev = void 0, social = void 0,
    secure = void 0, vm_api = void 0, vm_ref = "undefined" == typeof vm_ref ? void 0 : vm_ref,
    vm_loc = "undefined" == typeof vm_loc ? void 0 : vm_loc,
    vm_reference = "undefined" == typeof vm_reference ? void 0 : vm_reference, device_width = void 0, noplayer = void 0,
    lite = !1, flash = void 0, html5 = void 0, vm_original_width = 0, vm_original_height = 0, vm_is_full_screen = !1,
    embedded_params = new Object, _vm_unique = "undefined" == typeof _vm_unique ? 1 : _vm_unique, _vm_handler,
    VM_PLAYER = VM_PLAYER || {};
VM_PLAYER.Player = function (e) {
    this.unique = e.unique, this.el = null, this.div = null, this.player = null, this.key = "", this.apikey = e.apikey, this.provider = 0, this.urls = null, this.container = null, this.id = e.id, this.target = e.target, this.client = e.client, this.ref = e.ref, this.options = e.embed, this.callback = e.callback, this.defaults = null, this.properties = {
        caption: "",
        playerState: -1,
        currentTime: 0,
        duration: 0,
        volume: 1
    }, this.states = {WAITING: -1, READY: 0, PLAYING: 1, PAUSED: 2}
}, VM_PLAYER.Player.prototype = {
    sendEvent: function (e) {
        var t = new CustomEvent(e.eventName, {detail: e.eventData, bubbles: !0, cancelable: !0});
        this.container.dispatchEvent(t)
    }, load: function () {
        this.ref.search("https") > -1 && (this.options.secure = !0);
        var e = this.options.secure === !1 ? "" : "s",
            t = "http" + e + "://viewmedica.com/vm/viewmedica/allow/?client=" + this.client + "&ref=" + this.ref;
        void 0 !== this.apikey && null !== this.apikey && (t += "&apikey=" + this.apikey), this.jsonp(t, this.start, window["_vm_" + this.unique])
    }, start: function (e) {
        var t = "local" === this.options.dev || "staging" === this.options.dev;
        return void 0 !== e.response ? (_vm_show_error(this.client, this.ref, this.id, e, this.options), !1) : (this.key = e.key, this.provider = e.provider, this.urls = e.urls, this.defaults = e.settings, void 0 === this.target && (this.target = this.id), this.settings(e), this.validate() ? this.modernplus(t) ? void(t ? this.openBeta() : "scale" === this.options.resizetype && 5962 != this.client && 1306 != this.client && 6790 != this.client ? this.openScaled() : this.open()) : void(this.modern() ? (console.log("ViewMedica -> Forced to version 7."), this.options.vm_version = 7, this.open()) : (console.log("ViewMedica -> Forced to version 6."), this.options.vm_version = 6, this.openLegacy())) : (_vm_show_error(this.client, this.ref, this.id, {response: "2196"}, this.options), !1))
    }, validate: function () {
        var e = !1;
        for (var t in this.urls) {
            var i = this.urls[t];
            if (this.ref.search(i) > -1) {
                e = !0;
                break
            }
        }
        return e
    }, open: function () {
        vm_opened_count++;
        var e = "", t = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (e = "&sec=1", t = "s");
        var i = _vm_get_size("tablet", this.options.width);
        this.player = document.createElement("iframe"), this.player.setAttribute("width", this.options.width), this.player.setAttribute("height", i), this.player.setAttribute("frameborder", 0), this.player.setAttribute("webkitallowfullscreen", "always"), this.player.setAttribute("mozallowfullscreen", "always"), this.player.setAttribute("allowfullscreen", "always"), this.player.setAttribute("title", "ViewMedica 8 Video Player"), this.player.setAttribute("id", "viewmedica_" + this.id), this.player.setAttribute("src", "https://viewmedica.com/vm/viewmedica/embed/?client=" + this.client + this.params() + "&ref=" + encodeURIComponent(this.key) + e), this.player.style.border = "1px solid #ccc", this.player.style.overflow = "hidden", this.player.style["max-width"] = "100%", this.player.style["box-sizing"] = "border-box";
        var e = "", t = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (e = "&sec=1", t = "s"), this.div = document.getElementById(this.target), this.div.style["max-width"] = "100%", this.div.style["box-sizing"] = "border-box", this.div.innerHTML = "", this.div.appendChild(this.player), this.div.setAttribute("id", this.id), this.setElement(this.target), "function" == typeof this.callback && this.callback(), this.options.api !== !1 && (window.removeEventListener("message", this.messageReceived, !1), window.addEventListener("message", this.messageReceived, !1))
    }, openScaled: function () {
        vm_opened_count++;
        var e = "", t = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (e = "&sec=1", t = "s");
        _vm_get_size("tablet", this.options.width);
        this.div = document.getElementById(this.target), this.extra = document.createElement("div"), this.extra.className = "Viewmedica Viewmedica--eight Viewmedica--" + vm_opened_count, this.player = document.createElement("iframe"), this.player.setAttribute("width", "100%"), this.player.setAttribute("height", "100%"), this.player.setAttribute("frameborder", 0), this.player.setAttribute("webkitallowfullscreen", "always"), this.player.setAttribute("mozallowfullscreen", "always"), this.player.setAttribute("title", "ViewMedica 8 Video Player"), this.player.setAttribute("allowfullscreen", "always"), this.player.setAttribute("id", "viewmedica_" + this.id), this.player.setAttribute("src", "https://viewmedica.com/vm/viewmedica/embed/?client=" + this.client + this.params() + "&ref=" + encodeURIComponent(this.key) + e);
        var i = document.createElement("style");
        i.innerHTML = ".Viewmedica.Viewmedica--eight { position: relative; display: block; width: " + this.options.width + "px; max-width: 100%; height: auto; }.Viewmedica.Viewmedica--eight.Viewmedica--" + vm_opened_count + " { width: " + this.options.width + 'px; }.Viewmedica.Viewmedica--eight:before { content: ""; display: block; padding-top: 56.4%; }', document.head.appendChild(i), this.player.style.border = "1px solid #dedede", this.player.style.overflow = "hidden", this.player.style.position = "absolute", this.player.style["max-width"] = "100%", this.player.style["box-sizing"] = "border-box", this.player.style.left = "0", this.player.style.top = "0";
        var e = "", t = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (e = "&sec=1", t = "s"), this.div.innerHTML = "", this.div.style["max-width"] = "100%", this.div.appendChild(this.extra), this.extra.appendChild(this.player), this.div.setAttribute("id", this.id), this.setElement(this.target), "function" == typeof this.callback && this.callback(), this.options.api !== !1 && (window.removeEventListener("message", this.messageReceived, !1), window.addEventListener("message", this.messageReceived, !1))
    }, openBeta: function () {
        vm_opened_count++;
        var e = "", t = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (e = "&sec=1", t = "s");
        _vm_get_size("tablet", this.options.width);
        this.div = document.getElementById(this.target), this.extra = document.createElement("div"), this.extra.className = "Viewmedica Viewmedica--eight Viewmedica--" + vm_opened_count, this.player = document.createElement("iframe"), this.player.setAttribute("width", "100%"), this.player.setAttribute("height", "100%"), this.player.setAttribute("frameborder", 0), this.player.setAttribute("webkitallowfullscreen", "always"), this.player.setAttribute("mozallowfullscreen", "always"), this.player.setAttribute("allowfullscreen", "always"), this.player.setAttribute("title", "ViewMedica 8 Video Player"), this.player.setAttribute("id", "viewmedica_" + this.id), "local" === this.options.dev ? this.player.setAttribute("src", "http://localhost:8080/?client=" + this.client + this.params() + "&ref=" + encodeURIComponent(this.key) + e) : this.player.setAttribute("src", "https://viewmedica.com/vm/viewmedica/embed/?client=" + this.client + this.params() + "&ref=" + encodeURIComponent(this.key) + e);
        var i = document.createElement("style");
        i.innerHTML = ".Viewmedica.Viewmedica--eight { position: relative; display: block; width: " + this.options.width + "px; height: auto; }.Viewmedica.Viewmedica--eight.Viewmedica--" + vm_opened_count + " { width: " + this.options.width + 'px; }.Viewmedica.Viewmedica--eight:before { content: ""; display: block; padding-top: 56.4%; }', document.head.appendChild(i), this.player.style.border = "1px solid #dedede", this.player.style.overflow = "hidden", this.player.style.position = "absolute", this.player.style["max-width"] = "100%", this.player.style["box-sizing"] = "border-box", this.player.style.left = "0", this.player.style.top = "0";
        var e = "", t = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (e = "&sec=1", t = "s"), this.div.innerHTML = "", this.div.style.display = "flex", this.div.appendChild(this.extra), this.extra.appendChild(this.player), this.div.setAttribute("id", this.id), this.setElement(this.target), "function" == typeof this.callback && this.callback(), this.options.api !== !1 && (window.removeEventListener("message", this.messageReceived, !1), window.addEventListener("message", this.messageReceived, !1))
    }, openLegacy: function () {
        vm_opened_count++;
        var e = _vm_get_size("flash", this.options.width), t = "", i = "";
        (this.options.secure === !0 || "true" === this.options.secure) && (t = "&secure=true", i = "s"), document.getElementById(this.target).innerHTML = '<object width="' + this.options.width + '" height="' + e + '" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="viewmedica">            <param name="wmode" value="transparent" />            <param name="allowfullscreen" value="true">            <param name="allowscriptaccess" value="always">            <param name="movie" value="http' + i + "://www.swarminteractive.com/subscriptions/viewer.swf?client=" + this.client + this.params() + '&oldembed=false">            <embed src="http' + i + "://www.swarminteractive.com/subscriptions/viewer.swf?client=" + this.client + this.params() + '&oldembed=false"                type="application/x-shockwave-flash"                wmode="transparent"                allowfullscreen="true"                allowscriptaccess="always"                width="' + this.options.width + '" height="' + e + '">            </embed>        </object>'
    }, messageReceived: function (e) {
        window._vm_parse_status(e.data)
    }, settings: function () {
        for (var e = 0; e < vm_overrides.length; e++) {
            var t = vm_overrides[e];
            void 0 === this.options[t] && (this.options[t] = this.defaults[t])
        }
    }, jsonp: function (e, t, i) {
        var s = "viewmedica_jsonp_" + this.unique;
        e += e.match(/\?/) ? "&jsoncallback=" + s : "?jsoncallback=" + s, window[s] = function (e) {
            t.call(i, e), document.getElementsByTagName("head")[0].removeChild(o), o = null, delete window[s]
        };
        var o = document.createElement("script");
        o.type = "text/javascript", o.src = e, document.getElementsByTagName("head")[0].appendChild(o)
    }, modern: function () {
        return (vm_modernizr.rgba && vm_modernizr.fontface && vm_modernizr.opacity && vm_modernizr.video && vm_modernizr.inlinesvg && vm_modernizr.video.h264 || navigator.userAgent.search("iPad") > 0 || this.options.lite) && !this.options.flash && 6 != this.options.vm_version
    }, modernplus: function (e) {
        return e === !0 && (console.log("backgroundsize: " + vm_modernizr.backgroundsize), console.log("bgsizecover: " + vm_modernizr.bgsizecover), console.log("borderradius: " + vm_modernizr.borderradius), console.log("boxshadow: " + vm_modernizr.boxshadow), console.log("boxsizing: " + vm_modernizr.boxsizing), console.log("canvas: " + vm_modernizr.canvas), console.log("cssanimations: " + vm_modernizr.cssanimations), console.log("csscalc: " + vm_modernizr.csscalc), console.log("cssgradients: " + vm_modernizr.cssgradients), console.log("cssvminunit: " + vm_modernizr.cssvminunit), console.log("ellipsis: " + vm_modernizr.ellipsis), console.log("flexbox: " + (vm_modernizr.flexbox || vm_modernizr.flexboxlegacy || vm_modernizr.flexboxtweener)), console.log("fontface: " + vm_modernizr.fontface), console.log("inlinesvg: " + vm_modernizr.inlinesvg), console.log("opacity: " + vm_modernizr.opacity), console.log("rgba: " + vm_modernizr.rgba), console.log("textshadow: " + vm_modernizr.textshadow), console.log("video: " + vm_modernizr.video.h264)), vm_modernizr.backgroundsize && vm_modernizr.bgsizecover && vm_modernizr.borderradius && vm_modernizr.boxshadow && vm_modernizr.boxsizing && vm_modernizr.canvas && vm_modernizr.cssanimations && vm_modernizr.csscalc && vm_modernizr.cssgradients && vm_modernizr.ellipsis && (vm_modernizr.flexbox || vm_modernizr.flexboxlegacy || vm_modernizr.flexboxtweener) && vm_modernizr.fontface && vm_modernizr.inlinesvg && vm_modernizr.opacity && vm_modernizr.rgba && vm_modernizr.textshadow && vm_modernizr.video.h264 && !this.options.flash && 8 == this.options.vm_version
    }, params: function () {
        var e = "";
        return e += "&lang=" + this.options.lang, e += "&openthis=" + this.id, e += "&embedded=" + encodeURIComponent(this.ref), 8 != this.options.vm_version && (e += "&version=" + this.options.vm_version), (this.options.menuaccess === !1 || "false" === this.options.menuaccess) && (e += "&menuaccess=no"), void 0 !== this.apikey && null !== this.apikey && (e += "&apikey=" + this.apikey), (this.options.brochures === !1 || "false" === this.options.brochures || this.options.brochure === !1 || "false" === this.options.brochure) && (e += "&brodefault=false"), (this.options.disclaimer === !1 || "false" === this.options.disclaimer) && (e += "&disclaimer=off"), (this.options.favorites === !0 || "true" === this.options.favorites) && (e += "&favorites=on"), (this.options.captions === !1 || "false" === this.options.captions) && (e += "&captions=off"), (this.options.subtitles === !0 || "true" === this.options.subtitles) && (e += "&subtitles=on"), (this.options.search === !1 || "false" === this.options.search) && (e += "&search=off"), (this.options.sections === !1 || "false" === this.options.sections) && (e += "&sections=off"), (this.options.markup === !1 || "false" === this.options.markup) && (e += "&markup=off"), (this.options.vm_api === !1 || "false" === this.options.vm_api) && (e += "&api=off"), e += this.options.fullscreen === !1 || "false" === this.options.fullscreen ? "&fsmode=no" : "&fsmode=on", (this.options.dev === !0 || "local" === this.options.dev || "staging" === this.options.dev) && (e += "&dev=" + this.options.dev), (this.options.ignoreaudio === !0 || "true" === this.options.ignoreaudio || this.options.audio === !1 || "false" === this.options.audio) && (e += "&ignoreaudio=true"), (this.options.showhiddenplaylists === !0 || "true" === this.options.showhiddenplaylists) && (e += "&showhiddenplaylists=true"), (this.options.defaultmode === !1 || "auto" == this.options.defaultmode) && (e += "&defaultmode=" + this.options.defaultmode), (this.options.autoplay === !0 || "true" == this.options.autoplay) && (e += "&defaultmode=auto"), (this.options.secure === !0 || "true" === this.options.secure) && (e += "&sec=1"), (this.options.social === !1 || "false" === this.options.social) && (e += "&social=" + this.options.social), vm_modernizr.inlinesvg || (e += "&inlinesvg=no"), e
    }, overrideExternalLinks: function (e) {
        this.el.postMessage("overrideExternalLinks|{}", "*"), this.container.addEventListener("onExternalClick", function (t) {
            e(t.detail)
        })
    }, navigate: function (e) {
        this.el.postMessage('navigate|{"data":"' + e + '"}', "*")
    }, setElement: function (e) {
        this.container = document.getElementById("viewmedica_" + e), this.el = this.container.contentWindow
    }, setProperty: function (e) {
        this.properties[e.property] = e.value, "item" === e.property && e.value.label && this.player.setAttribute("title", e.value.label)
    }, getPlayerState: function () {
        return this.properties.playerState
    }, getCurrentTime: function () {
        return this.properties.currentTime
    }, getCaption: function () {
        return this.properties.caption
    }, getDuration: function () {
        return this.properties.duration
    }, playVideo: function () {
        this.el.postMessage("play|{}", "*")
    }, pauseVideo: function () {
        this.el.postMessage("pause|{}", "*")
    }, hideMenus: function () {
        this.el.postMessage("hideMenus|{}", "*")
    }, showMenus: function () {
        this.el.postMessage("showMenus|{}", "*")
    }, exitVideo: function () {
        this.el.postMessage("exitVideo|{}", "*")
    }, seekTo: function (e) {
        this.el.postMessage('seekTo|{"data":' + e + "}", "*")
    }, getVolume: function () {
        return this.properties.volume
    }, setVolume: function (e) {
        this.el.postMessage('setVolume|{"data":' + e + "}", "*")
    }, toggleMute: function () {
        this.el.postMessage("toggleMute|{}", "*")
    }, log: function (e) {
    }
}, window._vm = null, window._vm_players = window._vm_players || [], window.vm_overrides = ["openthis", "lang", "audio", "autoplay", "showhiddenplaylists", "defaultmode", "favorites", "resizetype", "disclaimer", "menuaccess", "captions", "subtitles", "search", "markup", "sections", "width", "height", "vm_api", "vm_version", "brochures", "brochure", "fullscreen", "ignoreaudio", "secure", "device_width", "noplayer", "target_div", "flash", "html5", "social", "embedded", "dev"], window.vm_opened_count = 0;