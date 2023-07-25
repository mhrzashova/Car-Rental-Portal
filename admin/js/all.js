    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if(sidebar.classList.contains("active")){
      sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    }else
      sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
    // Get the "Analytics" and "Stock" menu elements
    const analyticsItem = document.getElementById("analyticsItem");
    const stockItem = document.getElementById("stockItem");
    const bookingsSubMenu = document.getElementById("bookingsSubMenu");

    // Function to toggle the visibility of "Analytics" and "Stock" items
    function toggleSubItems() {
      bookingsSubMenu.classList.toggle("active");

      // Calculate the height of the sub-menu
      const subMenuHeight = bookingsSubMenu.offsetHeight;

      // Adjust the position of the "Analytics" and "Stock" items
      if (bookingsSubMenu.classList.contains("active")) {
        analyticsItem.style.transform = `translateY(${subMenuHeight}px)`;
        stockItem.style.transform = `translateY(${subMenuHeight}px)`;
      } else {
        analyticsItem.style.transform = "translateY(0)";
        stockItem.style.transform = "translateY(0)";
      }
    }

    // Attach a click event listener to the "Bookings" menu
    bookingsMenu.addEventListener("click", toggleSubItems);