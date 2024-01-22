$(document).ready(function () {
  /**
   * Sidebar toggle
   */
  if ($(".toggle-sidebar-btn").length) {
    $(".toggle-sidebar-btn").on("click", function (e) {
      $("body").toggleClass("toggle-sidebar");
    });
  }

  /**
   * Search bar toggle
   */
  if ($(".search-bar-toggle").length) {
    $(".search-bar-toggle").on("click", function (e) {
      $(".search-bar").toggleClass("search-bar-show");
    });
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = $("#navbar .scrollto");
  const navbarlinksActive = () => {
    let position = window.scrollY + 200;
    navbarlinks.each(function () {
      let navbarlink = $(this);
      if (!navbarlink.prop("hash")) return;
      let section = $(navbarlink.prop("hash"));
      if (!section.length) return;
      if (
        position >= section.offset().top &&
        position <= section.offset().top + section.outerHeight()
      ) {
        navbarlink.addClass("active");
      } else {
        navbarlink.removeClass("active");
      }
    });
  };

  $(window).on("load", navbarlinksActive);
  $(document).on("scroll", navbarlinksActive);

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = $("#header");
  if (selectHeader.length) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.addClass("header-scrolled");
      } else {
        selectHeader.removeClass("header-scrolled");
      }
    };

    $(window).on("load", headerScrolled);
    $(document).on("scroll", headerScrolled);
  }

  /**
   * Back to top button
   */
  let backtotop = $(".back-to-top");
  if (backtotop.length) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.addClass("active");
      } else {
        backtotop.removeClass("active");
      }
    };

    $(window).on("load", toggleBacktotop);
    $(document).on("scroll", toggleBacktotop);
  }

  /**
   * Initiate tooltips
   */
  $('[data-bs-toggle="tooltip"]').tooltip();

  /**
   * Toggle Sidebar
   */
  var currentLocation = window.location.pathname.split("/").pop(); // gets the current path

  // Loop through each anchor tag inside #sidebar-nav
  $("#sidebar-nav a").each(function () {
    var href = $(this).attr("href");

    // Check if href matches the current location
    if (href === currentLocation) {
      $(this).removeClass("collapsed"); // Remove the 'collapsed' class
    }
  });

  /**
   * form validation
   */
  var forms = $(".needs-validation");

  // Loop over them and prevent submission
  forms.each(function () {
    var form = $(this);

    form.on("submit", function (e) {
      // Use checkValidity method on the form elements
      if (!form[0].checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        form.addClass("was-validated");
        return;
      }

      e.preventDefault();
      Swal.fire({
        title: "Loading",
        html: "Please wait...",
        allowOutsideClick: false,
        didOpen: function () {
          Swal.showLoading();
        },
      });

      var formData = form.serialize();

      $.ajax({
        type: "POST",
        url: "assets/components/includes/process.php",
        data: formData,
        dataType: "json",
        success: function (response) {
          setTimeout(function () {
            Swal.fire({
              icon: response.status,
              title: response.message,
              showConfirmButton: false,
              timer: 1000,
            }).then(function () {
              if (response.redirect) {
                window.location.href = response.redirect;
              } else {
                location.reload();
              }
            });
          }, 1000);
        },
      });
    });
  });

  /**
   * Logout button
   */
  $(".logout").click(function (e) {
    e.preventDefault();

    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, logout",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          icon: "success",
          title: "See you again!",
          showConfirmButton: false,
          timer: 1000,
        }).then(function () {
          window.location.href = "assets/components/includes/logout.php";
        });
      }
    });
  });
});
