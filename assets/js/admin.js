window.onload = function () {

    let currentPage = location.href;

    $(".panelItem").click(promeniStranu);

}

// function ajaxZahtev(url, callback) {
//     $.ajax({
//         url: url,
//         success: callback,
//         error: function (xhr) {
//             console.log(xhr);
//         }
//     })
// }

class Car {

    stampajZaCars() {
        let url = "views/admin/cars/selectAll.php";
        ajaxZahtev(url, data => {
            // console.log(data);
            // console.log(this);

            $("#mainContent").html(data);

            $(".editCar").click((e) => {
                e.preventDefault();

                let carId = e.target.parentElement.dataset.carid;

                this.stampajUpdateCar(carId);
            });

            $(".deleteCar").click((e) => {
                e.preventDefault();

                let carId = e.target.parentElement.dataset.carid;

                console.log(carId);

                this.saljiZahtevZaDelete(carId);
            });

            $(".insertCar").click(() => this.stampajInsertCar());
        });
    }


    stampajInsertCar() {
        let url = "views/admin/cars/insertForm.php";
        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".error-field").hide();

            // $(".tabs").click(changeTab);

            // $(".tab-item:not(:first)").hide();

            $("#btnInsertCar").click(() => this.saljiFormuZaInsert());

            // $("#btnInsertCar").click(this.saljiFormuZaInsert);
        });
    }

    saljiFormuZaInsert() {
        let podaciCar = proveriFormuCar();

        $.ajax({
            url: "models/cars/insert.php",
            method: "POST",
            data: podaciCar,
            contentType: false,
            processData: false,
            success: (odgovor) => {
                if (odgovor.odg) {
                    alert("Successfully inserted!");
                    this.stampajZaCars();

                    console.log(this);

                } else {
                    console.log(odgovor.odg);
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    saljiZahtevZaDelete(carId) {
        let podaci = {
            carId: carId,
            btnDeleteCar: true
        }

        ajaxZahtevPost("models/cars/delete.php", podaci, data => {
            if (data.odg) {
                alert("Successfuly deleted");
                this.stampajZaCars();
            }
        });
    }

    stampajUpdateCar(carId) {
        let url = "views/admin/cars/updateForm.php?carId=" + carId;

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".error-field").hide();

            $("#btnUpdateCar").click(() => this.saljiZahtevZaUpdate());
        })
    }

    saljiZahtevZaUpdate() {
        let podaciCar = proveriFormuCarUpdate();

        console.log(podaciCar);

        //provera slike koci

        $.ajax({
            url: "models/cars/update.php",
            method: "POST",
            data: podaciCar,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);
                if (data.odg) {
                    alert("Updated successfully");
                    this.stampajZaCars();
                } else {
                    alert("Updated error, try again");
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });


    }


}

class Brand {

    stampajZaBrand() {
        let url = "views/admin/brands/selectAll.php";

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".editBrand").click((e) => {
                e.preventDefault();
                let brandId = e.target.parentElement.dataset.brandid;

                console.log(brandId, "Parent element je " + e.target.parentElement);

                this.prikaziFormuZaEdit(brandId);
            });

            $(".deleteBrand").click((e) => {
                e.preventDefault();

                let brandId = e.target.parentElement.dataset.brandid;

                console.log(brandId);

                this.saljiZahtevZaDelete(brandId);
            });

            $(".insertBrand").click(() => this.prikaziFormuZaInsert());

        });
    }

    prikaziFormuZaEdit(brandId) {
        // let brandId = $(this).data("brandid");
        let url = "views/admin/brands/insertForm.php?brandId=" + brandId;

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".error-field").hide();

            // let brandForm = document.querySelector("#brandForm");
            // brandForm.addEventListener("submit", this.proveriBrandFormu);

            $("#btnInsert").click(() => this.proveriBrandFormu());
        });

    }

    prikaziFormuZaInsert() {

        let url = "views/admin/brands/insertForm.php";

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".error-field").hide();

            console.log(this);

            // let brandForm = document.querySelector("#brandForm");
            // brandForm.addEventListener("submit", this.proveriBrandFormu);

            $("#btnInsert").click(() => this.proveriBrandFormu());

        })
    };

    proveriBrandFormu(e) {
        console.log("jel se poziva");
        let greske = [];

        let polje = {
            selector: "#brandName",
            regex: /^[A-Z][a-z\d\s\.]{3,40}$/,
            type: "input",
            example: "Mercedes"
        }

        proveriInputPolje(polje);

        let podaci = {
            brandName: $("#brandName").val(),
            btnInsert: true
        }

        let url = "models/brands/insert.php";

        if ($("#brandId").length) {
            podaci.brandId = $("#brandId").val();
            url = "models/brands/update.php";
        }

        console.log(greske, url);

        if (greske.length) {
            e.preventDefault();
        }

        ajaxZahtevPost(url, podaci, data => {
            console.log(data);

            if (data.status) {
                alert(data.text);
                this.stampajZaBrand();

            } else {
                alert(data.status);
            }
        });

    }

    saljiZahtevZaDelete(brandId) {
        let url = "models/brands/delete.php";
        // ajaxZahtev(url, data => {
        //     console.log(data);
        // })

        let podaci = {
            brandId: brandId,
            btnInsert: true
        }

        ajaxZahtevPost(url, podaci, data => {
            console.log(data);

            if (data.status) {
                alert(data.text);

                this.stampajZaBrand();
            }
        })


    }


}

