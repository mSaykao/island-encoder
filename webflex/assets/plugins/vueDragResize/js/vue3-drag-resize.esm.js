/**
 * Bundled by jsDelivr using Rollup v2.79.1 and Terser v5.19.2.
 * Original file: /npm/vue3-drag-resize@2.0.5/dist/index.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
import t from "../../../js/vue.build.js";
import ResizeObserver from "../../polyfill/resize-observer-polyfill.esm.js"

var e, i = {exports: {}};
self;
var n = i.exports = (e = t, (() => {
    var t = {
        705: t => {
            t.exports = function (t) {
                var e = [];
                return e.toString = function () {
                    return this.map((function (e) {
                        var i = t(e);
                        return e[2] ? "@media ".concat(e[2], " {").concat(i, "}") : i
                    })).join("")
                }, e.i = function (t, i, n) {
                    "string" == typeof t && (t = [[null, t, ""]]);
                    var o = {};
                    if (n) for (var r = 0; r < this.length; r++) {
                        var a = this[r][0];
                        null != a && (o[a] = !0)
                    }
                    for (var s = 0; s < t.length; s++) {
                        var h = [].concat(t[s]);
                        n && o[h[0]] || (i && (h[2] ? h[2] = "".concat(i, " and ").concat(h[2]) : h[2] = i), e.push(h))
                    }
                }, e
            }
        }, 566: (t, e, i) => {
            i.d(e, {Z: () => r});
            var n = i(705), o = i.n(n)()((function (t) {
                return t[1]
            }));
            o.push([t.id, ".vdr {\n    position: absolute;\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n}\n.vdr.active:before{\n    content: '';\n    width: 100%;\n    height: 100%;\n    position: absolute;\n    top: 0;\n    left: 0;\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n    outline: 1px dashed #d6d6d6;\n}\n.vdr-stick {\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n    position: absolute;\n    font-size: 1px;\n    background: #ffffff;\n    border: 1px solid #6c6c6c;\n    -webkit-box-shadow: 0 0 2px #bbb;\n            box-shadow: 0 0 2px #bbb;\n}\n.inactive .vdr-stick {\n    display: none;\n}\n.vdr-stick-tl, .vdr-stick-br {\n    cursor: nwse-resize;\n}\n.vdr-stick-tm, .vdr-stick-bm {\n    left: 50%;\n    cursor: ns-resize;\n}\n.vdr-stick-tr, .vdr-stick-bl {\n    cursor: nesw-resize;\n}\n.vdr-stick-ml, .vdr-stick-mr {\n    top: 50%;\n    cursor: ew-resize;\n}\n.vdr-stick.not-resizable{\n    display: none;\n}\n.content-container{\n    display: block;\n    position: relative;\n}", ""]);
            const r = o
        }, 379: (t, e, i) => {
            var n, o = function () {
                var t = {};
                return function (e) {
                    if (void 0 === t[e]) {
                        var i = document.querySelector(e);
                        if (window.HTMLIFrameElement && i instanceof window.HTMLIFrameElement) try {
                            i = i.contentDocument.head
                        } catch (t) {
                            i = null
                        }
                        t[e] = i
                    }
                    return t[e]
                }
            }(), r = [];

            function a(t) {
                for (var e = -1, i = 0; i < r.length; i++) if (r[i].identifier === t) {
                    e = i;
                    break
                }
                return e
            }

            function s(t, e) {
                for (var i = {}, n = [], o = 0; o < t.length; o++) {
                    var s = t[o], h = e.base ? s[0] + e.base : s[0], c = i[h] || 0, l = "".concat(h, " ").concat(c);
                    i[h] = c + 1;
                    var u = a(l), d = {css: s[1], media: s[2], sourceMap: s[3]};
                    -1 !== u ? (r[u].references++, r[u].updater(d)) : r.push({
                        identifier: l,
                        updater: m(d, e),
                        references: 1
                    }), n.push(l)
                }
                return n
            }

            function h(t) {
                var e = document.createElement("style"), n = t.attributes || {};
                if (void 0 === n.nonce) {
                    var r = i.nc;
                    r && (n.nonce = r)
                }
                if (Object.keys(n).forEach((function (t) {
                    e.setAttribute(t, n[t])
                })), "function" == typeof t.insert) t.insert(e); else {
                    var a = o(t.insert || "head");
                    if (!a) throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
                    a.appendChild(e)
                }
                return e
            }

            var c, l = (c = [], function (t, e) {
                return c[t] = e, c.filter(Boolean).join("\n")
            });

            function u(t, e, i, n) {
                var o = i ? "" : n.media ? "@media ".concat(n.media, " {").concat(n.css, "}") : n.css;
                if (t.styleSheet) t.styleSheet.cssText = l(e, o); else {
                    var r = document.createTextNode(o), a = t.childNodes;
                    a[e] && t.removeChild(a[e]), a.length ? t.insertBefore(r, a[e]) : t.appendChild(r)
                }
            }

            function d(t, e, i) {
                var n = i.css, o = i.media, r = i.sourceMap;
                if (o ? t.setAttribute("media", o) : t.removeAttribute("media"), r && "undefined" != typeof btoa && (n += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(r)))), " */")), t.styleSheet) t.styleSheet.cssText = n; else {
                    for (; t.firstChild;) t.removeChild(t.firstChild);
                    t.appendChild(document.createTextNode(n))
                }
            }

            var p = null, f = 0;

            function m(t, e) {
                var i, n, o;
                if (e.singleton) {
                    var r = f++;
                    i = p || (p = h(e)), n = u.bind(null, i, r, !1), o = u.bind(null, i, r, !0)
                } else i = h(e), n = d.bind(null, i, e), o = function () {
                    !function (t) {
                        if (null === t.parentNode) return !1;
                        t.parentNode.removeChild(t)
                    }(i)
                };
                return n(t), function (e) {
                    if (e) {
                        if (e.css === t.css && e.media === t.media && e.sourceMap === t.sourceMap) return;
                        n(t = e)
                    } else o()
                }
            }

            t.exports = function (t, e) {
                (e = e || {}).singleton || "boolean" == typeof e.singleton || (e.singleton = (void 0 === n && (n = Boolean(window && document && document.all && !window.atob)), n));
                var i = s(t = t || [], e);
                return function (t) {
                    if (t = t || [], "[object Array]" === Object.prototype.toString.call(t)) {
                        for (var n = 0; n < i.length; n++) {
                            var o = a(i[n]);
                            r[o].references--
                        }
                        for (var h = s(t, e), c = 0; c < i.length; c++) {
                            var l = a(i[c]);
                            0 === r[l].references && (r[l].updater(), r.splice(l, 1))
                        }
                        i = h
                    }
                }
            }
        }, 507: t => {
            t.exports = e
        }
    }, i = {};

    function n(e) {
        var o = i[e];
        if (void 0 !== o) return o.exports;
        var r = i[e] = {id: e, exports: {}};
        return t[e](r, r.exports, n), r.exports
    }

    n.n = t => {
        var e = t && t.__esModule ? () => t.default : () => t;
        return n.d(e, {a: e}), e
    }, n.d = (t, e) => {
        for (var i in e) n.o(e, i) && !n.o(t, i) && Object.defineProperty(t, i, {enumerable: !0, get: e[i]})
    }, n.o = (t, e) => Object.prototype.hasOwnProperty.call(t, e), n.r = t => {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(t, "__esModule", {value: !0})
    };
    var o = {};
    return (() => {
        n.r(o), n.d(o, {default: () => u});
        var t = n(507);

        function e(t) {
            return function (t) {
                if (Array.isArray(t)) return i(t)
            }(t) || function (t) {
                if ("undefined" != typeof Symbol && null != t[Symbol.iterator] || null != t["@@iterator"]) return Array.from(t)
            }(t) || function (t, e) {
                if (t) {
                    if ("string" == typeof t) return i(t, e);
                    var n = Object.prototype.toString.call(t).slice(8, -1);
                    return "Object" === n && t.constructor && (n = t.constructor.name), "Map" === n || "Set" === n ? Array.from(t) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? i(t, e) : void 0
                }
            }(t) || function () {
                throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
            }()
        }

        function i(t, e) {
            (null == e || e > t.length) && (e = t.length);
            for (var i = 0, n = new Array(e); i < e; i++) n[i] = t[i];
            return n
        }

        var r = {t: "top", m: "marginTop", b: "bottom"}, a = {l: "left", m: "marginLeft", r: "right"};
        const s = {
            name: "vue-drag-resize",
            emits: ["clicked", "dragging", "dragstop", "resizing", "resizestop", "activated", "deactivated"],
            props: {
                stickSize: {type: Number, default: 8},
                parentScaleX: {type: Number, default: 1},
                parentScaleY: {type: Number, default: 1},
                isActive: {type: Boolean, default: !1},
                preventActiveBehavior: {type: Boolean, default: !1},
                isDraggable: {type: Boolean, default: !0},
                isResizable: {type: Boolean, default: !0},
                aspectRatio: {type: Boolean, default: !1},
                parentLimitation: {type: Boolean, default: !1},
                snapToGrid: {type: Boolean, default: !1},
                gridX: {
                    type: Number, default: 50, validator: function (t) {
                        return t >= 0
                    }
                },
                gridY: {
                    type: Number, default: 50, validator: function (t) {
                        return t >= 0
                    }
                },
                parentW: {
                    type: Number, default: 0, validator: function (t) {
                        return t >= 0
                    }
                },
                parentH: {
                    type: Number, default: 0, validator: function (t) {
                        return t >= 0
                    }
                },
                w: {
                    type: [String, Number], default: 200, validator: function (t) {
                        return "string" == typeof t ? "auto" === t : t >= 0
                    }
                },
                h: {
                    type: [String, Number], default: 200, validator: function (t) {
                        return "string" == typeof t ? "auto" === t : t >= 0
                    }
                },
                minw: {
                    type: Number, default: 50, validator: function (t) {
                        return t >= 0
                    }
                },
                minh: {
                    type: Number, default: 50, validator: function (t) {
                        return t >= 0
                    }
                },
                x: {
                    type: Number, default: 0, validator: function (t) {
                        return "number" == typeof t
                    }
                },
                y: {
                    type: Number, default: 0, validator: function (t) {
                        return "number" == typeof t
                    }
                },
                z: {
                    type: [String, Number], default: "auto", validator: function (t) {
                        return "string" == typeof t ? "auto" === t : t >= 0
                    }
                },
                dragHandle: {type: String, default: null},
                dragCancel: {type: String, default: null},
                sticks: {
                    type: Array, default: function () {
                        return ["tl", "tm", "tr", "mr", "br", "bm", "bl", "ml"]
                    }
                },
                axis: {
                    type: String, default: "both", validator: function (t) {
                        return -1 !== ["x", "y", "both", "none"].indexOf(t)
                    }
                },
                contentClass: {type: String, required: !1, default: ""}
            },
            data: function () {
                return {
                    fixAspectRatio: null,
                    active: null,
                    zIndex: null,
                    parentWidth: null,
                    parentHeight: null,
                    left: null,
                    top: null,
                    right: null,
                    bottom: null,
                    minHeight: null
                }
            },
            beforeCreate: function () {
                this.stickDrag = !1, this.bodyDrag = !1, this.dimensionsBeforeMove = {
                    pointerX: 0,
                    pointerY: 0,
                    x: 0,
                    y: 0,
                    w: 0,
                    h: 0
                }, this.limits = {
                    left: {min: null, max: null},
                    right: {min: null, max: null},
                    top: {min: null, max: null},
                    bottom: {min: null, max: null}
                }, this.currentStick = null
            },
            mounted: function () {
                var t = this;
                const ro = new ResizeObserver((entries, observer) => {
                    for (const entry of entries) {
                        const {width, height} = entry.contentRect;
                        if(width > 0 && height > 0) {
                            this.parentWidth = this.parentW ? this.parentW : width;
                            this.parentHeight = this.parentH ? this.parentH : height;
                            if(this.x >= 0 && this.x <=1 && this.y >=0 && this.y <=1) {
                                this.left = this.x * this.parentWidth;
                                this.top = this.y * this.parentHeight;
                                this.right = this.parentWidth - (this.w === 'auto' ? this.$refs.container.scrollWidth : this.w*this.parentWidth) - this.left;
                                this.bottom = this.parentHeight - (this.h === 'auto' ? this.$refs.container.scrollHeight : this.h*this.parentHeight) - this.top;
                            } else {
                                this.left = this.x;
                                this.top = this.y;
                                this.right = this.parentWidth - (this.w === 'auto' ? this.$refs.container.scrollWidth : this.w) - this.left;
                                this.bottom = this.parentHeight - (this.h === 'auto' ? this.$refs.container.scrollHeight : this.h) - this.top;
                            }
                        }
                    }
                });
                ro.observe(this.$el.parentNode);
                this.domEvents = new Map([["mousemove", this.move], ["mouseup", this.up], ["mouseleave", this.up], ["mousedown", this.deselect], ["touchmove", this.move], ["touchend", this.up], ["touchcancel", this.up], ["touchstart", this.up]]), this.domEvents.forEach((function (t, e) {
                document.documentElement.addEventListener(e, t)
                })), this.dragHandle && e(this.$el.querySelectorAll(this.dragHandle)).forEach((function (e) {
                    e.setAttribute("data-drag-handle", t._uid)
                })), this.dragCancel && e(this.$el.querySelectorAll(this.dragCancel)).forEach((function (e) {
                    e.setAttribute("data-drag-cancel", t._uid)
                }))
            },
            beforeUnmount: function () {
                this.domEvents.forEach((function (t, e) {
                    document.documentElement.removeEventListener(e, t)
                }))
            },
            methods: {
                deselect: function () {
                    this.preventActiveBehavior || (this.active = !1)
                }, move: function (t) {
                    if (this.stickDrag || this.bodyDrag) {
                        t.stopPropagation();
                        var e = void 0 !== t.pageX ? t.pageX : t.touches[0].pageX,
                            i = void 0 !== t.pageY ? t.pageY : t.touches[0].pageY, n = this.dimensionsBeforeMove,
                            o = {x: (n.pointerX - e) / this.parentScaleX, y: (n.pointerY - i) / this.parentScaleY};
                        if (this.stickDrag && this.stickMove(o), this.bodyDrag) {
                            if ("x" === this.axis) o.y = 0; else if ("y" === this.axis) o.x = 0; else if ("none" === this.axis) return;
                            this.bodyMove(o)
                        }
                    }
                }, up: function (t) {
                    this.stickDrag ? this.stickUp(t) : this.bodyDrag && this.bodyUp(t)
                }, bodyDown: function (t) {
                    var e = t.target, i = t.button;
                    if (this.preventActiveBehavior || (this.active = !0), (!i || 0 === i) && (this.$emit("clicked", t), this.active && !(this.dragHandle && e.getAttribute("data-drag-handle") !== this._uid.toString() || this.dragCancel && e.getAttribute("data-drag-cancel") === this._uid.toString()))) {
                        void 0 !== t.stopPropagation && t.stopPropagation(), void 0 !== t.preventDefault && t.preventDefault(), this.isDraggable && (this.bodyDrag = !0);
                        var n = void 0 !== t.pageX ? t.pageX : t.touches[0].pageX,
                            o = void 0 !== t.pageY ? t.pageY : t.touches[0].pageY;
                        this.saveDimensionsBeforeMove({
                            pointerX: n,
                            pointerY: o
                        }), this.parentLimitation && (this.limits = this.calcDragLimitation())
                    }
                }, bodyMove: function (t) {
                    var e = this.dimensionsBeforeMove, i = this.parentWidth, n = this.parentHeight, o = this.gridX,
                        r = this.gridY, a = this.width, s = this.height, h = e.top - t.y, c = e.bottom + t.y,
                        l = e.left - t.x, u = e.right + t.x;
                    if (this.snapToGrid) {
                        var d = !0, p = !0, f = h - Math.floor(h / r) * r, m = n - c - Math.floor((n - c) / r) * r,
                            g = l - Math.floor(l / o) * o, v = i - u - Math.floor((i - u) / o) * o;
                        f > r / 2 && (f -= r), m > r / 2 && (m -= r), g > o / 2 && (g -= o), v > o / 2 && (v -= o), Math.abs(m) < Math.abs(f) && (d = !1), Math.abs(v) < Math.abs(g) && (p = !1), c = n - s - (h -= d ? f : m), u = i - a - (l -= p ? g : v)
                    }
                    var b = this.rectCorrectionByLimit({newLeft: l, newRight: u, newTop: h, newBottom: c});
                    this.left = b.newLeft, this.right = b.newRight, this.top = b.newTop, this.bottom = b.newBottom, this.$emit("dragging", this.rect)
                }, bodyUp: function () {
                    this.bodyDrag = !1, this.$emit("dragging", this.rect), this.$emit("dragstop", this.rect), this.dimensionsBeforeMove = {
                        pointerX: 0,
                        pointerY: 0,
                        x: 0,
                        y: 0,
                        w: 0,
                        h: 0
                    }, this.limits = {
                        left: {min: null, max: null},
                        right: {min: null, max: null},
                        top: {min: null, max: null},
                        bottom: {min: null, max: null}
                    }
                }, stickDown: function (t, e) {
                    var i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
                    if (this.isResizable && this.active || i) {
                        this.stickDrag = !0;
                        var n = void 0 !== e.pageX ? e.pageX : e.touches[0].pageX,
                            o = void 0 !== e.pageY ? e.pageY : e.touches[0].pageY;
                        this.saveDimensionsBeforeMove({
                            pointerX: n,
                            pointerY: o
                        }), this.currentStick = t, this.limits = this.calcResizeLimits()
                    }
                }, saveDimensionsBeforeMove: function (t) {
                    var e = t.pointerX, i = t.pointerY;
                    this.dimensionsBeforeMove.pointerX = e, this.dimensionsBeforeMove.pointerY = i, this.dimensionsBeforeMove.left = this.left, this.dimensionsBeforeMove.right = this.right, this.dimensionsBeforeMove.top = this.top, this.dimensionsBeforeMove.bottom = this.bottom, this.dimensionsBeforeMove.width = this.width, this.dimensionsBeforeMove.height = this.height, this.aspectFactor = this.width / this.height
                }, stickMove: function (t) {
                    var e = this.currentStick, i = this.dimensionsBeforeMove, n = this.gridY, o = this.gridX,
                        r = this.snapToGrid, a = this.parentHeight, s = this.parentWidth, h = i.top, c = i.bottom,
                        l = i.left, u = i.right;
                    switch (e[0]) {
                        case"b":
                            c = i.bottom + t.y, r && (c = a - Math.round((a - c) / n) * n);
                            break;
                        case"t":
                            h = i.top - t.y, r && (h = Math.round(h / n) * n)
                    }
                    switch (e[1]) {
                        case"r":
                            u = i.right + t.x, r && (u = s - Math.round((s - u) / o) * o);
                            break;
                        case"l":
                            l = i.left - t.x, r && (l = Math.round(l / o) * o)
                    }
                    var d = this.rectCorrectionByLimit({newLeft: l, newRight: u, newTop: h, newBottom: c});
                    if (l = d.newLeft, u = d.newRight, h = d.newTop, c = d.newBottom, this.aspectRatio) {
                        var p = this.rectCorrectionByAspectRatio({newLeft: l, newRight: u, newTop: h, newBottom: c});
                        l = p.newLeft, u = p.newRight, h = p.newTop, c = p.newBottom
                    }
                    this.left = l, this.right = u, this.top = h, this.bottom = c, this.$emit("resizing", this.rect)
                }, stickUp: function () {
                    this.stickDrag = !1, this.dimensionsBeforeMove = {
                        pointerX: 0,
                        pointerY: 0,
                        x: 0,
                        y: 0,
                        w: 0,
                        h: 0
                    }, this.limits = {
                        left: {min: null, max: null},
                        right: {min: null, max: null},
                        top: {min: null, max: null},
                        bottom: {min: null, max: null}
                    }, this.$emit("resizing", this.rect), this.$emit("resizestop", this.rect)
                }, calcDragLimitation: function () {
                    var t = this.parentWidth, e = this.parentHeight;
                    return {
                        left: {min: 0, max: t - this.width},
                        right: {min: 0, max: t - this.width},
                        top: {min: 0, max: e - this.height},
                        bottom: {min: 0, max: e - this.height}
                    }
                }, calcResizeLimits: function () {
                    var t = this.aspectFactor, e = this.width, i = this.height, n = this.bottom, o = this.top,
                        r = this.left, a = this.right, s = this.minh, h = this.minw,
                        c = this.parentLimitation ? 0 : null;
                    this.aspectRatio && (h / s > t ? s = h / t : h = t * s);
                    var l = {
                        left: {min: c, max: r + (e - h)},
                        right: {min: c, max: a + (e - h)},
                        top: {min: c, max: o + (i - s)},
                        bottom: {min: c, max: n + (i - s)}
                    };
                    if (this.aspectRatio) {
                        var u = {
                            left: {min: r - Math.min(o, n) * t * 2, max: r + (i - s) / 2 * t * 2},
                            right: {min: a - Math.min(o, n) * t * 2, max: a + (i - s) / 2 * t * 2},
                            top: {min: o - Math.min(r, a) / t * 2, max: o + (e - h) / 2 / t * 2},
                            bottom: {min: n - Math.min(r, a) / t * 2, max: n + (e - h) / 2 / t * 2}
                        };
                        "m" === this.currentStick[0] ? (l.left = {
                            min: Math.max(l.left.min, u.left.min),
                            max: Math.min(l.left.max, u.left.max)
                        }, l.right = {
                            min: Math.max(l.right.min, u.right.min),
                            max: Math.min(l.right.max, u.right.max)
                        }) : "m" === this.currentStick[1] && (l.top = {
                            min: Math.max(l.top.min, u.top.min),
                            max: Math.min(l.top.max, u.top.max)
                        }, l.bottom = {
                            min: Math.max(l.bottom.min, u.bottom.min),
                            max: Math.min(l.bottom.max, u.bottom.max)
                        })
                    }
                    return l
                }, sideCorrectionByLimit: function (t, e) {
                    var i = e;
                    return null !== t.min && e < t.min ? i = t.min : null !== t.max && t.max < e && (i = t.max), i
                }, rectCorrectionByLimit: function (t) {
                    var e = this.limits, i = t.newRight, n = t.newLeft, o = t.newBottom, r = t.newTop;
                    return {
                        newLeft: n = this.sideCorrectionByLimit(e.left, n),
                        newRight: i = this.sideCorrectionByLimit(e.right, i),
                        newTop: r = this.sideCorrectionByLimit(e.top, r),
                        newBottom: o = this.sideCorrectionByLimit(e.bottom, o)
                    }
                }, rectCorrectionByAspectRatio: function (t) {
                    var e = t.newLeft, i = t.newRight, n = t.newTop, o = t.newBottom, r = this.parentWidth,
                        a = this.parentHeight, s = this.currentStick, h = this.aspectFactor,
                        c = this.dimensionsBeforeMove, l = r - e - i, u = a - n - o;
                    if ("m" === s[1]) {
                        var d = u - c.height;
                        e -= d * h / 2, i -= d * h / 2
                    } else if ("m" === s[0]) {
                        var p = l - c.width;
                        n -= p / h / 2, o -= p / h / 2
                    } else l / u > h ? (l = h * u, "l" === s[1] ? e = r - i - l : i = r - e - l) : (u = l / h, "t" === s[0] ? n = a - o - u : o = a - n - u);
                    return {newLeft: e, newRight: i, newTop: n, newBottom: o}
                }
            },
            computed: {
                positionStyle: function () {
                    return {top: this.top + "px", left: this.left + "px", zIndex: this.zIndex}
                }, sizeStyle: function () {
                    return {width: this.width + "px", height: this.height + "px"}
                }, vdrStick: function () {
                    var t = this;
                    return function (e) {
                        var i = {
                            width: "".concat(t.stickSize / t.parentScaleX, "px"),
                            height: "".concat(t.stickSize / t.parentScaleY, "px")
                        };
                        return i[r[e[0]]] = "".concat(t.stickSize / t.parentScaleX / -2, "px"), i[a[e[1]]] = "".concat(t.stickSize / t.parentScaleX / -2, "px"), i
                    }
                }, width: function () {
                    return this.parentWidth - this.left - this.right
                }, height: function () {
                    return this.parentHeight - this.top - this.bottom
                }, rect: function () {
                    let ret = {};
                    if(this.x >= 0 && this.x <=1 && this.y >=0 && this.y <=1) {
                        ret = {
                            left: Math.round(this.left)/this.parentWidth,
                            top: Math.round(this.top)/this.parentHeight,
                            width: Math.round(this.width)/this.parentWidth,
                            height: Math.round(this.height)/this.parentHeight,
                        }
                    } else {
                        ret = {
                            left: Math.round(this.left),
                            top: Math.round(this.top),
                            width: Math.round(this.width),
                            height: Math.round(this.height),
                        }
                    }
                    return ret;
                }
            },
            watch: {
                active: function (t) {
                    t ? this.$emit("activated") : this.$emit("deactivated")
                }, isActive: {
                    immediate: !0, handler: function (t) {
                        this.active = t
                    }
                }, z: {
                    immediate: !0, handler: function (t) {
                        (t >= 0 || "auto" === t) && (this.zIndex = t)
                    }
                }, x: {
                    handler: function (t, e) {
                        var i = this;
                        if (!this.stickDrag && !this.bodyDrag && t !== this.left) {
                            var n = e - t;
                            this.bodyDown({pageX: this.left, pageY: this.top}), this.bodyMove({
                                x: n,
                                y: 0
                            }), this.$nextTick((function () {
                                i.bodyUp()
                            }))
                        }
                    }
                }, y: {
                    handler: function (t, e) {
                        var i = this;
                        if (!this.stickDrag && !this.bodyDrag && t !== this.top) {
                            var n = e - t;
                            this.bodyDown({pageX: this.left, pageY: this.top}), this.bodyMove({
                                x: 0,
                                y: n
                            }), this.$nextTick((function () {
                                i.bodyUp()
                            }))
                        }
                    }
                }, w: {
                    handler: function (t, e) {
                        var i = this;
                        if (!this.stickDrag && !this.bodyDrag && t !== this.width) {
                            var n = e - t;
                            this.stickDown("mr", {
                                pageX: this.right,
                                pageY: this.top + this.height / 2
                            }, !0), this.stickMove({x: n, y: 0}), this.$nextTick((function () {
                                i.stickUp()
                            }))
                        }
                    }
                }, h: {
                    handler: function (t, e) {
                        var i = this;
                        if (!this.stickDrag && !this.bodyDrag && t !== this.height) {
                            var n = e - t;
                            this.stickDown("bm", {
                                pageX: this.left + this.width / 2,
                                pageY: this.bottom
                            }, !0), this.stickMove({x: 0, y: n}), this.$nextTick((function () {
                                i.stickUp()
                            }))
                        }
                    }
                }, parentW: function (t) {
                    this.right = t - this.width - this.left, this.parentWidth = t
                }, parentH: function (t) {
                    this.bottom = t - this.height - this.top, this.parentHeight = t
                }
            }
        };
        var h = n(379), c = n.n(h), l = n(566);
        c()(l.Z, {insert: "head", singleton: !1}), l.Z.locals, s.render = function (e, i) {
            return (0, t.openBlock)(), (0, t.createBlock)("div", {
                class: ["vdr", "".concat(e.active || e.isActive ? "active" : "inactive", " ").concat(e.contentClass ? e.contentClass : "")],
                style: e.positionStyle,
                onMousedown: i[1] || (i[1] = function (t) {
                    return e.bodyDown(t)
                }),
                onTouchstart: i[2] || (i[2] = function (t) {
                    return e.bodyDown(t)
                }),
                onTouchend: i[3] || (i[3] = function (t) {
                    return e.up(t)
                }),
                ref: "container",
                tabindex: "0"
            }, [(0, t.createVNode)("div", {
                style: e.sizeStyle,
                class: "content-container",
                ref: "container2"
            }, [(0, t.renderSlot)(e.$slots, "default")], 4), ((0, t.openBlock)(!0), (0, t.createBlock)(t.Fragment, null, (0, t.renderList)(e.sticks, (function (i) {
                return (0, t.openBlock)(), (0, t.createBlock)("div", {
                    class: ["vdr-stick", ["vdr-stick-" + i, e.isResizable ? "" : "not-resizable"]],
                    onMousedown: (0, t.withModifiers)((function (t) {
                        return e.stickDown(i, t)
                    }), ["stop", "prevent"]),
                    onTouchstart: (0, t.withModifiers)((function (t) {
                        return e.stickDown(i, t)
                    }), ["stop", "prevent"]),
                    style: e.vdrStick(i)
                }, null, 46, ["onMousedown", "onTouchstart"])
            })), 256))], 38)
        };
        const u = s
    })(), o
})()), o = i.exports.__esModule;
export {o as __esModule};
export default n.default;
//# sourceMappingURL=/sm/9d26cfa55d14dbfd0bbc73521c7275e521bd008eb7b6c6a316811230be8dd64e.map
