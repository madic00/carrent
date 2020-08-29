<?php if(isset($_GET['btnFilterIndex'])): ?>

<script type="text/javascript">
  window.onload = function() {
    let searchKey = "<?= $_GET['searchKey'] ?>";
    let category = "<?= $_GET['category'] ?>";
    let fuel = "<?= $_GET['fuel'] ?>";

    var xhr = new XMLHttpRequest();

    xhr.open("GET", "models/cars/filterCars.php?page=cars&searchKey" + searchKey + "&category=" + category + "&fuel=" + fuel + "&btnFilter=true");

    xhr.onload = function() {
      let odg = JSON.parse(this.response);

      if(odg.cars.length) {
        cars = populateCarDiv(odg.cars);
      } else {
        cars = "<h3 class='mt-5'>We don't have any car for selected criteria</h3>";
      }

      document.querySelector("#carsContainer").innerHTML = cars;

      let paginacija = makePagination(odg);

      document.querySelector("#pagination").innerHTML = paginacija;

      document.querySelectorAll(".linkPagination").forEach(item => {
        item.addEventListener("click", promeniStranuPaginacija)
      });
      
    }

    xhr.send();

    document.querySelector("#searchKey").value = searchKey;
    document.querySelector("#category").value = category;
    document.querySelector("#fuel").value = fuel;

    // ne moze zato sto tek dole ucitavam vrednosti iz main jsa

  }

</script>

<?php endif; ?>