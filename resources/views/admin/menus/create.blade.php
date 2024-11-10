@extends('admin.layouts.admin')

{{-- ===========  meta Title  =================== --}}
@section('title')
ساخت منو
@endsection
{{-- ===========  My Css Style  =================== --}}
@section('style')
    <style>
        .img-profile{
            max-width: 150px;
            height: auto;
        }
        td{
            vertical-align: middle !important;
        }
        .img-profile{
            width: 200px;
            height: auto;
        }
        .menu-container {
    display: flex;
}

.menu-list {
    width: 50%;
    border-right: 1px solid #ccc;
}

.input-area {
    padding: 20px;
}
/**
*  Nestable css
*/
.dd {
  position: relative;
  display: block;
  margin: 0;
  padding: 0;
  max-width: 600px;
  list-style: none;
  font-size: 13px;
  line-height: 20px;
}

.dd-list {
  display: block;
  position: relative;
  margin: 0;
  padding: 0;
  list-style: none;
}

.dd-list .dd-list {
  padding-right: 30px;
}

.dd-collapsed .dd-list {
  display: none;
}

.dd-item,
.dd-empty,
.dd-placeholder {
  display: block;
  position: relative;
  margin: 0;
  padding: 0;
  min-height: 20px;
  font-size: 13px;
  line-height: 20px;
}

.dd-handle {
  display: block;
  height: 45px;
  display:flex;
  align-items:center;
  margin: 5px 0;
  padding: 5px 10px;
  color: #333;
  text-decoration: none;
  font-weight: bold;
  border: 1px solid #ccc;
  background: #fafafa;
  background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
  background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
  background: linear-gradient(top, #fafafa 0%, #eee 100%);
  -webkit-border-radius: 3px;
  border-radius: 3px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
    cursor: move;
    margin: 0 0 10px;
    background: #dbdbdb;
/*    color: #6f6f6f;*/
    padding: 5px 12px
}

.dd-handle:hover {
  color: #2ea8e5;
  background: #fff;
}

.dd-item > button {
/*  display: block;
  position: relative;
  cursor: pointer;
  float: left;
  width: 25px;
  height: 20px;
  margin: 5px 0;
  padding: 0;
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
  border: 0;
  background: transparent;
  font-size: 12px;
  line-height: 1;
  text-align: center;
  font-weight: bold;*/
      position: relative;
    cursor: pointer;
    float: right;
    width: 35px;
    height: 45px;
    margin: 0px 0px;
    padding: 0;
    text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
    border: 0;
    background: #4CAF50;
    font-size: 26px;
    line-height: 1;
    color: #fff;
    text-align: center;
    font-weight: bold;

}

.dd-item > button:before {
  content: '+';
  display: block;
  position: absolute;
  width: 100%;
  text-align: center;
  text-indent: 0;
}

.dd-item > button[data-action="collapse"]:before {
  content: '-';
}

.dd-placeholder,
.dd-empty {
  margin: 5px 0;
  padding: 0;
  min-height: 30px;
  background: #f2fbff;
  border: 1px dashed #b6bcbf;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.dd-empty {
  border: 1px dashed #bbb;
  min-height: 100px;
  background-color: #e5e5e5;
  background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
  background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
  background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
  background-size: 60px 60px;
  background-position: 0 0, 30px 30px;
}

.dd-dragel {
  position: absolute;
  pointer-events: none;
  z-index: 9999;
}

.dd-dragel > .dd-item .dd-handle {
  margin-top: 0;
}

.dd-dragel .dd-handle {
  -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
  box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
}

/**
* Nestable Extras
*/
.nestable-lists {
  display: block;
  clear: both;
  padding: 30px 0;
  width: 100%;
  border: 0;
  border-top: 2px solid #ddd;
  border-bottom: 2px solid #ddd;
}

#nestable-menu {
  padding: 0;
  margin: 20px 0;
}

#nestable-output,
#nestable2-output {
  width: 100%;
  height: 7em;
  font-size: 0.75em;
  line-height: 1.333333em;
  font-family: Consolas, monospace;
  padding: 5px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

