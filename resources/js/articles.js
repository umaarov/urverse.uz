// resources\js\articles.js
document.addEventListener ('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams (window.location.search);
  const activeTag = urlParams.get ('tag');

  if (activeTag) {
    const tagElements = document.querySelectorAll ('.tag');
    tagElements.forEach (tag => {
      if (tag.textContent.toLowerCase () === `#${activeTag.toLowerCase ()}`) {
        tag.classList.add ('active-tag');
      }
    });
  }
});
