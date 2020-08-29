$(document).ready(function () {
  var currentPage = location.href;
  console.log(currentPage);

  initMeni();

  if (currentPage.indexOf("page") == -1 || currentPage.indexOf("page=index") != -1) {
    initIndex();

    $(".owl-nav").hide();
  }

  if (currentPage.indexOf("cars") != -1) {

    ajaxZahtev("models/initApi.php", function (data) {

      // let cats = populateList(data.cats);
      // $("#category").append(cats);

      // let fuels = populateList(data.fuels);
      // $("#fuel").append(fuels);

      let transmissions = printChbs(data.transmission);
      $(transmissions).insertAfter("#fuel");

      $(".prenos").click(function (e) {
        if (e.ctrlKey) {
          $(this).prop("checked", false);
        }
      })


    });

    ajaxZahtev("models/cars/filterCars.php", function (data) {
      let cars = populateCarDiv(data.cars);
      $("#carsContainer").html(cars);

      let paginacija = makePagination(data);
      $("#pagination").html(paginacija);

      $(".linkPagination").click(promeniStranuPaginacija);

    });

    $("#btnFilter").click(filterCars);


    $("#slider-range").slider({
      range: true,
      min: 0,
      max: 200,
      values: [0, 200],
      slide: function (event, ui) {
        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        $("#minVal").val(ui.values[0]);
        $("#maxVal").val(ui.values[1]);
      }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));

  }

  if (currentPage.indexOf("carDetails") != -1) {

    imageGallery();

    $(".tabs").click(changeTab);

    $(".tab-item:not(:first)").hide();

    $(".error-field").hide();

    $("#submitRequest").click(saljiRentZahtev);
  }

  if (currentPage.indexOf("login") != -1 || currentPage.indexOf("register") != -1 || currentPage.indexOf("contact")) {
    $(".error-field").hide();
  }

  if (currentPage.indexOf("profile") != -1) {
    $(".panelItem").click(promeniStranu);
  }

  if (currentPage.indexOf("register") != -1) {
    $("#email").blur(checkEmail);
  }

  // za admin panel
  if (currentPage.indexOf("formaZaInsert") != -1) {
    $(".error-field").hide();

    $(".tabs").click(changeTab);

    $(".tab-item:not(:first)").hide();

  }

  initFooter();
});


function promeniStranu(e) {
  e.preventDefault();

  let strana = $(this).data("pagename");

  $(".panelItem").removeClass("btn-primary");
  $(this).removeClass("btn-light");
  $(this).addClass("btn-primary");

  let url = "";
  switch (strana) {
    case "cars":
      let kola = new Car();
      kola.stampajZaCars();

      break;

    case "brands":
      let brand = new Brand();
      brand.stampajZaBrand();

      break;

    case "bookings":
      let booking = new Booking();
      booking.stampajZaBooking();

      break;

    case "stats":
      let stats = new Stats();
      stats.stampajStats();
      break;

    case "userBook":
      let userBooking = new UserBook();
      userBooking.stampajZaUserBooking();
      break;

    case "userReview":
      let userReview = new UserReview();
      userReview.stampajUserReview();
      break;

    case "adminReview":
      let adminReview = new AdminReview();
      adminReview.stampajAdminReview();
      break;

    default:
      break;
  }

  // console.log(url);

}



/* INICIJALNA UCITAVANJA */

function ajaxZahtev(url, callback) {
  $.ajax({
    url: url,
    success: callback,
    error: function (xhr, error, status) {
      console.log(xhr, error, status);
    },
  });
}

function ajaxZahtevPost(url, data, callback) {
  $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data: data,
    success: callback,
    error: function (xhr) {
      console.log(xhr);

      if (xhr.responseJSON.odg) {
        alert(xhr.responseJSON.odg);
      }

      if (xhr.responseJSON.text) {
        alert(xhr.responseJSON.text);
      }

    }
  })
}

function initIndex() {
  ajaxZahtev("models/initApi.php", (data) => {
    let carsOut = populateCarDiv(data.cars.slice(0, 4));

    // $("#carItems").html(carsOut);

    let numberOfCars = data.cars.length;

    console.log(numberOfCars);

    $("#numberCars").html(numberOfCars);
  });
}

