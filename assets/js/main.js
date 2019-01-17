// Manage likes on posts
const [...likeForms] = document.querySelectorAll('.my-like-form');
const [...hearts] = document.querySelectorAll('.like-btn');

const select = document.querySelectorAll('.like-btn')

// Code do not edit

likeForms.forEach((likeForm) => {
    likeForm.addEventListener('submit', event => {

        event.preventDefault();

        const formData = new FormData(likeForm);
        const input = document.querySelector('.my-like-form').children[1];


        if (likeForm[1].value === 'liked') {
            likeForm[1].value = 'disliked';
        } else {
            likeForm[1].value = 'liked';
        }


        fetch('app/posts/likes.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(json => likeForm.nextElementSibling.children[0].textContent = `Likes: ${json.likes}`) ;


                let btnId = likeForm.dataset.id;
                console.log(btnId)
                document.querySelector(`.like-btn-${btnId}`).classList.toggle('liked');
    })
});



// sticky banner
    var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-200px";
  }
  prevScrollpos = currentScrollPos;
}


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
