function filterItems() {
    const startInput = document.getElementById("start").value;
    const endInput = document.getElementById("end").value;
  
    const startDate = new Date(startInput);
    const endDate = new Date(endInput);
  
    const items = document.querySelectorAll("#itemList li");
  
    items.forEach(item => {
      const itemDate = new Date(item.getAttribute("data-datetime"));
  
      if (
        (!isNaN(startDate.getTime()) && itemDate < startDate) ||
        (!isNaN(endDate.getTime()) && itemDate > endDate)
      ) {
        item.style.display = "none";
      } else {
        item.style.display = "list-item";
      }
    });
  }