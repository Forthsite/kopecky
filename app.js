let menuarray = document.querySelectorAll('.menu-opt');
menuarray.forEach(item => {
    item.onmouseover = function(){
        item.style.filter = "brightness(2)"
    }
});
const galleryItems = document.querySelectorAll('.grid-item');
// Function to filter gallery items based on category
function filterGallery(category) {
  // Loop through all gallery items
  galleryItems.forEach(item => {
    // If the item matches the selected category or "all", display it, otherwise hide it
    if (item.classList.contains(category)) {
    item.classList.add("fade-in")
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}
document.querySelectorAll('.grid-item.graphics img, .grid-item.socmedia img').forEach(image =>{
    image.onclick = () =>{
        document.querySelector('.popup-image').style.display = 'block';
        document.querySelector('.popup-image img').src = image.getAttribute('src');
    }
  });
  
  document.querySelector('.popup-image span').onclick = () => {
    document.querySelector('.popup-image').style.display = 'none';
  }
  