class Booking {
    stampajZaBooking() {
        let url = "views/admin/booking/selectAll.php";

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".confirmBooking").click((e) => {
                e.preventDefault();

                let bookId = e.target.dataset.bookingid;

                this.saljiPotvrduBooking(bookId);
            });

            $(".cancelBooking").click((e) => {
                e.preventDefault();

                let bookId = e.target.dataset.bookingid;

                this.saljiCancelBooking(bookId);
            })

        });
    }


    saljiPotvrduBooking(bookId) {
        let url = "models/booking/handleBook.php";

        let podaci = {
            bookId: bookId,
            btnHandleBook: "true"
        };

        ajaxZahtevPost(url, podaci, data => {
            alert(data.odgovorTxt);

            this.stampajZaBooking();
        })
    }

    saljiCancelBooking(bookId) {
        let url = "models/booking/handleBookCancel.php";

        let podaci = {
            bookId: bookId,
            btnHandleBook: "false"
        };

        ajaxZahtevPost(url, podaci, data => {
            alert(data.odgovorTxt);

            this.stampajZaBooking();
        })
    }

}


class Stats {
    stampajStats() {

        console.log("jel se radi ovde nesto");

        let url = "views/admin/statsLog.php";

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

        });
    }
}

class AdminReview {
    stampajAdminReview() {
        let url = "views/admin/reviews/selectAll.php";

        ajaxZahtev(url, data => {
            $("#mainContent").html(data);

            $(".changeStatus").click((e) => {
                e.preventDefault();

                let reviewId = e.target.dataset.reviewid;

                let reviewStatus = e.target.dataset.reviewstatus;

                this.changeReviewStatus(reviewId, reviewStatus);
            });

        });
    }

    changeReviewStatus(reviewId, reviewStatus) {
        let url = "models/reviews/changeState.php";

        let podaci = {
            reviewId: reviewId,
            reviewStatus: reviewStatus,
            btnChangeState: true
        };

        ajaxZahtevPost(url, podaci, data => {
            if (data.odg) {
                alert("State successfully changed");
                this.stampajAdminReview();
            }
        });
    }



}



// function stampajZaCars(url) {
//     $.ajax({
//         url: url,
//         success: function (data) {
//             console.log(data);

//             $("#mainContent").html(data);

//             $(".editCar").click(saljiZahtevZaEditCar);
//             $(".deleteCar").click(saljiZahtevZaDeleteCar);

//             $(".insertCar").click(stampajInsertCar);
//         },
//         error: function (xhr) {
//             console.log(xhr);
//         }
//     })
// }

// function stampaj