function initMeni() {
  ajaxZahtev("models/initApi.php", data => {
    printGlavniMeni(data.glavniMeni);

    printKorMeni(data.korMeni);

    $("#glavniMeni li a").each(function () {
      // if (currentPage.indexOf($(this).attr("href")) != -1) {
      //   $(this).addClass("active");
      // }
      // console.log($(this).attr("href"));

      let glavnaStrana = location.href.split("=")[1];

      let strana = $(this).attr("href").split("=")[1];

      console.log(glavnaStrana, strana);

      if (glavnaStrana == strana) {
        $(this).addClass("activeLink");
      }

      if (glavnaStrana == undefined || glavnaStrana == 1) {
        $("#glavniMeni li a:first").addClass("activeLink");
      }

    });

  })
}

function printGlavniMeni(data) {
  let out = "";

  for (const el of data) {
    out += `
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=${el.href}">${el.text}</a>
        </li>
    `;
  }

  $("#glavniMeni").html(out);
}

function printKorMeni(data) {
  let out = "";

  for (const el of data) {
    if (el.href == "logout") {
      out += `
        <a class="dropdown-item" href="index.php?page=${el.href}">${el.text}</a>
      `;
    } else {
      out += `
        <a class="dropdown-item" href="index.php?page=profile&userPage=${el.href}">${el.text}</a>
      `;

    }

  }

  $("#korMeni").html(out);
}

function initFooter() {
  let socials = [
    ["Facebook", "https://www.facebook.com"],
    ["Instagram", "https://www.instagram.com"],
    ["Youtube", "https://www.youtube.com"],
    ["Docs", "docs.pdf"],
    ["Author", "index.php?page=author"]
  ];

  let out = "";

  for (const el of socials) {
    out += `
      <li>
        <a href="${el[1]}" target="_blank">${el[0]}</a>
      </li> <i class="slash"> &#47; </i>
    `;
  }

  $("#social").html(out);
}



// function changeTab() {
//   let tabName = $(this).data("tabname");
//   $(".tabs").removeClass("active-tab");
//   $(this).addClass("active-tab");

//   $(".tab-item").hide();
//   $("#" + tabName).fadeIn();

// }

function checkEmail() {
  let email = $(this).val();

  let podaciMail = {
    email: email,
    btnCheckEmail: true
  }

  ajaxZahtevPost("models/checkEmail.php", podaciMail, data => {
    if (data.odg != true) {
      let out = `<small class='form-text text-danger error-field' id='wrongEmail'>${data.odg}</small>`;

      if (!$("#wrongEmail").length) {
        $(out).insertAfter("#email");
      }


      $("#email").addClass("border-danger");

    } else {
      $("#wrongEmail").remove();
      $("#email").removeClass("border-danger");
      $("#emailErr").hide();
    }
  })
}


function filterCars() {
  let keyword = $("#searchKey").val();
  let catId = $("#category").val();
  let fuelId = $("#fuel").val();
  let transId = $("input[name='transmission']:checked").val() ? $("input[name='transmission']:checked").val() : "0";

  let minVal = $("#minVal").val();
  let maxVal = $("#maxVal").val();

  let btnVal = $(this).val();

  let podaci = [];

  podaci.push(keyword, catId, fuelId, transId, minVal, maxVal, btnVal);

  $.ajax({
    url: "models/cars/filterCars.php?page=cars&searchKey=" + keyword + "&category=" + catId + "&fuel=" + fuelId + "&transmission=" + transId + "&minVal=" + minVal + "&maxVal=" + maxVal + "&btnFilter=true",
    success: function (data) {
      console.log(data);

      let cars = "";

      if (data.cars.length) {
        cars = populateCarDiv(data.cars);
      } else {
        cars = "<h3 class='mt-5'>We don't have any car for selected criteria</h3>";
      }

      $("#carsContainer").html(cars);

      let paginacija = makePagination(data);
      $("#pagination").html(paginacija);

      $(".linkPagination").click(promeniStranuPaginacija);
    },
    error: function (xhr) {
      console.log(xhr);
    }
  })

}

function makePagination(data) {
  let out = "";

  for (let i = 1; i <= data.brStrana; i++) {
    out += `
      <a class="p-2 linkPagination" href="index.php?page=cars&pageNo=${i}${data.queryStr}">${i}</a>
    `;
  }

  // console.log(out, data.brStrana);

  return out;
}

