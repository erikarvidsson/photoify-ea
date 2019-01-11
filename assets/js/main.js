// Manage likes on posts
const [...likeForms] = document.querySelectorAll('.my-like-form');
const select = document.querySelectorAll('.like-btn')

// Code do not edit

likeForms.forEach((likeForm) => {
    likeForm.addEventListener('submit', event => {

        event.preventDefault();

        const formData = new FormData(likeForm);

        if (likeForm[1].value === 'liked') {
            likeForm[1].value = 'disliked';
        } else {
            likeForm[1].value = 'liked';
        }

        fetch('app/users/likes.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(json => likeForm.nextElementSibling.nextSibling.previousSibling.textContent = json.likes);
          console.dir(likeForm.nextElementSibling.nextSibling);
    })
});


var sessionChecker = (req, res, next) => {
    if (req.session.user.id) {
        console.log('yess');
    }else{
      console.log('neej')
    }}


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