#nestable2 .dd-handle {
  color: #fff;
  border: 1px solid #999;
  background: #bbb;
  background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
  background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
  background: linear-gradient(top, #bbb 0%, #999 100%);
}

#nestable2 .dd-handle:hover {
  background: #bbb;
}

#nestable2 .dd-item > button:before {
  color: #fff;
}

.dd {
  //  float: right;
  //  width: 48 %;
  width: 80%;
}

.dd + .dd {
  margin-right: 2%;
}

.dd-hover > .dd-handle {
  background: #2ea8e5 !important;
}

/**
* Nestable Draggable Handles
*/
.dd3-content {
  display: block;
  height: 30px;
  margin: 5px 0;
  padding: 5px 10px 5px 40px;
  color: #333;
  text-decoration: none;
  font-weight: bold;
  border: 1px solid #ccc;
  background: #fafafa;
  background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
  background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
  background: linear-gradient(top, #fafafa 0%, #eee 100%);
  -webkit-border-radius: 3px;
  border-radius: 3px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.dd3-content:hover {
  color: #2ea8e5;
  background: #fff;
}

.dd-dragel > .dd3-item > .dd3-content {
  margin: 0;
}

.dd3-item > button {
  margin-right: 30px;
}

.dd3-handle {
  position: absolute;
  margin: 0;
  right: 0;
  top: 0;
  cursor: pointer;
  width: 30px;
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
  border: 1px solid #aaa;
  background: #ddd;
  background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
  background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
  background: linear-gradient(top, #ddd 0%, #bbb 100%);
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.dd3-handle:before {
  content: '≡';
  display: block;
  position: absolute;
  right: 0;
  top: 3px;
  width: 100%;
  text-align: center;
  text-indent: 0;
  color: #fff;
  font-size: 20px;
  font-weight: normal;
}

.dd3-handle:hover {
  background: #ddd;
}


/*
* Nestable++
*/
.button-delete {
  position: absolute;
  top: 3px;
  left: -26px;
}

.button-edit {
  position: absolute;
  top: 3px;
  left: -76px;
}



#saveButton {
  padding-right: 30px;
  padding-left: 30px;
}

.output-container {
  margin-top: 20px;
}

#json-output {
  margin-top: 20px;
}

    </style>
    
    <style>
        .form-group{
            display:flex;
 flex-direction:column !important;
 align-items:start !important;
 margin-bottom:10px !important;
            
        }
        .type-group{
            display:none;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

@endsection

@section('script')


    <script>
    /*jslint browser: true, devel: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true*/
/*global $ */

/*************** General ***************/

var updateOutput = function (e) {
  var list = e.length ? e : $(e.target),
      output = list.data('output');
  if (window.JSON) {
      console.log(window.JSON.stringify(list.nestable('serialize')));
    if (output) {
      output.val(window.JSON.stringify(list.nestable('serialize')));
    }
  } else {
    alert('JSON browser support required for this page.');
  }
  
 $.ajax({

        url : "{{ route('admin.menus.store') }}",
        data : {
            menus:window.JSON.stringify(list.nestable('serialize')),
            _token :"{{csrf_token()}}"
            
            
        },
        type : 'post',
        dataType : 'json',
        success : function(result){
if(result['status'] == 200){
    swal({
        title:"تغییرات با موفقیت ایجاد شد",
        icon:"success"
    })
    
    window.location.reload();
}
            

        }
    });
};

var nestableList = $("#nestable > .dd-list");

/***************************************/


/*************** Delete ***************/

var deleteFromMenuHelper = function (target) {
  if (target.data('new') == 1) {
    // if it's not yet saved in the database, just remove it from DOM
    target.fadeOut(function () {
      target.remove();
      updateOutput($('#nestable').data('output', $('#json-output')));
    });
  } else {
     
    // otherwise hide and mark it for deletion
    target.appendTo(nestableList); // if children, move to the top level
    target.data('deleted', '1');
    target.fadeOut();
  }
};

var deleteFromMenu = function () {
  var targetId = $(this).data('owner-id');
  var target = $('[data-id="' + targetId + '"]');

  var result = confirm("آیا از حذف منو مطمئن هستید؟");
  if (!result) {
    return;
  }

  // Remove children (if any)
  target.find("li").each(function () {
  
    deleteFromMenuHelper($(this));
  });

  // Remove parent
  deleteFromMenuHelper(target);

  // update JSON
  updateOutput($('#nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Edit ***************/

var menuEditor = $("#menu-editor");
var editButton = $("#editButton");
var editInputName = $("#editInputName");
var editInputShow = $("#editInputShow");
var editInputLink = $("#editInputLink");
var editInputPage = $("#editInputPage");
var editInputType = $("#editInputType");
var editInputNameEn = $("#editInputNameEn");
var currentEditName = $("#currentEditName");

// Prepares and shows the Edit Form
var prepareEdit = function () {
  var targetId = $(this).data('owner-id');
  var target = $('[data-id="' + targetId + '"]');
            $('.type-group').fadeOut();
          
           let type = target.data("type");
        
           $('.edit-'+type+'-group').fadeIn();
console.log(editInputType,target.data("type"));
  editInputName.val(target.data("name"));
  editInputLink.val(target.data("link"));
    editInputType.val(target.data("type"));
        editInputShow.val(target.data("show"));
    editInputPage.val(target.data("page"));
  editInputNameEn.val(target.data("name_en"));
  currentEditName.html(target.data("name"));
  editButton.data("owner-id", target.data("id"));

  console.log("[INFO] Editing Menu Item " + editButton.data("owner-id"));

  menuEditor.fadeIn();
};

// Edits the Menu item and hides the Edit Form
var editMenuItem = function () {
  var targetId = $(this).data('owner-id');
  var target = $('[data-id="' + targetId + '"]');

  var newName = editInputName.val();
    var newPage = editInputPage.val();
    var newNameEn = editInputNameEn.val();
  var newLink = editInputLink.val();
    var newType = editInputType.val();
        var newShow = editInputShow.val();
  

  target.data("name", newName);
    target.data("page", newPage);
    target.data("name_en", newNameEn);
  target.data("link", newLink);
    target.data("type", newType);
        target.data("show", newShow);
  target.data("updated",1);

  target.find("> .dd-handle").html(newName);

  menuEditor.fadeOut();

  // update JSON
  updateOutput($('#nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Add ***************/

var newIdCount = 1;

var addToMenu = function () {
  var newName = $("#addInputName").val();
  var newLink = $("#addInputLink").val();
  var newNameEn = $("#addInputNameEn").val();
  var newType = $("#addInputType").val();
  var newPage = $("#addInputPage").val();
    var newShow = $("#addInputShow").val();
  
  var newId = 'new-' + newIdCount;

  nestableList.append(
    '<li class="dd-item" ' +
    'data-id="' + newId + '" ' +
    'data-name="' + newName + '" ' +
    'data-name_en="' + newNameEn + '" ' +
      'data-link="' + newLink + '" ' +
       'data-page="' + newPage + '" ' +
        'data-type="' + newType + '" ' +
       'data-show="' + newShow + '" ' +
    'data-new="1" ' +
    'data-deleted="0">' +
    '<div class="dd-handle">' + newName + '</div> ' +
    '<span class="button-delete btn btn-danger btn-xs pull-right" ' +
    'data-owner-id="' + newId + '"> ' +
    '<i class="fa fa-times" aria-hidden="true"></i> ' +
    '</span>' +
    '<span class="button-edit btn btn-success btn-xs pull-right" ' +
    'data-owner-id="' + newId + '">' +
    '<i class="fa fa-pencil" aria-hidden="true"></i>' +
    '</span>' +
    '</li>'
  );

  newIdCount++;

  // update JSON
  updateOutput($('#nestable').data('output', $('#json-output')));

  // set events
  $("#nestable .button-delete").on("click", deleteFromMenu);
  $("#nestable .button-edit").on("click", prepareEdit);
};



/***************************************/



$(function () {

  // output initial serialised data
//   updateOutput($('#nestable').data('output', $('#json-output')));

  // set onclick events
  editButton.on("click", editMenuItem);

  $("#nestable .button-delete").on("click", deleteFromMenu);

  $("#nestable .button-edit").on("click", prepareEdit);

  $("#menu-editor").submit(function (e) {
    e.preventDefault();
  });

  $("#menu-add").submit(function (e) {
    e.preventDefault();
    addToMenu();
  });

});



/*!
 * Nestable jQuery Plugin - Copyright (c) 2012 David Bushell - http://dbushell.com/
 * Dual-licensed under the BSD or MIT licenses
 */
;(function($, window, document, undefined)
{
    var hasTouch = 'ontouchstart' in document;

    /**
     * Detect CSS pointer-events property
     * events are normally disabled on the dragging element to avoid conflicts
     * https://github.com/ausi/Feature-detection-technique-for-pointer-events/blob/master/modernizr-pointerevents.js
     */
    var hasPointerEvents = (function()
    {
        var el    = document.createElement('div'),
            docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
            return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        var supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
    })();

    var defaults = {
            listNodeName    : 'ol',
            itemNodeName    : 'li',
            rootClass       : 'dd',
            listClass       : 'dd-list',
            itemClass       : 'dd-item',
            dragClass       : 'dd-dragel',
            handleClass     : 'dd-handle',
            collapsedClass  : 'dd-collapsed',
            placeClass      : 'dd-placeholder',
            noDragClass     : 'dd-nodrag',
            emptyClass      : 'dd-empty',
            expandBtnHTML   : '<button data-action="expand" type="button">Expand</button>',
            collapseBtnHTML : '<button data-action="collapse" type="button">Collapse</button>',
            group           : 0,
            maxDepth        : 5,
            threshold       : 20
        };

    function Plugin(element, options)
    {
        this.w  = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function()
        {
            var list = this;

            list.reset();

            list.el.data('nestable-group', this.options.group);

            list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

            $.each(this.el.find(list.options.itemNodeName), function(k, el) {
                list.setParent($(el));
            });

            list.el.on('click', 'button', function(e) {
                if (list.dragEl) {
                    return;
                }
                var target = $(e.currentTarget),
                    action = target.data('action'),
                    item   = target.parent(list.options.itemNodeName);
                if (action === 'collapse') {
                    list.collapseItem(item);
                }
                if (action === 'expand') {
                    list.expandItem(item);
                }
            });

            var onStartEvent = function(e)
            {
                var handle = $(e.target);
                if (!handle.hasClass(list.options.handleClass)) {
                    if (handle.closest('.' + list.options.noDragClass).length) {
                        return;
                    }
                    handle = handle.closest('.' + list.options.handleClass);
                }

                if (!handle.length || list.dragEl) {
                    return;
                }

                list.isTouch = /^touch/.test(e.type);
                if (list.isTouch && e.touches.length !== 1) {
                    return;
                }

                e.preventDefault();
                list.dragStart(e.touches ? e.touches[0] : e);
            };

            var onMoveEvent = function(e)
            {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragMove(e.touches ? e.touches[0] : e);
                }
            };

            var onEndEvent = function(e)
            {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragStop(e.touches ? e.touches[0] : e);
                }
            };

            if (hasTouch) {
                list.el[0].addEventListener('touchstart', onStartEvent, false);
                window.addEventListener('touchmove', onMoveEvent, false);
                window.addEventListener('touchend', onEndEvent, false);
                window.addEventListener('touchcancel', onEndEvent, false);
            }

            list.el.on('mousedown', onStartEvent);
            list.w.on('mousemove', onMoveEvent);
            list.w.on('mouseup', onEndEvent);

        },

        serialize: function()
        {
            var data,
                depth = 0,
                list  = this;
                step  = function(level, depth)
                {
                    var array = [ ],
                        items = level.children(list.options.itemNodeName);
                    items.each(function()
                    {
                        var li   = $(this),
                            item = $.extend({}, li.data()),
                            sub  = li.children(list.options.listNodeName);
                        if (sub.length) {
                            item.children = step(sub, depth + 1);
                        }
                        array.push(item);
                    });
                    return array;
                };
            data = step(list.el.find(list.options.listNodeName).first(), depth);
            return data;
        },

        serialise: function()
        {
            return this.serialize();
        },

        reset: function()
        {
            this.mouse = {
                offsetX   : 0,
                offsetY   : 0,
                startX    : 0,
                startY    : 0,
                lastX     : 0,
                lastY     : 0,
                nowX      : 0,
                nowY      : 0,
                distX     : 0,
                distY     : 0,
                dirAx     : 0,
                dirX      : 0,
                dirY      : 0,
                lastDirX  : 0,
                lastDirY  : 0,
                distAxX   : 0,
                distAxY   : 0
            };
            this.isTouch    = false;
            this.moving     = false;
            this.dragEl     = null;
            this.dragRootEl = null;
            this.dragDepth  = 0;
            this.hasNewRoot = false;
            this.pointEl    = null;
        },

        expandItem: function(li)
        {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action="expand"]').hide();
            li.children('[data-action="collapse"]').show();
            li.children(this.options.listNodeName).show();
        },

        collapseItem: function(li)
        {
            var lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        expandAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.expandItem($(this));
            });
        },

        collapseAll: function()
        {
            var list = this;
            list.el.find(list.options.itemNodeName).each(function() {
                list.collapseItem($(this));
            });
        },

        setParent: function(li)
        {
                  
            if (li.children(this.options.listNodeName).length) {
                li.prepend($(this.options.expandBtnHTML));
                li.prepend($(this.options.collapseBtnHTML));
            }
            li.children('[data-action="expand"]').hide();
                     
        },

        unsetParent: function(li)
        {

            li.removeClass(this.options.collapsedClass);
        
                  
             
            li.children('[data-action]').remove();
            li.children(this.options.listNodeName).remove();
        },

        dragStart: function(e)
        {
            var mouse    = this.mouse,
                target   = $(e.target),
                dragItem = target.closest(this.options.itemNodeName);

            this.placeEl.css('height', dragItem.height());

            mouse.offsetX = e.offsetX !== undefined ? e.offsetX : e.pageX - target.offset().left;
            mouse.offsetY = e.offsetY !== undefined ? e.offsetY : e.pageY - target.offset().top;
            mouse.startX = mouse.lastX = e.pageX;
            mouse.startY = mouse.lastY = e.pageY;

            this.dragRootEl = this.el;

            this.dragEl = $(document.createElement(this.options.listNodeName)).addClass(this.options.listClass + ' ' + this.options.dragClass);
            this.dragEl.css('width', dragItem.width());

            dragItem.after(this.placeEl);
            dragItem[0].parentNode.removeChild(dragItem[0]);
            dragItem.appendTo(this.dragEl);

            $(document.body).append(this.dragEl);
            this.dragEl.css({
                'left' : e.pageX - mouse.offsetX,
                'top'  : e.pageY - mouse.offsetY
            });
            // total depth of dragging item
            var i, depth,
                items = this.dragEl.find(this.options.itemNodeName);
            for (i = 0; i < items.length; i++) {
                depth = $(items[i]).parents(this.options.listNodeName).length;
                if (depth > this.dragDepth) {
                    this.dragDepth = depth;
                }
            }
        },

        dragStop: function(e)
        {
            var el = this.dragEl.children(this.options.itemNodeName).first();
            el[0].parentNode.removeChild(el[0]);
                console.log(el)
            el.data('unset-parent',1);
            this.placeEl.replaceWith(el);

            this.dragEl.remove();
            this.el.trigger('change');
            if (this.hasNewRoot) {
                this.dragRootEl.trigger('change');
            }
            this.reset();
        },

        dragMove: function(e)
        {
            var list, parent, prev, next, depth,
                opt   = this.options,
                mouse = this.mouse;

            this.dragEl.css({
                'left' : e.pageX - mouse.offsetX,
                'top'  : e.pageY - mouse.offsetY
            });

            // mouse position last events
            mouse.lastX = mouse.nowX;
            mouse.lastY = mouse.nowY;
            // mouse position this events
            mouse.nowX  = e.pageX;
            mouse.nowY  = e.pageY;
            // distance mouse moved between events
            mouse.distX = mouse.nowX - mouse.lastX;
            mouse.distY = mouse.nowY - mouse.lastY;
            // direction mouse was moving
            mouse.lastDirX = mouse.dirX;
            mouse.lastDirY = mouse.dirY;
            // direction mouse is now moving (on both axis)
            mouse.dirX = mouse.distX === 0 ? 0 : mouse.distX > 0 ? 1 : -1;
            mouse.dirY = mouse.distY === 0 ? 0 : mouse.distY > 0 ? 1 : -1;
            // axis mouse is now moving on
            var newAx   = Math.abs(mouse.distX) > Math.abs(mouse.distY) ? 1 : 0;

            // do nothing on first move
            if (!mouse.moving) {
                mouse.dirAx  = newAx;
                mouse.moving = true;
                return;
            }

            // calc distance moved on this axis (and direction)
            if (mouse.dirAx !== newAx) {
                mouse.distAxX = 0;
                mouse.distAxY = 0;
            } else {
                mouse.distAxX += Math.abs(mouse.distX);
                if (mouse.dirX !== 0 && mouse.dirX !== mouse.lastDirX) {
                    mouse.distAxX = 0;
                }
                mouse.distAxY += Math.abs(mouse.distY);
                if (mouse.dirY !== 0 && mouse.dirY !== mouse.lastDirY) {
                    mouse.distAxY = 0;
                }
            }
            mouse.dirAx = newAx;

            /**
             * move horizontal
             */
            if (mouse.dirAx && mouse.distAxX >= opt.threshold) {
                // reset move distance on x-axis for new phase
                mouse.distAxX = 0;
                prev = this.placeEl.prev(opt.itemNodeName);
                // increase horizontal level if previous sibling exists and is not collapsed
                if (mouse.distX > 0 && prev.length && !prev.hasClass(opt.collapsedClass)) {
                    // cannot increase level when item above is collapsed
                    list = prev.find(opt.listNodeName).last();
                    // check if depth limit has reached
                    depth = this.placeEl.parents(opt.listNodeName).length;
                    if (depth + this.dragDepth <= opt.maxDepth) {
                        // create new sub-level if one doesn't exist
                        if (!list.length) {
                            list = $('<' + opt.listNodeName + '/>').addClass(opt.listClass);
                            list.append(this.placeEl);
                            prev.append(list);
                            this.setParent(prev);
                        } else {
                            // else append to next level up
                            list = prev.children(opt.listNodeName).last();
                            list.append(this.placeEl);
                        }
                    }
                }
                // decrease horizontal level
                if (mouse.distX < 0) {
                    // we can't decrease a level if an item preceeds the current one
                    next = this.placeEl.next(opt.itemNodeName);
                    if (!next.length) {
                        parent = this.placeEl.parent();
                        this.placeEl.closest(opt.itemNodeName).after(this.placeEl);
                        if (!parent.children().length) {
                            this.unsetParent(parent.parent());
                        }
                    }
                }
            }

            var isEmpty = false;

            // find list item under cursor
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'hidden';
            }
            this.pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY - (window.pageYOffset || document.documentElement.scrollTop)));
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'visible';
            }
            if (this.pointEl.hasClass(opt.handleClass)) {
                this.pointEl = this.pointEl.parent(opt.itemNodeName);
            }
            
            
            if (this.pointEl.hasClass(opt.emptyClass)) {
                isEmpty = true;
            }
            else if (!this.pointEl.length || !this.pointEl.hasClass(opt.itemClass)) {
                return;
            }

            // find parent list of item under cursor
            var pointElRoot = this.pointEl.closest('.' + opt.rootClass),
                isNewRoot   = this.dragRootEl.data('nestable-id') !== pointElRoot.data('nestable-id');

            /**
             * move vertical
             */
            if (!mouse.dirAx || isNewRoot || isEmpty) {
                // check if groups match if dragging over new root
                if (isNewRoot && opt.group !== pointElRoot.data('nestable-group')) {
                    return;
                }
                // check depth limit
                depth = this.dragDepth - 1 + this.pointEl.parents(opt.listNodeName).length;
                if (depth > opt.maxDepth) {
                    return;
                }
                var before = e.pageY < (this.pointEl.offset().top + this.pointEl.height() / 2);
                    parent = this.placeEl.parent();
                // if empty create new list to replace empty placeholder
                if (isEmpty) {
                    list = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
                    list.append(this.placeEl);
                    this.pointEl.replaceWith(list);
                }
                else if (before) {
                    this.pointEl.before(this.placeEl);
                }
                else {
                    this.pointEl.after(this.placeEl);
                }
                if (!parent.children().length) {
                    this.unsetParent(parent.parent());
                }
                if (!this.dragRootEl.find(opt.itemNodeName).length) {
                    this.dragRootEl.append('<div class="' + opt.emptyClass + '"/>');
                }
                // parent root list has changed
                if (isNewRoot) {
                    this.dragRootEl = pointElRoot;
                    this.hasNewRoot = this.el[0] !== this.dragRootEl[0];
                }
            }
        }

    };

    $.fn.nestable = function(params)
    {
        var lists  = this,
            retval = this;

        lists.each(function()
        {
            var plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Plugin(this, params));
                $(this).data("nestable-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    retval = plugin[params]();
                }
            }
        });

        return retval || lists;
    };

})(window.jQuery || window.Zepto, window, document);


      $('#nestable').nestable({
        maxDepth: 5
      })
        .on('change', updateOutput);
    </script>
    
    <script>
    
        function changeType(tag)
        {
            $('.type-group').fadeOut();
           let type = $(tag).val();
           $('.'+type+'-group').fadeIn();
        }
        
        function editChangeType(tag)
        {
           $('.type-group').fadeOut();
          
           let type = $(tag).val();
           console.log(type)
        
           $('.edit-'+type+'-group').fadeIn();
        }
        
    </script>

