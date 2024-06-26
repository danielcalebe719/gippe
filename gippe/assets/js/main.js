
document.addEventListener('DOMContentLoaded', function() {
  AOS.init();

  const loadMoreBtn = document.getElementById('load-more-btn');
  let visibleImages = 15;

  const allImages = document.querySelectorAll('.portfolio-item');

  // Reveal initial set of images
  for (let i = 0; i < visibleImages && i < allImages.length; i++) {
    allImages[i].classList.add('visible');
  }

  loadMoreBtn.addEventListener('click', function() {
    for (let i = visibleImages; i < visibleImages + 10 && i < allImages.length; i++) {
      allImages[i].classList.add('visible');
    }

    visibleImages += 10;

    if (visibleImages >= allImages.length) {
      loadMoreBtn.style.display = 'none';
    }
  });

  const galleryImages = document.querySelectorAll('.portfolio-item.visible .gallery-image');
  galleryImages.forEach(image => {
    image.addEventListener('click', function(event) {
      event.preventDefault();
      const lightbox = document.createElement('div');
      lightbox.id = 'gallery-lightbox';
      lightbox.innerHTML = `
        <div class="lightbox-content">
          <img src="${image.src}" alt="${image.alt}" class="lightbox-image">
        </div>
        <span class="close-btn">&times;</span>
      `;
      document.body.appendChild(lightbox);

      const closeBtn = lightbox.querySelector('.close-btn');
      closeBtn.addEventListener('click', function() {
        document.body.removeChild(lightbox);
      });
    });
  });
});



window.addEventListener('DOMContentLoaded', (event) => {
  const portfolioItems = document.querySelectorAll('.portfolio-item');

  portfolioItems.forEach(item => {
      const image = item.querySelector('img');
      const info = item.querySelector('.portfolio-info');

      // Obtém a largura da imagem
      const imageWidth = image.offsetWidth;

      // Define a largura do .portfolio-info igual à largura da imagem
      info.style.width = imageWidth + 'px';
  });
});
document.addEventListener('DOMContentLoaded', () => {
  const items = document.querySelectorAll('.portfolio-item');
  const loadMoreBtn = document.getElementById('load-more-btn');
  let visibleItems = 0;
  const itemsToShow = 4;

  const showItems = () => {
      for (let i = visibleItems; i < visibleItems + itemsToShow; i++) {
          if (items[i]) {
              items[i].classList.add('visible');
          }
      }
      visibleItems += itemsToShow;
      if (visibleItems >= items.length) {
          loadMoreBtn.style.display = 'none';
      }
  };

  loadMoreBtn.addEventListener('click', showItems);

  // Mostrar os primeiros itens ao carregar a página
  showItems();
});


// Supondo que esteja sendo utilizado jQuery

$(document).ready(function() {
  $('form.php-email-form').submit(function(event) {
      var form = $(this);
      var formData = form.serialize();

      $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: formData,
          success: function(response) {
              // Limpa as mensagens anteriores
              form.find('.error-message, .sent-message').removeClass('d-block');

              // Verifica se a resposta contém um erro
              if (response.indexOf('Error:') !== -1) {
                  form.find('.error-message').addClass('d-block').html(response);
              } else {
                  form.find('.sent-message').addClass('d-block').html(response);
                  // Limpa o formulário se a mensagem foi enviada com sucesso
                  form[0].reset();
              }
          }
      });

      // Evita que o formulário seja enviado da maneira tradicional
      event.preventDefault();
  });
});







(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 16
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Header fixed top on scroll
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    let headerOffset = selectHeader.offsetTop
    let nextElement = selectHeader.nextElementSibling
    const headerFixed = () => {
      if ((headerOffset - window.scrollY) <= 0) {
        selectHeader.classList.add('fixed-top')
        nextElement.classList.add('scrolled-offset')
      } else {
        selectHeader.classList.remove('fixed-top')
        nextElement.classList.remove('scrolled-offset')
      }
    }
    window.addEventListener('load', headerFixed)
    onscroll(document, headerFixed)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Skills animation
   */
  let skilsContent = select('.skills-content');
  if (skilsContent) {
    new Waypoint({
      element: skilsContent,
      offset: '80%',
      handler: function(direction) {
        let progress = select('.progress .progress-bar', true);
        progress.forEach((el) => {
          el.style.width = el.getAttribute('aria-valuenow') + '%'
        });
      }
    })
  }

  /**
   * Testimonials slider
   */
  new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });

  /**
   * Porfolio isotope and filter
   */
  window.addEventListener('load', () => {
    let portfolioContainer = select('.portfolio-container');
    if (portfolioContainer) {
      let portfolioIsotope = new Isotope(portfolioContainer, {
        itemSelector: '.portfolio-item'
      });

      let portfolioFilters = select('#portfolio-flters li', true);

      on('click', '#portfolio-flters li', function(e) {
        e.preventDefault();
        portfolioFilters.forEach(function(el) {
          el.classList.remove('filter-active');
        });
        this.classList.add('filter-active');

        portfolioIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        portfolioIsotope.on('arrangeComplete', function() {
          AOS.refresh()
        });
      }, true);
    }

  });

  /**
   * Initiate portfolio lightbox 
   */
  const portfolioLightbox = GLightbox({
    selector: '.portfolio-lightbox'
  });

  /**
   * Portfolio details slider
   */
  new Swiper('.portfolio-details-slider', {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });

  /**
   * Initiate Pure Counter 
   */
  new PureCounter();

})()