function promeniStranuPaginacija(e) {
  e.preventDefault();

  let hrefAttr = $(this).attr("href").split("&");

  let queryStr = "";

  for (let i = 1; i < hrefAttr.length; i++) {
    // queryStr += "" + hrefAttr[i];

    if (i == 1) {
      queryStr += hrefAttr[i];
    } else {
      queryStr += "&" + hrefAttr[i];
    }
  }


  $.ajax({
    url: "models/cars/filterCars.php?" + queryStr,
    success: function (data) {
      console.log(data);

      let cars = populateCarDiv(data.cars);
      $("#carsContainer").html(cars);
    },
    error: function (xhr) {
      console.log(xhr);
    }
  })
}



function changeTab() {
  let tabName = $(this).data("tabname");
  $(".tabs").removeClass("active-tab");
  $(this).addClass("active-tab");

  $(".tab-item").hide();
  $("#" + tabName).fadeIn();

}

function imageGallery() {
  let highlight = $(".gallery-highlight");
  let previews = $(".car-preview img");

  previews.click(function () {
    let smallSrc = $(this).attr("src");
    let bigSrc = smallSrc.replace("small", "").replace("-", "").replace("//", "/");

    highlight.attr("src", bigSrc);
    previews.removeClass("car-active");
    $(this).addClass("car-active");
  });

}

function saljiRentZahtev() {
  let carId = $(this).data("vehicleid");
  let userId = $(this).data("userid");

  let fromDate = $("#fromDate").val();
  let toDate = $("#toDate").val();

  const current = new Date();
  const currentTmp = Date.UTC(current.getFullYear(), current.getMonth(), current.getDate());

  const date1 = new Date(fromDate);
  const date2 = new Date(toDate);

  const tmp1 = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
  const tmp2 = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());

  if (tmp1 < currentTmp || tmp2 < currentTmp) {
    alert("You must choose date in future");
    return false;
  }

  if (isNaN(tmp1) || isNaN(tmp2)) {
    alert("You must choose both dates");

    return false;
  }

  if (tmp1 > tmp2 || tmp1 == tmp2) {
    $("#dateErr").html("From date must be lower than date to");
    $("#dateErr").fadeIn();
    return false;

  } else {
    console.log("OKEJ SU DATUMI");
    $("#dateErr").fadeOut();
  }

  let podaci = {
    carId,
    userId,
    fromDate,
    toDate,
    btnRentRequest: true
  };

  ajaxZahtevPost("models/cars/handleBooking.php", podaci, data => {
    if (data.statusOdg) {
      alert(data.odg);
      $("#dateErr").fadeOut();
    } else {
      console.log(data.odg)
      $("#dateErr").html(data.odg);
      $("#dateErr").fadeIn();
    }
  });


}


/* FUNKCIJE ADMIN PANEL */



/* STAMPANJE */

function populateCarDiv(data) {
  let out = "";

  for (const el of data) {
    out += `
      <div class="col-sm-12 col-md-6 mb-4">
        <div class="item-1">
            <img src="assets/img/${el.mainImg}" alt="Image" class="img-fluid" />
            <div class="item-1-contents">
              <div class="text-center">
              <h3>${el.brandName} ${el.name}</h3>

              <div class="rent-price"><span>$${el.latestPrice}/</span>day</div>
              </div>
              <ul class="specs">
                <li>
                  <span>Doors</span>
                  <span class="spec">${el.doors}</span>
                </li>
                <li>
                  <span>Seats</span>
                  <span class="spec">${el.seats}</span>
                </li>
                <li>
                  <span>Transmission</span>
                  <span class="spec">${el.transmissionType}</span>
                </li>
                <li>
                  <span>Fuel</span>
                  <span class="spec">${el.fuelType}</span>
                </li>
              </ul>
              <div class="d-flex action">
                <a href="index.php?page=carDetails&carId=${el.vehicleId}" class="btn btn-primary">View Details</a>
              </div>
            </div>
          </div>
      </div>
    `;
  }

  return out;
}

function populateList(data) {
  let out = "";

  for (const el of data) {

    if (el.hasOwnProperty("categoryId")) {
      out += `
        <option value="${el.categoryId}">${el.categoryName}</option>
      `;
    } else if (el.hasOwnProperty("fuelType")) {
      out += `
        <option value="${el.fuelId}">${el.fuelType}</option>
      `;
    }
  }

  return out;
}

function printChbs(data) {
  let out = "<p>Transmission type <br /> <small>Press ctrl and click to deselect</small></p>";

  for (let i = 0; i < data.length; i++) {
    out += `
      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input prenos" id="customRadio${i}" name="transmission" value="${data[i].transmissionId}" />
        <label class="custom-control-label" for="customRadio${i}">${data[i].transmissionType}</label>
      </div>
    `;

  }

  return out;
}