@endsection




@section('content')


    <div class="container-fluid" style="background-color: #fff; height: 100vh;">

      <h1 class="text-center"> مدیریت منو ها</h1>

      <div class="row">
        
        <div class="col-md-3">
          <form  id="menu-add">
            <h3> اضافه کردن منو </h3>
            <div class="form-group">
              <label for="addInputName">نام</label>
              <input name="name" type="text" class="form-control" id="addInputName" placeholder="نام" required>
            </div>
            
                        <div class="form-group">
              <label for="addInputName">نام انگلیسی</label>
              <input name="addInputNameEn" type="text" class="form-control" id="addInputNameEn" placeholder="نام انگلیسی" required>
            </div>
            
            
            <div class="form-group">
                   <label > نوع منو  </label>
                <select  id="addInputType" onchange="changeType(this)" class="form-control" name="type">
                    <option selected value="0">نوع منو را انتخاب کنید</option>
                    <option value="product"> محصول</option>
                    <option value="page"> صفحه</option>
                    <option value="link"> لینک خارجی</option>

                    <option value="blog" >مقاله</option>
                </select>
                @error('type')
                <span class="error text-danger">
                    {{$message}}
                </span>
                @enderror
            </div>
            
            
            <div class="form-group type-group page-group">
                                   <label > انتخاب صفحه   </label>
                <select id="addInputPage" class="form-control" name="page_id">
                    @foreach($pages as $page)
                    <option value="{{$page->id}}"> {{$page->title}}</option>
                    @endforeach

                </select>
            </div>

            
            <div class="form-group  show-group">
                                   <label > انتخاب نوع نمایش   </label>
                <select id="addInputShow" class="form-control" name="is_show_header">
                    
                    <option  value="1"> نمایش در هدر</option>
                    <option value="0" >نمایش در سایدبار</option>
                    
                    <option value="3"> نمایش در هر دو بخش </option>
                  

                </select>
            </div>
            <div class="form-group type-group link-group">
              <label for="addInputSlug">لینک </label>
              <input name="link" type="text" class="form-control" id="addInputLink" placeholder="link" >
            </div>
           
