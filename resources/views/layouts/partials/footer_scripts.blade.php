<script type="text/javascript">

    // NAVBAR BURGER IMPLEMENTATION FROM https://bulma.io/documentation/components/navbar/
    // Navbar Burger
    $(document).ready(function() {
      // Check for click events on the navbar burger icon
      $(".navbar-burger").click(function() {
          // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
          $(".navbar-burger").toggleClass("is-active");
          $(".navbar-menu").toggleClass("is-active");
      });
    });

</script>
