// Manage likes on posts
const [...likeForms] = document.querySelectorAll('.my-like-form');

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
