
/*
 * Camera Buttons
 */

var CameraButtons = function (blueprint3d) {

  var orbitControls = blueprint3d.three.controls;
  var three = blueprint3d.three;

  var panSpeed = 30;
  var directions = {
    UP: 1,
    DOWN: 2,
    LEFT: 3,
    RIGHT: 4
  }

  function init() {
    // Camera controls
    $("#zoom-in").click(zoomIn);
    $("#zoom-out").click(zoomOut);
    $("#zoom-in").dblclick(preventDefault);
    $("#zoom-out").dblclick(preventDefault);

    $("#reset-view").click(three.centerCamera)

    $("#move-left").click(function () {
      pan(directions.LEFT)
    })
    $("#move-right").click(function () {
      pan(directions.RIGHT)
    })
    $("#move-up").click(function () {
      pan(directions.UP)
    })
    $("#move-down").click(function () {
      pan(directions.DOWN)
    })

    $("#move-left").dblclick(preventDefault);
    $("#move-right").dblclick(preventDefault);
    $("#move-up").dblclick(preventDefault);
    $("#move-down").dblclick(preventDefault);
  }

  function preventDefault(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  function pan(direction) {
    switch (direction) {
      case directions.UP:
        orbitControls.panXY(0, panSpeed);
        break;
      case directions.DOWN:
        orbitControls.panXY(0, -panSpeed);
        break;
      case directions.LEFT:
        orbitControls.panXY(panSpeed, 0);
        break;
      case directions.RIGHT:
        orbitControls.panXY(-panSpeed, 0);
        break;
    }
  }

  function zoomIn(e) {
    e.preventDefault();
    orbitControls.dollyIn(1.1);
    orbitControls.update();
  }

  function zoomOut(e) {
    e.preventDefault;
    orbitControls.dollyOut(1.1);
    orbitControls.update();
  }

  init();
}

/*
 * Context menu for selected item
 */

var ContextMenu = function (blueprint3d, itemsList) {

  var scope = this;
  var selectedItem;
  var three = blueprint3d.three;
  var selectItemPrice = 0;
  var selectItem = "";
  function init() {
    $("#context-menu-delete").click(function (event) {
      $("#receivePrice").text((parseInt($("#receivePrice").text()) - selectItemPrice) + "$");
      console.log("selectedItemDelete => ", selectItem);
      selectedItem.remove();
      for(var i =0 ; i<itemsList.length;i+=2){
        if(itemsList[i]==selectItem.itemName){
          console.log("it is", typeof(itemsList), typeof(itemsList[0]));
          for(var j = i; j<itemsList.length; j+=2){
            itemsList[j] = itemsList[j+2];
            itemsList[j+1] = itemsList[j+3];
          }
          itemsList.pop();
          itemsList.pop();
          break;
        }
      }
      console.log("hello" + itemsList)
      // var filtered = itemsList.filter(selectItem.itemName);
      // console.log(filtered)
    });
    

    three.itemSelectedCallbacks.add(itemSelected);
    three.itemUnselectedCallbacks.add(itemUnselected);

    initResize();

    $("#fixed").click(function () {
      var checked = $(this).prop('checked');
      selectedItem.setFixed(checked);
    });
  }

  function cmToIn(cm) {
    return cm / 2.54;
  }

  function inToCm(inches) {
    return inches * 2.54;
  }

  function itemSelected(item) {
    selectedItem = item;

    $("#context-menu-name").text(item.metadata.itemName);
    selectItemPrice = item.metadata.itemPrice;
    selectItem = item.metadata;
    // console.log("====>", selectItem);

    $("#item-width").val(cmToIn(selectedItem.getWidth()).toFixed(0));
    $("#item-height").val(cmToIn(selectedItem.getHeight()).toFixed(0));
    $("#item-depth").val(cmToIn(selectedItem.getDepth()).toFixed(0));

    if(!order_flag){
      $("#context-menu").show();
    }

    $("#fixed").prop('checked', item.fixed);
    // console.log(selectedItem);  
  }

  function resize() {
    selectedItem.resize(
      inToCm($("#item-height").val()),
      inToCm($("#item-width").val()),
      inToCm($("#item-depth").val())
    );
  }

  function initResize() {
    $("#item-height").change(resize);
    $("#item-width").change(resize);
    $("#item-depth").change(resize);
  }

  function itemUnselected() {
    selectedItem = null;
    $("#context-menu").hide();
  }

  init();
}

/*
 * Loading modal for items
 */

var ModalEffects = function (blueprint3d) {

  var scope = this;
  var blueprint3d = blueprint3d;
  var itemsLoading = 0;

  this.setActiveItem = function (active) {
    itemSelected = active;
    update();
  }

  function update() {
    if (itemsLoading > 0) {
      $("#loading-modal").show();
    } else {
      $("#loading-modal").hide();
    }
  }

  function init() {
    blueprint3d.model.scene.itemLoadingCallbacks.add(function () {
      itemsLoading += 1;
      update();
    });

    blueprint3d.model.scene.itemLoadedCallbacks.add(function () {
      itemsLoading -= 1;
      update();
    });

    update();
  }

  init();
}

/*
 * Side menu
 */
var order_flag = 0;
var SideMenu = function (blueprint3d, floorplanControls, modalEffects, itemsList) {
  var blueprint3d = blueprint3d;
  var floorplanControls = floorplanControls;
  var modalEffects = modalEffects;

  var ACTIVE_CLASS = "active";

  var tabs = {
    "FLOORPLAN": $("#floorplan_tab"),
    "SHOP": $("#items_tab"),
    "DESIGN": $("#design_tab"),
    "ORDER" : $("#order_tab"),
  }
  var imageTabs = {
    "draw" : $("#draw"),
    "edit" : $("#edit"),
    "add" : $('#add')
  }

  var scope = this;
  this.stateChangeCallbacks = $.Callbacks();

  this.states = {
    "DEFAULT": {
      "div": $("#viewer"),
      "tab": tabs.DESIGN
    },
    "FLOORPLAN": {
      "div": $("#floorplanner"),
      "tab": tabs.FLOORPLAN
    },
    "SHOP": {
      "div": $("#accordion"),
      "tab": tabs.SHOP
    },
    "ORDER" : {
      "div" : $("#order_menu"),
      "tab" : tabs.ORDER
    }
  };

  // sidebar state
  var currentState = scope.states.FLOORPLAN;

  function imageToggle(tab) {
    return function () {
      var img = document.getElementById(tab).src;
      // img.indexOf('Edit-white.png')!=-1
      if (img.indexOf('Edit-white.png') != -1) {
        document.getElementById(tab).src = 'images/icons/Edit-dark.png';
      }
      else {
        document.getElementById(tab).src = 'images/icons/Edit-white.png';
      }
    }
  }
  function init() {
    for (var tab in tabs) {
      var elem = tabs[tab];
      elem.click(tabClicked(elem));
      // elem.click(imageToggle(elem));
    }
    // for (var imageTab in imageTabs) {
    //   var items = imageTabs[imageTab];
    //   items.click(imageToggle(item));
    // }

    $("#update-floorplan").click(floorplanUpdate);

    // initLeftMenu();

    blueprint3d.three.updateWindowSize();
    handleWindowResize();

    initItems();

    setCurrentState(scope.states.DEFAULT);
  }

  function floorplanUpdate() {
    setCurrentState(scope.states.DEFAULT);
  }

  function tabClicked(tab) {
    return function () {
      // Stop three from spinning
      blueprint3d.three.stopSpin();

      // Selected a new tab
      for (var key in scope.states) {
        var state = scope.states[key];
        if (state.tab == tab) {
          setCurrentState(state);
          break;
        }
      }
    }
  }

  function setCurrentState(newState) {

    if (currentState == newState) {
      return;
    }

    // show the right tab as active
    if (currentState.tab !== newState.tab) {
      if (currentState.tab != null) {
        currentState.tab.removeClass(ACTIVE_CLASS);
      }
      if (newState.tab != null) {
        newState.tab.addClass(ACTIVE_CLASS);
      }
    }

    // set item unselected
    blueprint3d.three.getController().setSelectedObject(null);

    // show and hide the right divs
    currentState.div.hide()
    newState.div.show()
    if (newState == scope.states.SHOP) {
      currentState.div.show();
      newState.div.show();
    }
    if (newState == scope.states.DEFAULT) {
      scope.states.FLOORPLAN.div.hide();
      scope.states.DEFAULT.div.show();
    }
    if (newState == scope.states.FLOORPLAN) {
      scope.states.DEFAULT.div.hide();
      scope.states.FLOORPLAN.div.show();
    }
    if(newState == scope.states.ORDER){
      scope.states.DEFAULT.div.show();
      order_flag = 1;
      $(this).add(order);
    }
    if(newState != scope.states.ORDER){
      scope.states.ORDER.div.hide();
      order_flag = 0;
      
    }

    // custom actions
    if (newState == scope.states.FLOORPLAN) {
      floorplanControls.updateFloorplanView();
      floorplanControls.handleWindowResize();
    }

    if (currentState == scope.states.FLOORPLAN) {
      blueprint3d.model.floorplan.update();
    }

    if (newState == scope.states.DEFAULT) {
      blueprint3d.three.updateWindowSize();
    }

    // set new state
    handleWindowResize();
    currentState = newState;

    scope.stateChangeCallbacks.fire(newState);
  }

  function initLeftMenu() {
    $(window).resize(handleWindowResize);
    handleWindowResize();
  }

  function handleWindowResize() {
    $(".sidebar").height(window.innerHeight);
    var offset = $('.add-items').offset();
    var itemsHeight = ($(window).innerHeight() - offset.top) - $(window).height() * 0.045;
    var onecollapseHeight = ($(window).height() - itemsHeight - offset.top);
    $(".add-items").height(itemsHeight - onecollapseHeight + 20);
    // var containerOffset = $('#accordion-container').offset(); // gets the container's origin coordinates
    // var containerHeight = ($(window).height() - containerOffset.top) - 20; //determines container's maximum height
    // $('#accordion-container').css({ // sets container's maximum height & enables vertical scrolling for content overflow
    //   'max-height': containerHeight, 
    //   'overflow-y' : 'auto'
    // });
  };

  // TODO: this doesn't really belong here
  function initItems() {
    var sum = 0;
    var oldprice = 0;
    $(".add-items").find(".add-item").mousedown(function (e) {
      var modelUrl = $(this).attr("model-url");
      var itemType = parseInt($(this).attr("model-type"));
      var metadata = {
        itemName: $(this).attr("model-name"),
        itemPrice: $(this).attr("model-price"),
        resizable: true,
        modelUrl: modelUrl,
        itemType: itemType
      }

      blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
      itemsList.push(metadata.itemName);
      itemsList.push(metadata.itemPrice);
      oldprice =oldprice + parseInt($(this).attr("model-price"));
      $('#receivePrice').text(oldprice+"$");
      // console.log("itemsList => ", itemsList);

      setCurrentState(scope.states.DEFAULT);
      
    });
  }

  function order(){
    var ordersDiv = $("#order-wrapper");
      ordersDiv.text("");
      for (var i = 0; i < itemsList.length; i+=2) {
        var item = itemsList[i];
        var price = itemsList[i+1];
        var html = '<div class="row order-table"><div class="col-8">' + item + '</div><div class="col-4">$' + price + '</div></div>';
        ordersDiv.append(html);
      }
  }

  init();

}

/*
 * Change floor and wall textures
 */

var TextureSelector = function (blueprint3d, sideMenu) {

  var scope = this;
  var three = blueprint3d.three;
  var isAdmin = isAdmin;

  var currentTarget = null;

  function initTextureSelectors() {
    $(".texture-select-thumbnail").click(function (e) {
      var textureUrl = $(this).attr("texture-url");
      var textureStretch = ($(this).attr("texture-stretch") == "true");
      var textureScale = parseInt($(this).attr("texture-scale"));
      currentTarget.setTexture(textureUrl, textureStretch, textureScale);

      e.preventDefault();
    });
  }

  function init() {
    three.wallClicked.add(wallClicked);
    three.floorClicked.add(floorClicked);
    three.itemSelectedCallbacks.add(reset);
    three.nothingClicked.add(reset);
    sideMenu.stateChangeCallbacks.add(reset);
    initTextureSelectors();
  }

  function wallClicked(halfEdge) {
    if(!order_flag){
        currentTarget = halfEdge;
        $("#floorTexturesDiv").hide();
        $("#wallTextures").show();
    }
  }

  function floorClicked(room) {
    if(!order_flag){
       currentTarget = room;
       $("#wallTextures").hide();
      $("#floorTexturesDiv").show();
    }
  }

  function reset() {
    $("#wallTextures").hide();
    $("#floorTexturesDiv").hide();
  }

  init();
}

/*
 * Floorplanner controls
 */

var ViewerFloorplanner = function (blueprint3d) {

  var canvasWrapper = '#floorplanner';

  // buttons
  var move = '#move';
  var remove = '#delete';
  var draw = '#draw';

  var activeStlye = 'btn-primary';

  this.floorplanner = blueprint3d.floorplanner;

  var scope = this;

  function init() {

    $(window).resize(scope.handleWindowResize);
    scope.handleWindowResize();

    // mode buttons
    scope.floorplanner.modeResetCallbacks.add(function (mode) {
      $(draw).removeClass(activeStlye);
      $(remove).removeClass(activeStlye);
      $(move).removeClass(activeStlye);
      if (mode == BP3D.Floorplanner.floorplannerModes.MOVE) {
        $(move).addClass(activeStlye);
      } else if (mode == BP3D.Floorplanner.floorplannerModes.DRAW) {
        $(draw).addClass(activeStlye);
      } else if (mode == BP3D.Floorplanner.floorplannerModes.DELETE) {
        $(remove).addClass(activeStlye);
      }

      if (mode == BP3D.Floorplanner.floorplannerModes.DRAW) {
        $("#draw-walls-hint").show();
        scope.handleWindowResize();
      } else {
        $("#draw-walls-hint").hide();
      }
    });

    $(move).click(function () {
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.MOVE);
    });

    $(draw).click(function () {
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.DRAW);
    });

    $(remove).click(function () {
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.DELETE);
    });
  }

  this.updateFloorplanView = function () {
    scope.floorplanner.reset();
  }

  this.handleWindowResize = function () {
    $(canvasWrapper).height(window.innerHeight - $(canvasWrapper).offset().top);
    scope.floorplanner.resizeView();
  };

  init();
};

