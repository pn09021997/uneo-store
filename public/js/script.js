$(document).ready(function () {
  //Btn Go Top
  $("#goTop").click(() => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  //Update fixed-top to Navbar
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      $(".navbar").addClass("fixed-top");
      $("#goTop").show();
    } else {
      $(".navbar").removeClass("fixed-top");
      $("#goTop").hide();
    }
  }

  //Get All Products
  const urlAllProducts = "./public/ajax/getAllProducts.php";
  const allProducts = [];

  $.ajax({
    type: "GET",
    url: urlAllProducts,
    dataType: "JSON",
    success: function (data) {
      for (let i = 0; i < data.length; i += 1) {
        allProducts.push(data[i]);
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });

  // --- SEARCH
  $("#searchInput").keyup((e) => {
    const value = e.target.value.toLowerCase();
    let products = [];
    if (value.length > 0)
      products = allProducts.filter(
        (o) => o.name.toLowerCase().indexOf(value) !== -1
      );
    renderSearchList(products, value);
  });

  function renderSearchList(products, search) {
    let renderList = "";
    for (let i = 0; i < products.length; i++) {
      const element = products[i];
      const img = products[i].pro_image;
      const name = products[i].name;
      renderList += `
            <li style='display: flex; margin-bottom: 5px'>
            <img src="${img}" alt="logo-img" class="img-fluid" width='50px' style='margin-right: 5px'>
            <a href="product-detail.php?productName=${name}" class="list-group-item list-group-item-action">
            ${name}
            </a>    
            </li>`;
    }
    $("#searchList").empty();
    $("#searchList").append(renderList);
  }
  /*function changeCurrency(currency) {
        console.log(currency);
        switch (currency) {
            case 'EUR':
                $('.price').each((index, item) => {
                    let currentPrice = item.innerHTML.substr(1, item.length);
                    let currencyUnit = 0.85;
                    item.innerHTML = '€' + (currentPrice * currencyUnit).toFixed(2);
                    console.log(item.innerHTML);
                });
                break;
            case 'USA':
                $('.price').each((index, item) => {
                    let currentPrice = item.innerHTML.substr(1, item.length);
                    let currencyUnit = 1.18;
                    item.innerHTML = '$' + (currentPrice * currencyUnit).toFixed(2);
                    console.log(item.innerHTML);
                });
                break;
            default: console.log('Not found');
                break;
        }
    }
    //Set Currency For 
    $('#demo').click(() => {
        console.log($('#demo').text());
    });*/

  //Get list Products by price range
  if ($("#priceRange")) {
    $("#rangeMinValue").html("113.7");
    $("#rangeMaxValue").html($("#priceRange").val());
    //Set value of Price Range
    $("#priceRange").mousemove(function () {
      window.requestAnimationFrame(function () {
        $("#rangeMinValue").html("113.7");
        $("#rangeMaxValue").html($("#priceRange").val());
      });
    });

    $("#priceRange").change(() => {
      const urlListProductByPriceRange =
        "./public/ajax/getListProductByPriceRange.php";
      var currentPriceRange = $("#priceRange").val();
      let categoryName = $(".category-title").text();
      $.ajax({
        type: "POST",
        url: urlListProductByPriceRange,
        data: { categoryName: categoryName, priceRange: currentPriceRange },
        dataType: "JSON",
        success: function (data) {
          var products = data.map((element) => {
            return element;
          });
          renderPriceRangeProducts(products);
        },
        error: function (xhr, status, error) {
          alert(error);
        },
      });
    });

    function renderPriceRangeProducts(products) {
      if (products.length > 0) {
        let renderData = "";
        for (let i = 0; i < products.length; i++) {
          let onSale = "";
          let onSaleIcon = "";
          if (products[i].sale == 1) {
            onSale = `<p class="desc-price">On Sale From <span class="price">$${products[i].price}</span></p>`;
            onSaleIcon = `<span class="onsale">ONSALE</span>`;
          } else {
            onSale = `<p class="desc-price">From <span class="price">$${products[i].price}</span></p>`;
          }
          renderData +=
            `
                    <div class="col-lg-4 col-sm-6 product-layout" style='animation: popIn .4s;'>
                    <div class="product-item text-center">
                        <div class="img-product-item"
                            style="background: url('${products[i].pro_image}') no-repeat; height: 300px; background-size: cover;">
                            <a href="#" class="vote"><i class="far fa-heart"></i></a>
                            <a href='./cart-interaction.php?productName=p${products[i].name}' class="btn-cart">
                                + Add To Cart
                            </a>` +
            onSaleIcon +
            `</div>
                        <div class="overlay"
                            style="background: url('${products[i].image_name}') no-repeat; background-size: cover;">
                        </div>
                        <div class="product-item-info mt-4">
                            <a href="./product-detail.php?productName=${products[i].name}" class="product-item-title" target="_blank">
                                <p>${products[i].name}</p>
                            </a>` +
            onSale +
            `</div>
                    </div>
                </div>
                               `;
        }
        $("#productList").empty();
        $("#productList").append(renderData);
      } else {
        $("#productList").empty();
        $("#productList").html(`
                    <div class='col-12 text-center text-info'><h3>No Item Yet !!!</h3></div>
                `);
      }
    }
  }
  //Render Sort Products List
  if ($("#sort-selected")) {
    const urlSortProductsList = "./public/ajax/getSortProductsList.php";
    $("#sort-selected").change(() => {
      let categoryName = $(".category-title").text();
      var arrCriteria = $("#sort-selected option:selected").val().split("-");
      $.ajax({
        type: "POST",
        url: urlSortProductsList,
        data: {
          columnName: arrCriteria[0],
          criteria: arrCriteria[1],
          categoryName: categoryName,
        },
        dataType: "JSON",
        success: function (data) {
          var products = data.map((element) => {
            return element;
          });

          renderSortProducts(products);
        },
        error: function (xhr, status, error) {
          alert(error);
        },
      });

      function renderSortProducts(products) {
        if (products.length > 0) {
          let renderData = "";
          for (let i = 0; i < products.length; i++) {
            let onSale = "";
            let onSaleIcon = "";
            if (products[i].sale == 1) {
              onSale = `<p class="desc-price">On Sale From <span class="price">$${products[i].price}</span></p>`;
              onSaleIcon = `<span class="onsale">ONSALE</span>`;
            } else {
              onSale = `<p class="desc-price">From <span class="price">$${products[i].price}</span></p>`;
            }
            renderData +=
              `
                        <div class="col-lg-4 col-sm-6 product-layout" style='animation: popIn .4s;'>
                        <div class="product-item text-center">
                            <div class="img-product-item"
                                style="background: url('${products[i].pro_image}') no-repeat; height: 300px; background-size: cover;">
                                <a href="#" class="vote"><i class="far fa-heart"></i></a>
                                <a href='./cart-interaction.php?productName=p${products[i].name}' class="btn-cart">
                                    + Add To Cart
                                </a>` +
              onSaleIcon +
              `</div>
                            <div class="overlay"
                                style="background: url('${products[i].image_name}') no-repeat; background-size: cover;">
                            </div>
                            <div class="product-item-info mt-4">
                                <a href="./product-detail.php?productName=${products[i].name}" class="product-item-title" target="_blank">
                                    <p>${products[i].name}</p>
                                </a>` +
              onSale +
              `</div>
                        </div>
                    </div>
                                   `;
          }
          $("#productList").empty();
          $("#productList").append(renderData);
        } else {
          $("#productList").empty();
          $("#productList").html(`
                        <div class='col-12 text-center text-info'><h3>No Item Yet !!!</h3></div>
                    `);
        }
      }
    });
  }

  //Render Products By Category
  if ($(".list-categories")) {
    const urlListProducts = "./public/ajax/getProductByCategory.php";
    $(".list-category-item").each(function (key, val) {
      $(this).click(() => {
        let type = "";
        let url = "";
        if (this.innerHTML == "All") {
          type = "GET";
          url = urlAllProducts;
        } else {
          type = "POST";
          url = urlListProducts;
        }
        $.ajax({
          type: type,
          url: url,
          data: { categoryID: val.getAttribute("id") },
          dataType: "JSON",
          success: function (data) {
            var products = data.map((element) => {
              return element;
            });
            renderCategoryItem(products, val.innerHTML);
          },
        });
      });
    });

    function renderCategoryItem(products, val) {
      if (products.length != 0) {
        let renderData = "";
        $("#categories-info").empty();
        $("#categories-info").html(`
                    <div class="img-product-item"
                         style="background: url('${products[0].category_img}'); background-size: cover; height: 780px;">
                        <span class="product-info" style='animation: popIn .4s;'>
                            <h3>${products[0].category_name}</h3>
                            <p>${products.length} products</p>
                        </span>
                    </div>
                    `);
        $("#categories-info").attr(
          "href",
          `./collection.php?categoryName=${products[0].category_name}`
        );
        let limit4_ProductsByVote = products.slice(0, 4);
        limit4_ProductsByVote.forEach((element) => {
          let onSale = "";
          let onSaleIcon = "";
          if (element["sale"] == 1) {
            onSale = `<p class="desc-price">On Sale From <span class="price">$${element["price"]}</span></p>`;
            onSaleIcon = `<span class="onsale">ONSALE</span>`;
          } else {
            onSale = `<p class="desc-price">From <span class="price">$${element["price"]}</span></p>`;
          }
          renderData +=
            `
                                <div class="col-lg-6 col-sm-6" style='animation: popIn .4s;'>
                                    <div class="product-item">
                                        <div class="img-product-item main-img"
                                            style="background: url('${element.pro_image}') no-repeat; height: 300px; background-size: cover;">
                                            <a href="#" class="vote"><i class="far fa-heart"></i></a>
                                            <a href='./cart-interaction.php?productName=p${element.name}' class="btn-cart">
                                                + Add To Cart
                                            </a>` +
            onSaleIcon +
            `</div>
                                        <div class="overlay"
                                        style="background: url('${element.image_name}') no-repeat; background-size: cover;">
                                    </div>
                                    <div class="product-item-info mt-4">
                                        <a href="./product-detail.php?productName=${element.name}" class="product-item-title" target="_blank">
                                            <p>${element.name}</p>
                                        </a>
                                        ` +
            onSale +
            `
                                        </p>
                                    </div>
                                    </div>
                                </div>
                               `;
        });
        $("#productList").empty();
        $("#productList").append(renderData);
      } else {
        $("#categories-info").html(`
                <div class="img-product-item"
                    style="height: 200px;">
                    <span class="product-info" style='animation: popIn .4s;'>
                        <h3>${val}</h3>
                        <p>0 products</p>
                    </span>
                </div>
                `);
        $("#categories-info").attr(
          "href",
          `./collection.php?categoryName=${val}`
        );
        $("#productList").empty();
        $("#productList").html(
          '<div class="col-12 text-center text-info" style="animation: popIn .4s;"><h3>No Item Yet !!!</h3></div>'
        );
      }
    }
  }

  //Format sub img and main img of product
  if ($(".sub-img")) {
    let arrMainImg = document.querySelectorAll(".main-img");
    let arrSubImg = document.querySelectorAll(".sub-img");
    let objImg = [];
    let txt = "";
    let preSelect = arrSubImg[0];
    let number_MainImg = 0;
    $(".sub-img").each((index, item) => {
      objImg.push(item.src);
    });

    function setMainImg(number_MainImg) {
      let arrImg_Split =
        arrMainImg[number_MainImg].style.backgroundImage.split('"');
      arrImg_Split[1] = txt;
      arrMainImg[number_MainImg].style.backgroundImage = arrImg_Split
        .toString()
        .replaceAll(",", '"');
      arrMainImg[number_MainImg].style.animation = "all .6s";
    }

    function setBorder_ChooseSubImg(chooseImg) {
      preSelect.setAttribute("style", "border: none");
      preSelect = chooseImg;
      txt = chooseImg.getAttribute("src");
      preSelect.setAttribute("style", "filter: brightness(70%);");
    }

    arrSubImg.forEach((element) => {
      element.addEventListener("click", () => {
        setBorder_ChooseSubImg(element);
        if (objImg.indexOf(txt) < 4) {
          number_MainImg = 0;
        } else if (objImg.indexOf(txt) > 3 && objImg.indexOf(txt) < 6) {
          number_MainImg = 1;
        }
        setMainImg(number_MainImg);
      });
    });
  }

  //Format time of sale product
  if (
    document.querySelector(".day") &&
    document.querySelector(".hour") &&
    document.querySelector(".sec") &&
    document.querySelector(".min")
  ) {
    const day = document.querySelector(".day");
    const hour = document.querySelector(".hour");
    const min = document.querySelector(".min");
    const sec = document.querySelector(".sec");
    let days = 1700;
    let hours = 23;
    let mins = 59;
    let secs = 59;
    let txtSecs = 0;
    let txtMins = 0;
    let txtHours = 0;

    day.innerHTML = days;
    hour.innerHTML = hours;
    min.innerHTML = mins;
    sec.innerHTML = secs;

    function addZero(number) {
      if (number < 10 || number == 0) {
        return ("0" + number).slice(-2);
      } else {
        return number;
      }
    }

    setInterval(() => {
      if (sec.innerHTML == "00") {
        sec.innerHTML = secs;
        mins -= 1;
        min.innerHTML = mins;
        if (min.innerHTML == "00") {
          min.innerHTML = mins;
          hours -= 1;
          hour.innerHTML = hours;
          if (hour.innerHTML == "00") {
            hour.innerHTML = hours;
            days -= 1;
            day.innerHTML = days;
          } else {
            txtHours = hour.innerHTML;
            txtHours -= 1;
            hour.innerHTML = addZero(txtHours);
          }
        } else {
          txtMins = min.innerHTML;
          txtMins -= 1;
          min.innerHTML = addZero(txtMins);
        }
      } else {
        txtSecs = sec.innerHTML;
        txtSecs -= 1;
        sec.innerHTML = addZero(txtSecs);
      }
    }, 1000);
  }

  //Set Content of Blogs

  if ($("#blog-title")) {
    let countBlog = 0;
    let arrBlogs = [
      {
        title: "Should you use a Shave Cream or Shave Gel ?",
        img: "https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/blog11_1728x.jpg?v=1609344075",
        categories: "LOOK,NEW",
        date: "February 9, 2020",
        content:
          "The first thing you need to do is sit down and set your goals. Diana...",
      },
      {
        title: "Easy Family Home Work Outs",
        img: "https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/b8_900x.jpg?v=1608651515",
        categories: "FAMILY,FASHION,SALE,SUMMER",
        date: "February 9, 2020",
        content:
          "Even though most of Utah has fully opened up – we’ve been having fun doing...",
      },
      {
        title: "4 Ways To Wear A Button-Up Shirt",
        img: "https://cdn.shopify.com/s/files/1/0076/1708/5530/articles/b5_900x.jpg?v=1608651517",
        categories: "SALE,WEAR",
        date: "February 9, 2020",
        content:
          "Hey guys! I wanted to share the ‘Best of’ multiple categories from the Nordstrom Sale,...",
      },
    ];

    let arrCategories = [];
    var txtCategories = "";

    function setContentOfBlog(arrBlogs, count) {
      $("#blog-img").attr("src", arrBlogs[count].img);
      $("#blog-title").html(arrBlogs[count].title);
      $("#blog-categories").innerHTML = "";
      arrCategories = arrBlogs[count].categories.split(",");
      let categoriesTxt = "";
      arrCategories.forEach((element) => {
        categoriesTxt += `<a>${element} ,</a>`;
      });
      $("#blog-categories").empty();
      $("#blog-categories").append(categoriesTxt);
      $("#blog-date").html(arrBlogs[count].date);
      $("#blog-content").html(arrBlogs[count].content);
    }

    $("#btn-next").click(() => {
      countBlog += 1;
      if (countBlog >= arrBlogs.length) {
        countBlog = 0;
      }
      setContentOfBlog(arrBlogs, countBlog);
    });

    $("#btn-prev").click(() => {
      if (countBlog == 0) {
        countBlog = arrBlogs.length;
      }
      countBlog -= 1;
      setContentOfBlog(arrBlogs, countBlog);
    });
  }

  //Set value of products layout display
  if ($(".product-layout")) {
    let txt = "";
    $(".layout-display").each((index, item) => {
      $(item).click(() => {
        txt = [];
        let arrProductLayout = $(".product-layout").attr("class").split(/\s+/);
        switch (index) {
          case 0:
            arrProductLayout[0] = "col-lg-6";
            $(".product-layout").each((index, item) => {
              $(item).attr(
                "class",
                arrProductLayout.toString().replaceAll(",", " ")
              );
              $(item).css("transition", ".4s");
            });
            break;
          case 1:
            arrProductLayout[0] = "col-lg-4";
            $(".product-layout").each((index, item) => {
              $(item).attr(
                "class",
                arrProductLayout.toString().replaceAll(",", " ")
              );
              $(item).css("transition", ".4s");
            });
            break;
          case 2:
            arrProductLayout[0] = "col-lg-3";
            $(".product-layout").each((index, item) => {
              $(item).attr(
                "class",
                arrProductLayout.toString().replaceAll(",", " ")
              );
              $(item).css("transition", ".4s");
            });
            break;
          default:
            break;
        }
      });
    });
  }

  // Comments and Description of Product
  if ($(".product-selected")) {
    //Always Open Review View if GET parameter page == true
    let sParam = "page";
    var resultPage = GetUrlParameter(sParam);
    if (resultPage == true) {
      $("#btnReviewForm").focus();
      $("#review-slide").css("display", "block");
      $("#reviewView").css("display", "block");
    } else {
      $("#btnDesc").focus();
      $("#desc-slide").css("display", "block");
    }

    $("#btnDesc").click(() => {
      $("#desc-slide").css("display", "block");
      $("#review-slide").css("display", "none");
    });
    $("#btnReviewForm").click(() => {
      $("#desc-slide").css("display", "none");
      $("#review-slide").css("display", "block");
    });
    $("#btn-openReviewForm").click(() => {
      $("#review-form").css("display", "block");
      $("#reviewView").css("display", "none");
    });
    $("#btn-openReviewView").click(() => {
      $("#review-form").css("display", "none");
      $("#reviewView").css("display", "block");
    });

    function GetUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1);
      var sURLVariables = sPageURL.split("&");
      for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split("=");
        if (sParameterName[0] == sParam) {
          return true;
        }
      }
      return false;
    }
  }

  if ($(".banner-slide")) {
    let countBannerSlide = 0;
    //Set Content Of Banner
    let arrProduct = [
      {
        collection: { title: "LIGHTING", year: "2021" },
        img: "https://cdn.shopify.com/s/files/1/0076/1708/5530/files/s1_1512x.jpg?v=1607016667",
        title: "CHIATO",
        price: "$650.00",
      },
      {
        collection: { title: "LIGHTING", year: "2020" },
        img: "https://cdn.shopify.com/s/files/1/0076/1708/5530/files/s2_1512x.jpg?v=1607016667",
        title: "AURA",
        price: "$103.99",
      },
    ];

    let txtSplitImgOfBannerSlide = [];

    txtSplitImgOfBannerSlide = $(".banner-slide").attr("background-image");
    function setContentOfBanner(arrProduct, count) {
      $("#category-title").html(arrProduct[count].collection.title);
      $("#category-year").html(arrProduct[count].collection.year);
      $(".product-title").html(arrProduct[count].title);
      $(".product-price").html(arrProduct[count].price);
      $(".banner-slide").css(
        "background-image",
        `url(${arrProduct[count].img})`
      );
      $(".page").html("0" + (count + 1));
      $(".banner-slide").css("transition", `all .4s`);
    }

    $("#btn-slide-prev1").click(() => {
      countBannerSlide += 1;
      if (countBannerSlide >= arrProduct.length) {
        countBannerSlide = 0;
      }
      setContentOfBanner(arrProduct, countBannerSlide);
    });
    $("#btn-slide-next1").click(() => {
      if (countBannerSlide == 0) {
        countBannerSlide = arrProduct.length;
      }
      countBannerSlide -= 1;
      setContentOfBanner(arrProduct, countBannerSlide);
    });
    $("#btn-slide-prev2").click(() => {
      countBannerSlide += 1;
      if (countBannerSlide >= arrProduct.length) {
        countBannerSlide = 0;
      }
      setContentOfBanner(arrProduct, countBannerSlide);
    });
    $("#btn-slide-next2").click(() => {
      if (countBannerSlide == 0) {
        countBannerSlide = arrProduct.length;
      }
      countBannerSlide -= 1;
      setContentOfBanner(arrProduct, countBannerSlide);
    });
  }
});
