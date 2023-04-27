<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div cl s="container">
      <div class="card" style="margin-top: 10px;">
        <div class="card-body">
          <h5 class="card-title">Wishlist Collection</h5>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Archived</a>
            </li>
          </ul>
          <div id="tab-active" class="row">
            <div class="col">
              <div style="padding: 10px;">
                <div class="d-flex flex-row mb-3" id="wishlist-category-section">
                </div>
                <div class="row">
                  <div class="col">
                    <div class="input-group mb-3">
                      <input type="text" id="search" class="form-control" placeholder="product's name" aria-label="" aria-describedby="basic-addon2">
                      <span class="input-group-text" id="btn-search"><button type="button" class="btn btn-primary">Search</button></span>
                    </div>
                  </div>
                  <div class="col">

                  </div>
                </div>
                <div class="d-flex">
                  <div class="flex-grow-1 m-auto">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="btn-select-all">
                      <label class="form-check-label" for="flexCheckDefault">
                        Select All
                      </label>
                    </div>
                  </div>
                  <div class="p-2">
                    <div class="dropdown">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Shop : <span id="filter-shop-selected">All</span>
                      </button>
                      <ul class="dropdown-menu" id="shop-wrapper">
                      </ul>
                    </div>
                  </div>
                  <div class="p-2">
                    <div class="dropdown">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Price : <span id="sort-price-selected">Low to High</span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item sort-price" data-price-order='asc' data-sort-price="Low to High" href="#">Low to High</a></li>
                        <li><a class="dropdown-item sort-price" data-price-order='desc' data-sort-price="High to Low" href="#">High to Low</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="p-2">
                    <div class="dropdown">
                      <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Date : <span id="sort-date-selected">Oldest to Newest</span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item sort-date" data-date-order='asc' data-sort-date="Oldest to Newest" href="#">Oldest to Newest</a></li>
                        <li><a class="dropdown-item sort-date" data-date-order='desc' data-sort-date="Newest to Oldest" href="#">Newest to Oldest</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="" id="wishlist-section"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-wishlist-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <form id="wishlist-category-form">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Wishlist Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" id="name" placeholder="">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(document).ready(function () {
        $("body").on('click', '#btn-add-wishlist-category', function(e) {
          $("#modal-wishlist-category").modal('show');
        });

        function wishlistCategoryList() {
          $.ajax({
            method: 'GET',
            url: '/wishlist/category',
            cache: false,
          }).done(function (data) {
            $("#wishlist-category-section").empty();
            var categories = data.data;
            var elmCategorySection = "";
            if (categories.length > 0) {
              for(var i = 0; i < categories.length; i++) {
                var elm = $("<div>").addClass("p-2")
                .append($("<img>").attr('src', 'https://place-hold.it/100x100').addClass("img-thumbnail"))
                .append($("<br>"))
                .append($("<span>").text(categories[i].name));
                $("#wishlist-category-section").append(elm);
              }
              $("#wishlist-category-section").append($("<div>").addClass("p-2")
                .append($("<button>").addClass("btn btn-primary").attr({
                  'type': 'button',
                  'id': 'btn-add-wishlist-category'
                }).text('Add')));
            }
          });
        }

        function wishlist() {
          var params = {
            shop: $("#filter-shop-selected").html(),
            price: $("#sort-price-selected").html(),
            date: $("#sort-date-selected").html(),
            search: $("#search").val(),
          };
          $.ajax({
            method: 'GET',
            url: "{{ route('wishlist.data') }}?" + $.param(params),
            cache: false,
          }).done(function (data) {
            var wishlist = data.data;
            $("#wishlist-section").empty();
            if (wishlist.length > 0) {
              for(var i = 0; i < wishlist.length; i++) {
                var elm = '<div class="d-flex mb-3" style="margin-left: -8px;"><div class="p-2">'+
                    '<div class="form-check">'+
                      '<input class="form-check-input w-list" type="checkbox" value="" id="w-list-'+wishlist[i].product.id+'">'+
                      '<label class="form-check-label" for="flexCheckDefault">'+
                      '</label>'+
                    '</div>'+
                  '</div>'+
                  '<div class="p-2">'+
                    '<img src="https://place-hold.it/300x200" class="img-thumbnail" alt="...">'+
                  '</div>'+
                  '<div class="p-2 flex-fill">'+
                    '<h5>'+wishlist[i].product.name+'</h5>'+
                    '<span>Desc</span>'+
                    '<table class="table table-borderless" style="">'+
                      '<tr>'+
                        '<th>Price</th>'+
                        '<th>Quantity</td>'+
                        '<th>Shop</td>'+
                        '<th>&nbsp;</td>'+
                      '</tr>'+
                      '<tr>'+
                        '<td>$'+wishlist[i].product.price+'</td>'+
                        '<td>1</td>'+
                        '<td>'+wishlist[i].product.source+'</td>'+
                        '<td><span class="badge rounded-pill text-bg-primary">Most desired</span></td>'+
                      '<tr>'+
                    '</table>'+
                  '</div>'+
                '</div></div>';
                $("#wishlist-section").append($(elm));
              }
            }
          })
        }

        function getShop() {
          $.ajax({
            method: 'GET',
            url: '{{ route("wishlist.shop") }}',
            cache: false
          }).done(function (data) {
            var shops = data;
            var elm = '<li><a class="dropdown-item filter-shop" data-filter-shop="All" href="#">All</a></li>';
            $("#shop-wrapper").append($(elm));
            for(var i = 0; i < shops.length; i++) {
              var elm = '<li><a class="dropdown-item filter-shop" data-filter-shop="'+shops[i]+'" href="#">'+shops[i]+'</a></li>';
              $("#shop-wrapper").append($(elm));
            }
          })
        }

        $("#wishlist-category-form").submit(function () {
          $.ajax({
            method: 'POST',
            url: '/wishlist/category/add',
            data: {'name': $(this).find('#name').val()},
            cache: false,
          }).done(function (data) {
            if (data == 'ok') {
              $("#modal-wishlist-category").modal('hide');
              wishlistCategoryList();
            }
          });
          return false;
        });

        $("body").on('click', '.filter-shop', function(e) {
          $("#filter-shop-selected").html($(this).data('filter-shop'));
          wishlist();
        });

        $("body").on('click', '.sort-price', function(e) {
          $("#sort-price-selected").html($(this).data('sort-price'));
          wishlist();
        });

        $("#btn-select-all").click(function() {
          $(".w-list").each(function (i, elem) {
            $(elem).trigger('click');
          });
        });

        $("#btn-search").click(function() {
          wishlist();
        });

        // render categories
        wishlistCategoryList();
        wishlist();
        getShop();

      });
    </script>
  </body>
</html>