/* PROVERE FORME */

var podaci = [];
var greske = [];

var regexName = /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{3,20}){0,2}$/;
var regexEmail = /^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/;
var regexLicenceNo = /^[A-Z][\d]{3}-[\d]{3}-[\d]{2}-[\d]{3}-[\d]$/;

var objValid = {
  fname: "John",
  lname: "Conally",
  email: "johnconnaly@gmail.com",
  licenceNo: "F255-921-50-094-0",
};

function proveriPolje(regex, polje) {
  if (regex.test(polje.val())) {
    podaci.push(polje.val());
    polje.removeClass("border-danger");
  } else {
    greske.push(polje.attr("id") + " nije dobro");
    polje.val("");
    polje.addClass("border border-danger");
    let pId = polje.attr("id");
    polje.attr("placeholder", objValid[pId]);
    return false;
  }
}

function proveriRegister() {
  podaci = [];
  greske = [];

  let fname = $("#fname");
  let lname = $("#lname");
  let email = $("#email");
  let password = $("#password");
  let licenceNo = $("#licenceNo");
  let yearsExp = $("#yearsExp");

  // proveriPolje(regexName, fname);
  // proveriPolje(regexName, lname);
  // proveriPolje(regexEmail, email);
  // proveriPolje(regexLicenceNo, licenceNo);

  // if (password.val().length < 5) {
  //   password.attr("placeholder", "Password must have 5 chars min");
  //   password.addClass("border border-danger");
  //   greske.push("Password must have 5 chars min");
  // } else {
  //   password.removeClass("border-danger");
  // }

  // if (yearsExp.val() < 0 || yearsExp.val() == "") {
  //   yearsExp.attr("placeholder", "Years must be positive number");
  //   yearsExp.val("");
  //   yearsExp.addClass("border border-danger");
  //   greske.push("Years of experience must be positive number");
  // } else {
  //   yearsExp.removeClass("border-danger");
  // }

  let polja = [
    {
      selector: "#fname",
      regex: /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{3,20}){0,2}$/,
      type: "input",
      example: "John"
    },
    {
      selector: "#lname",
      regex: /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{3,20}){0,2}$/,
      type: "input",
      example: "Connaly"
    },
    {
      selector: "#email",
      regex: /^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/,
      type: "input",
      example: "johnconnaly@gmail.com"
    },
    {
      selector: "#password",
      regex: /^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/,
      type: "password",
      example: "johnconnaly@gmail.com"
    },
    {
      selector: "#licenceNo",
      regex: /^[A-Z][\d]{3}-[\d]{3}-[\d]{2}-[\d]{3}-[\d]$/,
      type: "input",
      example: "F255-921-50-094-0"
    },
    {
      selector: "#yearsExp",
      type: "number",
      example: "Enter positive number"
    },

  ]

  for (const polje of polja) {
    if (polje.type == "input") {
      proveriInputPolje(polje);
    } else if (polje.type == "number") {
      proveriNumberPolje(polje);
    } else if (polje.type == "password") {
      proveriInputPass(polje);
    }
  }

  console.log(greske);

  if (greske.length == 0 && !$("#wrongEmail").length) {
    return true;
  } else {
    return false;
  }
}

function proveriLogin() {
  podaci = [];
  greske = [];

  let email = $("#email");
  let password = $("#password");

  // proveriPolje(regexEmail, email);

  // if (password.val().length < 5) {
  //   password.attr("placeholder", "Password must have 5 chars min");
  //   password.addClass("border border-danger");
  //   greske.push("Password must have 5 chars min");
  // } else {
  //   password.removeClass("border-danger");
  // }


  let polja = [
    {
      selector: "#email",
      regex: /^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/,
      type: "text",
      example: "somebody12@gmail.com"
    },
    {
      selector: "#password",
      type: "password"
    }
  ];

  for (const el of polja) {
    if (el.type == "text") {
      proveriInputPolje(el);
    } else if (el.type == "password") {
      proveriInputPass(el);
    }
  }

  console.log(greske);

  if (greske.length == 0) {
    return true;
  } else {
    return false;
  }
}


var podaciCar = new FormData();