<div class="form-group">
                <button class="btn btn-primary" id="addButton"> <i class="fa fa-plus-circle" aria-hidden="true"></i>اضافه کردن منو</button>
</div>
          </form>


        </div>
        <div class="col-md-6">
          <h3>منو</h3>
          <div class="dd nestable" id="nestable">
            <ol class="dd-list">

              <!--- Initial Menu Items --->
@foreach($menus as $menu)
             <li class="dd-item" data-id="{{$menu->id}}" data-name="{{$menu->name}}" data-show="{{$menu->is_show_header}}" data-type="{{$menu->type}}" data-name_en="{{$menu->name_en}}" data-page="{{$menu->page_id}}" data-link="{{$menu->link}}" data-new="0" data-deleted="0">
                <div class="dd-handle">{{$menu->name}}</div>
                <span class="button-delete btn btn-danger btn-xs pull-right"
                      data-owner-id="{{$menu->id}}">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </span>
                <span class="button-edit btn btn-success btn-xs pull-right"
                      data-owner-id="{{$menu->id}}">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </span>
       @if($menu->children->isNotEmpty())
                       <ol class="dd-list">
                  @foreach($menu->children as $child)
                  <li class="dd-item" data-page="{{$child->page_id}}" data-show="{{$child->is_show_header}}" data-id="{{$child->id}}" data-name="{{$child->name}}" data-type="{{$child->type}}" data-name_en="{{$child->name_en}}" data-link="{{$child->link}}" data-new="0" data-deleted="0">
                    <div class="dd-handle">{{$child->name}}</div>
                    <span class="button-delete btn btn-danger btn-xs pull-right"
                          data-owner-id="{{$child->id}}">
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                    <span class="button-edit btn btn-success btn-xs pull-right"
                          data-owner-id="{{$child->id}}">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </span>
                  </li>
                  @endforeach


                  
                </ol>
       @endif

         
              </li>