var mainControls = function (blueprint3d) {
  var blueprint3d = blueprint3d;

  function newDesign() {
    blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":204.85099999999989,"y":289.052},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":672.2109999999999,"y":289.052},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":672.2109999999999,"y":-178.308},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":204.85099999999989,"y":-178.308}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
  }

  function loadDesign() {
    files = $("#loadFile").get(0).files;
    var reader = new FileReader();
    reader.onload = function (event) {
      var data = event.target.result;
      blueprint3d.model.loadSerialized(data);
    }
    reader.readAsText(files[0]);
  }

  function saveDesign() {
    var data = blueprint3d.model.exportSerialized();
    var a = window.document.createElement('a');
    var blob = new Blob([data], { type: 'text' });
    a.href = window.URL.createObjectURL(blob);
    a.download = 'design.blueprint3d';
    document.body.appendChild(a)
    a.click();
    document.body.removeChild(a)
  }

  function init() {
    $("#new").click(newDesign);
    $("#loadFile").change(loadDesign);
    $("#saveFile").click(saveDesign);
  }

  init();
}

/*
 * Initialize!
 */


$(document).ready(function () {

  // main setup
  var opts = {
    floorplannerElement: 'floorplanner-canvas',
    threeElement: '#viewer',
    threeCanvasElement: 'three-canvas',
    textureDir: "models/textures/",
    widget: false
  }
  var blueprint3d = new BP3D.Blueprint3d(opts);
  var itemsList = [];

  var modalEffects = new ModalEffects(blueprint3d);
  var viewerFloorplanner = new ViewerFloorplanner(blueprint3d);
  var contextMenu = new ContextMenu(blueprint3d, itemsList);
  var sideMenu = new SideMenu(blueprint3d, viewerFloorplanner, modalEffects, itemsList);
  var textureSelector = new TextureSelector(blueprint3d, sideMenu);
  var cameraButtons = new CameraButtons(blueprint3d);
  mainControls(blueprint3d);



  // This serialization format needs work
  // Load a simple rectangle room
  blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":204.85099999999989,"y":289.052},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":672.2109999999999,"y":289.052},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":672.2109999999999,"y":-178.308},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":204.85099999999989,"y":-178.308}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"public/rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
});