var poljaCar = [
  {
    selector: "#carName",
    regex: /^[A-z\s\d\.]{2,30}$/,
    type: "input",
    example: "Sportage"
  },
  {
    selector: "#brandName",
    regex: "",
    type: "ddl"
  },
  {
    selector: "#categoryName",
    regex: "",
    type: "ddl"
  },
  {
    selector: "#desc",
    regex: "",
    type: "textarea"
  },
  {
    selector: "#modelYear",
    regex: /^(19|20)[0-9]{2}$/,
    type: "input",
    example: 2000
  },
  {
    selector: "#seats",
    regex: "",
    type: "number"
  },
  {
    selector: "#doors",
    regex: "",
    type: "number"
  },
  {
    selector: "#fuelType",
    regex: "",
    type: "ddl"
  },
  {
    selector: "input[name=transmissiontype]",
    regex: "",
    type: "radio",
    errSelector: "#transmissiontypeErr",
    name: "transmissiontype"
  },
  {
    selector: "#mileage",
    regex: "",
    type: "number"
  },
  {
    selector: "#luggage",
    regex: "",
    type: "number"
  },
  {
    selector: "#coverPhoto",
    regex: "",
    type: "file"
  },
  {
    selector: "#otherPhoto",
    regex: "",
    type: "file"
  },

  {
    selector: "#otherPhoto2",
    regex: "",
    type: "file"
  },
  {
    selector: "#price",
    regex: "",
    type: "number"
  }
];

function proveriFormuCar() {
  greske = [];

  for (const el of poljaCar) {
    if (el.type == "input") {
      proveriInputPolje(el, podaciCar);
      // let propName = el.selector.substr(1);

    } else if (el.type == "number") {
      proveriNumberPolje(el, podaciCar);
    } else if (el.type == "ddl") {
      proveriDdl(el, podaciCar);
    } else if (el.type == "radio") {
      let radio = $(el.selector + ":checked");

      if (radio.length == 0 || radio.val() == "") {
        greske.push("Select one option");
        $(el.errSelector).fadeIn();
        return false;
      } else {
        $(el.errSelector).hide();

        podaciCar.append(el.name, radio.val());

      }

    } else if (el.type == "textarea") {
      let area = $(el.selector);

      if (area.val().length < 10 || !area.val().trim().length) {
        greske.push("Desc must have at least 10 chars");
        area.addClass("border border-danger");

        $(el.selector + "Err").fadeIn();

        return false;
      } else {
        $(el.selector + "Err").hide();
        area.removeClass("border-danger");

        let propName = el.selector.substr(1);
        podaciCar.append(propName, area.val());
      }

    } else if (el.type == "file") {
      if (!$(el.selector).val()) {
        greske.push("Upload photo err");
        $(el.selector + "Err").fadeIn();
        return false;
      } else {
        $(el.selector + "Err").hide();

        let slika = document.querySelector(el.selector).files[0];

        let propName = el.selector.substr(1);

        podaciCar.append(propName, slika);
      }

    }
  }

  let oprema = $(".oprema:checked");

  if (oprema.length) {
    let opremaNiz = Array.from(oprema);

    for (const el of opremaNiz) {
      let elId = $(el).attr("id");
      let elVal = $(el).val();

      podaciCar.append(elId, elVal);
    }

  }

  console.log(greske);

  if (greske.length) {
    return greske;
  } else {

    podaciCar.append("btnInsertCar", "true");
    return podaciCar;
  }

}

var podaciCarUpdate = new FormData();

function proveriFormuCarUpdate() {

  podaciCarUpdate.append("carId", $("#carId").val());

  for (const el of poljaCar) {
    if (el.type == "input") {
      proveriInputPolje(el, podaciCarUpdate);
      // let propName = el.selector.substr(1);

    } else if (el.type == "number") {
      proveriNumberPolje(el, podaciCarUpdate);
    } else if (el.type == "ddl") {
      proveriDdl(el, podaciCarUpdate);
    } else if (el.type == "radio") {
      let radio = $(el.selector + ":checked");

      if (radio.length == 0 || radio.val() == "") {
        greske.push("Select one option");
        $(el.errSelector).fadeIn();
        return false;
      } else {
        $(el.errSelector).hide();

        podaciCarUpdate.append(el.name, radio.val());

      }

    } else if (el.type == "textarea") {
      let area = $(el.selector);

      if (area.val().length < 10) {
        greske.push("Desc must have at least 10 chars");
        area.addClass("border border-danger");

        $(el.selector + "Err").fadeIn();

        return false;
      } else {
        $(el.selector + "Err").hide();
        area.removeClass("border-danger");

        let propName = el.selector.substr(1);
        podaciCarUpdate.append(propName, area.val());
      }

    } else if (el.type == "file") {
      if ($(el.selector).val()) {
        $(el.selector + "Err").hide();

        let slika = document.querySelector(el.selector).files[0];

        let propName = el.selector.substr(1);

        podaciCarUpdate.append(propName, slika);

      }

    }
  }

  let oprema = $(".oprema:checked");

  if (oprema.length) {
    let opremaNiz = Array.from(oprema);

    for (const el of opremaNiz) {
      let elId = $(el).attr("id");
      let elVal = $(el).val();

      podaciCarUpdate.append(elId, elVal);
    }

  }

  console.log(greske);

  if (greske.length) {
    return greske;
  } else {

    podaciCarUpdate.append("btnUpdateCar", "true");
    return podaciCarUpdate;
  }
}


