gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

// Initialize ScrollSmoother
const smoother = ScrollSmoother.create({
    smooth: 1, // Smoothing value
    effects: true, // Enable effects
});

// Smooth scroll implementation with ScrollSmoother
document.querySelectorAll(".scroll-link").forEach(link => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href").substring(1); // Get the target section ID
        const target = document.getElementById(targetId);

        if (target) {
            // Use ScrollSmoother's scrollTo method
            smoother.scrollTo(target, true); // Pass true for smooth scrolling
        }
    });
});


var swiperOptions = {
	loop: false,
	freeMode: true,
	autoplay: {
		delay: 1500,
		disableOnInteraction: true,
	},
    navigation: {
        nextEl: ".swiper_button_next",
        prevEl: ".swiper_button_prev",
      },
	slidesPerView: 1,
	spaceBetween: 30,
	speed: 1000,
	grabCursor: true,
	breakpoints: {
        575: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        991: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
    },        
};

var swiper = new Swiper(".index_third_slider", swiperOptions);

var swiperOptions1 = {
	loop: false,
	freeMode: true,
	autoplay: {
		delay: 1500,
		disableOnInteraction: true,
	},
    navigation: {
        nextEl: ".swiper_button_next",
        prevEl: ".swiper_button_prev",
      },
	slidesPerView: 1,
	spaceBetween: 30,
	speed: 1000,
	grabCursor: true,
	breakpoints: {
        575: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        991: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
    },        
};

var swiper = new Swiper(".index_fourth_slider", swiperOptions1);

(function () {
  const quantityContainer = document.querySelector(".quantity");
  const minusBtn = quantityContainer.querySelector(".minus");
  const plusBtn = quantityContainer.querySelector(".plus");
  const inputBox = quantityContainer.querySelector(".input-box");

  updateButtonStates();

  quantityContainer.addEventListener("click", handleButtonClick);
  inputBox.addEventListener("input", handleQuantityChange);

  function updateButtonStates() {
    const value = parseInt(inputBox.value);
    minusBtn.disabled = value <= 1;
    plusBtn.disabled = value >= parseInt(inputBox.max);
  }

  function handleButtonClick(event) {
    if (event.target.classList.contains("minus")) {
      decreaseValue();
    } else if (event.target.classList.contains("plus")) {
      increaseValue();
    }
  }

  function decreaseValue() {
    let value = parseInt(inputBox.value);
    value = isNaN(value) ? 1 : Math.max(value - 1, 1);
    inputBox.value = value;
    updateButtonStates();
    handleQuantityChange();
  }

  function increaseValue() {
    let value = parseInt(inputBox.value);
    value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
    inputBox.value = value;
    updateButtonStates();
    handleQuantityChange();
  }

  function handleQuantityChange() {
    let value = parseInt(inputBox.value);
    value = isNaN(value) ? 1 : value;

    // Execute your code here based on the updated quantity value
    console.log("Quantity changed:", value);
  }
})();

