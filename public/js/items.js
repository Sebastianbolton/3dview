// add items to the "Add Items" tab

$(document).ready(function () {
  var items = [
    {
      "name": "Dresser - Dark Wood",
      "image": "public/models/thumbnails/thumbnail_matera_dresser_5.png",
      "model": "public/models/js/DWR_MATERA_DRESSER2.js",
      "type": "1",
      "price": "2216.00"
    },
    {
      "name": "Dresser - White",
      "image": "public/models/thumbnails/thumbnail_img25o.jpg",
      "model": "public/models/js/we-narrow6white_baked.js",
      "type": "1",
      "price": "2100.00"
    },
    {
      "name": "Bedside table - Shale",
      "image": "public/models/thumbnails/thumbnail_Blu-Dot-Shale-Bedside-Table.jpg",
      "model": "public/models/js/bd-shalebedside-smoke_baked.js",
      "type": "1",
      "price": "770.00"
    },
    {
      "name": "Bedside table - White",
      "image": "public/models/thumbnails/thumbnail_arch-white-oval-nightstand.jpg",
      "model": "public/models/js/cb-archnight-white_baked.js",
      "type": "1",
      "price": "150.00"
    },
    {
      "name": "Wardrobe - White",
      "image": "public/models/thumbnails/thumbnail_TN-ikea-kvikine.png",
      "model": "public/models/js/ik-kivine_baked.js",
      "type": "1",
      "price": "932.00"
    },
    {
      "name": "Full Bed",
      "image": "public/models/thumbnails/thumbnail_nordli-bed-frame__0159270_PE315708_S4.JPG",
      "model": "public/models/js/ik_nordli_full.js",
      "type": "1",
      "price": "3000.00"
    },
    {
      "name": "Bookshelf",
      "image": "public/models/thumbnails/thumbnail_kendall-walnut-bookcase.jpg",
      "model": "public/models/js/cb-kendallbookcasewalnut_baked.js",
      "type": "1",
      "price": "419.00"
    },
    {
      "name": "Media Console - White",
      "image": "public/models/thumbnails/thumbnail_clapboard-white-60-media-console-1.jpg",
      "model": "public/models/js/cb-clapboard_baked.js",
      "type": "1",
      "price": "2700.00"
    },
    {
      "name": "Media Console - Black",
      "image": "public/models/thumbnails/thumbnail_moore-60-media-console-1.jpg",
      "model": "public/models/js/cb-moore_baked.js",
      "type": "1",
      "price": "2539.00"
    },
    {
      "name": "Sectional - Olive",
      "image": "public/models/thumbnails/thumbnail_img21o.jpg",
      "model": "public/models/js/we-crosby2piece-greenbaked.js",
      "type": "1",
      "price": "1500.00"
    },
    {
      "name": "Sofa - Grey",
      "image": "public/models/thumbnails/thumbnail_rochelle-sofa-3.jpg",
      "model": "public/models/js/cb-rochelle-gray_baked.js",
      "type": "1",
      "price": "1076.00"
    },
    {
      "name": "Wooden Trunk",
      "image": "public/models/thumbnails/thumbnail_teca-storage-trunk.jpg",
      "model": "public/models/js/cb-tecs_baked.js",
      "type": "1",
      "price": "649.00"
    },
    {
      "name": "Floor Lamp",
      "image": "public/models/thumbnails/thumbnail_ore-white.png",
      "model": "public/models/js/ore-3legged-white_baked.js",
      "type": "1",
      "price": "570.00"
    },
    {
      "name": "Coffee Table - Wood",
      "image": "public/models/thumbnails/thumbnail_stockholm-coffee-table__0181245_PE332924_S4.JPG",
      "model": "public/models/js/ik-stockholmcoffee-brown.js",
      "type": "1",
      "price": "160.00"
    },
    {
      "name": "Side Table",
      "image": "public/models/thumbnails/thumbnail_Screen_Shot_2014-02-21_at_1.24.58_PM.png",
      "model": "public/models/js/GUSossingtonendtable.js",
      "type": "1",
      "price": "150.00"
    },
    {
      "name": "Dining Table",
      "image": "public/models/thumbnails/thumbnail_scholar-dining-table.jpg",
      "model": "public/models/js/cb-scholartable_baked.js",
      "type": "1",
      "price": "150.00"
    },
    {
      "name": "Dining table",
      "image": "public/models/thumbnails/thumbnail_Screen_Shot_2014-01-28_at_6.49.33_PM.png",
      "model": "public/models/js/BlakeAvenuejoshuatreecheftable.js",
      "type": "1",
      "price": "150.00"
    },
    {
      "name": "Blue Rug",
      "image": "public/models/thumbnails/thumbnail_cb-blue-block60x96.png",
      "model": "public/models/js/cb-blue-block-60x96.js",
      "type": "8",
      "price": "150.00"
    },
    {
      "name": "NYC Poster",
      "image": "public/models/thumbnails/thumbnail_nyc2.jpg",
      "model": "public/models/js/nyc-poster2.js",
      "type": "2",
      "price": "150.00"
    }
    /*     
    {
       "name" : "",
       "image" : "",
       "model" : "",
       "type" : "1"
      }, 
      */
    ]
    var chairs = [
      {
        "name": "Chair",
        "image": "public/models/thumbnails/thumbnail_Church-Chair-oak-white_1024x1024.jpg",
        "model": "public/models/js/gus-churchchair-whiteoak.js",
        "type": "1",
        "price": "210.00"
      },
      {
        "name": "Red Chair",
        "image": "public/models/thumbnails/thumbnail_tn-orange.png",
        "model": "public/models/js/ik-ekero-orange_baked.js",
        "type": "1",
        "price": "653.00"
      },
      {
        "name": "Blue Chair",
        "image": "public/models/thumbnails/thumbnail_ekero-blue3.png",
        "model": "public/models/js/ik-ekero-blue_baked.js",
        "type": "1",
        "price": "551.00"
      },
      {
        "name": "Sectional - Olive",
        "image": "public/models/thumbnails/thumbnail_img21o.jpg",
        "model": "public/models/js/we-crosby2piece-greenbaked.js",
        "type": "1",
        "price": "1500.00"
      },
      {
        "name": "Sofa - Grey",
        "image": "public/models/thumbnails/thumbnail_rochelle-sofa-3.jpg",
        "model": "public/models/js/cb-rochelle-gray_baked.js",
        "type": "1",
        "price": "1076.00"
      },
      
    ]
    var doors = [
      {
        "name": "Closed Door",
        "image": "public/models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.04.12_PM.png",
        "model": "public/models/js/closed-door28x80_baked.js",
        "type": "7",
        "price": "329.00"
      },
      {
        "name": "Open Door",
        "image": "public/models/thumbnails/thumbnail_Screen_Shot_2014-10-27_at_8.22.46_PM.png",
        "model": "public/models/js/open_door.js",
        "type": "7",
        "price": "0.00"
      },
      
    ]
    var carpets = [
      {
        "name": "Blue Rug",
        "image": "public/models/thumbnails/thumbnail_cb-blue-block60x96.png",
        "model": "public/models/js/cb-blue-block-60x96.js",
        "type": "8",
        "price": "150.00"
      },
      {
        "name": "NYC Poster",
        "image": "public/models/thumbnails/thumbnail_nyc2.jpg",
        "model": "public/models/js/nyc-poster2.js",
        "type": "2",
        "price": "150.00"
    }

  ]

  var itemsDiv = $("#items-wrapper")
  for (var i = 0; i < items.length; i++) {
    var item = items[i];
    var html = '<div class="col-sm-6 design-items">' +
      '<a class="thumbnail add-item" model-name="' +
      item.name +
      '" model-url="' +
      item.model +
      '" model-type="' +
      item.type +
      '" model-price="' +
      item.price +
      '"><img src="' +
      item.image +
      '" alt="Add Item"><p>' +
      item.name +
      '</p><span>' +
      item.price +
      '</span>$</a></div>';

    itemsDiv.append(html);
  }

  var chairsDiv = $("#chairs-wrapper")
  for (var i = 0; i < chairs.length; i++) {
    var item = chairs[i];
    var html = '<div class="col-sm-6 design-items">' +
      '<a class="thumbnail add-item" model-name="' +
      item.name +
      '" model-url="' +
      item.model +
      '" model-type="' +
      item.type +
      '"model-price="' +
      item.price +
      '"><img src="' +
      item.image +
      '" alt="Add Item"><p>' +
      item.name +
      '</p><span>' +
      item.price +
      '</span>$</a></div>';
    chairsDiv.append(html);

  }

  var doorsDiv = $("#doors-wrapper")
  for (var i = 0; i < doors.length; i++) {
    var item = doors[i];
    var html = '<div class="col-sm-6 design-items">' +
      '<a class="thumbnail add-item" model-name="' +
      item.name +
      '" model-url="' +
      item.model +
      '" model-type="' +
      item.type +
      '" model-price="' +
      item.price +
      '"><img src="' +
      item.image +
      '" alt="Add Item"><p>' +
      item.name +
      '</p><span>' +
      item.price +
      '</span>$</a></div>';
    doorsDiv.append(html);
  }
  var carpetsDiv = $("#carpets-wrapper")
  for (var i = 0; i < carpets.length; i++) {
    var item = carpets[i];
    var html = '<div class="col-sm-6 design-items">' +
      '<a class="thumbnail add-item" model-name="' +
      item.name +
      '" model-url="' +
      item.model +
      '" model-type="' +
      item.type +
      '" model-price="' +
      item.price +
      '"><img src="' +
      item.image +
      '" alt="Add Item"><p>' +
      item.name +
      '</p><span>' +
      item.price +
      '</span>$</a></div>';
    carpetsDiv.append(html);
  }
});