function proveriContact() {
  greske = [];

  let polja = [
    {
      selector: "#firstName",
      regex: /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{3,20}){0,2}$/,
      type: "input",
      example: "John"
    },
    {
      selector: "#lastName",
      regex: /^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{3,20}){0,2}$/,
      type: "input",
      example: "Smith"
    },
    {
      selector: "#email",
      regex: /^[A-z\d\.-]{5,100}\@[a-z]{2,10}\.[a-z]{2,20}$/,
      type: "input",
      example: "johnsmith@gmail.com"
    },
    {
      selector: "#msg",
      type: "textarea",
      example: "Your message must have at least 10 chars"
    }
  ];

  for (const el of polja) {
    if (el.type == "input") {
      proveriInputPolje(el);
    } else if (el.type == "textarea") {
      let area = $(el.selector);

      if (area.val().length < 10) {
        greske.push("Message must have at least 10 chars");
        area.addClass("border border-danger");

        $(el.selector + "Err").html(el.example);
        $(el.selector + "Err").fadeIn();

        return false;
      } else {
        $(el.selector + "Err").hide();
        area.removeClass("border-danger");
      }
    }
  }

  console.log(greske);

  if (greske.length) {
    return false;
  } else {
    return true;
  }

}

function proveriInputPolje(el, podaci = new FormData()) {
  let polje = $(el.selector);
  let regex = el.regex;
  let poljeErr = $(el.selector + "Err");
  let propName = el.selector.substr(1);

  if (regex.test(polje.val())) {
    polje.removeClass("border-danger");
    poljeErr.hide();
    podaci.append(propName, polje.val());
  } else {
    greske.push(el.selector + " not in right format");
    polje.val("");
    polje.addClass("border border-danger");

    poljeErr.html("Valid format: " + el.example);
    poljeErr.fadeIn();

    return false;
  }
}

function proveriNumberPolje(el, podaci = new FormData()) {
  let polje = $(el.selector);
  let poljeErr = $(el.selector + "Err");
  let propName = el.selector.substr(1);

  if (polje.val() < 0 || polje.val() == "") {
    polje.addClass("border border-danger");
    greske.push(el.selector + " enter positive number");

    poljeErr.html("Valid format: enter positive number");
    poljeErr.fadeIn();

    return false;
  } else {
    polje.removeClass("border-danger");
    poljeErr.hide();

    podaci.append(propName, polje.val());
  }
}

function proveriDdl(el, podaci = new FormData()) {
  let polje = $(el.selector);
  let propName = el.selector.substr(1);

  if (polje.val() == 0) {
    polje.addClass("border border-danger");
    greske.push(el.selector + " select one element");
    return false;
  } else {
    polje.removeClass("border-danger");

    podaci.append(propName, polje.val());
  }
}

function proveriInputPass(el, podaci = new FormData()) {
  let polje = $(el.selector);
  let propName = el.selector.substr(1);

  console.log(polje.val());

  if (polje.val() == "" || polje.val().length < 5) {
    let greskaPolje = $(el.selector + "Err");
    greskaPolje.fadeIn();
    greskaPolje.html("Password must have 5 chars min");

    greske.push("Password has less than 5 chars");
    polje.addClass("border border-danger");
    return false;
  } else {
    polje.removeClass("border-danger");

    podaci.append(propName, polje.val());
  }
}


