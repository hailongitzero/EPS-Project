/**

 */
var Treeview = function() {
    var e = function() {
            $("#mTreeDanhMuc").on('changed.jstree', function (e, data) {
                var tb = $("#mTbDocument");
                var nodeId = $('#mTreeDanhMuc').jstree().get_selected("id")[0].id;
                var noteText = $('#mTreeDanhMuc').jstree().get_selected("id")[0].text;
                var maDanhMuc = $('#'+nodeId).find('a').attr('data-content');
                var level = $('#'+nodeId).attr('aria-level');
                if( level > 1){
                    $('#tbTitleSec').text(noteText);
                    $('#maDanhMucTaiLieu').val(maDanhMuc);
                    $('#tbTaiLieuTitle').text(noteText);
                    $('#mdAddDocumentTitle').text(' - ' + noteText);
                }
            }).jstree({
                core: {
                    themes: {
                        responsive: !1
                    }
                },
                types: {
                    default: {
                        icon: "fa fa-folder"
                    },
                    file: {
                        icon: "fa fa-file"
                    }
                },
                plugins: ["types"]
            })
        },
        t = function() {
            $("#mTreeDanhMucMoRong").on('changed.jstree', function (e, data) {
                var tb = $("#mTbDocumentExt");
                var nodeId = $('#mTreeDanhMucMoRong').jstree().get_selected("id")[0].id;
                var noteText = $('#mTreeDanhMucMoRong').jstree().get_selected("id")[0].text;
                var maDanhMuc = $('#'+nodeId).find('a').attr('data-content');
                var level = $('#'+nodeId).attr('aria-level');
                if( level > 1) {
                    $('#tbTitleSec').text(noteText);
                    $('#maDanhMucTaiLieu').val(maDanhMuc);
                    $('#tbTaiLieuTitle').text(noteText);
                    $('#mdAddDocumentTitle').text(' - ' + noteText);
                }
            }).jstree({
                core: {
                    themes: {
                        responsive: !1
                    }
                },
                types: {
                    default: {
                        icon: "fa fa-folder"
                    },
                    file: {
                        icon: "fa fa-file"
                    }
                },
                plugins: ["types"]
            })
        },
        n = function() {
            $("#m_tree_3").jstree({
                plugins: ["wholerow", "checkbox", "types"],
                core: {
                    themes: {
                        responsive: !1
                    },
                    data: [{
                        text: "Same but with checkboxes",
                        children: [{
                            text: "initially selected",
                            state: {
                                selected: !0
                            }
                        }, {
                            text: "custom icon",
                            icon: "fa fa-warning m--font-danger"
                        }, {
                            text: "initially open",
                            icon: "fa fa-folder m--font-default",
                            state: {
                                opened: !0
                            },
                            children: ["Another node"]
                        }, {
                            text: "custom icon",
                            icon: "fa fa-warning m--font-waring"
                        }, {
                            text: "disabled node",
                            icon: "fa fa-check m--font-success",
                            state: {
                                disabled: !0
                            }
                        }]
                    }, "And wholerow selection"]
                },
                types: {
                    default: {
                        icon: "fa fa-folder m--font-warning"
                    },
                    file: {
                        icon: "fa fa-file  m--font-warning"
                    }
                }
            })
        },
        a = function() {
            $("#m_tree_4").jstree({
                core: {
                    themes: {
                        responsive: !1
                    },
                    check_callback: !0,
                    data: [{
                        text: "Parent Node",
                        children: [{
                            text: "Initially selected",
                            state: {
                                selected: !0
                            }
                        }, {
                            text: "Custom Icon",
                            icon: "fa fa-warning m--font-danger"
                        }, {
                            text: "Initially open",
                            icon: "fa fa-folder m--font-success",
                            state: {
                                opened: !0
                            },
                            children: [{
                                text: "Another node",
                                icon: "fa fa-file m--font-waring"
                            }]
                        }, {
                            text: "Another Custom Icon",
                            icon: "fa fa-warning m--font-waring"
                        }, {
                            text: "Disabled Node",
                            icon: "fa fa-check m--font-success",
                            state: {
                                disabled: !0
                            }
                        }, {
                            text: "Sub Nodes",
                            icon: "fa fa-folder m--font-danger",
                            children: [{
                                text: "Item 1",
                                icon: "fa fa-file m--font-waring"
                            }, {
                                text: "Item 2",
                                icon: "fa fa-file m--font-success"
                            }, {
                                text: "Item 3",
                                icon: "fa fa-file m--font-default"
                            }, {
                                text: "Item 4",
                                icon: "fa fa-file m--font-danger"
                            }, {
                                text: "Item 5",
                                icon: "fa fa-file m--font-info"
                            }]
                        }]
                    }, "Another Node"]
                },
                types: {
                    default: {
                        icon: "fa fa-folder m--font-brand"
                    },
                    file: {
                        icon: "fa fa-file  m--font-brand"
                    }
                },
                state: {
                    key: "demo2"
                },
                plugins: ["contextmenu", "state", "types"]
            })
        },
        f = function() {
            $("#m_tree_5").jstree({
                core: {
                    themes: {
                        responsive: !1
                    },
                    check_callback: !0,
                    data: [{
                        text: "Parent Node",
                        children: [{
                            text: "Initially selected",
                            state: {
                                selected: !0
                            }
                        }, {
                            text: "Custom Icon",
                            icon: "fa fa-warning m--font-danger"
                        }, {
                            text: "Initially open",
                            icon: "fa fa-folder m--font-success",
                            state: {
                                opened: !0
                            },
                            children: [{
                                text: "Another node",
                                icon: "fa fa-file m--font-waring"
                            }]
                        }, {
                            text: "Another Custom Icon",
                            icon: "fa fa-warning m--font-waring"
                        }, {
                            text: "Disabled Node",
                            icon: "fa fa-check m--font-success",
                            state: {
                                disabled: !0
                            }
                        }, {
                            text: "Sub Nodes",
                            icon: "fa fa-folder m--font-danger",
                            children: [{
                                text: "Item 1",
                                icon: "fa fa-file m--font-waring"
                            }, {
                                text: "Item 2",
                                icon: "fa fa-file m--font-success"
                            }, {
                                text: "Item 3",
                                icon: "fa fa-file m--font-default"
                            }, {
                                text: "Item 4",
                                icon: "fa fa-file m--font-danger"
                            }, {
                                text: "Item 5",
                                icon: "fa fa-file m--font-info"
                            }]
                        }]
                    }, "Another Node"]
                },
                types: {
                    default: {
                        icon: "fa fa-folder m--font-success"
                    },
                    file: {
                        icon: "fa fa-file  m--font-success"
                    }
                },
                state: {
                    key: "demo2"
                },
                plugins: ["dnd", "state", "types"]
            })
        },
        o = function() {
            $("#m_tree_6").jstree({
                core: {
                    themes: {
                        responsive: !1
                    },
                    check_callback: !0,
                    data: {
                        url: function(e) {
                            return "http://keenthemes.com/metronic/preview/inc/api/jstree/ajax_data.php"
                        },
                        data: function(e) {
                            return {
                                parent: e.id
                            }
                        }
                    }
                },
                types: {
                    default: {
                        icon: "fa fa-folder m--font-brand"
                    },
                    file: {
                        icon: "fa fa-file  m--font-brand"
                    }
                },
                state: {
                    key: "demo3"
                },
                plugins: ["dnd", "state", "types"]
            })
        };
    return {
        init: function() {
            e(), t(), n(), a(), f(), o()
        }
    }
}();
jQuery(document).ready(function() {
    Treeview.init()
});