@endforeach
              <!--- Item1 --->


              <!--- Item2 --->

              <!--- Item3 --->
 
		


            </ol>
          </div>
        </div>
        
        <div class="col-md-3">
            
                      <form class="" id="menu-editor" style="display: none;">
            <h3>ویرایش <span id="currentEditName"></span></h3>
            <div class="form-group">
              <label for="addInputName">نام</label>
              <input name="name" type="text" class="form-control" id="editInputName" placeholder="نام" required>
            </div>
                        <div class="form-group">
              <label for="addInputName">نام انگلیسی</label>
              <input name="name_en" type="text" class="form-control" id="editInputNameEn" placeholder="نام انگلیسی" required>
            </div>
                        <div class="form-group">
                   <label > نوع منو  </label>
                <select  id="editInputType" onchange="editChangeType(this)" class="form-control" name="type">
                    <option selected value="0">نوع منو را انتخاب کنید</option>
                    <option value="product"> محصول</option>
                    <option value="page"> صفحه</option>
                    <option value="link"> لینک خارجی</option>
   
                     <option value="blog" >مقاله</option>
                </select>
                @error('type')
                <span class="error text-danger">
                    {{$message}}
                </span>
                @enderror
            </div>
            
            
            <div class="form-group  type-group edit-page-group">
                   <label > انتخاب صفحه   </label>
                <select id="editInputPage" class="form-control" name="page_id">
                    @foreach($pages as $page)
                    <option value="{{$page->id}}"> {{$page->title}}</option>
                    @endforeach

                </select>
            </div>


         <div class="form-group   edit-show-group">
                   <label > انتخاب نوع نمایش   </label>
                <select id="editInputShow" class="form-control" name="is_show_header">
               
                    <option  value="1"> نمایش در هدر</option>
                    
                     <option value="0"> نمایش در سایدبار </option>
                     
                                   <option value="2"> نمایش در هر دو بخش </option>
                  

                </select>
            </div>

            <div class="form-group type-group edit-link-group">
              <label for="addInputLink">لینک</label>
              <input type="text" name="link" class="form-control" id="editInputLink" placeholder="لینک">
            </div>
            

            <button class="btn btn-info" id="editButton">ویرایش</button>
          </form>
        </div>
      </div>

      <!--<div class="row output-container">-->
      <!--  <div class="col-md-offset-1 col-md-10">-->
      <!--    <h2 class="text-center">Output:</h2>-->
      <!--    <form class="form">-->
      <!--      <textarea class="form-control" id="json-output" rows="5"></textarea>-->
      <!--    </form>-->
      <!--  </div>-->
      <!--</div>-->

    </div>



@endsection