// KLASE 
class UserBook {
  stampajZaUserBooking() {
    let url = "views/user/booking/selectAll.php";

    ajaxZahtev(url, data => {
      $("#mainContent").html(data);

      $(".cancelBookingUser").click((e) => {
        e.preventDefault();

        let bookId = e.target.dataset.bookingid;

        this.saljiCancelBooking(bookId);
      })

    });
  }

  saljiCancelBooking(bookId) {
    let status = $("#status").data("statusid");

    if (status == 1) {
      let url = "models/booking/cancelUserBook.php";

      let podaciCancel = {
        bookId: bookId,
        btnUserCancel: true
      };

      $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: podaciCancel,
        success: data => {
          if (data.odg) {
            alert("You successfully canceled");
            this.stampajZaUserBooking();
          } else {
            alert("You can't cancel");
          }
        },
        error: function (xhr) {
          console.log(xhr);
        }
      })
    } else {
      alert("Admin didn't aproved your request, you can't cancel yet");
    }

  }
}

class UserReview {
  stampajUserReview() {
    let url = "views/user/reviews/selectAll.php";

    ajaxZahtev(url, data => {
      $("#mainContent").html(data);

      $(".editReview").click(e => {
        e.preventDefault();

        let reviewId = e.target.parentElement.dataset.reviewid;

        this.handleEditReview(reviewId);
      });

      $(".deleleReview").click(e => {
        e.preventDefault();

        let reviewId = e.target.parentElement.dataset.reviewid;

        this.handleDeleteReview(reviewId);
      });

      $(".insertReview").click(() => {
        this.stampajInsertReview();
      })

    });
  }

  handleEditReview(reviewId) {
    let reviewTxt = $("#review" + reviewId);

    // let regexReview = /^[A-z](A-z\d\..)*$/;

    if (reviewTxt.val().trim().length) {
      let url = "models/reviews/userUpdate.php";

      let podaciReview = {
        reviewId: reviewId,
        reviewTxt: reviewTxt.val(),
        editReviewBtn: true
      };

      ajaxZahtevPost(url, podaciReview, data => {
        if (data.odg) {
          alert("Updated successfully");

          this.stampajUserReview();
        } else {
          alert(data.odg);
        }
      });

    } else {
      alert("Enter valid text");
    }

  }

  handleDeleteReview(reviewId) {

    let url = "models/reviews/userDelete.php";

    let podaci = {
      reviewId: reviewId,
      deleteReviewBtn: true
    };

    ajaxZahtevPost(url, podaci, data => {
      if (data.odg) {
        alert("Succesfully deleted");

        this.stampajUserReview();

      } else {
        alert(data.odg);
      }
    });

  }

  stampajInsertReview() {
    let url = "views/user/reviews/insertForm.php";

    ajaxZahtev(url, data => {
      $("#mainContent").html(data);

      $(".error-field").hide();

      $("#btnInsertReview").click(() => this.proveriInsertReview());
    });
  }

  proveriInsertReview() {
    greske = [];

    let podaciReview = {};

    let polja = [
      {
        selector: "#vehicleName",
        type: "ddl"
      },
      {
        selector: "#reviewTxt",
        regex: "",
        type: "textarea"
      }
    ];

    for (const el of polja) {
      let propName = el.selector.substr(1);

      if (el.type == "ddl") {
        if ($(el.selector).val() != 0) {
          $(el.selector + "Err").hide();
          $(el.selector).removeClass("border-danger");
          podaciReview[propName] = $(el.selector).val();

        } else {
          greske.push(el.selector + " you must choose");

          $(el.selector).addClass("border border-danger");

          return false;
        }
      } else {
        let area = $(el.selector);

        if (area.val().length < 10 || !area.val().trim().length) {
          greske.push("Review must have at least 10 chars");
          area.addClass("border border-danger");

          $(el.selector + "Err").fadeIn();

          return false;
        } else {
          $(el.selector + "Err").hide();
          area.removeClass("border-danger");

          podaciReview[propName] = area.val();
        }
      }
    }

    if (!$("#vehicleName").length) {
      console.log("Ne postoji ddl na strani");
      return false;
    }

    podaciReview.btnInsertReview = true;

    if (greske.length) {
      return false;
    }

    let url = "models/reviews/userInsert.php";
    ajaxZahtevPost(url, podaciReview, data => {
      if (data.odg) {
        alert("Successfully inserted review");

        this.stampajUserReview();
      } else {
        alert(data.odg);
      }
    });

  }

}
