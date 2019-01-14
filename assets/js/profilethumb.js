

const portraitThumbnailImage = [...document.querySelectorAll('.user-img img')]
portraitThumbnailImage.map(img => {
    (img.clientHeight > img.clientWidth) ? img.classList.add('portrait') : img.classList.add('landscape')
})
